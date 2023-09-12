<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");
    if(!isset($_SESSION['id']) && ($_SESSION['id'] != 1)){
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
            header("location: cadastrar_ingrediente.php");
        } else {
            echo "Erro ao cadastrar o lanche: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
    if(isset($_POST['voltar'])){
        header("location: index.php");
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pisco Coast - Cadastro de Lanches</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            font-size: 24px;
        }

        form {
            max-width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="button"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        
        input[type="button"]:hover {
            background-color: #0056b3;
        }

        @media (min-width: 768px) {
            /* Estilos para tablets e desktops */
            h1 {
                font-size: 28px;
            }

            form {
                max-width: 600px;
            }
        }
    </style>
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
        <a href="index.php"><input type="button" value="Voltar" name="voltar"></a>
    </form>
</body>
</html>
