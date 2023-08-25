<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];

    // Processar a inserção no banco de dados
    $sql = "INSERT INTO produtos (nome, tipo, preco, descricao) VALUES ('$nome', 'lanche', $preco, '$descricao')";
    $resultado = $conn->query($sql);

    if ($resultado) {
        echo "Lanche cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o lanche: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Cadastro de Lanches</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Lanches</h1>
    </header>
    <form method="post" action="">
        <!-- Campos de cadastro aqui -->
        <input type="submit" value="Cadastrar">
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
