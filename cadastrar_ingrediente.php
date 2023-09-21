<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");
    if(!isset($_SESSION['id']) && ($_SESSION['id'] != 1)){
        header("location: login.php");
}
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];

    $sql = "INSERT INTO ingredientes (nome, quantidade) VALUES ('$nome', $quantidade)";
    $resultado = $conn->query($sql);

    if ($resultado) {
        header("location: lanche_ingrediente.php");
    } else {
        echo "Erro ao cadastrar o ingrediente: " . $conn->error;
    }

    $conn->close();
    if (isset($_POST['voltar'])){
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pisco Coast - Cadastro de Ingredientes</title>
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

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <h1>Cadastro de Ingredientes</h1>
    </header>
    <form method="post" action="" autocomplete="off">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required><br>
        <input type="submit" value="Cadastrar"><br>
        <input type="button" value="Voltar" name="voltar">
    </form>
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