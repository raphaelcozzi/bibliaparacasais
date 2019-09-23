<!-- BEGIN main -->
       <section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Artigos {txt_tag}</h1>
                    <ul class="breadcrumb">
                        <li><a href="home.php">In&iacute;cio</a></li>
                        <li class="active">Artigos {txt_tag}</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->
                    <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="topic-page topic-list blog-list">

                                {listagem_artigos}

                             <ul class="pager">
                                <li> <a href="javascript:void(0)" id="loadMore">Carregar Mais</a></li>
                            </ul>

                                                        <!-- end article well -->

                            
                        </div><!-- end blog-list -->
                    </div><!-- end col -->


                    <div class="col-md-4">
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->


                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Artigos Recentes</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                       {listagem_artigos_recentes}
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END main -->



<!-- BEGIN artigo -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>{titulo}</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li><a href="/artigos">Artigos</a></li>
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
                                            <h4><a href="single-topic.html" title="">{titulo}</a></h4>
                                            <div class="blog-meta clearfix">
                                                <small>publicado em {dataCadastro}</small>
                                                <small><a href="javascript:void(0)">{total_comentarios} Coment&aacute;rios</a></small>
                                                <small><a href="javascript:void(0)">{total_curtidas} Curtidas</a></small>
                                                <small>em <a href="javascript:void(0)"> {categoria}</a></small>
                                                <small>por <a href="javascript:void(0)"> {nome_usuario}</a></small>
                                            </div>
                                        </div>
                                        {conteudo}
                                    </div>
                                </div>{tags}
                                <!-- end tpic-desc -->
               

                                {box_social}
                                <!-- end topic -->
                            </article>
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


                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Artigos Recentes</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                       {listagem_artigos_recentes}
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END artigo -->