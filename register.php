<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (nome, cpf, endereco, email, senha) VALUES ('$nome', '$cpf', '$endereco', '$email', '$senha')";
    $resultado = $conn->query($sql);

    if ($resultado) {
        echo "Registro realizado com sucesso!";
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }

    header("location: login.php");

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Registro</h1>
    </header>
    <form method="post" action="register.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" required><br>
        <label for="endereco">Endereço:</label>
        <textarea name="endereco" required></textarea><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>
        <a href="login.php"><input type="submit" value="Registrar"></a>
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
