<?php
session_start();

function criarBancoDeDados() {
    $caminhoBanco = __DIR__ . DIRECTORY_SEPARATOR . 'cadastro.db';
    $banco = new SQLite3($caminhoBanco);
    $banco->exec('CREATE TABLE IF NOT EXISTS nomes (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT NOT NULL)');
    return $banco;
}

function excluirNome($banco, $id) {
    $comando = $banco->prepare('DELETE FROM nomes WHERE id = :id'); 
    $comando->bindValue(':id', $id, SQLITE3_INTEGER); 
    $comando->execute(); // Executa a consulta preparada
}

if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 

    if (!empty($id)) { 
        $banco = criarBancoDeDados(); 
        excluirNome($banco, $id); 
        header("Location: listar.php"); 
    } else {
        $_SESSION['erro'] = "O ID não foi especificado.";
        header("Location: listar.php"); 
    }
} else {
    header("Location: listar.php"); 
}
