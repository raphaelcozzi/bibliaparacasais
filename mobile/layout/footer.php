
<div id="menu-settings" class="menu menu-box-bottom menu-box-detached round-large" data-menu-height="750" data-menu-effect="menu-over">
        <div class="content bottom-0">
           <div class="menu-title"><h1>Mais Op&ccedil;&otilde;es</h1><p class="color-highlight">Seus perfil e outras coisas</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
              
            <div class="divider top-25 bottom-0"></div>
            <div class="link-list link-list-2 link-list-long-border">
               
                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-user bg-blue2-dark color-white round-tiny"></i>
                    <span>Perfil</span>
                </a>  
               
                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-book bg-blue2-dark color-white round-tiny"></i>
                    <span>Vers&atilde;o</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-search bg-blue2-dark color-white round-tiny"></i>
                    <span>Pesquisa</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-sticky-note bg-blue2-dark color-white round-tiny"></i>
                    <span>Meus Artigos</span>
                    
                </a>  
               
                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-bookmark bg-blue2-dark color-white round-tiny"></i>
                    <span>Artigos Salvos</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-pencil-alt bg-blue2-dark color-white round-tiny"></i>
                    <span>Novo Artigo</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-bookmark bg-blue2-dark color-white round-tiny"></i>
                    <span>Artigos Salvos</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-graduation-cap bg-blue2-dark color-white round-tiny"></i>
                    <span>Meus Cursos</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-envelope bg-blue2-dark color-white round-tiny"></i>
                    <span>Contato</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-info bg-blue2-dark color-white round-tiny"></i>
                    <span>Termos de Uso</span>
                    
                </a>  

                <a href="#" data-menu="menu-backgrounds" class="no-border">
                    <i class="fa fa-times bg-blue2-dark color-white round-tiny"></i>
                    <span>Sair</span>
                    
                </a>  

               
            </div>
        </div> 
        
    </div>   
<div class="menu-hider"></div>
</div>

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

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script>
   
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


</script>   

</body>