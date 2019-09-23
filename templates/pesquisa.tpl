<!-- BEGIN main -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Pesquisa</h1>
                    <ul class="breadcrumb">
                        <li><a href="home.php">Home</a></li>
                        <li class="active">Pesquisa</li>
                    </ul>
                    <form class="site-search b text-left" action="pesquisa" method="post" name="pesquisa">
                        <div class="form-group label-floating">
                           <label class="control-label" for="focusedInput2">O que voc&ecirc; deseja encontrar?</label>
                           <input class="form-control" id="focusedInput2" type="text" required="required" name="q" value="{q}">
                        </div>
                        <div class="form-group clearfix">
                            <!-- inline style is just to demo custom css to put checkbox below input above -->
                            <div class="checkbox pull-left">
                                <label>
                                   <input type="radio" name="tipo" value="artigos" {artigosSelected}> &nbsp;Em Artigos
                                </label>
                                <label>
                                   <input type="radio" name="tipo" value="biblia" {bibliaSelected}> &nbsp;Na B&iacute;blia
                                </label>
                            </div>
                            <div class="submit-button pull-right">
                               <button type="submit" class="btn btn-raised btn-info gr"><i class="material-icons">search</i> Pesquisar</button>
                            </div>
                        </div>
                                
                    </form>
                               
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->
        
        {titulo_resultado_pesquisa}

        <section class="section lb">
            <div class="container" style="margin-top: -50px;">
                <div class="row">
                    <div class="col-md-8">
                        <div class="topic-page topic-list blog-list">
                           
                           
                           {listagem_pesquisa}
                          {botao_mais}
                          
                          

                            
                        </div><!-- end blog-list -->
                        
