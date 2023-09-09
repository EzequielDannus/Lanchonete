<?php
include("includes/db.php");
if(!isset($_SESSION['id'])){
    header("location: login.php");
}

if (isset($_GET['adicionar_carrinho'])) {
    $produto_id = $_GET['id'];


    $sqlcarrinho = "INSERT INTO carrinho (id_cliente, id_produto) VALUES ({$_SESSION['id']}, $produto_id)";
    $resultado = $conn->query($sqlcarrinho);

}

$sql = "SELECT * FROM produtos";
$resultado = $conn->query($sql);

$produtos = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pisco-Coast</title>
</head>

<body>
    <form action="index.php" method="get">
        <header>
            <div class="titles">
                <div class="maintitle">
                    <?php if($_SESSION['id'] != 1) : ?>
                    <a href="fazer_pedido.php">Cart</a>
                    <?php endif ?>
                    <h1>Bem-vindo ao PiscoCoast</h1>
                    <a class="logout" href="logout.php">logout</a>
                </div>
            </div>

                    <?php if($_SESSION['id'] != 1) : ?>
            <div class="title">
                <h2>Lanches</h2>
            </div>
        </header>
        <nav>
            <ul class="box">
                <?php foreach ($produtos as $produto) : ?>
                    <?php if ($produto['tipo'] == "lanche") : ?>
                        <div class="food-container">
                            <img src="<?php echo $produto['imagem'] ?>" alt="Imagem do Produto">
                            <div class="description">
                                <p class="food-title"><?php echo $produto['nome']; ?></p>
                                <p class="food-desc"><?php echo $produto['descricao'] ?></p>
                                <div class="cartdiv">
                                    <p class="food-price">R$ <?php echo $produto['preco'] ?></p>
                                    <a class="cart" href="index.php?id=<?php echo $produto['id'];?>&adicionar_carrinho=ok">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="division"></div>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
            <div class="title">
                <h2>Bebidas</h2>
            </div>
            <ul class="box">
                <?php foreach ($produtos as $produts) : ?>
                    <?php if ($produts['tipo'] == "bebida") : ?>
                        <div class="food-container">
                            <img src="<?php echo $produts['imagem'] ?>" alt="Imagem do Produto">
                            <div class="description">
                                <p class="food-title"><?php echo $produts['nome']; ?></p>
                                <p class="food-desc"><?php echo $produts['descricao'] ?></p>
                                <div class="cartdiv">
                                    <p class="food-price">R$ <?php echo $produts['preco'] ?></p>
                                    <a class="cart" href="index.php?id=<?php echo $produts['id'];?>&adicionar_carrinho=ok">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="division"></div>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </nav>
        <?php endif ?>
        <?php if($_SESSION['id'] == 1 ) : ?>
            <div class="adm">
            <nav>
                    <ul>
                        <li>
                            <a href="cadastrar_produto.php">Cadastrar Produto</a>
                        </li>
                        <li>
                            <a href="cadastrar_ingrediente.php">Cadastrar Ingrediente</a>
                        </li>
                        <li>
                            <a href="pedido.php">Pedidos</a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php endif ?>

    </form>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .adm {
    text-align: center; 
    flex-direction: column;
}

.adm nav ul {
    list-style: none;
    padding: 0;
    flex-direction: column;
}

.adm nav ul li {
    display: inline;
    margin-right: 20px;
    flex-direction: column;
}

.adm nav ul li:last-child {
    margin-right: 0;
    flex-direction: column;
}

.adm nav ul li a {
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: #007bff;
    flex-direction: column;
}

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-image: url(./uploads/bg.png);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .cartdiv {
        display: flex;
        flex-direction: row;
        width: 50vw;

    }

    html {
        width: 100vw;
    }

    .cart {
        height: 5.5rem;
        width: 5rem;

        background: none;
        border-radius: 1rem;
    }

    svg {
        color: green;
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
        width: 30vw;
        height: 20rem;
        border-radius: 1rem;

    }

    .maintitle {
        display: flex;
        align-items: center;
        justify-content: space-around;


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