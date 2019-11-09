<?php                                                                                                                            
require_once("modules/home.php");                                                                      


class cadastro extends home
{

	function main()
	{

		@session_start();
		$db = new db();

      
      if(isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK);
         die();
      }
      
      $_SESSION['pagina'] = "cadastro";
      $_SESSION['titulo_pagina'] = "Entrar ou Cadastrar-se";
      

      
      
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

         $google_login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';
      

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var("google_login_url",$google_login_url);
			$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
			$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
			$GLOBALS["base"]->write_design_specific('cadastro.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
         
         
	}
	
	function insere()
	{
		@session_start();
		
		$db = new db();

		$nome = $this->blockrequest($_REQUEST['nome']);
		$email = $this->blockrequest($_REQUEST['email']);
		$estado = $this->blockrequest($_REQUEST['estado']);
		$cidade = $this->blockrequest($_REQUEST['cidade']);
		$senha = $this->blockrequest($_REQUEST['senha']);
		$endereco = $this->blockrequest($_REQUEST['endereco']);
		$pais = $this->blockrequest($_REQUEST['pais']);
		
		
		$eventos_lote_atual = 1;
		$lancamentos_lote_atual = 1;
		
		$sql = "SELECT * FROM usuarios WHERE email = '".$email."' ";
                $db->query($sql,__LINE__,__FILE__);
                $db->next_record();
	    
		if($db->num_rows() > 0)
		{
			echo '<script language="javascript">alert("E-mail existente"); location="'.ABS_LINK.'/login";</script>';
			die();			
		}
	   
		

	   $sql = "INSERT INTO usuarios (nome, email, senha, estado, data_cadastro, status, cidade, alert_daily, endereco, pais, origem, ip_origem) 
	   			VALUES ('".$nome."', '".$email."', MD5('".$senha."'), 7, NOW(), 5, 6779, 1, '".$endereco."','".$pais."','web', '".$_SERVER['REMOTE_ADDR']."')";
      

	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	   $id_usuario = $db->get_last_insert_id("usuarios","id");
	   
      $sql = "UPDATE usuarios SET usuario_master = ".$id_usuario." WHERE id = ".$id_usuario." LIMIT 1 "; 
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
           
	   

		/* GERA A CHAVE DE VALIDAÇÃO */
		$key = substr(md5(md5(time()).rand(6,9)),0,30);
		
		
	   $sql = "INSERT INTO activation (thekey, used, id_usuario) VALUES ('".$key."', 0, ".$id_usuario.")";
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	   
	   
	   /* Envia um e-mail confirmando o cadastro */
	   
	   $msg = "Parab&eacute;ns, ".$nome.", agora voc&ecirc; j&aacute; pode utilizar o ".TITULO_SISTEMA."!<br>";
	   $msg .= "Guarde seus dados:<br><br>";
	   $msg .= "Login: ".$email;
	   $msg .= "<br>";
	   $msg .= "Senha: ".$senha;
	   $msg .= "<br>";
	   $msg .= "<br>";
	   $link = ABS_LINK."/index.php?module=cadastro&method=valid&email=".$email."&key=".trim($key);
	   
	   
	   $msg .= "<strong>Clique aqui para ativar seu cadastro: <a href='".$link."' target='_blank'>".ABS_LINK."/index.php?module=cadastro&method=valid&email=".$email."&key=".$key."</a></strong>";
	   $msg .= "<br>";
	   $msg .= "<br>";
	   $msg .= "Atenciosamente,<br>Equipe ".TITULO_SISTEMA."";
	   $msg .= "<br>";
	   $msg .= "Copyright 2019 - ".date("Y")." ".TITULO_SISTEMA."";
	   $msg .= "<br>";
	   $msg .= "<br>";
	   $msg .= ABS_LINK;


		$subject = "Confirme seu cadastro - ".TITULO_SISTEMA." ";

      

      $sql = "INSERT INTO log (id_usuario, acao, data) VALUES ($id_usuario , '".$nome." efetuou o cadastro. ID: ".$id_usuario."', NOW())";			
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      
	
		$this->email($email, $subject, $msg);
      
      
		unset($_SESSION['id']);
		unset($_SESSION['nome']);
		unset($_SESSION['email']);
		unset($_SESSION['logado']);
		unset($_SESSION['alert_daily']);
		unset($_SESSION['boss']);
		unset($_SESSION['idioma']);
      unset($_SESSION['FB_ID']);
      unset($_SESSION['FB_EMAIL']);
      unset($_SESSION['FB_NOME']);
      unset($_SESSION['FB_PAIS']);
      unset($_SESSION['FB_FOTO']);
      
	   
	   header("Location: ".ABS_LINK."/cadastro/confirm");
		
	}
	
