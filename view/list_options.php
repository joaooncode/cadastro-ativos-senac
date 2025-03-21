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

<body class="d-flex flex-column bg-light w-vw-100 min-vh-100 overflow-hidden">
    <div class="container mt-3">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="text-primary">Controle de Opções</h1>
            <button class="btn btn-primary" onclick="" data-bs-toggle="modal"
                data-bs-target="#novaOpcao">Nova Opção</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">URL</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum registro encontrado</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?php echo $row['id_opcao']; ?></td>
                                <td><?php echo $row['descricao_opcao']; ?></td>
                                <td><?php echo $row['nivel_opcao']; ?></td>
                                <td><?php echo $row['url_opcao']; ?></td>
                                <td>
                                    <?php if ($row['status_opcao'] == 1): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="editar_opcao.php?id=<?php echo $row['id_opcao']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="javascript:void(0)" onclick="confirmarExclusao(<?php echo $row['id_opcao']; ?>)" class="btn btn-danger btn-sm">Excluir</a>
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