<?php
include_once('dropdownView.php');
include_once('headView.php');

include_once('../controllers/sessionController.php');
include_once('../controllers/functionsController.php');
include_once('../models/connect_db.php');

/* include_once('./modal/update_types.php'); */

$ativos = fetchData($conn, 'ativo', 'statusAtivo', 'Ativo');

include_once('modal/move_modal.php');
?>

<body class="min-vw-100 min-vh-100">
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <main class="vw-100 vh-100 d-flex flex-column align-items-center justify-content-center">
            <!-- Tabela ativos cadastrados -->
            <div class="container mb-5 w-100">
                <div class="text-center mb-4">
                    <h1 class="text-primary">Movimentações</h1>
                    <button id="cadastrarTipoBtn" class="btn btn-outline-primary mt-3 mb-3 p-3"
                        style="width: 100%; max-width: 200px;" data-bs-toggle="modal"
                        data-bs-target="#cadastrarMovimentacao">
                        Realizar Nova Movimentação
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered  border-primary mt-5">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Ativo</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Quantidade Uso</th>
                                <th scope="col">Última Movimentação</th>
                                <th scope="col">Local Origem</th>
                                <th scope="col">Local Destino</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ativos as $ativo => $value): ?>
                                <tr>
                                    <td><?= $value['descricaoAtivo'] ?></td>
                                    <td><?= $value['idUsuario'] ?></td>
                                    <td><?= $value['tipoMovimentacao'] ?></td>
                                    <td><?= $value['quantidadeMovimentacao'] ?></td>
                                    <td><?= $value['quantidadeUso'] ?></td>
                                    <td><?= $value['ultimaMovimentacao'] ?></td>
                                    <td><?= $value['localOrigem'] ?></td>
                                    <td><?= $value['localDestino'] ?></td>
                                    <td><?= $value['descricaoMovimentacao'] ?></td>
                                    <td><?= $value['dataHoraMovimentacao'] ?></td>
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