$(document).ready(function () {
  $(".salvar").click(function () {
    let marca = $("#marca").val();
    let idMarca = $("#idMarca").val();

    // Verifica se o campo obrigatório está preenchido
    if (!marca) {
      alert("Por favor, preencha o campo Marca.");
      $("#marca").addClass("is-invalid");
      return;
    } else {
      $("#marca").removeClass("is-invalid");
    }

    let acao = idMarca === "" ? "inserir" : "update";

    $.ajax({
      type: "POST",
      url: "../controllers/brandsController.php",
      data: {
        acao: acao,
        marca: marca,
        idMarca: idMarca,
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
      alert(result);
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
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
      let retorno = JSON.parse(result);
      $("#cadastrarMarcaBtn").click();
      $("#marca").val(retorno[0]["descricaoMarca"]);
      $("#idMarca").val(retorno[0]["idMarca"]);
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", error);
    },
  });
}

function limpar_modal() {
  $("#marca").val("");
  $("#idMarca").val("");
}
