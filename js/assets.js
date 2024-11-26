$(document).ready(function () {
  $("#save-btn").click(function () {
    const form = $("#register")[0];

    // verifica se o formulário está preenchido
    if (form.checkValidity()) {
      // valor dos inputs
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
          assets_description: description,
          assets_quantity: quantity,
          assets_obs: obs,
          assets_status: status,
          assets_brand: brand,
          assets_type: type,
        },
      });
    }
  });
});
