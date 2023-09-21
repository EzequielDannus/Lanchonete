<?php
    include "includes/db.php";
    var_dump($_SESSION["id"]);
    if (isset($_SESSION["id"])) {
            $userId = $_SESSION["id"];
            $sqlEnd = "SELECT endereco FROM clientes WHERE id = $userId";
            $result = $conn->query($sqlEnd);
            if (isset($result)) {
                $row = $result->fetch_assoc();
                $endereco = $row["endereco"];
                echo "<label for=''>Endereço:</label>";
                echo "<textarea name='endereco' required>{$endereco}</textarea><br>";
            }
        } else {
            echo "<textarea name='endereco' required></textarea><br>";
        }
        ?>