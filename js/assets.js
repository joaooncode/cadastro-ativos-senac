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
    let action = "";
    console.log(idAsset);

    if (idAsset == "") {
      action = "insert";
    } else {
      action = "update";
    }
    console.log(action);

    $.ajax({
      type: "POST",
      url: "../controllers/assetsController.php",
      data: {
        action: action,
        description: description,
        quantity: quantity,
        obs: obs,
        status: status,
        brand: brand,
        type: type,
        idAtivo: idAsset,
      },
      success: function (result) {
        // alert(result);
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
