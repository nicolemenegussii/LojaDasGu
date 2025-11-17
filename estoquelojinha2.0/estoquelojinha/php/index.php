<?php
require_once("conexao.php");

$sql = "SELECT nome_produto, categoria_produto, descricao_produto, valor_produto, url_foto_produto
        FROM produto";
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
      <li><a href="../html/cadastro.html">CADASTRO</a></li>
      <li><a href="../html/login.html">LOG IN</a></li>
    </ul>
  </header>

<?php
  if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'cadastro') {
      echo '<p class="sucesso-popup">Cliente cadastrado com sucesso!</p>';
  }
  
  ?>

  <main class="produtos-container">
    <h2>Produtos Disponíveis</h2>

    <div class="produtos">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="produto">
            <form action="adiciona_carrinho.php" method="POST" style="display: inline;">
              <input type="hidden" name="nome_produto" value="' . htmlspecialchars($row['nome_produto']) . '">
              <input type="hidden" name="valor_produto" value="' . $row['valor_produto'] . '">
              <input type="hidden" name="categoria_produto" value="' . htmlspecialchars($row['categoria_produto']) . '">
              <input type="hidden" name="descricao_produto" value="' . htmlspecialchars($row['descricao_produto']) . '">
              <input type="hidden" name="url_foto_produto" value="' . htmlspecialchars($row['url_foto_produto']) . '">
              
              <div class="divImagemCard">
                <img src="' . htmlspecialchars($row['url_foto_produto']) . '" alt="' . htmlspecialchars($row['nome_produto']) . '">
              </div>

              <h3>' . htmlspecialchars($row['nome_produto']) . '</h3>
              <p>' . htmlspecialchars($row['categoria_produto']) . '</p>
              <p class="preco">R$ ' . number_format($row['valor_produto'], 2, ',', '.') . '</p>

              <button type="submit">Adicionar ao Carrinho</button>
            </form>
          </div>
          ';
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