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
    <form method="post" action="processar_pedido.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="endereco">Endereço:</label>
        <?php
        require_once("includes/db.php");

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
        
        <!-- Recuperar os produtos do banco de dados -->
        <?php
        $sqlProdutos = "SELECT * FROM produtos";
        $resultProdutos = $conn->query($sqlProdutos);

        if ($resultProdutos->num_rows > 0) {
            echo "<ul>";
            while ($rowProduto = $resultProdutos->fetch_assoc()) {
                echo "<li>";
                echo "<label>{$rowProduto['nome']} - {$rowProduto['preco']}</label>";
                echo "<input type='number' name='produtos[{$rowProduto['id']}]' min='0'><br>";

                // Lista de ingredientes para este produto
                $sqlIngredientes = "SELECT * FROM lanche_ingredientes WHERE id_lanche = {$rowProduto['id']}";
                $resultIngredientes = $conn->query($sqlIngredientes);

                if ($resultIngredientes->num_rows > 0) {
                    echo "<ul>";
                    while ($rowIngrediente = $resultIngredientes->fetch_assoc()) {
                        echo "<li>";
                        echo "<input type='checkbox' name='remover_ingredientes[{$rowProduto['id']}][{$rowIngrediente['id_ingrediente']}]'>";
                        echo "{$rowIngrediente['nome_ingrediente']}";
                        echo "</li>";
                    }
                    echo "</ul>";
                }

                echo "</li>";
            }
            echo "</ul>";
        }
        ?>
        
        <input type="submit" value="Enviar Pedido">
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
