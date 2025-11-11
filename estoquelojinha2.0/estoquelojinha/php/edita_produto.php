<?php
require_once("conexao.php");
if (isset($_GET['id_produto']) && is_numeric($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];
    
    $sql = "SELECT id_produto, nome_produto, categoria_produto, descricao_produto, fornecedor_produto, valor_produto, unidadeDeMedida_produto, quantidade, url_foto_produto FROM produto WHERE id_produto = ?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        $conexao->close();
        die("Produto não encontrado."); 
    }
    $stmt->close();
}
$conexao->close(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
  <link rel="stylesheet" href="../css/adicionarProduto.css">
  <link rel="stylesheet" href="../css/cabecalho.css">
</head>
<body>
    <header>
      <div class="logo">lojinha</div>
        <ul>
          <li><a href="../php/index.php" >PRINCIPAL</a></li>
          <li><a href="../php/dashboard.php">DASHBOARD</a></li>
          <li><a href="adicionarProduto.html">ADICIONAR PRODUTOS</a></li>
          <li><a href="../php/editar_produto.php" class="active">EDITAR PRODUTOS</a></li>
          <li>ADMINISTRADOR</li>
        </ul>
    </header>
    <div class="left">
        <h2>Editar Produto</h2>
        <img src="<?php echo $produto['url_foto_produto']; ?>" alt="Foto Atual" style="max-width: 150px;"> <br>
        <form action="salvarAlteracoesProduto.php" method="POST" >
        <input type="hidden" name="id_produto" value=<?php echo $produto['id_produto']; ?>>
        <input type="text" placeholder="Nome do produto" name="nome_produto" value="<?php echo $produto['nome_produto']; ?>">
        <input type="text" placeholder="Categoria" name="categoria_produto" value="<?php echo $produto['categoria_produto']; ?>">
        <input type="text" placeholder="Descrição" name="descricao_produto" value="<?php echo $produto['descricao_produto']; ?>">
        <input type="text" placeholder="Fornecedor" name="fornecedor_produto" value="<?php echo $produto['fornecedor_produto']; ?>">
        <input type="number" placeholder="Valor (R$)" name="valor_produto" value="<?php echo $produto['valor_produto']; ?>">
        <input type="text" placeholder="Unidade de medida" name="unidadeDeMedida_produto" value="<?php echo $produto['unidadeDeMedida_produto']; ?>">
        <input type="number"placeholder="Quantidade" name="quantidade" value="<?php echo $produto['quantidade']; ?>">
        <input type="text" placeholder="URL da foto do produto" name="url_foto_produto" value="<?php echo $produto['url_foto_produto']; ?>">
        <button type="submit">Salvar Alterações</button>
    </form>
    </div>
</body>
</html>