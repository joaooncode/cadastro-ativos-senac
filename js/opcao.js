$(document).on('click', '.salvar', function () {
    // Coleta os dados dos campos do modal
    var descricaoOpcao = $("#descricao_opcao").val();
    var idOpcao = $("#id_opcao").val();
    var nivelOpcao = $("#nivel_opcao").val();
    var opcaoSuperior = $("#opcao_superior").val();
    var urlOpcao = $("#url_opcao").val();

    // Exemplo de requisição AJAX
    $.ajax({
        url: '../controllers/optionsController', // Altere para a URL correta do seu endpoint
        type: 'POST',
        data: {
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
            $("#novaOpcao").modal('hide');
            // Atualize a listagem ou exiba uma mensagem de sucesso
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Em caso de erro, exiba uma mensagem de erro ou trate conforme sua necessidade
            console.error('Erro:', textStatus, errorThrown);
            alert('Ocorreu um erro ao salvar a opção.');
        }
    });
});
