<!-- BEGIN main -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Cursos</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li>Cursos</a></li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                       
                       
                       {listagem_cursos_recentes}
                             <ul class="pager">
                                <li> <a href="javascript:void(0)" id="loadMore">Carregar Mais</a></li>
                            </ul>                       
                       
                    <div class="widget nopadding clearfix">
                            <div class="panel panel-primary nopadding">
                                <div class="panel-heading">
                                   <h3 class="panel-title">Ajude-me a encontrar um curso:</h3>
                                </div>
                                <div class="panel-body">
                                 {listagem_sugestoes_cursos}
                                </div>
                            </div>
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

<!-- BEGIN curso -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>{titulo}</h1>
                    <ul class="breadcrumb">
                        <li><a href="{ABS_LINK}home">In&iacute;cio</a></li>
                        <li><a href="{ABS_LINK}cursos">Cursos</a></li>
                        <li class="active">{titulo}</li>
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
                                        {imagem_destaque}

                                        <div class="single-topic-meta">
                                            <h4><a>{titulo}</a></h4>
                                            <div class="pull-left"></div>
                                            <div class="pull-right">Dura&ccedil;&atilde;o: {duracao} dia{s}</div>
                                            <div class="blog-meta clearfix">
                                                <small>publicado em {dataCadastro}</small>
                                                <small><a href="javascript:void(0)">{total_comentarios} Coment&aacute;rios</a></small>
                                                <small><a href="javascript:void(0)">{total_curtidas} Curtidas</a></small>
                                                <small>em <a href="javascript:void(0)"> {categoria}</a></small>
                                                <small><a href="javascript:void(0)"> {quantos_completaram}</a> completaram</small>
                                            </div>
                                        </div><hr>
                                        {resumo}
                                    </div>
                                </div>{tags}
                                <!-- end tpic-desc -->
               

                                {box_social}
                                <!-- end topic -->
                            </article>
                                <article class="well clearfix">
                                <div class="topic-desc row-fluid clearfix">
                                    <div class="col-sm-12">

                                        <div class="single-topic-meta">
                                            <h4><a>Cursos Relacionados</a></h4>
                                            {cursos_relacionados}
                                    </div>
                                </div>
                            </article>
                                
                                
                                
                                
                           <ul class="pager">
                                <li> <a href="javascript:void(0)" id="loadMore2">Carregar Mais Cursos</a></li>
                            </ul>
                            
                            
                            <!-- end article well -->
                        </div><!-- end blog-list -->

                    {box_comentar_post}
                        
                        
                        
                  <div class="row">
                    <div class="col-md-12">
                        <aside class="topic-page topic-list blog-list forum-list single-forum">
                            {listagem_comentarios}

                           <ul class="pager">
                                <li> <a href="javascript:void(0)" id="loadMore">Carregar Mais</a></li>
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
                        
                        {box_meus_dados}


                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Cursos Recentes</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                       {listagem_cursos_recentes}
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->


<!-- END curso -->


<!-- BEGIN aula -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>{titulo}</h1>
                    <ul class="breadcrumb">
                        <li><a href="{ABS_LINK}home">In&iacute;cio</a></li>
                        <li><a href="{ABS_LINK}cursos">Cursos</a></li>
                        <li><a href="{ABS_LINK}cursos/curso/{slug}">Cursos</a></li>
                        <li class="active">Iniciar Curso</li>
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
                                        {imagem_destaque}

                                        <div class="single-topic-meta">
                                            <h4><a>{titulo}</a></h4>
                                            <div class="pull-left"></div>
                                            <div class="pull-right">Dura&ccedil;&atilde;o: {duracao} dia{s}</div>
                                            <div class="blog-meta clearfix">
                                                <small>publicado em {dataCadastro}</small>
                                                <small><a href="javascript:void(0)">{total_comentarios} Coment&aacute;rios</a></small>
                                                <small><a href="javascript:void(0)">{total_curtidas} Curtidas</a></small>
                                                <small>em <a href="javascript:void(0)"> {categoria}</a></small>
                                                <small><a href="javascript:void(0)"> {quantos_completaram}</a> completaram</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> 
                                    
                                   
                                    
                                    
                            </article>
                            
                            <!-- end article well -->
                        </div><!-- end blog-list -->
                        
                        <div class="widget nopadding clearfix">
                            <div class="panel panel-primary nopadding">
                                <div class="panel-heading">
                                   <h3 class="panel-title">Plano de Estudo</h3>
                                </div>
                               <div class="panel-body">
                                 {listagem_dias} 
                                  
                                  
                               </div>
                            </div>
                            </div>
                                         
                       </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->
                        
                        {box_meus_dados}

                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END aula -->

<!-- BEGIN topico -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>{titulo}</h1>
                    <ul class="breadcrumb">
                        <li><a href="{ABS_LINK}home">In&iacute;cio</a></li>
                        <li><a href="{ABS_LINK}cursos">Cursos</a></li>
                        <li><a href="{ABS_LINK}cursos/curso/{curso_slug}">{curso_titulo}</a></li>
                        <li class="active">{titulo}</li>
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
                                        {imagem_destaque}

                                        <div class="single-topic-meta">
                                            <h4><a>{titulo}</a></h4>
                                            
                                        </div><hr>
                                        {conteudo}
                                    </div><div class="pull-left"><a href="{ABS_LINK}cursos/aula/{curso_slug}" class="btn btn-raised btn-info gr"><i class="material-icons">arrow_back</i></a></div>
                                            <div class="pull-right"><a href="{ABS_LINK}cursos/concluitopic/{slug}"  class="btn btn-raised btn-info gr"><i class="material-icons">check</i></a></div>
                                </div>
                                    <!-- end topic -->
                            </article>
                            <!-- end article well -->
                        </div><!-- end blog-list -->

                                          
                       </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->
                        
                        {box_meus_dados}

                        
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END topico -->