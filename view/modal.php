<?php
include_once('head.php');
?>


<!--MODAL CADASTRO DE ATIVOS-->

<form id="register" type="submit">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Ativo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Descrição:</label>
                            <input required type="text" class="form-control" id="description">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="col-form-label">Quantidade:</label>
                            <input required type="number" class="form-control" id="quantity"></input>
                        </div>
                        <div class="mb-3">
                            <label for="observation" class="col-form-label">Observação:</label>
                            <textarea type="text" class="form-control" id="observation"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status">Status:</label>
                            <select required id="status" class="form-select" aria-label="Default select example">
                                <option class="selected">Informe o status do ativo:</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Em transferência">Em transferência</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand">Marca:</label>
                            <select required id="brand" class="form-select" aria-label="Default select example">
                                <option class="selected">Selecione a marca:</option>
                                <option value="Dell">Dell</option>
                                <option value="Lenovo">Lenovo</option>
                                <option value="Positivo">Positivo</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type">Tipo:</label>
                            <select required id="type" class="form-select" aria-label="Default select example">
                                <option class="selected">Selecione o tipo do ativo:</option>
                                <option value="Ferramenta">Ferramenta</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Software">Software</option>
                                <option value="Redes">Redes</option>
                                <option value="Miscelânea">Miscelânea</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" id="clear-btn">Limpar</button>
                    <button type="submit" class="btn btn-primary" id="save-btn">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>