<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Cadastro</title>
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
        $(document).ready(function() {
            $('#telefone').on('input', function () {
                var telefone = $(this).val().replace(/\s/g, '');
        
                telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');

                $(this).val(telefone);
            });

            $('#senha, #repetir_senha').on('keyup', function () {
                if ($('#senha').val() == $('#repetir_senha').val()) {
                    $('#senha, #repetir_senha').css('border-color', 'green');
                } else {
                    $('#senha, #repetir_senha').css('border-color', 'red');
                }
            });
        });
    </script>
</head>
<body>
<?php require_once 'header.php';?>

    <main class="container mt-4">
        <section>
            <h2>Cadastro</h2>

            <form action="processa_cadastro.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Insira um e-mail válido" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}" title="Insira um telefone válido" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" pattern=".{5,12}" title="A senha deve ter entre 5 e 12 caracteres" required>
                </div>
                <div class="form-group">
                    <label for="repetir_senha">Repetir Senha</label>
                    <input type="password" class="form-control" id="repetir_senha" name="repetir_senha" required>
                </div>
                <div class="form-group mt-2 btn-group">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </section>
    </main>
        
    <?php include_once 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>
</html>