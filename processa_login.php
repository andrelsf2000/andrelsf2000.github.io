<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM dweb WHERE email = ? LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
         echo "Usuário encontrado.<br>";
        echo "Senha digitada: " . $password . "<br>";
        echo "Senha do banco (hash): " . $user['senha'] . "<br>";

        if (password_verify($password, $user['senha'])) {
            session_start();
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['email'] = $user['email'];
            header("Location: servicos.php");
            echo "Usuário autenticado. Redirecionando para servicos.php...";
        } else {
            echo "Senha incorreta.<br>";
        }
    } else {
        echo "Usuário não encontrado.<br>";
    }
}
?>