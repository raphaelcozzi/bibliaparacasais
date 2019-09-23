
<!-- BEGIN main -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                             <div>
                                    <a href="usuarios/usuarionovo" class="btn default green-stripe">
                                            <i class="fa fa-plus"></i> Incluir novo Widget </a>
                              </div>
                              <br>

                            <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Listagem de Widgets</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Nome</th> 
                                                <th>Posi&ccedil;&atilde;o</th> 
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
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user"></i>Editar Widget </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=widgets&method=update" method="post" name="editar"  class="form-horizontal" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="{id}" />
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Nome</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="nome" value="{nome}">
                                                                <span class="help-block"> Nome do widget. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">Conte&uacute;do</label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" rows="15" id="textArea" name="content">{content}</textarea>
                                                                <span class="help-block">Insira aqui o conte&uacute;do do widget. Aceita tags HTML.</span>
                                                            </div>
                                                        </div>
                                                       
                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">Posi&ccedil;&atilde;o</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                   <select name="position" id="position"  class="form-control">
                                                               {listagem_positions}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>                                                       

                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                   <select name="status" id="status"  class="form-control">
                                                               {listagem_status}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>                                                       

                                                    </div>

                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Salvar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
<!-- END edita -->



<!-- BEGIN novo -->
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user"></i>Novo Widget </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="index.php?module=widgets&method=insere" method="post" name="editar"  class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Nome</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="" name="nome">
                                                                <span class="help-block"> Nome do widget. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="col-md-3 control-label">Conte&uacute;do</label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" rows="15" id="textArea" name="content"></textarea>
                                                                <span class="help-block">Insira aqui o conte&uacute;do do widget. Aceita tags HTML.</span>
                                                            </div>
                                                        </div>
                                                       
                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">Posi&ccedil;&atilde;o</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                   <select name="position" id="position"  class="form-control">
                                                               {listagem_positions}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                           
                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                   <select name="status" id="status"  class="form-control">
                                                               {listagem_status}
                                                           </select>
                                                                </div>
                                                            </div>
                                                        </div>   

                                                    </div>

                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Salvar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
<!-- END novo -->

