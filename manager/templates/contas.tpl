<!-- BEGIN main -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                             <div>
                                    <a href="usuarios/usuarionovo" class="btn default green-stripe">
                                            <i class="fa fa-plus"></i> Incluir </a>
                              </div>
                              <br>

                            <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Listagem de Usu&aacute;rios Cadastrados</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Nome</th> 
                                                <th>Email</th> 
                                                <th>Origem</th> 
                                                <th>Situa&ccedil;&atilde;o</th> 
                                                <th>Cidade</th> 
                                                <th>Estado</th> 
                                                <th>Plano</th> 
                                                <th>Cadastro</th> 
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

<!-- BEGIN edita -->
<style>
#uploadavatar{
    display:none;
}

</style>
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user"></i>Editar Conta de Usu&aacute;rio </div>
                                                    <!--
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                                -->
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=contas&method=update" method="post" name="editar"  class="form-horizontal" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="{id}" />
                                                    <input type="hidden" name="senha_old" value="{senha}" />
                                                    <input type="hidden" name="exception" value="{excpt_value}" />
                                                    <div class="form-body">
                                                      <div class="form-group">
                                                           <label class="col-md-3 control-label">Origem:</label>
                                                            <div class="col-md-4">
                                                               <h3 style="margin-top:0px;">{origem}</h3>
                                                                  <span class="help-block"> Origem do cadastro da conta do usu&aacute;rio. </span>
                                                            </div>
                                                        </div>                                                       
                                                       
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Nome</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="nome" value="{nome}">
                                                                <span class="help-block"> Nome do usu&aacute;rio. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Email </label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    
                                                                    <input type="email" name="email" class="form-control" placeholder="" value="{email}">                                                                   <span class="input-group-addon input-circle-right">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </span>
                                                                  </div>
                                                                   <span class="help-block"> (Ser&aacute; o login) </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Senha</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input type="password" name="senha" class="form-control" placeholder="Senha" value="{senha}">
                                                                    <span class="input-group-addon input-circle-right">
                                                                        <i class="fa fa-key"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Confirme a Senha</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input type="password" name="senha2" class="form-control" placeholder="Repita a senha" value="{senha}">
                                                                    <span class="input-group-addon input-circle-right">
                                                                        <i class="fa fa-key"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Pa&iacute;s</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="pais" value="{pais}">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                                    

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Estado</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="estado" id="estados"  class="form-control">
                                                               {listagem_estado}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Cidade</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="cidade" id="cidades"  class="form-control">
                                                               {listagem_cidade}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Telefone</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="telefone" value="{telefone}">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Foto</label>
                                                            <div class="col-md-4">
                                                                  <a href="javascript:void(0);" id="upload_link2"><img src="{avatar}" alt="" id="theavatar" class="avatar img-circle img-responsive"></a>

                                                                     <input id="uploadavatar" name="avatar" type="file"/>

                                                                   <a href="javascript:void(0);" id="upload_link">  <center><small class="online">Alterar Foto</small></center></a>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Bio</label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" rows="4" id="textArea" placeholder="Sobre mim" name="bio">{bio}</textarea>
                                                                <span class="help-block">Resumo sobre o usu&aacute;rio</span>
                                                            </div>
                                                        </div>
                    									 
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Notifica&ccedil;&otilde;es</label>
                                                            <div class="col-md-4">
                                                                <input type="checkbox" name="alert_daily" value="1" {alert_daily_chk}> &nbsp;&nbsp;Receber notifica&ccedil;&otilde;es e alertas
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                                
                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">Plano</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="plano" id="plano"  class="form-control">
                                                               {listagem_planos}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>                                                                

                                                            <div class="form-group">
                                                               <label class="col-md-3 control-label">Situa&ccedil;&atilde;o</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="situacao" id="situacao"  class="form-control">
                                                               {listagem_situacoes}
                                                           </select>
                                                                </div>
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
                                                           
                  <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                         <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Artigos publicados pelo usu&aacute;rio</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>Imagem</th> 
                                                <th>T&iacute;tulo</th> 
                                                <th>Categoria</th> 
                                                <th>Publica&ccedil;&atilde;o</th> 
                                                <th>Situa&ccedil;&atilde;o</th> 
                                                <th>Curtidas</th> 
                                                <th>Coment&aacute;rios</th> 
                                                <th>&nbsp;</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_artigos}
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
                                        <span class="caption-subject bold uppercase">Coment&aacute;rios feitos pelo usu&aacute;rio</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                               <th>&nbsp;</th> 
                                                <th>Onde?</th> 
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
                                                           
                                                           
                                                           
                                                <!-- END FORM-->
                                            </div>
                                        </div>
	<script type="text/javascript">
    $(document).ready(function(){
    $('#estados').change(function(){
    $('#cidades').load('index.php?module=meus_dados&method=ajax_cidade&estado='+$('#estados').val() );
    
    });
    });
    
    </script>

