<?php
require_once("env.php");
$host = getenv("DB_HOST");
$usuario = getenv("DB_USER");
$senha = getenv("DB_PASS");
$banco = getenv("DB_NAME");
$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>