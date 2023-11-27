<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Login</title>
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
<?php require_once 'header.php';?>
    
    <main class="container mt-4">
        <section>
            <h2>Login</h2>

            <form action="processa_login.php" method="post">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <div class="form-group mr-2 btn-group"></div>
                    <a href="cadastro.php" class="btn btn-primary">Cadastrar</a>
                </div>
            </form>
        </section>
    </main>
        
    <?php include_once 'footer.php'; ?>
</body>
</html>