<?php
class login
{
	
	/** OS SEGUINTES DADOS DO USUÁRIO SÃO ARMAZENADOS EM SESSÕES:
	*
	*				$_SESSION['logged'] = "43628bbbb8613ac94fd61bd46aab5a45314s";
	*				$_SESSION['id']
	*				$_SESSION['nome']		
	*				$_SESSION['email']
	*				$_SESSION['alert_daily']
	*				$_SESSION['boss']
	*				$_SESSION['lancamentos_lote']		
	*				$_SESSION['grantees']		
	*				$_SESSION['idioma']		
    */
	
	
	function main()
	{
		$db = new db();

		@session_start();


			$sql = "select * from estados";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			$listagem_estado = "<option value='7' selected>Rio de Janeiro</option>";
			
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$listagem_estado .= "<option value='".$db->f("id")."' ";
				
				if($db->f("id") == $estado)
					$listagem_estado .= "selected='selected'";
				
				$listagem_estado .= ">".$db->f("estado")."</option>";			
	
				$db->next_record();

			}

	   $sql = "SELECT * FROM cidades WHERE id_estados = 7";
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	
	   for($i = 0; $i < $db->num_rows(); $i++)
	   {
		   $listagem_cidade .= "<option value='".$db->f("id")."'>".$db->f("cidade")."</option>";
	
		   $db->next_record();
	
	   }
		   $alertaDisplay = 'hide';

			$GLOBALS["base"]->template->set_var("alertaDisplay",$alertaDisplay);

