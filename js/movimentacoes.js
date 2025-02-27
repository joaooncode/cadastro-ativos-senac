$(document).ready(function (params) {
  $("[data-toggle=tooltip]").tooltip();
});

$(".salvar").click(function (params) {
  let ativo = $("#ativo").val();
  let tipo = $("#tipoMovimentacao").val();
  let quantidade = $("#quantidadeMovimentacao").val();
  let origem = $("#localOrigem").val();
  let destino = $("#localDestino").val();
  let descricao = $("#descricaoMovimentacao").val();

  // Verifica se os campos obrigatórios estão preenchidos
  let isValid = true;
  if (!ativo) {
    $("#ativo").addClass("is-invalid");
    isValid = false;
  } else {
    $("#ativo").removeClass("is-invalid");
  }
  if (!tipo) {
    $("#tipoMovimentacao").addClass("is-invalid");
    isValid = false;
  } else {
    $("#tipoMovimentacao").removeClass("is-invalid");
  }
  if (!quantidade) {
    $("#quantidadeMovimentacao").addClass("is-invalid");
    isValid = false;
  } else {
    $("#quantidadeMovimentacao").removeClass("is-invalid");
  }
  if (!origem) {
    $("#localOrigem").addClass("is-invalid");
    isValid = false;
  } else {
    $("#localOrigem").removeClass("is-invalid");
  }
  if (!destino) {
    $("#localDestino").addClass("is-invalid");
    isValid = false;
  } else {
    $("#localDestino").removeClass("is-invalid");
  }

  if (!isValid) {
    alert("Campos obrigatórios não preenchidos!");
    return;
  }

  $.ajax({
    type: "POST",
    url: "../controllers/moveController.php",
    data: {
      descricao: descricao,
      ativo: ativo,
      origem: origem,
      destino: destino,
      tipo: tipo,
      quantidade: quantidade,
    },
    success: function (response) {
      if (response == "Sucesso") {
        console.log(response);
        alert("Movimentação cadastrada com sucesso!");
        location.reload();
      } else {
        alert(response);
      }
    },
    error: function (response) {
      if (response == "Erro") {
        console.log(error);
        alert("Falha ao realizar a movimentação\n" + error);
      }
    },
  });
});
