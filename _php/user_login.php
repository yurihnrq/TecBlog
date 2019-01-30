<?php

//Arquivo de conexão com banco de dados
require_once('_classes/class.database.php');

//Compatibilidade com JSON
header('Content-Type: application/json');

//Conexão com o banco de dados
$database = new Database();
$link     = $database->conectarMySQL();

//Capturando valores passados por POST via Ajax
$email   = $_POST['loginEmail'];
$senha   = $_POST['loginSenha'];

$loginSenha_cod = md5($senha);

//Realizando requisição no banco de dados
$sql    = "SELECT * FROM table_user WHERE user_email = '$email' AND user_pass = '$loginSenha_cod'";
//O comando SQL requisita email e senha pertencentes à mesma tupla
$result = mysqli_query($link, $sql);
$row = mysqli_num_rows($result);
//Verificando se email e senha existem
if ($row > 0) {
	$user = mysqli_fetch_array($result);
    //Verificar se a sessão não já está aberta.
	if (session_status() !== PHP_SESSION_ACTIVE) {
        //Inicia sessão
        session_start();
		$_SESSION['user_id']    = $user[     'id'    ];
		$_SESSION['user_name']  = $user[ 'user_name' ];
		$_SESSION['user_email'] = $user['user_email' ];
        $_SESSION['user_adm']   = $user[ 'user_adm'  ];
        if ($user['user_text'] !== null) {
            $_SESSION['user_text'] = $user['user_text'];
        }
        if (isset($_SESSION['url']) && $_SESSION['url'] !== null && $_SESSION['url'] !== "") {    
            $data = array(
                'response' => 'Login realizado com sucesso!',
                'success' => true,
                'url' => $_SESSION['url']
            );
        } else {
            $data = array(
                'response' => 'Login realizado com sucesso!',
                'success' => true,
                'url' => false
            );
        }
		echo json_encode($data);
	} else {
		$data = array(
			'response' => 'Já existe uma sessão ativa!',
			'success' => false
		);
		echo json_encode($data);
	}
} else {
	$data = array(
		'response' => 'Usuário ou senha incorretos!',
		'success' => false,
		'invalid' => true
	);
	echo json_encode($data);
}


?>