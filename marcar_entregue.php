<?php
include("includes/db.php");

if (isset($_GET['pedido_id'])) {
    $pedido_id = $_GET['pedido_id'];

    $sql_remover_pedido = "DELETE FROM pedidos WHERE id_cliente = $pedido_id";
    $resultado_remover_pedido = $conn->query($sql_remover_pedido);

    header("location: index.php");
}
?>
