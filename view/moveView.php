<?php
include_once('dropdownView.php');
include_once('headView.php');

include_once('../controllers/sessionController.php');
include_once('../controllers/functionsController.php');
include_once('../models/connect_db.php');

include_once('../controllers/moveController.php');


/* include_once('./modal/update_types.php'); */

$ativos = fetchData($conn, 'ativo', 'statusAtivo', 'Ativo');

include_once('modal/move_modal.php');

?>

<body class="min-vw-100 min-vh-100 overflow-hidden">
    <div class="container min-vh-100 min-vw-100 d-flex align-content-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container mb-5 w-100">
                <div class="d-flex flex-column justify-content-evenly align-items-center">
                    <h1 class="text-center text-primary">Movimentações</h1>
                    <button id="cadastrarTipoBtn" onclick="limpar_modal()" style="width: 100%; max-width: 200px;"
                        type="button" class="btn btn-outline-primary mt-3 mb-3 p-3" data-bs-toggle="modal"
                        data-bs-target="#cadastrarMovimentacao">Realizar Nova Movimentação</button>
                </div>
                <table class="table table-bordered  border-primary mt-5">
                    <thead>
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
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ativos as $ativo => $value) {
                            ?>
                            <tr>

                                <td>
                                    <p>
                                        <?php echo $value['idAtivo'] ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $value['idUsuario'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['tipoMovimentacao'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['quantidadeMovimentacao'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['quantidadeUso'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['ultimaMovimentacao'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['localOrigem'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['localDestino'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['descricaoMovimentacao'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['dataHoraMovimentacao'] ?>
                                    </p>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                    </tbody>
                </table>
            </div>

        </main>
    </div>
    <script src="../js/movimentacoes.js"></script>
</body>