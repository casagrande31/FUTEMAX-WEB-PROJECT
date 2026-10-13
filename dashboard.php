<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Cadastro de Produtos</title>
    <link rel="stylesheet" href="estilo.css">
    
    <style>
        body {
            display: block;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container">
        <h2>Cadastrar Novas Camisas</h2>
        
        <form action="adicionar.php" method="post" enctype="multipart/form-data">
            <label for="nome">Nome do Time:</label>
            <input type="text" id="nome" name="nome" placeholder="Corinthians, Barcelona..." required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" placeholder="Escreva aqui detalhes da camisa"></textarea>

             <label for="sexo">Sexo:</label>
            <textarea id="sexo" name="sexo" placeholder="Masculino/Feminino"></textarea>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" placeholder="1, 2, 3 ..." required>

            <label for="imagem">Imagem da Camisa:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>

            <button type="submit">Cadastrar Camisa</button>
        </form>
    </div>
</body>
</html>