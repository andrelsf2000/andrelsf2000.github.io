<?php
session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "bddweb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$query_servicos = "SELECT servico, descricao FROM dweb3";
$result_servicos = $conn->query($query_servicos);

$conn->close();

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

            <form action="processa_servicos.php" method="post">
                <div class="form-group">
                    <label for="nome_servico">Nome do Serviço</label>
                    <select class="form-control" id="nome_servico" name="nome_servico" required>
                        <option value="" disabled selected><?php echo $descricao_padrao; ?></option>
                        
                        <?php while ($row = $result_servicos->fetch_assoc()): ?>
                            <option value="<?php echo $row['servico']; ?>" data-descricao="<?php echo $row['descricao']; ?>"><?php echo $row['servico']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" readonly><?php echo $descricao_padrao; ?></textarea>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Selecionar</button>
                </div>
            </form>
        </section>
    </main>
    
    <?php include_once 'footer.php'; ?>

    <script>
        $(document).ready(function () {
            $('#nome_servico').change(function () {
                var selectedOption = $(this).val();

                var descricao = $('option:selected', this).data('descricao');

                $('#descricao').val(descricao || "<?php echo $descricao_padrao; ?>");
            });
        });
    </script>
</body>
</html>