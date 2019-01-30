<?php
session_start();
//Arquivo de conexão com banco de dados
require_once('_classes/class.database.php');

//Compatibilidade com JSON
header('Content-Type: application/json');


//Conexão com o banco de dados
$database = new Database();
$link     = $database->conectarMySQL();

//Capturando valores passados por POST via Ajax
$nome_alt    = $_POST['userName'];
$email_alt   = $_POST['userEmail'];
$senha_alt   = $_POST['userSenha'];

$nome = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
$id = $_SESSION['user_id'];


//Verificando se houve conexão com o banco de dados
if($link){
	//Verificando se o e-mail inserido já não está cadastrado
    
	$sql      = "SELECT * FROM table_user WHERE user_email = '$email_alt' AND id != '$id'";
	$result   = mysqli_query($link, $sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		$data = array(
			'response' => 'O e-mail inserido já está cadastrado!',
			'success' => false
        );
		echo json_encode($data);
	} else {
		//Verificando se a senha é compativel
        $senha_cod = md5($senha_alt);
		$sql    = "SELECT user_pass FROM table_user WHERE id = '$id'";
		$result = mysqli_query($link, $sql);
        $senha_dado = mysqli_fetch_array($result);
        
		if ($senha_dado['user_pass'] === $senha_cod) {
            
            $sql = "UPDATE table_user SET user_name = '$nome_alt', user_email = '$email_alt' WHERE id = '$id'";
            $result = mysqli_query($link, $sql);
            
            if ($result) {
                $_SESSION['user_name'] = $nome_alt;
                $_SESSION['user_email'] = $email_alt;
                $data = array(
                    'response' => 'Aleração realizada com sucesso!',
                    'success' => true
                );
                echo json_encode($data);   
            } else {
                $data = array(
                    'response' => 'Ocorreu um erro ao realizar as alterações. Tente novamente mais tarde.',
                    'success' => false
                );
                echo json_encode($data);
            }
		} else {
			$data = array(
				'response' => 'Senha incorreta!',
				'success' => false
			);
			echo json_encode($data);
		}
	}
} else{
	$data = array(
		'response' => 'Ocorreu um erro durante a conexão com o servidor. Tente novamente mais tarde.',
		'success' => false);
	echo json_encode($data);
}

?>