   		$GLOBALS["base"]->template->set_var('ABS_LINK' ,ABS_LINK);
			$GLOBALS["base"]->template->set_var("TX_ENTRAR",TX_ENTRAR);
			$GLOBALS["base"]->template->set_var("TX_LEMBRAR",TX_LEMBRAR);
			$GLOBALS["base"]->template->set_var("TX_LOGIN",TX_LOGIN);
			$GLOBALS["base"]->template->set_var("TX_ESQUECEU_SENHA",TX_ESQUECEU_SENHA);
			$GLOBALS["base"]->template->set_var("TX_ACESSE_USANDO",TX_ACESSE_USANDO);
			$GLOBALS["base"]->template->set_var("TX_AINDA_NAO_POSSUO_CONTA",TX_AINDA_NAO_POSSUO_CONTA);
			$GLOBALS["base"]->template->set_var("TX_REDEFINIR_SENHA",TX_REDEFINIR_SENHA);
			$GLOBALS["base"]->template->set_var("TX_VOLTAR",TX_VOLTAR);
			$GLOBALS["base"]->template->set_var("TX_ESQUECEU_A_SENHA",TX_ESQUECEU_A_SENHA);
			$GLOBALS["base"]->template->set_var("TITULO_SISTEMA",TITULO_SISTEMA);
			$GLOBALS["base"]->template->set_var("TX_CRIAR_NOVA_CONTA",TX_CRIAR_NOVA_CONTA);
			$GLOBALS["base"]->template->set_var("TX_ENTRE_INFORMACOES",TX_ENTRE_INFORMACOES);
			$GLOBALS["base"]->template->set_var("BTN_SUBMIT",BTN_SUBMIT);
			$GLOBALS["base"]->template->set_var("ANALYTICS",ANALYTICS);
			$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
			$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
			$GLOBALS["base"]->template->set_var('msg_error' , '');
			$GLOBALS["base"]->write_design_specific('login.tpl' , 'login');


	}
		
	
	function logar()
	{	
		/**
		*	Método principal de login ao sistema
		*/

		$db = new db();
		$db2 = new db();
		
		@session_start();
		
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		
		$login = $this->blockrequest($login);
		$senha = $this->blockrequest($senha);	
			
		if($_POST['login'] && $_POST['senha'])
		{	
			$sql = "SELECT * FROM admin_usuarios
					WHERE ( email = '".$login."' AND senha = MD5('".$senha."')) AND (status = 1) limit 1";
         
									
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
					
			if($db->num_rows() > 0)
			{
					/* Guarda em sessão todos os parâmetros utéis do usuário */
					$_SESSION['adm_logged'] = "43628bbbb8613ac94fd61bd46aab5a45314s";
					$_SESSION['adm_id'] = $db->f("id");		
					$_SESSION['adm_nome'] = $db->f("nome");		
					$_SESSION['adm_email'] = $db->f("email");
					$_SESSION['adm_alert_daily'] = $db->f("alert_daily");		
					$_SESSION['adm_boss'] = $db->f("usuario_master");		
					$_SESSION['adm_idioma'] = $db->f("idioma");		
						
               if(ACTIVE_GRANTEES == 1)
                  $this->gera_permissoes($_SESSION['adm_id']); // Chama a função que define as áreas que o usuário tem acesso.
			

				$GLOBALS["base"]->template->set_var('msg_error' , '');
				

				if($db->f("avatar") == "")
					$avatar = 'http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=sem+imagem';
				else
					$avatar = $db->f("avatar");
					
					
					if(date("H") > 00 && date("H") < 12)
						$saudacao = "Bom dia";

					if(date("H") >= 12 && date("H") < 18)
						$saudacao = "Boa tarde";


					if(date("H") >= 18 && date("H") <= 23)
						$saudacao = "Boa noite";
               

				
                  $this->notificacao($saudacao.", ".$_SESSION['adm_nome']."! Seja Bem-vindo(a)!", "green");
						header("Location: ".ABS_LINK);

			}
		}
			
			$msg = "Dados de acesso incorretos!";


			$sql = "select * from estados";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			$listagem_estado = "<option value='7' selected>Rio de Janeiro</option>";
			
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$listagem_estado .= "<option value='".$db->f("id")."' ";
				
				if($db->f("id") == $estado)
					$listagem_estado .= "selected='selected'";
				
				$listagem_estado .= ">".$db->f("estado")."</option>";			
	
				$db->next_record();

			}

	   $sql = "SELECT * FROM cidades WHERE id_estados = 7";
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	
	   for($i = 0; $i < $db->num_rows(); $i++)
	   {
		   $listagem_cidade .= "<option value='".$db->f("id")."'>".$db->f("cidade")."</option>";
	
		   $db->next_record();
	
	   }

   		$GLOBALS["base"]->template->set_var('ABS_LINK' ,ABS_LINK);
			$GLOBALS["base"]->template->set_var("TX_ENTRAR",TX_ENTRAR);
			$GLOBALS["base"]->template->set_var("TX_LEMBRAR",TX_LEMBRAR);
			$GLOBALS["base"]->template->set_var("TX_LOGIN",TX_LOGIN);
			$GLOBALS["base"]->template->set_var("TX_ESQUECEU_SENHA",TX_ESQUECEU_SENHA);
			$GLOBALS["base"]->template->set_var("TX_ACESSE_USANDO",TX_ACESSE_USANDO);
			$GLOBALS["base"]->template->set_var("TX_AINDA_NAO_POSSUO_CONTA",TX_AINDA_NAO_POSSUO_CONTA);
			$GLOBALS["base"]->template->set_var("TX_REDEFINIR_SENHA",TX_REDEFINIR_SENHA);
			$GLOBALS["base"]->template->set_var("TX_VOLTAR",TX_VOLTAR);
			$GLOBALS["base"]->template->set_var("TX_ESQUECEU_A_SENHA",TX_ESQUECEU_A_SENHA);
			$GLOBALS["base"]->template->set_var("TITULO_SISTEMA",TITULO_SISTEMA);
			$GLOBALS["base"]->template->set_var("TX_CRIAR_NOVA_CONTA",TX_CRIAR_NOVA_CONTA);
			$GLOBALS["base"]->template->set_var("TX_ENTRE_INFORMACOES",TX_ENTRE_INFORMACOES);
			$GLOBALS["base"]->template->set_var("BTN_SUBMIT",BTN_SUBMIT);

			$GLOBALS["base"]->template->set_var("alertaDisplay",$alertaDisplay);
			$GLOBALS["base"]->template->set_var("ANALYTICS",ANALYTICS);
			$GLOBALS["base"]->template->set_var("TITULO_SISTEMA",TITULO_SISTEMA);
			$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
			$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);

			$GLOBALS["base"]->template->set_var('msg_error' , $msg);
			$GLOBALS["base"]->write_design_specific('login.tpl' , 'login');

	}
	
			
	function logout()
	{
		@session_start();	

		unset($_SESSION['adm_id']);
		unset($_SESSION['adm_nome']);
		unset($_SESSION['adm_email']);
		unset($_SESSION['adm_logged']);
		unset($_SESSION['adm_alert_daily']);
		unset($_SESSION['adm_boss']);
		unset($_SESSION['adm_idioma']);
		unset($_SESSION['adm_grantees']);

		session_destroy();

		header("Location: ".ABS_LINK."home");
		
	}

	function check_login()
	{
		@session_start();
      
		if($_SESSION['adm_id'] == 0 || !$_SESSION['adm_id'])
		{
		   header("Location: ".ABS_LINK."login/logout");
		}
		if($_SESSION['adm_logged'] != "43628bbbb8613ac94fd61bd46aab5a45314s" || !$_SESSION['adm_logged'])
		{
			header("Location: login");
		}
		
	}
	
		function blockrequest($param)
		{
			/*
				Retira todas as tags html da string;
				Retira qualquer isntrução SQL da string
			*/
			
			$str = strip_tags($param);

			$p1 = str_replace("INSERT"," ",$str);
			$p2 = str_replace("DELETE"," ",$p1);
			$p3 = str_replace("UPDATE"," ",$p2);
			$p4 = str_replace("TRUNCATE"," ",$p3);
			$p5 = str_replace("DUMP"," ",$p4);
			$p6 = str_replace("DROP"," ",$p5);

			$p7 = str_replace("<"," ",$p6);
			$p8 = str_replace(">"," ",$p7);
			$p9 = str_replace("'","/'",$p8);
			$p10 = str_replace("id","",$p9);
			$p11 = str_replace("id","",$p10);
			$p12 = str_replace(" or ","",$p11);
			$p13 = str_replace(" and ","",$p12);
			$p14 = str_replace("<>","",$p13);
			$p15 = str_replace("> 0","",$p14);
			$p15 = str_replace("--","",$p15);

			$str = $p15;
			
			return $str;
		}
		
	function gera_permissoes($func)
	{
		@session_start();
		
		$db = new db();
		
		// GUARDA A SESSÃO COM O ARRAY DE PERMISSÕES DAS ÁREAS DO ADMIN
		// GUARDA A SESSÃO COM O ARRAY DE PERMISSÕES DAS ÁREAS DO ADMIN
		// GUARDA A SESSÃO COM O ARRAY DE PERMISSÕES DAS ÁREAS DO ADMIN

		$sql_privilegios = "SELECT
							id_usuario
							,id_menu
							,allow
						FROM privilegios
						WHERE id_usuario = ".$func." 
						order by id_menu asc";

		$db->query($sql_privilegios,__LINE__,__FILE__);				
		$db->next_record();

		$_SESSION['adm_grantees'] = array();
		
		for($i = 0; $i < $db->num_rows(); $i++)
		{
				
				$_SESSION['adm_grantees']["area_".$db->f("id_menu")] = $db->f("allow");
				
				$db->next_record();
		}
			
								
	}

		function termos()
		{
			
			$GLOBALS["base"]->template->set_var("TX_VOLTAR",TX_VOLTAR);
			$GLOBALS["base"]->template->set_var("ANALYTICS",ANALYTICS);
			$GLOBALS["base"]->template->set_var('msg_error' , '');
			$GLOBALS["base"]->write_design_specific('login.tpl' , 'termos');			
		}
	
         function notificacao($mensagem,$cor)
         {
            $_SESSION['msg'] = array("mensagem"=>$mensagem,"tm"=>$cor,"mt"=>"air");
         }

      
 }

?>