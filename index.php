<?php 
include("includes/db.php");
    $sql="SELECT * FROM produtos";
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
    <form action="index.php" method="get">
    <header>
        <h1>Bem-vindo ao PiscoCoast</h1>
    </header>
    <nav>
        <h2>Lanches</h2>
        <ul>
            <?php foreach($produtos as $produto) :?>
                <?php if($produto['tipo']=="lanche") : ?>
                <div class="box">
                    <p><?php echo $produto['nome'];?></p>
                </div>
                <?php endif?>
                <?php endforeach ?>
        </ul>
            <h2>Bebidas</h2>
            <ul>
            <?php foreach($produtos as $produts) : ?>
            <?php  if($produts['tipo']=="bebida") : ?>
                <div class="box">
                    <p><?php echo $produts['nome'];?></p>
                </div>
            <?php endif ?>
            <?php endforeach ?>
        </ul>
    </nav>
    <footer>
        <p>&copy; 2023 Pisco-Coast. Todos os direitos reservados.</p>
    </footer>
    </form>
</body>
</html>
