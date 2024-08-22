<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de configuração do banco de dados
include 'config.php';

// Inicializar variáveis para mensagens de erro
$error = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter as credenciais do formulário
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Preparar a consulta SQL
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário existe
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificar a senha
        if (password_verify($password, $user['password'])) {
            // Iniciar a sessão do usuário
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Fechar a declaração e a conexão com o banco de dados
            $stmt->close();
            $conn->close();

            // Redirecionar para a página principal
            header('Location: painel.php');
            exit;
        } else {
            // Senha incorreta
            $error = "Nome de usuário ou senha incorretos.";
        }
    } else {
        // Usuário não encontrado
        $error = "Nome de usuário ou senha incorretos.";
    }

    // Fechar a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="image-section"></div>
        <div class="login-section">
            <h2>Login</h2>
            <?php if (!empty($error)) : ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="submit" value="Entrar">
            </form>
        </div>
    </div>
</body>
</html>
