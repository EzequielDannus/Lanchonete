<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit; // Encerrar o script para evitar processamento desnecessário
}

if (isset($_GET['id_produto'])) {
    $produto_id = $_GET['id_produto'];
    $cliente_id = $_SESSION['id'];

    $sql_delete = "DELETE FROM carrinho WHERE id_cliente = $cliente_id AND id_produto = $produto_id";
    $result_delete = $conn->query($sql_delete);

    if ($result_delete) {
        header("location: fazer_pedido.php"); // Redirecionar de volta para o carrinho
        exit;
    } else {
        echo "Erro ao excluir o produto do carrinho.";
    }
}
?>
