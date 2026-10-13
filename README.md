# FUTEMAX GESTOR

Sistema web desenvolvido em **PHP** com banco de dados **SQLite** para gerenciamento de estoque de camisas de futebol.

## Funcionalidades

- Cadastro e login de usuários.
- Cadastro de camisas com nome do time, descrição, sexo, quantidade e imagem.
- Listagem do estoque com filtro por nome.
- Edição e exclusão de camisas.
- Cada cadastro de produto é associado ao usuário que o criou.
- Armazenamento das imagens na pasta `uploads/`.

## Tecnologias utilizadas

- PHP
- HTML e CSS
- SQLite
- PDO para conexão com o banco de dados

## Pré-requisitos

Escolha uma das opções abaixo:

- **PHP instalado localmente**, com as extensões `PDO` e `pdo_sqlite` habilitadas; ou
- **XAMPP**, que inclui PHP e também oferece ferramentas para administrar bancos de dados, como o MySQL/MariaDB pelo phpMyAdmin. Confira se a extensão `pdo_sqlite` está habilitada na configuração do PHP.

**Atenção:** este projeto utiliza **SQLite**, por meio do arquivo `database.sqlite`. Portanto, não é necessário iniciar o MySQL/MariaDB nem administrar o banco pelo phpMyAdmin para executar esta versão do sistema. O phpMyAdmin é útil para projetos que utilizam MySQL/MariaDB.

## Como executar no localhost

### Opção 1 — Usando o servidor embutido do PHP

1. Baixe ou clone este repositório.
2. Extraia os arquivos e abra o terminal na pasta do projeto (a pasta que contém `index.php`).
3. Verifique se o PHP está instalado:

   ```bash
   php -v
   ```

4. Inicie o servidor local:

   ```bash
   php -S localhost:8000
   ```

5. Abra no navegador:

   [http://localhost:8000](http://localhost:8000)

### Opção 2 — Usando XAMPP

1. Instale e abra o XAMPP.
2. Copie a pasta do projeto para `C:\xampp\htdocs\ED prog. web` (ou use um nome de pasta mais simples, como `futemax-gestor`).
3. Inicie o **Apache** pelo painel do XAMPP.
4. Acesse o endereço correspondente à pasta, por exemplo:

   `http://localhost/futemax-gestor/`

## Banco de dados

O projeto usa **SQLite**, um banco de dados local armazenado em arquivo. O arquivo `database.sqlite` fica na raiz do projeto, e a conexão é configurada em `db.php`.

O XAMPP também disponibiliza MySQL/MariaDB e o phpMyAdmin para outros projetos, mas essa aplicação não usa esses serviços atualmente. Não é necessário criar um banco no phpMyAdmin para rodá-la.

Ao acessar uma página que utiliza a conexão, o projeto executa o SQL de `init_db.php`, criando as tabelas `usuarios` e `produtos` caso ainda não existam.

### Começar com um banco vazio

O arquivo `database.sqlite` incluído no projeto pode conter dados de testes anteriores. Para começar do zero:

1. Pare o servidor local.
2. Faça uma cópia de segurança de `database.sqlite`, caso queira preservar os dados.
3. Exclua o arquivo `database.sqlite`.
4. Inicie o servidor novamente e abra o projeto. O SQLite criará um novo banco, e a aplicação criará as tabelas automaticamente.
5. Na tela inicial, clique em **Cadastre-se** para criar seu usuário.

> **Importante:** não exclua `init_db.php`. Ele contém o SQL usado para criar as tabelas. Se você mantiver o banco existente, os registros e usuários antigos também serão mantidos.

## Estrutura principal

```text
ED prog. web/
├── index.php           # Tela de login
├── login.php           # Validação do login
├── registrar.php       # Formulário de cadastro de usuário
├── salvar_usuario.php  # Criação de usuário
├── dashboard.php       # Formulário de cadastro de camisas
├── adicionar.php       # Salva uma camisa no banco
├── listar.php          # Lista e filtra o estoque
├── editar.php          # Edita os dados de uma camisa
├── excluir.php         # Exclui uma camisa
├── menu.php            # Menu de navegação
├── logout.php          # Encerra a sessão
├── db.php              # Conexão SQLite
├── init_db.php         # Criação das tabelas
├── database.sqlite     # Banco de dados SQLite
├── estilo.css          # Estilos da aplicação
├── fundo.jpg           # Imagem de fundo
└── uploads/            # Imagens das camisas
```

## Observações

- A pasta `uploads/` precisa permitir gravação pelo PHP para que o envio de imagens funcione.
- Se o banco não abrir, confira se a extensão `pdo_sqlite` está habilitada no PHP.
- Este projeto foi desenvolvido para uso local/estudo. Antes de publicá-lo em um servidor acessível pela internet, revise a segurança, especialmente o upload de imagens e as operações de edição e exclusão.
