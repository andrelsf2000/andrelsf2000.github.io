<?php
require_once 'config.php';

$pdo = new PDO('mysql:host=localhost;dbname=bddweb', 'root', '');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userData = [];

if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
    $email = $_SESSION['email'];
    $sql = "SELECT usuario, email, telefone, senha FROM dweb WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $userData['email'];
    $newPhone = $userData['telefone'];
    $newPassword = $userData['senha'];

    if (isset($_POST["newEmail"]) && !empty($_POST["newEmail"])) {
        $newEmail = $_POST["newEmail"];
    }

    if (isset($_POST["newPhone"]) && !empty($_POST["newPhone"])) {
        $newPhone = $_POST["newPhone"];
    }

    if (isset($_POST["newPassword"]) && !empty($_POST["newPassword"])) {
        $newPassword = $_POST["newPassword"];
        $repeatPassword = $_POST["repeatPassword"];

        if ($newPassword !== $repeatPassword) {
            echo "A nova senha não confere, tente novamente!";
            exit();
        }

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    $updateSql = "UPDATE dweb SET email = ?, telefone = ?, senha = ? WHERE email = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([$newEmail, $newPhone, $newPassword, $email]);

    header("Location: atualizacao_sucesso.php");
    exit();
}
?>