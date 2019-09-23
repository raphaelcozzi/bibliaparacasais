<!-- BEGIN main_home -->
<div class="row">
   
  <div class="col-md-12">
  <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Artigos Pendentes de Aprova&ccedil;&atilde;o</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_1">
                                        <thead>
                                            <tr>
                                               <th>&nbsp;</th> 
                                                <th>T&iacute;tulo</th> 
                                                <th>Publica&ccedil;&atilde;o</th> 
                                                <th>Autor</th> 
                                                <th>Ver</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_artigos_pendentes}
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
  </div>

</div>
<div class="row">
   
  <div class="col-md-12">
  <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Coment&aacute;rios Pendentes de Aprova&ccedil;&atilde;o</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th> 
                                                <th>Onde?</th> 
                                                <th>Data</th> 
                                                <th>Coment&aacute;rio</th> 
                                                <th>Aprovar</th>
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_comentarios_pendentes}
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
  </div>

</div>

<div class="row">
   
  <div class="col-md-6">
  <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Novos Usu&aacute;rios Cadastrados</span>
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
                                                <th>Situa&ccedil;&atilde;o</th> 
                                                <th>Plano</th> 
                                                <th>Cadastro</th> 
                                                <th>&nbsp;</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_novos_usuarios}
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
  </div>

  <div class="col-md-6">
  <div class="portlet light bordered">
                            
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-list font-dark"></i>
                                        <span class="caption-subject bold uppercase">Atividade Recente</span>
                                    </div>
                                    
                                   
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover nowrap" id="sample_4">
                                        <thead>
                                            <tr>
                                                <th>Usu&aacute;rio</th> 
                                               <th>A&ccedil;&atilde;o</th> 
                                                <th>Data</th> 
                                                <th>&nbsp;</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                         				{listagem_atividade_recente}
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
  </div>
                                        
</div>
                                        
                                        
<script>
   
function ordena()
{
   return 1;
} 
</script>                                        


                                   
                
<!-- END main_home -->

<!-- BEGIN cabecalho -->
<!DOCTYPE html>

<!--[if IE 9]> <html class="no-js ie9 fixed-layout" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{TITULO_SISTEMA}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <base href="{ABS_LINK}" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{ABS_LINK}assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{ABS_LINK}assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{ABS_LINK}assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{ABS_LINK}assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="{ABS_LINK}assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="{ABS_LINK}assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
        
        <link rel="shortcut icon" href="{ABS_LINK}favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="home" style="margin-top:-27px;">
                        <img src="{ABS_LINK}assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
               <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="separator hide"> </li>
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    {total_pending_notifications} 
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">{total_pending_notifications} notifica&ccedil;&otilde;es</span> novas</h3>
                                       <!-- <a href="page_user_profile_1.html">ver tudo</a>-->
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 450px;" data-handle-color="#637283">
                                        {html_notifications}
                                            
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <li class="separator hide"> </li>
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"> {usuario_nome} </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    
                                    {avatar} </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="meusdados">
                                            <i class="icon-user"></i> Meus dados </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="login/logout">
                                            <i class="icon-key"></i> Sair </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">

		<div class="page-sidebar-wrapper">
        
        <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        {menu}
        </ul>
      </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>{page_title}
                               <!-- <small>blank page layout</small> -->
                            </h1>
                        </div>
        </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        {breadcrumbs}
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    {msg}               
               

<!-- END cabecalho -->

<!-- BEGIN footer -->

       </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2010 - 2019 &copy; {TITULO_SISTEMA}.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{ABS_LINK}assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{ABS_LINK}assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{ABS_LINK}assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		<script src="{ABS_LINK}assets/global/scripts/jquery.maskMoney.js" type="text/javascript"></script>

 		<script src="{ABS_LINK}assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript"></script>

        <script src="{ABS_LINK}assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>

        <script src="{ABS_LINK}assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
		<script src="{ABS_LINK}assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
        <script src="{ABS_LINK}assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>
       <!-- <script src="assets/global/plugins/jquery-1.4.2.min.js" type="text/javascript"></script> -->


<script>
 $(document).ready(function(){
               
 $("#formartigo").on("submit", function () {
    var hvalue = $('.ql-editor').html();
    $(this).append("<textarea name='conteudo' style='display:none'>"+hvalue+"</textarea>");
   }); 
 });
   
$(function(){
    $("#currency").maskMoney();
    $("#valor").maskMoney({symbol:"R$", decimal:",", thousands:"."});
    $("#precision").maskMoney({precision:3})
    $("#saldo_").maskMoney({symbol:"R$", decimal:",", thousands:"."});
    $("#limite_").maskMoney({symbol:"R$", decimal:",", thousands:"."});
    $("#chequeEspecial").maskMoney({symbol:"R$", decimal:",", thousands:"."});

})
function removeMask(){
    $("#currency").unmaskMoney();
}

$(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#uploadavatar:hidden").trigger('click');
    });

    $("#upload_link2").on('click', function(e){
        e.preventDefault();
        $("#uploadavatar:hidden").trigger('click');
    });

});        


document.getElementById("uploadavatar").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("theavatar").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};



</script>

    </body>

</html><!-- END footer -->

