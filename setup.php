<?php
try {
    // Conectar ao SQLite. Se o arquivo não existir, ele será criado.
    $pdo = new PDO('sqlite:database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão com o banco de dados SQLite estabelecida com sucesso.<br>";

    // Criar a tabela de usuários (está correta)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario TEXT NOT NULL UNIQUE,
            senha TEXT NOT NULL
        )
    ");
    echo "Tabela 'usuarios' criada ou já existente.<br>";

    // Criar a tabela de produtos com a nova coluna 'id_usuario'
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS produtos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            descricao TEXT,
            quantidade INTEGER,
            imagem TEXT,
            id_usuario INTEGER, -- ESTA LINHA ESTAVA FALTANDO
            FOREIGN KEY (id_usuario) REFERENCES usuarios(id) -- E ESTA TAMBÉM
        )
    ");
    echo "Tabela 'produtos' criada com a estrutura correta.<br>";

    // Inserir um usuário admin padrão, se não existir
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute(['admin']);
    if ($stmt->fetch() === false) {
        $senhaHash = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->exec("INSERT INTO usuarios (usuario, senha) VALUES ('admin', '$senhaHash')");
        echo "Usuário 'admin' com senha 'admin123' criado com sucesso.<br>";
    } else {
        echo "Usuário 'admin' já existe.<br>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>