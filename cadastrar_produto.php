<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");
    if(($_SESSION['id']) != 1){
        header("location: login.php");
}

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $tipo = $_POST["tipo"];

    $uploadDir = "uploads/";
    $nomeArquivo = uniqid() . "_" . $_FILES["imagem"]["name"];
    $caminhoArquivo = $uploadDir . $nomeArquivo;

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
        
        $sql = "INSERT INTO produtos (nome, tipo, preco, descricao, imagem) VALUES ('$nome', '$tipo', $preco, '$descricao', '$caminhoArquivo')";
        $resultado = $conn->query($sql);

        if ($resultado) {
            echo "Lanche cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o lanche: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pisco Coast - Cadastro de Lanches</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Lanches</h1>
    </header>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo" required>
            <option value="lanche">Lanche</option>
            <option value="bebida">Bebida</option>
        </select><br>
        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" accept="image/*" required><br>
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
