<?php

include('../models/connect_db.php');
include('../controllers/functions.php');
include('navbar.php');


$users = fetchData($conn, 'usuario');

?>

<!doctype html>
<title>Listar usuários</title>
<html lang="pt-br">

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
                                <a class="nav-link link-primary active" href="list_users.php">Listar Usuário</a>
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
        <!--Tabela usuários cadastrados-->
        <div class=" container mb-5 w-100">
            <h1 class="text-center text-primary">Lista de usuários</h1>
            <table class="table table-bordered border-primary mt-5">
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
                                        href="./patch_user.php?idUsuario=<?php echo $value['idUsuario'] ?>">
                                        <?php echo $value['nomeUsuario'] ?>
                                    </a>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <a class=" link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover"
                                        href="./patch_user.php?idUsuario=<?php echo $value['idUsuario'] ?>">
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
</body>

</html>