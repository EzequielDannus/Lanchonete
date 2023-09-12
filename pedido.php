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
                echo 'Comprovante Pix: <br>';
                echo '<img src="' . $pedido['comprovante_pix'] . '" alt="" width="250px">';
                echo '<a href="marcar_entregue.php?pedido_id=' . $pedido['id_cliente'] . '">Pedido Entregue</a>';
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

.caixa {
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    padding: 20px;
    margin: 10px;
}

.caixa p {
    margin: 0;
}

.caixa img {
    max-width: 100%;
    height: auto;
}

.caixa a {
    display: block;
    text-align: center;
    margin-top: 10px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
}

.caixa a:hover {
    background-color: #0056b3;
}

@media (min-width: 768px) {
    /* Estilos para tablets e desktops */
    h1 {
        font-size: 28px;
    }

    .caixa {
        max-width: 600px;
        margin: 20px auto;
    }
}

</style>