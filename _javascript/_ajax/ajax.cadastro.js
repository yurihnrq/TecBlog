/*globals alert:false, $:false*/
//Aguardando carregamento do DOM
$(document).ready(function () {
    //Disparando função ao realizar submit no form de cadastro
    'use strict';
    $('#form_cadastro').on('submit', function (e) {
        //Previnindo que o formulário seja enviado por método padrão
        e.preventDefault();
        //Verificando se o formulário está válido
        if ($(this).parsley().isValid()) {
            //Fazendo requisição Ajax
            $.ajax({
                url: '../_php/user_cad.php',
                data: $(this).serialize(),
                type: 'POST',
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    $('#modal_loader').modal({backdrop: 'static', keyboard: false});
                    //Desabilitando formulário
                    $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", true);
                },
                success: function (data) {
                    if (data.success) {
                        //Habilitando formulário
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
                        
                        $('#modal_loader').modal('hide');
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email]").val("");
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email]").removeClass('is-valid text-valid');
                        setTimeout(function () {
                            alert('Cadastro realizado com sucesso!');
                            window.location.assign('../');
                        }, 300);
                    } else {
                        //Habilitando formulário
                        $('#form_cadastro').find("input[type=text], input[type=password], input[type=email], button").prop("disabled", false);
                        
                        $('#modal_loader').modal('hide');
                        setTimeout(function () {
                            if (data.email === false) {
                                $('#modal_loader').modal('hide');
                                setTimeout(function () {
                                    alert(data.response);
                                    //Apagando valores dos campos de senha
                                    $('#cadastro_senha').val('');
                                    $('#cadastro_rsenha').val('');

                                    //Adicionando classe de erro aos inputs de senha e repetir senha
                                    //Senha
                                    $('#cadastro_senha').removeClass('text-success');
                                    $('#cadastro_senha').removeClass('is-valid');
                                    $('#cadastro_senha').addClass('text-danger');
                                    $('#cadastro_senha').addClass('is-invalid');
                                    //Repetir senha
                                    $('#cadastro_rsenha').removeClass('text-success');
                                    $('#cadastro_rsenha').removeClass('is-valid');
                                    $('#cadastro_rsenha').addClass('text-danger');
                                    $('#cadastro_rsenha').addClass('is-invalid');
                                    
                                }, 100);
                            } else {
                                alert(data.response + "\nClique em OK para reiniciar a página.");
                                location.reload();
                            }
                            
                        }, 600);
                        
                    }
                },
                error: function (data) {
                    //Apagando valores dos campos de senha
                    $('#cadastro_senha').val('');
                    $('#cadastro_rsenha').val('');

                    //Adicionando classe de erro aos inputs de senha e repetir senha
                    //Senha
                    $('#cadastro_senha').removeClass('text-success');
                    $('#cadastro_senha').removeClass('is-valid');
                    $('#cadastro_senha').addClass('text-danger');
                    $('#cadastro_senha').addClass('is-invalid');
                    //Repetir senha
                    $('#cadastro_rsenha').removeClass('text-success');
                    $('#cadastro_rsenha').removeClass('is-valid');
                    $('#cadastro_rsenha').addClass('text-danger');
                    $('#cadastro_rsenha').addClass('is-invalid');

                    setTimeout(function () {
                        alert("Erro na requisição de cadastro.\nErro: " + data.response);
                        $('#modal_loader').modal('hide');
                    }, 500);
                }
            });
        }
    });
});