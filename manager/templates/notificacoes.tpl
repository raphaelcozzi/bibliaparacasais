<!-- BEGIN main -->
<div class="row">
                        <div class="col-md-12">
                           <div>
                                    <a href="notificacoes/novo" class="btn default green-stripe">
                                            <i class="fa fa-plus"></i> Nova notificação push </a>
                           </div><br>
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Notificações Push Enviadas</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                               <th>Título</th> 
                                               <th>Conteúdo</th> 
                                                <th>Link</th> 
                                                <th>Data de Envio</th> 
                                                <th>Destinos</th> 
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

<!-- BEGIN novo -->
 <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Nova notificação Push</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                 <form action="index.php?module=notificacoes&method=send" method="post" name="notificacoes" id="notificacoes"  class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                      <div class="form-group">
                                                           <label class="col-md-3 control-label">T&iacute;tulo</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="title" required="">
                                                                <span class="help-block"> T&iacute;tulo. </span>
                                                            </div>
                                                        </div>                                    
                                   
                                                            <div class="form-group">
                                                           <label class="col-md-3 control-label">Mensagem</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="message" required="" id="msg">
                                                                <span class="help-block"> Conteúdo da notificação. </span>
                                                            </div>
                                                        </div>
                                                       
                                                            <div class="form-group">
                                                           <label class="col-md-3 control-label">Link</label>
                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" placeholder="" name="link" id="link">
                                                                <span class="help-block"> Link para onde o usuário é direcionado ao clicar na notificação.. </span>
                                                            </div>
                                                        </div>  
                                                       
                                                               <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Enviar</button>
                                                                <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>                                   
                                   
                                </div>
                                 </form>
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

<!-- END novo -->


