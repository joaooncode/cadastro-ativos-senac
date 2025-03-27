$(document).on('click', '.salvar', function () {
  // Coleta os dados dos campos do modal
  let descricaoOpcao = $("#descricao_opcao").val();
  let idOpcao = $("#id_opcao").val();
  let nivelOpcao = $("#nivel_opcao").val();
  let urlOpcao = $("#url_opcao").val();
  let nivel_superior = $("#nivel_superior").val();


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
      nivel_superior: nivel_superior,
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



function buscarOpcaoSuperior(id_superior = false) {
  let nivel_opcao = $('#nivel_opcao').val();
  if (nivel_opcao == 1 || nivel_opcao == '') {
    $('#div_superior').attr('style', 'display:none')
  } else {

    nivel_opcao = nivel_opcao - 1;
    $.ajax({
      type: 'POST',
      url: "../controllers/optionsController.php",
      data: {
        acao: 'buscar_opcoes_pai',
        nivel_opcao: nivel_opcao
      },
      success: function (result) {
        let resposta = JSON.parse(result);
        let select = `<select class="form-select" id="nivel_superior">
                        <option value="">Selecione o nível superior</option>
                        `
        $(resposta).each(function (index, element) {
          if (id_superior == element.idOpcao) {
            select += '<option value="' + element.id_opcao + '" selected>' + element.descricao_opcao + '</option>'
          } else {
            select += '<option value="' + element.id_opcao + '">' + element.descricao_opcao + '</option>'
          }

        })
        select += '</select>';
        $('#select').html(select);
      },

      error: function (xhr, status, error) {
        alert('Erro na requisição: ' + error);
      }
    });

    $('#div_superior').attr('style', 'display:block')


  }
  return


}


function limpar_modal() {
  $("#descricao_opcao").val("");
  $("#id_opcao").val("");
  $("#url_opcao").val("");
  $("#nivel_opcao").val("");
}
