<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $valor_atual = $_POST['valor_atual'];
    $retorno = $_POST['retorno'];

    $query = "INSERT INTO investimentos (id, nome, valor_atual, retorno) VALUES (UUID(), '$nome', '$valor_atual', '$retorno')";
    if (mysqli_query($conn, $query)) {
        header('Location: investimentos.php');
    } else {
        echo "Erro ao adicionar investimento!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Investimento</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Investimento</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="number" name="valor_atual" placeholder="Valor Atual" required>
            <input type="number" name="retorno" placeholder="Retorno" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>