<?php
// 1. Configurações de erro (em produção, mude para 0)
ini_set("display_errors", 1);
error_reporting(E_ALL);

// 2. Definir charset moderno
header('Content-Type: text/html; charset=utf-8');

// 3. Credenciais (Idealmente viriam de um arquivo .env)
$servername = getenv('DB_HOST') ?: "54.234.153.24";
$username   = getenv('DB_USER') ?: "root";
$password   = getenv('DB_PASS') ?: "Senha123";
$database   = getenv('DB_NAME') ?: "meubanco";

// 4. Conexão com tratamento de exceção
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $link = new mysqli($servername, $username, $password, $database);
    $link->set_charset("utf8mb4");

    // Gerar dados
    $aluno_id  = rand(1, 999);
    $rand_str  = strtoupper(bin2hex(random_bytes(4)));
    $host_name = gethostname();

    // 5. Prepared Statements (Proteção contra SQL Injection)
    $stmt = $link->prepare("INSERT INTO Alunos (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES (?, ?, ?, ?, ?, ?)");
    
    // "isssss" significa: i = integer, s = string (para os demais 5 campos)
    $stmt->bind_param("isssss", $aluno_id, $rand_str, $rand_str, $rand_str, $rand_str, $host_name);

    if ($stmt->execute()) {
        echo "<h3>Novo registro criado com sucesso!</h3>";
        echo "ID: $aluno_id | Host: $host_name";
    }

    $stmt->close();
    $link->close();

} catch (mysqli_sql_exception $e) {
    // Log do erro real no servidor e mensagem genérica para o usuário
    error_log($e->getMessage());
    exit("Erro ao conectar ou inserir dados no banco.");
}
?>