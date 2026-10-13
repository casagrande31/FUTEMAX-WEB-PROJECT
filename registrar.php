<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="login-page">

  <div class="container-login">
        <h2>Criar Conta</h2>

        <?php if(isset($_GET['erro'])): ?>
            <?php if($_GET['erro'] == 'senha') { echo "<p class='erro'>As senhas não conferem.</p>"; } ?>
            <?php if($_GET['erro'] == 'usuario_existe') { echo "<p class='erro'>Este nome de usuário já está em uso.</p>"; } ?>
        <?php endif; ?>

        <form action="salvar_usuario.php" method="post">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Escolha um nome de usuário" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>

            <label for="confirma_senha">Confirme a Senha:</label>
            <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Digite a senha novamente" required>

            <button type="submit" class="button">Cadastrar</button>
        </form>
         <div class="link-cadastro">
            <p>Já tem uma conta? <a href="index.php">Faça o login</a></p>
        </div>
    </div>

</body>
</html>