<script>
   
function ordena()
{
   return 4;
} 
</script>                                        


<!-- END edita -->



<!-- BEGIN novo -->
<style>
#uploadavatar{
    display:none;
}

</style>
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user"></i>Nova Conta de Usu&aacute;rio </div>
                                                    <!--
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                                -->
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=contas&method=insere" method="post" name="editar"  class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Nome</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="nome">
                                                                <span class="help-block"> Nome do usu&aacute;rio. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Email </label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    
                                                                    <input type="email" name="email" class="form-control" placeholder="">                                                                   <span class="input-group-addon input-circle-right">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </span>
                                                                  </div>
                                                                   <span class="help-block"> (Ser&aacute; o login) </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Senha</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                                                                    <span class="input-group-addon input-circle-right">
                                                                        <i class="fa fa-key"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Confirme a Senha</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input type="password" name="senha2" class="form-control" placeholder="Repita a senha">
                                                                    <span class="input-group-addon input-circle-right">
                                                                        <i class="fa fa-key"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Pa&iacute;s</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="pais">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Estado</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="estado" id="estados"  class="form-control">
                                                               {listagem_estado}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Cidade</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="cidade" id="cidades"  class="form-control">
                                                               {listagem_cidade}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Telefone</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="telefone">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Foto</label>
                                                            <div class="col-md-4">
                                                                  <a href="javascript:void(0);" id="upload_link2"><img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=sem+foto" alt="" id="theavatar" class="avatar img-circle img-responsive"></a>

                                                                     <input id="uploadavatar" name="avatar" type="file"/>

                                                                   <a href="javascript:void(0);" id="upload_link">  <center><small class="online">Alterar Foto</small></center></a>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                         <div class="form-group">
                                                            <label class="col-md-3 control-label">Bio</label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" rows="4" id="textArea" placeholder="Sobre mim" name="bio"></textarea>
                                                                <span class="help-block">Resumo sobre o usu&aacute;rio</span>
                                                            </div>
                                                        </div>
                    									 
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Notifica&ccedil;&otilde;es</label>
                                                            <div class="col-md-4">
                                                                <input type="checkbox" name="alert_daily" value="1"> &nbsp;&nbsp;Receber notifica&ccedil;&otilde;es e alertas
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                                
                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">Plano</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="plano" id="plano"  class="form-control">
                                                               {listagem_planos}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>                                                                

                                                            <div class="form-group">
                                                               <label class="col-md-3 control-label">Situa&ccedil;&atilde;o</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                           <select name="situacao" id="situacao"  class="form-control">
                                                               {listagem_situacoes}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>                                                                

                                                    </div>

                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Cadastrar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
	<script type="text/javascript">
    $(document).ready(function(){
    $('#estados').change(function(){
    $('#cidades').load('index.php?module=meus_dados&method=ajax_cidade&estado='+$('#estados').val() );
    
    });
    });
    
    </script>




<!-- END novo -->

