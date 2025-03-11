<?php
$servername = "82.25.77.221"; // Ou IP do banco de dados
$username = "joao";
$password = "mqfinCZGcE46X";
$dbname = "ativos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
echo "Conexão bem-sucedida!";
$conn->close();
?>