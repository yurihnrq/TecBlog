<?php
//Verificar se a sessão já não está aberta.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_cache_expire();
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
?>
<!DOCTYPE html>
<html lang="pt-br" style="height: 100vh;">

<head>
    <title>TecBlog</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="_css/style.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Normalize -->
    <link rel="stylesheet" type="text/css" href="_normalize/normalize.css">

    <!-- Meta tags obrigatórias -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">

    <!-- Ícone -->
    <link rel="icon" type="x-icon" href="_img/black-icon.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="_bootstrap/css/bootstrap.css">
</head>

<body>
    <nav id="navbar_01" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="_img/white-icon.png" width="30px"> TecBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_nav" aria-controls="navbar_nav" aria-expanded="false" aria-label="botaoNavegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbar_nav">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato/">
                        Contato
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="publicacoes/">
                        Posts
                    </a>
                </li>
                <li class="collapse navbar-collapse nav-item divisor_01" role="separator">

                </li>
                <li class="collapse nav-item divisor_02" role="separator" id="navbar_nav">

                </li>
                <?php
                if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
                    ?>
                <li class="nav-item dropdown">
                    <a id="nav_user" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        if (isset($_SESSION['user_adm']) && $_SESSION['user_adm'] == 'adm') {
                            ?>
                        <a class="dropdown-item nav-link" href="publicar/">Publicar</a>
                        <a class="dropdown-item nav-link" href="painel/">Painel</a>
                        <?php

                    }
                    ?>
                        <a class="dropdown-item nav-link" href="user/">Opções</a>
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
    <div class="home">
        <div class="home_title">
            <?php
            if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name'])) {
                ?>
            <h1>
                Seja bem vindo,
                <?php
                if ($pos) {
                    echo substr($user_name, 0, $pos) . '.';
                } else {
                    echo $user_name . '.';
                };
                ?>
            </h1>
            <div id="btn_gp">
                <a href="user/" class="btn btn-lg">
                    Painel do usuário
                </a>
                <a href="publicacoes/" class="btn btn-lg">
                    Acesse agora nossas publicações
                </a>
            </div>
            <?php

        } else {
            ?>
            <h1>Tudo sobre tecnologia</h1>
            <div id="btn_gp">
                <a class="btn btn-lg" href="cadastro/">
                    Não é cadastrado?
                </a>
                <a class="btn btn-lg" href="publicacoes/">
                    Acesse agora nossas publicações
                </a>
            </div>
            <?php

        }
        ?>
        </div>
    </div>
    <div class="container conteudo_01">
        <div class="row">
            <div class="col-lg-6 col_text">
                <h2>Um pouco de tudo...</h2>
                <p class="text-justify p_01">
                    No Tecblog, você poderá encontrar matérias e publicações sobre vários âmbitos da tecnologia!
                </p>
                <h4>Hardwares e dispositivos:</h4>
                <p class="text-justify p_01">
                    Descubra e tenha conhecimento sobre novas tecnologias que estão sendo empregadas nos celulares e
                    computadores de
                    última geração.
                </p>
                <h4>Softwares:</h4>
                <p class="text-justify p_01">
                    Conheça aplicativos úteis para o seu dia a dia. Softwares que irão agilizar suas tarefas ou quebrar
                    um galho
                    quando você precisar.
                </p>
                <h4>Jogos:</h4>
                <p class="text-justify p_01">
                    Acompanhe os jogos em desenvolvimento, veja truques e dicas para seus jogos favoritos. Esteja em
                    dia no mundo dos
                    games!
                </p>
            </div>
            <div class="col-lg-6 col_img">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid img_content d-none d-lg-block" src="_img/hardware.jpg">
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid img_content d-none d-lg-block" src="_img/software.jpg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid img_content" src="_img/technology.png">
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid img_content d-none d-md-block" src="_img/gaming.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container conteudo_02">
        <div class="row">
            <div class="col-lg-7 div_texto">
                <div class="row">
                    <h2>Não perca nossas publicações!</h2>
                    <p class="text-justify p_02">
                        Ao inscrever-se em nosso site, você receberá todas as atualizações e será avisado sobre novas
                        publicações
                        diretamente em seu email. Não há maneira melhor para estar por dentro das novidades!
                    </p>
                    <h2>Somente o que você quiser!</h2>
                    <p class="text-justify p_02">
                        Ao acessar nossa página de publicações, você pode escolher o tema das mesmas! Assim você
                        seleciona somente o que
                        deseja ler, aproveitando ao máximo seu tempo.
                    </p>
                    <h2>Contate os administradores</h2>
                    <p class="text-justify p_02">
                        Usuários cadastrados tem acesso exclusivo à nossa página de contato! Dê ideias à nossos
                        administradores e ajude
                        no desenvolvimento do <strong>nosso</strong> blog!
                    </p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row div_img_email">
                    <img src="_img/email-purple.png" class="img-fluid img_email">
                </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid footer">
        <div align="center">
            <div class="btngp_social">
                <a href="http://www.facebook.com/yurihbernardes" target="_blank">
                    <button class="btn btn-lg btn_face btn_social">
                        Facebook
                    </button>
                </a>
                <a href="https://www.instagram.com/yurihbernardes/" target="_blank">
                    <button class="btn btn-lg btn_insta btn_social">
                        Instagram
                    </button>
                </a>
                <a href="https://twitter.com/yurihbernardes" target="_blank">
                    <button class="btn btn-lg btn_twitter btn_social">
                        Twitter
                    </button>
                </a>
            </div>
        </div>
        <div>
            <h1 class="text-center">Yuri Henrique B. Maciel | &copy; 2018</h1>
        </div>
    </footer>
    <!-- jQuery, Popper.js e Boostrap JS -->
    <script src="_javascript/_jquery/jquery-3.3.1.min.js">
    </script>
    <script src="_javascript/_popper/popper.min.js">
    </script>
    <script src="_bootstrap/js/bootstrap.min.js">
    </script>
    <!-- Validação -->
    <script type="text/javascript" src="_javascript/_parsley/parsley.min.js">
    </script>
    <script type="text/javascript" src="_javascript/_parsley/parsley.validate.js">
    </script>
    <!-- Ajax -->
    <script type="text/javascript" src="_javascript/_ajax/ajax.cadastro.js">
    </script>
    <script type="text/javascript" src="_javascript/_ajax/ajax.logout.js">
    </script>
    <!-- JavaScript -->
    <script type="text/javascript">
        $('body').bind('click', function(e) {
            if ($(e.target).closest('.navbar').length == 0) {
                // click happened outside of .navbar, so hide
                var opened = $('.navbar-collapse').hasClass('collapse show');
                if (opened === true) {
                    $('#navbar_nav').collapse('hide');
                }
            }
        });

    </script>
</body>

</html>
