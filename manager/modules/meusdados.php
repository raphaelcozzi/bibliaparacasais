<?php                                                                                       
require_once("modules/home.php");                                                                      

	class meusdados extends home                                                                             
    {              

		function main()
		{
			@session_start();
			$db = new db();

			$sql = "SELECT
					admin_usuarios.nome as nome_usuario
					, admin_usuarios.email as login
					, admin_usuarios.estado as estado
					, admin_usuarios.cidade as cidade
					, admin_usuarios.senha as senha
					, admin_usuarios.alert_daily as alert_daily
					, admin_usuarios.avatar as avatar
					, admin_usuarios.telefone as telefone
					, admin_usuarios.bio as bio
				FROM
					admin_usuarios
				WHERE admin_usuarios.id = ".$_SESSION['adm_id']." ";

			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
	
				$nome = $db->f("nome_usuario");
				$nome_usuario = $db->f("nome_usuario");
				$email = $db->f("login");
				$estado = $db->f("estado");
				$cidade = $db->f("cidade");
				$senha = $db->f("senha");
				$alert_daily = $db->f("alert_daily");
				$avatar = $db->f("avatar");
				$telefone = $db->f("telefone");
				$bio = $db->f("bio");
				
				if(strlen($avatar)<10)
					$avatar = 'http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=sem+foto';


		    $sql = "select * from estados";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			$listagem_estado = "<option value='00' selected>-</option>";
			
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$listagem_estado .= "<option value='".$db->f("id")."' ";
				
				if($db->f("id") == $estado)
					$listagem_estado .= "selected='selected'";
				
				$listagem_estado .= ">".$db->f("estado")."</option>";			
	
				$db->next_record();

			}
				

		   $sql = "SELECT * FROM cidades WHERE id_estados = ".$estado;
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();
	
		   for($i = 0; $i < $db->num_rows(); $i++)
		   {
			   $listagem_cidade .= "<option value='".$db->f("id")."' ";
			   
			   if($db->f("id") == $cidade)
			   	$listagem_cidade .= "selected='selected'";
				
			   $listagem_cidade .= ">".$db->f("cidade")."</option>";
	
			   $db->next_record();
	
		   }
		   
		   if($alert_daily == 1)
			   $alert_daily_chk = " checked='checked' ";
			  else
			   $alert_daily_chk = "";
			   
		
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			
			$GLOBALS["base"]->template->set_var("avatar",$avatar);
			$GLOBALS["base"]->template->set_var("alert_daily_chk",$alert_daily_chk);
			$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
			$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
			$GLOBALS["base"]->template->set_var('nome_usuario',$nome_usuario);
			$GLOBALS["base"]->template->set_var('estado',$estado);
			$GLOBALS["base"]->template->set_var('nome',$nome);
			$GLOBALS["base"]->template->set_var('login',$email);
			$GLOBALS["base"]->template->set_var('senha',$senha);
			$GLOBALS["base"]->template->set_var('telefone',$telefone);
			$GLOBALS["base"]->template->set_var('bio',$bio);
			$GLOBALS["base"]->template->set_var('id_usuario',$_SESSION['adm_id']);
			$GLOBALS["base"]->template->set_var('BTN_SALVAR' , BTN_SALVAR);
			$GLOBALS["base"]->template->set_var('BTN_CANCELAR' , BTN_CANCELAR);  

			$GLOBALS["base"]->write_design_specific('meusdados.tpl' , 'main');                       
			$GLOBALS["base"]->template = new template();                                                  
			$this->footer();                                                                               

			
		}
		
		function update_usuario()
		{
			@session_start();
			$db = new db();
			
			$email = $this->blockrequest($_REQUEST['email']);	
	
	
			$sql = "SELECT email FROM admin_usuarios WHERE email = '".$email."' AND id <> ".$_SESSION['adm_id']." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			
			if($db->num_rows() > 0)
			{
            $this->notificacao("e-mail existente!", "yellow");
				header("Location: ".ABS_LINK."/meusdados");
				die();	
			}

			$nome = $this->blockrequest($_REQUEST['nome']);	
			$email = $this->blockrequest($_REQUEST['email']);	
			$senha = $this->blockrequest($_REQUEST['senha']);	
			$senha_old = $this->blockrequest($_REQUEST['senha_old']);	
			$telefone = $this->blockrequest($_REQUEST['telefone']);	
			$estado = $this->blockrequest($_REQUEST['estado']);	
			$cidade = $this->blockrequest($_REQUEST['cidade']);	
			$bio = $this->blockrequest($_REQUEST['bio']);	
			$alert_daily = $this->blockrequest($_REQUEST['alert_daily']);
			
			
			if($_REQUEST['alert_daily'] && $_REQUEST['alert_daily'] == "1")
				$alert_daily = $this->blockrequest($_REQUEST['alert_daily']);
			else
				$alert_daily = 0;		
				
			$sql = "UPDATE admin_usuarios
					SET nome = '".$nome."',
					email = '".$email."',";
					
			if($senha_old != $senha)
				$sql .=	"senha = MD5('".$senha."'),";
					
			$sql .=	"status = 1,
					estado = '".$estado."',
					cidade = '".$cidade."',
					telefone = '".$telefone."',
					bio = '".$bio."',
					alert_daily = ".$alert_daily."
					WHERE id = ".$_SESSION['adm_id']." ";
		
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();



				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensão do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome único para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficará
					$imagem_dir = "files/".$arquivo;
			
					// Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE admin_usuarios SET avatar = 'files/".$arquivo."' WHERE id = ".$_SESSION['adm_id']." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}
			
         $this->notificacao("Dados atualizados com sucesso", "green");
			header("Location: ".ABS_LINK."/meusdados");	
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
		
		
	}                                                                                                     





?>