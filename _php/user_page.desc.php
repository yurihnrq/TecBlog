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
$desc_alt = $_POST['userDesc'];
$email    = $_SESSION['user_email'];
$id       = $_SESSION['user_id'];

//Verificando se houve conexão com o banco de dados
if($link){
	//Verificando se o e-mail inserido já não está cadastrado
    
	$sql      = "SELECT * FROM table_user WHERE user_email = '$email' AND id = '$id'";
	$result   = mysqli_query($link, $sql);
	$num_rows = mysqli_num_rows($result);
    
    if ($num_rows > 0) {
            $sql = "UPDATE table_user SET user_text = '$desc_alt' WHERE id = '$id'";
            $result = mysqli_query($link, $sql);
            
            if ($result) {
                $_SESSION['user_text'] = $desc_alt;
                $data = array(
                    'response' => 'Aleração realizada com sucesso!',
                    'success' => true
                );
                echo json_encode($data);   
            } else {
                $data = array(
                    'response' => 'Ocorreu um erro ao realizar a alteração. Tente novamente mais tarde.',
                    'success' => false
                );
                echo json_encode($data);
            }
    } else {	
    $data = array(
		'response' => 'Não foi possível realizar a alteração. Tente novamente mais tarde.',
		'success' => false);
	echo json_encode($data);
        
    }
	
} else{
	$data = array(
		'response' => 'Ocorreu um erro durante a conexão com o servidor. Tente novamente mais tarde.',
		'success' => false);
	echo json_encode($data);
}

?>