<div class="widget nopadding clearfix">
                            <div class="panel panel-primary nopadding">
                                <div class="panel-heading">
                                    <h3 class="panel-title">O que a B&iacute;blia diz sobre:</h3>
                                </div>
                                <div class="panel-body">
                               <ul class="list-inline tags">
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=amor">Amor</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=paz">Paz</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=fe">F&eacute;</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=cura">Cura</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=casamento">Casamento</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=ressurreicao">Ressurei&ccedil;&atilde;o</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=medo">Medo</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=forca">For&ccedil;a</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=esperanca">Esperan&ccedil;a</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=ansiedade">Ansiedade</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=perdao">Perd&atilde;o</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=alegria">Alegria</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=criancas">Crian&ccedil;as</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=confianca">Confian&ccedil;a</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=oracao">Ora&ccedil;&atilde;o</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=graca">Gra&ccedil;a</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=sabedoria">Sabedoria</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=preocupacao">Preocupa&ccedil;&atilde;o</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=raiva">Raiva</a></li>
                                            <li><a href="index.php?module=pesquisa&method=main&tipo=biblia&q=santo+espirito">Santo Esp&iacute;rito</a></li>
                                        </ul>
                                </div>
                            </div>
                        </div><!-- end widget -->
                        
                    </div>
                    <div class="col-md-4">
                       
                     <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                   <h3 class="panel-title">Hist&oacute;rias B&iacute;blicas</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                       <!-- CONTENT -->
                                       <div class="list-group-item">
                                                           
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A cria&ccedil;&atilde;o do Mundo</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/1"><small>Genesis 1</small></a> <a href="{ABS_LINK}livros/livro/gn/2"><small>Genesis 2:1-4</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A queda</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/3"><small>Genesis 3</small></a>                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> No&eacute; e o dil&uacute;vio</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/6"><small>Genesis 6:5-22</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/7"><small>Genesis 7</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/8"><small>Genesis 8</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/9"><small>Genesis 9:1-17</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Abra&atilde;o foi chamado por Deus</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/12"><small>Genesis 12:1-9</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/15"><small>Genesis 15:1-7</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Abra&atilde;o e Isaque</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/15"><small>Genesis 15:1-6</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/21"><small>Genesis 21:1-7</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/22"><small>Genesis 22:1-19</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jos&eacute; &eacute; vendido como escravo</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/37"><small>Genesis 37</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jos&eacute; sobe ao poder</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/gn/39"><small>Genesis 39</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/40"><small>Genesis 40</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/41"><small>Genesis 41</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/42"><small>Genesis 42</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/43"><small>Genesis 43</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/44"><small>Genesis 44</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/gn/45"><small>Genesis 45</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> O nascimento de Mois&eacute;s e a Sar&ccedil;a ardente</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/ex/1"><small>&Ecirc;xodo 1:6-22</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/3"><small>&Ecirc;xodo 3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/4"><small>&Ecirc;xodo 4</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> As pragas e a P&aacute;scoa</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/ex/5"><small>&Ecirc;xodo 5</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/6"><small>&Ecirc;xodo 6</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/7"><small>&Ecirc;xodo 7</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/8"><small>&Ecirc;xodo 8</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/9"><small>&Ecirc;xodo 9</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/10"><small>&Ecirc;xodo 10</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/11"><small>&Ecirc;xodo 11</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/12"><small>&Ecirc;xodo 12</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A separa&ccedil;&atilde;o do Mar Vermelho e os dez Mandamentos</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/ex/14"><small>&Ecirc;xodo 14</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/19"><small>&Ecirc;xodo 19</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/20"><small>&Ecirc;xodo 20</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ex/34"><small>&Ecirc;xodo 34</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Entrando na Terra Prometida</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/nm/13"><small>N&uacute;meros 13</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/nm/14"><small>N&uacute;meros 14</small></a>
                                                                     <a href="{ABS_LINK}livros/livro/js/2"><small>Josu&eacute; 2</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/js/3"><small>Josu&eacute; 3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/js/5"><small>Josu&eacute; 5</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/js/6"><small>Josu&eacute; 6</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Sans&atilde;o</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/jz/13"><small>Ju&iacute;zes 13</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jz/14"><small>Ju&iacute;zes 14</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jz/15"><small>Ju&iacute;zes 15</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jz/16"><small>Ju&iacute;zes 16</small></a>
                                                              </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Rute</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/rt/1"><small>Rute 1</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/rt/2"><small>Rute 2</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/rt/3"><small>Rute 3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/rt/4"><small>Rute 4</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Samuel &eacute; chamado por Deus</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/1sm/1"><small>1Samuel 1</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/1sm/3"><small>1Samuel 3</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Davi e Golias</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/1sm/1"><small>1Samuel 1</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/1sm/17"><small>1Samuel 17</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Elias</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/1rs/16"><small>1Reis 16:29-34</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/1rs/17"><small>1Reis 17</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/1rs/18"><small>1Reis 18</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/1rs/19"><small>1Reis 19</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/1rs/21"><small>1Reis 21:17-29</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/2rs/1"><small>2Reis 1</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/2rs/2"><small>2Reis 2:1-18</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Neemias e Esdras</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/ne/1"><small>Neemias 1</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ne/2"><small>Neemias 2</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ne/3"><small>Neemias 3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ne/4"><small>Neemias 4</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ne/6"><small>Neemias 6:15-16</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ne/1"><small>Neemias 8:1-3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ne/10"><small>Neemias 10:28-29</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Ester</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/et/2"><small>Ester 2</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/3"><small>Ester 3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/4"><small>Ester 4</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/5"><small>Ester 5</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/6"><small>Ester 6</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/7"><small>Ester 7</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/8"><small>Ester 8</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/et/9"><small>Ester 9</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Daniel na cova dos Le&otilde;es</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/dn/6"><small>Daniel 6</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> O nascomento de Jesus</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/1"><small>Mateus 1:18-25</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/1"><small>Lucas 1:26-38</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/2"><small>Lucas 2:1-21</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus &eacute; batizado</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/3"><small>Mateus3</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/1"><small>Marcos 1:1-11</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/3"><small>Lucas 3:15-22</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/1"><small>Jo&atilde;o 1:29-34</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus &eacute; tentado</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/4"><small>Mateus 4:1-11</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/1"><small>Marcos 1:12-13</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/4"><small>Lucas 4:1-13</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> O serm&atilde;o da Montanha</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/5"><small>Mateus 5</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mt/6"><small>Mateus 6</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mt/7"><small>Mateus 7</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus cura um homem paral&iacute;tico</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/9"><small>Mateus 9:2-8</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/2"><small>Marcos 2:1-12</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/5"><small>Lucas 5:17-29</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus expulsa desp&iacute;ritos malignos</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/8"><small>Mateus 8:28-34</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/5"><small>Marcos 5:1-20</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/8"><small>Lucas 8:27-39</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus cura uma menina</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/9"><small>Mateus 9:18-26</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/5"><small>Marcos 5:21-43</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/8"><small>Lucas 8:40-56</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus alimenta 5.000</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/14"><small>Mateus 14:13-21</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/6"><small>Marcos 6:30-44</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/9"><small>Lucas 9:10-17</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/6"><small>Jo&atilde;o 6:1-14</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Um pai e seus dois filhos</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/lc/15"><small>Lucas 15:11-32</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A entrada triunfal</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/21"><small>Mateus 21:1-11</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/11"><small>Marcos 11:1-11</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/19"><small>Lucas 19:28-44</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/12"><small>Jo&atilde;o 12:12-19</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A &uacute;ltima ceia</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/26"><small>Mateus 26:14-30</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/14"><small>Marcos 14:12-26</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/22"><small>Lucas 22:7-23</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/13"><small>Jo&atilde;o 13:1-30</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus &eacute; preso</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/26"><small>Mateus 26:36-75</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/14"><small>Marcos 14:32-50</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/22"><small>Lucas 22:39-53</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/18"><small>Jo&atilde;o 18:1-11</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A cruz</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/27"><small>Mateus 27:11-61</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/15"><small>Marcos 15</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/23"><small>Lucas 23</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/18"><small>Jo&atilde;o 18:28-40</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/19"><small>Jo&atilde;o 19</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> O t&uacute;mulo vazio</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/27"><small>Mateus 27:61-66</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mt/28"><small>Mateus 28:1-15</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/16"><small>Marcos 16:1-14</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/24"><small>Lucas 24:1-49</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/jo/20"><small>Jo&atilde;o 20</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Jesus volta para o c&eacute;u</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/mt/28"><small>Mateus 28:16-20</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/mc/16"><small>Marcos 16:15-20</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/lc/24"><small>Lucas 24:50-53</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/18"><small>Atos 1:1-11</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> A vinda do Esp&iacute;rito Santo</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/at/2"><small>Atos 2</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Um paral&iacute;tico &eacute; curado</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/at/3"><small>Atos 3</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Paulo encontra Jesus</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/at/9"><small>Atos 9:1-9</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Corn&eacute;lio e a vis&atilde;o de Pedro</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/at/10"><small>Atos 10</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Viagens de Paulo e suas prova&ccedil;&otilde;es</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/at/13"><small>Atos 13</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/14"><small>Atos 14</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/16"><small>Atos 16</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/17"><small>Atos 17</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/18"><small>Atos 18</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/19"><small>Atos 19</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/20"><small>Atos 20</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/21"><small>Atos 21</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/25"><small>Atos 25</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/27"><small>Atos 27</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/at/28"><small>Atos 28</small></a>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                  <h3><a href="{ABS_LINK}perfil/artigos"><i class="material-icons">class</i> Novos C&eacute;us e Nova Terra</a></h3>
                                                                  <a href="{ABS_LINK}livros/livro/ap/21"><small>Apocalipse 21</small></a>
                                                                  <a href="{ABS_LINK}livros/livro/ap/22"><small>Apocalipse 22:1-5</small></a>
                                                               </header>
                                                           </div>
                                                       
                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>                       
                       
                        <div class="widget clearfix">
                            <div class="banner-widget">
                                <a href="" target="new"><img src="assets/images/uploads/banner.jpg" alt="" class="img-responsive"></a>
                            </div>
                        </div><!-- end widget -->
                        
                        
                           
                        
                                    </div><!-- end container -->
                     </section><!-- end section -->
<!-- END main -->


