<?php

include_once('../controllers/sessionController.php');
include_once('../models/connect_db.php');
include_once('../controllers/functionsController.php');
include_once('headView.php');
include_once('dropdownView.php');

?>

<body style="width: 100vw; height: 100vh;">

    <h1 class='text-center text-primary mb-5'>Relatórios</h1>
    <div class="container w-100">
        <div class="form-container container mt-5 w-100vw">
            <form action="" class="d-flex align-items-center justify-content-center w-100vw">
                <div style="margin-right:2rem">
                    <select class="form-select mb-4 w-100" aria-label="Default select example">
                        <option selected>Ativo</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="form-select mb-4 w-100" aria-label="Default select example">
                        <option selected>Marca</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="form-select mb-4 w-100" aria-label="Default select example">
                        <option selected>Usuário Responsável Pela Movimentação</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <button class="btn btn-primary">Gerar Relatório</button>
                </div>
                <div>
                    <div class="row mb-4">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Data Inicianal"
                                aria-label="First name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Data Final" aria-label="Last name">
                        </div>
                    </div>
                    <select class="form-select mb-4 w-100" aria-label="Default select example">
                        <option selected>Tipo</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="form-select mb-4 w-100" aria-label="Default select example">
                        <option selected>Tipo de Movimentação</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <button class="btn btn-secondary">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</body>