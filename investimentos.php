<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

// Supondo que você tenha uma tabela de investimentos
$query = "SELECT * FROM investimentos";
$result = mysqli_query($conn, $query);
$investimentos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investimentos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Investimentos</h1>
        <canvas id="investimentosChart"></canvas>
        <ul>
            <?php foreach ($investimentos as $investimento): ?>
                <li><?php echo $investimento['nome'] . ' - ' . $investimento['valor_atual'] . ' - ' . $investimento['retorno']; ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="add_investimento.php">Adicionar Investimento</a>
    </div>
    <script>
        const ctx = document.getElementById('investimentosChart').getContext('2d');
        const investimentosChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($investimentos as $investimento) { echo "'" . $investimento['nome'] . "',"; } ?>],
                datasets: [{
                    label: 'Investimentos',
                    data: [<?php foreach ($investimentos as $investimento) { echo $investimento['valor_atual'] . ","; } ?>],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>