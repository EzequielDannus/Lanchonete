<?php
    include("includes/db.php");

    $sql="SELECT c.endereco FROM clientes c WHERE c.id = {$_SESSION['id']}";
    $resultado=$conn->query($sql); 
    $cliente = $resultado->fetch_all(MYSQLI_ASSOC);

    $sql_apagar_carrinho = "DELETE FROM carrinho WHERE id_cliente = {$_SESSION['id']}";
    $resultado_apagar_carrinho = $conn->query($sql_apagar_carrinho);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisco Coast - Confirmacao de Pedido</title>
</head>
<body>
    <h1>Pedido Feito com sucesso</h1>
    <p>Pedido sera Enviado em breve para <?php echo $cliente[0]['endereco']; ?></p>
    <a href="index.php"><button>Voltar para o Cardapio</button></a>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    font-size: 24px;
    margin: 20px 0;
}

p {
    text-align: center;
}

button {
    display: block;
    margin: 20px auto;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

button:hover {
    background-color: #0056b3;
}

@media (min-width: 768px) {
    /* Estilos para tablets e desktops */
    h1 {
        font-size: 28px;
    }
}

</style>