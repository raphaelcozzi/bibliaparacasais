<!-- BEGIN main -->
         <section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Meu Perfil</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li class="active">Meu Perfil</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">account_circle</i> Meus dados pessoais</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <form class="sidebar-login" method="post" action="perfil/updateusuario" enctype="multipart/form-data">
                                          <input type="hidden" name="senha_old" value="{senha}">
                                           <div class="col-sm-4">
                                              <a href="javascript:void(0);" id="upload_link2"><img src="{avatar}" alt="" id="theavatar" class="avatar img-circle img-responsive"></a>
                                                 
                                                 <input id="uploadavatar" name="avatar" type="file"/>
                                                 
                                               <a href="javascript:void(0);" id="upload_link">  <center><small class="online">Alterar Foto</small></center></a>
                                                 
                                    </div>
                                           <div class="col-sm-8">
                                           <small>Seu nome</small>
                                           <input required="required" type="text" class="form-control" placeholder="Nome" name="nome" value="{nome_usuario}">   
                                           </div>
                                           
                                           <div class="col-sm-8">
                                           <small>Seu email</small>
                                           <input required="required" type="email" class="form-control" name="email" placeholder="E-mail" value="{login}">


                                           <small>Estado</small>
                                           <select name="estado" id="estados" class="form-control">
                                                   {listagem_estado}
                                           </select>

                                           <small>Cidade</small>
                                           <select name="cidade" id="cidades" class="form-control">
                                                   {listagem_cidade}
                                           </select>

                                           <small>Telefone</small>
                                           <input type="text" class="form-control" placeholder="Telefone" name="telefone" value="{telefone}">
                                           <small>Senha</small>
                                           <input required="required" type="password" class="form-control" placeholder="Senha" name="senha" value="{senha}">
                                           <small>Confirmar a senha</small>
                                           <input required="required" type="password" class="form-control" placeholder="Senha2" name="senha2" value="{senha}">
                                           <small>Sobre mim</small>
                                           <textarea class="form-control" rows="4" id="textArea" placeholder="Sobre mim" name="bio">{bio}</textarea>
                                            <div class="checkbox">
                                                <label>
                                                   <input type="checkbox" name="alert_daily" value="1" {alert_daily_chk}> &nbsp;&nbsp;Receber notifica&ccedil;&otilde;es e alertas
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-raised btn-info gr">Atualizar dados</button>
                                           </div>
                                        </form> 

                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->

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
  
  
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Editar Artigo</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/perfil">Meu Perfil</a></li>
                        <li class="active">Editar Artigo</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">create</i> Editar o artigo</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <!-- CONTENT -->
                                       <form id="formartigo" class="sidebar-login" method="post" action="perfil/updateArtigo" enctype="multipart/form-data">
                                          <input type="hidden" name="artigo_id" value="{artigo_id}">
                                           <div class="col-sm-12">
                                              <a href="javascript:void(0);" id="upload_link2">
                                                 <img src="{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>

                                             <div class="col-sm-12">
                                              <small>T&iacute;tulo</small>
                                           <input required="required" type="text" class="form-control" placeholder="T&iacute;tulo do Artigo" name="titulo" value="{titulo}">   
                                           </div>
                                           
                                           <div class="col-sm-12">
                                           <small>Categoria</small>
                                           <select class="form-control" name="categoria">
                                              {listagem_categorias}
                                           </select>
                                           </div>

                                             <div class="col-sm-12">
                                              <small>Tags</small>
                                           <input required="required" type="text" class="form-control" placeholder="Digite cada tag separada por virgula" name="tags" value="{tags}">   
                                           </div>

                                           <small>Conte&uacute;do</small>
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

                                           <button type="submit" id="enviar" class="btn btn-raised btn-info gr">Enviar para Publicar</button>
                                           </div>
                                        </form> 

                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->
        
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
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Cursos Inscrito</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/perfil">Meu Perfil</a></li>
                        <li class="active">Cursos Inscrito</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">school</i> Cursos em que me inscrevi</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <!-- CONTENT -->
                                       {listagem}
                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END cursos -->


<!-- BEGIN artigos -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Meus Artigos</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/perfil">Meu Perfil</a></li>
                        <li class="active">Meus Artigos</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">class</i> Artigos publicados por mim</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <!-- CONTENT -->
                                       {listagem}
                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END artigos -->


<!-- BEGIN artigosMarcados -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Artigos Salvos</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/perfil">Meu Perfil</a></li>
                        <li class="active">Artigos Salvos</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">bookmark</i> Artigos salvos por mim</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <!-- CONTENT -->
                                       {listagem}
                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->

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
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Novo Artigo</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/perfil">Meu Perfil</a></li>
                        <li class="active">Novo Artigo</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">create</i> Criar novo artigo</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <!-- CONTENT -->
                                       <form id="formartigo" class="sidebar-login" method="post" action="perfil/insertArtigo" enctype="multipart/form-data">
                                           <div class="col-sm-12">
                                              <a href="javascript:void(0);" id="upload_link2">
                                                 <img src="{avatar}" alt="" id="theavatar" class="avatar img-square img-responsive">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"> <small class="online">Alterar a Imagem em Destaque</small></a>
                                           </div>

                                             <div class="col-sm-12">
                                              <small>T&iacute;tulo</small>
                                           <input required="required" type="text" class="form-control" placeholder="T&iacute;tulo do Artigo" name="titulo">   
                                           </div>
                                           
                                           <div class="col-sm-12">
                                           <small>Categoria</small>
                                           <select class="form-control" name="categoria">
                                              <option value="0">Selecione uma categoria</option>
                                              {listagem_categorias}
                                           </select>
                                           </div>

                                             <div class="col-sm-12">
                                              <small>Tags</small>
                                           <input required="required" type="text" class="form-control" placeholder="Digite cada tag separada por virgula" name="tags">   
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

                                           <button type="submit" id="enviar" class="btn btn-raised btn-info gr">Enviar para Publicar</button>
                                           
                                        </form> 

                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->
        
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
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Cursos Salvos</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/perfil">Meu Perfil</a></li>
                        <li class="active">Cursos Salvos</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">bookmark</i> Cursos salvos por mim</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                       <!-- CONTENT -->
                                       {listagem}
                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                                                
                        <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        {box_meus_dados}

                                                
                </div><!-- end row -->
                
                
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END cursosMarcados -->

