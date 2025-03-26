<?php
include_once('../controllers/sessionController.php');
include_once('dropdownView.php');
include_once('headView.php');

include_once('../controllers/functionsController.php');
include_once('../models/connect_db.php');

include_once('../controllers/typesController.php');


include_once('modal/types_modal.php');
/* include_once('./modal/update_types.php'); */

$brand = fetchData($conn, 'tipo');

?>
<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid flex-grow-1 py-4">
        <main class="h-100">
            <div class="container">
                <div class="text-center mb-4">
                    <h1 class="text-primary mb-3">Tipos</h1>
                    <button id="cadastrarTipoBtn" onclick="limpar_modal()" 
                            class="btn btn-outline-primary w-100 w-md-auto mb-3"
                            data-bs-toggle="modal"
                            data-bs-target="#typesModal">
                        <i class="bi bi-plus-lg d-md-none"></i>
                        <span class="d-none d-md-inline">Cadastrar Tipo</span>
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
                                <th scope="col" style="min-width: 120px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brand as $value): ?>
                            <tr>
                                <td class="fw-bold"><?= $value['descricaoTipo'] ?></td>
                                <td class="d-none d-md-table-cell"><?= $value['idUsuario'] ?></td>
                                <td class="d-none d-lg-table-cell">
                                    <?= date('d/m/Y H:i', strtotime($value['dataCadastroTipo'])) ?>
                                </td>
                                <td>
                                    <?php if ($value['statusTipo'] == "S"): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                                        <button class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#updateTypes"
                                                onclick="editar('<?= $value['idTipo'] ?>')"
                                                title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <?php if ($value['statusTipo'] == "S"): ?>
                                            <button class="btn btn-sm btn-success"
                                                    onclick="muda_status('N','<?= $value['idTipo'] ?>')"
                                                    title="Desativar">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="muda_status('S','<?= $value['idTipo'] ?>')"
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
    <script src="../js/types.js"></script>
</body>