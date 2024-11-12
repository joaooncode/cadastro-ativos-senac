<?php

include('../models/connect_db.php');
include('../controllers/functions.php');

// id do usuário a ser alterado
$id = $_GET['idUsuario'];


$query_db = fetchData($conn, 'usuario', 'idUsuario', $id);

foreach ($query_db as $key => $value) {
    # code...
    $nome = $value['nomeUsuario'];
    $turma = $value['turmaUsuario'];
    $idUsuario = $value['idUsuario'];
}


//$sql = "UPDATE usuario SET nomeUsuario='$updateName' SET turmaUsuario='$$updateClass' WHERE id=$id";

?>


<!doctype html>
<html lang="pt-br">

<head>
    <title>Alteração de usuário</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="min-vw-100 min-vh-100 overflow-hidden">

    <header>
        <!-- Navbar -->
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
                                <a class="nav-link link-primary" href="">Listar Ativos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-primary" href="./list_users.php">Listar Usuário</a>
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

    <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column mt-5 pt-5">
        <h1 class="text-center text-primary mb-3">Alterar usuário</h1>
        <hr class="border border-primary border-3 opacity-25 w-100 mb-4">

        <!-- Formulário -->
        <div class="container w-100 h-100 mt-5">

            <form action="../controllers/patch_user.php" method="POST"
                class="w-100 d-flex flex-column justify-content-center align-items-center">
                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                <div class="mb-3">
                    <label for="nomeUsuario" class="form-label">Nome</label>
                    <input type="text" value="<?php echo $nome ?>" class="form-control w-100" id="nomeUsuario"
                        name="nomeUsuario" required />
                </div>
                <div class="mb-3">
                    <label for="turmaUsuario" class="form-label">Turma</label>
                    <input type="text" value="<?php echo $turma ?>" class=" form-control w-100" id="turmaUsuario"
                        name="turmaUsuario" required />
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary py-2 px-4 w-100">Alterar</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-5 py-3 text-center">
        <!-- Add footer content here if needed -->
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>