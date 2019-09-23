<?php
require_once("modules/home.php");

class contas  extends home                                                                    
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
                  usuarios.id AS id
                  , usuarios.nome
                  , usuarios.email
                  , usuarios.origem
                  , usuarios.status AS situacao
                  , DATE_FORMAT(usuarios.data_cadastro,'%d/%m/%Y') AS data_cadastro
                  , planos.titulo AS plano
                  , cidades.cidade AS cidade
                  , estados.prefixo AS estado
                  FROM
                  usuarios,
                  cidades,
                  estados,
                  planos
                  WHERE usuarios.id_plano = planos.id
                  AND usuarios.estado = estados.id
                  AND usuarios.cidade = cidades.id
                  AND cidades.id_estados = estados.id
                  ORDER BY usuarios.nome ASC";
				
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id_usuario = $db->f("id");			
				$nome = $db->f("nome");			
				$email = $db->f("email");
				$cidade = $db->f("cidade");
				$estado = $db->f("estado");
				$origem = $db->f("origem");
				$situacao = $db->f("situacao");
				$plano = $db->f("plano");
				$data_cadastro = $db->f("data_cadastro");
            
            switch($situacao)
            {
               case "1":
                  $situacao = "Ativo";
               break;

               case "5":
                  $situacao = "Pendente de Ativar";
               break;

               case "0":
                  $situacao = "Banido";
               break;

               case "2":
                  $situacao = "Conta Desativada";
               break;
            
            }
				
				$listagem .= '<tr> 
										<td>'.$nome.'</td>
										<td>'.$email.'</td>
										<td>'.$origem.'</td>
										<td>'.$situacao.'</td>
										<td>'.$cidade.'</td> 
										<td>'.$estado.'</td> 
										<td>'.$plano.'</td> 
										<td>'.$data_cadastro.'</td> 
										<td><a href="contas/edita/'.$id_usuario.'" >Editar</a></td>
										<td><a href="contas/exclui/'.$id_usuario.'" onclick="return(confirm(\' !! ATENÇÃO !! \n\n Deseja excluir o usuario '.$nome.' ?  \n\n ESTA AÇÃO NÃO PODERÁ SER DESFEITA \'))">Excluir</a></td>										
									</tr>';
				
				
				
				
				$db->next_record();
			}


		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		$GLOBALS["base"]->template->set_var("listagem",$listagem);
		$GLOBALS["base"]->write_design_specific('contas.tpl' , 'main');                       
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                           

			
		}

      
		function novo()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();

           
         $sql = "SELECT id, titulo FROM planos ORDER BY titulo ASC";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $listagem_planos .= '<option value="'.$db->f("id").'" ';
            
            if($db->f("id") == $id_plano)
               $listagem_planos .= ' selected="selected" ';   
            
            $listagem_planos .= '>'.$db->f("titulo").'</option>';

            $db->next_record();
         }

         
         
         $listagem_situacoes = '<option value="1" ';
         
         if($situacao == "1")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Ativo</option>';
         

         $listagem_situacoes .= '<option value="5" ';
         
         if($situacao == "5")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Pendente de Ativar</option>';
         

         $listagem_situacoes .= '<option value="0" ';
         
         if($situacao == "0")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Banido</option>';


         $listagem_situacoes .= '<option value="2" ';
         
         if($situacao == "2")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Conta Desativada</option>';

         
         
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

	   $sql = "SELECT * FROM cidades WHERE id_estados = 7 ";
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
         

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
			$GLOBALS["base"]->template->set_var('listagem_situacoes',$listagem_situacoes);
			$GLOBALS["base"]->template->set_var('listagem_planos',$listagem_planos);
         $GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
         $GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
         $GLOBALS["base"]->write_design_specific('contas.tpl' , 'novo');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

			
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
			

			$sql = "SELECT usuarios.nome,
							usuarios.email,
							usuarios.senha,
							usuarios.telefone,
							usuarios.cidade,
							usuarios.estado,
							usuarios.pais,
							usuarios.id_plano,
							usuarios.origem,
                     usuarios.alert_daily as alert_daily
                     , usuarios.avatar as avatar
                     , usuarios.bio as bio
                     , usuarios.status AS situacao
					FROM usuarios
					WHERE id = ".$id." ";
                        
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			$nome = $db->f("nome");
			$email = $db->f("email");
			$senha = $db->f("senha");
			$telefone = $db->f("telefone");
			$id_cidade = $db->f("cidade");
			$id_estado = $db->f("estado");
			$alert_daily = $db->f("alert_daily");
			$avatar = $db->f("avatar");
			$bio = $db->f("bio");
			$id_plano = $db->f("id_plano");
			$situacao = $db->f("situacao");
			$pais = $db->f("pais");
			$origem = $db->f("origem");
	
			
	
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



			
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();       
			

			if(USE_AVATAR == 1)
			{
				$sql = "SELECT avatar
					FROM usuarios
					WHERE id = ".$id." ";
				$db->query($sql,__LINE__,__FILE__);
				$db->next_record();
				
				$avatar = $db->f("avatar");
				
				
				if(strlen($avatar)<10)
					$avatar = 'http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=sem+foto';
            else
               $avatar = LINK_ORIGINAL.'/'.$avatar;
					
				
				$GLOBALS["base"]->template->set_var("avatar",$avatar);
			}

		   if($alert_daily == 1)
			   $alert_daily_chk = " checked='checked' ";
			  else
			   $alert_daily_chk = "";
           
           
         $sql = "SELECT id, titulo FROM planos ORDER BY titulo ASC";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $listagem_planos .= '<option value="'.$db->f("id").'" ';
            
            if($db->f("id") == $id_plano)
               $listagem_planos .= ' selected="selected" ';   
            
            $listagem_planos .= '>'.$db->f("titulo").'</option>';

            $db->next_record();
         }

         
         
         $listagem_situacoes = '<option value="1" ';
         
         if($situacao == "1")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Ativo</option>';
         

         $listagem_situacoes .= '<option value="5" ';
         
         if($situacao == "5")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Pendente de Ativar</option>';
         

         $listagem_situacoes .= '<option value="0" ';
         
         if($situacao == "0")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Banido</option>';


         $listagem_situacoes .= '<option value="2" ';
         
         if($situacao == "2")
            $listagem_situacoes .= ' selected="selected" ';
            
         $listagem_situacoes .= '>Conta Desativada</option>';
         
         
         
         /* Comentários feitos pelo usuário */
         
         $sql = 'SELECT comentarios.id AS idComentario,
                        comentarios.conteudo AS conteudo,
                        DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                        usuarios.nome AS nome_usuario,
                        usuarios.avatar AS avatar,
                        usuarios.online AS online,
                        comentarios.likes AS likes,
                        comentarios.deslikes AS deslikes,
                        comentarios.usuario_id AS autor,
                        comentarios.status AS situacao,
                        comentarios.tipo AS tipo,
                        comentarios_contexto_referencia.contexto_id,
                        comentarios.tipo
                        FROM comentarios, usuarios, comentarios_contexto_referencia, artigos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND artigos.id = comentarios_contexto_referencia.contexto_id
                        AND comentarios.usuario_id = '.$id.'
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC';
         
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$idComentario = $db->f("idComentario");
				$conteudo = $db->f("conteudo");
				$data_comentario = $db->f("data_comentario");
				$nome_usuario = $db->f("nome_usuario");
				$avatar = $db->f("avatar");
				$likes = $db->f("likes");
				$deslikes = $db->f("deslikes");
				$situacao = $db->f("situacao");
				$tipo = $db->f("tipo");
            $contexto_id = $db->f("contexto_id");
            switch($tipo)
            {
               case "1":
                  $onde = "Artigo";
                  
                  $sql2 = "SELECT titulo FROM artigos WHERE id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo");
               break;

               case "2":
                  $onde = "Livro";
                  $sql2 = "SELECT livros.liv_nome AS titulo, versiculos.ver_capitulo FROM livros, versiculos WHERE livros.liv_id = versiculos.ver_liv_id AND versiculos.ver_id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo");
               break;

               case "3":
                  $onde = "Cap&iacute;tulo";
                  $sql2 = "SELECT livros.liv_nome AS titulo, versiculos.ver_capitulo FROM livros, versiculos WHERE livros.liv_id = versiculos.ver_liv_id AND versiculos.ver_id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo")." ".$db2->f("ver_capitulo");
               break;

               case "4":
                  $onde = "Curso";
                  $sql2 = "SELECT titulo FROM cursos WHERE id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo");
               break;
            
            }
            
            
            
				$listagem_comentarios .= '<tr> 
										<td><img src="'.LINK_ORIGINAL.'/'.$avatar.'" width="60"></td>
										<td>'.$tituloContexto.'</td>
										<td>'.$data_comentario.'</td>
										<td>'.$conteudo.'</td> 
										<td>'.$likes.'</td> 
										<td>'.$deslikes.'</td>';

                              switch($situacao)
                              {
                                 case "0":
                                    $listagem_comentarios .= '<td><a href="artigos/aprovaComentario/'.$idComentario.'/'.$artigo_id.'" onclick="return(confirm(\'Confirma aprovar o comentario?\'))">APROVAR</a></td>';
                                 break;

                                 case "1":
                                     $listagem_comentarios .= "<td>Aprovado</td>";
                                 break;
                              }
            
            																
									 $listagem_comentarios .= '<td><a href="artigos/excluiComentario/'.$idComentario.'/'.$artigo_id.'" onclick="return(confirm(\'Deseja excluir o comentario?\'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         $sql = "SELECT artigos.id AS id,
               artigos.imagem_destaque AS imagem_destaque,
               artigos.titulo AS titulo,
               artigos_categorias.titulo AS categoria,
               DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') AS dataCadastro,
               artigos.status AS situacao,
               usuarios.nome AS autor, 
               artigos.likes AS likes 
               FROM artigos, artigos_categorias, usuarios 
               WHERE artigos.categoria_id = artigos_categorias.id 
               AND artigos.usuario_id = usuarios.id 
               AND artigos.usuario_id = ".$id."
               ORDER BY artigos.id DESC ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$imagem_destaque = $db->f("imagem_destaque");
				$titulo = $db->f("titulo");
				$categoria = $db->f("categoria");
				$dataCadastro = $db->f("dataCadastro");
				$situacao = $db->f("situacao");
				$autor = $db->f("autor");
				$likes = $db->f("likes");
            
            switch($situacao)
            {
               case "0":
                  $situacao = "Pendente";
               break;

               case "1":
                  $situacao = "Publicado";
               break;
            }
            
            if($imagem_destaque =="")
               $imagem_destaque = "http://www.placehold.it/60x60/EFEFEF/AAAAAA&amp;text=NENHUMA";


            $sql2 = "SELECT COUNT(id) AS total FROM comentarios_contexto_referencia WHERE contexto_id = ".$id." ";
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();
            $comentarios = $db2->f("total");
            
				$listagem_artigos .= '<tr> 
										<td><img src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" width="60"></td>
										<td>'.$titulo.'</td>
										<td>'.$categoria.'</td>
										<td>'.$dataCadastro.'</td> 
										<td>'.$situacao.'</td> 
										<td>'.$likes.'</td> 
										<td>'.$comentarios.'</td> 
										<td><a href="artigos/edita/'.$id.'" >Editar</a></td>
										<td><a href="artigos/exclui/'.$id.'" onclick="return(confirm(\'Deseja excluir o artigo '.$titulo.' ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }
         
         
			$GLOBALS["base"]->template->set_var('listagem_artigos',$listagem_artigos);
			$GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
			$GLOBALS["base"]->template->set_var('origem',$origem);
			$GLOBALS["base"]->template->set_var('pais',$pais);
			$GLOBALS["base"]->template->set_var('listagem_situacoes',$listagem_situacoes);
			$GLOBALS["base"]->template->set_var('listagem_planos',$listagem_planos);
			$GLOBALS["base"]->template->set_var('bio',$bio);
			$GLOBALS["base"]->template->set_var("alert_daily_chk",$alert_daily_chk);
			$GLOBALS["base"]->template->set_var("nome",$nome);
			$GLOBALS["base"]->template->set_var("email",$email);
			$GLOBALS["base"]->template->set_var("senha",$senha);
			$GLOBALS["base"]->template->set_var("telefone",$telefone);
			$GLOBALS["base"]->template->set_var("listagem_cidade",$listagem_cidade);
			$GLOBALS["base"]->template->set_var("listagem_estado",$listagem_estado);
			$GLOBALS["base"]->template->set_var("id",$id);

			$GLOBALS["base"]->write_design_specific('contas.tpl' , 'edita');                       
			$GLOBALS["base"]->template = new template();                                                  
			$this->footer();                                                                               
         
      }
      
      function update()
      {
         
			@session_start();
			$db = new db();
			
			$email = $this->blockrequest($_REQUEST['email']);	
			$id = $this->blockrequest($_REQUEST['id']);	
	
         
			$sql = "SELECT email FROM usuarios WHERE email = '".$email."' AND id <> ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			if($db->num_rows() > 0)
			{
            $this->notificacao("E-mail existente! Escolha outro e-mail.", "yellow");
				header("Location: ".ABS_LINK."/contas/edita/".$id." ");
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
			$situacao = $this->blockrequest($_REQUEST['situacao']);
			$plano = $this->blockrequest($_REQUEST['plano']);
			$pais = $this->blockrequest($_REQUEST['pais']);
			
			
			if($_REQUEST['alert_daily'] && $_REQUEST['alert_daily'] == "1")
				$alert_daily = $this->blockrequest($_REQUEST['alert_daily']);
			else
				$alert_daily = 0;		
				
			$sql = "UPDATE usuarios
					SET nome = '".$nome."',
					email = '".$email."',";
					
			if($senha_old != $senha)
				$sql .=	"senha = MD5('".$senha."'),";
					
			$sql .=	"status = 1,
					estado = ".$estado.",
					cidade = ".$cidade.",
					pais = '".$pais."',
					telefone = '".$telefone."',
					bio = '".$bio."',
					alert_daily = ".$alert_daily.",
					id_plano = ".$plano.",
					status = ".$situacao."
					WHERE id = ".$id." ";
		
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();



				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/".$arquivo;
			
					// Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE usuarios SET avatar = 'files/".$arquivo."' WHERE id = ".$_SESSION['id']." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}
			
         $this->notificacao("Dados do usuario atualizados com sucesso", "green");
			header("Location: ".ABS_LINK."/contas");	
         
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
         $telefone = $this->blockrequest($_REQUEST['telefone']);
         
			$alert_daily = $this->blockrequest($_REQUEST['alert_daily']);
         if(isset($_REQUEST['alert_daily']))
            $alert_daily = 1;
         else
            $alert_daily = 0;
         
			$situacao = $this->blockrequest($_REQUEST['situacao']);
			$plano = $this->blockrequest($_REQUEST['plano']);
			$bio = $this->blockrequest($_REQUEST['bio']);


			$sql = "SELECT email FROM usuarios WHERE email = '".$email."' ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			if($db->num_rows() > 0)
			{
            $this->notificacao("E-mail existente! Escolha outro e-mail.", "yellow");
				header("Location: ".ABS_LINK."/contas/novo");
				die();	
			}



         $sql = "INSERT INTO usuarios (nome, email, senha, estado, data_cadastro, status, cidade, alert_daily, endereco, pais, idioma, bio, origem, telefone) 
                  VALUES ('".$nome."', '".$email."', MD5('".$senha."'), ".$estado.", NOW(), ".$situacao.", ".$cidade.",".$alert_daily.", '".$endereco."','".$pais."','pt_br', '".$bio."', 'admin', '".$telefone."')";

         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $id_usuario = $db->get_last_insert_id("usuarios","id");

	   
      $sql = "UPDATE usuarios SET usuario_master = ".$id_usuario." WHERE id = ".$id_usuario." LIMIT 1 "; 
	   $db->query($sql,__LINE__,__FILE__);
	   $db->next_record();
           
	   

		/* GERA A CHAVE DE VALIDAÃ‡ÃƒO */
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
      
      if($situacao == 5)
      {
         $link = ABS_LINK."/index.php?module=cadastro&method=valid&email=".$email."&key=".trim($key);

         $msg .= "<strong>Clique aqui para ativar seu cadastro: <a href='".$link."' target='_blank'>".ABS_LINK."/index.php?module=cadastro&method=valid&email=".$email."&key=".$key."</a></strong>";
         $msg .= "<br>";
   
         $subject = "Confirme seu cadastro - ".TITULO_SISTEMA." ";

      }
      else
         $subject = "Cadastro Confirmado - ".TITULO_SISTEMA." ";
         
      
      
	   $msg .= "<br>";
	   $msg .= "Atenciosamente,<br>Equipe ".TITULO_SISTEMA."";
	   $msg .= "<br>";
	   $msg .= "Copyright 2019 - ".date("Y")." ".TITULO_SISTEMA."";
	   $msg .= "<br>";
	   $msg .= "<br>";
	   $msg .= ABS_LINK;



      

      $sql = "INSERT INTO log (id_usuario, acao, data) VALUES ($id_usuario , '".$nome." efetuou o cadastro atraves do admin. ID: ".$id_usuario."', NOW())";			
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      
	
         $this->email($email, $subject, $msg);

         $this->notificacao("Conta de usuario cadastrada com sucesso. Um e-mail foi enviado para o endereço especificado.", "green");
         header("Location: ".ABS_LINK."contas");
         
      }

      function exclui()
      {
			@session_start();
         $db = new db();
			$db2 = new db();
         
         
         $id = $_REQUEST['id'];
         
         
         $sql2 = "SELECT id FROM comentarios WHERE usuario_id = ".$id." ";
			$db2->query($sql2,__LINE__,__FILE__);
			$db2->next_record();
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id_comentario = $db2->f("id");			

            $sql = "DELETE FROM comentarios_contexto_referencia  WHERE comentario_id = ".$id_comentario." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $db2->next_record();
   
         }
         
         $sql = "DELETE FROM comentarios  WHERE usuario_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM comentarios_marcados  WHERE usuario_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         $sql = "DELETE FROM cursos_usuarios  WHERE usuario_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         $sql = "DELETE FROM cursos_topicos_usuarios  WHERE usuario_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM artigos WHERE usuario_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $sql = "DELETE FROM cursos_usuarios_curtidas_bookmarks  WHERE usuario_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM usuarios  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Conta de usu&aacute;rio removida com sucesso.","green");
         header("Location: ".ABS_LINK."contas");
         
      }

      
 }


?>