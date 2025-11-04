<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pedidos</title>
  <link rel="stylesheet" href="../css/cabecalho.css">
  <link rel="stylesheet" href="../css/carrinho.css">
</head>
<body>
  <header>
    <div class="logo">lojinha</div>
    <ul>
      <li><a href="../php/index.php">PRINCIPAL</a></li>
      <li><a href="../php/carrinho.php" >CARRINHO</a></li>
      <li><a href="../php/pedido_pedido.php"class="active"></a>PEDIDO</li>
    </ul>
  </header>

  <main class="carrinho-container">
    <section class="itens-carrinho">

      <?php if (!empty($_SESSION['carrinho'])): ?>
        <?php

        foreach ($_SESSION['carrinho'] as $nome => $produto):
          $nome_produto       = htmlspecialchars($produto['nome_produto'] ?? '');
          $valor_produto      = floatval($produto['valor_produto'] ?? 0);
          $quantidade         = intval($produto['quantidade'] ?? 1);
          $endereco_cliente   = htmlspecialchars($produto['endereco'] ?? '');
          
          $subtotal = $valor_produto * $quantidade;
          $totalGeral += $subtotal;
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
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

    <?php if (!empty($_SESSION['pedido'])): ?>
    <aside class="resumo">
      <h3>Endereço de entrega</h3>
      <div class="linha">
        <span> Endereço: <?= $endereco_cliente?></span>
      </div>
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

      <a href=" " class="botao-continuar">Efetuar compra</a>
    </aside>
    <?php endif; ?>
  </main>
</body>
</html>
