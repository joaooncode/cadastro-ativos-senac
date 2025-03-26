<?php

include_once('../controllers/sessionController.php');
include_once('../models/connect_db.php');
include_once('../controllers/functionsController.php');
include_once('headView.php');
include_once('dropdownView.php');


$users = fetchData($conn, 'usuario');




?>

<body class="min-vh-100">
    <main class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <h1 class="text-center text-primary mb-4 mb-md-5">Lista de usuários</h1>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-nowrap">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col" class="d-none d-md-table-cell">Turma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user => $value) { ?>
                                <tr>
                                    <td class="fw-bold"><?= $value['idUsuario'] ?></td>
                                    <td>
                                        <a class="link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover" 
                                           href="patchUserView.php?idUsuario=<?= $value['idUsuario'] ?>">
                                            <?= $value['nomeUsuario'] ?>
                                        </a>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a class="link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover" 
                                           href="patchUserView.php?idUsuario=<?= $value['idUsuario'] ?>">
                                            <?= $value['turmaUsuario'] ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>