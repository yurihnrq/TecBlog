<?php

//Fun��o chamada para enviar o e-mail. Tem como par�metro o e-mail do destinat�rio.
function sendEmail($email){

	//Assunto do e-mail
	$email_subject = "Obrigado por se cadastrar no TecBlog";

	//Mensagem do e-mail, constru�da em HTML
	$email_message = '
		<html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>Cadastro realizado com sucesso!</title>
            </head>
            <body style="
                font-family: monospace, consolas; 
                letter-spacing: -2; 
                background-color: lightgray; 
                min-width: 500px;
                margin: 10px;
                padding: 0px;
            ">
                <div style="background-color: #313552; padding: 20px;">
                    <h1 style="padding: 0px; margin: 0px; color: white;">Obrigado por se registrar no TecBlog</h1>       
                </div>
                <div style="text-align: justify;">
                    <div style="float: left; background-color: white; padding: 20px; text-indent: 40px;">
                        <h1 style="color: darkslateblue;">
                            Estamos felizes de ter voc� conosco!
                        </h1>
                        <hr>
                        <h2>
                            A partir de agora, sempre que novas publica��es forem realizadas, voc� receber� uma notifica��o diretamente no seu e-mail. N�o se esque�a que, ao acessar sua conta em nosso site, voc� pode alterar sua prefer�ncias de notifica��es.
                        </h2>
                        <h2>
                            Caso queira desabilitar as notifica��es, basta acessar o painel de configura��es realizando login em nosso site.
                        </h2>
                        <h2 style="color: #6872AF;">
                            Para acessar o TecBlog, clique <a href="http://127.0.0.1/TecBlog/login/" target="_blank">aqui</a>.
                        </h2>
                    </div>
                </div>
            </body>
        </html>
	';

	//C�digo PHPMailer
	//Chama a classe PHPMailer
	require_once('_phpmailer/class.phpmailer.php');
	//Instanciando objeto PHPMailer
	$mail = new PHPMailer();
	//Passando protocolo a ser utilizado
	$mail->IsSMTP();

	//Configura��o do e-mail
	//Porta utilizada pelo Gmail
	$mail->Port = '465';
	//
	$mail->Host = 'smtp.gmail.com';
	//Habilitando possibilidade de utilizar estrutura de e-mail em HTML
	$mail->IsHTML(true);
	//
	$mail->Mailer = 'smtp'; 
	$mail->SMTPSecure = 'ssl';

	//Configura��o do usu�rio que enviar� o e-mail
	$mail->SMTPAuth = true; 
	$mail->Username = 'testetecblog@gmail.com'; // Usu�rio Gmail
	$mail->Password = 'teste123123123'; // Senha Gmail

	$mail->SingleTo = true; 

	//Configura��o remetente
	$mail->From = "testetecblog@gmail.com"; 
	$mail->FromName = "TecBlog - Contato"; 

	//Adicionando destinat�rio, passado como par�metro da fun��o
	$mail->addAddress($email);

	//Passando atributos do e-mail
	$mail->Subject = "$email_subject"; 
	$mail->Body = "$email_message";
	$mail->AltBody = "Obrigador por se cadastrar. A partir de agora, sempre que novas publica��es forem realizadas, voc� receber� uma notifica��o diretamente no seu e-mail. N�o se esque�a que, ao acessar sua conta em nosso site, voc� pode alterar sua prefer�ncias de notifica��es.";

	//Eviando e-mail e testando sucesso
	if(!$mail->Send()){
	    return false;
	} else {
		return true;
	}
}

?>