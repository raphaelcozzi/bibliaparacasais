<!-- BEGIN cabecalho -->
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
 <meta property="og:url"           content="{ABS_LINK}{pagina_atual}" />
      <meta property="og:type"          content="website" />
      <meta property="og:title"         content="{titulo_pagina} - Bíblia para Casais | Cursos, estudos, artigos, vídeos e mais!" />
      <meta property="og:description"   content="Bíblia Sagrada online para Casais, Plataforma e aplicativo para namorados, noivos e casamentos. Edifique seu relacionamento através da palavra de Deus!" />
      <meta property="og:image"         content="http://bibliaparacasais.com.br/assets/images/biblia-sagrada-online-para-casais-redonda.png" />  
      <title>{titulo_pagina} - B&iacute;blia para Casais | Cursos, estudos, artigos, v&iacute;deos e mais!</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/style.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}styles/framework.css">
<link rel="stylesheet" type="text/css" href="{ABS_LINK}fonts/css/fontawesome-all.min.css">
<link rel="shortcut icon" href="{ABS_LINK}favicon.ico" type="image/x-icon" />
<base href="{ABS_LINK}" />
</head>
    
<body class="theme-light" data-background="none" data-highlight="red2">
    <style type="text/css">
@media (max-width:700px) {
  img#avatarLogin {
    display: none;
  }
}      
      </style>
   <a id="button_backtop"><i class="fa fa-angle-up" style="margin-top:10px;"></i></a>        
<div id="page">
        
    <div id="page-preloader">
        <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
    </div>
   
        
    <div id="footer-menu" class="footer-menu-5-icons footer-menu-style-1">
      {menu}
        <div class="clear"></div>
    </div>
     {msg}
      <div class="header header-static header-logo-left demo-shadow bottom-50" style="position:fixed !important; margin-bottom: 150px;">
           
            <a href="https://mobile.bibliaparacasais.com.br" class="header-logo font-14"></a>
            <a href="javascript:void(0);" class="header-title" style="margin-left: 50px !important;">{titulo_pagina}</a> 
           <!-- <a href="javascript:history.back();" class="header-icon header-icon-1 color-white"><i class="fa fa-arrow-left"></i></a>-->
            <a href="#" data-menu="menu-share" class="header-icon header-icon-1"><i class="fas fa-share-alt" style="font-size:25px !important; margin-top:10px !important;"></i></a>
            <a href="#" data-menu="menu-amigos"  class="header-icon header-icon-2"><i class="fas fa-users" style="font-size:25px !important; margin-top:10px !important;"></i></a>
            <a href="{ABS_LINK}perfil" class="header-icon header-icon-3"><i class="fa fa-user-circle" style="font-size:25px !important; margin-top:10px !important;"></i></a>
        </div> 
        <div style="height:45px;"></div>
<!-- END cabecalho -->





<!-- BEGIN main -->

<div class="page-content header-clear-small">
<!-- BARRA DE PESQUISA -->
<div class="content-boxed content-boxed-full shadow-large bottom-15">
                <div class="search search-header">
                    <i class="fa fa-search"></i>
                    <form action="{ABS_LINK}pesquisa" method="post" name="pesquisa">
                    <input type="text" placeholder="O que voc&ecirc; procura?" name="q">
                    <a href="javascript:void(0);" onclick="document.pesquisa.submit();" class="disabled"><i class="fa fa-times-circle color-red2-dark"></i></a>
                    </form>
                </div>
            </div>

<div class="content">
   <!-- VERSICULO DO DIA -->
<div data-height="300" class="caption round-large shadow-large" style="height:auto !important; height:auto; ">
                <div class="caption-top  left-20 right-20 top-20">
                    <p class="left-text color-white bottom-30"><i class="fa fa-quote-left fa-3x opacity-10"></i></p>
                    {versiculo_dia}
                    
                </div>     
                <div class="caption-overlay bg-black opacity-80">
                   
                </div>
                <div class="caption-background bg-18"></div> 
            </div>
