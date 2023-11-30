<?php
$imagens1 = [
    "Imagem/fitness-and-health-5711488.jpg",
    "Imagem/pexels-anastasia-shuraeva-4944978.jpg",
    "Imagem/pexels-eduardo-romero-1886487.jpg",
    "Imagem/pexels-jonathan-borba-13896072.jpg",
    "Imagem/pexels-koolshooters-8544788.jpg",
    "Imagem/pexels-li-sun-2475875.jpg",
    "Imagem/pexels-pavel-danilyuk-8860988.jpg",
    "Imagem/pexels-yan-krukau-8436640.jpg",
];

    $imagens2 = [
    "Imagem/carl-barcelo-hHzzdVQnkn0-unsplash.jpg",
    "Imagem/john-arano-h4i9G-de7Po-unsplash.jpg",
    "Imagem/pexels-ketut-subiyanto-5037407.jpg",
    "Imagem/pexels-nathan-cowley-2413552.jpg",
    "Imagem/pexels-tima-miroshnichenko-5327507.jpg",
    "Imagem/pexels-william-choquette-1954524.jpg",
    "Imagem/jonathan-borba-lrQPTQs7nQQ-unsplash.jpg",
    "Imagem/bruce-mars-tj27cwu86Wk-unsplash.jpg",
];

shuffle($imagens1);
shuffle($imagens2);

$primeiraFileira = array_slice($imagens1, 0, count($imagens1) / 2);
$terceiraFileira = array_slice($imagens1, count($imagens1) / 2);

$segundaFileira = array_slice($imagens2, 0, count($imagens2) / 2);
$quartaFileira = array_slice($imagens2, count($imagens2) / 2);

shuffle($primeiraFileira);
shuffle($segundaFileira);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Fitness e Exercícios</title>
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
            <h2>Dicas de Exercícios</h2>
            <p class="text-justify">Aqui estão alguns exemplos de exercícios para manter-se saudável.</p>
            
            <div class="row">
                <?php foreach ($primeiraFileira as $imagem1): ?>
                    <div class="col-md-3 mb-4">
                        <img src="<?php echo $imagem1; ?>" alt="Exercício" class="img-fluid">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <?php foreach ($segundaFileira as $imagem2): ?>
                    <div class="col-md-3 mb-4">
                        <img src="<?php echo $imagem2; ?>" alt="Exercício" class="img-fluid">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <?php foreach ($terceiraFileira as $imagem1): ?>
                    <div class="col-md-3 mb-4">
                        <img src="<?php echo $imagem1; ?>" alt="Exercício" class="img-fluid">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <?php foreach ($quartaFileira as $imagem2): ?>
                    <div class="col-md-3 mb-4">
                        <img src="<?php echo $imagem2; ?>" alt="Exercício" class="img-fluid">
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    
    <?php include_once 'footer.php'; ?>
</body>
</html>