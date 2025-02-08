/* $(document).ready(function () {
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
 */

$(function () {
  $("#save-btn").click(() => {
    // Gather form field values
    const description = $("#description").val();
    const quantity = $("#quantity").val();
    const obs = $("#observation").val();
    const status = $("#status").val();
    const brand = $("#brand").val();
    const type = $("#type").val();
    const idAsset = $("#idAsset").val();
    const img = $("#imagem_ativo")[0]?.files[0];

    // Determine the action based on whether idAsset is empty
    const action = idAsset === "" ? "insert" : "update";

    // Build FormData object for file upload and other data
    const formData = new FormData();
    formData.append("action", action);
    formData.append("description", description);
    formData.append("obs", obs);
    formData.append("type", type);
    formData.append("brand", brand);
    formData.append("status", status);
    formData.append("quantity", quantity);
    formData.append("imagem_ativo", img);

    // AJAX request to the controller
    $.ajax({
      type: "POST",
      url: "../controllers/assetsController.php",
      data: formData,
      processData: false,
      contentType: false,
      success: (result) => {
        alert(result);
        location.reload();
      },
    });
  });
});

// Change asset status
const changeStatus = (status, id) => {
  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: { action: "changeStatus", status, idAtivo: id },
    success: () => location.reload(),
  });
};

// Update asset information
const updateAsset = (id) => {
  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: { action: "getInfo", idAtivo: id },
    success: (result) => {
      const jsonReturn = JSON.parse(result);
      $("#cadastrarAtivoBtn").click();
      $("#idAsset").val(id);
      $("#description").val(jsonReturn[0].descricaoAtivo);
      $("#quantity").val(jsonReturn[0].quantidadeAtivo);
      $("#observation").val(jsonReturn[0].obsAtivo);
      $("#brand").val(jsonReturn[0].idMarca);
      $("#type").val(jsonReturn[0].idTipo);
      if (jsonReturn[0]["url_imagem"] != "") {
        $("#imagemPreview").attr(
          "src",
          window.location.protocol +
            "//" +
            window.location.host +
            "/" +
            jsonReturn[0]["url_imagem"],
          $(".preview").attr("style", "display:block")
        );
      } else {
        $(".preview").attr("style", "display:none");
      }
      console.log(jsonReturn);
    },
  });
};

// Clear modal fields
const clearModal = () => {
  $("#description, #quantity, #observation, #brand, #type, #idAsset").val("");
};

// Delete an asset
const deleteAsset = (id) => {
  if (confirm("Tem certeza que deseja excluir esse ativo?")) {
    $.ajax({
      type: "POST",
      url: "../controllers/assetsController.php",
      data: { action: "delete", idAtivo: id },
      success: (result) => {
        alert(result);
        location.reload();
      },
      error: (xhr, status, error) => console.error("Erro:", error),
    });
  }
};
