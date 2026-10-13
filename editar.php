<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: listar.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $sexo = $_POST['sexo'];
    $quantidade = $_POST['quantidade'];
    

    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, sexo = ?, quantidade = ? WHERE id = ?");
    $stmt->execute([$nome, $descricao, $sexo, $quantidade, $id]);

    header("Location: listar.php");
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2>Editar Produto</h2>
        <form method="post">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea>
            
            <label for="sexo">Sexo:</label>
            <textarea id="sexo" name="sexo"><?= htmlspecialchars($produto['sexo']) ?></textarea>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>

            <p><strong>Obs:</strong> A imagem não pode ser alterada nesta tela.</p>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>