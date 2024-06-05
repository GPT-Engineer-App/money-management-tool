<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$query = "SELECT * FROM transacao WHERE tipo='Crédito'";
$result = mysqli_query($conn, $query);
$economias = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Economias</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Economias</h1>
        <canvas id="economiasChart"></canvas>
        <ul>
            <?php foreach ($economias as $economia): ?>
                <li><?php echo $economia['descricao'] . ' - ' . $economia['valor'] . ' - ' . $economia['data']; ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="add_economia.php">Adicionar Economia</a>
    </div>
    <script>
        const ctx = document.getElementById('economiasChart').getContext('2d');
        const economiasChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($economias as $economia) { echo "'" . $economia['data'] . "',"; } ?>],
                datasets: [{
                    label: 'Economias',
                    data: [<?php foreach ($economias as $economia) { echo $economia['valor'] . ","; } ?>],
                    borderColor: 'rgba(54, 162, 235, 1)',
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