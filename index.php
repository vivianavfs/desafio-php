<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Listar Produtos</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center border-bottom text-primary my-5">Lista de Produtos</h1>
        <div class="float-end mb-5">
            <a class="btn btn-primary" href="adicionarproduto.php">Adicionar Produto</a>
        </div>
        <?php
        include("dao/dbconexao.php");
        $sql_busca_produtos = "SELECT idprod, nome, cor, preco  FROM produtos INNER JOIN precos ON idprodf = idprod";
        $result_produtos = $conn->query($sql_busca_produtos);

        if ($result_produtos) {

            if (sizeof($result_produtos->fetch_assoc()) == 0) {
                $vazia = true;
            }
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
        ?>

        <?php if (isset($_COOKIE["msgedit"])) {
            echo "<p class='text-success'>" . $_COOKIE["msgedit"] . "</p>";
            $_COOKIE["msgedit"] = NULL;
        } ?>
        <?php if (isset($_COOKIE["msgeditErr"])) {
            echo "<p class='text-danger'>" . $_COOKIE["msgeditErr"] . "</p>";
            $_COOKIE["msgeditErr"] = NULL;
        } ?>
        <?php if (isset($_COOKIE["msgeditErr2"])) {
            echo "<p class='text-danger'>" . $_COOKIE["msgeditErr2"] . "</p>";
            $_COOKIE["msgeditErr2"] = NULL;
        } ?>
        <?php if (isset($_COOKIE["msgdelete"])) {
            echo "<p class='text-success'>" . $_COOKIE["msgdelete"] . "</p>";
            $_COOKIE["msgdelete"] = NULL;
        } ?>
        <?php if (isset($_COOKIE["msgdeleteErr"])) {
            echo "<p class='text-danger'>" . $_COOKIE["msgdeleteErr"] . "</p>";
            $_COOKIE["msgdeleteErr"] = NULL;
        } ?>

<p class="text-primary">Filtros</p>

            <p class="mb-0">Nome</p>
            <input class="mb-2" type="text" id="busca-nome" onkeyup="buscaPorNomes()" placeholder="Busca por nomes..">

            <p class="mb-0">Cor</p>
            <select class="mb-2" name="select-cor" id="select-cor" onchange="buscaPorCor()">
                <option value="">Filtre por Cor</option>
                <option value="amarelo">Amarelo</option>
                <option value="azul">Azul</option>
                <option value="vermelho">Vermelho</option>
            </select>

            <p class="mb-0">Preço</p>

                <input type="number" id="prmenor" placeholder="mínimo" step=".01">

                <input type="number" id="prmaior" placeholder="máximo" step=".01">

                <button class="btn btn-primary btn-sm" onclick="buscaPorPreco()">Filtrar</button>

        <table class="table" id="table-prods">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome do Produto</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Preço com Desconto</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>

                <?php if (isset($vazia)) {
                    echo "<tr><td colspan='6'> Não há produtos. </td></tr>";
                } else {
                    for ($i = 1; $i < $result_produtos->num_rows; $i++) {
                        $produto = $result_produtos->fetch_object();
                        echo "<tr>";
                        echo "<td scope='row'>" . $produto->idprod . "</td>";
                        echo "<td scope='row'>" . $produto->nome . "</td>";
                        echo "<td scope='row'>" . $produto->cor . "</td>";
                        echo "<td scope='row'>R$ " . number_format($produto->preco, 2, ',', '.') . "</td>";
                        echo "<td scope='row'>R$ ";
                        if ($produto->cor == "amarelo")
                            echo number_format(($produto->preco * 0.9), 2, ',', '.');
                        else if ($produto->cor == "azul" || ($produto->cor == "vermelho" && $produto->preco <= 50))
                            echo number_format(($produto->preco * 0.8), 2, ',', '.');
                        else if ($produto->cor == "vermelho" && $produto->preco > 50)
                            echo number_format(($produto->preco * 0.95), 2, ',', '.');
                        echo "</td>";
                        echo "<td><a href='editarproduto.php?idprod=" . $produto->idprod . "' class='btn btn-warning'>Editar</a></td>";
                        echo "<td><a href='dao/dbexcluirproduto.php?idprod=" . $produto->idprod . "' class='btn btn-danger'>Excluir</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        //busca na coluna de nomes pelo texto informado no input
        function buscaPorNomes() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("busca-nome");
            filter = input.value.toUpperCase();
            table = document.getElementById("table-prods");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        //busca na coluna de cores pela cor selecionada
        function buscaPorCor() {
            var filter, table, tr, td, i, txtValue;
            filter = document.getElementById("select-cor").value;
            table = document.getElementById("table-prods");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        //busca por preço, no preço com desconto
        function buscaPorPreco() {
            var minimo, maximo, table, tr, td, i, txtValue;
            minimo = parseFloat(document.getElementById("prmenor").value);
            maximo = parseFloat(document.getElementById("prmaior").value);
            table = document.getElementById("table-prods");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    numValue = parseFloat(txtValue.split('R$ ')[1].replace('.', '').replace(',','.'));
                    if (numValue >= minimo && numValue <= maximo) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }


    </script>
</body>

</html>