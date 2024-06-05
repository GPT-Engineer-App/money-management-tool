<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $query = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email'] = $email;
            header('Location: home.php');
        } else {
            echo "Login falhou!";
        }
    } elseif (isset($_POST['register'])) {
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $query = "INSERT INTO usuario (nomeCompleto, email, senha) VALUES ('$nomeCompleto', '$email', '$senha')";
        if (mysqli_query($conn, $query)) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="login">Login</button>
        </form>
        <h1>Cadastro</h1>
        <form method="POST">
            <input type="text" name="nomeCompleto" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="register">Cadastrar</button>
        </form>
    </div>
</body>
</html>