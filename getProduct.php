<?php
// getProduct.php

header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$user = 'username';
$password = 'password';
$database = 'database';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebe o código de barras da requisição
$barcode = $_GET['barcode'];

// Prepara e executa a consulta
$sql = "SELECT nome FROM produtos WHERE codigo_barras = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $barcode);
$stmt->execute();
$stmt->bind_result($nome);
$stmt->fetch();

// Retorna o nome do produto ou mensagem de não encontrado
if ($nome) {
    echo json_encode(['name' => $nome]);
} else {
    echo json_encode(['name' => 'Produto não encontrado']);
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
