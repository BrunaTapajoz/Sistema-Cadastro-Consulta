<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root1";
$password = "123456";
$dbname = "sistemalunos";


$this = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($this->connect_error) {
    die("Falha na conexão: " . $this->connect_error);
}

// Seleciona todos os alunos
$sql = "SELECT id, nome, email, curso, data_cadastro FROM sistemalunos.alunos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Nome</th><th>Email</th><th>Curso</th><th>Data de Cadastro</th><th>Ação</th></tr>";
    // Exibe os dados de cada linha
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nome"]. "</td><td>" . $row["email"]. "</td><td>" . $row["curso"]. "</td><td>" . $row["data_cadastro"]. "</td><td><a href='excluir_aluno.php?id=" . $row["id"] . "'>Excluir</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum aluno cadastrado.";
}

$this->close();
?>