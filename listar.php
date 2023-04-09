<?php
session_start();

function criarBancoDeDados() {
    $caminhoBanco = __DIR__ . DIRECTORY_SEPARATOR . 'cadastro.db';
    $banco = new SQLite3($caminhoBanco);
    $banco->exec('CREATE TABLE IF NOT EXISTS nomes (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT NOT NULL)');
    return $banco;
}

function listarNomes($banco) {
    $resultado = $banco->query('SELECT * FROM nomes');
    return $resultado;
}

$db = criarBancoDeDados();
$nomes = listarNomes($db);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cadastros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Listar Cadastros</h1>
        <ul>
            <?php while ($nome = $nomes->fetchArray()): ?>
                <li>
                    <?= htmlspecialchars($nome['nome']) ?>
                    <a href="excluir.php?id=<?= $nome['id'] ?>" class="btn-excluir">X</a>
                </li>
            <?php endwhile; ?>
        </ul>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
