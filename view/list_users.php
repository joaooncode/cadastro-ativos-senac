<?php

include('../models/connect_db.php');
include('../controllers/functions.php');


$users = fetchData($conn, 'usuario');



?>


<!doctype html>
<html lang="en">

<head>
    <title>Listar Usuários</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!--Link css-->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="min-vw-100 min-vh-100">
    <header>
        <!-- place navbar here -->
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary fs-5 shadow p-3 mb-5 bg-body-tertiary rounded fixed-top"
                data-bs-theme="light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="https://api.senacrs.com.br/bff/site-senac/v1/file/078f143692e591ec20623efea089cdf3d19a24.png"
                            alt="logo-senac" height="45" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link link-primary" aria-current="page" href="./index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" href="#">Listar Ativos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary active" href="./list_users.php">Listar Usuário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" href="#">Cadastrar Ativo</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
        <div class=" container mb-5 w-100">
            <h1 class="text-center text-primary">Lista de usuários</h1>
            <table class="table table-striped table-bordered mt-5">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Turma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value['idUsuario'] ?>
                            </td>
                            <td>
                                <p>
                                    <a class="link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover"
                                        href="./patch_user.php?idUsuario=<?php echo $value['nomeUsuario'] ?>">
                                        <?php echo $value['nomeUsuario'] ?>
                                    </a>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <a class=" link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover"
                                        href="./patch_user.php?idUsuario=<?php echo $value['nomeUsuario'] ?>">
                                        <?php echo $value['turmaUsuario'] ?>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>