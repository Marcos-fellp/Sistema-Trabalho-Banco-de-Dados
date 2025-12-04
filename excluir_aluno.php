<?php
session_start();
include('conexao.php');

// Verifica se existe ID
if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = intval($_GET['id']);

// Deleta no banco
$sql = "DELETE FROM dados WHERE id_aluno = $id";  // <-- use o nome correto aqui
$result = mysqli_query($conexao, $sql);

// Verifica se excluiu
if ($result) {
    header("Location: listar_alunos.php?msg=Aluno excluído com sucesso");
    exit;
} else {
    die("Erro ao excluir aluno: " . mysqli_error($conexao));
}
?>
