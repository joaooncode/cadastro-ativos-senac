<?php
include_once('../view/headView.php');
//include_once('../dropdownView.php');
include_once('../controllers/sessionController.php');


?>



<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Atualizar ativo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="updateDescription" class="col-form-label">Descrição:</label>
                        <input type="text" class="form-control" id="updateDescription">
                    </div>
                    <div class="mb-3">
                        <label for="updateQuantity" class="col-form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="updateQuantity">
                    </div>
                    <div class="mb-3">
                        <label for="updateObs" class="col-form-label">Observação:</label>
                        <textarea class="form-control" id="updateObs"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Limpar</button>
                <button type="button" class="btn btn-primary">Atualizar</button>
            </div>
        </div>
    </div>
</div>