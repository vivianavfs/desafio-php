<?php

//Verifica se o metodo é post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErr = $corErr = $precoErr = "";

    $idprod = $_POST['idprod'];
    $nome = $_POST['nome'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];


    if (empty($nome)) {
        setcookie("nomeErr", "Preencha o nome", time() + 2);
        $nomeErr = true;
    }
    if (empty($cor)) {
        setcookie("corErr", "Selecione a cor", time() + 2);
        $corErr = true;
    }
    if (empty($preco)) {
        setcookie("precoErr", "Informe o preço", time() + 2);
        $precoErr = true;
    }

    if ($nomeErr || $corErr || $precoErr) {
        header('location: editarproduto.php');
    }

    //cria a conexão
    include("dbconexao.php");


    //busca o produto e preço pelo id
    $sql_busca_produto = "SELECT * FROM produtos INNER JOIN precos ON idprodf = idprod WHERE idprod =" . $idprod;
    $result_produto = $conn->query($sql_busca_produto);



    //Verifica se houve alteração antes de salvar
    $produto_banco = $result_produto->fetch_object();
    if ($result_produto->num_rows == 1) {
        if ($produto_banco->nome != $nome || $produto_banco->cor != $cor || $produto_banco->preco) {
            
            //Atualiza o produto
            $sql_alter_produto = "UPDATE produtos SET nome='$nome' WHERE idprod = $produto_banco->idprod";
            $result_update_produto = $conn->query($sql_alter_produto);
            echo var_dump($result_update_produto, $sql_alter_produto);

            if ($result_update_produto) {
                echo "test2";
                //Atualiza o preço do produto
                $sql_alter_produto = "UPDATE precos SET preco=$preco WHERE idprodf = $produto_banco->idprod AND idpreco = $produto_banco->idpreco";
                $result_update_preco = $conn->query($sql_alter_produto);

                if ($result_update_preco) {
                    echo "test3";
                    setcookie("msgedit", "Produto atualizado com sucesso.", time() + 2, "/");
                } else {
                    setcookie("msgeditErr", "Falha ao atualizar o preço do produto.", time() + 2, "/");
                }
            } else {
                setcookie("msgeditErr2", "Falha ao atualizar o produto.", time() + 2, "/");
            }
        }
    }

    //Fecha a conexão
    $conn->close();
}

    //Volta a página inicial
    header('location: ../index.php');

?>