</div>
{widget_home_1}                    
         
      <!-- CURSOS EM DESTAQUE -->
      <div class="content">
         <div class="double-slider owl-carousel owl-no-dots bottom-40">
           {listagem_cursos_destaque}
            
        </div>
        </div>
            <div class="content">
        <!-- CATEGORIAS DE CURSOS -->
         <div class="double-slider owl-carousel owl-no-dots top-45 bottom-40 left-0 right-0">
            {listagem_categorias_cursos}
            
        </div>
        </div>
        <!-- ARTIGOS RECENTES -->

        <div class="timeline-body timeline-body-center" style="margin-top: 0px;">
           <a href="{ABS_LINK}perfil/novoArtigo" class="button button-full left-10 right-10 button-xxs button-round-large bg-blue2-dark shadow-large bottom-10" style="z-index:999999; height:50px; padding-top:15px; margin-top: 0px;">CRIE SEU ARTIGO</a>
			<div class="timeline-deco"></div>
         
         {listagem_artigos_recentes}		         

          <a href="{ABS_LINK}artigos" class="button button-full left-10 right-10 button-xxs button-round-large bg-highlight shadow-large bottom-10">Ver mais</a>

		</div>   
</div>
   

                
<!-- END main -->






<!-- BEGIN footer -->
<script>
  document.getElementById('video_small').src='';
 
  </script>
<div id="menu-video" class="menu menu-box-bottom menu-box-detached round-medium" data-menu-height="250" data-menu-effect="menu-over" style="z-index:999999999 !important; background-color: #ffffff; opacity: 0.0 !important;">
   <div class='responsive-iframe max-iframe'>{videoid}</div>
        <!--<h3 class="center-text uppercase bolder top-30">Video Embeds</h3>-->
        <!--<p class="boxed-text-large">
            Embed any video from any media service. Just copy the iframe and we'll handle the rest.
        </p>-->
        <a href="#" id="vertelacheia" class="button button-center-medium button-s shadow-large button-round-small bg-green1-dark" data-menu="menu-video-fullscreen">Ver em tela cheia</a> 
    </div>
   
<div id="menu-video-fullscreen" class="menu menu-box-bottom menu-box-detached round-medium" data-menu-height="95%" data-menu-effect="menu-over" style="z-index:99999999999 !important; background-color: #000000; opacity: 0.0 !important;">
   
   
   {videoidfull}
        <!--<h3 class="center-text uppercase bolder top-30">Video Embeds</h3>
        <p class="boxed-text-large">
            Embed any video from any media service. Just copy the iframe and we'll handle the rest.
        </p>
        <a href="#" class="close-menu button button-center-medium button-s shadow-large button-round-small bg-green1-dark">Awesome</a> -->
        <div style="height:110px; width: 110px; float: right; margin-top: 60px; margin-right: -20px; z-index: 9999999999 !important;"><a id="fechar_full" href="#" class="close-menu button button-center-medium button-s shadow-large button-round-small bg-black-dark"><i style="font-size:40px;" class="fas fa-times-circle"></i></a></div>
    </div>



<div id="menu-share" class="menu menu-box-bottom menu-box-detached round-large" data-menu-height="260" data-menu-effect="menu-over" style="z-index:999999999 !important;">
        <div class="content bottom-0">
            <div class="menu-title"><h1>Compartilhe</h1><p class="color-highlight">Compartilhe para seus amigos</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
            <div class="divider bottom-0"></div>
        </div>
        <div class="link-list link-list-1 left-15 right-15">
            <a href="#" onclick="return shareOriginal()">
                <i class="font-18 fab fa-facebook color-facebook"></i>
                <span class="font-13">Facebook</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="#" class="shareToTwitter">
                <i class="font-18 fab fa-twitter-square color-twitter"></i>
                <span class="font-13">Twitter</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="whatsapp://send?text=Venha Conhecer a Bíblia para Casais: www.bibliaparacasais.com.br" target="_blank" class="shareToWhatsApp">
                <i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
                <span class="font-13">WhatsApp</span>
                <i class="fa fa-angle-right"></i>
            </a>   
        </div>
    </div>



<div id="menu-amigos" class="menu menu-box-bottom menu-box-detached round-large" data-menu-height="130" data-menu-effect="menu-over" style="z-index:999999999 !important;">
        <div class="content bottom-0">
            <div class="menu-title"><h1>Convide seus amigos</h1><p class="color-highlight"></p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
            <div class="divider bottom-0"></div>
        </div>
        <div class="link-list link-list-1 left-15 right-15">
           <a href="whatsapp://send?text=Venha Conhecer a Bíblia para Casais: www.bibliaparacasais.com.br" target="_blank">
                <i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
                <span class="font-13">WhatsApp</span>
                <i class="fa fa-angle-right"></i>
            </a>   
        </div>
    </div>

   
   