	function ajax_cidade()
	{
		@session_start();
		
		$db = new db();
	
		$idestado = $_GET['estado'];
	
	
	   $sql = "SELECT * FROM cidades WHERE id_estados = ".$idestado;
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	
	   for($i = 0; $i < $db->num_rows(); $i++)
	   {
		   echo "<option value='".$db->f("id")."'>".$db->f("cidade")."</option>";
	
		   $db->next_record();
	
	   }
			
	}
	
	function confirm()
	{

      @session_start();

      $_SESSION['pagina'] = "cadastro";
      
      if(isset($_SESSION['id']))
      {
         header("Location: ".ABS_LINK);
         die();
      }

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

		    $GLOBALS["base"]->write_design_specific('cadastro.tpl' , 'confirm');
			$GLOBALS["base"]->template = new template();
			$this->footer();
		
	}
	
	function valid()
	{
		$db = new db();
		
      $_SESSION['pagina'] = "cadastro";
		
		$key = $this->blockrequest($_REQUEST['key']);
		$email = $this->blockrequest($_REQUEST['email']);
		
		$key = str_replace(" ","",$key);

	   $sql = "SELECT id as id_usuario FROM usuarios WHERE email = '".$email."' LIMIT 1 ";
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	   $id_usuario = $db->f("id_usuario");

	   if($db->num_rows() > 0)
	   {
		

		   $sql = "SELECT * FROM activation WHERE (thekey = '".$key."') AND id_usuario = ".$id_usuario." AND used = 0 LIMIT 1";
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();

		   if($db->num_rows() > 0)
		   {


			   $sql = "UPDATE usuarios SET status = 1 WHERE id = ".$id_usuario." LIMIT 1 ";
			   $db->query($sql,__LINE__,__FILE__);
			   $db->next_record();

			   $sql = "UPDATE activation SET used = 1, act_date = NOW() WHERE (thekey = '".$key."') AND id_usuario = ".$id_usuario." ";
			   $db->query($sql,__LINE__,__FILE__);
			   $db->next_record();
			   
				echo '<script language="javascript">alert("Seu cadastro foi ativado com sucesso!"); location="'.ABS_LINK.'login'.'";
				</script>';
				die();
		
		   }
	   }
	}
   
   function continuar()
	{
      @session_start();

      $_SESSION['pagina'] = "cadastro";
      
      if(!isset($_SESSION['id']))
      {
         header("Location: ".ABS_LINK);
         die();
      }

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

		    $GLOBALS["base"]->write_design_specific('cadastro.tpl' , 'continuar');
			$GLOBALS["base"]->template = new template();
			$this->footer();
      
		
	}
   
   
   function unconfirmed()
   {/*
    * Método que mostra uma mensagem para o usuário, caso ele ainda não 
    * tenha confirmado o seu cadastro através do e-mail.
    */
      
      @session_start();

      $_SESSION['pagina'] = "cadastro";
      
      if(isset($_SESSION['id']))
      {
         header("Location: ".ABS_LINK);
         die();
      }

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

		    $GLOBALS["base"]->write_design_specific('cadastro.tpl' , 'unconfirmed');
			$GLOBALS["base"]->template = new template();
			$this->footer();
   }

}

?>