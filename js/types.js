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
      url: "../controllers/typesController.php",
      data: {
        acao: acao,
        tipo: tipo,
        idTipo: idTipo,
      },
      success: function (result) {
        alert(result);
        location.reload();
      },
    });
  });
});

function muda_status(status, idTipo) {
  $.ajax({
    type: "POST",
    url: "../controllers/typesController.php",
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
    url: "../controllers/typesController.php",
    data: {
      acao: "get_info",
      idTipo: idTipo,
    },
    success: function (result) {
      retorno = JSON.parse(result);
      $("#cadastrarTipoBtn").click();

      $("#tipo").val(retorno[0]["descricaoTipo"]);
      $("#idTipo").val(retorno[0]["idTipo"]);

      console.log(retorno);
    },
  });
}
function limpar_modal() {
  $("#tipo").val("");
  $("#idTipo").val("");
}