<script>
window.fbAsyncInit = function() {
	FB.init({
	  appId            : '302328724009353',
	  autoLogAppEvents : true,
	  xfbml            : true,
	  version          : 'v2.10'
	});
	FB.AppEvents.logPageView();
  };
 
  (function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   
   

 
function shareOverrideOGMeta(overrideLink, overrideTitle, overrideDescription, overrideImage)
{
	FB.ui({
		method: 'share_open_graph',
		action_type: 'og.likes',
      description: overrideDescription,
		action_properties: JSON.stringify({
			object: {
				'og:url': overrideLink,
				'og:title': overrideTitle,
				'og:description': overrideDescription,
				'og:image': overrideImage
			}
		})
	},
	function (response) {
	// Action after response
	});
}
 
function shareOriginal()
{
	FB.ui({
		method: 'share',
		href: window.location.href
	},
	function (response) {
	// Action after response
	});
	
	return false;
}
 
</script>
   
<div id="menu-settings" class="menu menu-box-bottom menu-box-detached round-large" data-menu-height="95%" data-menu-effect="menu-over" style="z-index:9999999;">
        <div class="content bottom-0">
           <div class="menu-title"><h1>Mais Op&ccedil;&otilde;es</h1><p class="color-highlight">Seus perfil e outras coisas</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
              
            <div class="divider top-25 bottom-0"></div>
            <div class="link-list link-list-2 link-list-long-border">
               
                <a href="{ABS_LINK}perfil" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-user bg-blue2-dark color-white round-tiny"></i>
                    <span>Perfil</span>
                </a>  
               
                <a href="{ABS_LINK}home/versoes" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-book bg-blue2-dark color-white round-tiny"></i>
                    <span>Vers&atilde;o</span>
                    
                </a>  

                <a href="{ABS_LINK}pesquisa" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-search bg-blue2-dark color-white round-tiny"></i>
                    <span>Pesquisa</span>
                    
                </a>  

                <a href="{ABS_LINK}perfil/artigos" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-sticky-note bg-blue2-dark color-white round-tiny"></i>
                    <span>Meus Artigos</span>
                    
                </a>  
               
                <a href="{ABS_LINK}perfil/artigosMarcados" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-bookmark bg-blue2-dark color-white round-tiny"></i>
                    <span>Artigos Salvos</span>
                    
                </a>  

                <a href="{ABS_LINK}perfil/novoArtigo" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-pencil-alt bg-blue2-dark color-white round-tiny"></i>
                    <span>Novo Artigo</span>
                    
                </a>  

                <a href="{ABS_LINK}perfil/cursos" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-graduation-cap bg-blue2-dark color-white round-tiny"></i>
                    <span>Cursos Inscrito</span>
                    
                </a>  


                <a href="{ABS_LINK}perfil/cursosMarcados" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-book bg-blue2-dark color-white round-tiny"></i>
                    <span>Cursos Salvos</span>
                    
                </a>  

                <a href="{ABS_LINK}contato" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-envelope bg-blue2-dark color-white round-tiny"></i>
                    <span>Contato</span>
                    
                </a>  

                <a href="{ABS_LINK}termosdeuso" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-info bg-blue2-dark color-white round-tiny"></i>
                    <span>Termos de Uso</span>
                    
                </a>  
                    <!--

                <a href="{ABS_LINK}termosdeuso/licenca" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-info bg-blue2-dark color-white round-tiny"></i>
                    <span>Licen&ccedil;a</span>
                    
                </a>  -->
                    
                    
                <a href="{ABS_LINK}login/logout" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-times bg-blue2-dark color-white round-tiny"></i>
                    <span>Sair</span>
                    
                </a>  

               
            </div>
        </div> 
        
    </div>   
<div class="menu-hider"></div>
</div>

<style type="text/css">
   #uploadavatar{
    display:none;
   }

#loadMore {
    width:100%;  
    padding: 10px;
    text-align: center;
    background-color: #E91E63;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
    -webkit-border-radius: 24px;
      -moz-border-radius: 24px;
      border-radius: 24px;
}

   #loadMore2 {
    width:100%;  

    padding: 10px;
    text-align: center;
    background-color: #E91E63;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
    -webkit-border-radius: 24px;
      -moz-border-radius: 24px;
      border-radius: 24px;
}

