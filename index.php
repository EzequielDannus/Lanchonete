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
    <form action="index.php" method="get">
        <header>
            <div class="titles">
                <div class="maintitle">
                    <h1>Bem-vindo ao PiscoCoast</h1>
                </div>
                <div class="title">
                    <h2>Lanches</h2>
                </div>
            </div>

        </header>
        <nav>
            </div>
            <ul class="box">
                <?php foreach ($produtos as $produto) : ?>
                    <?php if ($produto['tipo'] == "lanche") : ?>    

                        <?php
                        if(!isset($_SESSION['id'])){
                            echo "<a href=login.php>";
                        }
                         else{
                         echo "<a href=fazer_pedido.php?produto_id=<?php {$produto['id']}";
                         } ?>
                        <div class="food-container">
                            <img src="<?php echo $produto['imagem'] ?>" alt="Imagem do Produto">
                            <div class="description">
                                <p class="food-title"><?php echo $produto['nome']; ?></p>
                                <p class="food-desc"><?php echo $produto['descricao'] ?></p>
                                <p class="food-price">R$ <?php echo $produto['preco'] ?></p>
                            </div>
                        </div>
                        <div class="division"></div>
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
            <div class="title">
                <h2>Bebidas</h2>
            </div>

            <ul class="box">
                <?php foreach ($produtos as $produts) : ?>
                    <?php if ($produts['tipo'] == "bebida") : ?>
                        <a href="fazer_pedido.php?produto_id=<?php echo $produto['id'];?>">
                        <div class="food-container">
                            <img src="<?php echo $produts['imagem'] ?>" alt="Imagem do Produto">
                            <div class="description">
                                <p class="food-title"><?php echo $produts['nome']; ?></p>
                                <p class="food-desc"><?php echo $produts['descricao'] ?></p>
                                <p class="food-price">R$ <?php echo $produts['preco'] ?></p>
                            </div>
                        </div>
                        <div class="division"></div>
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </nav>


    </form>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-image: url(./uploads/bg.png);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .food-container {
        display: flex;

        align-items: center;
        gap: 4rem;

    }

    .description {
        display: flex;
        flex-direction: column;
        gap: 1rem;

    }

    .box {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 0.8rem;

    }

    .division {
        background-color: grey;
        height: 0.1rem;
        margin: 1rem;
        padding: 0rem !important;
        width: 100vw;


    }

    p {
        width: 60vw;
        font-size: 2rem;
        text-decoration: none;
        color: white;
    }

    img {
        width: 20rem;
        height: 20rem;
        border-radius: 1rem;

    }

    .maintitle {
        display: flex;
        align-items: center;
        justify-content: center;

    }

    h1 {
        color: whitesmoke;
        padding: 0.2rem;
        border-radius: 0.5rem;
    }

    .title {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
    }

    h2 {
        background-color: whitesmoke;
        padding: 0.2rem;
        border-radius: 0.5rem;
        font-weight: bold;
    }

    .titles {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .food-title {
        font-size: 2.5rem;
        font-weight: bold;

    }

    .food-desc {
        font-size: 1.7rem;
    }

    .food-price {
        font-size: 3rem;
    }
</style>

</html>