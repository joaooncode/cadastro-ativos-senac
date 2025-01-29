<div class="modal fade" id="cadastrarMovimentacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Cadastrar Movimentação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="ativo" class="col-form-label"><span class="text-danger">*</span>Ativo</label>
                    <select required id="ativo" class="form-select" aria-label="Default select example">
                        <?php
                        foreach ($ativos as $ativo => $value) {
                            echo '<option value ="' . $value['idAtivo'] . '">' . $value['descricaoAtivo'] . '</option>';

                        }
                        ?>

                    </select>
                    <label for="tipoMovimentacao" class="col-form-label"><span class="text-danger">*</span>Tipo</label>
                    <select class="form-select" aria-label="Default select example" name="tipoMovimentacao"
                        id="tipoMovimentacao">
                        <option id="entrada" name="entrada" value="entrada">Entrada</option>
                        <option id="remover" name="remover" value="remover">Remover</option>
                        <option id="realocar" name="realocar" value="realocar">Realocar</option>
                    </select>
                    </select>
                    <label for="quantidade" class="col-form-label"><span class="text-danger">*</span>Quantidade</label>
                    <input type="text" class="form-control" name="quantidadeMovimentacao" id="quantidadeMovimentacao">
                    <label for="localOrigem" class="col-form-label">Local Origem</label>
                    <input type="text" class="form-control" name="localOrigem" id="localOrigem">
                    <label for="localDestino" class="col-form-label">Local Destino</label>
                    <input type="text" class="form-control" name="localDestino" id="localDestino">
                    <label for="descricao" class="col-form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricaoMovimentacao" id="descricaoMovimentacao">
                </div>
                <p class="text-danger">* Campos Obrigatórios</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary salvar">Salvar</button>
            </div>
        </div>
    </div>
</div>
</div>