.post_unico
{
   display: none;
}
.post_unico2
{
   display: none;
}
   
   
#button_backtop {
  display: inline-block;
  background-color: #E91E63;
  width: 50px;
  height: 50px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 80px;
  right: 30px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  visibility: hidden;
  z-index: 1000;
  color: #ffffff;
  font-size: 30px;
}
#button_backtop::after {
  font-family: FontAwesome;
  font-weight: normal;
  font-style: normal;
  font-size: 2em;
  line-height: 50px;
  color: #fff;
}
#button_backtop:hover {
  cursor: pointer;
  background-color: #333;
}
#button_backtop:active {
  background-color: #555;
}
#button_backtop.show {
  opacity: 1;
  visibility: visible;
}
   
</style>

<script type="text/javascript" src="{ABS_LINK}scripts/jquery.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/plugins.js"></script>
<script type="text/javascript" src="{ABS_LINK}scripts/custom.js"></script>
<script language="javascript">
   
   
   $('#vertelacheia').click(function(){

     document.getElementById("video_small").src="";

});
   
      $('#fechar_full').click(function(){

     document.location.reload();

});
   

   
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


</script>
    <script language="javascript">
       
       $(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#uploadavatar:hidden").trigger('click');
    });

    $("#upload_link2").on('click', function(e){
        e.preventDefault();
        $("#uploadavatar:hidden").trigger('click');
    });

});        


document.getElementById("uploadavatar").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("theavatar").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

function shareFacebook(url,titulo){

        var w = 630;
        var h = 360;

        var left = screen.width/2 - 630/2;
        var top = screen.height/2 - 360/2;

        window.open('http://www.facebook.com/sharer.php?u='+url+'&t='+url, 'Compartilhar no facebook', 'toolbar=no, location=no, directories=no, status=no, ' + 'menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+ ', height=' + h + ', top=' + top + ', left=' + left);
 }

function mostraFormReply(formResposta)
{
	if(document.getElementById(formResposta).style.display == "none" )
   {
		document.getElementById(formResposta).style.display = "block";
   }
	else
   {
		document.getElementById(formResposta).style.display = "none";
   }
}
 $(document).ready(function(){
               
 $("#formartigo").on("submit", function () {
    var hvalue = $('.ql-editor').html();
    $(this).append("<textarea name='conteudo' style='display:none'>"+hvalue+"</textarea>");
   });               
               
            $('#estados').change(function(){
            $('#cidades').load('index.php?module=perfil&method=ajax_cidade&estado='+$('#estados').val() );

            });
            
            
            });
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
    });
  }		
		
</script>   

</body>
<!-- END footer -->

<!-- BEGIN versoes -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:history.back();" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
               <h1 class="color-white bolder">Vers&atilde;o</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   Escolha a vers&atilde;o da B&iacute;blia
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

   
         <div class="content-boxed">
                      <div class="content accordion-style-2">
                         <h3 class="bolder">Vers&otilde;es</h3>


                         <div class="link-list link-list-1">
                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/1';">
                                <i class="fa fa-{ver_1} color-black" {ver_1_cor}></i>
                                <span {ver_1_cor}>Almeida Revisada Imprensa B&iacute;blica</span><i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/2';">
                                <i class="fa fa-{ver_2} color-black" {ver_2_cor}></i>
                                <span {ver_2_cor}>Almeida Corrigida e Revisada Fiel</span><i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/3';">
                                <i class="fa fa-{ver_3} color-black" {ver_3_cor}></i>
                                <span {ver_3_cor}>Nova Vers&atilde;o Internacional</span><i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/4';">
                                <i class="fa fa-{ver_4} color-black" {ver_4_cor}></i>
                                <span {ver_4_cor}>Sociedade B&iacute;blica Brit&acirc;nica</span><i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/7';">
                                <i class="fa fa-{ver_5} color-black" {ver_5_cor}></i>
                                <span {ver_5_cor}>American Standard Version</span><i class="fa fa-angle-right"></i>
                            </a>

                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/8';">
                                <i class="fa fa-{ver_6} color-black" {ver_6_cor}></i>
                                <span {ver_6_cor}>King James</span><i class="fa fa-angle-right"></i>
                            </a>
                                
                            <a href="#" onClick="javascript:location='{ABS_LINK}home/alteraVersao/5';">
                                <i class="fa fa-{ver_7} color-black" {ver_7_cor}></i>
                                <span {ver_7_cor}>O Livro</span><i class="fa fa-angle-right"></i>
                            </a>
                            
                         
                        </div>
                             
                           
                          </div> 

                      </div>     
                  </div>      
    </div>

<!-- END versoes -->