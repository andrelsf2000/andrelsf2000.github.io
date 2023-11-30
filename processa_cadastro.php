<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO dweb (usuario, email, telefone, senha) VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$nome, $email, $telefone, $senha_hash]);

    header("Location: cadastro_sucesso.php");
    exit();
} else {
    header("Location: cadastro.php?erro=1");
    exit();
}
?>