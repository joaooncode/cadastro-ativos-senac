<!-- Modal para exibir informações do ativo -->
<div class="modal fade" id="infoAtivo" tabindex="-1" aria-labelledby="infoAtivoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoAtivoLabel">Informações do Ativo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Descrição:</strong> <span id="infoDescricao"></span></p>
        <p><strong>Quantidade:</strong> <span id="infoQuantidade"></span></p>
        <p><strong>Quantidade Mínima:</strong> <span id="infoQuantidadeMinima"></span></p>
        <p><strong>Quantidade em Uso:</strong> <span id="infoQuantidadeUso"></span></p>
        <p><strong>Marca:</strong> <span id="infoMarca"></span></p>
        <p><strong>Status:</strong> <span id="infoStatus"></span></p>
        <p><strong>Tipo:</strong> <span id="infoTipo"></span></p>
        <p><strong>Observação:</strong> <span id="infoObservacao"></span></p>
        <p><strong>Imagem:</strong></p>
        <img id="infoImagem" src="" alt="Imagem do Ativo" style="max-width: 100%; height: auto;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>