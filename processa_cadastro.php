<?php
require_once 'config.php';

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    // Hash da senha antes de armazenar no banco de dados (recomendado para segurança)
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a instrução SQL para inserir os dados na tabela
    $sql = "INSERT INTO dweb (usuario, email, telefone, senha) VALUES (?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $pdo->prepare($sql);

    // Executa a declaração SQL com os parâmetros
    $stmt->execute([$nome, $email, $telefone, $senha_hash]);

    // Redireciona para uma página de sucesso ou outra página desejada
    header("Location: cadastro_sucesso.php");
    exit(); // Encerra o script após o redirecionamento
} else {
    // Se o formulário não foi enviado, redirecione para a página de erro
    header("Location: cadastro.php?erro=1");
    exit(); // Encerra o script após o redirecionamento
}
?>