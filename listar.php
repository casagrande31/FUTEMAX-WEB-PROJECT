<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';

// Pega o ID do usuário da sessão para o filtro (FUNCIONALIDADE CORRETA)
$id_usuario_logado = $_SESSION['usuario_id'];
$filtro_nome = isset($_GET['filtro_nome']) ? $_GET['filtro_nome'] : '';

// Prepara a query SQL que busca APENAS os produtos do usuário logado (FUNCIONALIDADE CORRETA)
$sql = "SELECT * FROM produtos WHERE id_usuario = ?";
$params = [$id_usuario_logado];

// Adiciona o filtro por nome se ele for usado (FUNCIONALIDADE CORRETA)
if (!empty($filtro_nome)) {
    $sql .= " AND nome LIKE ?";
    $params[] = '%' . $filtro_nome . '%';
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Camisetas</title>
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
        <h2>Camisetas Cadastradas</h2>

        <form method="get" class="filtro-form">
            <input type="text" name="filtro_nome" placeholder="Filtrar por nome..." value="<?= htmlspecialchars($filtro_nome) ?>">
            <button type="submit">Filtrar</button>
        </form>

        <table class="tabela-listagem">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Sexo</th>
                    <th>Qtd.</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($produtos) > 0): ?>
                    <?php foreach ($produtos as $produto): ?>
                       
                <?php
                    $desc = $produto['descricao'];
                     if (mb_strlen($desc, 'UTF-8') > 50) {
                    $preview = mb_substr($desc, 0, 50, 'UTF-8') . ' ...';
                     } else {
                    $preview = $desc;
                    }
                ?>
                       
                        <tr>
                            <td><img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem do produto" width="80"></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= htmlspecialchars($preview) ?></td>
                            <td><?= htmlspecialchars($produto['sexo']) ?></td>
                            <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $produto['id'] ?>" class="btn-editar">Editar</a>
                                <a href="excluir.php?id=<?= $produto['id'] ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja chutar essa camisa?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>