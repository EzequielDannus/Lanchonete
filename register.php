<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql_check_email = "SELECT * FROM clientes WHERE email = '$email'";
    $resultado_check_email = $conn->query($sql_check_email);

    if ($resultado_check_email->num_rows > 0) {
        
        echo "Este e-mail já está registrado. Por favor, escolha outro e-mail.";
    } else {
        $sql_register = "INSERT INTO clientes (nome, cpf, endereco, email, senha) VALUES ('$nome', '$cpf', '$endereco', '$email', '$senha')";

        $resultado = $conn->query($sql_register);

        if ($resultado) {
            echo "Registro realizado com sucesso!";
            header("location: login.php");
        } else {
            echo "Erro ao registrar: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pisco Coast - Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Pisco Coast</h1>
            <h1>Registre-se</h1>
        </header>
        <form method="post" action="register.php" style="font-weight: bold;">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>
            <label for="cpf">CPF:</label>
            <input type="number" id="numero" name="cpf" oninput="limitarCaracteres(this, 11)"><br>
            <label for="endereco">Endereço:</label>
            <input name="endereco" require></input><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br>
            <input type="submit" value="Registrar">
            <p style="color: white; font-weight: bold;">Já tem uma conta? <a href="login.php">Faça login aqui</a></p>

        </form>


    </div>
</body>
<meta name="viewport" content="width=device-width, initial-scale=1">

</html>

<style>
    body {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        background-image: url(./uploads/Wallpaper.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        background-color: grey;
        background-color: rgba(10, 23, 55, 0.4);
        padding: 1rem;
        border-radius: 10px;
        height: 42vh;
    }

    a {

        color: white;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4rem;
        font-family: sans-serif;
        font-size: 1rem;
        font-style: normal;

    }

    label {
        color: white;
    }

    input {
        border-radius: 7px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        background-color: grey;
        background-color: rgba(10, 23, 55, 0.4);
        padding: 2rem;
        border-radius: 10px;
        height: 45vh;
    }

    @media (max-width: 576px) {
        form {
            width: 70vw;
            height: 50vh;
            flex-shrink: 0;
        }
    }
</style>
<script>
    function limitarCaracteres(elemento, maxCaracteres) {
      if (elemento.value.length > maxCaracteres) {
        elemento.value = elemento.value.slice(0, maxCaracteres);
      }
    }
  </script>