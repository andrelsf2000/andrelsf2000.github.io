<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
    $pdo = new PDO('mysql:host=localhost;dbname=bddweb', 'root', '');
    $email = $_SESSION['email'];
    $sql = "SELECT usuario FROM dweb WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $primeiroNome = isset($result['usuario']) ? explode(' ', $result['usuario'])[0] : '';

    $logoutButton = '<div class="dropdown">
                        <button class="btn btn-primary btn-circle font-weight-bold" onclick="toggleDropdown()" aria-haspopup="true" aria-expanded="false">
                            ' . strtoupper(substr($primeiroNome, 0, 1)) . '
                        </button>
                        <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
                            <a class="dropdown-item" href="meuCadastro.php">Meu Cadastro</a>
                            <a class="dropdown-item" href="logout.php">Sair</a>
                        </div>
                    </div>';
} else {
    $logoutButton = '';
}
?>

<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
    }

    window.onclick = function (event) {
        if (!event.target.matches('.btn-circle')) {
            var dropdowns = document.getElementsByClassName('dropdown-menu');
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }
</script>

<div class="bg-primary text-white text-center py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="Imagem/png-transparent-gym-logo-fitness-thumbnail.png" alt="Logotipo" style="max-width: 100px;">
            </div>
            <div class="col-md-6">
                <h1>Fitness e Exercícios</h1>
            </div>
            <div class="col-md-4">
                <nav class="d-inline-block">
                    <a href="index.php" class="text-white">Página Inicial</a> |
                    <a href="servicos.php" class="text-white">Serviços</a> |
                    <a href="sobre.php" class="text-white">Sobre</a> |
                    <a href="faleconosco.php" class="text-white">Fale Conosco</a>
                </nav>
                <div class="d-inline-block">
                    <?php echo $logoutButton; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-circle {
        border-radius: 50%;
        padding: 10px 15px;
        display: inline-block;
    }

    .font-weight-bold {
        font-weight: bold;
    }
</style>