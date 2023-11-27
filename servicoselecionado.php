<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <title>Serviço Selecionado</title>
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
            <h2>Serviço Selecionado</h2>
            
            <div class="form-group">
                <p>Agradecemos por escolher a Fitness e Exercícios! Para realizar a sua matrícula, compareça a uma de nossas unidades.</p>
            </div>
        </section>
    </main>
    
    <?php include_once 'footer.php'; ?>
</body>
</html>