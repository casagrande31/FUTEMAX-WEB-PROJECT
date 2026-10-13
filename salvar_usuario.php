<?php
require 'db.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    
    if ($senha !== $confirma_senha) {
        
        header("Location: registrar.php?erro=senha");
        exit();
    }

    
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    if ($stmt->fetch()) {
        
        header("Location: registrar.php?erro=usuario_existe");
        exit();
    }

    
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    if ($stmt->execute([$usuario, $senhaHash])) {
        
        header("Location: index.php?sucesso=1");
        exit();
    } else {
        echo "Ocorreu um erro ao cadastrar o usuário.";
    }
}
?>