<?php
include("conexao.php");

$resultado = mysqli_query($conexao, "SELECT * FROM pedido_mais_cliente");
echo "<h2>listar clientes com pedido</h2>"; 
while($linha = mysqli_fetch_assoc($resultado)){
    echo "nome: " . $linha['nome_cliente'];
}
?>