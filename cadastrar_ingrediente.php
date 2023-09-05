<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");
    if(!isset($_SESSION['id']) != 1){
        header("location: login.php");
}
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];

    // Processar a inserção no banco de dados
    $sql = "INSERT INTO ingredientes (nome, quantidade) VALUES ('$nome', $quantidade)";
    $resultado = $conn->query($sql);

    if ($resultado) {
        echo "Ingrediente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o ingrediente: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pisco Coast - Cadastro de Ingredientes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Ingredientes</h1>
    </header>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="quantidade">Quantidade:</label>
        <input type="text" name="quantidade" required><br>
        <input type="submit" value="Cadastrar">
    </form>
    <footer>
    </footer>
    
</body>
</html>
<style>
    header {
        display: flex;
        justify-content: center;

    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input {
        width: 10rem;
    }

    textarea {
        width: 10rem;
    }

    select {
        width: 10rem;
    }

    body {
        margin: 1rem;
        padding: 0;
        box-sizing: border-box;
}
</style>