<?php

include_once('../models/connect_db.php');
include_once('../controllers/functions.php');
include_once('head.php');
include_once('dropdown.php');
include_once('../controllers/session.php');


$users = fetchData($conn, 'usuario');

?>

<body class="min-vw-100 min-vh-100">
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