<?php

session_start();

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['user_adm']);
unset($_SESSION['url']);

//Apagando todos os dados da sessão:
session_unset();
unset($_SESSION);
//Destruindo a sessão:
session_destroy();

$data = array(
    'response' => 'Sua sessão foi finalizada!',
    'success' => true
);

echo json_encode($data);

?>