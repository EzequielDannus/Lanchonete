<?php
include "includes/db.php"; 
if(!isset($_SESSION['id'])){
    header("location: login.php");
}
$sql = "SELECT nome, id_produto, SUM(vendas.quantidade) AS total_vendido
        FROM vendas
        JOIN produtos ON produtos.id = vendas.id_produto
        GROUP BY vendas.id_produto, produtos.nome
        ORDER BY total_vendido DESC";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $tabela = "<table border='1'>";
    while ($row = $resultado->fetch_object()) { 
        $tabela .= "<tr>"; 
        $tabela .= "<td>". $row -> nome ."</td>"; 
        $tabela .= "<td>". $row -> total_vendido ."</td>"; 
        $tabela .= "</tr>";
    }
    $tabela .= "</table>";
    echo $tabela; 
} else {
    echo "Nenhuma venda Registrada";
}


$conn->close();
?>
