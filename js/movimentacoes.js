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

  if (ativo == "" || tipo == "" || quantidade == "") {
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
    },
    success: function (response) {
      if (response == "sucesso") {
        console.log(response);
      }
    },
    error: function (response) {
      if (response == "erro") {
        console.log(error);
      }
    },
  });
});
