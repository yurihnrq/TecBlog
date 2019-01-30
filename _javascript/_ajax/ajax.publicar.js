/*globals alert:false, $:false*/
//Aguardando carregamento do DOM
$(document).ready(function () {
    'use strict';
    //Gerando data da publicação
    function dataPub() {
        var d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');
    }
    var data = dataPub();
    document.getElementById('pub_data').value = data;
    //Disparando função ao realizar submit no form de login
    $('#form_publicar').on('submit', function (e) {
        //Previnindo que o formulário seja enviado por método padrão
        e.preventDefault();
        //Verificando se o formulário está válido
        if ($(this).parsley().isValid()) {
            //Fazendo requisição Ajax
            $.ajax({
                url: '../_php/page_publication.php',
                data: $(this).serialize(),
                type: 'POST',
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    //Desabilitando formulário
                    $('#form_publicar').find("textarea, input, button").prop("disabled", true);
                },
                success: function (data) {
                    alert(data.response);
                    $('#form_publicar').find("textarea, input, button").prop("disabled", false);
                    $('#form_publicar').find("textarea, input").val(" ");
                    tinyMCE.activeEditor.setContent('');
                },
                error: function (data) {
                    alert('Erro inesperado: ' + data.response);
                }
            });
        }
    });
});

