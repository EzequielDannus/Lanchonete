<?php

include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $email = mysqli_real_escape_string($conn, $email);
    $senha = mysqli_real_escape_string($conn, $senha);

    $sql = "SELECT * FROM clientes WHERE email = '$email'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        if (count($usuarios) == 0) {
            header("location: register.php");
            exit();
        } else {
            $hashSenhaArmazenada = $usuarios[0]['senha'];

            if (password_verify($senha, $hashSenhaArmazenada)) {
                $_SESSION['id'] = $usuarios[0]['id'];
                $_SESSION['endereco'] = $usuarios[0]['endereco'];
                header("location: index.php");
                exit();
            } else {
                echo "Senha incorreta.";
            }
        }
    } else {
        echo "Erro ao executar a consulta: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pisco Coast - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header style="display: flex; flex-direction: column; align-items: center;">
            <h1>Pisco Coast</h1>
            <h1>Login</h1>
        </header>
        <form method="post" action="login.php" autocomplete="off">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br>
            <input type="submit" value="Login">
            <p style="color: white; font-weight: bold;">Ainda não possui uma conta? <a href="register.php">Registre-se aqui!</a></p>
        </form>
    </div>

</body>
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

    p {
        line-height: 1.5rem;
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
        height: 20vh;
    }

    @media (max-width: 576px) {
        form {
            width: 70vw;
            height: 24vh;
            flex-shrink: 0;
        }



        input {
            height: 10rem;
        }


    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">

</html>