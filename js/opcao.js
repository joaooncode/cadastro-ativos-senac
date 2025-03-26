$(document).on('click', '.salvar', function () {
  // Coleta os dados dos campos do modal
  let descricaoOpcao = $("#descricao_opcao").val();
  let idOpcao = $("#id_opcao").val();
  let nivelOpcao = $("#nivel_opcao").val();
  let opcaoSuperior = $("#opcao_superior").val();
  let urlOpcao = $("#url_opcao").val();


  let acao = idOpcao === "" ? "inserir" : "update";

  // Exemplo de requisição AJAX
  $.ajax({
    url: '../controllers/optionsController.php',
    type: 'POST',
    data: {
      acao: acao,
      descricao_opcao: descricaoOpcao,
      id_opcao: idOpcao,
      nivel_opcao: nivelOpcao,
      opcao_superior: opcaoSuperior,
      url_opcao: urlOpcao
    },
    success: function (response) {

      console.log('Sucesso:', response);

    },
    error: function (jqXHR, textStatus, errorThrown) {

      console.error('Erro:', textStatus, errorThrown);
      alert('Ocorreu um erro ao salvar a opção.');
    }
  });
});



function muda_status(status, idOpcao) {
  $.ajax({
    type: "POST",
    url: "../controllers/optionsController.php",
    data: {
      acao: "alterar_status",
      status: status,
      id_opcao: idOpcao,
    },
    success: function (result) {
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
    },
  });
}


function editar(idOpcao) {
  $("#id_opcao").val(idOpcao);
  $.ajax({
    type: "POST",
    url: "../controllers/optionsController.php",
    data: {
      acao: "get_info",
      id_opcao: idOpcao,
    },
    success: function (result) {
      let retorno = JSON.parse(result);
      alert('teste')
      $("#novaOpcaoBtn").click()
      $("#descricao_opcao").val(retorno[0]["descricao_opcao"]);
      $("#url_opcao").val(retorno[0]["url_opcao"]);
      $("#nivel_opcao").val(retorno[0]["nivel_opcao"]);
      $("#id_opcao").val(retorno[0]["id_opcao"]);
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
    },
  });
}


function verificarNivelOpcao(idNivel) {
  const campoSuperior = $("#nivel_opcao_dinamico");
  const selectOpcaoSuperior = $("#opcaoSuperior");
  const labelOpcaoSuperior = $("#labelOpcaoSuperior");

  // Esconde o campo dinâmico e limpa o select
  campoSuperior.hide();
  selectOpcaoSuperior.empty();

  // Verifica o nível selecionado
  if (idNivel == 2) { // Submenu
    labelOpcaoPai.text("Selecione o Menu:");
    buscarOpcoesPai(1); // Busca opções do tipo menu (idNivel = 1)
    campoSuperior.show();
  } else if (idNivel == 3) { // Ação
    labelOpcaoPai.text("Selecione o Submenu:");
    buscarOpcoesPai(2); // Busca opções do tipo submenu (idNivel = 2)
    campoSuperior.show();
  } else { // Menu
    campoSuperior.hide();
  }
}


function buscarOpcaoSuperior(idOpcaoSuperior) {
  $.ajax({
    type: 'POST',
    url: "../controllers/optionsController.php",
    data: {
      acao: 'buscar_opcoes_pai',
      idOpcaoSuperior: idOpcaoSuperior
    },
    success: function (result) {
      let resposta = JSON.parse(result);
      if (resposta.status === 'sucesso') {
        const selectOpcaoPai = $("#opcaoSuperior");
        selectOpcaoPai.empty();
        selectOpcaoPai.append('<option value="">Selecione uma opção</option>');
        resposta.dados.forEach(opcao => {
          selectOpcaoPai.append(`<option value="${opcao.idOpcao}">${opcao.descricaoOpcao}</option>`);
        });
      } else {
        alert('Erro: ' + resposta.mensagem);
      }
    },
    error: function (xhr, status, error) {
      alert('Erro na requisição: ' + error);
    }
  });
}


function limpar_modal() {
  $("#descricao_opcao").val("");
  $("#id_opcao").val("");
  $("#url_opcao").val("");
  $("#nivel_opcao").val("");
}
