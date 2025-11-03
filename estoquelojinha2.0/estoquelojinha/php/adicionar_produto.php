<?php
include("conexao.php");
require_once '../php/verificar_sessao.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome       = $_POST['nome_produto'];
    $categoria  = $_POST['categoria_produto'];
    $descricao  = $_POST['descricao_produto'];
    $fornecedor = $_POST['fornecedor_produto'];
    $valor      = $_POST['valor_produto'];
    $unidade    = $_POST['unidadeDeMedida_produto'];
    $quantidade = $_POST['quantidade'];
    $url_foto_produto        = $_POST['url'];

    $sql = "INSERT INTO produto 
            (nome_produto, categoria_produto, descricao_produto, fornecedor_produto, valor_produto, unidadeDeMedida_produto, quantidade, url_foto_produto)
            VALUES ('$nome', '$categoria', '$descricao', '$fornecedor', $valor, '$unidade', $quantidade, '$url_foto_produto')";

    if (mysqli_query($conexao, $sql)) {
        echo "Produto cadastrado com sucesso!";
        header("Location: ../php/index.php");
    } else {
        echo "Erro ao inserir: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?> 