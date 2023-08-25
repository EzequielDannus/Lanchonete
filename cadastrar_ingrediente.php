<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

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
    <title>LancheFácil - Cadastro de Ingredientes</title>
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
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
