<?php

//Obtem o ID
$idprod = $_GET['idprod'];

//Incluí a conexão
include('dbconexao.php');

//Verifica se existe o produto e o preço
$sql_busca_produto = "SELECT * FROM produtos INNER JOIN precos ON idprod = idprodf WHERE idprod = $idprod";
$result_produto = $conn->query($sql_busca_produto);

//Caso encontre o produto, deleta o produto
if($result_produto->num_rows == 1) {
    $sql_deleta_produto = "DELETE FROM `produtos` WHERE `produtos`.`idprod` = $idprod";
    $result_delete = $conn->query($sql_deleta_produto);

    echo var_dump($result_delete);

    if($result_delete){
        setcookie("msgdelete", "Produto " . $idprod . " deletado.", time()+2, "/");
    } else {
        setcookie("msgdeleteErr", "Produto " . $idprod . " não foi deletado.", time()+2, "/");
    }
}

header("location: ../index.php");