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

<body class="min-vw-100 min-vh-100 overflow-hidden">
    <div class="container min-vh-100 min-vw-100 d-flex align-content-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container mb-5 w-100">
                <div class="d-flex flex-column justify-content-evenly align-items-center">
                    <h1 class="text-center text-primary">Marcas</h1>
                    <button id="cadastrarMarcaBtn" onclick="limpar_modal()" style="width: 100%; max-width: 200px;"
                        type="button" class="btn btn-outline-primary mt-3 mb-3 p-3" data-bs-toggle="modal"
                        data-bs-target="#cadastrarMarca">Cadastrar Marca
                    </button>
                </div>
                <div class="container w-100 overflow-auto">
                    <table class="table  table-bordered border-dark mt-5">
                        <thead class="table table-dark">
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
                                        <?php echo $value['descricaoMarca'] ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $value['idUsuario'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['dataCadastroMarca'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?php echo $value['statusMarca'] ?>
                                    </p>
                                </td>
                                <td>
                                    <div class="actions d-flex justify-content-evenly">
                                        <button id="editBrand" data-bs-toggle="modal" data-bs-target="#cadastrarMarca"
                                            onclick="editar('<?php echo $value['idMarca']; ?>')"
                                            class="mx-2 btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <div class="changeStatus">
                                            <?php
                                                if ($value['statusMarca'] == "S") {
                                                    ?>
                                            <button id="activeBrand"
                                                onclick="muda_status('N','<?php echo $value['idMarca']; ?>')"
                                                class=" btn btn-success">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                            <?php
                                                } else {
                                                    ?>
                                            <button id="inactiveBrand"
                                                onclick="muda_status('S','<?php echo $value['idMarca']; ?>')"
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
                </div>
            </div>

        </main>
    </div>
    <script src="../js/marcas.js"></script>
</body>