<!-- BEGIN main -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Livros</h1>
                    <h2>{versao_atual}</h2>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li class="active">Livros</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->
        
<section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                              <h4 class="module-title"><i class="material-icons">book</i> Velho Testamento</h4>
                                 {velho_testamento}
                    </div>
                    <div class="col-md-6">
                              <h4 class="module-title"><i class="material-icons">book</i> Novo Testamento</h4>
                                 {novo_testamento}

                    </div>
                </div>
            </div>
</section>        
        
        
<div class="stickyfooter">
<div id="sitefooter" class="container">

</div>
</div>
	<div id="wrapper">
		<div id="copyright" class="row" style="width:100%;">

<section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                       <div class="widget" style="background-color:#f5f7fa;">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">book</i> B&iacute;blia de Estudo Para Casais</h4>
                                <div class="list-group">
                                
                                
                                    <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/home"><i class="material-icons">description</i> In&iacute;cio</a></p>
                                        </div>
                                    </div>
 <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/livros"><i class="material-icons">description</i> Livros</a></p>
                                        </div>
                                    </div>                                    
 <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/artigos"><i class="material-icons">description</i> Artigos</a></p>
                                        </div>
                                    </div>                                    

 <div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="/pesquisa"><i class="material-icons">description</i> Pesquisa</a></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="widget" style="background-color:#f5f7fa;">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">book</i> Velho Testamento</h4>
                                <div class="list-group">
                                 
                                 {velho_testamento}

                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="widget" style="background-color:#f5f7fa;">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">book</i> Novo Testamento</h4>
                                <div class="list-group">
                                    <div class="list-group-item">
                                 {novo_testamento}
                                    


                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->

                <hr class="invis">

		</div>
	</div>
	</div>
 
 
 <!-- BEGIN ORIGINAL FOOTER -->
 <div class="stickyfooter">
 
 
            <div id="sitefooter" class="container">
            
            
                <div id="copyright" class="row">
                    <div class="col-md-6 col-sm-12 text-left">
                       <p>B&iacute;blia de estudo para casais &copy; <a href="https://www.dunadesign.com.br">Duna Design</a>.</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-inline text-right">
                            <li><a href="{ABS_LINK}sitemap">Mapa do Site</a></li>
                            <li><a href="{ABS_LINK}termosdeuso">Termos de uso</a></li>
                            <li><a href="{ABS_LINK}licenca">Licen&ccedil;a</a></li>
                            <li><a href="{ABS_LINK}contato">Contato</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

       

        <!-- Modal -->
        <div id="LoginModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Entrar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="login-buttons">
                                    <a href="3rd_party/sdk-facebook/fbconfig.php" class="btn btn-raised btn-facebook btn-block"><i class="fa fa-facebook"></i> Entrar com Facebook</a>
                                    
                                    <a href="javascript:void(0)" class="btn btn-raised btn-google-plus btn-block"><i class="fa fa-google-plus"></i> Entrar com Google</a>
                                    </div>

                                    <form class="sidebar-login" action="login/logar" method="post">
                                       <input type="email" name="login" class="form-control" placeholder="E-mail" required>
                                        <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> &nbsp;&nbsp;Lembrar de mim
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-raised btn-info gr">Entrar</button>
                                    </form> 
                                </div>
                            </div>
                            <small>Ainda n&atilde;o tem cadastro?</small> <br><small><a href="cadastro">Cadastre-se agora</a></small>
                        </div><!-- end widget -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/ripples.min.js"></script>
    <script src="assets/js/material.min.js"></script>
    <script src="assets/js/custom.js"></script>
    
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
        <script language="javascript">
		function mostraFormReply(formResposta)
		{
			if(document.getElementById(formResposta).style.display == "none" )
				document.getElementById(formResposta).style.display = "block";
			else
				document.getElementById(formResposta).style.display = "none";
		}
        
        
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

        </script>
        <script language="javascript">
            $(document).ready(function(){
               
 $("#formartigo").on("submit", function () {
    var hvalue = $('.ql-editor').html();
    $(this).append("<textarea name='conteudo' style='display:none'>"+hvalue+"</textarea>");
   });               
               
            $('#estados').change(function(){
            $('#cidades').load('index.php?module=perfil&method=ajax_cidade&estado='+$('#estados').val() );

            });
            });           
    </script>

<style type="text/css">
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
}
.post_unico
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
  bottom: 30px;
  right: 30px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  visibility: hidden;
  z-index: 1000;
}
#button_backtop::after {
  content: "\f077";
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

