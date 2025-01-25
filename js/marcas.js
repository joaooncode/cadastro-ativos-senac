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
      url: "../controllers/brandsController.php",
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

function muda_status(status, idMarca) {
  $.ajax({
    type: "POST",
    url: "../controllers/brandsController.php",
    data: {
      acao: "alterar_status",
      status: status,
      idMarca: idMarca,
    },
    success: function (result) {
      //console.log(result)
      //alert(result);
      location.reload();
    },
  });
}

function editar(idMarca) {
  $("#idMarca").val(idMarca);
  $.ajax({
    type: "POST",
    url: "../controllers/brandsController.php",
    data: {
      acao: "get_info",
      idMarca: idMarca,
    },
    success: function (result) {
      console.log(result);

      retorno = JSON.parse(result);
      $("#cadastrarMarcaBtn").click();

      $("#marca").val(retorno[0]["descricaoMarca"]);
      $("#idMarca").val(retorno[0]["idMarca"]);

      console.log(retorno);
    },
  });
}
function limpar_modal() {
  $("#marca").val("");
  $("#idMarca").val("");
}
