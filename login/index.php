<?php
session_start();

if(isset($_SESSION['user_name'])){
    header('Location: ../');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>TecBlog - Entrar</title>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="../_css/style.css">
		<link rel="stylesheet" type="text/css" href="_css/login.css">

		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- Normalize -->
		<link rel="stylesheet" type="text/css" href="../_normalize/normalize.css">

		<!-- Meta tags obrigatórias -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta charset="utf-8">

		<!-- Ícone -->
		<link rel="icon" type="x-icon" href="../_img/black-icon.png">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="../_bootstrap/css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	</head>
	<body id="xd">
		<!---------------------- MODAL's ---------------------->
		<!-- MODAL Loading -->
		<div class="modal fade" id="modal_success" tabindex="-1" role="dialog" 
		aria-labelledby="modalSuccess" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="modalParaLoader">Carregando...</h5>
		        		<button id="close_success" type="button" style="display: none;" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
			      	<div id="loader_body" class="modal-body" align="center">
			        	<img src="../_img/purple-loader.gif" alt="Loader" width="150">
			      	</div>
			      	<div class="modal-footer justify-content-start">
			        	<h5>Por favor, aguarde.</h5>
			      	</div>
		    	</div>
		  	</div>
		</div>

		<div id="conteudo" class="container-fluid" align="center">
			<div class="header">
				<h1>
					<a href="../" class="linkHome">
						<img src="../_img/black-icon.png" width="50px"> TecBlog
					</a>
				</h1>	
			</div>
			<h3 style="margin-bottom: 20px;">Entrar</h3>
			<form id="form_login" class="parsley_validate" novalidate method="post" action="">
				<div class="form-row" align="left">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								E-mail
							</div>
						</div>
						<input type="email" class="form-control" id="login_email"  name="loginEmail" 
						aria-describedby="emailHelp" placeholder="user@email.com" required
						maxlength="50" data-parsley-length-message = "O nome deve conter ao menos 4."
				      	data-parsley-required-message="Insira seu e-mail."
				      	data-parsley-type-message="Insira um e-mail válido."
				      	data-parsley-validate-if-empty="true">
					</div>
					<small id="email_message" class="form-text text-muted">Não iremos compartilhar seu e-mail com ninguém</small>
				</div><br>
				<div class="form-row" align="left">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								Senha
							</div>
						</div>
						<input type="password" class="form-control" id="login_senha" name="loginSenha"
						placeholder="********" required data-parsley-minlength="8" maxlength="16" 
						data-parsley-minlength-message = "A senha deve conter ao menos 8 caracteres."
						data-parsley-required-message="Insira sua senha."
						data-parsley-validate-if-empty="true">
					</div>
				</div><br>
				<div class="btn-group justify-content-end" style="width: 100%;">
					<button type="submit" class="btn btn-info btnLeft">Entrar</button>
					<a class="btn btn-dark btnRight" href="../">Voltar para Home</a>
				</div>
			</form>
		</div>
		<div class="div_footer" align="center">
			<small class="form-text text-muted small_top">
				Yuri Henrique B. Maciel | &copy; 2018
			</small>
		</div>
		
		<!-- jQuery, Popper.js e Boostrap JS -->
		<script src="../_javascript/_jquery/jquery-3.3.1.min.js"></script>
		<script src="../_javascript/_popper/popper.min.js"></script>
		<script src="../_bootstrap/js/bootstrap.min.js"></script>
		<!-- Validação -->
		<script type="text/javascript" src="../_javascript/_parsley/parsley.min.js"></script>
		<script type="text/javascript" src="../_javascript/_parsley/parsley.validate.js"></script>
		<!-- Ajax -->
		<script type="text/javascript" src="../_javascript/_ajax/ajax.login.js"></script>
		<!-- JavaScript --> 
		<script type="text/javascript">
			
		</script>
	</body>
</html>
