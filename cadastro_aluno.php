<?php
session_start();
include('conexao.php'); // arquivo de conexão com o banco

// Verifica se os campos foram enviados
if (empty($_POST['nome']) || empty($_POST['date']) || empty($_POST['rua']) || empty($_POST['number']) || empty($_POST['bairro']) || empty($_POST['cep']) ||  empty($_POST['responsavel']) || empty($_POST['tipo_responsavel']) || empty($_POST['curso'])){
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    header('Location: form.php'); // sua página de cadastro
    exit();
}

$nome = $_POST['nome'];
$date = $_POST['date'];
$rua = $_POST['rua'];
$number = $_POST['number'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$resp = $_POST['responsavel'];
$tipo_resp = $_POST['tipo_responsavel'];
$curso = $_POST['curso'];

$query = "INSERT INTO dados (aluno_name, data_nasc, rua, numero, bairro, cep, nome_responsavel, tipo_responsavel, curso) VALUES ('$nome', '$date', '$rua', '$number', '$bairro', '$cep', '$resp', '$tipo_resp', '$curso')";

if(mysqli_query($conexao, $query)){
    $_SESSION['mensagem'] = "cadastro realizado com sucesso!";
    header('Location: form.php');

}else{
      $_SESSION['mensagem'] = "cadastro não realizado!";
}
?>