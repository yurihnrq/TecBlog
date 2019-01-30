/*globals alert:false, $:false*/
//Aguardando carregamento do DOM
$(document).ready(function () {
    'use strict';
    //Disparando função ao realizar submit no form de login
    $('#btn_logout').on('click', function () {
        $.ajax({
            url: '_php/user_logout.php',
            dataType: 'json',
            success: function (data) {
                alert(data.response);
                window.location.reload();
            },
            error: function (data) {
                setTimeout(function () {
                    alert("Erro na requisição de login.\nErro: " + data.response);
                }, 500);
            }
        });
    });
});