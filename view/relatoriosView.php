<?php

include_once('../controllers/sessionController.php');
include_once('../models/connect_db.php');
include_once('../controllers/functionsController.php');
include_once('headView.php');
include_once('dropdownView.php');






$ativos = fetchData($conn, 'ativo', 'statusAtivo', 'S');
$marcas = fetchData($conn, 'marca', 'statusMarca', 'S');
$tipos = fetchData($conn, 'tipo', 'statusTipo', 'S');
$usuarios = fetchData($conn, 'usuario', 'statusUsuario', 'Ativo');

?>

<body style="width: 100vw; height: 100vh;">

    <h1 class='text-center text-primary mb-5'>Relatórios</h1>
    <div class="container w-100">
        <div class="form-container container mt-5 w-100vw">
            <form action="resultadoRelatorioView.php" method="post"
                class="d-flex align-items-center justify-content-center w-100vw">
                <div style="margin-right:2rem">
                    <select name="ativo" class="form-select mb-4 w-100" aria-label="Default select example">
                        <option value="" selected>Ativo</option>
                        <?php
                        foreach ($ativos as $ativo => $value) {
                            echo '<option value ="' . $value['idAtivo'] . '">' . $value['descricaoAtivo'] . '</option>';

                        }
                        ?>
                    </select>
                    <select name="marca" class="form-select mb-4 w-100" aria-label="Default select example">
                        <option value='' selected>Marca</option>
                        <?php
                        foreach ($marcas as $marca => $value) {
                            echo '<option value ="' . $value['idMarca'] . '">' . $value['descricaoMarca'] . '</option>';

                        }
                        ?>
                    </select>
                    <select name="usuario" class="form-select mb-4 w-100" aria-label="Default select example">
                        <option value="" selected>Usuário Responsável Pela Movimentação</option>
                        <?php
                        foreach ($usuarios as $usuario => $value) {
                            echo '<option value ="' . $value['idUsuario'] . '">' . $value['nomeUsuario'] . '</option>';

                        }
                        ?>
                    </select>
                    <button class="btn btn-primary">Gerar Relatório</button>
                </div>
                <div>
                    <div class="row mb-4">
                        <div class="col">
                            <input name="dataInicio" type="date" class="form-control" placeholder="Data Inicianal"
                                aria-label="First name">
                        </div>
                        <div class="col">
                            <input name="dataFim" type="date" class="form-control" placeholder="Data Final"
                                aria-label="Last name">
                        </div>
                    </div>
                    <select name="tipo" class="form-select mb-4 w-100" aria-label="Default select example">
                        <option value="" selected>Tipo</option>
                        <?php
                        foreach ($tipos as $tipo => $value) {
                            echo '<option value ="' . $value['idTipo'] . '">' . $value['descricaoTipo'] . '</option>';

                        }
                        ?>
                    </select>
                    <select name="tipoMovimentacao" class="form-select mb-4 w-100" aria-label="Default select example">
                        <option value="" selected>Tipo de Movimentação</option>
                        <option value="adicionar">Adicionar</option>
                        <option value="remover">Remover</option>
                        <option value="realocar">Realocar</option>
                    </select>
                    <button class="btn btn-secondary">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</body>