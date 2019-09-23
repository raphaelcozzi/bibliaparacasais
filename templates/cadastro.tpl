<!-- BEGIN main -->
<section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Entrar ou Cadastrar-se</h1>
                    <ul class="breadcrumb">
                        <li><a href="/home">In&iacute;cio</a></li>
                        <li class="active">Entrar ou Cadastrar-se</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">lock_open</i> Acessar a conta</h4>
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="login-buttons">
                                        <a href="3rd_party/sdk-facebook/fbconfig.php" class="btn btn-raised btn-facebook btn-block"><i class="fa fa-facebook"></i> Entrar com Facebook</a>
                                        <a href="{google_login_url}" class="btn btn-raised btn-google-plus btn-block"><i class="fa fa-google"></i> Entrar com Google</a>

                                        
                                        </div>

                                       <form class="sidebar-login" action="/login/logar" method="post">
                                            <input type="text" class="form-control" name="login" placeholder="E-mail">
                                            <input type="password" name="senha" class="form-control" placeholder="Senha">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="lembrar" value="1"> &nbsp;&nbsp;Lembrar de mim
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-raised btn-info gr">Entrar</button>
                                        </form> 
                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>

                    <div class="col-md-7">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">lock</i> Cadastrar</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <form class="sidebar-login" action="/cadastro/insere" method="post">
                                           <input type="text" class="form-control" placeholder="Nome" name="nome" required>
                                            <input type="email" class="form-control" placeholder="E-mail" name="email" required>
                                            <input type="password" class="form-control" placeholder="Senha" name="senha" required>
                                            <input type="password" class="form-control" placeholder="Re-digite sua senha" name="senha2" required>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> &nbsp;&nbsp;Receber novidades
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-raised btn-info gr">Concluir Cadastro</button>
                                        </form> 

                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

<!-- END main -->


<!-- BEGIN continuar -->
 <div class="container">
                <div class="row">
                    <div class="content col-md-12">
                        <div class="welcome-text">
                           <h1>Parab&eacute;ns! Seu cadastro foi feito com sucesso.</h1>
                           <p>Um e-mail de confirma&ccedil;&atilde;o foi enviado para voc&ecirc;.</p>
                           <p><a class="btn btn-raised btn-info gr" href="/home"><i class="material-icons">arrow_right_alt</i>&nbsp;&nbsp; Continuar</a></p>
                        </div>
                    </div>
                </div>
 </div> 

<!-- END continuar -->


<!-- BEGIN confirm -->
 <div class="container">
                <div class="row">
                    <div class="content col-md-12">
                        <div class="welcome-text">
                           <h1>Parab&eacute;ns! Seu cadastro foi feito com sucesso.</h1>
                           <h3>Confirme seu cadastro.</h3>
                           <p>Um e-mail de confirma&ccedil;&atilde;o foi enviado para voc&ecirc;.</p>
                           <p><a class="btn btn-raised btn-info gr" href="/home"><i class="material-icons">arrow_right_alt</i>&nbsp;&nbsp; Continuar</a></p>
                        </div>
                    </div>
                </div>
 </div> 

<!-- END confirm -->

<!-- BEGIN unconfirmed -->
 <div class="container">
                <div class="row">
                    <div class="content col-md-12">
                        <div class="welcome-text">
                           <h1>Seu e-mail ainda n&atilde;o foi confirmado.</h1>
                           <h3>Para acessar sua conta &eacute; necess&aacute;rio confirmar seu cadastro.</h3>
                           <p>Um e-mail de confirma&ccedil;&atilde;o foi enviado para voc&ecirc;.</p>
                           <p><a class="btn btn-raised btn-info gr" href="/home"><i class="material-icons">arrow_right_alt</i>&nbsp;&nbsp; Continuar</a></p>
                        </div>
                    </div>
                </div>
 </div> 

<!-- END unconfirmed -->
