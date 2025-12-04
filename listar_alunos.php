<?php 
session_start();
include('conexao.php');




// Buscar todos os alunos do banco
$sql = "SELECT * FROM dados ORDER BY aluno_name ASC";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alunos Cadastrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #ede8e8ff;">
  <div class="container-fluid">

    <a class="navbar-brand d-flex align-items-center ms-0" href="painel.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-apple" viewBox="0 0 16 16">
        <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
      </svg>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link active" href="login.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="form.php">Form</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>

  </div>
</nav>

<style>
.navbar .nav-link,
.navbar .navbar-brand {
    color: black !important;
}
</style>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header" style="background-color: grey; color: white;">
            <h4 class="m-0">Alunos Cadastrados</h4>
        </div>

        <div class="card-body">

            <table class="table table-striped" id="alunosTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data Nasc.</th>
                        <th>Endereço</th>
                        <th>Responsável</th>
                        <th>Curso</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['aluno_name'] ?></td>

                        <td>
                            <?= date("d/m/Y", strtotime($row['data_nasc'])) ?>
                        </td>

                        <td>
                            <?= $row['rua'] ?>, 
                            <?= $row['numero'] ?> - 
                            <?= $row['bairro'] ?>  
                            (<?= $row['cep'] ?>)
                        </td>

                        <td>
                            <?= $row['nome_responsavel'] ?>
                            (<?= $row['tipo_responsavel'] ?>)
                        </td>

                        <td><?= strtoupper($row['curso']) ?></td>

                        <td>
                          <a href="editar_aluno.php?id=<?= $row['id_aluno'] ?>" class="btn btn-primary btn-sm">

                                Editar
                            </a>
                             <a href="excluir_aluno.php?id=<?= $row['id_aluno'] ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este aluno?');">
                                Excluir
                            </a>
                        </td>

                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
