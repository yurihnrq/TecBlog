<?php
//Verificar se a sessão já não está aberta.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_cache_expire();
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
$_SESSION['url'] = $_SERVER['REQUEST_URI'];


if ($_SESSION['user_adm'] !== 'adm') {
    header('Location: ../');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br" style="height: 100vh;">
	<head>
		<title>TecBlog - Publicar</title>
        
        
        <!-- TinyMCE -->
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=uaaicoceo6qchtcd0f1110x211p29963w76anxhwkgx1diq8"></script>
        <script>
            tinymce.init({ 
                selector: "textarea",
                plugins: "paste",
                theme: 'modern',
                mobile: {
                    theme: 'mobile',
                    plugins: [ 'autosave', 'lists', 'autolink' ]
                }
            });
        </script>
        
        <!-- FACEBOOK APP -->
        <meta property="fb:app_id" content="598667527214963" />
        
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="_css/publicar.css">

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
    <?php
        if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_email']) && !isset($_SESSION['user_name'])){
    ?>
        <body style="
             padding-top: 0px; 
             background: url('../_img/home.jpg'); 
             background-attachment: fixed; 
             background-size: cover;
        ">
    <?php
        } else {
    ?>
	   <body style="background: white; padding-top: 100px;">
    <?php
        }
    ?>
        <!-- Código para funcionamento de plugins do Facebook -->
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.1';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
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
                            <a class="dropdown-item nav-link" href="../painel/">Painel</a>
                            <?php
                            }
                            ?>
                            <a class="dropdown-item nav-link" href="../user">Opções</a>
                            <button class="dropdown-item nav-link" id="btn_logout" href="#">Sair</button>
                        </div>
					</li>
                    <?php
                        } else {
                    ?>
					<li class="nav-item">
						<a id="nav_entrar" class="nav-link" href="../login">
							Entrar
						</a>
					</li>

					<li class="nav-item">
						<a id="nav_cadastro" class="nav-link" href="../cadastro">
							Inscrever-se
						</a>
					</li>
                    <?php
                        }
                    ?>
				</ul>
			</div>
		</nav>
        <div id="conteudo" class="container" align="center">
			<div class="row">
                <div class="col-lg-12">
                    <h3 style="margin-bottom: 20px;">Publicar</h3>
                    <form id="form_publicar" class="parsley_validate" novalidate method="post" action="">
                        <input type="hidden" name="pubAutorID" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" id="pub_data" name="pubData">
                        <h5>Selecione uma categoria</h5>
                        <div class="form-row justify-content-center">
                            <select class="custom-select select_publica" name="pubCateg">
                                <option value="hardware">
                                    Hardware
                                </option>
                                <option value="software">
                                    Software
                                </option>  
                                <option value="games">
                                    Jogos
                                </option>
                            </select>
                        </div><br>
                        <h5>Título da publicação</h5>
                        <div class="form-row justify-content-center">
                            <input type="text" class="form-control pub_titulo" name="pubTitulo" placeholder="Insira um título">
                        </div>
                        <br>
                        <div class="form-row justify-content-center">
                            <textarea class="form-control texto_publica" maxlength="10000" data-parsley-required required
                            placeholder="Digite seu texto aqui..."
                            data-parsley-length-message = "O texto deve conter no máximo 10000 caracteres."
                            data-parsley-required-message="Por favor, preencha o formulário." name="pubTexto"></textarea>
                        </div><br>
                        <div class="form-row form-row-btn justify-content-end">
                            <div class="btn-group">
                                <button class="btn btn-info btnLeft">Publicar</button>
                                <button type="reset" class="btn btn-dark btnRight">Voltar para Home</button>
                            </div>
                        </div><br>

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
		<script type="text/javascript" src="../_javascript/_ajax/ajax.cadastro.js"></script>
        <script type="text/javascript" src="../_javascript/_ajax/ajax.logout-page.js"></script>
        <script type="text/javascript" src="../_javascript/_ajax/ajax.publicar.js"></script>
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
