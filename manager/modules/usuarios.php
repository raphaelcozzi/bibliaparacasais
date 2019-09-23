<?php

require_once("modules/home.php");

	class usuarios  extends home                                                                    
    {              

		function main()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
			$db1 = new db();
			$db2 = new db();
			$db3 = new db();
			$db4 = new db();

			$sql = "SELECT
					admin_usuarios.id as id
					, admin_usuarios.nome
					, admin_usuarios.email
					, admin_usuarios.telefone
					, cidades.cidade as cidade
					, estados.prefixo as estado
				FROM
					admin_usuarios,
					cidades,
					estados
				WHERE admin_usuarios.estado = estados.id
				AND admin_usuarios.cidade = cidades.id
				AND cidades.id_estados = estados.id
                                AND admin_usuarios.usuario_master = ".$_SESSION['adm_boss']."
					ORDER BY admin_usuarios.nome ASC";
				
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id_usuario = $db->f("id");			
				$nome = $db->f("nome");			
				$email = $db->f("email");
				$cidade = $db->f("cidade");
				$estado = $db->f("estado");
				$telefone = $db->f("telefone");
				
				
				$usuarios_listagem .= '<tr> 
										<td>'.$nome.'</td>
										<td>'.$email.'</td>
										<td>'.$cidade.'</td> 
										<td>'.$estado.'</td> 
										<td>'.$telefone.'</td> 
										<td><a href="usuarios/edita/'.$db->f("id").'" >Editar</a></td>
										<td><a href="usuarios/exclui/'.$db->f("id").'" onclick="return(confirm(\'Deseja excluir o usuario '.$db->f("nome").' ? \'))">Excluir</a></td>										
									</tr>';
				
				
				
				
				$db->next_record();
			}


		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		
		$GLOBALS["base"]->template->set_var("usuarios_listagem",$usuarios_listagem);
		$GLOBALS["base"]->template->set_var("btn_novo",$btn_novo);
													
		$GLOBALS["base"]->write_design_specific('usuarios.tpl' , 'main');                       
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                           

			
		}

		function busca()
		{
			@session_start();
			$db = new db();
			$db1 = new db();
			$db2 = new db();
			$db3 = new db();
			$db4 = new db();

                        if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();

			$q = $this->blockrequest($_REQUEST['q']);

			$sql = "SELECT
					admin_usuarios.id as id
					, admin_usuarios.nome
					, admin_usuarios.email
					, admin_usuarios.telefone
					, cidades.cidade as cidade
					, estados.prefixo as estado
				FROM
					admin_usuarios,
					cidades,
					estados
				WHERE admin_usuarios.estado = estados.id
				AND admin_usuarios.cidade = cidades.id
				AND cidades.id_estados = estados.id	

				AND (admin_usuarios.nome LIKE '%".$q."%' OR admin_usuarios.email LIKE '%".$q."%')
                                AND admin_usuarios.usuario_master = ".$_SESSION['adm_boss']."

					ORDER BY admin_usuarios.nome ASC";
					
				
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id_usuario = $db->f("id");			
				$nome = $db->f("nome");			
				$email = $db->f("email");
				$cidade = $db->f("cidade");
				$estado = $db->f("estado");
				$telefone = $db->f("telefone");
				
				
				$usuarios_listagem .= '<tr> 
										<td>'.$nome.'</td>
										<td>'.$email.'</td>
										<td>'.$cidade.'</td> 
										<td>'.$estado.'</td> 
										<td>'.$telefone.'</td> 
										<td><a href="index.php?module=usuarios&method=edita&id='.$db->f("id").'" >Editar</a></td>
										<td><a href="index.php?module=usuarios&method=exclui&id='.$db->f("id").'" onclick="return(confirm(\'Deseja excluir o usuario '.$db->f("nome").' ? \'))">Excluir</a></td>										
									</tr>';

					
				$db->next_record();
			}


		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		
		$GLOBALS["base"]->template->set_var("usuarios_listagem",$usuarios_listagem);
		$GLOBALS["base"]->template->set_var("btn_novo",$btn_novo);
													
		echo $GLOBALS["base"]->write_design_specific('usuarios.tpl' , 'main');                       
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                           

			
		}
		
	function usuarionovo()
	{
		@session_start();
		$db = new db();
		$db1 = new db();
		$db2 = new db();
		$db3 = new db();
		$db4 = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                
                
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

		// LISTAGEM DE PERMISSIONAMENTO
		// LISTAGEM DE PERMISSIONAMENTO
		// LISTAGEM DE PERMISSIONAMENTO
		// LISTAGEM DE PERMISSIONAMENTO
		
		if(ACTIVE_GRANTEES == 1)
		{
			
			$listagem_privilegios = '<div class="portlet">
		<div class="portlet-content nopadding">
          <table cellpadding="0" cellspacing="0" id="box-table-a" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th scope="col">Area</th>
                <th scope="col">Item</th>
                <th scope="col">Acesso</th>
              </tr>
            </thead>
            <tbody>'; 

			$sql = "SELECT * FROM admin_areas ORDER BY descricao ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
		
			for($l = 0; $l < $db->num_rows(); $l++)
			{
				
				$sql = "SELECT * FROM admin_menu_itens WHERE id_area = ".$db->f("id")." ";
				$db2->query($sql,__LINE__,__FILE__);
				$db2->next_record();
				
	
				for($a = 0; $a < $db2->num_rows(); $a++)
				{
					
					
					
					$listagem_privilegios .= '<tr>
										<td>'.$db->f("descricao").'</td>
										<td>'.$db2->f("descricao").'</td>
										<td width="120"><input type="checkbox" name="produtos[]" value="'.$db2->f("id").'"></td>
									  </tr>';
	
	
					
					$db2->next_record();
				}
				$db->next_record();
			}
			
				$listagem_privilegios .= '<tr class="footer">
											<td ></td>
											<td align="right">&nbsp;</td>
											<td align="right">
											</td>
										  </tr>
										</tbody>
									  </table>
									</div>
								  </div>';

		}
		else
			$listagem_privilegios = "";
			



		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		$GLOBALS["base"]->template->set_var('listagem_privilegios',$listagem_privilegios);
		$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
		$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
		$GLOBALS["base"]->template->set_var('BTN_SALVAR' , BTN_SALVAR);
		$GLOBALS["base"]->template->set_var('BTN_CANCELAR' , BTN_CANCELAR);  
		$GLOBALS["base"]->write_design_specific('usuarios.tpl' , 'usuarionovo');                                            
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                               
		
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

	function insere()
	{
		
	
		@session_start();
		$db = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                
		$db = new db();
		$db1 = new db();
		$db2 = new db();
		$db3 = new db();
		$db4 = new db();
	
		$nome = $this->blockrequest($_REQUEST['nome']);
		$email = $this->blockrequest($_REQUEST['email']);
		$estado = $this->blockrequest($_REQUEST['estado']);
		$cidade = $this->blockrequest($_REQUEST['cidade']);
		$senha = $this->blockrequest($_REQUEST['senha']);
		$telefone = $this->blockrequest($_REQUEST['telefone']);
		
		
		$sql = "SELECT * FROM admin_usuarios WHERE email = '".$email."' ";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		
		if($db->num_rows() > 0)
		{
         $this->notificacao("Email ja cadastrado, tente outro novamente.!", "blue");
         header("Location: ".ABS_LINK."/usuarios");   
         die(); 
       }
	   
		
	
		   $sql = "INSERT INTO admin_usuarios (nome, email, senha, estado, data_cadastro, status, cidade, telefone, usuario_master) 
					VALUES ('".$nome."', '".$email."', MD5('".$senha."'), ".$estado.", NOW(), 1, ".$cidade.", '".$telefone."', ".$_SESSION['adm_boss'].")";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			$id_usuario = $db->get_last_insert_id("usuarios","id");
			
			
			if(USE_AVATAR == 1)
			{


				if(isset($_FILES['avatar']['name']))
				{
	
					// Pega extensão do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome único para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficará
					$imagem_dir = "files/".$arquivo;

					$arquivo = $imagem_dir;
			
					// Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);

						$sql = "UPDATE admin_usuarios SET avatar = '".$arquivo."' WHERE id = ".$id_usuario." LIMIT 1 ";				
						$db->query($sql,__LINE__,__FILE__);
						$db->next_record();

					}
					


				}
				else
				{
					$arquivo = "";
				}
	
	
	
				
				
			}



			/* INSERE OS PRIVILÉGIOS DO USUÁRIO */
			
			if(ACTIVE_GRANTEES == 1)
			{
			
				$produtos = $_REQUEST['produtos'];
	
	
	
					$sql4 = "SELECT id FROM admin_menu_itens";
					$db4->query($sql4,__LINE__,__FILE__);
					$db4->next_record();
				
					for($i = 0; $i < $db4->num_rows(); $i++)
					{
						$allow = 0;	
					
					
						if(in_array($db4->f("id"),$produtos))
							$allow = 1;
						
						
							$sql = "INSERT INTO privilegios 
							(id_menu, id_usuario, allow)
							VALUES (".$db4->f("id").", ".$id_usuario.", ".$allow.")";	
							$db->query($sql,__LINE__,__FILE__);
							$db->next_record();
	
							$db4->next_record();
	
				}
			}
         $this->notificacao("Usuario cadastrado com sucesso!", "green");
			header("Location: ".ABS_LINK."/usuarios");   
		
	   }
	   
	   function edita()
	   {
			@session_start();
			$db = new db();
			$db1 = new db();
			$db2 = new db();
			$db3 = new db();
			$db4 = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                        
                        
			$id = $this->blockrequest($_REQUEST['id']);	
			
			if($_REQUEST['exception'] == "1")
			{
				if($_SESSION['adm_id'] != $id )	
					header("Location: index.php?module=home&method=main&msg=Tentativa de acesso negada. Tente acessar apenas os seus dados.&tm=red&mt=air");
			}

			$sql = "SELECT nome,
							email,
							senha,
							telefone,
							cidade,
							estado
					FROM admin_usuarios
					WHERE id = ".$id."
              AND admin_usuarios.usuario_master = ".$_SESSION['adm_boss']." ";
                        
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			$nome = $db->f("nome");
			$email = $db->f("email");
			$senha = $db->f("senha");
			$telefone = $db->f("telefone");
			$id_cidade = $db->f("cidade");
			$id_estado = $db->f("estado");
	
			
	
		    $sql = "select * from estados";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$listagem_estado .= "<option value='".$db->f("id")."' ";
				
				if($db->f("id") == $id_estado)
					$listagem_estado .= "selected='selected'";
				
				$listagem_estado .= ">".$db->f("estado")."</option>";			
	
				$db->next_record();

			}

	   $sql = "SELECT * FROM cidades WHERE id_estados = ".$id_estado." ";
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
	
	   for($i = 0; $i < $db->num_rows(); $i++)
	   {
		   $listagem_cidade .= "<option value='".$db->f("id")."' ";
		   
				if($db->f("id") == $id_cidade)
					$listagem_cidade .= "selected='selected' ";
		   
		  		$listagem_cidade .= " >".$db->f("cidade")."</option>";
	
		   $db->next_record();
	
	   }

		// LISTAGEM DE PERMISSIONAMENTO
		// LISTAGEM DE PERMISSIONAMENTO
		// LISTAGEM DE PERMISSIONAMENTO
		// LISTAGEM DE PERMISSIONAMENTO
		
		if(ACTIVE_GRANTEES == 1 && !$_REQUEST['exception'])
		{
			$listagem_privilegios = '<div class="portlet">
					<div class="portlet-content nopadding">
					  <table cellpadding="0" cellspacing="0" id="box-table-a" class="table table-striped table-bordered table-hover" width="100%">
						<thead>
						  <tr>
							<th scope="col">Area</th>
							<th scope="col">Item</th>
							<th scope="col">Accesso</th>
						  </tr>
						</thead>
						<tbody>'; 

			$sql = "SELECT * FROM admin_areas ORDER BY descricao ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
		
			for($l = 0; $l < $db->num_rows(); $l++)
			{
				
				$sql = "SELECT * FROM admin_menu_itens WHERE id_area = ".$db->f("id")." ";
				$db2->query($sql,__LINE__,__FILE__);
				$db2->next_record();
				
	
				for($a = 0; $a < $db2->num_rows(); $a++)
				{
	

					$listagem_privilegios .= '<tr>
										<td>'.$db->f("descricao").'</td>
										<td>'.$db2->f("descricao").'</td>
										<td width="120"><input type="checkbox" name="produtos[]" value="'.$db2->f("id").'" ';

														
						$sql4 = "SELECT * FROM privilegios WHERE id_usuario = ".$id." AND allow = 1 AND id_menu = ".$db2->f("id")." ";
						$db4->query($sql4,__LINE__,__FILE__);
						$db4->next_record();
						if($db4->num_rows() > 0)
							$listagem_privilegios .= ' checked="checked" ';
						
						$listagem_privilegios .= '></td> 
													</tr> ';
					
					$db2->next_record();
				}
				$db->next_record();
			}
			
					$listagem_privilegios .= '<tr class="footer">
											<td></td>
											<td align="right">&nbsp;</td>
											<td align="right">
											</td>
										  </tr>
										</tbody>
									  </table>
									</div>
								  </div>';		
		}
		else
			$listagem_privilegios = "";



			
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();       
			
			if($_REQUEST['exception'] == 1)
				$GLOBALS["base"]->template->set_var("excpt_value",1);
			else
				$GLOBALS["base"]->template->set_var("excpt_value",0);
				

			if(USE_AVATAR == 1)
			{
				$sql = "SELECT avatar
					FROM admin_usuarios
					WHERE id = ".$id." AND admin_usuarios.usuario_master = ".$_SESSION['adm_boss']." ";
				$db->query($sql,__LINE__,__FILE__);
				$db->next_record();
				
				$avatar = $db->f("avatar");
				
				
				if($avatar == "")
					$avatar = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=sem+foto';
					
				
				$GLOBALS["base"]->template->set_var("avatar",$avatar);
			}

			$GLOBALS["base"]->template->set_var('BTN_SALVAR' , BTN_SALVAR);
			$GLOBALS["base"]->template->set_var('BTN_CANCELAR' , BTN_CANCELAR);  
			$GLOBALS["base"]->template->set_var("listagem_privilegios",$listagem_privilegios);
			$GLOBALS["base"]->template->set_var("nome",$nome);
			$GLOBALS["base"]->template->set_var("email",$email);
			$GLOBALS["base"]->template->set_var("senha",$senha);
			$GLOBALS["base"]->template->set_var("telefone",$telefone);
			$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
			$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
			$GLOBALS["base"]->template->set_var("id",$id);

			$GLOBALS["base"]->write_design_specific('usuarios.tpl' , 'edita_usuario');                       
			$GLOBALS["base"]->template = new template();                                                  
			$this->footer();                                                                               
		   
	   }
	


		function update()
		{

			@session_start();
			$db = new db();
			$db4 = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                        
			$nome = $this->blockrequest($_REQUEST['nome']);	
			$email = $this->blockrequest($_REQUEST['email']);	
			$senha = $this->blockrequest($_REQUEST['senha']);	
			$nome = $this->blockrequest($_REQUEST['nome']);	
			$estado = $this->blockrequest($_REQUEST['estado']);	
			$cidade = $this->blockrequest($_REQUEST['cidade']);	
			$telefone = $this->blockrequest($_REQUEST['telefone']);	

			$id = $this->blockrequest($_REQUEST['id']);	

			$sql = "UPDATE admin_usuarios
					SET nome = '".$nome."',
					email = '".$email."', ";
			
			if($_REQUEST['senha_old'] != $senha)		
					$sql .= " senha = MD5('".$senha."'),";
					
			$sql .= "status = 1,
					estado = ".$estado.",
					cidade = ".$cidade.",
					telefone = '".$telefone."'
					WHERE id = ".$id." AND admin_usuarios.usuario_master = ".$_SESSION['adm_boss']." ";
		
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			if(USE_AVATAR == 1)
			{


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

						$sql = "UPDATE admin_usuarios SET avatar = 'files/".$arquivo."' WHERE id = ".$id." LIMIT 1 ";				
						$db->query($sql,__LINE__,__FILE__);
						$db->next_record();
					}


				
					
				}

				
			}



			/* INSERE OS PRIVILÉGIOS DO USUÁRIO */
			
			if(ACTIVE_GRANTEES == 1 && $_REQUEST['exception'] != 1)
			{
	
	
				$sql = "DELETE FROM privilegios WHERE id_usuario = ".$id." ";	
				$db->query($sql,__LINE__,__FILE__);
				$db->next_record();
	
	
				/* INSERE OS PRIVILÉGIOS DO USUÁRIO */
				
				$produtos = $_REQUEST['produtos'];
	
	
	
					$sql4 = "SELECT id FROM admin_menu_itens";
					$db4->query($sql4,__LINE__,__FILE__);
					$db4->next_record();
				
					for($i = 0; $i < $db4->num_rows(); $i++)
					{
						$allow = 0;	
					
					
						if(in_array($db4->f("id"),$produtos))
							$allow = 1;
						
						
							$sql = "INSERT INTO privilegios 
							(id_menu, id_usuario, allow)
							VALUES (".$db4->f("id").", ".$id.", ".$allow.")";	
							$db->query($sql,__LINE__,__FILE__);
							$db->next_record();
	
							$db4->next_record();
	
				}
			}



			
         $this->notificacao("Dados atualizados com sucesso!", "green");
			header("Location: ".ABS_LINK."/usuarios");	
		}
		
		function exclui()
		{
			@session_start();
			$db = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
             $this->valida_privilegios();
                        
          $id = $this->blockrequest($_REQUEST['id']);	
         
			$sql = "DELETE FROM admin_usuarios WHERE id = ".$id." AND usuario_master = ".$_SESSION['adm_boss']." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			
			if(ACTIVE_GRANTEES == 1)
			{
				$sql = "DELETE FROM privilegios WHERE id_usuario = ".$id." ";	
				$db->query($sql,__LINE__,__FILE__);
				$db->next_record();
			}
         

         $this->notificacao("Usuario Excluido com sucesso!", "green");
			header("Location: ".ABS_LINK."/usuarios");	
			
		}
		
}                                                                                                     





?>