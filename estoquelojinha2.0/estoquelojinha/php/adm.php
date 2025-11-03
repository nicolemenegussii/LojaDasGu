<?php
session_start(); 
require '../php/conexao.php';

$user = $_POST['user'];
$senha_digitada = $_POST['senha'];
$sql = "SELECT * FROM administradores WHERE usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 1) {
    
    $admin = $result->fetch_assoc();
    $senha_hash_do_banco = $admin['senha'];

    if (password_verify($senha_digitada, $senha_hash_do_banco)) {
        
        // SUCESSO!
        // 5. (PROBLEMA 3 CORRIGIDO) Salva os dados na sessão
        $_SESSION['login'] = 'ok'; 
        $_SESSION['id_admin'] = $admin['id_admin']; 
        $_SESSION['ultimo_acesso'] = time(); 
        
        header("Location: ../php/dashboard.php");
        
        $stmt->close();
        $conexao->close();
        exit; 

    } else {
        header("Location: ../html/adm.html?erro=1");
        $stmt->close();
        $conexao->close();
        exit;
    }

} else {
    header("Location: ../html/adm.html?erro=1");
    $conexao->close();
    exit;
}
?>