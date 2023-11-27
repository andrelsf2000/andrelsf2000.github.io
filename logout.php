<?php
// Inicie a sessão (se ainda não estiver iniciada)
session_start();

// Encerre a sessão
session_destroy();

// Redirecione para a página index.php
header("Location: index.php");
exit();
?>