<?php

//Verifica se o metodo é post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErr = $corErr = $precoErr = "";

    $nome = $_POST['nome'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];

    if (empty($nome)) {
       setcookie("nomeErr", "Preencha o nome", time()+2, "/");
       $nomeErr = true;
    }
    if (empty($cor)) {
        setcookie("corErr", "Selecione a cor", time()+2, "/");
        $corErr = true;
    }
    if (empty($preco)) {
        setcookie("precoErr", "Informe o preço", time()+2, "/");
        $precoErr = true;
    }

    if ($nomeErr || $corErr || $precoErr){
        header('location: adicionarproduto.php');
    }

    //cria a conexão
    include("dbconexao.php");
    
    //Inserindo o produto
    $sql_produto = "INSERT INTO produtos (nome, cor) VALUES ('$nome', '$cor')";
    $result_produto = $conn->query($sql_produto);
    $id_produto = $conn->insert_id;
    if ($result_produto) {
        echo "produto inserido " . $id_produto . "INSERT INTO precos (preco, idprod) VALUES ('$preco', $id_produto)";
        $sql_preco = "INSERT INTO precos (preco, idprodf) VALUES ('$preco', $id_produto)";
        $result_preco = $conn->query($sql_preco);
        if($result_preco) {
            echo "produto inserido";
            setcookie("msg", "Produto inserido com sucesso.", time()+2, "/");
        } else {
            setcookie("msgErr", "Falha ao inserir produto.", time()+2, "/");
            // echo "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . $result_preco;
        }
    } else {
        setcookie("msgErr", "Falha ao inserir produto.", time()+2, "/");
        // echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
    $conn->close();
    }

    header('location: ../adicionarproduto.php');
?>