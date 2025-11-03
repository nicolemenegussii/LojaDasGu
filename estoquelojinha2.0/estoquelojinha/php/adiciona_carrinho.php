<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_produto      = $_POST['nome_produto'] ?? '';
    $valor_produto     = $_POST['valor_produto'] ?? 0;
    $categoria_produto = $_POST['categoria_produto'] ?? '';
    $descricao_produto = $_POST['descricao_produto'] ?? '';
    $url_foto_produto  = $_POST['url_foto_produto'] ?? '';

    // cria o carrinho caso não exista
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // adiciona ou incrementa quantidade
    if (isset($_SESSION['carrinho'][$nome_produto])) {
        $_SESSION['carrinho'][$nome_produto]['quantidade']++;
    } else {
        $_SESSION['carrinho'][$nome_produto] = [
            'nome_produto'      => $nome_produto,
            'valor_produto'     => $valor_produto,
            'categoria_produto' => $categoria_produto,
            'descricao_produto' => $descricao_produto,
            'url_foto_produto'  => $url_foto_produto,
            'quantidade'        => 1
        ];
    }

    header("Location: ../php/index.php");
    exit;
}
?>
