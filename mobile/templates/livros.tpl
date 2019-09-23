<!-- BEGIN main -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:history.back();" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
               <h1 class="color-white bolder"> Livros</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   {versao_atual}
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    
<div class="content-boxed content-boxed-full shadow-large bottom-15">
                <div class="search search-header">
                    <i class="fa fa-search"></i>
                    <form action="{ABS_LINK}pesquisa" method="post" name="pesquisa">
                    <input type="text" placeholder="O que voc&ecirc; procura?" name="q">
                    <a href="javascript:void(0);" onclick="document.pesquisa.submit();" class="disabled"><i class="fa fa-times-circle color-red2-dark"></i></a>
                    </form>
                </div>
            </div>
           <div class="search-trending content-boxed shadow-large">
                      <div class="content bottom-15">
                         <h5 class="bold">Velho Testamento</h5>
                      <ul class="bottom-15">
                         {velho_testamento}
                      </ul>
                      </div>
                  </div>        
   
               <div class="search-trending content-boxed shadow-large">
                      <div class="content bottom-15">
                         <h5 class="bold">Novo Testamento</h5>
                      <ul class="bottom-15">
                          {novo_testamento}
                      </ul>
                      </div>
                  </div>        
      
   
   
   
</div>
        
<!-- END main -->


<!-- BEGIN livro -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:history.back();" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
               <h1 class="color-white bolder"> {liv_nome_titulo}</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

           <div class="search-trending content-boxed shadow-large">
                      <div class="content bottom-15">
                         <h5 class="bold">Cap&iacute;tulos</h5>
                      <ul class="bottom-15">
                         {listagem_capitulos}
                      </ul>
                      </div>

           </div>    
                      
                      
               <div class="divider top-20"></div>
            {box_comentar_post}
            {listagem_comentarios}                      

                  
      
   
   
   
</div>
        
        
<!-- END livro -->


<!-- BEGIN capitulo -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.3&appId=1436661063287579&autoLogAppEvents=1"></script>
<div id="fb-root"></div>

<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:history.back();" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
               <h1 class="color-white bolder"> {liv_nome_titulo} {ver_capitulo}</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

           <div class="search-trending content-boxed shadow-large">
                      <div class="content bottom-15">
                         <h5 class="bold">Vers&iacute;culos</h5>
                      <ul class="bottom-15">
                        {listagem_versiculos}
                      </ul>
                      </div>
                  </div>
                      
                      
   
   <center><a href="{ABS_LINK}livros/livro/{livro_anterior_abreviado}" class="button button-m shadow-small button-circle bg-red2-dark"><i class="fa fa-arrow-left"></i>{livro_anterior}</a>
      <a href="{ABS_LINK}livros/livro/{liv_abreviado}" class="button button-m shadow-small button-circle bg-red2-dark">Cap&iacute;tulos</a>
      <a href="{ABS_LINK}livros/livro/{proximo_livro_abreviado}" class="button button-m shadow-small button-circle bg-red2-dark">{proximo_livro}<i class="fa fa-arrow-right"></i></a></center>

              <div class="divider top-20"></div>
            {box_comentar_post}
            {listagem_comentarios}                      
 
</div>
{listagem_versiculos_boxes}
<!-- END capitulo -->