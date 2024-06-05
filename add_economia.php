<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $conta_id = '1234567890'; // Supondo que você tenha uma conta fixa

    $query = "INSERT INTO transacao (id, descricao, valor, data, tipo, conta_id) VALUES (UUID(), '$descricao', '$valor', '$data', 'Crédito', '$conta_id')";
    if (mysqli_query($conn, $query)) {
        header('Location: economias.php');
    } else {
        echo "Erro ao adicionar economia!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Economia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Economia</h1>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" name="valor" placeholder="Valor" required>
            <input type="date" name="data" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>