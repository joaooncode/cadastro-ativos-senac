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
    $.ajax({
      type: "POST",
      url: "../controllers/assets.php",
      data: {
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
