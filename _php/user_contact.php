<?php

//Iniciando sessão
session_start();

//Arquivo de conexão com banco de dados
require_once('_classes/class.database.php');

//Compatibilidade com JSON
header('Content-Type: application/json');

$assunto = $_POST['contAssunto'];
$texto   = $_POST['contTexto'];
$email   = $_SESSION['user_email'];
$nome    = $_SESSION['user_name'];
$id      = $_SESSION['user_id'];

$email_message = "
    <h1>Contato - TecBlog</h1>
    <br><br>
    <h3>ID usuário: $id</h3><br>
    <h3>Nome usuário: $nome</h3><br>
    <h3>E-mail usuário: $email</h3>
    <br><br>
    <h3>Assunto: $assunto</h3>
    <p>$texto</p>
";

//Código PHPMailer
//Chama a classe PHPMailer
require_once('_phpmailer/class.phpmailer.php');
//Instanciando objeto PHPMailer
$mail = new PHPMailer();
//Passando protocolo a ser utilizado
$mail->IsSMTP();

//Configuração do e-mail
//Porta utilizada pelo Gmail
$mail->Port = '465';
//
$mail->Host = 'smtp.gmail.com';
//Habilitando possibilidade de utilizar estrutura de e-mail em HTML
$mail->IsHTML(true);
//
$mail->Mailer = 'smtp'; 
$mail->SMTPSecure = 'ssl';

//Configuração do usuário que enviará o e-mail
$mail->SMTPAuth = true; 
$mail->Username = 'testetecblog@gmail.com'; // Usuário Gmail
$mail->Password = 'teste123123123'; // Senha Gmail

$mail->SingleTo = true; 

//Configuração remetente
$mail->From = "testetecblog@gmail.com"; 
$mail->FromName = "TecBlog - Contato"; 

//Adicionando destinatário, passado como parâmetro da função
$mail->addAddress('yurihenrique.bernardes@gmail.com');

//Passando atributos do e-mail
$mail->Subject = "Contato - TecBlog"; 
$mail->Body = "$email_message";
$mail->AltBody = "ID usuário: $id, Nome usuário: $nome, E-mail usuário: $email, Assunto: $assunto. ..... $texto";

//Eviando e-mail e testando sucesso
if(!$mail->Send()){
    $data = array(
		'response' => 'Ocorreu um erro inesperada. Tente novamente mais tarde.',
		'success' => false
	);
	echo json_encode($data);
} else {
    $data = array(
		'response' => 'Formulário enviado com sucesso!',
		'success' => true
	);
	echo json_encode($data);
}

?>