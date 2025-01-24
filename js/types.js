$(document).ready(function () {
  $(".salvar").click(function () {
    let tipo = $("#tipo").val();
    let idTipo = $("#idTipo").val();

    if (idTipo == "") {
      acao = "inserir";
    } else {
      acao = "update";
    }

    //alert(descricao_ativo);
    $.ajax({
      type: "POST",
      url: "../controllers/types.php",
      data: {
        acao: acao,
        tipo: tipo,
        idTipo: idTipo,
      },
      success: function (result) {
        //alert(result);
        location.reload();
      },
    });
  });
});

function muda_status(status, idTipo) {
  $.ajax({
    type: "POST",
    url: "../controllers/types.php",
    data: {
      acao: "alterar_status",
      status: status,
      idTipo: idTipo,
    },
    success: function (result) {
      //console.log(result)
      //alert(result);
      location.reload();
    },
  });
}

function editar(idTipo) {
  $("#idTipo").val(idTipo);
  $.ajax({
    type: "POST",
    url: "../controllers/types.php",
    data: {
      acao: "get_info",
      idTipo: idTipo,
    },
    success: function (result) {
      retorno = JSON.parse(result);
      $("#btn_modal").click();

      $("#ativo").val(retorno[0]["descricaoAtivo"]);
      $("#marca").val(retorno[0]["idMarca"]);
      $("#tipo").val(retorno[0]["idTipo"]);
      $("#quantidade").val(retorno[0]["observacaoAtivo"]);
      $("#observacao").val(retorno[0]["quantidadeAtivo"]);

      console.log(retorno);
    },
  });
}
function limpar_modal() {
  $("#ativo").val("");
  $("#marca").val("");
  $("#tipo").val("");
  $("#quantidade").val("");
  $("#observacao").val("");
  $("#idAtivo").val("");
}
