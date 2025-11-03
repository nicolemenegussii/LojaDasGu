<?php
session_start(); 

require '../php/conexao.php';
$user = $_POST['user'];
$senha_digitada = $_POST['senha']; // A senha que o usuário digitou

$sql = "SELECT * FROM cliente WHERE email_cliente = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o e-mail foi encontrado
if($result->num_rows === 1) {
    
    $cliente = $result->fetch_assoc();
    $senha_hash_do_banco = $cliente['senha_cliente']; // Pega o hash seguro do banco

    if (password_verify($senha_digitada, $senha_hash_do_banco)) {
        $_SESSION['id_cliente'] = $cliente['id_cliente'];
        $_SESSION['nome_cliente'] = $cliente['nome_cliente'];
        
        header("Location: ../php/index.php");
        $stmt->close();
        $conexao->close();
        exit;
        
    } else {
        // se o e-mail existe, mas a senha está errada
        header("Location: ../html/login.html?erro=1");
        $stmt->close();
        $conexao->close();
        exit; 
    }

} else {
    //se o e-mail não foi encontrado
    header("Location: ../html/login.html?erro=1");
    $conexao->close();
    exit; 
}
?>