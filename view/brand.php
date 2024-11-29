<?php
include_once('dropdown.php');
include_once('head.php');
include_once('../controllers/session.php');
include_once('../models/connect_db.php');
include_once('../controllers/functions.php');
include_once('modal_brand.php');


$brand = fetchData($conn, 'marca');

?>

<body class="min-vw-100 min-vh-100 overflow-hidden">
    <div class="container min-vh-100 min-vw-100 d-flex align-content-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container mb-5 w-100">
                <h1 class="text-center text-primary">Marcas</h1>
                <table class="table table-bordered  border-primary mt-5">
                    <thead>
                        <th scope="col">
                            Descrição
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
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                    </tbody>
                </table>
            </div>
            <button data-bs-toggle="modal" class="btn btn-outline-primary btn-lg p-4">Cadastrar marca</button>
        </main>
    </div>
</body>