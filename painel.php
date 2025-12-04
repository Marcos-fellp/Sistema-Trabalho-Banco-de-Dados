<?php
session_start();
include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
 		
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <!-- ÍCONE NO CANTO ESQUERDO -->
    <a class="navbar-brand d-flex align-items-center ms-0" href="painel.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-apple" viewBox="0 0 16 16">
        <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
      </svg>
    </a>

    <!-- BOTÃO MOBILE -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENUS NO CANTO DIREITO -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto"> <!-- empurra para direita -->

        <li class="nav-item">
          <a class="nav-link active" href="login.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="form.php">Form</a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="listar_alunos.php">Alunos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>

  </div>
</nav>

 <h5>Olá, <?php echo $_SESSION['email'];?></h5>
 


<?php

include('conexao.php'); // arquivo de conexão com o banco

// Consulta para contar o total de registros na tabela "dados"
$query_total = "SELECT COUNT(*) AS total_alunos FROM dados";
$result_total = mysqli_query($conexao, $query_total);

// Pega o resultado
$total_alunos = 0;
if($result_total) {
    $row = mysqli_fetch_assoc($result_total);
    $total_alunos = $row['total_alunos'];
}

$query_info = "SELECT COUNT(*) AS total_info FROM dados WHERE curso = 'info'";
$result_info = mysqli_query($conexao, $query_info);

$total_info = 0;
if($result_info){
    $row = mysqli_fetch_assoc($result_info);
    $total_info = $row["total_info"];
}

// Consulta para ENF
$query_enf = "SELECT COUNT(*) AS total_enf FROM dados WHERE curso = 'ENF'";
$result_enf = mysqli_query($conexao, $query_enf);

$total_enf = 0;
if($result_enf){
    $row = mysqli_fetch_assoc($result_enf);
    $total_enf = $row["total_enf"];
}

// Consulta para DS
$query_ds = "SELECT COUNT(*) AS total_ds FROM dados WHERE curso = 'DS'";
$result_ds = mysqli_query($conexao, $query_ds);

$total_ds = 0;
if($result_ds){
    $row = mysqli_fetch_assoc($result_ds);
    $total_ds = $row["total_ds"];
}
// Consulta para ADM
$query_adm = "SELECT COUNT(*) AS total_adm FROM dados WHERE curso = 'ADM'";
$result_adm = mysqli_query($conexao, $query_adm);

$total_adm = 0;
if($result_adm){
    $row = mysqli_fetch_assoc($result_adm);
    $total_adm = $row["total_adm"];
}

// Array com todos os cursos e seus totais
$cursos = [
    "Informática" => $total_info,
    "ENF" => $total_enf,
    "DS" => $total_ds,
    "ADM" => $total_adm
];

// Encontra o curso com maior quantidade
$curso_mais_alunos = array_keys($cursos, max($cursos))[0];
$quantidade_mais_alunos = max($cursos);

// ================================
// CONSULTA: ALUNOS POR CURSO
// ================================
$sqlCurso = "SELECT curso, COUNT(*) AS total FROM dados GROUP BY curso";
$resultCurso = mysqli_query($conexao, $sqlCurso);

$cursos = [];
$totalCursos = [];

while ($row = mysqli_fetch_assoc($resultCurso)) {
    $cursos[] = $row['curso'];
    $totalCursos[] = $row['total'];
}

// ================================
// CONSULTA: ALUNOS POR BAIRRO
// ================================
$sqlBairro = "SELECT bairro, COUNT(*) AS total FROM dados GROUP BY bairro ORDER BY total DESC";
$resultBairro = mysqli_query($conexao, $sqlBairro);

$bairros = [];
$totalBairros = [];

while ($row = mysqli_fetch_assoc($resultBairro)) {
    $bairros[] = $row['bairro'];
    $totalBairros[] = $row['total'];
}

// ================================
// CONSULTA: ALUNOS POR TIPO DE RESPONSÁVEL
// ================================
$sqlResponsavel = "SELECT tipo_responsavel, COUNT(*) AS total FROM dados GROUP BY tipo_responsavel";
$resultResp = mysqli_query($conexao, $sqlResponsavel);

