let originalQuantity = "";

$(function () {
  // Monitore mudanças no campo de quantidade
  $("#quantity").on("input", function () {
    // Verifique se é uma edição (idAsset tem valor) e se o valor mudou
    if ($("#idAsset").val() && $(this).val() !== originalQuantity) {
      $("#reason-change-div").show();
    } else {
      $("#reason-change-div").hide();
      $("#reasonChange").val("");
    }
  });

  // Adicione ao clear-btn para esconder o campo de motivo
  $("#clear-btn").click(function () {
    $("#reason-change-div").hide();
    $("#reasonChange").val("");
  });

  $("#save-btn").click(() => {
    // Coleta os valores dos campos do formulário
    const description = $("#description").val();
    const quantity = $("#quantity").val();
    const obs = $("#observation").val();
    const status = $("#status").val();
    const brand = $("#brand").val();
    const type = $("#type").val();
    const idAsset = $("#idAsset").val();
    const img = $("#imagem_ativo")[0]?.files[0];
    const quantityMin = $("#quantityMin").val();
    const reasonChange = $("#reasonChange").val();

    // Verifica se todos os campos obrigatórios estão preenchidos
    let isValid = true;
    if (!description) {
      $("#description").addClass("is-invalid");
      isValid = false;
    } else {
      $("#description").removeClass("is-invalid");
    }
    if (!quantity) {
      $("#quantity").addClass("is-invalid");
      isValid = false;
    } else {
      $("#quantity").removeClass("is-invalid");
    }
    if (!brand) {
      $("#brand").addClass("is-invalid");
      isValid = false;
    } else {
      $("#brand").removeClass("is-invalid");
    }
    if (!type) {
      $("#type").addClass("is-invalid");
      isValid = false;
    } else {
      $("#type").removeClass("is-invalid");
    }
    if (!quantityMin) {
      $("#quantityMin").addClass("is-invalid");
      isValid = false;
    } else {
      $("#quantityMin").removeClass("is-invalid");
    }

    // Verifica se o motivo da alteração foi preenchido quando necessário
    if ($("#idAsset").val() && quantity !== originalQuantity && !reasonChange) {
      $("#reasonChange").addClass("is-invalid");
      Swal.fire({
        title: "Atenção!",
        text: "Por favor, informe o motivo da alteração na quantidade.",
        icon: "warning",
        confirmButtonText: "OK",
      });
      isValid = false;
    } else {
      $("#reasonChange").removeClass("is-invalid");
    }

    if (!isValid) {
      Swal.fire({
        title: "Campos obrigatórios",
        text: "Por favor, preencha todos os campos obrigatórios.",
        icon: "error",
        confirmButtonText: "OK",
      });
      return;
    }

    // Define a ação com base na existência do idAsset
    const action = idAsset === "" ? "insert" : "update";
    const actionText = idAsset === "" ? "cadastrando" : "atualizando";

    // Monta o objeto FormData para enviar os dados e o arquivo
    const formData = new FormData();
    // Use "idAtivo" para que o backend receba o identificador corretamente
    formData.append("idAtivo", idAsset);
    formData.append("action", action);
    formData.append("description", description);
    formData.append("obs", obs);
    formData.append("type", type);
    formData.append("brand", brand);
    formData.append("status", status);
    formData.append("quantity", quantity);
    formData.append("quantityMin", quantityMin);
    formData.append("reasonChange", reasonChange);

    // Adiciona a imagem se houver
    if (img) {
      formData.append("imagem_ativo", img);
    }

    // Mostrar loading enquanto processa
    Swal.fire({
      title: `${actionText.charAt(0).toUpperCase() + actionText.slice(1)
        } ativo...`,
      text: "Por favor, aguarde enquanto processamos sua solicitação.",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    // Requisição AJAX para o controller
    $.ajax({
      type: "POST",
      url: "../controllers/assetsController.php",
      data: formData,
      processData: false,
      contentType: false,
      success: (result) => {
        Swal.fire({
          title: "Sucesso!",
          text: result,
          icon: "success",
          confirmButtonText: "OK",
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      },
      error: (xhr, status, error) => {
        console.error("Erro na requisição:", error);
        Swal.fire({
          title: "Erro!",
          text: "Ocorreu um erro ao processar sua solicitação.",
          icon: "error",
          confirmButtonText: "OK",
        });
        console.log(error);

      },
    });
  });
});

// Função para alterar o status do ativo
const changeStatus = (status, id) => {
  Swal.fire({
    title: "Alterando status",
    text: "Tem certeza que deseja alterar o status deste ativo?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Sim",
    cancelButtonText: "Não",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Alterando status...",
        text: "Por favor, aguarde.",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      $.ajax({
        type: "POST",
        url: "../controllers/assetsController.php",
        data: { action: "changeStatus", status, idAtivo: id },
        success: (result) => {
          Swal.fire({
            title: "Status alterado!",
            text: result,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            location.reload();
          });
        },
        error: (xhr, status, error) => {
          console.error("Erro:", error);
          Swal.fire({
            title: "Erro!",
            text: "Ocorreu um erro ao alterar o status.",
            icon: "error",
            confirmButtonText: "OK",
          });
        },
      });
    }
  });
};

// Função para obter e preencher os dados do ativo para atualização
const updateAsset = (id) => {
  Swal.fire({
    title: "Carregando informações",
    text: "Buscando dados do ativo...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: { action: "getInfo", idAtivo: id },
    success: (result) => {
      Swal.close();
      const jsonReturn = JSON.parse(result);
      $("#cadastrarAtivoBtn").click();
      $("#idAsset").val(id);
      $("#description").val(jsonReturn[0].descricaoAtivo);
      $("#quantity").val(jsonReturn[0].quantidadeAtivo);
      // Armazene o valor original da quantidade
      originalQuantity = jsonReturn[0].quantidadeAtivo;
      $("#observation").val(jsonReturn[0].obsAtivo);
      $("#brand").val(jsonReturn[0].idMarca);
      $("#type").val(jsonReturn[0].idTipo);
      $("#quantityMin").val(jsonReturn[0].quantidadeMinimaAtivo);
      // Esconda o campo de motivo inicialmente
      $("#reason-change-div").hide();
      if (jsonReturn[0]["url_imagem"] !== "") {
        $("#imagemPreview").attr(
          "src",
          window.location.protocol +
          "//" +
          window.location.host +
          "/" +
          jsonReturn[0]["url_imagem"]
        );
        $(".preview").css("display", "block");
      } else {
        $(".preview").css("display", "none");
      }
    },
    error: (xhr, status, error) => {
      console.error("Erro:", error);
      Swal.fire({
        title: "Erro!",
        text: "Ocorreu um erro ao buscar informações do ativo.",
        icon: "error",
        confirmButtonText: "OK",
      });
    },
  });
};

// Função para limpar os campos do modal
const clearModal = () => {
  $("#description, #quantity, #observation, #brand, #type, #idAsset").val("");
  $(".preview").css("display", "none");
  $("#reasonChange").val("");
  $("#reason-change-div").hide();
  originalQuantity = "";
};

// Função para excluir um ativo
const deleteAsset = (id) => {
  Swal.fire({
    title: "Confirmar exclusão",
    text: "Tem certeza que deseja excluir esse ativo? Esta ação não pode ser desfeita.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sim, excluir!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Excluindo ativo...",
        text: "Por favor, aguarde.",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      $.ajax({
        type: "POST",
        url: "../controllers/assetsController.php",
        data: { action: "delete", idAtivo: id },
        success: (result) => {
          Swal.fire({
            title: "Excluído!",
            text: result,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            location.reload();
          });
        },
        error: (xhr, status, error) => {
          console.error("Erro:", error);
          Swal.fire({
            title: "Erro!",
            text: "Ocorreu um erro ao excluir o ativo.",
            icon: "error",
            confirmButtonText: "OK",
          });
        },
      });
    }
  });
};

// Função para mostrar informações do ativo
const showInfo = (id) => {
  Swal.fire({
    title: "Carregando informações",
    text: "Buscando detalhes do ativo...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: { action: "getInfo", idAtivo: id },
    success: (result) => {
      Swal.close();
      const jsonReturn = JSON.parse(result);
      $("#infoDescricao").text(jsonReturn[0].descricaoAtivo);
      $("#infoQuantidade").text(jsonReturn[0].quantidadeAtivo);
      $("#infoQuantidadeMinima").text(jsonReturn[0].quantidadeMinimaAtivo);
      $("#infoQuantidadeUso").text(jsonReturn[0].quantidadeUso);
      $("#infoMarca").text(jsonReturn[0].idMarca);
      $("#infoStatus").text(jsonReturn[0].idStatus);
      $("#infoTipo").text(jsonReturn[0].idTipo);
      $("#infoObservacao").text(jsonReturn[0].obsAtivo);
      if (jsonReturn[0]["url_imagem"] !== "") {
        $("#infoImagem").attr(
          "src",
          window.location.protocol +
          "//" +
          window.location.host +
          "/" +
          jsonReturn[0]["url_imagem"]
        );
      } else {
        $("#infoImagem").attr("src", "");
      }
      $("#infoAtivo").modal("show");
    },
    error: (xhr, status, error) => {
      console.error("Erro:", error);
      Swal.fire({
        title: "Erro!",
        text: "Ocorreu um erro ao buscar informações do ativo.",
        icon: "error",
        confirmButtonText: "OK",
      });
    },
  });
};