#uploadavatar{
    display:none
}
   </style>
       
{ANALYTICS}

</body>
</html>

        
        
<!-- END main -->


<!-- BEGIN livro -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>{liv_nome_titulo}</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/livros">Livros</a></li>
                        <li class="active">{liv_nome_titulo}</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="single-topic-page topic-page topic-list blog-list">
                            <article class="well clearfix">
                                <div class="topic-desc row-fluid clearfix">
                                    <div class="col-sm-12">
                                        

                                        <div class="single-topic-meta">
                                            <h4>Cap&iacute;tulos</h4>
                                        </div>
                                        
                                        {listagem_capitulos}

                                    </div>
                                </div>
                                <!-- end tpic-desc -->

                                <footer class="topic-footer clearfix">
                                    

                                    <div class="pull-right">
                                        <div class="customshare">
                                            <div class="list">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                                <!-- end topic -->
                            </article>
                            <!-- end article well -->
                            
                            
                        </div><!-- end blog-list -->

                  <!-- COMENTAR NO POST -->         
                  {box_comentar_post}
                 <!-- COMENTAR NO POST -->         

                        
                  <div class="row">
                    <div class="col-md-12">
                        <aside class="topic-page topic-list blog-list forum-list single-forum">

                           
                           {listagem_comentarios}
                          
					
                          <ul class="pager">
                                <li> <a href="#" id="loadMore">Carregar Mais</a></li>
                            </ul>
                            
                        </aside>
                    </div><!-- end col -->
                </div><!-- end row -->

                                          
                       </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->

                        <div class="widget">
                            <div class="custom-module">
                               <h4 class="module-title"><i class="material-icons">list</i> &Uacute;ltimos coment&aacute;rios no Livro</h4>

                                <ul class="categories">
                                    {listagem_ultimas_respostas}
                                </ul><!-- end cats -->
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->

                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Coment&aacute;rios Recentes em Livros</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                    {comentarios_recentes}    
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
        
        
<!-- END livro -->


<!-- BEGIN capitulo -->

<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>{liv_nome_titulo} {ver_capitulo_titulo}</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="{ABS_LINK}livros/livro/{liv_abreviado_titulo}">{liv_nome_titulo}</a></li>
                        <li class="active">Cap&iacute;tulo {ver_capitulo_titulo}</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="single-topic-page topic-page topic-list blog-list">
                            <article class="well clearfix">
                                <div class="topic-desc row-fluid clearfix">
                                    <div class="col-sm-12">
                                        

                                        <div class="single-topic-meta">
                                           <h4>Vers&iacute;culos</h4>
                                        </div>
                                       {listagem_versiculos}

                                    </div>
                                </div>
                                <!-- end tpic-desc -->

                                <div class="col-md-12">
                                   
                                   <div class="col-md-4">
                                    
                                   
                                           <a href="{ABS_LINK}livros/livro/{livro_anterior_abreviado}">&leftarrow;{livro_anterior}</a>
                                       
                                   </div>
                                     <div class="col-md-4">
                                        <a href="{ABS_LINK}livros/livro/{liv_abreviado}"><center>Cap&iacute;tulos</center></a>
                                     </div>
                                   
                                   
                              <div class="col-md-4" align="right">                                  
                          
                                           <a href="{ABS_LINK}livros/livro/{proximo_livro_abreviado}">{proximo_livro} &rightarrow;</a>
                                        
                              </div>
                                   
                                   
                                </div>
                                <!-- end topic -->
                            </article>
                            <!-- end article well -->
                            
                            
                        </div><!-- end blog-list -->
                        
               <!-- COMENTAR NO POST -->         
               {box_comentar_post}     
               <!-- COMENTAR NO POST -->         

            <div class="row">
                    <div class="col-md-12">
                        <aside class="topic-page topic-list blog-list forum-list single-forum">
                           {listagem_comentarios}
                           
                            <ul class="pager">
                                <li> <a href="#" id="loadMore">Carregar Mais</a></li>
                            </ul>

                           
                        </aside>
                    </div><!-- end col -->
                </div><!-- end row -->

                                          
                       </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->

                        <div class="widget">
                            <div class="custom-module">
                               <h4 class="module-title"><i class="material-icons">list</i> &Uacute;ltimos coment&aacute;rios no Cap&iacute;tulo</h4>

                                <ul class="categories">
                                    {listagem_ultimas_respostas}
                                </ul><!-- end cats -->
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->

                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Coment&aacute;rios Recentes em Cap&iacute;tulos</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                        {comentarios_recentes}
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->


<!-- END capitulo -->