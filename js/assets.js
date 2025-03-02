$(function () {
  $("#save-btn").click(() => {
    alert('Teste')
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

    if (!isValid) {
      alert("Por favor, preencha todos os campos obrigatórios.");
      return;
    }

    // Define a ação com base na existência do idAsset
    const action = idAsset === "" ? "insert" : "update";

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

    // Adiciona a imagem se houver
    if (img) {
      formData.append("imagem_ativo", img);
    }

    // Requisição AJAX para o controller
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
      error: (xhr, status, error) => {
        console.error("Erro na requisição:", error);
      },
    });
  });
});

// Função para alterar o status do ativo
const changeStatus = (status, id) => {
  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: { action: "changeStatus", status, idAtivo: id },
    success: (result) => {
      //alert(result);
      location.reload();
    },
    error: (xhr, status, error) => {
      console.error("Erro:", error);
    },
  });
};

// Função para obter e preencher os dados do ativo para atualização
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
      $("#quantityMin").val(jsonReturn[0].quantidadeMinimaAtivo);
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
    },
  });
};

// Função para limpar os campos do modal
const clearModal = () => {
  $("#description, #quantity, #observation, #brand, #type, #idAsset").val("");
  $(".preview").css("display", "none");
};

// Função para excluir um ativo
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
      error: (xhr, status, error) => {
        console.error("Erro:", error);
      },
    });
  }
};
const showInfo = (id) => {
  $.ajax({
    type: "POST",
    url: "../controllers/assetsController.php",
    data: { action: "getInfo", idAtivo: id },
    success: (result) => {
      const jsonReturn = JSON.parse(result);
      $("#infoDescricao").text(jsonReturn[0].descricaoAtivo);
      $("#infoQuantidade").text(jsonReturn[0].quantidadeAtivo);
      $("#infoQuantidadeMinima").text(jsonReturn[0].quantidadeMinimaAtivo);
      $("#infoQuantidadeUso").text(jsonReturn[0].quantidadeUso);
      $("#infoMarca").text(jsonReturn[0].idMarca);
      $("#infoStatus").text(jsonReturn[0].statusAtivo);
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
    },
  });
};