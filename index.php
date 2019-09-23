<?php 
require_once("config.php");
require_once 'vendor/autoload.php';

if(HTTPS == 1)
{
	if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
		$redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirect_url");
		exit();
	}
}
/*
if(LOADING_BAR == 1)
	ob_start();
*/

require_once(CONFIG_PATH."/inc/base.php");
require_once(CONFIG_PATH."/int/".CONFIG_LANG.".php");

/*
if(!$_REQUEST['module'] && !$_REQUEST['method'])
{
	if($_SESSION['logged'] == "43628bbbb8613ac94fd61bd46aab5a45314s")
	{
		header("Location: index.php?module=home&method=main");
	}
}
*/
/**
*	Papaya FrameWork by Global Soft Union
*			
*	 @version V4.0  
*	 @data Mai 2019   
*	 @author Raphael Cozzi
*	 
*   Adicionado o Composer com autoload e pacotes Monolog, GUMP e PHPUnit
*
*	* O index.php chama o modulo correspondente, dizendo qual método dele será chamado
*	* em seguida o modulo chama as o método que pode chamar outros métodos, caso necessário.
*	* Os métodos setam variaveis para os htmls em /templates.
*/

		// VERIFICA SE O USUÁRIO ESTÁ LOGADO
/*
		if($_REQUEST['module'] && $_REQUEST['method'])
			if($_REQUEST['module'] != "login")
			{

				if($_REQUEST['module'] != "cadastro")
				{

				if(LOADING_BAR == 1)
				{
					ob_start();
					echo '<style type="text/css">
						.overover
						{
							width:100%;
							height:100%;
							background-image:url(images/ajax-loader.gif);
							background-position:center;
							background-repeat:no-repeat;
							background-color:#FFF;	
						}
						</style>
						<div id="overover" class="overover"></div>';
						
						ob_flush();
				}

						require_once("modules/login.php");
						$check = new login();
						$check->check_login();
				}
			}
*/

	/***************************************************************************/
	//                                                                         //
	//                                MÓDULO                                   //
	//                                                                         //
	//*************************************************************************/
	/* Pega o parametro que foi passado em module que vai definir qual modulo sera usado */
	if($_REQUEST['module'])
		$module = $_REQUEST['module']; 
	else
		$module = "home";
   
	/***************************************************************************/
	//                                                                         //
	//                                MÉTODO                                   //
	//                                                                         //
	//*************************************************************************/
	/* Pega o parametro que foi passado que define o método que será usado do módulo */
	if($_REQUEST['method'])
		$method = $_REQUEST['method'];
	else
		$method = "main";	

		/* Primeiro verifica se o arquivo que contem o modulo realmente existe */
		if(file_exists("modules/".$module.".php"))
			include("modules/".$module.".php");
		else
			echo "M&oacute;dulo Inexistente.";

	eval('$obj = new '.($module).'();');
	eval('$obj->'.($method).'();');

?>