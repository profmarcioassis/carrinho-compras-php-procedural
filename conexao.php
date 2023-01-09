<?php

//Dados do banco de dados
define("DB_HOST", "localhost");
define("DB_NAME", "loja_site");
define("DB_USER", "root");
define("DB_PASS", "");

//Conexao com Banco de Dados
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);

?>