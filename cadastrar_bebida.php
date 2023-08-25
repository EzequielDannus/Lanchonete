<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];

    // Processar a inserção no banco de dados
    $sql = "INSERT INTO produtos (nome, tipo, preco) VALUES ('$nome', 'bebida', $preco)";
    $resultado = $conn->query($sql);

    if ($resultado) {
        echo "Bebida cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar a bebida: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Cadastro de Bebidas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Bebidas</h1>
    </header>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br>
        <!-- Outros campos de cadastro específicos para bebidas -->
        <input type="submit" value="Cadastrar">
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
