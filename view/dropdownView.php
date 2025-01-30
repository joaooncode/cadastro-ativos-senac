<?php
include_once('headView.php');

?>

<body class="min-vh-100 min-vw-100 overflow-x-hidden position-relative">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fs-4 mb-5 position-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://api.senacrs.com.br/bff/site-senac/v1/file/078f143692e591ec20623efea089cdf3d19a24.png"
                    alt="logo-senac" height="45" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav flex-grow-1 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link link-primary" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-primary" href="moveView.php">Movimentações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-primary" href="relatoriosView.php">Relatórios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-primary" href="brandView.php">Marcas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-primary" href="typesView.php">Tipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-primary" href="registerAssetsView.php">Ativos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="dropdown" class="nav-link link-primary dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Usuário
                        </a>
                        <ul id="dropdown-menu" class="dropdown-menu">
                            <li><a class="dropdown-item link-primary" href="registerUserView.php">Cadastrar usuário</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item link-primary" href="listUsersView.php">Listar Usuário</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Botão de fechar alinhado à direita -->
                <form action="../controllers/logoutController.php" method="post">
                    <button id="signOut" type="submit" class="btn btn-lg btn-outline-primary mx-5 ms-auto">
                        <i class="fa fa-close"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>