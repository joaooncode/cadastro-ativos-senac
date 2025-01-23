$(document).ready(function () {
  $(".salvar").click(function () {
    let marca = $("#marca").val();
    let idMarca = $("#idMarca").val();

    if (idMarca == "") {
      acao = "inserir";
    } else {
      acao = "update";
    }

    //alert(descricao_ativo);
    $.ajax({
      type: "POST",
      url: "../controllers/brands.php",
      data: {
        acao: acao,
        marca: marca,
        idMarca: idMarca,
      },
      success: function (result) {
        //alert(result);
        location.reload();
      },
    });
  });
});

function muda_status(status, idAtivo) {
  $.ajax({
    type: "POST",
    url: "../controllers/assets.php",
    data: {
      acao: "alterar_status",
      status: status,
      idAtivo: idAtivo,
    },
    success: function (result) {
      //console.log(result)
      //alert(result);
      location.reload();
    },
  });
}

function editar(idAtivo) {
  $("#idAtivo").val(idAtivo);
  $.ajax({
    type: "POST",
    url: "../controllers/assets.php",
    data: {
      acao: "get_info",
      idAtivo: idAtivo,
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
