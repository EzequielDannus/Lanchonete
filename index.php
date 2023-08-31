<?php 
include("includes/db.php");
$sql = "SELECT * FROM produtos";
$resultado = $conn->query($sql);
$produtos = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pisco-Coast</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao PiscoCoast</h1>
    </header>
    <nav>
        <h2>Lanches</h2>
        <ul>
            <?php foreach($produtos as $produto) :?>
                <?php if($produto['tipo']=="lanche") : ?>
                <a href="fazer_pedido.php?produto_id=<?php echo $produto['id']; ?>">
                    <div class="box">
                    <img src="<?php echo $produto['imagem']?>" alt="Imagem do Produto">
                        <p><?php echo $produto['nome'];?></p>
                        <p><?php echo $produto['descricao']?></p>
                        <p>R$ <?php echo $produto['preco']?></p>
                    </div>
                </a>
                <?php endif?>
            <?php endforeach ?>
        </ul>
        <h2>Bebidas</h2>
        <ul>
            <?php foreach($produtos as $produts) : ?>
            <?php if($produts['tipo']=="bebida") : ?>
                <a href="fazer_pedido.php?produto_id=<?php echo $produts['id']; ?>">
                    <div class="box">
                    <img src="<?php echo $produts['imagem']?>" alt="Imagem do Produto">
                        <p><?php echo $produts['nome'];?></p>
                        <p><?php echo $produts['descricao']?></p>
                        <p>R$ <?php echo $produts['preco']?></p>
                    </div>
                </a>
            <?php endif ?>
            <?php endforeach ?>
        </ul>
    </nav>
    <footer>
        <p>&copy; 2023 Pisco-Coast. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
