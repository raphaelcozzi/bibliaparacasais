<!-- BEGIN main -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                             <div>
                                    <a href="cursos/novo" class="btn default green-stripe">
                                            <i class="fa fa-plus"></i> Incluir Novo Curso </a>
                              </div>
                              <br>

                            <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Listagem de Cursos</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Imagem</th> 
                                                <th>T&iacute;tulo</th> 
                                                <th>Categoria</th> 
                                                <th>T&oacute;picos</th> 
                                                <th>Inscritos</th> 
                                                <th>Situa&ccedil;&atilde;o</th> 
                                                <th>Curtidas</th> 
                                                <th>Coment&aacute;rios</th> 
                                                <th>Dura&ccedil;&atilde;o</th> 
                                                <th>Data</th> 
                                                <th>&nbsp;</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                                        
<script>
   
function ordena()
{
   return 1;
} 
</script>                                        


<!-- END main -->

<!-- BEGIN categorias -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                             <div>
                                    <a href="cursos/novoCategoria" class="btn default green-stripe">
                                            <i class="fa fa-plus"></i> Incluir </a>
                              </div>
                              <br>

                            <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Categorias de Cursos</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>T&iacute;tulo</th> 
                                                <th>&nbsp;</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                                        
<script>
   
function ordena()
{
   return 2;
} 
</script>                                        


<!-- END categorias -->

<!-- BEGIN editaCategoria -->

<style>

#uploadavatar{
    display:none;
}

</style>     
               
                     <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                   <i class="fa fa-user"></i>Editar Categoria de Curso</div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=cursos&method=updateCategoria" method="post" name="editar"  class="form-horizontal" enctype="multipart/form-data">
                                                   <input type="hidden" name="id" value="{id}">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="titulo" required="" value="{titulo}">
                                                                <span class="help-block"> T&iacute;tulo da categoria. </span>
                                                            </div>
                                                        </div>
                                                                
                                                         <div class="form-group">
                                                           <label class="col-md-3 control-label">Imagem de Destaque</label>
                                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>



                                                            </div>                                                                

                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Atualizar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
<!-- END editaCategoria -->

<!-- BEGIN novoCategoria -->
<style>

#uploadavatar{
    display:none;
}

</style>     
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user"></i>Nova Categoria de Curso </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=cursos&method=insereCategoria" method="post" name="editar"  class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="titulo" required="">
                                                                <span class="help-block"> T&iacute;tulo da categoria. </span>
                                                            </div>
                                                        </div>
                                                       
                                                       
                                                            <div class="form-group">
                                                           <label class="col-md-3 control-label">Imagem de Destaque</label>
                                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>



                                                            </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Salvar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
<!-- END novoCategoria -->


<!-- BEGIN edita -->
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
   height:400px;
	box-sizing:border-box;
	direction:ltl;
	display:block;
	max-width:100%;
	max-height:100%;
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

#uploadavatar{
    display:none;
}

</style>                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-list"></i>Editando o Curso: <strong>{titulo}</strong> </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=cursos&method=updateCurso" method="post" name="editar" id="formartigo"  class="form-horizontal" enctype="multipart/form-data">
                                                   <input type="hidden" name="curso_id" value="{curso_id}">
                                                    <div class="form-body">
                                                       
                                                       
                                                           <div class="form-group">
                                                           <label class="col-md-3 control-label">Imagem de Destaque</label>
                                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="https://www.bibliaparacasais.com.br/{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>



                                                            </div>
                                                        </div>
                                                       
                                                       
                                                       
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="titulo" required="" value="{titulo}">
                                                                <span class="help-block"> T&iacute;tulo do artigo. </span>
                                                            </div>
                                                        </div>
                                                                
                                                                <div class="form-group">
                                                           <label class="col-md-3 control-label">Categoria</label>
                                                            <div class="col-md-4">
                                                               <select name="categoria" class="form-control">
                                                                  {listagem_categorias}
                                                               </select>
                                                                <span class="help-block"> Categoria do artigo. </span>
                                                            </div>
                                                        </div>
                                                               <div class="form-group">
                                                           <label class="col-md-3 control-label">Tags</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control"  placeholder="Digite cada tag separada por virgula"  name="tags" required="" value="{tags}">
                                                                <span class="help-block"> Tags usadas no artigo. </span>
                                                            </div>
                                                        </div>


                                                               <div class="form-group">
                                                                  <label class="col-md-3 control-label">Resumo</label>
                                                            <div class="col-md-8">
                                                           <div id="standalone-container"><div id="toolbar-container">
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
                                         <!--<textarea class="form-control" rows="10" id="edit" placeholder="Insira aqui o conte&uacute;do do seu artigo..." name="conteudo"></textarea></div>-->
                                         <div id="edit">{conteudo}</div>
                                         <br>

                                           </div>
                                           </div>
                                           </div>


                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">Situa&ccedil;&atilde;o:</label>
                                                            <div class="col-md-4">
                                                               <select name="situacao" class="form-control">
                                                                  {listagem_situacoes}
                                                               </select>
                                                               
                                                                <span class="help-block"> Aprovar ou Desaprovar o artigo. </span>
                                                            </div>
                                                        </div>
                                                                
                                                               <div class="form-group">
                                                                  <label class="col-md-3 control-label">Dura&ccedil;&atilde;o</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control"  placeholder=""  name="duracao" required="" value="{duracao}">
                                                                <span class="help-block"> em dias. </span>
                                                            </div>
                                                        </div>
                                                                
                                                                
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Atualizar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                                
<div class="row">
                        <div class="col-md-12">
                            <div>
                                    <a href="cursos/novoTopico/{curso_id}" class="btn default green-stripe">
                                       <i class="fa fa-plus"></i> Incluir Novo T&oacute;pico </a>
                            </div><br>
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                         <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">T&oacute;picos do Curso</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_2">
                                        <thead>
                                            <tr>
                                               <th>Ti&iacute;tulo</th> 
                                                <th>Dia</th> 
                                                <th>&nbsp;</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_topicos}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>                                                
