<?php
    include("includes/db.php");

    $sql="SELECT c.endereco FROM clientes c WHERE c.id = {$_SESSION['id']}";
    $resultado=$conn->query($sql); 
    $cliente = $resultado->fetch_all(MYSQLI_ASSOC);

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
    <p>Pedido Enviado para <?php echo $cliente[0]['endereco']; ?></p>
    <a href="index.php"><button>Voltar para o Cardapio</button></a>
</body>
</html>