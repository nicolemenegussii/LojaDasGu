<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carrinho de Compras</title>
  <link rel="stylesheet" href="../css/cabecalho.css">
  <link rel="stylesheet" href="../css/carrinho.css">
</head>
<body>
  <header>
    <div class="logo">lojinha</div>
    <ul>
      <li><a href="../php/index.php">PRINCIPAL</a></li>
      <li><a href="../php/carrinho.php" class="active">CARRINHO</a></li>
      <li><a href="../html/login.html">LOG IN</a></li>
    </ul>
  </header>

  <main class="carrinho-container">
    <section class="itens-carrinho">
      <h2>Carrinho de Compras</h2>

      <?php if (!empty($_SESSION['carrinho'])): ?>
        <?php
        $totalGeral = 0;

        foreach ($_SESSION['carrinho'] as $nome => $produto):
          $nome_produto       = htmlspecialchars($produto['nome_produto'] ?? '');
          $categoria_produto  = htmlspecialchars($produto['categoria_produto'] ?? '');
          $url_foto_produto   = htmlspecialchars($produto['url_foto_produto'] ?? '');
          $valor_produto      = floatval($produto['valor_produto'] ?? 0);
          $quantidade         = intval($produto['quantidade'] ?? 1);
          
          $subtotal = $valor_produto * $quantidade;
          $totalGeral += $subtotal;
        ?>
        <div class="item">
          <div class="foto">
            <img src="<?= $url_foto_produto ?>" alt="<?= $nome_produto ?>">
          </div>

          <div class="detalhes">
            <h3><?= $nome_produto ?></h3>
            <p class="categoria"><?= $categoria_produto ?></p>

            <div class="quantidade-container">
              <span>Qtd:</span>
              <span class="quantidade"><?= $quantidade ?></span>
            </div>

            <a href="remover_item_carrinho.php ?nome=<?= urlencode($nome) ?>" class="remover">Remover</a>
          </div>

          <div class="preco">
            <p class="valor">R$ <?= number_format($valor_produto, 2, ',', '.') ?></p>
            <p class="subtotal">Subtotal: <strong>R$ <?= number_format($subtotal, 2, ',', '.') ?></strong></p>
          </div>
        </div>
        <?php endforeach; ?>

      <?php else: ?>
        <p class="vazio">Seu carrinho está vazio.</p>
        <div style="text-align:center;">
          <a href="index.php" class="botao-voltar">Voltar à loja</a>
        </div>
      <?php endif; ?>
    </section>

    <?php if (!empty($_SESSION['carrinho'])): ?>
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

      <a href="../php/pedido_pedido.php" class="botao-continuar">Finalizar compra</a>
      <a href="" class="botao-continuar">Continuar comprando</a>
    </aside>
    <?php endif; ?>
  </main>
</body>
</html>
