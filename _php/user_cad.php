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
$nome    = $_POST['cadNome'];
$email   = $_POST['cadEmail'];
$senha   = $_POST['cadSenha'];

//Verificando se houve conexão com o banco de dados
if($link){
	//Verificando se o e-mail inserido já não está cadastrado
	$sql      = "SELECT * FROM table_user WHERE  user_email = '$email'";
	$result   = mysqli_query($link, $sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		$data = array(
			'response' => 'O e-mail inserido já está cadastrado!',
			'success' => false,
			'email' => false);
		echo json_encode($data);
	} else {
		//Realizando inserção dos dados
        $senha_cod = md5($senha);
		$sql    = "INSERT INTO table_user (user_email, user_pass, user_name, user_adm) 
				   VALUES ('$email', '$senha_cod','$nome', 'user')";
		$result = mysqli_query($link, $sql);

		if ($result) {
			require_once('send_email.php');
			$sent_email = sendEmail($email);
			if ($sent_email) {
                if(!isset($_SESSION['user_name'])){
                    $sql    = "SELECT * FROM table_user WHERE user_email = '$email' AND user_pass = '$senha_cod'";
                    //O comando SQL requisita email e senha pertencentes à mesma tupla
                    $result = mysqli_query($link, $sql);
                    $user = mysqli_fetch_array($result);
                    $_SESSION['user_id']    = $user[     'id'    ];
                    $_SESSION['user_name']  = $user[ 'user_name' ];
                    $_SESSION['user_email'] = $user['user_email' ];
                    
                    $data = array(
					'response' => 'Cadastro realizado com sucesso!',
					'success' => true
				    );
				    echo json_encode($data);
                } else {
                    $data = array(
					   'response' => 'Cadastro realizado com sucesso!',
					   'success' => true
				    );
				    echo json_encode($data);
                }
			} else {
				$sql    = "DELETE FROM table_user WHERE user_email = '$email'";
				$result = mysqli_query($link, $sql);

				$data = array(
					'response' => 'Ocorreu um erro inesperado. Tente novamente mais tarde.',
					'success' => false
				);
				echo json_encode($data);
			}	
		} else {
			$data = array(
				'response' => 'Ocorreu um erro ao realizar seu cadastro. Tente novamente mais tarde.',
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