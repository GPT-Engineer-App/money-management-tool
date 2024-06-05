<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$query = "SELECT * FROM transacao WHERE tipo='Débito'";
$result = mysqli_query($conn, $query);
$gastos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Gastos</h1>
        <canvas id="gastosChart"></canvas>
        <ul>
            <?php foreach ($gastos as $gasto): ?>
                <li><?php echo $gasto['descricao'] . ' - ' . $gasto['valor'] . ' - ' . $gasto['data'] . ' - ' . $gasto['categoria_nome']; ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="add_gasto.php">Adicionar Gasto</a>
    </div>
    <script>
        const ctx = document.getElementById('gastosChart').getContext('2d');
        const gastosChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($gastos as $gasto) { echo "'" . $gasto['data'] . "',"; } ?>],
                datasets: [{
                    label: 'Gastos',
                    data: [<?php foreach ($gastos as $gasto) { echo $gasto['valor'] . ","; } ?>],
                    borderColor: 'rgba(255, 99, 132, 1)',
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