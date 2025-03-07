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
    Swal.fire({
      title: "Atenção!",
      text: "Campos obrigatórios não preenchidos!",
      icon: "warning",
      confirmButtonText: "OK",
    });
    return;
  }

  // Mostrar loading enquanto processa
  Swal.fire({
    title: "Processando...",
    text: "Registrando movimentação do ativo.",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });

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
        Swal.fire({
          title: "Sucesso!",
          text: "Movimentação cadastrada com sucesso!",
          icon: "success",
          confirmButtonText: "OK",
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      } else {
        Swal.fire({
          title: "Erro!",
          html: response,
          icon: "error",
          confirmButtonText: "OK",
        });
      }
    },
    error: function (xhr, status, error) {
      console.error("Erro:", error);
      Swal.fire({
        title: "Falha na operação!",
        html: "Falha ao realizar a movimentação<br>" + error,
        icon: "error",
        confirmButtonText: "OK",
      });
    },
  });
});
