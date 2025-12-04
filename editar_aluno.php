<?php
include("conexao.php");

if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id'];

// Buscar o aluno pelo ID
$sql = "SELECT * FROM dados WHERE id_aluno = '$id'";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Aluno não encontrado.");
}

$aluno = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h4 class="m-0">Editar Aluno</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="update_aluno.php">

                <input type="hidden" name="id" value="<?= $aluno['id_aluno'] ?>">

                <label class="form-label">Nome do Aluno</label>
                <input type="text" name="aluno_name" class="form-control mb-3" value="<?= $aluno['aluno_name'] ?>">

                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nasc" class="form-control mb-3" value="<?= $aluno['data_nasc'] ?>">

                <label class="form-label">Rua</label>
                <input type="text" name="rua" class="form-control mb-3" value="<?= $aluno['rua'] ?>">

                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control mb-3" value="<?= $aluno['numero'] ?>">

                <label class="form-label">Bairro</label>
                <input type="text" name="bairro" class="form-control mb-3" value="<?= $aluno['bairro'] ?>">

                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control mb-3" value="<?= $aluno['cep'] ?>">

                <label class="form-label">Nome do Responsável</label>
                <input type="text" name="nome_responsavel" class="form-control mb-3" value="<?= $aluno['nome_responsavel'] ?>">

                <label class="form-label">Tipo de Responsável</label>
                <input type="text" name="tipo_responsavel" class="form-control mb-3" value="<?= $aluno['tipo_responsavel'] ?>">

                <label class="form-label">Curso</label>
                <input type="text" name="curso" class="form-control mb-3" value="<?= $aluno['curso'] ?>">

                <a href="listar_alunos.php" class="btn btn-secondary">Cancelar</a>
                 <button type="submit" class="btn btn-primary">Salvar Alterações</button>

            </form>

        </div>
    </div>

</div>

</body>
</html>
