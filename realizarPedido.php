<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cliente_nome = $_POST["cliente_nome"];
    $endereco = $_POST["endereco"];
    $forma_pagamento = $_POST["forma_pagamento"];
    $produtos = $_POST["produtos"]; 

    $total = 0;
    foreach ($produtos as $produto_id) {
        
        $query = "SELECT preco FROM produtos WHERE id = $produto_id";
        $result = $conn->query($query);
        $preco = $result->fetch_assoc()["preco"];
        $total += $preco;
    }

    
    $query = "INSERT INTO pedidos (cliente_nome, endereco, valor_total, forma_pagamento, status) VALUES ('$cliente_nome', '$endereco', '$total', '$forma_pagamento', 'pendente')";
    if ($conn->query($query) === TRUE) {
        echo "Pedido realizado com sucesso!";
    } else {
        echo "Erro ao realizar o pedido: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Realizar Pedidos</title>
</head>
<body>
    <h1>Realizar Pedidos</h1>
    <form method="post">
        Cliente: <input type="text" name="cliente_nome"><br>
        Endereço: <input type="text" name="endereco"><br>
        Forma de Pagamento: <select name="forma_pagamento">
            <option value="dinheiro">Dinheiro</option>
            <option value="PIX">PIX</option>
        </select><br>
        Selecionar Produtos:<br>
        <?php
        $query = "SELECT * FROM produtos";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo '<input type="checkbox" name="produtos[]" value="' . $row["id"] . '"> ' . $row["nome"] . '<br>';
        }
        ?>
        <input type="submit" value="Realizar Pedido">
    </form>
</body>
</html>

<?php
$conn->close();
?>
