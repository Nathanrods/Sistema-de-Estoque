<?php
// Incluir o arquivo de configuração do banco de dados
include 'config.php';

// Inicializar variáveis para mensagens de erro e sucesso
$error = "";
$success = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário e sanitizar
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // Validar se os campos não estão vazios
    if (empty($username) || empty($password) || empty($email)) {
        $error = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "O e-mail fornecido é inválido.";
    } else {
        // Criptografar a senha
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Processar o upload da imagem
        $image_data = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_size = $_FILES['image']['size'];
            $image_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            // Verificar o tamanho do arquivo (máximo de 1 MB)
            if ($image_size > 1 * 1024 * 1024) {
                $error = "A imagem deve ter no máximo 1 MB.";
            } elseif (!in_array($image_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $error = "Formato de imagem não suportado. Use JPG, JPEG, PNG ou GIF.";
            } else {
                // Ler o conteúdo da imagem
                $image_data = file_get_contents($image_tmp_name);
            }
        }

        // Preparar a consulta SQL para evitar SQL Injection
        $sql = "INSERT INTO usuarios (username, password, email, image) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $username, $hashed_password, $email, $image_data);

            // Executar a consulta
            if ($stmt->execute()) {
                // Mensagem de sucesso
                $success = "Usuário registrado com sucesso!";
                // Fechar a declaração
                $stmt->close();
                // Fechar a conexão com o banco de dados
                $conn->close();
                // Redirecionar após o sucesso
                header('Location: login.php');
                exit;
            } else {
                // Mensagem de erro detalhada
                $error = "Erro ao registrar o usuário: " . $stmt->error;
            }
        } else {
            // Mensagem de erro detalhada
            $error = "Erro na preparação da consulta: " . $conn->error;
        }
    }

    // Fechar a conexão com o banco de dados se não tiver redirecionado ainda
    if (!$success) {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Registrar</title>
</head>
<body>
    <div class="container">
        <div class="register-section">
            <h2>Registrar</h2>
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php elseif (!empty($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="file" name="image" accept="image/*">
                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>
</body>
</html>
