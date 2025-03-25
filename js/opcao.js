$(document).on('click', '.salvar', function () {
    // Coleta os dados dos campos do modal
    let descricaoOpcao = $("#descricao_opcao").val();
    let idOpcao = $("#id_opcao").val();
    let nivelOpcao = $("#nivel_opcao").val();
    let opcaoSuperior = $("#opcao_superior").val();
    let urlOpcao = $("#url_opcao").val();


    let acao = idOpcao === "" ? "inserir" : "update";

    // Exemplo de requisição AJAX
    $.ajax({
        url: '../controllers/optionsController.php', // Altere para a URL correta do seu endpoint
        type: 'POST',
        data: {
            acao: acao,
            descricao_opcao: descricaoOpcao,
            id_opcao: idOpcao,
            nivel_opcao: nivelOpcao,
            opcao_superior: opcaoSuperior,
            url_opcao: urlOpcao
        },
        success: function (response) {
            // Se a requisição for bem-sucedida, você pode tratar a resposta conforme necessário
            console.log('Sucesso:', response);
            // Exemplo: fechar o modal e atualizar a interface
            //$("#novaOpcao").modal('hide');
            // Atualize a listagem ou exiba uma mensagem de sucesso
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Em caso de erro, exiba uma mensagem de erro ou trate conforme sua necessidade
            console.error('Erro:', textStatus, errorThrown);
            alert('Ocorreu um erro ao salvar a opção.');
        }
    });
});



function muda_status(status, idOpcao) {
    $.ajax({
        type: "POST",
        url: "../controllers/optionsController.php",
        data: {
            acao: "alterar_status",
            status: status,
            id_opcao: idOpcao,
        },
        success: function (result) {
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error("Erro na requisição:", error);
        },
    });
}


function editar(idOpcao) {
    $("#id_opcao").val(idOpcao);
    $.ajax({
        type: "POST",
        url: "../controllers/optionsController.php",
        data: {
            acao: "get_info",
            id_opcao: idOpcao,
        },
        success: function (result) {
            let retorno = JSON.parse(result);
            alert('teste')
            $("#novaOpcaoBtn").click()
            $("#descricao_opcao").val(retorno[0]["descricao_opcao"]);
            $("#url_opcao").val(retorno[0]["url_opcao"]);
            $("#nivel_opcao").val(retorno[0]["nivel_opcao"]);
            $("#id_opcao").val(retorno[0]["id_opcao"]);
        },
        error: function (xhr, status, error) {
            console.error("Erro na requisição:", error);
        },
    });
}



function limpar_modal() {
    $("#descricao_opcao").val("");
    $("#id_opcao").val("");
    $("#url_opcao").val("");
    $("#nivel_opcao").val("");
}
