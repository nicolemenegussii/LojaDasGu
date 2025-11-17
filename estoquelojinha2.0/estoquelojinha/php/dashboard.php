
<?php
require("conexao.php");
require_once '../php/verificar_sessao.php'; 

$sqlJoin = "SELECT p.id_pedido, p.data_pedido, c.nome_cliente 
            FROM cliente c 
            JOIN pedido p ON c.id_cliente = p.id_cliente";
$resJoin = $conexao->query($sqlJoin);

$sqlCount = "SELECT COUNT(*) AS total_produtos FROM produto";
$totalProdutos = $conexao->query($sqlCount)->fetch_assoc()['total_produtos'];

$sqlMaxMin = "SELECT MAX(valor_produto) AS produto_mais_caro, MIN(valor_produto) AS produto_mais_barato FROM produto";
$precos = $conexao->query($sqlMaxMin)->fetch_assoc();

$sqlMedia = "SELECT AVG(valor_produto) AS media FROM produto";
$media = $conexao->query($sqlMedia)->fetch_assoc()['media'];

$sqlGroup = "SELECT e.id_expedicao, COUNT(p.id_pedido) AS total_pedidos
             FROM expedicao e
             JOIN pedido p ON e.id_expedicao = p.id_expedicao
             GROUP BY e.id_expedicao";
$resGroup = $conexao->query($sqlGroup);

$sqlHaving = "SELECT e.id_expedicao, COUNT(p.id_pedido) AS total_pedidos
              FROM expedicao e
              JOIN pedido p ON e.id_expedicao = p.id_expedicao
              GROUP BY e.id_expedicao
              HAVING COUNT(p.id_pedido) > 5";
$resHaving = $conexao->query($sqlHaving);

$sqlView = "SELECT nome_produto, categoria_produto FROM produto";
$resView = $conexao->query($sqlView);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="../css/dashboard.css">
<link rel="stylesheet" href="../css/cabecalho.css">
</head>
<body>
    <header>
      <div class="logo">lojinha</div>
        <ul>
          <li><a href="../html/dashboard.html" class="active">DASHBOARD</a></li>
          <li><a href="../html/adicionarProduto.html">ADICIONAR PRODUTO</a></li>
<<<<<<< HEAD
          <li><a href="../php/sair.php"><img src="../php/sair.png"></a></li>
=======
          <li><a href="../php/editar_produto.php">EDITAR PRODUTO</a></li>
          <li><a href="../html/adicionarProduto.html">EXCLUIR PRODUTO</a></li>
          <li><a href="../php/sair.php">SAIR</a></li>
>>>>>>> 8f6670a00befe760479f4c644a37d854dae6676d
          <li>ADMINISTRADOR</li>
        </ul>
    </header>
    <h1>Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h2>Total de Produtos</h2>
            <p><?php echo $totalProdutos; ?></p>
        </div>
        <div class="card">
            <h2>Produto Mais Caro</h2>
            <p>R$ <?php echo number_format($precos['produto_mais_caro'], 2, ',', '.'); ?></p>
        </div>
        <div class="card">
            <h2>Produto Mais Barato</h2>
            <p>R$ <?php echo number_format($precos['produto_mais_barato'], 2, ',', '.'); ?></p>
        </div>
        <div class="card">
            <h2>Preço Médio</h2>
            <p>R$ <?php echo number_format($media, 2, ',', '.'); ?></p>
        </div>
    </div>

    <!-- JOIN -->
    <table>
        <tr><th>ID Pedido</th><th>Data</th><th>Cliente</th></tr>
        <?php while($row = $resJoin->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_pedido']; ?></td>
                <td><?php echo $row['data_pedido']; ?></td>
                <td><?php echo $row['nome_cliente']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- VIEW -->
    <h2>Produtos (VIEW)</h2>
    <table>
        <tr><th>Nome</th><th>Categoria</th></tr>
        <?php while($row = $resView->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['nome_produto']; ?></td>
                <td><?php echo $row['categoria_produto']; ?></td>
            </tr>
        <?php } ?>
    </table> 

    <!-- GROUP BY -->
    <canvas id="graficoExpedicao"></canvas>
    <script>
        const ctx1 = document.getElementById('graficoExpedicao');
        const labelsExpedicao = [<?php
            $labels = [];
            $valores = [];
            mysqli_data_seek($resGroup, 0);
            while($row = $resGroup->fetch_assoc()) {
                $labels[] = "'Expedição " . $row['id_expedicao'] . "'";
                $valores[] = $row['total_pedidos'];
            }
            echo implode(", ", $labels);
        ?>];
        const dataExpedicao = [<?php echo implode(", ", $valores); ?>];

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labelsExpedicao,
                datasets: [{
                    label: 'Pedidos por Expedição',
                    data: dataExpedicao,
                    backgroundColor: 'rgba(75,192,192,0.4)',
                    borderColor: 'rgba(75,192,192,1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>

    <!-- HAVING -->
    <table>
        <tr><th>ID Expedição</th><th>Total de Pedidos</th></tr>
        <?php while($row = $resHaving->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_expedicao']; ?></td>
                <td><?php echo $row['total_pedidos']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