$tiposResp = [];
$totalResp = [];

while ($row = mysqli_fetch_assoc($resultResp)) {
    $tiposResp[] = $row['tipo_responsavel'];
    $totalResp[] = $row['total'];
}

// ================================
// CONSULTA: ALUNOS POR IDADE
// ================================
$sqlIdade = "
SELECT YEAR(CURDATE()) - YEAR(data_nasc) AS idade,
       COUNT(*) AS total
FROM dados
GROUP BY idade
ORDER BY idade;
";

$resultIdade = mysqli_query($conexao, $sqlIdade);

$idades = [];
$totalIdades = [];

while ($row = mysqli_fetch_assoc($resultIdade)) {
    $idades[] = $row['idade'];
    $totalIdades[] = $row['total'];
}
$sqlCurso = "SELECT curso, COUNT(*) AS total FROM dados GROUP BY curso;";
$resultCurso = mysqli_query($conexao, $sqlCurso);

$cursos = [];
$totaisCursos = [];

while ($row = mysqli_fetch_assoc($resultCurso)) {
    $cursos[] = $row['curso'];
    $totaisCursos[] = $row['total'];
}

/* ===========================
   2) Alunos por FAIXA ETÁRIA
   =========================== */
$sqlFaixa = "
SELECT 
    CASE
        WHEN TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) BETWEEN 13 AND 14 THEN '13–14 anos'
        WHEN TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) BETWEEN 15 AND 16 THEN '15–16 anos'
        WHEN TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) BETWEEN 17 AND 18 THEN '17–18 anos'
        ELSE 'Outros'
    END AS faixa_etaria,
    COUNT(*) AS total
FROM dados
GROUP BY faixa_etaria;
";

$resultFaixa = mysqli_query($conexao, $sqlFaixa);

$faixas = [];
$totaisFaixa = [];

while ($row = mysqli_fetch_assoc($resultFaixa)) {
    $faixas[] = $row['faixa_etaria'];
    $totaisFaixa[] = $row['total'];
}

$sql = "SELECT tipo_responsavel, COUNT(*) AS total FROM dados GROUP BY tipo_responsavel";
$result = mysqli_query($conexao, $sql);

$labelsResp = [];
$totaisResp = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labelsResp[] = $row['tipo_responsavel'];
    $totaisResp[] = $row['total'];
}

$sql = "SELECT bairro, COUNT(*) AS total FROM dados GROUP BY bairro ORDER BY bairro";
$result = mysqli_query($conexao, $sql);

$labelsBairro = [];
$totaisBairro = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labelsBairro[] = $row['bairro'];
    $totaisBairro[] = $row['total'];
}
?>


<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
        <div class="card text-bg-primary mb-3" style="max-width: 18rem; margin-left: 20px;">
           <div class="card-header">Total de Alunos</div>    
             <div class="card-body">
                <h5>Alunos matriculados</h5>
                <h5 class="card-title"><?php echo  $total_alunos; ?></h5> 
             </div>   
        </div>
      

 <div class="card text-bg-warning mb-3" style="max-width: 18rem; margin-left: 20px;">
   <div class="card-header">Alunos Enfermagem</div>    
    <div class="card-body">
      <h5>Enfermagem</h5>
      <h5 class="card-title"><?php echo  $total_enf; ?></h5> 
  </div>   
 </div>
 
  <div class="card text-bg-success mb-3" style="max-width: 18rem; margin-left: 20px;">
   <div class="card-header">Alunos Informática</div>    
    <div class="card-body">
      <h5>Informática</h5>
      <h5 class="card-title"><?php echo  $total_info; ?></h5> 
  </div>   
 </div>

</div>