<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                         <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Pessoas inscritas no curso</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_3">
                                        <thead>
                                            <tr>
                                               <th>Nome</th> 
                                                <th>Email</th> 
                                                <th>Origem</th> 
                                                <th>Inscrição</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_usuarios_inscritos}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>                                                
                                                
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                         <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Coment&aacute;rios feitos no curso</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                               <th>&nbsp;</th> 
                                                <th>Autor</th> 
                                                <th>Data</th> 
                                                <th>Coment&aacute;rio</th> 
                                                <th>Likes</th> 
                                                <th>Deslikes</th> 
                                                <th>Situa&ccedil;&atilde;o</th>
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_comentarios}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                                                
                                                
                                            </div>
                                        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="3rd_party/quill/quill.min.js"></script>
<script src="3rd_party/autosize.min.js"></script>

<script>
   
function ordena()
{
   return 2;
} 
</script>                                        

<script>
   
   autosize(document.getElementById("edit"));

  var quill = new Quill('#edit', {
    modules: {
      formula: true,
      syntax: true,
      toolbar: '#toolbar-container'
    },
    placeholder: 'Escreva aqui o resumo do seu curso...',
    theme: 'snow'
  });
  
  
  
</script>
                                                              
<!-- END edita -->


<!-- BEGIN novo -->
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
   height:400px;
	box-sizing:border-box;
	direction:ltl;
	display:block;
	max-width:100%;
	max-height:100%;
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

#uploadavatar{
    display:none;
}

</style>                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-list"></i>Novo Curso: </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=cursos&method=insereCurso" method="post" name="editar" id="formartigo"  class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                       
                                                       
                                                           <div class="form-group">
                                                           <label class="col-md-3 control-label">Imagem de Destaque</label>
                                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="http://www.placehold.it/600x400/EFEFEF/AAAAAA&amp;text=sem+imagem+em+destaque" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>



                                                            </div>
                                                        </div>
                                                       
                                                       
                                                       
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="titulo" required="">
                                                                <span class="help-block"> T&iacute;tulo do artigo. </span>
                                                            </div>
                                                        </div>
                                                                
                                                                <div class="form-group">
                                                           <label class="col-md-3 control-label">Categoria</label>
                                                            <div class="col-md-4">
                                                               <select name="categoria" class="form-control">
                                                                  {listagem_categorias}
                                                               </select>
                                                                <span class="help-block"> Categoria do artigo. </span>
                                                            </div>
                                                        </div>
                                                               <div class="form-group">
                                                           <label class="col-md-3 control-label">Tags</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control"  placeholder="Digite cada tag separada por virgula"  name="tags" required="">
                                                                <span class="help-block"> Tags usadas no artigo. </span>
                                                            </div>
                                                        </div>


                                                               <div class="form-group">
                                                                  <label class="col-md-3 control-label">Resumo</label>
                                                            <div class="col-md-8">
                                                           <div id="standalone-container"><div id="toolbar-container">
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
                                         <!--<textarea class="form-control" rows="10" id="edit" placeholder="Insira aqui o conte&uacute;do do seu artigo..." name="conteudo"></textarea></div>-->
                                         <div id="edit"></div>
                                         <br>

                                           </div>
                                           </div>
                                           </div>


                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">Situa&ccedil;&atilde;o:</label>
                                                            <div class="col-md-4">
                                                               <select name="situacao" class="form-control">
                                                                  {listagem_situacoes}
                                                               </select>
                                                               
                                                                <span class="help-block"> Aprovar ou Desaprovar o artigo. </span>
                                                            </div>
                                                        </div>
                                                                
                                                               <div class="form-group">
                                                                  <label class="col-md-3 control-label">Dura&ccedil;&atilde;o</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control"  placeholder=""  name="duracao" required="">
                                                                <span class="help-block"> em dias. </span>
                                                            </div>
                                                        </div>
                                                                
                                                                
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Salvar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                                
          
                                                
                                                                    
                                                
                                            </div>
                                        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="3rd_party/quill/quill.min.js"></script>
