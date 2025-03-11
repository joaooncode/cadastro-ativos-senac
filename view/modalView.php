<?php
include_once('headView.php');
?>


<!--MODAL CADASTRO DE ATIVOS-->

<form id="form">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Ativo</h1>
                    <button onclick="clearModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form type="submit" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Descrição:</label>
                            <input required type="text" class="form-control" id="description">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="col-form-label">Quantidade:</label>
                            <input required type="number" class="form-control" id="quantity"></input>
                        </div>
                        <div class="mb-3">
                            <label for="quantityMin" class="col-form-label">Quantidade Minima:</label>
                            <input required type="number" class="form-control" id="quantityMin"></input>
                        </div>
                        <div class="mb-3">
                            <label for="observation" class="col-form-label">Observação:</label>
                            <textarea type="text" class="form-control" id="observation"></textarea>
                        </div>
                        <div class="mb-3" id="reason-change-div" style="display: none;">
                            <label for="reasonChange" class="col-form-label">Motivo da alteração:</label>
                            <textarea type="text" class="form-control" id="reasonChange"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="brand">Marca:</label>
                            <select required id="brand" class="form-select" aria-label="Default select example">
                                <option value="" selected>Selecione uma marca</option>
                                <?php
                                foreach ($brands as $brand => $value) {
                                    echo '<option value ="' . $value['idMarca'] . '">' . $value['descricaoMarca'] . '</option>';
                                }

                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type">Tipo:</label>
                            <select required id="type" class="form-select" aria-label="Default select example">
                                <option value="" selected>Selecione um tipo</option>
                                <?php
                                foreach ($types as $type => $value) {
                                    echo '<option value="' . $value['idTipo'] . '">' . $value['descricaoTipo'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Inserir Imagem</label>
                            <input class="form-control" accept="image/png, image/jpeg" type="file" name="imagem_ativo"
                                id="imagem_ativo">
                        </div>
                        <div class="mb-3 preview" style="display:none">
                            <label for="formFile" class="form-label">Imagem Preview</label>
                            <img style="width: 150px; position: relative; left: 20%" src="" alt="" id="imagemPreview">
                        </div>
                    </div>
                    <input id='idAsset' type="hidden">
                </form>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" id="clear-btn">Limpar</button>
                    <button type="button" class="btn btn-primary" id="save-btn">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>