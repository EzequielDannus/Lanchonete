<?php
include("includes/db.php");
if(!isset($_SESSION['id'])){
    header("location: login.php");
}

$sql = "SELECT * FROM carrinho c JOIN produtos p ON p.id=c.id_produto WHERE id_cliente= {$_SESSION['id']};";
$resultado = $conn->query($sql);

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
    

    
    $carrinho = $ingredientes_por_produto;

    $sqlsoma = "SELECT SUM(p.preco) AS soma FROM produtos p JOIN carrinho c ON p.id=c.id_produto WHERE id_cliente= {$_SESSION['id']}";
    $resultado2 = $conn->query($sqlsoma);
    $somacarrinho = $resultado2->fetch_assoc();

    if (isset($_FILES["comprovantePix"]["name"])) {
    $uploadDir = "comprovantes/";
    $nomeArquivo = uniqid() . "_" . $_FILES["comprovantePix"]["name"];
    $caminhoArquivo = $uploadDir . $nomeArquivo;
    

    if(isset($_POST['enviar_pedido'])){
     
        $sql_pedido = "INSERT INTO pedidos (id_cliente, data_pedido, valor, pagamento, cliente_endereco, troco, comprovante_pix, id_produtos) VALUES ({$_SESSION['id']}, NOW(), {$somacarrinho["soma"]}, '{$_POST['pagamento']}', '{$_SESSION['endereco']}','{$_POST['troco']}', '$caminhoArquivo', {$cart['id']})";
        $resultado22 = $conn->query($sql_pedido);
            
        if (move_uploaded_file($_FILES["comprovantePix"]["tmp_name"], $caminhoArquivo)) {
            echo "deu";
        } else {
            echo "Erro ao mover o arquivo para o diretório de destino.";
        }

        if ($resultado) {
            $ingredientesParaRemover = $_POST['ingredientes_para_remover'];
            $ingredientesParaRemoverString = "'" . implode("','", $ingredientesParaRemover) . "'";

            $sql_descontaigrediente = "UPDATE ingredientes i
                JOIN lanche_ingredientes li ON i.id = li.id_ingrediente
                JOIN carrinho c ON li.id_lanche = c.id_produto
                SET i.quantidade = i.quantidade - 1
                WHERE c.id_cliente = {$_SESSION['id']}
                AND i.nome NOT IN ($ingredientesParaRemoverString);";

            $resultado_desconta_ingrediente = $conn->query($sql_descontaigrediente);
        
            header("location: confirmacao.php");
        } else {
            echo "Erro ao fazer pedido do lanche: " . $conn->error;
        }
    }
}
}
    $conn->close();
    

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pisco Coast - Fazer Pedido</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Carrinho</h1>
    </header>
    <form method="post" action="fazer_pedido.php" enctype="multipart/form-data">
    <?php if(isset($carrinho)) : ?>
    <?php foreach($carrinho as $cart) : ?>
            <img src="<?php echo $cart['imagem']?>" alt="">
            <p class="food-desc"><?php echo $cart['nome'] ?></p>
            <p class=""><?php echo $cart['descricao']?></p>
            <div class="caixa-ingrediente">
            <p>Ingredientes:</p>
            <ul>
                <?php foreach($cart['ingredientes'] as $ingrediente) : ?>
                    <li>
                        <input type="checkbox" name="ingredientes_para_remover[]" value="<?php echo $ingrediente; ?>">
                        <?php echo $ingrediente; ?>
                    </li>
                <?php endforeach ?>
            </ul>
            </div>
            <a href="delete.php?id_produto=<?php echo $cart['id_produto']; ?>"><img src="uploads/54324.png" alt="" width="20px"></a>
        <?php endforeach ?>
        <?php 
        $conn = new mysqli("localhost","root","","lanchonete"); 
 
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
        $conn->close();
        ?>
        

       <p>Valor Total: R$<?php echo $somacarrinho["soma"]; ?></p>
       <?php endif ?>
       <label for="pagamento">Forma de Pagamento:</label>
<select name="pagamento" id="pagamento" required>
    <option value="dinheiro">Dinheiro</option>
    <option value="PIX">PIX</option>
</select><br>
<label for="">Troco (se necessario):</label>

<input type="text" name="troco" id="troco" placeholder="R$ 0,00">
<div id="chavePixField" style="display: none;">
    <label for="chavePix">Chave PIX:</label>
    <p>04432430001</p>
    <label for="">Comprovante Pix:</label>
    <input type="file" name="comprovantePix" id="imagem">

    
</div>

<input type="submit" name="remover_ingredientes" value="Remover Ingredientes">

        <input type="submit" name="enviar_pedido" value="Enviar Pedido">
        <a href="index.php">Voltar Para o Cardapio</a>
    </form>
    <footer>
    </footer>
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

</body>
</html>
