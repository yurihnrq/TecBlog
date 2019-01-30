<?php
//Verificar se a sessão já não está aberta.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_cache_expire();
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
$_SESSION['url'] = $_SERVER['REQUEST_URI'];


?>
<!DOCTYPE html>
<html lang="pt-br" style="height: 100vh;">
	<head>
		<title>TecBlog - Publicações</title>
        
        
        <!-- TinyMCE -->
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=uaaicoceo6qchtcd0f1110x211p29963w76anxhwkgx1diq8"></script>
        <script>
            tinymce.init({ 
                selector: "textarea",
                plugins: "paste",
                menubar: "edit",
                toolbar: "paste"
            });
        </script>
        
        <!-- FACEBOOK APP -->
        <meta property="fb:app_id" content="598667527214963" />
        
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="_css/publicacoes.css">

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
    <body style="background: white; padding-top: 100px;">
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
                                <a class="dropdown-item nav-link" href="../publicar/">Publicar</a>
                                <a class="dropdown-item nav-link" href="../painel/">Painel</a>
                            <?php
                            }
                            ?>
                            <a class="dropdown-item nav-link" href="../user/">Opções</a>
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
			<?php
            //Arquivo de conexão com banco de dados
            require_once('../_php/_classes/class.database.php');
            
            //Conexão com o banco de dados
            $database = new Database();
            $link     = $database->conectarMySQL();
            
            //Verificando conexão com o banco de dados
            if ($link) {
                $sql = "SELECT * FROM table_pub ORDER BY id DESC";
                $result = mysqli_query($link, $sql);
                $linhas = mysqli_num_rows($result);
                
                //Verificando se há publicações
                if ($linhas > 0) {
                    ?>
                    <h1>Publicações</h1>
                    <?php
                    while($publicacoes = mysqli_fetch_array($result)){
                    ?>
                        <div class="div-pub col-lg-12" align="center">
                            <h3 class="pub-title"><?php echo $publicacoes['pub_title']; ?></h3>
                            <div class="div-pub-text" align="left">
                                <?php echo $publicacoes['pub_text']; ?>
                            </div>
                            <div align="right">
                                <?php
                                    $autor = $publicacoes['adm_id'];
                                    $sql_text = "SELECT * FROM table_user WHERE id = '$autor'";
                                    $result_autor = mysqli_query($link, $sql_text);
                                    $dados_autor = mysqli_fetch_array($result_autor);
                                ?>
                                <small class="form-text text-muted pub_autor">
                                    <?php
                                    if ($dados_autor['user_text'] === null || $dados_autor['user_text'] === "") {
                                    ?>
                                        Por <span style="cursor: help; font-weight: bold;" data-toggle="tooltip" data-placement="top" title="Não há descrição deste autor.">
                                        <?php
                                            echo $dados_autor['user_name'];
                                        ?></span>
                                        , em 
                                        <?php 
                                            $mysql_date = $publicacoes['pub_date'];
                                            $formatted_date = date('d/m/Y', strtotime($mysql_date));
                                            echo $formatted_date;
                                        ?>
                                        .
                                    <?php
                                    } else {
                                    ?>
                                        Por <span style="cursor: help; font-weight: bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $dados_autor['user_text']; ?>">
                                        <?php
                                            echo $dados_autor['user_name'];
                                        ?></span>
                                        , em 
                                        <?php 
                                            $mysql_date = $publicacoes['pub_date'];
                                            $formatted_date = date('d/m/Y', strtotime($mysql_date));
                                            echo $formatted_date;
                                        ?>
                                        .
                                    <?php
                                    }
                                    ?>
                                </small>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                ?>
                    <h1>Ainda não há publicações. :(</h1>
                <?php
                }
            } else {
            ?>
                <h1>Não foi possível acessar as publicações. :(</h1>
            <?php
            }
            
            
            ?>
        </div>
        <div class="div_footer" style="position: fixed; bottom: 0px;" align="center">
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
                window.addEventListener("load", function() {
                    window. scrollTo(0, 0); 
                });
            });
            
            $(document).ready(function (){
                var alturaCorpo = $('#conteudo').height();
                if (alturaCorpo >= 395) {
                    $('.div_footer').css('cssText','position: relative; bottom: auto;')
                }
            });
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
		</script>
	</body>
</html>
