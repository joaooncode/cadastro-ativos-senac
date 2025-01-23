<?php
include_once('dropdown.php');
include_once('head.php');

include_once('../controllers/session.php');
include_once('../controllers/functions.php');
include_once('../models/connect_db.php');

include_once('../controllers/brands.php');


include_once('modal/modal_marca.php');


$brand = fetchData($conn, 'marca');

?>

<body class="min-vw-100 min-vh-100 overflow-hidden">
    <div class="container min-vh-100 min-vw-100 d-flex align-content-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container mb-5 w-100">
                <div class="d-flex flex-column justify-content-evenly align-items-center">
                    <h1 class="text-center text-primary">Marcas</h1>
                    <button id="cadastrarAtivoBtn" onclick="limparModal()" style="width: 100%; max-width: 200px;"
                        type="button" class="btn btn-outline-primary mt-3 mb-3 p-3" data-bs-toggle="modal"
                        data-bs-target="#updateModal">Cadastrar Marca</button>
                </div>
                <table class="table table-bordered  border-primary mt-5">
                    <thead>
                        <th scope="col">
                            Descrição
                        </th>
                        <th scope="col">
                            Usuário de cadastro
                        </th>
                        <th scope="col">
                            Ações
                        </th>
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
    <script src="../js/marcas.js"></script>
</body>