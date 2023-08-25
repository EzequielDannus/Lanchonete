<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

    $nome = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $pagamento = $_POST["pagamento"];
    $troco = isset($_POST["troco"]) ? $_POST["troco"] : null;

    // Processar a inserção do pedido no banco de dados
    $sql = "INSERT INTO pedidos (id_cliente, pagamento, troco) VALUES ($idCliente, '$pagamento', $troco)";
    $resultado = $conn->query($sql);

    if ($resultado) {
        // Inserir produtos associados ao pedido na tabela pedido_produtos
        $idPedido = $conn->insert_id;
        foreach ($_POST["produtos"] as $idProduto => $quantidade) {
            $sqlProduto = "INSERT INTO pedido_produtos (id_pedido, id_produto, quantidade) VALUES ($idPedido, $idProduto, $quantidade)";
            $conn->query($sqlProduto);
        }

        echo "Pedido realizado com sucesso!";
    } else {
        echo "Erro ao realizar o pedido: " . $conn->error;
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Fazer Pedido</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Fazer Pedido</h1>
    </header>
    <form method="post" action="fazer_pedido.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="endereco">Endereço:</label>
        <?php
        if (isset($_SESSION["user_id"])) {
            $userId = $_SESSION["user_id"];
            $sql = "SELECT endereco FROM clientes WHERE id = $userId";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $endereco = $row["endereco"];
                echo "<textarea name='endereco' required>$endereco</textarea><br>";
            }
        } else {
            echo "<textarea name='endereco' required></textarea><br>";
        }
        ?>
        <label for="pagamento">Forma de Pagamento:</label>
        <select name="pagamento" required>
            <option value="dinheiro">Dinheiro</option>
            <option value="PIX">PIX</option>
        </select><br>
        <label for="troco">Troco (se aplicável):</label>
        <input type="text" name="troco"><br>
        <!-- Outros campos de seleção de produtos, quantidade, etc. -->
        <input type="submit" value="Enviar Pedido">
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
