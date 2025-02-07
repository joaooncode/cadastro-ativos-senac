$(document).ready(function () {
  $("#save-btn").click(function () {
    //const form = $("#form")[0];
    // alert("teste");
    // verifica se o formulário está preenchido

    const description = $("#description").val();
    const quantity = $("#quantity").val();
    const obs = $("#observation").val();
    const status = $("#status").val();
    const brand = $("#brand").val();
    const type = $("#type").val();
    const idAsset = $("#idAsset").val();

    const imgAtivo = $("#imagem_ativo");
    const img = imgAtivo[0].files[0];

    let action = "";
    console.log(idAsset);

    if (idAsset == "") {
      action = "insert";
    } else {
      action = "update";
    }

    var formData = new FormData();

    formData.append("action", action);
    formData.append("description", description);
    formData.append("obs", obs);
    formData.append("type", type);
    formData.append("brand", brand);
    formData.append("status", status);
    formData.append("quantity", quantity);
    formData.append("imagem_ativo", img);

    $.ajax({
      type: "POST",
      url: "../controllers/assetsController.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (result) {
        alert(result);
        location.reload();
      },
    });
  });
});

// Alterar o status do ativo no banco de dados
function changeStatus(status, id) {
  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: {
      action: "changeStatus",
      status: status,
      idAtivo: id,
    },
    success: function (result) {
      location.reload();
    },
  });
}

// Atualiza as informações do ativo
function updateAsset(id) {
  //alert(id);

  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: {
      action: "getInfo",
      idAtivo: id,
    },
    success: function (result) {
      jsonReturn = JSON.parse(result);
      $("#cadastrarAtivoBtn").click();
      $("#idAsset").val(id);
      $("#description").val(jsonReturn[0]["descricaoAtivo"]);
      $("#quantity").val(jsonReturn[0]["quantidadeAtivo"]);
      $("#observation").val(jsonReturn[0]["obsAtivo"]);
      $("#brand").val(jsonReturn[0]["idMarca"]);
      $("#type").val(jsonReturn[0]["idTipo"]);

      console.log(jsonReturn);
      //console.log(result);
    },
  });
}

function clearModal(params) {
  $("#description").val("");
  $("#quantity").val("");
  $("#observation").val("");
  $("#brand").val("");
  $("#type").val("");
  $("#idAsset").val("");
}

// Função para excluir um ativo
function deleteAsset(id) {
  // Confirmação antes de excluir
  if (confirm("Tem certeza que deseja excluir esse ativo?")) {
    $.ajax({
      type: "POST",
      url: "../controllers/assetsController.php",
      data: {
        action: "delete",
        idAtivo: id,
      },
      success: function (result) {
        alert(result);
        location.reload(); // Recarrega a página para atualizar a lista
      },
      error: function (xhr, status, error) {
        console.error("Erro: " + error);
      },
    });
  }
}
