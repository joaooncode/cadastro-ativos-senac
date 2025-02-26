$(document).ready(function () {
  $(".salvar").click(function () {
    let tipo = $("#tipo").val();
    let idTipo = $("#idTipo").val();

    // Verifica se o campo obrigatório está preenchido
    if (!tipo) {
      alert("Por favor, preencha o campo Tipo.");
      $("#tipo").addClass("is-invalid");
      return;
    } else {
      $("#tipo").removeClass("is-invalid");
    }

    let acao = idTipo === "" ? "inserir" : "update";

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
      error: function (xhr, status, error) {
        console.error("Erro na requisição:", error);
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
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
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
      let retorno = JSON.parse(result);
      $("#cadastrarTipoBtn").click();
      $("#tipo").val(retorno[0]["descricaoTipo"]);
      $("#idTipo").val(retorno[0]["idTipo"]);
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
    },
  });
}

function limpar_modal() {
  $("#tipo").val("");
  $("#idTipo").val("");
}
