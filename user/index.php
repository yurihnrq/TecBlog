<?php
//Verificar se a sessão já não está aberta.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_cache_expire();
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}

if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_email'])){
    header('Location: ../');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br" style="height: 100vh;">
	<head>
		<title>TecBlog</title>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="_css/user.css">

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
	</head>
	<body>
		

		<!---------------------- MODAL's ---------------------->
		<!-- Modal ENTRAR -->
		<!-- <div class="modal fade" id="modal_ENTRAR" tabindex="-1" role="dialog" 
		aria-labelledby="modalLogin" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLabel">Login</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body">
			      		<form id="form_modal_entrar" method="post" action="_php/user_auth.php">
			       			<label for="campo_email">E-mail</label>
			        		<br>
			        		<input id="campo_email" type="email" name="inputEmail" class="form-control">
			        		<br>

			       			<label for="campo_senha">Senha</label>
			       			<br>
			        		<input id="campo_senha" type="password" name="inputPassword" class="form-control">
			        		<br>
			        		<button type="submit" class="btn btn-secondary btn_modal_submit" data-dismiss="modal">Entrar</button>
		        			<button type="reset" class="btn btn-primary btn_modal_cancel">Limpar</button>
			        	</form>
			      	</div>
		      		<div class="modal-footer">
		        		<h5>Yuri Henrique B. Maciel | &copy; 2018</h5>
		      		</div>
				</div>
			</div>
		</div> -->

		<!-- Modal CADASTRO -->
		<!-- <div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" 
		aria-labelledby="modalCadastro" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
			        	<button id="close_cadastro" type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body">
			      		<form id="form_modal_cadastro" class="pasrley_validate" 
			      		name="formCadastro" action="" method="post" enctype="multipart/form-data" novalidate>

			      			<div class="form-row">
				      			<label>Como deseja ser chamado?</label>
				      			<br>
				      			<input id="cadastro_nome" type="text" name="cadastroNome" 
				      			class="form-control" maxlength="40" minlength="4" required 
				      			placeholder="Digite seu apelido ou nome" 
				      			data-parsley-length-message = "O nome deve conter ao menos 4."
				      			data-parsley-required-message="Campo obrigatório.">
			      			</div><br>

			      			<div class="form-row">
				       			<label for="cadastro_email">E-mail</label>
				        		<br>
				        		<input id="cadastro_email" type="email" name="cadastroEmail" 
				        		class="form-control" maxlength="50" required placeholder="Digite seu email"
				        		data-parsley-type-message = "Insira um e-mail válido."
				        		data-parsley-required-message="Campo obrigatório.">
			        		</div><br>

			        		<div class="form-row">
				       			<label for="cadastro_senha">Senha</label>
				       			<br>
				        		<input id="cadastro_senha" type="password" name="cadastroSenha" 
				        		class="form-control" required data-parsley-minlength="8" maxlength="16" 
				        		data-parsley-minlength-message = "A senha deve conter ao menos 8 caracteres."
				        		placeholder="Crie uma senha de 8 a 16 caracteres"
				        		data-parsley-required-message="Campo obrigatório.">
			        		</div><br>

			        		<div class="form-row">
				        		<label for="cadastro_ctr_senha">Repita a senha</label>
				       			<br>
				        		<input id="cadastro_ctr_senha" type="password" name="cadastroRSenha" 
				        		class="form-control" data-parsley-equalto="#cadastro_senha"
				        		data-parsley-equalto-message = "As senhas não correspondem."
				        		required maxlength="16" placeholder="Confirme sua senha"
				        		data-parsley-required-message="Repita sua senha.">
			        		</div><br>
			      	</div>
		      		<div class="modal-footer">
		        		<button type="submit" id="btn_cadastro" name="btnCadastro" class="btn btn-secondary btn_modal_submit">Cadastrar</button>
		        		<button type="reset" class="btn btn-primary btn_modal_cancel">Limpar</button>
		        		</form>
		      		</div>
				</div>
			</div>
		</div>
 -->
		<!-- MODAL Loading -->
		<!-- <button type="button" id="btn_loader" style="display: none;" class="btn btn-primary" 
		data-toggle="modal" data-target="#modal_loader" data-backdrop="static" data-keyboard="false">
		  	Launch
		</button>

		<div class="modal fade" id="modal_loader" tabindex="-1" role="dialog" 
		aria-labelledby="modalLoader" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="loader_title">Carregando...</h5>
		        		<button id="close_loader" type="button" style="display: none;" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
			      	<div id="loader_body" class="modal-body" align="center">
			        	<img src="_img/purple-loader.gif" alt="Loader" width="150">
			      	</div>
			      	<div class="modal-footer justify-content-start">
			        	<h5>Por favor, aguarde.</h5>
			      	</div>
		    	</div>
		  	</div>
		</div> -->

		<!-- MODAL Success -->
		<!-- <button type="button" id="btn_success" style="display: none;" class="btn btn-primary" data-toggle="modal" data-target="#modal_success" data-backdrop="static" data-keyboard="false">
		  	Launch
		</button>

		<div class="modal fade" id="modal_success" tabindex="-1" role="dialog" 
		aria-labelledby="modalSuccess" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="modalParaSuccess">Cadastro realizado com sucesso!</h5>
		        		<button id="close_success" type="button" style="display: none;" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
			      	<div id="loader_body" class="modal-body" align="center">
			        	<h5>
			        		Você será redirecionado para a página de login.
			        	</h5>
			      	</div>
			      	<div class="modal-footer justify-content-start">
			        	<h5>Por favor, aguarde...</h5>
			      	</div>
		    	</div>
		  	</div>
		</div> -->

		
		<nav id="navbar_01" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
			<a class="navbar-brand" href="../"><img src="../_img/white-icon.png" width="30px"> TecBlog</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_nav" aria-controls="navbar_nav" aria-expanded="false" aria-label="botaoNavegação">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbar_nav">
				<ul class="nav navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../">
							Home
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="../contato/">
							Contato
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="../publicacoes/">
							Posts
						</a>
					</li>
					<li class="collapse navbar-collapse nav-item divisor_01" role="separator">

			  		</li>
			  		<li class="collapse nav-item divisor_02" role="separator" id="navbar_nav">

			  		</li>
                    <?php
                        if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])){
                    ?>
                    <li class="nav-item dropdown">
						<a id="nav_user" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" 
                           aria-haspopup="true" aria-expanded="false">
							<?php 
                            $user_name = $_SESSION['user_name'];
                            $pos = strpos($user_name, " ");
                            if ($pos) {
                                echo substr($user_name, 0, $pos);   
                            } else {
                                echo $user_name;
                            }
                            ?>
						</a>
                        <div class="dropdown-menu dropdown-menu-right fade" aria-labelledby="dropdownMenuButton">
                            <?php 
                            if(isset($_SESSION['user_adm']) && $_SESSION['user_adm'] == 'adm'){ 
                            ?>
                            <a class="dropdown-item nav-link" href="../publicar/">Publicar</a>
                            <a class="dropdown-item nav-link" href="../painel/">Painel</a>
                            <?php
                            }
                            ?>
                            <button class="dropdown-item nav-link" id="btn_logout">Sair</button>                            
                        </div>
					</li>
                    <?php
                        } else {
                    ?>
					<li class="nav-item">
						<a id="nav_entrar" class="nav-link" href="login/">
							Entrar
						</a>
					</li>

					<li class="nav-item">
						<a id="nav_cadastro" class="nav-link" href="cadastro/">
							Inscrever-se
						</a>
					</li>
                    <?php
                        }
                    ?>
				</ul>
			</div>
		</nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <h1>Dados da conta</h1>
                    <form id="form_user" class="parsley_validate" novalidate method="post" action="">
                        <div class="form-row" align="left">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        E-mail
                                    </div>
                                </div>
                                <input type="email" class="form-control" id="user_email" name="userEmail"
                                placeholder="********" required
                                value="<?php echo $_SESSION['user_email']; ?>" disabled
                                data-parsley-required-message="O campo não pode estar vazio."
                                data-parsley-type-message="Insira um e-mail válido."
                                data-parsley-validate-if-empty="true">
                            </div>
                        </div><br>
                        <div class="form-row" align="left">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Nome
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="user_name" name="userName"
                                required minlength="4"value="<?php echo $_SESSION['user_name']; ?>" 
                                disabled data-parsley-required-message="O campo não pode estar vazio."
                                data-parsley-length-message = "O nome deve conter ao menos 4."
                                data-parsley-validate-if-empty="true">
                            </div>
                        </div><br>
                        <div class="form-row" align="left">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Senha
                                    </div>
                                </div>
                                <input type="password" class="form-control" id="user_senha" name="userSenha"
                                placeholder="********" required minlength="4" disabled maxlength="16"
                                data-parsley-required-message="É necessário confirmar sua senha."
                                data-parsley-validate-if-empty="true">
                            </div>
                        </div><br>
                        <div class="btn-group justify-content-end" style="width: 100%;">
                            <button type="button" class="btn btn-info btnLeft btnAlterar">Alterar</button>
                            <button type="submit" class="btn btn-info btnLeft btnEnviar" style="display: none;">Enviar</button>
                            <a class="btn btn-dark btnRight" href="../">Voltar para Home</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <h1>Sobre você</h1>
                    <form id="form_desc" class="parsley_validate" novalidate method="post" action="">
                        <textarea class="form-control areaDesc" name="userDesc"><?php if(isset($_SESSION['user_text'])){echo $_SESSION['user_text'];}?></textarea>
                        <input type="hidden" id="hidden_text" value="<?php echo $_SESSION['user_text']; ?>">
                        <br>
                        <div class="btn-group justify-content-end" style="width: 100%;">
                            <button type="submit" class="btnDesc btn btn-info btnLeft" disabled>Enviar</button>
                            <button class="btn btn-dark btnRight descReset" type="reset">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
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
		<script type="text/javascript" src="../_javascript/_ajax/ajax.user-page.js"></script>
        <script type="text/javascript" src="../_javascript/_ajax/ajax.logout-page.js"></script>
		<!-- JavaScript --> 
		<script type="text/javascript">
			$('body').bind('click', function(e) {
                if($(e.target).closest('.navbar').length == 0) {
                    // click happened outside of .navbar, so hide
                    var opened = $('.navbar-collapse').hasClass('collapse show');
                    if ( opened === true ) {
                        $('#navbar_nav').collapse('hide');
                    }
                }
		</script>
	</body>
</html>
<?php
	if (isset($_GET['login']) && $_GET['login'] == 1) {
	?>
		<script type="text/javascript">
			document.getElementById("nav_entrar").click();
		</script>
	<?php
	}
?>
