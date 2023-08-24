<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];

    $query = "INSERT INTO produtos (nome, descricao, preco, estoque) VALUES ('$nome', '$descricao', '$preco', '$estoque')";
    if ($conn->query($query) === TRUE) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o produto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <form method="post">
        Nome: <input type="text" name="nome"><br>
        Descrição: <textarea name="descricao"></textarea><br>
        Preço: <input type="text" name="preco"><br>
        Estoque: <input type="text" name="estoque"><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

<?php
$conn->close();
?>
