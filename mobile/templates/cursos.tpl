<!-- BEGIN main -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
               <h1 class="color-white bolder">Cursos {emCategoria}</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

<div class="content-boxed">
            <div class="content">
                <div class="tab-controls tab-animated tabs-large tabs-rounded" 
                     data-tab-items="2" 
                     data-tab-active="bg-green1-dark">
                    <a href="#" data-tab-active data-tab="tab-8"><i class="fa fa-graduation-cap"></i> Cursos</a>
                    <a href="#" data-tab="tab-9"><i class="fa fa-bookmark"></i> Meus Cursos</a>
                </div>
                <div class="clear bottom-15"></div>
                <div class="tab-content" id="tab-8">
                    <p class="bottom-0">
                       
                       {listagem_cursos_recentes}
                       {listagem_sugestoes_cursos}


                </div>
                <div class="tab-content" id="tab-9">
                   
               <div class="search-trending content-boxed shadow-large">
                                     <div class="content bottom">
                                        <h5 class="bold">Meus Cursos Inscritos</h5>
                                     <ul class="bottom-15">
                                        
                                        {listagem_meus_cursos}
                                     </ul>
                                     </div>
                                 </div>      

                </div>
            </div>     
        </div>
   
   
   
</div>


<!-- END main -->

<!-- BEGIN curso -->
<div class="page-content header-clear-small">
<div class="article" style="margin-top:-20px;">
        <a href="cursos" class="close-article button button-s button-full bg-highlight bottom-0">Fechar Curso</a>
        <div data-height="350" class="caption shadow-large">
            <div class="caption-center">
               <h1 class="center-text color-white bolder font-30">{titulo}</h1>
                <p class="boxed-text-huge under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-60"></div>
            <div class="caption-bg bg-26" style="background: url('{imagem_destaque}'); background-repeat: no-repeat; background-size: cover;"></div>
        </div>
        <div class="content top-20">
           Em {dataCadastro} | {total_comentarios} coment&aacute;rios | {total_curtidas} curtidas | em {categoria} 
           
        </div>
        <div class="content top-20">
            <p>
                {resumo}
            </p>
            
			{box_social}
         <a style="float:right; width: 100px;" href="cursos/aula/{slug}" class="icon icon-xs icon-round bg-green2-dark"><i class="fa fa-play"></i></a>
         {tags}
         
            <div class="divider top-20"></div>
            {cursos_relacionados}
            <div class="divider top-20"></div>
            {box_comentar_post}
           <div class="divider top-20"></div>
            {listagem_comentarios}
            
           
            <div class="divider"></div>
        </div>
        <a href="cursos" class="close-article button button-xl button-full bg-highlight bottom-0">Fechar Curso</a>
    </div>  
   </div>

<!-- END curso -->


<!-- BEGIN aula -->
<div class="page-content header-clear-small">
<div class="article" style="margin-top:-20px;">
        <a href="javascript:history.back();" class="close-article button button-s button-full bg-highlight bottom-0">Voltar</a>
        <div data-height="350" class="caption shadow-large">
            <div class="caption-center">
               <h1 class="center-text color-white bolder font-30">{titulo}</h1>
                <p class="boxed-text-huge under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-60"></div>
            <div class="caption-bg bg-26" style="background: url('{imagem_destaque}'); background-repeat: no-repeat; background-size: cover;"></div>
        </div>
        <div class="content top-20">
           Em {dataCadastro}| {total_comentarios} coment&aacute;rios | {total_curtidas} curtidas | em {categoria} 
           <br>
           Dura&ccedil;&atilde;o: {duracao} dia{s} | {quantos_completaram} completaram
           
        </div>
        
            
            <div class="content-boxed">
                      <div class="content accordion-style-2">
                          <h3 class="bolder">Plano de Estudo</h3>
                          <p>
                             T&oacute;picos para o plano de estudo do curso. 
                          </p>

                          {listagem_dias} 

                      </div>     
                  </div>         
           


           
           <div class="divider"></div>
        <a href="cursos" class="close-article button button-xl button-full bg-highlight bottom-0">Fechar Curso</a>
    </div>    
    </div> 
<!-- END aula -->

<!-- BEGIN topico -->
<div class="page-content header-clear-small">
<div class="article" style="margin-top:-20px;">
        <a href="javascript:history.back();" class="close-article button button-s button-full bg-highlight bottom-0">Voltar</a>
        <div data-height="350" class="caption shadow-large">
            <div class="caption-center">
               <h1 class="center-text color-white bolder font-30">{titulo}</h1>
                <p class="boxed-text-huge under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-60"></div>
            <div class="caption-bg bg-26"  style="background: url('{imagem_destaque}'); background-repeat: no-repeat; background-size: cover;"></div>
        </div>
        <div class="content top-20">
            <p>
                {conteudo}
                
            </p>
            
             
            <div>
            <a style="width: 47%;" href="javascript:history.back();" class="icon icon-xs icon-round bg-red2-dark"><i class="fa fa-arrow-left"></i></a>

            <a style="width: 47%;" href="{ABS_LINK}cursos/concluitopic/{slug}" class="icon icon-xs icon-round bg-green2-dark"><i class="fa fa-check"></i></a>

            <div class="divider"></div>
        </div>
    </div>    
        <a href="cursos" class="close-article button button-xl button-full bg-highlight bottom-0">Fechar Curso</a>
    </div>    
    </div>    
        
<!-- END topico -->