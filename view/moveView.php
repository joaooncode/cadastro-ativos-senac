<?php
// Start the session at the top

include_once('../controllers/sessionController.php');
include_once('dropdownView.php');
include_once('headView.php');

include_once('../controllers/functionsController.php');
include_once('../models/connect_db.php');

// Fetch the data
$ativos = fetchData($conn, 'ativo'); // Check if this function is correct for your needs

include_once('modal/move_modal.php');


$moveQuery = "SELECT idUsuario,
                     tipoMovimentacao,
                     quantidadeUso,
                     quantidadeMovimentacao,
                     localOrigem,
                     localDestino,
                     descricaoMovimentacao,
                     dataHoraMovimentacao,
                     (SELECT nomeUsuario FROM usuario u WHERE u.idUsuario = m.idUsuario) AS usuario,
                     (SELECT descricaoAtivo FROM ativo a WHERE a.idAtivo = m.idAtivo) AS ativo,
                     (SELECT quantidadeAtivo FROM ativo a WHERE a.idAtivo = m.idAtivo) AS quantidadeTotal,
                     (SELECT quantidadeMovimentacao FROM ativo a WHERE a.idAtivo = m.idAtivo) AS quantidadeMovimentacao
              FROM movimentacao m
              WHERE m.statusMovimentacao = 'S'";

$moveQueryResult = mysqli_query($conn, $moveQuery) or die(false);
$movimentacoes = $moveQueryResult->fetch_all(MYSQLI_ASSOC);
?>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid flex-grow-1 py-4">
        <main class="d-flex flex-column h-100">
            <div class="container">
                <div class="text-center mb-4">
                    <h1 class="text-primary mb-3">Movimentações</h1>
                    <button id="cadastrarTipoBtn" class="btn btn-outline-primary w-100 w-md-auto mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#cadastrarMovimentacao">
                        <i class="bi bi-plus-lg d-md-none"></i>
                        <span class="d-none d-md-inline">Realizar Nova Movimentação</span>
                    </button>
                </div>

                <div class="table-responsive rounded-3 shadow">
                    <table class="table table-bordered table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Ativo</th>
                                <th scope="col">Tipo</th>
                                <th scope="col" class="d-none d-lg-table-cell">Qtd. Mov.</th>
                                <th scope="col" class="d-none d-md-table-cell">Qtd. Total</th>
                                <th scope="col">Qtd. Uso</th>
                                <th scope="col" class="d-none d-xl-table-cell">Origem</th>
                                <th scope="col" class="d-none d-xl-table-cell">Destino</th>
                                <th scope="col" class="d-none d-sm-table-cell">Descrição</th>
                                <th scope="col" class="text-nowrap">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($movimentacoes as $value): ?>
                            <tr>
                                <td class="fw-bold"><?= $value['ativo'] ?></td>
                                <td><?= $value['tipoMovimentacao'] ?></td>
                                <td class="d-none d-lg-table-cell"><?= $value['quantidadeMovimentacao'] ?></td>
                                <td class="d-none d-md-table-cell"><?= $value['quantidadeTotal'] ?></td>
                                <td><?= $value['quantidadeUso'] ?></td>
                                <td class="d-none d-xl-table-cell"><?= $value['localOrigem'] ?></td>
                                <td class="d-none d-xl-table-cell"><?= $value['localDestino'] ?></td>
                                <td class="d-none d-sm-table-cell text-truncate" style="max-width: 200px;">
                                    <?= $value['descricaoMovimentacao'] ?>
                                </td>
                                <td class="text-nowrap">
                                    <?= date('d/m/Y H:i', strtotime($value['dataHoraMovimentacao'])) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="../js/movimentacoes.js"></script>
</body>