<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = trim($_POST["password"]); // Remover espaços em branco

    // Consulta para obter as credenciais do usuário
    $sql = "SELECT * FROM dweb WHERE email = ? LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Adiciona mensagem de depuração
        echo "Usuário encontrado.<br>";
        echo "Senha digitada: " . $password . "<br>";
        echo "Senha do banco (hash): " . $user['senha'] . "<br>";

        // Verifica se o hash da senha digitada corresponde ao hash no banco de dados
        if (password_verify($password, $user['senha'])) {
            // As credenciais são válidas
            session_start();
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['email'] = $user['email'];
            header("Location: servicos.php");
            // Adiciona mensagem de depuração
            echo "Usuário autenticado. Redirecionando para servicos.php...";
        } else {
            // Senha incorreta
            echo "Senha incorreta.<br>";
        }
    } else {
        // Usuário não encontrado
        echo "Usuário não encontrado.<br>";
    }
}
?>