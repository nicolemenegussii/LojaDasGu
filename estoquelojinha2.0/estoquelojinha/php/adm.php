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
    
    if (password_verify($senha_digitada, $admin['senha'])) {
        $_SESSION['login'] = 'ok'; 
        $_SESSION['id_admin'] = $admin['id'];
        $_SESSION['usuario'] = $admin['usuario'];
        
        header("Location: ../php/dashboard.php");
    } else {
        //senha errada
        header("Location: ../html/adm.html?erro=1");
    }
} else {
    //usuário não existe
    header("Location: ../html/adm.html?erro=1");
}

$stmt->close();
$conexao->close();
exit;
?>