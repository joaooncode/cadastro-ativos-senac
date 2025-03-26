<?php
include_once '../controllers/sessionController.php';
include_once 'dropdownView.php';
include_once 'headView.php';

include_once '../controllers/functionsController.php';
include_once '../models/connect_db.php';

include_once '../controllers/brandsController.php';

include_once 'modal/modal_marca.php';

$brand = fetchData($conn, 'marca');

?>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid flex-grow-1 py-4">
        <main class="h-100">
            <div class="container">
                <div class="text-center mb-4">
                    <h1 class="text-primary mb-3">Marcas</h1>
                    <button id="cadastrarMarcaBtn" onclick="limpar_modal()" 
                            class="btn btn-outline-primary w-100 w-md-auto mb-3"
                            data-bs-toggle="modal"
                            data-bs-target="#cadastrarMarca">
                        <i class="bi bi-plus-lg d-md-none"></i>
                        <span class="d-none d-md-inline">Cadastrar Marca</span>
                    </button>
                </div>

                <div class="table-responsive rounded-3 shadow">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Descrição</th>
                                <th scope="col" class="d-none d-md-table-cell">Usuário</th>
                                <th scope="col" class="d-none d-lg-table-cell">Data Cadastro</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 150px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brand as $value): ?>
                            <tr>
                                <td class="fw-bold"><?= $value['descricaoMarca'] ?></td>
                                <td class="d-none d-md-table-cell"><?= $value['idUsuario'] ?></td>
                                <td class="d-none d-lg-table-cell">
                                    <?= date('d/m/Y H:i', strtotime($value['dataCadastroMarca'])) ?>
                                </td>
                                <td>
                                    <?php if ($value['statusMarca'] == "S"): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cadastrarMarca"
                                                onclick="editar('<?= $value['idMarca'] ?>')"
                                                title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <?php if ($value['statusMarca'] == "S"): ?>
                                            <button class="btn btn-sm btn-success"
                                                    onclick="muda_status('N','<?= $value['idMarca'] ?>')"
                                                    title="Desativar">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="muda_status('S','<?= $value['idMarca'] ?>')"
                                                    title="Ativar">
                                                <i class="bi bi-toggle-off"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/marcas.js"></script>
</body>