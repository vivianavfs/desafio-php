<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Adicionar Produto</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center border-bottom text-primary my-5">Cadastrar Produto</h1>
        <div class="mb-5">
            <a class="btn btn-primary" href="index.php">Voltar</a>
        </div>
        <div class="content">
       <?php if(isset($_COOKIE["msg"])) echo "<p class='text-success'>". $_COOKIE["msg"] . "</p>" ?>
       <?php if(isset($_COOKIE["msgErr"])) echo "<p class='text-danger'>". $_COOKIE["msgErr"] . "</p>" ?>
       <?php if(isset($_COOKIE["msgErrServer"])) echo "<p class='text-danger'>". $_COOKIE["msgErrServer"] . "</p>" ?>
            <form class="needs-validation" action="dao/dbsalvarproduto.php" method="post">
                <div class="mb-3">
                    <label for="inputNome" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" id="inputNome" name="nome">
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
                    <select class="form-select" multiple aria-label="multiple select" name="cor" required>
                        <option selected disabled value="">Selecione a cor</option>
                        <option value="amarelo">Amarelo</option>
                        <option value="azul">Azul</option>
                        <option value="vermelho">Vermelho</option>
                    </select>
                    <?php 
                    if(isset($_COOKIE["corErr"])){
                    echo '<div class="text-danger">
                        Por favor selecione uma cor.
                    </div>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="inputPreco" class="form-label">Preço do Produto</label>
                    <input type="number" class="form-control" id="inputPreco" name="preco" step=".01" required>
                    <?php 
                    if(isset($_COOKIE["precoErr"])){
                    echo '<div class="text-danger">
                        Por favor selecione uma cor.
                    </div>';
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</body>

</html>