<?php
require_once "../php/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_cliente     = $_POST['nome'];
    $cpf_cliente      = $_POST['cpf'];
    $email_cliente    = $_POST['email'];
    $senha_cliente    = $_POST['senha']; 
    $numero_cliente   = $_POST['celular'];
    $endereco_cliente = $_POST['endereco'];

    $senha_hash = password_hash($senha_cliente, PASSWORD_DEFAULT);

    //para evitar sql injection
    $sql = "INSERT INTO cliente 
              (nome_cliente, cpf_cliente, email_cliente, senha_cliente, numero_cliente, endereco_cliente) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        header("Location: ../html/cadastro.html?erro=prepare");
        $conexao->close();
        exit;
    }

    //define que todos são strings "ssssss"
    $stmt->bind_param("ssssss", 
        $nome_cliente, 
        $cpf_cliente, 
        $email_cliente, 
        $senha_hash, 
        $numero_cliente, 
        $endereco_cliente
    );

    if ($stmt->execute()) {
        //se der certo, mostra mensagem de sucesso na index
        header("Location: ../php/index.php?sucesso=cadastro");
        $stmt->close();   
        $conexao->close();
        exit; // Encerra o script
    } else {

        //verifica se os dados já não existem no banco
        if ($conexao->errno == 1062) {
            header("Location: ../html/cadastro.html?erro=duplicado");
        } else {
            header("Location: ../html/cadastro.html?erro=inesperado");
        }
        $stmt->close();  
        $conexao->close(); 
        exit; 
    }
}
?>