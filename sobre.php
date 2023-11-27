<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Sobre Mim</title>
    <style>
        /* Estilo para dispositivos mobiles */
        @media (max-width: 767px) {
            .text-justify {
                text-align: justify;
            }
        }
        /* Estilo para dispositivos desktops */
        @media (min-width: 768px) {
            .text-justify {
                text-align: justify;
            }
        }
    </style>
</head>
<body>
    <?php include_once 'header.php'; ?>
    
    <main class="container mt-4">
        <section>
            <h2>Sobre Mim</h2>
            <p class="text-justify">Eu sou André Ferreira. Sou um entusiasta do fitness e um defensor de um estilo de vida saudável. Aqui está uma foto minha após um treino:</p>
            
            <div class="text-center">
                <img src="Imagem/pexels-dreamlens-production-896059.jpg" alt="Minha Foto" style="max-width: 35%; height: auto;">
            </div>

            <p class="text-justify"><strong>Biografia:</strong></p>
            <p class="text-justify">Sou um entusiasta do fitness, apaixonado por atividades físicas e um defensor de um estilo de vida saudável. Ao longo dos anos, tenho explorado várias áreas do condicionamento físico e estou sempre em busca de desafios.</p>

            <p class="text-justify"><strong>Formação:</strong></p>
            <p class="text-justify">Completei meu bacharelado em Educação Física na Universidade de Saúde e Bem-Estar. Atualmente, estou cursando um mestrado em Ciências do Esporte, focando em nutrição esportiva e treinamento de força.</p>

            <p class="text-justify"><strong>Hobbies:</strong></p>
            <p class="text-justify">Fora da academia, tenho uma paixão por esportes ao ar livre, como trilhas e ciclismo. Também sou um ávido leitor e escritor de artigos relacionados à saúde e condicionamento físico.</p>
        </section>
    </main>
    
    <?php include_once 'footer.php'; ?>
</body>
</html>