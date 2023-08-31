<?php
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $email = mysqli_real_escape_string($conn, $email); // Evita SQL Injection
    $senha = mysqli_real_escape_string($conn, $senha);

    $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        if (count($usuarios) == 0) {
            header("location: register.php");
            exit(); // Encerre o script para evitar mais processamento desnecessário
        } else {
            $_SESSION['id'] = $usuarios[0]['id'];
            header("location: index.php");
            exit(); // Encerre o script
        }
    } else {
        echo "Erro ao executar a consulta: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>
        <input type="submit" value="Login">
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body
