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
    $categoria_nome = $_POST['categoria_nome'];
    $conta_id = '1234567890'; // Supondo que você tenha uma conta fixa

    $query = "INSERT INTO transacao (id, descricao, valor, data, tipo, conta_id, categoria_nome) VALUES (UUID(), '$descricao', '$valor', '$data', 'Débito', '$conta_id', '$categoria_nome')";
    if (mysqli_query($conn, $query)) {
        header('Location: gastos.php');
    } else {
        echo "Erro ao adicionar gasto!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Gasto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Gasto</h1>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" name="valor" placeholder="Valor" required>
            <input type="date" name="data" required>
            <input type="text" name="categoria_nome" placeholder="Categoria" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>