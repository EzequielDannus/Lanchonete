<?php
include("includes/db.php");

$sql="SELECT * FROM pedidos p JOIN clientes c ON c.id=p.id_cliente";
$resultado=$conn->query($sql);
$pedidos=$resultado->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisco Coast - Pedidos</title>
</head>
<body>
    <?php if(empty($pedidos)) : ?>
            <div class="caixa">
                <p>Sem Pedidos</p>
            </div>
        <?php endif ?>
    <?php foreach($pedidos as $pedido)  : ?>
        
    <?php if(isset($pedido)) : ?>
    <div class="caixa">
        <p> Cliente: <?php echo $pedido['nome'];?></p>
        <p>Endereço: <?php echo $pedido['endereco'];?></p>
        <p>Valor: <?php echo $pedido['valor']; ?></p>
    </div>
    <?php endif ?>
    <?php endforeach ?>
</body>
</html>