<?php
include("conexao.php");

$id = $_POST['id'];
$aluno_name = $_POST['aluno_name'];
$data_nasc = $_POST['data_nasc'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$nome_responsavel = $_POST['nome_responsavel'];
$tipo_responsavel = $_POST['tipo_responsavel'];
$curso = $_POST['curso'];

$sql = "
UPDATE dados SET
    aluno_name='$aluno_name',
    data_nasc='$data_nasc',
    rua='$rua',
    numero='$numero',
    bairro='$bairro',
    cep='$cep',
    nome_responsavel='$nome_responsavel',
    tipo_responsavel='$tipo_responsavel',
    curso='$curso'
WHERE id_aluno = $id
";

if(mysqli_query($conexao, $sql)){
    header("Location: listar_alunos.php?msg=ok");
    exit;
} else {
    echo "Erro ao atualizar.";
}
?>
