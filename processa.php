<?php
session_start();

function criarBancoDeDados() {
    $caminhoBanco = __DIR__ . DIRECTORY_SEPARATOR . 'cadastro.db';
    $banco = new SQLite3($caminhoBanco);
    $banco->exec('CREATE TABLE IF NOT EXISTS nomes (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT NOT NULL)');
    return $banco;
}

function inserirNome($banco, $nome) {
    $comando = $banco->prepare('INSERT INTO nomes (nome) VALUES (:nome)');
    $comando->bindValue(':nome', $nome, SQLITE3_TEXT);
    $comando->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));

    if (!empty($nome)) {
        $banco = criarBancoDeDados();
        inserirNome($banco, $nome);

        $_SESSION['sucesso'] = "Cadastro Realizado!";
        header("Location: index.php");
    } else {
        echo "O campo nome não pode estar vazio.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
