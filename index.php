<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="login-page">
  <div class="container-login">
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="seu_estilo.css">
</head>
<body class="login-page">
  <div class="container-login">
        <h2>Login</h2>

        <?php if(isset($_GET['erro'])) { echo "<p class='erro'>Usuário ou senha inválidos.</p>"; } ?>
        <?php if(isset($_GET['sucesso'])) { echo "<p class='sucesso'>Usuário cadastrado com sucesso! Faça o login.</p>"; } ?>

        <form action="login.php" method="post">
            <input type="text" id="usuario" name="usuario" placeholder="User" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <button type="submit" class="button">Entrar</button>
        </form>

        <div class="link-cadastro">
            <p>Não tem uma conta? <a href="registrar.php">Cadastre-se</a></p>
        </div>
  </div>
</body>
