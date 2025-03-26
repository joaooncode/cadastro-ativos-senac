<?php
include_once('headView.php');
include_once('../controllers/sessionController.php');
include_once('dropdownView.php');
include_once('../models/connect_db.php');
include_once('../controllers/functionsController.php');

$brands = fetchData($conn, 'marca');
$types = fetchData($conn, 'tipo');

include_once('modalView.php');
include_once('./modal/info_modal.php');
include_once('modal/update_assets_btn.php');

$assets = fetchData($conn, 'ativo');

$sql = "
    SELECT 
    idAtivo,
    descricaoAtivo,
    (SELECT descricaoMarca FROM marca m WHERE m.idMarca = a.idMarca) as marca,
    statusAtivo,
    dataHoraCadastroAtivo, 
    quantidadeAtivo,
    quantidadeMinimaAtivo,
    obsAtivo,
    url_imagem,
    (SELECT descricaotipo FROM tipo t WHERE t.idTipo = a.idTipo) as tipo,
    (SELECT quantidadeUso from movimentacao m  where m.idAtivo = a.idAtivo and statusMovimentacao = 'S') as quantidadeUso
    FROM ativo a
";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//retorna todos os ativos
$data = $result->fetch_all(MYSQLI_ASSOC);

?>


<body class="min-vh-100">
    <div class="container-fluid">
        <main class="py-4">
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <button id="cadastrarAtivoBtn" onclick="clearModal()" 
                            class="btn btn-outline-primary w-100 py-2" 
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                        Cadastrar Ativo
                    </button>
                </div>
                <div class="col-12 col-md-8">
                    <form class="row g-2" action="./productsResultApi.php" method="post">
                        <div class="col-12 col-sm-9">
                            <input class="form-control" name="search" type="text" 
                                   placeholder="Pesquisar no Mercado Livre">
                        </div>
                        <div class="col-12 col-sm-3">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                Pesquisar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered border-dark table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th class="d-none d-md-table-cell">Quantidade Cadastrada</th>
                            <th class="d-none d-lg-table-cell">Quantidade Minima</th>
                            <th>Em uso</th>
                            <th class="d-none d-sm-table-cell">Marca</th>
                            <th>Status</th>
                            <th class="d-none d-lg-table-cell">Tipo</th>
                            <th class="d-none d-sm-table-cell">Imagem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $assets => $value) { 
                            $quantidadeDisponivel = $value['quantidadeAtivo'] - $value['quantidadeUso']; ?>
                            <tr class="text-uppercase">
                                <td><?= $value['idAtivo'] ?></td>
                                <td><?= $value['descricaoAtivo'] ?></td>
                                <td class="d-none d-md-table-cell">
                                    <?= $value['quantidadeAtivo'] ?>
                                    <?php if ($quantidadeDisponivel < $value['quantidadeMinimaAtivo']) { ?>
                                        <i class="bi bi-exclamation-triangle-fill text-danger"
                                           title="Quantidade abaixo do mínimo"></i>
                                    <?php } ?>
                                </td>
                                <td class="d-none d-lg-table-cell"><?= $value['quantidadeMinimaAtivo'] ?></td>
                                <td><?= $value['quantidadeUso'] ?></td>
                                <td class="d-none d-sm-table-cell"><?= $value['marca'] ?></td>
                                <td><?= $value['statusAtivo'] ?></td>
                                <td class="d-none d-lg-table-cell"><?= $value['tipo'] ?></td>
                                <td class="d-none d-sm-table-cell">
                                    <?php if (!empty($value['url_imagem'])) { ?>
                                        <img src="<?= $value['url_imagem'] ?>" 
                                             class="img-fluid" 
                                             style="max-width: 80px;" 
                                             alt="Imagem do Ativo">
                                    <?php } else {
                                        echo 'Sem imagem';
                                    } ?>
                                </td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row gap-1">
                                        <button class="btn btn-primary btn-sm" 
                                                onclick="showInfo('<?= $value['idAtivo'] ?>')"
                                                data-bs-toggle="modal"
                                                data-bs-target="#infoAtivo">
                                            <i class="bi bi-info-circle d-md-none"></i>
                                            <span class="d-none d-md-inline">Info</span>
                                        </button>
                                        <button class="btn btn-primary btn-sm"
                                                onclick="updateAsset('<?= $value['idAtivo'] ?>')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                                onclick="deleteAsset('<?= $value['idAtivo'] ?>')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <?php if ($value['statusAtivo'] == "S") { ?>
                                            <button class="btn btn-success btn-sm"
                                                    onclick="changeStatus('N','<?= $value['idAtivo'] ?>')">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="changeStatus('S','<?= $value['idAtivo'] ?>')">
                                                <i class="bi bi-toggle-off"></i>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" id="idAsset" value="">
            </div>
        </main>
    </div>
    <script src="../js/assets.js"></script>
</body>