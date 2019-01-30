/*globals alert:false, $:false*/
//Aguardando carregamento do DOM
$(document).ready(function () {
    'use strict';
    //Variaveis com valores originais
    var desc_inicial = $('#hidden_text').val();

    //Troca de botões
    $('.btnAlterar').on('click', function () {
        $('.btnAlterar').hide();
        $('.btnEnviar').show();
        $('#form_user').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
        $('#user_senha').prop("placeholder", 'Confirme sua senha');

    });
    
    //Requisição para alterção de dados do usuário
    $('#form_user').on('submit', function (e) {
        //Previnindo que o formulário seja enviado por método padrão
        e.preventDefault();
        //Verificando se o formulário está válido
        if ($(this).parsley().isValid()) {
            //Fazendo requisição Ajax
            $.ajax({
                url: '../_php/user_page.php',
                data: $(this).serialize(),
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        alert(data.response);
                        window.location.reload();
                    } else {
                        alert(data.response);
                    }
                },
                error: function (data) {
                    alert('Erro na requisição. Caso o problema persista, entre em contato conosco.');
                }
            });
        }
    });


    //Verificando se houve alteração no campo de descrição
    $('.areaDesc').on('keyup', function () {
        var desc_mod = $('.areaDesc').val();
        if (desc_mod !== desc_inicial) {
            $('.btnDesc').removeAttr('disabled');
        } else {
            $('.btnDesc').attr('disabled', 'true');
        }

    });
    $('.descReset').on('click', function () {
        $('.btnDesc').attr('disabled', 'true');
    });

    //Requisição para alteração da descrição do usuário
    $('#form_desc').on('submit', function (e) {
        //Previnindo que o formulário seja enviado por método padrão
        e.preventDefault();
        //Verificando se o formulário está válido
        if ($(this).parsley().isValid()) {
            //Fazendo requisição Ajax
            $.ajax({
                url: '../_php/user_page.desc.php',
                data: $(this).serialize(),
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        alert(data.response);
                        window.location.reload();
                    } else {
                        alert(data.response);
                    }
                },
                error: function (data) {
                    alert('Erro na requisição. Caso o problema persista, entre em contato conosco.');
                }
            });
        }
    });
});
