<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $sexo = $_POST['sexo'];
    $quantidade = $_POST['quantidade'];
    $imagem_nome = '';

    // Pega o ID do usuário que está logado na sessão
    $id_usuario_logado = $_SESSION['usuario_id'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta_upload = 'uploads/';
        $imagem_nome = uniqid() . '_' . basename($_FILES['imagem']['name']);
        $caminho_imagem = $pasta_upload . $imagem_nome;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
    }

    // A query INSERT agora inclui a coluna id_usuario e o valor correto
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao,  sexo, quantidade, imagem, id_usuario) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $sexo, $quantidade,  $imagem_nome, $id_usuario_logado]);

    header("Location: listar.php");
    exit();
}
?>