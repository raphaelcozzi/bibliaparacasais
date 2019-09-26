<!-- BEGIN main -->
         <div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Meu Perfil</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        
   {box_meus_dados}
   
   <div class="content-boxed">
            <div class="content bottom-0">
                <div class="contact-form">
                   <form class="contactForm" method="post" action="perfil/updateusuario" enctype="multipart/form-data" name="formPerfil">
                      <input type="hidden" name="senha_old" value="{senha}">
                        <fieldset>
                           <!--<a href="javascript:void(0);" id="upload_link2">
                              <img src="{avatar}" alt="" id="theavatar" class="avatar img-circle img-responsive" style="width:100%;"></a>
                                                 
                                                 <input id="uploadavatar" name="avatar" type="file"/>
                                                 
                                               <a href="javascript:void(0);" id="upload_link">  <center><small class="online">Alterar Foto</small></center></a>-->
                           
                            
                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Nome:<span></span></label>
                                <input type="text" class="contactField round-small requiredField" id="contactNameField" required="required"  placeholder="Nome" name="nome" value="{nome_usuario}" />
                            </div>
                            <div class="form-field form-email">
                                <label class="contactEmailField color-theme" for="contactEmailField">E-mail: <span></span></label>
                                <input type="text" name="email" placeholder="E-mail" value="{login}" class="contactField round-small requiredField requiredEmailField" id="contactEmailField"  required="required" />
                            </div>


                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Telefone:</label>
                                <input type="text" placeholder="Telefone" name="telefone" value="{telefone}" class="contactField round-small requiredField" id="contactNameField" />
                            </div>
                           

                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Estado:</label>
                                <select name="estado" id="estados" style="width:100%;  border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small"">
                                   {listagem_estado}
                                </select>
                            </div>
                           <br>
                           
                           
                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Cidade:</label>
                                <select name="cidade" id="cidades" style="width:100%;  border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small"">
                                   {listagem_cidade}
                                </select>
                            </div>
                           <br>
                           
                           
                           <div class="form-field form-text">
                                <label class="contactMessageTextarea color-theme" for="contactMessageTextarea">Sobre mim: <span></span></label>
                                <textarea  id="textArea" placeholder="Sobre mim" name="bio" class="contactTextarea round-small" >{bio}</textarea>
                            </div>
                           
                    <div class="form-field form-name">
                      <label class="contactNameField color-theme" for="contactNameField">Senha:</label>
                        <input type="password"  placeholder="Senha" name="senha" value="{senha}" class="contactField round-small requiredField">
                    </div>          
                    <div class="form-field form-name">
                       <label class="contactNameField color-theme" for="contactNameField">Confirme sua senha:</label>
                        <input type="password" placeholder="Confirme sua senha" name="senha2" value="{senha}" class="contactField round-small requiredField">
                    </div><br><br>
                    <div class="checkbox">
                                                <label>
                                                   <input type="checkbox" name="alert_daily" value="1" {alert_daily_chk}> &nbsp;&nbsp;Receber notifica&ccedil;&otilde;es e alertas
                                                </label>
                    </div><br>
                            <div class="form-button">
                                <input type="submit" class="button bg-highlight button-m button-full round-small bottom-0 shadow-huge contactSubmitButton" value="Salvar Dados" data-formId="contactForm" />
                            </div>
                        </fieldset>
                    </form>			
                </div>
            </div>
        </div>

   
        
    </div>

<!-- END main -->

<!-- BEGIN edtArtigo -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
<link rel="stylesheet" href="3rd_party/quill/quill.snow.css" />
<style>
  body > #standalone-container {
    margin: 50px auto;
    max-width: 720px;
  }
