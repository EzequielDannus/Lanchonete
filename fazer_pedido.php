<?php
include("includes/db.php");
$pagamento = isset($_POST["pagamento"]) ? $_POST["pagamento"] : '';
$troco = isset($_POST["troco"]) ? $_POST["troco"] : '';
$comprovantePix = isset($_POST["comprovante_pix"]) ? $_POST["comprovante_pix"] : '';

if(isset($_GET['produto_id'])) {
    $produtoId = $_GET['produto_id'];


    $sqlProduto = "SELECT * FROM produtos WHERE id = $produtoId";
    $resultProduto = $conn->query($sqlProduto);

    
    $sqlPedidoInsert = "INSERT INTO pedidos (id_cliente,id_produtos ,data_pedido, pagamento, troco, comprovante_pix) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?, ?)";
    $stmtPedidoInsert = $conn->prepare($sqlPedidoInsert);
    $stmtPedidoInsert->bind_param("iisss", $_SESSION['id'], $produtoId, $pagamento, $troco, $comprovantePix);

    if($resultProduto->num_rows == 1) {
        $rowProduto = $resultProduto->fetch_assoc();


        $sqlIngredientes = "SELECT i.id, i.nome FROM ingredientes i
                            JOIN lanche_ingredientes li ON i.id = li.id_ingrediente
                            WHERE li.id_lanche = $produtoId";
        $resultIngredientes = $conn->query($sqlIngredientes);
        $ingredientes = $resultIngredientes->fetch_all(MYSQLI_ASSOC);
    } else {

        header("Location: index.php");
        exit();
    }
} else {

    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['remover_ingredientes'])) {
        $ingredientesRemover = $_POST['remover_ingredientes'];
        foreach($ingredientesRemover as $idIngrediente) {

        }
    }

}

$pagamento = isset($_POST["pagamento"]) ? $_POST["pagamento"] : ''; 
$troco = isset($_POST["troco"]) ? $_POST["troco"] : ''; 
$comprovantePix = $pagamento ; 


if ($stmtPedidoInsert->execute()) {
    $pedidoId = $stmtPedidoInsert->insert_id; // Obtém o ID do pedido recém-inserido
    // ...
} else {
    echo "Erro ao inserir pedido: " . $stmtPedidoInsert->error;
}
$stmtPedidoInsert->close();

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
    <form method="post" action="fazer_pedido.php?produto_id=<?php echo $produtoId; ?>">
 
        <h2>Lanche Selecionado</h2>
        <p>Nome: <?php echo $rowProduto['nome']; ?></p>
        <p>Preço: R$ <?php echo $rowProduto['preco']; ?></p>
        <p>Descrição: <?php echo $rowProduto['descricao']; ?></p>

      
        <h2>Remover Ingredientes</h2>
        <?php if (!empty($ingredientes)) : ?>
            <ul>
                <?php foreach ($ingredientes as $ingrediente) : ?>
                    <li>
                        <input type="checkbox" name="remover_ingredientes[]" value="<?php echo $ingrediente['id']; ?>">
                        <?php echo $ingrediente['nome']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Não há ingredientes para remover deste lanche.</p>
        <?php endif; ?>

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

        <a href="index.php"><input type="submit" value="Enviar Pedido"></a>
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>