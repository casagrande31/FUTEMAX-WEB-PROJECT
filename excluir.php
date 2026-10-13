<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';
$id = $_GET['id'] ?? null;
if ($id) {
   
    $stmt = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch();
    if ($produto && !empty($produto['imagem'])) {
        $caminho_imagem = 'uploads/' . $produto['imagem'];
        if (file_exists($caminho_imagem)) {
            unlink($caminho_imagem); 
        }
    }

    
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: listar.php");
exit();
?>