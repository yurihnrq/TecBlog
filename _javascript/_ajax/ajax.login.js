/*globals alert:false, $:false*/
//Aguardando carregamento do DOM
$(document).ready(function () {
    //Disparando função ao realizar submit no form de login
    'use strict';
    $('#form_login').on('submit', function (e) {
        //Previnindo que o formulário seja enviado por método padrão
        e.preventDefault();
        //Verificando se o formulário está válido
        if ($(this).parsley().isValid()) {
            //Fazendo requisição Ajax
            $.ajax({
                url: '../_php/user_login.php',
                data: $(this).serialize(),
                type: 'POST',
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    //Desabilitando formulário
                    $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", true);
                },
                success: function (data) {
                    if (data.success) {
                        //Habilitando formulário
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
                        setTimeout(function () {
							alert(data.response);
                            if (data.url === false) {
                                window.location.assign('../');
                            } else {
                                window.location.assign(data.url);
                            }
                        }, 600);
                    } else {
                        //Habilitando formulário
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
                        alert(data.response);
                    }
                    if (data.invalid) {
                        //Habilitando formulário
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
                        $('#login_senha').val('');
                        $('#login_senha').removeClass('text-success');
                        $('#login_senha').removeClass('is-valid');
                        $('#login_senha').addClass('text-danger');
                        $('#login_senha').addClass('is-invalid');
                        document.getElementById('login_senha').focus();
                    }
                },
                error: function (data) {
                    //Habilitando formulário
                    $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
                    $('#login_senha').val('');
                    $('#login_senha').removeClass('text-success');
                    $('#login_senha').removeClass('is-valid');
                    $('#login_senha').addClass('text-danger');
                    $('#login_senha').addClass('is-invalid');
                    setTimeout(function () {
                        alert("Erro na requisição de login.\nErro: " + data.response);
                    }, 500);
                }
            });
        }
    });
});