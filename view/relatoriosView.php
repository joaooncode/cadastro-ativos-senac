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
<body class="d-flex flex-column min-vh-100">
    <div class="container flex-grow-1 py-5">
        <h1 class='text-center text-primary mb-4 mb-md-5'>Relatórios</h1>
        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <form action="resultadoRelatorioView.php" method="post" class="bg-white p-4 rounded-3 shadow">
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ativo</label>
                                <select name="ativo" class="form-select">
                                    <option value="" selected>Selecione um ativo</option>
                                    <?php foreach ($ativos as $value): ?>
                                    <option value="<?= $value['idAtivo'] ?>"><?= $value['descricaoAtivo'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Marca</label>
                                <select name="marca" class="form-select">
                                    <option value='' selected>Selecione uma marca</option>
                                    <?php foreach ($marcas as $value): ?>
                                    <option value="<?= $value['idMarca'] ?>"><?= $value['descricaoMarca'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Usuário</label>
                                <select name="usuario" class="form-select">
                                    <option value="" selected>Selecione um usuário</option>
                                    <?php foreach ($usuarios as $value): ?>
                                    <option value="<?= $value['idUsuario'] ?>"><?= $value['nomeUsuario'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Período</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input name="dataInicio" type="date" class="form-control" aria-label="Data inicial">
                                    </div>
                                    <div class="col-6">
                                        <input name="dataFim" type="date" class="form-control" aria-label="Data final">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select name="tipo" class="form-select">
                                    <option value="" selected>Selecione um tipo</option>
                                    <?php foreach ($tipos as $value): ?>
                                    <option value="<?= $value['idTipo'] ?>"><?= $value['descricaoTipo'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tipo de Movimentação</label>
                                <select name="tipoMovimentacao" class="form-select">
                                    <option value="" selected>Selecione o tipo</option>
                                    <option value="adicionar">Adicionar</option>
                                    <option value="remover">Remover</option>
                                    <option value="realocar">Realocar</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row g-2 mt-2">
                        <div class="col-12 col-md-6">
                            <button type="submit" class="btn btn-primary w-100">
                                Gerar Relatório
                            </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="reset" class="btn btn-outline-secondary w-100">
                                Limpar Filtros
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>