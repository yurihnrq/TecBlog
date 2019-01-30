/*globals alert:false, $:false*/
//Aguardando carregamento do DOM
$(document).ready(function () {
    //Disparando função ao realizar submit no form de cadastro
    'use strict';
    $('#form_contato').on('submit', function (e) {
        //Previnindo que o formulário seja enviado por método padrão
        e.preventDefault();
        //Verificando se o formulário está válido
        if ($(this).parsley().isValid()) {
            //Fazendo requisição Ajax
            $.ajax({
                url: '../_php/user_contact.php',
                data: $(this).serialize(),
                type: 'POST',
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    //Desabilitando formulário
                    $('.text_contato').prop("disabled", true);
                    $('.select_contato').prop("disabled", true);
                    $('.btn').prop("disabled", true);
                },
                success: function (data) {
                    if (data.success) {
                        //Removendo valores
                        $('.text_contato').val('');
                        
                        //Removendo classes
                        $('.text_contato').removeClass('text-success');
                        $('.text_contato').removeClass('is-valid');
                        
                        
                        setTimeout(function () {
                            alert(data.response);
                            
                            
                            //Habilitando formulário
                            $('.text_contato').prop("disabled", false);
                            $('.select_contato').prop("disabled", false);
                            $('.btn').prop("disabled", false);
                        }, 500);
                    } else {
                        
                        //Apagando valores do textarea
                        $('.text_contato').val('');

                        //Adicionando classes de erro ao textarea
                        $('.text_contato').removeClass('text-success');
                        $('.text_contato').removeClass('is-valid');
                        $('.text_contato').addClass('text-danger');
                        $('.text_contato').addClass('is-invalid');

                        setTimeout(function () {
                            alert(data.response);
                            
                            //Habilitando formulário
                            $('.text_contato').prop("disabled", false);
                            $('.select_contato').prop("disabled", false);
                            $('.btn').prop("disabled", false);
                        }, 500);
                    }
                },
                error: function (data) {
                    //Apagando valores do textarea
                    $('.text_contato').val('');

                    //Adicionando classes de erro ao textarea
                    $('.text_contato').removeClass('text-success');
                    $('.text_contato').removeClass('is-valid');
                    $('.text_contato').addClass('text-danger');
                    $('.text_contato').addClass('is-invalid');
                    
                    document.getElementsByClassName('text_contato').focus();

                    setTimeout(function () {
                        alert("Erro na requisição de cadastro.\nErro: " + data.response);
                    }, 500);
                }
            });
        }
    });
});