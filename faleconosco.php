<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    $pdo = new PDO('mysql:host=localhost;dbname=bddweb', 'root', '');

    $sql = "INSERT INTO dweb2 (nome, email, mensagem) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $mensagem]);

    if ($stmt->rowCount() > 0) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Por favor, tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Fale Conosco</title>
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
</head>
<body>
    <?php include_once 'header.php'; ?>  
    
    <main class="container mt-4">
        <section>
            <h2>Fale Conosco</h2>
            <div class="form-group">
                <div class="justify-text">
                    <p>Deixe sua mensagem, faça perguntas sobre fitness, peça conselhos de treino ou compartilhe suas próprias histórias de condicionamento físico.</p>
                </div>
            </div>
            
            <form method="post" action="faleconosco.php">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5" placeholder="Digite sua mensagem"></textarea>
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </section>
    </main>
    
    <?php include_once 'footer.php'; ?>
</body>
</html>