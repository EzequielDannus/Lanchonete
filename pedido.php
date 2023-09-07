<?php
include("includes/db.php");

$sql = "SELECT *, c.id as cliente_id,pr.nome as nome_produto FROM pedidos p JOIN produtos pr ON pr.id=p.id_produtos JOIN clientes c ON c.id=p.id_cliente";
$resultado = $conn->query($sql);
$pedidos = $resultado->fetch_all(MYSQLI_ASSOC);

$clienteAtual = null;
$valorTotalCliente = 0;

foreach ($pedidos as $pedido) {
    
    if ($pedido['cliente_id'] != $clienteAtual) {
        
        if ($clienteAtual !== null) {
            echo '<p>Valor Total: R$' . $valorTotalCliente . '</p>';
            echo '</div><br>';
        }

        echo '<div class="caixa" style="border: 1px solid black;">';
        echo '<p> Cliente: ' . $pedido['nome'] . '</p>';
        echo '<p>Endereço: ' . $pedido['endereco'] . '</p>';

        $valorTotalCliente = 0;

        $clienteAtual = $pedido['cliente_id'];
    }

    
    echo '<p>Produto: ' . $pedido['nome_produto'] . '</p>';
    echo '<p>Valor: ' . $pedido['valor'] . '</p>';
        
    $valorTotalCliente += $pedido['valor'];
}
if(empty($pedido['comprovante_pix'])){
    if ($clienteAtual !== null) {
        echo '<p>Valor Total: R$' . $valorTotalCliente . '</p>';
        echo '</div><br>';
    }        
}
else{
    if ($clienteAtual !== null) {
        echo '<p>Valor Total: R$' . $valorTotalCliente . '</p>';
        
        
        foreach ($pedidos as $pedido) {
            if ($pedido['cliente_id'] == $clienteAtual) {
                echo '<img src="' . $pedido['comprovante_pix'] . '" alt="" width="250px">';
                echo '</div><br>';
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisco Coast - Pedidos</title>
</head>
<body>
    <?php if (empty($pedidos)) : ?>
        <div class="caixa" >
            <p>Sem Pedidos</p>
        </div>
    <?php endif ?>
</body>
</html>
