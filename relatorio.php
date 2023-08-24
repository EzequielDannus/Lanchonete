<?php
include("config.php");


$query = "SELECT MONTH(data_pedido) AS mes, YEAR(data_pedido) AS ano, SUM(valor_total) AS total_vendas FROM pedidos WHERE status = 'entregue' GROUP BY YEAR(data_pedido), MONTH(data_pedido)";
$result = $conn->query($query);
$relatorio_vendas = [];
while ($row = $result->fetch_assoc()) {
    $relatorio_vendas[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Relatórios</title>
</head>
<body>
    <h1>Relatórios</h1>
    <h2>Vendas Mensais</h2>
    <table border="1">
        <tr>
            <th>Mês</th>
            <th>Ano</th>
            <th>Total de Vendas</th>
        </tr>
        <?php foreach ($relatorio_vendas as $relatorio) { ?>
            <tr>
                <td><?php echo $relatorio["mes"]; ?></td>
                <td><?php echo $relatorio["ano"]; ?></td>
                <td>R$ <?php echo $relatorio["total_vendas"]; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
