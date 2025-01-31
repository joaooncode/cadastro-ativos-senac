<?php
// Start the session at the top

include_once('dropdownView.php');
include_once('headView.php');

include_once('../controllers/sessionController.php');
include_once('../controllers/functionsController.php');
include_once('../models/connect_db.php');

// Fetch the data
$ativos = fetchData($conn, 'movimentacao', 'statusAtivo', 'Ativo'); // Check if this function is correct for your needs

include_once('modal/move_modal.php');


$moveQuery = "SELECT idUsuario,
                     tipoMovimentacao,
                     quantidadeUso,
                     quantidadeMovimentacao,
                     localOrigem,
                     localDestino,
                     descricaoMovimentacao,
                     dataHoraMovimentacao,
                     (SELECT usuario FROM usaurio u WHERE u.idUsuario = m.idUsuario) AS usuario,
                     (SELECT descricaoAtivo FROM ativo a WHERE a.idAtivo = m.idAtivo) AS ativo
              FROM movimentacao m
              WHERE m.statusMovimentacao = 'S'";

$moveQueryResult = mysqli_query($conn, $moveQuery) or die(false);
$movimentacoes = $moveQueryResult->fetch_all(MYSQLI_ASSOC);
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
                    <table class="table table-hover table-bordered mt-5">
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
                            <?php foreach ($movimentacoes as $value): ?>
                                <tr>
                                    <td><?php echo $value['ativo']; ?></td>
                                    <td><?php echo $value['usuario']; ?></td>
                                    <td><?php echo $value['tipoMovimentacao']; ?></td>
                                    <td><?php echo $value['quantidadeMovimentacao']; ?></td>
                                    <td><?php echo $value['quantidadeUso']; ?></td>
                                    <td><?php echo $value['dataHoraMovimentacao']; ?></td>
                                    <td><?php echo $value['localOrigem']; ?></td>
                                    <td><?php echo $value['localDestino']; ?></td>
                                    <td><?php echo $value['descricaoMovimentacao']; ?></td>
                                    <td><?php echo $value['dataHoraMovimentacao']; ?></td>
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