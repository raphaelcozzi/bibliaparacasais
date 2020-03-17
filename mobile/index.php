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
// Verifica se o cookie de sessão existe e redireciona
if(isset($_COOKIE['bibliapcid']) && $_COOKIE['bibliapcid'] != "" && !$_SESSION['id'])
{
   $db99 = new db();

   $sql99 = "SELECT id_usuario FROM user_session WHERE session_id = '".$_COOKIE['bibliapcid']."' limit 1";
   $db99->query($sql99,__LINE__,__FILE__);
   $db99->next_record();
   $uid = $db99->f("id_usuario");
   
   if($db99->num_rows() > 0)
   {
      $sql99 = "SELECT * FROM usuarios WHERE ID = ".$uid." limit 1";
      $db99->query($sql99,__LINE__,__FILE__);
      $db99->next_record();

      if($db99->num_rows() > 0)
      {
            /* Guarda em sessão todos os parâmetros utéis do usuário */
      /*      $_SESSION['logado'] = "rRJ4fvbvtvgcf";
            $_SESSION['id'] = $db99->f("id");		
            $_SESSION['nome'] = $db99->f("nome");		
            $_SESSION['email'] = $db99->f("email");
            $_SESSION['alert_daily'] = $db99->f("alert_daily");		
            $_SESSION['boss'] = $db99->f("usuario_master");		
            $_SESSION['idioma'] = $db99->f("idioma");

                  if(substr($db99->f("avatar"),0,4) == "http")
                          $_SESSION['avatar'] = $db99->f("avatar");
                  else
                     $_SESSION['avatar'] = LINK_ORIGINAL."/".$db99->f("avatar");		

                  $_SESSION['telefone'] = $db99->f("telefone");		

                  $sql99 = "UPDATE usuarios SET online = 1 WHERE id = ".$_SESSION['id']." LIMIT 1";
                  $db99->query($sql99,__LINE__,__FILE__);
                  $db99->next_record();


                  if(ACTIVE_GRANTEES == 1)
                     $this->gera_permissoes($_SESSION['id']); // Chama a função que define as áreas que o usuário tem acesso.


               if($db99->f("avatar") == "")
               {
                  $avatar = 'http://www.placehold.it/60x60/EFEFEF/AAAAAA&amp;text=sem+imagem';
                  $_SESSION['avatar'] = $avatar;		
               }
               else
               {
                  $avatar = $db99->f("avatar");
                  $_SESSION['avatar'] = $db99->f("avatar");		
               }


                  if(date("H") > 00 && date("H") < 12)
                     $saudacao = "Bom dia";

                  if(date("H") >= 12 && date("H") < 18)
                     $saudacao = "Boa tarde";


                  if(date("H") >= 18 && date("H") <= 23)
                     $saudacao = "Boa noite";


                 // $this->notificacao($saudacao.", ".$_SESSION['nome']."! Seja Bem-vindo(a)!", "green");
                  //header("Location: ".ABS_LINK."home");
                   echo '<script>location="'.ABS_LINK.'";</script>';

      }
   }
  /* else // Se não encontrou o session_id no banco
   {
          //  header("Location: ".ABS_LINK."home");
       echo '<script>location="'.ABS_LINK.'";</script>';
   }
   */
   
/*   
}
*/
if(!$_REQUEST['module'] && !$_REQUEST['method'])
{
	if($_SESSION['logged'] == "43628bbbb8613ac94fd61bd46aab5a45314s" || $_SESSION['logado'] == "rRJ4fvbvtvgcf")
	{
		header("Location: index.php?module=home&method=main");
	}
}

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
			if($_REQUEST['module'] != "login" && $_REQUEST['module'] != "cadastro")
			{

						require_once("modules/login.php");
						$check = new login();
						$check->check_login();
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