<script src="3rd_party/autosize.min.js"></script>

<script>
   
function ordena()
{
   return 2;
} 
</script>                                        

<script>
   
   autosize(document.getElementById("edit"));

  var quill = new Quill('#edit', {
    modules: {
      formula: true,
      syntax: true,
      toolbar: '#toolbar-container'
    },
    placeholder: 'Escreva aqui o resumo do seu curso...',
    theme: 'snow'
  });
  
  
  
</script>
                                                              
<!-- END novo -->


<!-- BEGIN editaTopico -->

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
   height:400px;
	box-sizing:border-box;
	direction:ltl;
	display:block;
	max-width:100%;
	max-height:100%;
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

#uploadavatar{
    display:none;
}

</style>                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                   <i class="fa fa-list"></i>Editando o T&oacute;pico: <strong>{titulo}</strong> </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=cursos&method=updateTopico" method="post" name="editar" id="formartigo"  class="form-horizontal" enctype="multipart/form-data">
                                                   <input type="hidden" name="curso_id" value="{curso_id}">
                                                   <input type="hidden" name="topico_id" value="{topico_id}">
                                                    <div class="form-body">
                                                       
                                                       
                                                           <div class="form-group">
                                                           <label class="col-md-3 control-label">Imagem de Destaque</label>
                                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="https://www.bibliaparacasais.com.br/{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>



                                                            </div>
                                                        </div>
                                                       
                                                   <div class="form-group">
                                                           <label class="col-md-3 control-label">V&iacute;deo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="video" value="{video}">
                                                               <span class="help-block"> Link do V&iacute;deo do Youtube ou do Vimeo</span>
                                                            </div>
                                                        </div>                                                       
                                                       
                                                       
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="titulo" required="" value="{titulo}">
                                                               <span class="help-block"> T&iacute;tulo do T&oacute;pico. </span>
                                                            </div>
                                                        </div>
                                                                
                                                                <div class="form-group">
                                                           <label class="col-md-3 control-label">Dia</label>
                                                            <div class="col-md-4">
                                                               <select name="dia" class="form-control">
                                                                  {listagem_dias}
                                                               </select>
                                                                <span class="help-block"> Dia do curso a que pertence o t&oacute;pico. </span>
                                                            </div>
                                                        </div>
                                                               


                                                               <div class="form-group">
                                                                  <label class="col-md-3 control-label">Conte&uacute;do</label>
                                                            <div class="col-md-8">
                                                           <div id="standalone-container"><div id="toolbar-container">
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
                                         <br>

                                           </div>
                                           </div>
                                           </div>


                                                                
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Atualizar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                                
                                                
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
    placeholder: 'Escreva aqui o conteudo do seu topico...',
    theme: 'snow'
  });
  
  
  
</script>

<!-- END editaTopico -->

<!-- BEGIN novoTopico -->

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
   height:400px;
	box-sizing:border-box;
	direction:ltl;
	display:block;
	max-width:100%;
	max-height:100%;
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

#uploadavatar{
    display:none;
}

</style>                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                   <i class="fa fa-list"></i>Criando novo T&oacute;pico</div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=cursos&method=insereTopico" method="post" name="editar" id="formartigo"  class="form-horizontal" enctype="multipart/form-data">
                                                 <input type="hidden" name="curso_id" value="{curso_id}">
                                                   <div class="form-body">
                                                       
                                                       
                                                           <div class="form-group">
                                                           <label class="col-md-3 control-label">Imagem de Destaque</label>
                                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="http://www.placehold.it/600x400/EFEFEF/AAAAAA&amp;text=sem+imagem+em+destaque" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>



                                                            </div>
                                                        </div>
                                                       
                                                   <div class="form-group">
                                                           <label class="col-md-3 control-label">V&iacute;deo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="video">
                                                               <span class="help-block"> Link do V&iacute;deo do Youtube ou do Vimeo</span>
                                                            </div>
                                                        </div>                                                       
                                                       
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="titulo" required="">
                                                               <span class="help-block"> T&iacute;tulo do T&oacute;pico. </span>
                                                            </div>
                                                        </div>
                                                                
                                                                <div class="form-group">
                                                           <label class="col-md-3 control-label">Dia</label>
                                                            <div class="col-md-4">
                                                               <select name="dia" class="form-control">
                                                                  {listagem_dias}
                                                               </select>
                                                                <span class="help-block"> Dia do curso a que pertence o t&oacute;pico. </span>
                                                            </div>
                                                        </div>
                                                               


                                                               <div class="form-group">
                                                                  <label class="col-md-3 control-label">Conte&uacute;do</label>
                                                            <div class="col-md-8">
                                                           <div id="standalone-container"><div id="toolbar-container">
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
                                         <br>

                                           </div>
                                           </div>
                                           </div>


                                                                
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Salvar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                                
                                                
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
    placeholder: 'Escreva aqui o conteudo do seu topico...',
    theme: 'snow'
  });
  
  
  
</script>

<!-- END novoTopico -->
