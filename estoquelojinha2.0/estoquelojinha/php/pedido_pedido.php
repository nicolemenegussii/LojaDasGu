<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pedidos</title>
  <link rel="stylesheet" href="../css/cabecalho.css">
</head>
<body>
  <header>
    <div class="logo">lojinha</div>
    <ul>
      <li><a href="../php/index.php">PRINCIPAL</a></li>
      <li><a href="../php/carrinho.php" >CARRINHO</a></li>
      <li><a href="../php/pedido_pedido.php" class="active">PEDIDO</a></li>
    </ul>
  </header>

  <main class="carrinho-container">
    <section class="itens-carrinho">

      <?php if (!empty($_SESSION['carrinho'])): ?>
        <?php
        $totalGeral = 0; // Garantir que a variável seja inicializada
        foreach ($_SESSION['carrinho'] as $nome => $produto):
          $nome_produto       = htmlspecialchars($produto['nome_produto'] ?? '');
          $valor_produto      = floatval($valor_produto['valor_produto'] ?? 0);
          $quantidade         = intval($quantidade['quantidade'] ?? 1);
          $endereco_cliente   = htmlspecialchars($endereco_cliente['endereco'] ?? '');
          $url_foto_produto   = htmlspecialchars($url_foto_produto['url_foto_produto'] ?? '');
          
          $subtotal = $valor_produto * $quantidade;
          $totalGeral += $subtotal;
          
          // Aqui seria necessário definir a URL da foto do produto (corrigido)
          $url_foto_produto = $produto['url_foto_produto'] ?? 'default-image.jpg'; // Exemplo de valor padrão
        ?>
        <div class="item">
          <div class="foto">
            <img src="<?= $url_foto_produto ?>" alt="<?= $nome_produto ?>">
          </div>

          <div class="detalhes">
            <h3><?= $nome_produto ?></h3>

            <div class="quantidade-container">
              <span>Qtd:</span>
              <span class="quantidade"><?= $quantidade ?></span>
            </div>

            <div class="preco">
              <p class="valor">R$ <?= number_format($valor_produto, 2, ',', '.') ?></p>
              <p class="subtotal">Subtotal: <strong>R$ <?= number_format($subtotal, 2, ',', '.') ?></strong></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

    <?php if (!empty($endereco_cliente)): ?>
    <aside class="resumo">
      <h3>Endereço de entrega</h3>
      <div class="linha">
        <span> Endereço: <?= $endereco_cliente ?></span>
      </div>
    </aside>
    <?php endif; ?>

    <?php if (!empty($_SESSION['pedido'])): ?>
    <aside class="resumo">
      <h3>Resumo do Pedido</h3>
      <div class="linha">
        <span>Subtotal:</span>
        <span>R$ <?= number_format($totalGeral, 2, ',', '.') ?></span>
      </div>

      <div class="total">
        <span>Total estimado:</span>
        <strong>R$ <?= number_format($totalGeral, 2, ',', '.') ?></strong>
      </div>

      <a href="../php/pedido_expedido.php" class="botao-continuar">Efetuar compra</a>
    </aside>
    <?php endif; ?>
  </main>
</body>
</html>
