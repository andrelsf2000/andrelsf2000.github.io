<?php
require_once 'config.php';

// Inclua o código para conectar ao banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=bddweb', 'root', '');

// Inclua lógica para obter os dados do usuário a partir do banco de dados
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userData = []; // Inicializa $userData como um array vazio

if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
    $email = $_SESSION['email'];
    $sql = "SELECT usuario, email, telefone, senha FROM dweb WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Se o usuário não estiver autenticado, redirecione para a página de login
    header("Location: login.php");
    exit();
}

// Lógica para atualizar os dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definindo os novos valores como os valores atuais do usuário
    $newEmail = $userData['email'];
    $newPhone = $userData['telefone'];
    $newPassword = $userData['senha'];

    // Atualiza os valores se os campos foram preenchidos
    if (isset($_POST["newEmail"]) && !empty($_POST["newEmail"])) {
        $newEmail = $_POST["newEmail"];
    }

    if (isset($_POST["newPhone"]) && !empty($_POST["newPhone"])) {
        $newPhone = $_POST["newPhone"];
    }

    if (isset($_POST["newPassword"]) && !empty($_POST["newPassword"])) {
        // Verifica se as senhas são idênticas, apenas se uma nova senha for fornecida
        $newPassword = $_POST["newPassword"];
        $repeatPassword = $_POST["repeatPassword"];

        if ($newPassword !== $repeatPassword) {
            // Informa o usuário sobre senhas não coincidentes
            echo "A nova senha não confere, tente novamente!";
            exit(); // Encerra o script se as senhas não coincidirem
        }

        // Hash da nova senha
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    // Atualiza os dados no banco de dados
    $updateSql = "UPDATE dweb SET email = ?, telefone = ?, senha = ? WHERE email = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([$newEmail, $newPhone, $newPassword, $email]);

    // Redireciona para a página de sucesso após a atualização bem-sucedida
    header("Location: atualizacao_sucesso.php");
    exit(); // Certifique-se de que não há código após o redirecionamento
}
?>