<!-- NOVA LINHA COM MAIS 3 CARDS -->
<div class="row justify-content-sm-center mt-4">

  <!-- CARD ROXO -->
  <div class="card text-bg-dark mb-3" style="max-width: 18rem; margin-right: 20px;">
    <div class="card-header">Alunos Desenvolvimento de Sistemas</div>
    <div class="card-body">
      <h5>DS</h5>
      <h5 class="card-text"><?php echo  $total_ds; ?> </h5>
    </div>
  </div>


  <!-- CARD CIANO -->
  <div class="card text-bg-info mb-3" style="max-width: 18rem; margin-right: 20px;">
    <div class="card-header">Alunos Administração</div>
    <div class="card-body">
      <h5>Administração</h5>
      <h5 class="card-text"><?php echo  $total_adm; ?></h5>
    </div>
  </div>

  <!-- CARD VERMELHO -->
  <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
    <div class="card-header">Curso com mais alunos</div>
    <div class="card-body">
      <h5><?php echo $curso_mais_alunos; ?></h5>
      <h5 class="card-text"><?php echo $quantidade_mais_alunos ?> </h5>
    </div>
  </div>

</div>

<div class="row">

    <!-- GRÁFICO 1 - ALUNOS POR CURSO -->
    <div class="col-md-6">
        <div class="card p-3">
            <h5 class="text-center">Total de Alunos por Curso</h5>
            <canvas id="graficoCurso"></canvas>
        </div>
    </div>

    <!-- GRÁFICO 2 - ALUNOS POR FAIXA ETÁRIA -->
    <div class="col-md-6">
        <div class="card p-3">
            <h5 class="text-center">Quantidade de Alunos por Faixa Etária</h5>
            <canvas id="graficoFaixa"></canvas>
        </div>
    </div>

</div>

<div class="row mt-4">

  <div class="col-md-6">
    <div class="card p-3">
        <h5 class="text-center">Tipo de Responsável</h5>
        <canvas id="graficoResponsavel"></canvas>
    </div>
</div>

  <div class="col-md-6">
    <div class="card p-3">
        <h5 class="text-center">Alunos por Bairro</h5>
        <canvas id="graficoBairro"></canvas>
    </div>
</div>

   
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* =============================
   GRÁFICO 1 — Alunos por curso
   ============================= */
var ctx1 = document.getElementById('graficoCurso').getContext('2d');
var graficoCurso = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($cursos); ?>,
        datasets: [{
            label: 'Alunos',
            data: <?php echo json_encode($totaisCursos); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});

/* =========================================
   GRÁFICO 2 — Alunos por FAIXA ETÁRIA
   ========================================= */
var ctx2 = document.getElementById('graficoFaixa').getContext('2d');
var graficoFaixa = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($faixas); ?>,
        datasets: [{
            label: 'Alunos',
            data: <?php echo json_encode($totaisFaixa); ?>,
            backgroundColor: 'rgba(255, 159, 64, 0.5)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});

const labelsResp = <?= json_encode($labelsResp) ?>;
const dadosResp = <?= json_encode($totaisResp) ?>;

// Gráfico de Rosca (Doughnut)
const ctxResponsavel = document.getElementById('graficoResponsavel').getContext('2d');
new Chart(ctxResponsavel, {
    type: 'doughnut',
    data: {
        labels: labelsResp,
        datasets: [{
            data: dadosResp,
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#ffc107',
                '#dc3545',
                '#6f42c1',
                '#17a2b8'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Quantidade por Tipo de Responsável'
            }
        }
    }
});

const labelsBairro = <?= json_encode($labelsBairro) ?>;
const dadosBairro = <?= json_encode($totaisBairro) ?>;

// Gráfico de Pizza (Pie)
const ctxBairro = document.getElementById('graficoBairro').getContext('2d');
new Chart(ctxBairro, {
    type: 'pie',
    data: {
        labels: labelsBairro,
        datasets: [{
            data: dadosBairro,
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#dc3545',
                '#ffc107',
                '#17a2b8',
                '#6f42c1',
                '#fd7e14',
                '#20c997',
                '#6610f2',
                '#e83e8c'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Quantidade de Alunos por Bairro'
            }
        }
    }
});

</script>

</body>
</html>


   