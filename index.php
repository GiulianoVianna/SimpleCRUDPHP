<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Nomes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php session_start(); ?>

    <div class="container">
        <h1>Cadastro de Nomes</h1>
        <form action="processa.php" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>
            <button type="submit">Cadastrar</button>
            <a href="listar.php" class="listar-btn">Listar Cadastros</a>
        </form>
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert" role="alert">
                <?= $_SESSION['sucesso'] ?>
            </div>
            <?php unset($_SESSION['sucesso']); ?>
        <?php endif; ?>
    </div>
</body>
</html>
