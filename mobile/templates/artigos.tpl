<!-- BEGIN main -->
  <div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:history.back();" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Artigos {emCategoria}</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   Artigos publicados
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        <div class="page">
            
            
           <!-- CATEGORIAS DE ARTIGOS -->
         <div class="double-slider owl-carousel owl-no-dots top-15">
            {listagem_categorias_artigos}
        </div>
         
      <!-- LISTAGEM DE ARTIGOS -->

        <div class="timeline-body timeline-body-center" style="margin-top: 0px;">
			<div class="timeline-deco"></div>
         
         {listagem_artigos}
         
		</div>        
            

        </div>
        </div>

<!-- END main -->



<!-- BEGIN artigo -->
<div class="page-content header-clear-small" id="corpo">
<div class="article" style="margin-top:-20px;">
        <a href="artigos" class="close-article button button-s button-full bg-highlight bottom-0">Fechar Artigo</a>
        <div data-height="350" class="caption shadow-large">
            <div class="caption-center">
               <h1 class="center-text color-white bolder font-30">{titulo}</h1>
                <p class="boxed-text-huge under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-60"></div>
            <div class="caption-bg bg-26" style="background: url('{imagem_destaque}'); background-repeat: no-repeat; background-size: cover;"></div>
        </div>
        <div style="float:right; white-space: nowrap; width: 80px; margin-top: 0px; position: absolute; z-index: 999; right: 30px; margin-top: 15px;">
                        <div style="float: left;"><a href="javascript:void(0);" onClick="fonte('d');"  class="header-icon header-icon-1"><i class="fas fa-search-minus" style="font-size:25px !important; margin-top:10px !important;"></i></a></div>
                        <div style="float: right;"><a href="javascript:void(0);" onClick="fonte('a');" class="header-icon header-icon-2"><i class="fas fa-search-plus" style="font-size:25px !important; margin-top:10px !important;"></i></a></div>

                         </div>
        <div class="content top-20">
           Em {dataCadastro} | {total_comentarios} coment&aacute;rios | {total_curtidas} curtidas | em {categoria} | Por {nome_usuario}  
           
        </div>
        <div class="content top-20">
            <p>
                {conteudo}
            </p>
            <p>
               {tags}
            </p>
            
            {box_social}
            
            <div class="divider top-20"></div>
            {box_comentar_post}
            {listagem_comentarios}
           
            
            
            <div class="clear"></div>
            <div class="divider"></div>
        </div>
        <a href="artigos" class="close-article button button-xl button-full bg-highlight bottom-0">Fechar Artigo</a>
    </div>    
    </div>    
        

<!-- END artigo -->