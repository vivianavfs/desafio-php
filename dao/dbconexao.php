<?php
//Variaveis para conectar no banco
$servername = "localhost";
$database = "loja";
$username = "root";
$password = "123";

//conectando no bando
$conn = new mysqli($servername, $username, $password, $database);

//verificando a conexão, se falhar retorna um cokokie de erro com a mensagem
if ($conn->connect_error) {
    setcookie("msgErrServer", "Falha no servidor.", time() + 2);
    die("Falha na conexão: " . mysqli_connect_error());
}
?>