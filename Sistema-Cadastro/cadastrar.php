<?php

require 'PHP/db.php';

//  realizar a conexão
$db = new Database('localhost', 'Escola', 'Bruna', '123456', 3307);
$db->connect(); // Conecta ao banco de dados


$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';

// Busca de alunos cadastrados no banco de dados
$alunos = []; // variável aluno como vazia,pode ser preenchida com os dados inseridos
try {
    $pdo = $db->getConnection(); // conecta com o database
    $stmt = $pdo->prepare("SELECT * FROM sistemalunos.alunos");// prepara uma consulta no sql
    //* from pega todos os dados da table alunos do db sistema_alunos
    $stmt->execute();//Stmt ele pega a consulta preparada e executa ela
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p class='error'>Erro ao buscar alunos: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
    <link rel="stylesheet" href="CSS/Style1.css">
</head>
<body>
    <div class="form-container">
        <h1>Cadastro de Alunos</h1>
        <!-- Formulário de cadastro que envia os dados para o cadastro.php para inserir no db-->
        <form action="cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome aqui" required>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" placeholder="Qual sua idade?" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Insira seu email" required>

            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" placeholder="Insira o seu curso" required>

            <input type="submit" value="Cadastrar">
        </form>
                <!-- Exibe mensagem de sucesso ou erro -->
                <?php if ($status == 'success'): ?>
        <p class="success">Aluno cadastrado com sucesso!</p>
    <?php elseif ($status == 'error'): ?>
        <p class="error">Erro ao cadastrar aluno: <?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    </div>
</body>
</html>
