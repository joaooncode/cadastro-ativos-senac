<?php
include_once('head.php');
include_once('../controllers/session.php');
include_once('modal.php');
include_once('navbar.php');
?>

<body class="min-vw-100 min-vh-100">
    <main class="vw-100 vh-100 d-flex align-items-center justify-content-center">
        <!--Tabela ativos cadastrados-->
        <div class="container mb-5 w-100">
            <table class="table table-bordered border-primary mt-5">
                <thead>
                    <th scope="col">
                        Descrição
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Marca
                    </th>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Tipo
                    </th>
                </thead>
            </table>
        </div>
    </main>
</body>
<script src="../js/ativos.js"></script>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Abrir modal</button>