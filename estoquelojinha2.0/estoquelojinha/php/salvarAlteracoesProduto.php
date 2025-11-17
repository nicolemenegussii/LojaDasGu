<?php
include("conexao.php");
require_once '../php/verificar_sessao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto =  $_POST['id_produto'];
    if (empty($id_produto)) {
        die("Erro, id vazio cabecudo!");
    }
    
    $nome       = $_POST['nome_produto'];
    $categoria  = $_POST['categoria_produto'];
    $descricao  = $_POST['descricao_produto'];
    $fornecedor = $_POST['fornecedor_produto'];
    $valor      = $_POST['valor_produto'];
    $quantidade = $_POST['quantidade']; 
    $unidade    = $_POST['unidadeDeMedida_produto'];
    $url_foto_produto = $_POST['url_foto_produto'];

    $sql = "UPDATE produto SET nome_produto = ?, categoria_produto = ?, descricao_produto = ?, fornecedor_produto = ?, valor_produto = ?, unidadeDeMedida_produto = ?, quantidade = ?, url_foto_produto = ? WHERE id_produto = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssssi", $nome, $categoria, $descricao, $fornecedor, $valor, $unidade, $quantidade, $url_foto_produto, $id_produto);

    if ($stmt->execute()) {
        header("Location: ../php/editar_produto.php");
        exit();
    } else {
        echo "Erro ao tentar alyerar:" . $stmt->error;
    }
    $stmt->close();

}

$conexao->close();
?>