$(document).ready(function () {
    $(".salva_acesso").click(function () {
        $inputs = document.querySelectorAll(".check");
        arrAcesso = {};
        $(inputs).each(function (index, elemento) {
            console.log(elemento);

            if (!arrAcesso[index]) {
                arrAcesso[index] = {};  // Inicializando o objeto no índice específico
            }
            if ($(elemento).is(":checked")) {
                arrAcesso[index]['id_opcao'] = $(elemento).val();
                arrAcesso[index]['acesso'] = 'S';

            } else {
                arrAcesso[index]['id_opcao'] = $(elemento).val();
                arrAcesso[index]['acesso'] = 'N';
            }
        });


        cargo = $("#cargo").val();
        arrData = {};
        arrData["acao"] = "grava_acessos";
        arrData["cargo"] = cargo;
        arrData["acessos"] = arrAcesso;
        console.log(arrData);

        $.ajax({
            method: "post",
            url: "/controllers/acessoController.php",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify(arrData),
            success: function (result) {
                alert(result);
            },
        });
    });
});
function get_acessos() {
    cargo = $('#cargo').val()

    inputs = document.querySelectorAll('.check')

    $(inputs).each(function (index, elemento) {
        $(elemento).prop('checked', false)
    })

    $.ajax({
        type: 'post',
        url: '/controllers/acessoController.php',
        data: {
            acao: 'busca_acessos',
            cargo: cargo
        },
        success: function (result) {
            retorno = JSON.parse(result)

            $(retorno).each(function (index, elemento) {
                if (elemento.status_acesso == 'S') {
                    $('.' + elemento.id_opcao).prop('checked', true)
                } else {
                    $('.' + elemento.id_opcao).prop('checked', false)
                }
            })

        }
    })
}