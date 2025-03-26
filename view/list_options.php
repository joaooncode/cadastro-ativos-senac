<?php
include('dropdownView.php');
include_once('../models/connect_db.php');
include_once('../controllers/functionsController.php');

$options_data = fetchData($conn, 'opcoes_menu');
$levels = fetchData($conn, 'nivel_acesso');
include_once('./modal/options_modal.php');
$query = 'SELECT 
            id_opcao,
            descricao_opcao,
            nivel_opcao,
            url_opcao,
            status_opcao,
            idUsuario,
            data_cadastro
        FROM opcoes_menu';

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$data = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Listar Opções</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add your CSS links here if needed -->
</head>

<body class="d-flex flex-column bg-light min-vh-100">
    <div class="container-fluid px-lg-5 mt-3">
        <div class="row align-items-center mb-3 mb-md-4 g-2">
            <div class="col-12 col-md-6">
                <h1 class="text-primary h4 mb-0">Controle de Opções</h1>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <button class="btn btn-primary w-100 w-md-auto" 
                        data-bs-toggle="modal" 
                        data-bs-target="#novaOpcao"
                        id="novaOpcaoBtn" 
                        onclick="limpar_modal()">
                    <i class="bi bi-plus-lg d-md-none"></i>
                    <span class="d-none d-md-inline">Nova Opção</span>
                </button>
            </div>
        </div>

        <div class="table-responsive rounded-3 shadow-sm">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-nowrap">ID</th>
                        <th scope="col">Descrição</th>
                        <th scope="col" class="d-none d-sm-table-cell">Nível</th>
                        <th scope="col" class="d-none d-lg-table-cell">URL</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width: 120px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">Nenhum registro encontrado</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($data as $row): ?>
                    <tr>
                        <td class="fw-bold"><?= $row['id_opcao'] ?></td>
                        <td><?= $row['descricao_opcao'] ?></td>
                        <td class="d-none d-sm-table-cell"><?= $row['nivel_opcao'] ?></td>
                        <td class="d-none d-lg-table-cell text-truncate" style="max-width: 200px;">
                            <?= $row['url_opcao'] ?>
                        </td>
                        <td>
                            <?php if ($row['status_opcao'] == 'S'): ?>
                            <button class="btn btn-sm btn-success py-1" 
                                    onclick="muda_status('N','<?= $row['id_opcao'] ?>')">
                                <i class="bi bi-check-circle"></i>
                                <span class="d-none d-md-inline">Ativo</span>
                            </button>
                            <?php else: ?>
                            <button class="btn btn-sm btn-danger py-1" 
                                    onclick="muda_status('S','<?= $row['id_opcao'] ?>')">
                                <i class="bi bi-x-circle"></i>
                                <span class="d-none d-md-inline">Inativo</span>
                            </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <button onclick="editar('<?= $row['id_opcao'] ?>')"
                                        class="btn btn-sm btn-primary"
                                        title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button onclick="confirmarExclusao('<?= $row['id_opcao'] ?>')"
                                        class="btn btn-sm btn-danger"
                                        title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function confirmarExclusao(id) {
        if (confirm("Tem certeza que deseja excluir esta opção?")) {
            window.location.href = "excluir_opcao.php?id=" + id;
        }
    }
    </script>
    <script src="../js/opcao.js"></script>
</body>

</html>