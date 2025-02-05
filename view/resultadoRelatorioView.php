<?php

include_once('../controllers/sessionController.php');
include_once('../models/connect_db.php');
include_once('headView.php');
include_once('dropdownView.php');

$ativo = $_POST['ativo'];
$dataInicio = $_POST['dataInicio'];
$dataFim = $_POST['dataFim'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$usuario = $_POST['usuario'];
$tipoMovimentacao = $_POST['tipoMovimentacao'];


$relatorioQuery = "SELECT
                        (SELECT descricaoAtivo FROM ativo a WHERE a.idAtivo = m.idAtivo) as ativo,
                        (SELECT nomeUsuario FROM usuario u WHERE u.idUsuario = m.idUsuario) as usuario,
                        idUsuario,
                        tipoMovimentacao,
                        quantidadeUso,
                        quantidadeMovimentacao,
                        localOrigem,
                        localDestino,
                        descricaoMovimentacao,
                        dataHoraMovimentacao
                    FROM movimentacao m 

                    WHERE
                        idAtivo IS NOT NULL
                    ";


if ($ativo != null && $ativo != '') {
    $relatorioQuery .= " AND m.idAtivo=$ativo";
    $relatorioQuery .= " AND m.idAtivo=$ativo";
    if ($marca != null && $marca != '') {
        $relatorioQuery .= " and m.idAtivo in(SELECT idAtivo FROM ativo a WHERE a.idMarca = $marca) ";
    }
    if ($tipo != null && $tipo != '') {
        $relatorioQuery .= " and m.idAtivo in(SELECT idAtivo FROM ativo a WHERE a.idTipo = $tipo) ";
    }
}
if ($usuario != null && $usuario != '') {
    $relatorioQuery .= " AND idUsuario=$usuario";
    $relatorioQuery .= " AND idUsuario=$usuario";
}
if ($tipoMovimentacao != null && $tipoMovimentacao != '') {
    $relatorioQuery .= " AND m.tipoMovimentacao='$tipoMovimentacao'";
}

if ($dataInicio != '' || $dataInicio != null) {
    $relatorioQuery .= " AND m.dataHoraMovimentacao >'$dataInicio'";
}
if ($dataFim != '' || $dataFim != null) {
    $relatorioQuery .= " AND m.dataHoraMovimentacao < '$dataFim'";
}


$resultQuery = mysqli_query($conn, $relatorioQuery) or die(false);
$movimentacoesResult = $resultQuery->fetch_all(MYSQLI_ASSOC);



// echo the query for debugging purposes

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Relatório</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
    <div class="container mt-5">
        <div id="toolbar" class="mb-5"></div>
        <h1 class="text-center text-primary mb-4">Resultado do Relatório</h1>
        <div class="table-responsive">
            <table id="relatorios" class="table table-bordered table-hover mt-4">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Ativo</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Quantidade Uso</th>
                        <th scope="col">Quantidade Movimentação</th>
                        <th scope="col">Tipo Movimentação</th>
                        <th scope="col">Local Origem</th>
                        <th scope="col">Local Destino</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($movimentacoesResult)) {
                        foreach ($movimentacoesResult as $movimentacao) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($movimentacao['ativo']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['idUsuario']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['quantidadeUso']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['quantidadeMovimentacao']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['tipoMovimentacao']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['localOrigem']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['localDestino']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['descricaoMovimentacao']) . "</td>";
                            echo "<td>" . htmlspecialchars($movimentacao['dataHoraMovimentacao']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Nenhum resultado encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            let table = $('#relatorios').DataTable({
                search: {
                    return: true
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            table.buttons().container()
                .appendTo('#toolbar');
        });
    </script>
</body>

</html>