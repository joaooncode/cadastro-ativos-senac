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
      url: "../controllers/assets.php",
      data: {
        action: action,
        description: description,
        quantity: quantity,
        obs: obs,
        status: status,
        brand: brand,
        type: type,
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
    url: "../controllers/assets.php",
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

function updateAsset(id) {
  alert(id);
  $("#updateBtn").click();
  $.ajax({
    type: "PUT",
    url: "../controllers/update_assets.php",
    data: {},
  });
}
