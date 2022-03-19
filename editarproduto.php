<?php

$idprod = $_GET['idprod'];

include("dao/dbconexao.php");

$query_prod = "SELECT * FROM produtos WHERE idprod = ".$idprod;

$prod_result = $conn->query($query_prod);

if ($prod_result->num_rows == 1) {
    $produto = $prod_result->fetch_object();
    $query_preco = "SELECT preco FROM precos WHERE idprodf = ". $idprod;
    $preco_result = $conn->query($query_preco);
    if ($preco_result->num_rows == 1) {
        $produto->preco = $preco_result->fetch_object()->preco;
    }
}
$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Editar Produto</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center border-bottom text-primary my-5">Editar Produto</h1>
        <div class="mb-5">
            <a class="btn btn-primary" href="index.php">Voltar</a>
        </div>
        <div class="content">
       <?php if(isset($_COOKIE["msg"])) { echo "<p class='text-success'>". $_COOKIE["msg"] . "</p>"; $_COOKIE["msg"] = NULL; } ?>
       <?php if(isset($_COOKIE["msgErr"])) { echo "<p class='text-danger'>". $_COOKIE["msgErr"] . "</p>"; $_COOKIE["msgErr"] = NULL; } ?>
       <?php if(isset($_COOKIE["msgErrServer"])) { echo "<p class='text-danger'>". $_COOKIE["msgErrServer"] . "</p>"; $_COOKIE["msgErrServer"] = NULL; } ?>
            <form class="needs-validation" action="dao/dbeditarproduto.php" method="post">
                <div class="mb-3">
                    <label for="inputNome" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" id="inputNome" name="nome" value="<?php echo $produto->nome; ?>">
                    <?php 
                    if(isset($_COOKIE["nomeErr"])){
                    echo '<div class="text-danger">
                    Preencha o nome do produto.
                    </div>';
                    $_COOKIE["nomeErr"] = NULL;
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <select class="form-select" multiple aria-label="multiple select" name="cor">
                        <option disabled value="">Selecione a cor</option>";
                        <option disabled value="amarelo"  <?php echo $produto->cor == "amarelo" ? "selected" : ""; ?> >Amarelo</option>";
                        <option disabled value='azul' <?php echo $produto->cor == "azul" ? "selected" : ""; ?> >Azul</option>";
                        <option disabled value='vermelho' <?php echo $produto->cor == "vermelho" ? "selected" : ""; ?>>Vermelho</option>";
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputPreco" class="form-label">Preço do Produto</label>
                    <input type="number" class="form-control" id="inputPreco" name="preco" step=".01" value="<?php echo number_format($produto->preco, 2, ',', ''); ?>" required>
                    <?php 
                    if(isset($_COOKIE["precoErr"])){
                    echo '<div class="text-danger">
                        Por favor selecione uma cor.
                    </div>';
                    $_COOKIE["precoErr"] = NULL;
                    }
                    ?>
                </div>
                <input type="hidden" name="idprod" value="<?php echo $produto->idprod ?>">
                
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</body>

</html>