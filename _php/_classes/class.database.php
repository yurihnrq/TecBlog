<?php

class Database{
	
	private $host = '127.0.0.1';
	private $user = 'root';
	private $password = '';
	private $database = 'tecblog_db';
	
	public function conectarMySQL(){
		
		//Criando conexão com o banco de dados
		$link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		
		//Definindo tabela de caracteres para que erros envolvendo caracteres sejam minimizados
		mysqli_set_charset($link, 'utf8');
		
		//Verificando se houve erros durante a conexão
		if(!$link){
			return false;
		}
		
		return $link;
	}
	
}

?>