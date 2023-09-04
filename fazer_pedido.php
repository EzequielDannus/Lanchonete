<?php
include("includes/db.php");
if(!isset($_SESSION['id'])){
    header("location: login.php");
}

$sql = "SELECT * FROM carrinho c JOIN produtos p ON p.id=c.id_produto WHERE id_cliente= {$_SESSION['id']};";
$resultado = $conn->query($sql);

// Obtenha os ingredientes relacionados aos produtos no carrinho
$ingredientes_por_produto = array();
while ($cart = $resultado->fetch_assoc()) {
    $id_produto = $cart['id_produto'];
    
    $sql_ingredientes_produto = "SELECT i.nome as nome_ingrediente FROM ingredientes i JOIN lanche_ingredientes li ON i.id=li.id_ingrediente WHERE li.id_lanche = $id_produto;";
    $resultado_ingredientes = $conn->query($sql_ingredientes_produto);
    
    $ingredientes = array();
    while ($ingrediente = $resultado_ingredientes->fetch_assoc()) {
        $ingredientes[] = $ingrediente['nome_ingrediente'];
    }
    
    $cart['ingredientes'] = $ingredientes;
    $ingredientes_por_produto[] = $cart;
}

$carrinho = $ingredientes_por_produto;

$sqlsoma = "SELECT SUM(p.preco) FROM produtos p JOIN carrinho c ON p.id=c.id_produto WHERE id_cliente= {$_SESSION['id']}";
$resultado2 = $conn->query($sqlsoma);
$somacarrinho = $resultado2->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Fazer Pedido</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Carrinho</h1>
    </header>
    <form method="post" action="">
    <?php foreach($carrinho as $cart) : ?>
            <img src="<?php echo $cart['imagem']?>" alt="">
            <p class="food-desc"><?php echo $cart['nome'] ?></p>
            <p class=""><?php echo $cart['descricao']?></p>
            <p>Ingredientes:</p>
            <ul>
                <?php foreach($cart['ingredientes'] as $ingrediente) : ?>
                    <li>
                        <input type="checkbox" name="ingredientes_para_remover[]" value="<?php echo $ingrediente; ?>">
                        <?php echo $ingrediente; ?>
                    </li>
                <?php endforeach ?>
            </ul>
            <a href="delete.php?id_produto=<?php echo $cart['id_produto']; ?>"><img src="uploads/54324.png" alt="" width="20px"></a>
        <?php endforeach ?>
        <?php 
        require_once("includes/db.php");

        if (isset($_SESSION["user_id"])) {
            $userId = $_SESSION["id"];
            $sql = "SELECT endereco FROM clientes WHERE id = $userId";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $endereco = $row["endereco"];
                echo "<label for=''>Endereço:</label>";
                echo "<textarea name='endereco' required>$endereco</textarea><br>";
            }
        } else {
            echo "<textarea name='endereco' required></textarea><br>";
        }
        ?>
       <p>Valor Total: R$<?php echo $somacarrinho["SUM(p.preco)"]; ?></p>
       <label for="pagamento">Forma de Pagamento:</label>
<select name="pagamento" id="pagamento" required>
    <option value="dinheiro">Dinheiro</option>
    <option value="PIX">PIX</option>
</select><br>

<div id="chavePixField" style="display: none;">
    <label for="chavePix">Chave PIX:</label>
    <p>04432430001</p>
</div>

<input type="submit" name="remover_ingredientes" value="Remover Ingredientes">

<script>
    const pagamentoSelect = document.getElementById('pagamento');
    const chavePixField = document.getElementById('chavePixField');

    pagamentoSelect.addEventListener('change', function() {
        if (pagamentoSelect.value === 'PIX') {
            chavePixField.style.display = 'block';
        } else {
            chavePixField.style.display = 'none';
        }
    });
</script>

        <a href="index.php"><input type="submit" value="Enviar Pedido"></a>
    </form>
    <footer>
    </footer>
</body>
</html>