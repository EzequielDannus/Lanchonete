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
                echo '<a href="marcar_entregue.php?pedido_id=' . $pedido['id'] . '">Pedido Entregue</a>';
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
    /* Reset de estilos básicos */
body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-image: url('background.jpg'); /* Substitua 'background.jpg' pela sua imagem de fundo desejada */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #fff;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9); /* Fundo semi-transparente */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.caixa {
    border: 1px solid #ccc;
    padding: 10px; /* Reduzimos o espaçamento interno */
    margin-bottom: 20px;
    background-color: rgba(255, 255, 255, 0.95); /* Fundo semi-transparente */
    border-radius: 5px;
}

h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
}

h2 {
    font-size: 22px;
    margin-bottom: 15px;
    color: #444;
}

p {
    font-size: 18px;
    margin-bottom: 10px;
    color: #666;
}

ul {
    list-style-type: none;
}

ul li {
    font-size: 16px;
    margin-bottom: 5px;
    color: #888;
}

a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    margin-left: 10px;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
}

/* Estilos para as imagens de comprovante */
img.comprovante {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
}

/* Estilos para o botão "Pedido Entregue" */
button.pedido-entregue {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

button.pedido-entregue:hover {
    background-color: #45a049;
}

</style>