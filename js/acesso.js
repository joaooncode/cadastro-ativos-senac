$(document).ready(function () {
    $(".salva_acesso").click(function () {
        $input = document.querySelectorAll(".check");
        arrAcesso = {};
        if (!arrAcesso[index]) {
            arrAcesso[index] = {};
        }
        if ($(elemento).is(":checked")) {
            arrAcesso[index]["id_opcao"] = $(elemento).val();
            arrAcesso[index]["acesso"] = "S";
        } else {
            arrAcesso[index]["id_opcao"] = $(elemento).val();
            arrAcesso[index]["acesso"] = "N";
        }


        cargo = $("#cargo").val();
        arrData = {};
        arrData["acao"] = "grava_acessos";
        arrData["cargo"] = cargo;
        arrData["acao"] = arrAcesso;
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
    $.ajax({
        type: 'post',
        url: '/controllers/acessoController.php',
        data: {
            acao: 'busca_acessos',
            cargo: cargo
        },
        success: function (result) {
            retorno = JSON.parse(result)
            if (retorno) {
                inputs = document.querySelectorAll('.check')

                $(inputs).each(function (index, elemento) {
                    $(elemento).prop('checked', false)
                })
            } else {
                $(retorno).each(function (index, elemento) {
                    if (elemento.statusAcesso == 'S') {
                        $('.' + elemento.id_opcao).prop('checked', true)
                    } else {
                        $('.' + elemento.id_opcao).prop('checked', false)
                    }
                })
            }
        }
    })
}