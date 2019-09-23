<!-- BEGIN main -->
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta property="og:url"           content="https://bibliaparacasais.com.br/" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="In&iacute;cio - Bíblia para Estudo de Casais" />
<meta property="og:description"   content="Bíblia para Estudo de Casais" />

<title>B&iacute;blia para casais</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
    
<body class="theme-light" data-background="none" data-highlight="red2">
<div id="page">
        
    <div id="page-preloader">
        <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
    </div>
     
<!-- <div class="header header-fixed header-logo-center">-->
 <!--  <a class="header-title">B&iacute;blia Para Casais</a>-->
		<!--<a href="#" class="back-button header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>-->
		<!--<a href="#" data-toggle-theme-switch class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>-->
	<!-- </div>-->
   <form class="sidebar-login" action="cadastro/insere" method="post" name="cadastro">
 <div class="page-content header-clear-medium">   
        <center><img src="logo.png" width="100" style="margin-top: -30px;"></center>
            <div class="content-boxed left-40 right-40">
                <div class="content top-10 bottom-10">
                    <h1 class="center-text uppercase ultrabold fa-3x">Cadastre-se</h1>
                    <p class="center-text color-highlight font-11 under-heading bottom-30">
                       Se ainda n&atilde;o possui uma conta, cadastre-se aqui.
                    </p>
                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-user font-11"></i>
                        <span>Nome</span>
                        <em></em>
                        <input type="name" placeholder="Nome" name="nome" required="required">
                    </div> 
                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-at"></i>
                        <span>E-mail</span>
                        <em>(ser&aacute; o seu login)</em>
                        <input type="email" placeholder="Email"  name="email" required="required">
                    </div>         
                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-lock font-11"></i>
                        <span>Senha</span>
                        <em></em>
                        <input type="password" placeholder="Escolha uma senha" name="senha" required="required">
                    </div>          
                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-lock font-11"></i>
                        <span>Confirme sua senha</span>
                        <em></em>
                        <input type="password" placeholder="Confirme sua senha"  name="senha2" required="required">
                    </div>         
                    <div class="clear"></div>
                     <button type="submit" class="button button-full button-m shadow-large button-round-small bg-green1-dark top-30 bottom-0" style="width:100%;">CONCLUIR CADASTRO</button>
                    <div class="divider bottom-20"></div>
                    <div class="bottom-20">
                       <a href="login" class="back-button center-text font-11 color-theme">J&aacute; possui uma conta? Entre aqui.</a>
                    </div>
                    <!--<a href="3rd_party/sdk-facebook/fbconfig.php" class="back-button button button-icon button-full button-m shadow-large button-round-small font-11 bg-facebook top-30 bottom-0"><i class="fab fa-facebook-f"></i>Entrar com Facebook</a>-->
                    <a href="{google_login_url}" class="back-button button button-icon button-full button-m shadow-large button-round-small font-11 bg-google top-10 bottom-40"><i class="fab fa-google"></i>Entrar com Google</a>

                </div>
            </div>

                    
    </div>
   </form>

   
   
   </div>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  
    <script language="javascript">
       $(function () {
    $(".post_unico").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".post_unico:hidden").slice(0, 4).slideDown();
        if ($(".post_unico:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});


 $(function () {
    $(".post_unico2").slice(0, 2).show();
    $("#loadMore2").on('click', function (e) {
        e.preventDefault();
        $(".post_unico2:hidden").slice(0, 2).slideDown();
        if ($(".post_unico2:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});

   $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.totop a').fadeIn();
    } else {
        $('.totop a').fadeOut();
    }
});

var button_backtop = $('#button_backtop');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    button_backtop.addClass('show');
  } else {
    button_backtop.removeClass('show');
  }
});

button_backtop.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

function shareFacebook(url,titulo){

        var w = 630;
        var h = 360;

        var left = screen.width/2 - 630/2;
        var top = screen.height/2 - 360/2;

        window.open('http://www.facebook.com/sharer.php?u='+url+'&t='+url, 'Compartilhar no facebook', 'toolbar=no, location=no, directories=no, status=no, ' + 'menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+ ', height=' + h + ', top=' + top + ', left=' + left);
 }

</script>
</body>
   
   

<!-- END main -->



<!-- BEGIN continuar -->
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta property="og:url"           content="https://bibliaparacasais.com.br/" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="In&iacute;cio - Bíblia para Estudo de Casais" />
<meta property="og:description"   content="Bíblia para Estudo de Casais" />

<title>B&iacute;blia para casais</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/style.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/framework.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}fonts/css/fontawesome-all.min.css">
<link rel="shortcut icon" href="{ABS_LINK}favicon.ico" type="image/x-icon" />

</head>
    
<body class="theme-light" data-background="none" data-highlight="red2">
<div id="page">
        
    <div id="page-preloader">
        <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
    </div> <div class="page-content header-clear-medium">  
       <center><img src="{ABS_LINK}logo.png" width="100" style="margin-top: -30px;"></center><br><br>
            <center> <h1>Parab&eacute;ns! Seu cadastro foi feito com sucesso.</h1></center>
           <center>  <p>Um e-mail de confirma&ccedil;&atilde;o foi enviado para voc&ecirc;.</p></center>
            <a href="login" class="button button-full button-m shadow-large button-round-small bg-green1-dark top-30 bottom-30">CONTINUAR</a>
   
    </div>                           
   </div>
<script type="text/javascript" src="{ABS_LINK}scripts/jquery.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/plugins.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/custom.js"></script>
</body>
<!-- END continuar -->


<!-- BEGIN confirm -->
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta property="og:url"           content="https://bibliaparacasais.com.br/" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="In&iacute;cio - Bíblia para Estudo de Casais" />
<meta property="og:description"   content="Bíblia para Estudo de Casais" />

<title>B&iacute;blia para casais</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/style.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/framework.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}fonts/css/fontawesome-all.min.css">
<link rel="shortcut icon" href="{ABS_LINK}favicon.ico" type="image/x-icon" />

</head>
    
<body class="theme-light" data-background="none" data-highlight="red2">
<div id="page">
        
    <div id="page-preloader">
        <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
    </div> <div class="page-content header-clear-medium">  
       <center><img src="{ABS_LINK}logo.png" width="100" style="margin-top: -30px;"></center><br>
            <center> <h1>Parab&eacute;ns! Seu cadastro foi feito com sucesso.</h1></center><br><br>
            <center><h3>Confirme seu cadastro.</h3></center>
           <center>  <p>Um e-mail de confirma&ccedil;&atilde;o foi enviado para voc&ecirc;.</p></center>
            <a href="home" class="button button-full button-m shadow-large button-round-small bg-green1-dark top-30 bottom-30">CONTINUAR</a>
   
    </div>                           
   </div>
<script type="text/javascript" src="{ABS_LINK}scripts/jquery.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/plugins.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/custom.js"></script>
</body>
<!-- END confirm -->

<!-- BEGIN unconfirmed -->
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta property="og:url"           content="https://bibliaparacasais.com.br/" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="In&iacute;cio - Bíblia para Estudo de Casais" />
<meta property="og:description"   content="Bíblia para Estudo de Casais" />

<title>B&iacute;blia para casais</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/style.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/framework.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}fonts/css/fontawesome-all.min.css">
<link rel="shortcut icon" href="{ABS_LINK}favicon.ico" type="image/x-icon" />

</head>
    
<body class="theme-light" data-background="none" data-highlight="red2">
<div id="page">
        
    <div id="page-preloader">
        <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
    </div> <div class="page-content header-clear-medium">  
            <center><img src="{ABS_LINK}logo.png" width="100" style="margin-top: -30px;"></center>
            <center> <h1>Seu e-mail ainda n&atilde;o foi confirmado.</h1></center>
              <h3>Para acessar sua conta &eacute; necess&aacute;rio confirmar seu cadastro.</h3>
           <center>  <p>Um e-mail de confirma&ccedil;&atilde;o foi enviado para voc&ecirc;.</p></center>
            <a href="login" class="button button-full button-m shadow-large button-round-small bg-green1-dark top-30 bottom-30">CONTINUAR</a>
   
    </div>                           
   </div>
<script type="text/javascript" src="{ABS_LINK}scripts/jquery.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/plugins.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/custom.js"></script>
</body>

<!-- END unconfirmed -->