#edit {
	width:100%;
	box-sizing:border-box;
	direction:ltl;
	display:block;
	max-width:100%;
	line-height:1.5;
	padding:15px 15px 30px;
	border-radius:8px;
	border:1px solid #FFFFFF;
	font:13px Tahoma, cursive;
	transition:box-shadow 0.5s ease;
	box-shadow:0 4px 6px rgba(0,0,0,0.1);
	font-smoothing:subpixel-antialiased;
	background:linear-gradient(#F9EFAF, #F7E98D);
	background:-o-linear-gradient(#FFFFFF, #FFFFFF);
	background:-ms-linear-gradient(#FFFFFF, #FFFFFF);
	background:-moz-linear-gradient(#FFFFFF, #FFFFFF);
	background:-webkit-linear-gradient(#FFFFFF, #FFFFFF);
}
</style>


<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="perfil/artigos" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Editar o Artigo</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        
      
   <div class="content-boxed">
            <div class="content bottom-0">
                <div class="contact-form">
                   <form id="formartigo" class="contactForm" method="post" action="perfil/updateArtigo" enctype="multipart/form-data">
                      <input type="hidden" name="artigo_id" value="{artigo_id}">
                        <fieldset>

                            <!--<div class="form-field form-name">
                               <label class="contactNameField color-theme" for="contactNameField">Imagem de Destaque:<span></span></label>
                               
                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="../{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>


                               
                               
                            </div>-->
                           
                           
                            <div class="form-field form-name">
                               <label class="contactNameField color-theme" for="contactNameField">T&iacute;tulo:<span></span></label>
                                <input type="text" name="titulo" value="{titulo}" class="contactField round-small requiredField" id="contactNameField" required="required" />
                            </div>
                            

                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Categoria:</label>
                                <select name="categoria" style="width:100%; border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small">
                                  <option value="0">Selecione uma categoria</option>
                                              {listagem_categorias}
                                </select>
                            </div>
                           <br>
                           
                           
                             <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Tags:<span></span></label>
                                <input type="text"  value="{tags}" class="contactField round-small requiredField" id="contactNameField" placeholder="Digite cada tag separada por virgula" name="tags" />
                            </div>
                            
                           
                           
                           
                          <small>Conte&uacute;do</small>
                                           <div id="standalone-container">
                                              <div id="toolbar-container">
                                       <span class="ql-formats">
                                         <select class="ql-font"></select>
                                         <select class="ql-size"></select>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-bold"></button>
                                         <button class="ql-italic"></button>
                                         <button class="ql-underline"></button>
                                         <button class="ql-strike"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <select class="ql-color"></select>
                                         <select class="ql-background"></select>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-script" value="sub"></button>
                                         <button class="ql-script" value="super"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-header" value="1"></button>
                                         <button class="ql-header" value="2"></button>
                                         <button class="ql-blockquote"></button>
                                         <button class="ql-code-block"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-list" value="ordered"></button>
                                         <button class="ql-list" value="bullet"></button>
                                         <button class="ql-indent" value="-1"></button>
                                         <button class="ql-indent" value="+1"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-direction" value="rtl"></button>
                                         <select class="ql-align"></select>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-link"></button>
                                         <button class="ql-image"></button>
                                         <button class="ql-video"></button>
                                         <button class="ql-formula"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-clean"></button>
                                       </span>
                                     </div>
                                          <div id="edit">{conteudo}</div>
                                          </div>
                                           <br>
                           

                           <div class="form-button">
                                <input type="submit" class="button bg-highlight button-m button-full round-small bottom-0 shadow-huge" value="Enviar para publicar"/>
                            </div>
                        </fieldset>
                    </form>			
                </div>
            </div>
        </div>

   
        
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

<script src="3rd_party/quill/quill.min.js"></script>
<script src="3rd_party/autosize.min.js"></script>


<script>
   
   
   autosize(document.getElementById("edit"));

  var quill = new Quill('#edit', {
    modules: {
      formula: true,
      syntax: true,
      toolbar: '#toolbar-container'
    },
    placeholder: 'Escreva aqui o conteúdo do seu artigo...',
    theme: 'snow'
  });
</script>
        
        

<!-- END edtArtigo -->

<!-- BEGIN cursos -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Cursos Inscritos</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                 Cursos em que me inscrevi
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

   
   <div class="content-boxed content-boxed-full">
            <div class="content bottom-0">
                <div class="contact-information last-column">
                    <div class="container top-20">
                        <p class="contact-information">
                           <strong class="color-theme font-16">Cursos</strong>
                        </p>
                        <div class="divider bottom-0"></div>
                        <div class="link-list link-list-1">
                            {listagem}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
   {box_meus_dados}
   

   
        
    </div>
<!-- END cursos -->


<!-- BEGIN artigos -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Meus Artigos</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                 Artigos publicados por mim
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

   
   <div class="content-boxed">
                      <div class="content accordion-style-2">
                          <h3 class="bolder">Artigos</h3>
                         {listagem} 

                      </div>     
                  </div>      
    
        
  {box_meus_dados}
   

   
        
    </div>
<!-- END artigos -->


<!-- BEGIN artigosMarcados -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Artigos Salvos</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                 Artigos Salvos por mim
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

   
   <div class="content-boxed">
                      <div class="content accordion-style-2">
                          <h3 class="bolder">Artigos</h3>
                         {listagem} 
                      </div>     
                  </div>      
    
        
   {box_meus_dados}
   

   
        
    </div>
<!-- END artigosMarcados -->


<!-- BEGIN novoArtigo -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
<link rel="stylesheet" href="3rd_party/quill/quill.snow.css" />
<style>
  body > #standalone-container {
    margin: 50px auto;
    max-width: 720px;
  }
#edit {
	width:100%;
	box-sizing:border-box;
	direction:ltl;
	display:block;
	max-width:100%;
	line-height:1.5;
	padding:15px 15px 30px;
	border-radius:8px;
	border:1px solid #FFFFFF;
	font:13px Tahoma, cursive;
	transition:box-shadow 0.5s ease;
	box-shadow:0 4px 6px rgba(0,0,0,0.1);
	font-smoothing:subpixel-antialiased;
	background:linear-gradient(#F9EFAF, #F7E98D);
	background:-o-linear-gradient(#FFFFFF, #FFFFFF);
	background:-ms-linear-gradient(#FFFFFF, #FFFFFF);
	background:-moz-linear-gradient(#FFFFFF, #FFFFFF);
	background:-webkit-linear-gradient(#FFFFFF, #FFFFFF);
}
</style>


<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:history.back();" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Novo Artigo</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        
      
   <div class="content-boxed">
            <div class="content bottom-0">
                <div class="contact-form">
                   <form id="formartigo" class="contactForm" method="post" action="perfil/insertArtigo" enctype="multipart/form-data">
                        <fieldset>

                            <!--<div class="form-field form-name">
                               <label class="contactNameField color-theme" for="contactNameField">Imagem de Destaque:<span></span></label>
                               
                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="http://www.placehold.it/600x400/EFEFEF/AAAAAA&amp;text=sem+imagem+em+destaque" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>


                               
                               
                            </div>-->
                           
                           
                            <div class="form-field form-name">
                               <label class="contactNameField color-theme" for="contactNameField">T&iacute;tulo:<span></span></label>
                                <input type="text" name="titulo" value="" class="contactField round-small requiredField" id="contactNameField" required="required" />
                            </div>
                            

                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Categoria:</label>
                                <select name="categoria" style="width:100%; border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small">
                                  <option value="0">Selecione uma categoria</option>
                                              {listagem_categorias}
                                </select>
                            </div>
                           <br>
                           
                           
                             <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Tags:<span></span></label>
                                <input type="text"  value="" class="contactField round-small requiredField" id="contactNameField" placeholder="Digite cada tag separada por virgula" name="tags" />
                            </div>
                            
                           
                           
                           
                          <small>Conte&uacute;do</small>
                                           <div id="standalone-container">
                                              <div id="toolbar-container">
                                       <span class="ql-formats">
                                         <select class="ql-font"></select>
                                         <select class="ql-size"></select>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-bold"></button>
                                         <button class="ql-italic"></button>
                                         <button class="ql-underline"></button>
                                         <button class="ql-strike"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <select class="ql-color"></select>
                                         <select class="ql-background"></select>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-script" value="sub"></button>
                                         <button class="ql-script" value="super"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-header" value="1"></button>
                                         <button class="ql-header" value="2"></button>
                                         <button class="ql-blockquote"></button>
                                         <button class="ql-code-block"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-list" value="ordered"></button>
                                         <button class="ql-list" value="bullet"></button>
                                         <button class="ql-indent" value="-1"></button>
                                         <button class="ql-indent" value="+1"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-direction" value="rtl"></button>
                                         <select class="ql-align"></select>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-link"></button>
                                         <button class="ql-image"></button>
                                         <button class="ql-video"></button>
                                         <button class="ql-formula"></button>
                                       </span>
                                       <span class="ql-formats">
                                         <button class="ql-clean"></button>
                                       </span>
                                     </div>
                                          <div id="edit"></div>
                                          </div>
                                           <br>
                           

                           <div class="form-button">
                                <input type="submit" class="button bg-highlight button-m button-full round-small bottom-0 shadow-huge" value="Enviar para publicar"/>
                            </div>
                        </fieldset>
                    </form>			
                </div>
            </div>
        </div>

   
        
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

<script src="3rd_party/quill/quill.min.js"></script>
<script src="3rd_party/autosize.min.js"></script>


<script>
   
   
   autosize(document.getElementById("edit"));

  var quill = new Quill('#edit', {
    modules: {
      formula: true,
      syntax: true,
      toolbar: '#toolbar-container'
    },
    placeholder: 'Escreva aqui o conteúdo do seu artigo...',
    theme: 'snow'
  });
</script>
        
        
<!-- END novoArtigo -->


<!-- BEGIN cursosMarcados -->
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Cursos Salvos</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                 Cursos Salvos por mim
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

   
   <div class="content-boxed">
                      <div class="content accordion-style-2">
                          <h3 class="bolder">Cursos</h3>
                          {listagem}
                      </div>     
                  </div>      
    
        
   {box_meus_dados}
   

   
        
    </div>

<!-- END cursosMarcados -->

