<?php
include_once('dropdown.php');
include_once('head.php');

include_once('../controllers/session.php');
include_once('../controllers/functions.php');
include_once('../models/connect_db.php');

include_once('../controllers/types.php');


include_once('modal/types_modal.php');
/* include_once('./modal/update_types.php'); */

$brand = fetchData($conn, 'tipo');

?>

<body class="min-vw-100 min-vh-100 overflow-hidden">
    <div class="container min-vh-100 min-vw-100 d-flex align-content-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container mb-5 w-100">
                <div class="d-flex flex-column justify-content-evenly align-items-center">
                    <h1 class="text-center text-primary">Tipos</h1>
                    <button id="cadastrarTipoBtn" onclick="limpar_modal()" style="width: 100%; max-width: 200px;"
                        type="button" class="btn btn-outline-primary mt-3 mb-3 p-3" data-bs-toggle="modal"
                        data-bs-target="#typesModal">Cadastrar Tipo</button>
                </div>
                <table class="table table-bordered  border-primary mt-5">
                    <thead>
                        <th scope="col">
                            Descrição
                        </th>
                        <th scope="col">
                            Usuário de cadastro
                        </th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($brand as $row => $value) {
                            ?>
                            <tr>

                                <td>
                                    <p>
                                        <?php echo $value['descricaoTipo'] ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $value['idUsuario'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['dataCadastroTipo'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['statusTipo'] ?>
                                    </p>
                                </td>

                                <td>
                                    <div class="actions d-flex justify-content-evenly">
                                        <button id="editType" data-bs-toggle="modal" data-bs-target="updateTypes"
                                            onclick="editar('<?php echo $value['idTipo']; ?>')"
                                            class="mx-2 btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <div class="changeStatus">
                                            <?php
                                            if ($value['statusTipo'] == "Ativo") {
                                                ?>
                                                <button id=" activeType"
                                                    onclick="changeStatus('Inativo','<?php echo $value['idTipo']; ?>')"
                                                    class=" btn btn-success">
                                                    <i class="bi bi-toggle-on"></i>
                                                </button>
                                                <?php
                                            } else {
                                                ?>
                                                <button id="inactiveType"
                                                    onclick="changeStatus('Ativo','<?php echo $value['idTipo']; ?>')"
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

                    </tbody>
                </table>
            </div>

        </main>
    </div>
    <script src="../js/types.js"></script>
</body>