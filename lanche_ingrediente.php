<?php
include("includes/db.php");

if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit; 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_lanche = $_POST['id_lanche'];

    $ingredientes_selecionados = $_POST['ingredientes_selecionados'];

    foreach ($ingredientes_selecionados as $id_ingrediente) {

        $sql_insert = "INSERT INTO lanche_ingredientes (id_lanche, id_ingrediente) VALUES ($id_lanche, $id_ingrediente)";
        $resultado_insert = $conn->query($sql_insert);
        
        if (!$resultado_insert) {
            echo "Erro ao adicionar ingrediente ao lanche: " . $conn->error;
            exit;
        }
    }
    
}

// Consulta todos os lanches disponíveis
$sql_lanches = "SELECT * FROM produtos";
$resultado_lanches = $conn->query($sql_lanches);
$lanches = $resultado_lanches->fetch_all(MYSQLI_ASSOC);

// Consulta todos os ingredientes disponíveis
$sql_ingredientes = "SELECT * FROM ingredientes";
$resultado_ingredientes = $conn->query($sql_ingredientes);
$ingredientes = $resultado_ingredientes->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Ingredientes ao Lanche</title>
</head>
<body>
    <h1>Adicionar Ingredientes ao Lanche</h1>
    
    <form method="post" action="" autocomplete="off">
        <label for="id_lanche">Selecione um Lanche:</label>
        <select name="id_lanche" required>
            <?php foreach ($lanches as $lanche) : ?>
                <option value="<?php echo $lanche['id']; ?>"><?php echo $lanche['nome']; ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <label for="ingredientes_selecionados[]">Selecione Ingredientes:</label>
        <select name="ingredientes_selecionados[]" multiple required>
            <?php foreach ($ingredientes as $ingrediente) : ?>
                <option value="<?php echo $ingrediente['id']; ?>"><?php echo $ingrediente['nome']; ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <input type="submit" value="Adicionar Ingredientes">
    </form>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
        }

        form {
            max-width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select[multiple] {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 20px auto;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (min-width: 768px) {
            /* Estilos para tablets e desktops */
            h1 {
                font-size: 28px;
            }

            form {
                max-width: 600px;
            }
        }
    </style>