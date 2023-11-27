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
$updateSuccessMessage = ''; // Inicializa a mensagem de sucesso como uma string vazia

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

    // Define a mensagem de sucesso apenas se os dados foram realmente atualizados
    if ($updateStmt->rowCount() > 0) {
        // Redireciona para a página de sucesso após a atualização bem-sucedida
        header("Location: atualizacao_sucesso.php");
        exit(); // Certifique-se de que não há código após o redirecionamento
    }
}

// Lógica para exclusão do cadastro
if (isset($_POST["excluirCadastro"])) {
    // Apresenta uma mensagem de confirmação e um botão "Sim" e "Não"
    echo '
        <script>
            var confirmacao = confirm("Tem certeza de que deseja excluir seu cadastro?");
            if (confirmacao) {
                window.location.href = "meucadastro.php?excluir=true";
            } else {
                window.location.href = "meucadastro.php"; // Redireciona de volta à página original se cancelado
            }
        </script>
    ';
}

// Lógica para confirmar a exclusão
if (isset($_GET["excluir"]) && $_GET["excluir"] == "true") {
    // Exclua os dados do usuário do banco de dados
    $deleteSql = "DELETE FROM dweb WHERE email = ?";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->execute([$email]);

    // Limpe as variáveis de sessão
    session_unset();

    // Apresenta a mensagem de exclusão bem-sucedida e redireciona para a página inicial
    echo '
        <script>
            alert("Seus dados foram excluídos com sucesso!");
            window.location.href = "index.php";
        </script>
    ';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Meu Cadastro</title>
    <style>
        /* Estilo para dispositivos mobiles */
        @media (max-width: 767px) {
            .form-control {
                width: 100%;
            }
            .justify-text {
                width: 100%;
                text-align: justify;
            }
        }
        /* Estilo para dispositivos desktops */
        @media (min-width: 768px) {
            .form-control {
                width: 30%;
            }
            .justify-text {
                width: 30%;
                text-align: justify;
            }
        }

    </style>
    <script>
        // Adiciona a máscara de telefone
        $(document).ready(function() {
            $('#newPhone').mask('(00) 00000-0000');
            
            // Adiciona a validação de senha apenas se uma nova senha for fornecida
            $('#newPassword, #repeatPassword').on('keyup', function () {
                if ($('#newPassword').val() !== "") {
                    if ($('#newPassword').val() == $('#repeatPassword').val()) {
                        $('#newPassword, #repeatPassword').css('border-color', 'green');
                    } else {
                        $('#newPassword, #repeatPassword').css('border-color', 'red');
                    }
                }
            });
        });
    </script>
</head>
<body>
    <?php require_once 'header.php';?>
        
    <h1>Meu Cadastro</h1>

    <!-- Exiba a mensagem de sucesso se existir -->
    <?php if (!empty($updateSuccessMessage)) : ?>
        <p style="color: green;"><?php echo $updateSuccessMessage; ?></p>
    <?php endif; ?>
    
    <!-- Exiba os dados do usuário -->
    <p><strong>Nome:</strong> <?php echo $userData['usuario']; ?></p>
    <p><strong>E-mail:</strong> <?php echo $userData['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $userData['telefone']; ?></p>

    <!-- Formulário para alteração dos dados -->
    <form action="meucadastro.php" method="post">
        <label for="newEmail">Novo E-mail:</label>
        <input type="email" id="newEmail" name="newEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Insira um e-mail válido">

        <label for="newPhone">Novo Telefone:</label>
        <input type="text" id="newPhone" name="newPhone" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}" title="Insira um telefone válido">

        <label for="newPassword">Nova Senha:</label>
        <input type="password" id="newPassword" name="newPassword" pattern=".{5,12}" title="A senha deve ter entre 5 e 12 caracteres">

        <label for="repeatPassword">Repetir Nova Senha:</label>
        <input type="password" id="repeatPassword" name="repeatPassword">

        <button type="submit">Atualizar Cadastro</button>

        <br> <br> <!-- Adicione esta linha para criar uma quebra de linha -->
        
        <!-- Botão Excluir Cadastro -->
        <button type="submit" name="excluirCadastro" onclick="return confirm('Tem certeza de que deseja excluir seu cadastro?');">Excluir Cadastro</button>
    </form>

    <?php include_once 'footer.php'; ?>

    <!-- Adicione o plugin de máscara de telefone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>
</html>