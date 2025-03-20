<div class="modal fade" id="novaOpcao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Cadastrar Nova Opção</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="descricao_opcao" class="col-form-label">Descrição Opção <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="descricao_opcao">
                    <input type="hidden" class="form-control" id="id_opcao">

                </div>
                <div class="mb-3">
                    <label for="nivel_opcao" class="col-form-label">Nivel Opção <span class="text-danger">*</span></label>
                    <select name="" id="nivel_opcao" class="form-select">
                        <option value="" disabled selected>Selecione o nível da opção</option>
                        <?php
                                foreach ($levels as $value) {
                                    echo '<option value ="' . $value['id_nivel'] . '">' . $value['descricao_nivel'] . '</option>';
                                }

                                ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="opcao_superior">Opção Superior</label>
                    <select name="" id="opcao_superior" class="form-select">
                        <option value="" disabled selected>Selecione a opção superior</option>
                        <option value="" disabled selected>Selecione o nível da opção</option>
                        <option id="menu" value="menu">Menu</option>
                        <option id="submenu" value="submenu">Submenu</option>
                        <option id="acao" value="acao">Ação</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="url_opcao">URL</label>
                    <input type="text" class="form-control" id="url_opcao">
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