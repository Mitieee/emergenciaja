<?php
require_once("env.php");
$host = getenv("DB_HOST");
$usuario = getenv("DB_USER");
$senha = getenv("DB_PASS");
$banco = getenv("DB_NAME");
$conexao = new mysqli($host, $usuario, $senha, $banco);
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>
