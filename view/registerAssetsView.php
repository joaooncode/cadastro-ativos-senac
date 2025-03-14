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


<body class="min-vw-100 min-vh-100">
    <div class="container-fluid d-flex align-items-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">

            <button id="cadastrarAtivoBtn" onclick="clearModal()" style="width: 100%; max-width: 200px;" type="button"
                class="btn btn-outline-primary mt-3 mb-3 p-3" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Cadastrar Ativo</button>


            <!-- Campo de busca api mercado livre-->
            <div class="container mt-5">
                <form class="d-flex align-items-center justify-content-between" action="./productsResultApi.php"
                    method="post">
                    <input class="form-control m-2" name="search" type="text" placeholder="Pesquisar no Mercado Livre">
                    <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
                </form>
            </div>
            <!-- Tabela ativos cadastrados -->
            <div class="container-fluid mb-2 w-100">

                <!-- Adicionando responsividade à tabela -->
                <div class="table-responsive d-flex align-items-center justify-content-center"
                    style="overflow-x:auto; width: 100%;">

                    <table class="table table-bordered border-dark w-75 mt-5">
                        <thead class="table table-dark">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Quantidade Cadastrada</th>
                                <th scope="col">Quantidade Minima</th>
                                <th scope="col">Quantidade em uso</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $assets => $value) {
                                $quantidadeDisponivel = $value['quantidadeAtivo'] - $value['quantidadeUso'];
                            ?>
                                <tr class="text-uppercase">
                                    <td><?php echo $value['idAtivo'] ?></td>
                                    <td><?php echo $value['descricaoAtivo'] ?></td>
                                    <td>
                                        <?php echo $value['quantidadeAtivo'] ?>
                                        <?php if ($quantidadeDisponivel < $value['quantidadeMinimaAtivo']) { ?>
                                            <i class="bi bi-exclamation-triangle-fill text-danger"
                                                title="Quantidade abaixo do mínimo"></i>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $value['quantidadeMinimaAtivo']  ?></td>
                                    <td><?php echo $value['quantidadeUso']  ?></td>
                                    <td><?php echo $value['marca'] ?></td>
                                    <td><?php echo $value['statusAtivo'] ?></td>
                                    <td><?php echo $value['tipo'] ?></td>
                                    <td>
                                        <?php if (!empty($value['url_imagem'])) { ?>
                                            <img src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/' . $value['url_imagem']; ?>"
                                                alt="Imagem do Ativo" style="max-width: 100px; height: auto;">
                                        <?php } else {
                                            echo 'Sem imagem';
                                        } ?>
                                    </td>
                                    <td>
                                        <div class=" actions d-flex justify-content-evenly">
                                            <button class="mx-2 btn btn-primary btn-sm" id="info"
                                                onclick="showInfo('<?php echo $value['idAtivo']; ?>')" data-bs-toggle="modal"
                                                data-bs-target="#infoAtivo">Ver informações</button>
                                            <button id="editAsset" onclick="updateAsset('<?php echo $value['idAtivo']; ?>')"
                                                class="mx-2 btn btn-primary">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button id="deleteAsset"
                                                onclick="deleteAsset('<?php echo $value['idAtivo']; ?>')"
                                                class="mx-2 btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <div class="changeStatus">
                                                <?php
                                                if ($value['statusAtivo'] == "S") {
                                                ?>
                                                    <button id=" activeAsset"
                                                        onclick="changeStatus('N','<?php echo $value['idAtivo']; ?>')"
                                                        class=" btn btn-success">
                                                        <i class="bi bi-toggle-on"></i>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button id="inactiveAsset"
                                                        onclick="changeStatus('S','<?php echo $value['idAtivo']; ?>')"
                                                        class=" btn btn-danger">
                                                        <i class="bi bi-toggle-off"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" id="idAsset" value="">
                </div> <!-- Fim da table-responsive -->
            </div>
        </main>
    </div>

    <script src="../js/assets.js"></script>
    <script src="../js/updateAssets.js"></script>

</body>