<?php
session_start();

if (isset($_GET['nome']) && isset($_SESSION['carrinho'][$_GET['nome']])) {
    unset($_SESSION['carrinho'][$_GET['nome']]);
}

header("Location: carrinho.php");
exit;
?>
