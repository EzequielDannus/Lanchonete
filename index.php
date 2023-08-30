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
    <form action="" method="get">
    <header>
        <h1>Bem-vindo ao PiscoCoast</h1>
    </header>
    <nav>
        <h2>Lanches</h2>
        <ul>
            <?php
            foreach($produtos as $produto) :
            ?>

            <?php endforeach ?>
        </ul>
    </nav>
    <footer>
        <p>&copy; 2023 PiscoCoast. Todos os direitos reservados.</p>
    </footer>
    </form>
</body>
</html>
