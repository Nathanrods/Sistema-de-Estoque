<?php
// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar a sessão
session_start();

// Incluir o arquivo de configuração do banco de dados
include 'config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

// Obter o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

// Preparar a consulta SQL para obter a imagem do usuário
$sql = "SELECT image FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);

// Verificar se a preparação da consulta foi bem-sucedida
if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Associar o ID do usuário e executar a consulta
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se o usuário foi encontrado
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $image_data = $user['image'];

    if ($image_data) {
        // Definir o tipo de conteúdo da imagem
        header('Content-Type: image/jpeg'); // Alterar conforme o tipo de imagem
        echo $image_data;
    } else {
        // Imagem não encontrada, retornar uma imagem padrão
        header('Content-Type: image/jpeg');
        readfile('images/default.jpg');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}

$stmt->close();
$conn->close();
?>
