<?php
//Início da sessão
session_start();

//Arquivo de conexão com banco de dados
require_once('_classes/class.database.php');

//Compatibilidade com JSON
header('Content-Type: application/json');

//Conexão com o banco de dados
$database = new Database();
$link     = $database->conectarMySQL();

//Captura dos dados
$pub_categ  = $_POST['pubCateg'];
$id_autor   = $_SESSION['user_id'];
$data_pub   = $_POST['pubData'];
$titulo_pub = $_POST['pubTitulo'];
$texto_pub  = $_POST['pubTexto'];

if($link){
    $sql = "INSERT INTO table_pub (pub_title, pub_text, pub_theme, pub_date, pub_img, adm_id)
            VALUES ('$titulo_pub','$texto_pub','$pub_categ','$data_pub','none','$id_autor')";
    $result = mysqli_query($link, $sql);
    if ($result) {
        $data = array(
            'response' => 'Publicação realizada com sucesso.',
            'success' => true
        );
        echo json_encode($data);
    } else {
        $data = array(
            'response' => 'Houve um erro inesperado. Tente novamente mais tarde.',
            'success' => false
            
        );
        echo json_encode($data);
    }
} else {
    $data = array(
        'response' => 'Houve um erro de conexão com o banco de dados.',
        'success' => false
    );
    echo json_encode($data);
}
?>
