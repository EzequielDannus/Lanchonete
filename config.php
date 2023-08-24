<?php
$host = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$database = "lanche_facil";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
