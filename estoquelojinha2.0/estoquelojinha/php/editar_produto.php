<?php
require_once("conexao.php");

$sql = "SELECT id_produto, nome_produto, categoria_produto, descricao_produto, fornecedor_produto, valor_produto, unidadeDeMedida_produto, quantidade, url_foto_produto FROM produto";
$result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lojinha</title>
  <link rel="stylesheet" href="../css/cabecalho.css">
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <header>
    <div class="logo">lojinha</div>
    <ul>
      <li><a href="../php/index.php" class="active">PRINCIPAL</a></li>
      <li><a href="../php/carrinho.php">CARRINHO</a></li>
      
      <li><a href="../html/login.html">LOG IN</a></li>
    </ul>
  </header>
  <main class="produtos-container">
    <h2>Produtos Disponíveis</h2>
    <div class="produtos">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="produto">
            <form action="edita_produto.php" method="GET">
              <input type="hidden" name="id_produto" value="' . $row['id_produto'] . '">
              <div class="divImagemCard">
              <img src="' . $row['url_foto_produto'] . '" alt="' . $row['nome_produto'] . '">
              </div>
              <h3>' . $row['nome_produto'] . '</h3>
              <p>' . $row['categoria_produto'] . '</p>
              <button type="submit">Editar Produto</button>
            </form>
          </div> ';
        }
      } else {
        echo "<p>Nenhum produto encontrado.</p>";
      }

      $conexao->close();
      ?>
    </div>
  </main>
</body>
</html>