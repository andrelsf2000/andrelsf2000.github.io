<?php
// Verificar se o usuário está autenticado
session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    // Se não autenticado, redirecionar para a página de login
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "bddweb";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para obter as opções da coluna "servico"
$query_servicos = "SELECT servico, descricao FROM dweb3";
$result_servicos = $conn->query($query_servicos);

// Fechar a conexão
$conn->close();

// Adicionar uma opção padrão para a descrição
$descricao_padrao = "Selecione um serviço";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Serviços</title>
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
    <?php require_once 'header.php'; ?>  
    
    <main class="container mt-4">
        <section>
            <h2>Serviços</h2>

            <!-- Formulário -->
            <form action="processa_servicos.php" method="post">
                <!-- Campo do formulário para selecionar o serviço -->
                <div class="form-group">
                    <label for="nome_servico">Nome do Serviço</label>
                    <select class="form-control" id="nome_servico" name="nome_servico" required>
                        <!-- Adicionar a opção padrão -->
                        <option value="" disabled selected><?php echo $descricao_padrao; ?></option>
                        
                        <!-- Preencher o menu suspenso com opções do banco de dados -->
                        <?php while ($row = $result_servicos->fetch_assoc()): ?>
                            <option value="<?php echo $row['servico']; ?>" data-descricao="<?php echo $row['descricao']; ?>"><?php echo $row['servico']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Campo do formulário para exibir a descrição -->
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" readonly><?php echo $descricao_padrao; ?></textarea>
                </div>

                <!-- Outros campos e botões conforme necessário -->

                <!-- Botão para enviar o formulário -->
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Selecionar</button>
                </div>
            </form>
        </section>
    </main>
    
    <?php include_once 'footer.php'; ?>

    <!-- Script para atualizar a descrição ao selecionar uma opção -->
    <script>
        // Função para atualizar a descrição ao selecionar uma opção
        $(document).ready(function () {
            $('#nome_servico').change(function () {
                // Obter o valor selecionado
                var selectedOption = $(this).val();

                // Obter a descrição associada à opção selecionada
                var descricao = $('option:selected', this).data('descricao');

                // Atualizar o campo de descrição com a descrição correspondente
                $('#descricao').val(descricao || "<?php echo $descricao_padrao; ?>");
            });
        });
    </script>
</body>
</html>