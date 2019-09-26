<?php                                                                                       
require_once("modules/home.php");                                                                      

	class perfil extends home                                                                             
    {              

		function main()
		{
         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }

         @session_start();
			$db = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Perfil";
         
			$sql = "SELECT
					usuarios.nome as nome_usuario
					, usuarios.email as login
					, usuarios.estado as estado
					, usuarios.cidade as cidade
					, usuarios.senha as senha
					, usuarios.alert_daily as alert_daily
					, usuarios.avatar as avatar
					, usuarios.telefone as telefone
					, usuarios.bio as bio
				FROM
					usuarios
				WHERE usuarios.id = ".$_SESSION['id']." ";

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
			
			$listagem_estado = "<option value='00' selected>SELECIONE</option>";
			
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
			   
           
           
         $box_meus_dados = $this->boxMeusDados();
		
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

         
			$GLOBALS["base"]->template->set_var("box_meus_dados",$box_meus_dados);
         
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
			$GLOBALS["base"]->template->set_var('id_usuario',$_SESSION['id']);

			$GLOBALS["base"]->write_design_specific('perfil.tpl' , 'main');                       
			$GLOBALS["base"]->template = new template();                                                  
			$this->footer();                                                                               

			
		}
		
		function updateusuario()
		{
			@session_start();
			$db = new db();
			
			$email = $this->blockrequest($_REQUEST['email']);	
	
         
			$sql = "SELECT email FROM usuarios WHERE email = '".$email."' AND id <> ".$_SESSION['id']." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			if($db->num_rows() > 0)
			{
            $this->notificacao("E-mail existente! Escolha outro e-mail.", "yellow");
				header("Location: ".ABS_LINK."/perfil");
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
				
			$sql = "UPDATE usuarios
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
					WHERE id = ".$_SESSION['id']." ";
		
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();



				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensão do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome único para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficará
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
			
         $this->notificacao("Dados atualizados com sucesso", "green");
			header("Location: ".ABS_LINK."/perfil");	
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
      
      function delArtigo()
      {
			@session_start();
			$db = new db();
			$db2 = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$artigo_id = $this->blockrequest($_REQUEST['id']);
         
         $sql = "SELECT COUNT(id) AS total FROM artigos
                 WHERE id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->f("total") >= 1)
         {
            $sql = "DELETE FROM artigos WHERE id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql2 = 'SELECT comentario_id FROM comentarios_contexto_referencia WHERE contexto_id = '.$artigo_id.' ';
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();
            for($i = 0; $i < $db2->num_rows(); $i++)
            {
               $comentario_id = $db2->f("comentario_id");
               
               $sql = "DELETE FROM comentarios WHERE comentario_id_referencia = ".$comentario_id." ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "DELETE FROM comentarios_usuarios_curtidas_bookmarks WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "DELETE FROM comentarios_marcados WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
               $db2->next_record();
            }


            $sql = 'DELETE FROM comentarios_contexto_referencia WHERE contexto_id = '.$artigo_id.' ';
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
         }
         
         
         $this->notificacao("Artigo Exclu&iacute;do.", "green");
         header("Location: ".ABS_LINK."perfil/artigos");         
         
      }
		

      function edtArtigo()
      {
         
			@session_start();
			$db = new db();
         $db2 = new db();
         $db4 = new db();

         $_SESSION['pagina'] = "artigo";
         $_SESSION['titulo_pagina'] = "Editar Artigo";
         
         $artigo_id = $this->blockrequest($_REQUEST['id']);
			
               $sql = "SELECT artigos.id AS artigo_id, 
                       artigos.titulo AS titulo, 
                       artigos.slug AS slug, 
                       artigos.conteudo AS conteudo, 
                       artigos.tags AS tags, 
                       artigos.imagem_destaque AS imagem_destaque, 
                       artigos.categoria_id AS categoria_id, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       usuarios.nome AS nome_usuario, 
                       artigos.usuario_id AS autor,
                       artigos.likes AS total_curtidas
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id 
                       AND artigos.id = '".$artigo_id."' 
                       AND artigos.usuario_id = ".$_SESSION['id']." ";
               
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
                  if($db->num_rows() == 0)
                  {
                     header("Location: ".ABS_LINK."home");         
                     die();
                  }

                     $artigo_id = $db->f('artigo_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $nome_usuario = $db->f('nome_usuario');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $autor = $db->f('autor');
                     $total_curtidas = $db->f('total_curtidas');
                     $tags = $db->f('tags');

                     $listagem_categorias = '';

                     $sql = "SELECT * FROM artigos_categorias WHERE status = 1 ORDER BY titulo ASC";
                     $db->query($sql,__LINE__,__FILE__);
                     $db->next_record();

                     for($i = 0; $i < $db->num_rows(); $i++)
                     {
                        $listagem_categorias .= "<option value='".$db->f("id")."' ";
                        
                        if($categoria_id == $db->f("id"))   
                           $listagem_categorias .= "selected='selected' ";
                        
                        $listagem_categorias .= " >".$db->f("titulo")."</option>";

                        $db->next_record();

                     }

                   $box_meus_dados = $this->boxMeusDados();
                  
                     $this->cabecalho();                                                                            
                     $GLOBALS["base"]->template = new template();

                     $GLOBALS["base"]->template->set_var('box_meus_dados' , $box_meus_dados);  
                     $GLOBALS["base"]->template->set_var('avatar' , $imagem_destaque);  
                     $GLOBALS["base"]->template->set_var('artigo_id' , $artigo_id);  
                     $GLOBALS["base"]->template->set_var('titulo' , $titulo);  
                     $GLOBALS["base"]->template->set_var('tags' , $tags);  
                     $GLOBALS["base"]->template->set_var('conteudo' , $conteudo);  
                     $GLOBALS["base"]->template->set_var('listagem_categorias' , $listagem_categorias);  

                     $GLOBALS["base"]->write_design_specific('perfil.tpl' , 'edtArtigo');                       
                     $GLOBALS["base"]->template = new template();                                                  
                     $this->footer();                                                                               
                     
      }
      
      function cursos()
      {
         @session_start();
         $db = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Cursos Inscrito";
         
         
         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }
         
         
            $listagem = '<div class="faq_wrapper"><div class="panel-group" id="accordion">';
            
            $sql = "SELECT cursos.titulo,
            cursos.slug as slug,
            cursos.id as curso_id,
            cursos.resumo,
            DATE_FORMAT(cursos_usuarios.dataCadastro, '%d/%m/%Y') AS dataCadastro
            FROM cursos, cursos_usuarios 
            WHERE cursos.id = cursos_usuarios.curso_id 
            AND cursos_usuarios.usuario_id = ".$_SESSION['id']." 
            ORDER BY cursos_usuarios.dataCadastro DESC";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               $titulo = $db->f("titulo");
               $resumo = $db->f("resumo");
               $dataCadastro = $db->f("dataCadastro");
               $slug = $db->f("slug");

               
               $listagem .= '<a href="'.ABS_LINK.'cursos/curso/'.$slug.'">
                                <i class="fa fa-graduation-cap color-black"></i>
                                <span>'.$titulo.'</span><i class="fa fa-angle-right"></i>
                            </a>';
               
               
               $db->next_record();
            }
            
            $listagem .= '</div></div>';


            $box_meus_dados = $this->boxMeusDados();

         
            $this->cabecalho();                                                                            
            $GLOBALS["base"]->template = new template();

            $GLOBALS["base"]->template->set_var("box_meus_dados",$box_meus_dados);
            $GLOBALS["base"]->template->set_var("listagem",$listagem);

            $GLOBALS["base"]->write_design_specific('perfil.tpl' , 'cursos');                       
            $GLOBALS["base"]->template = new template();                                                  
            $this->footer();                                                                               
         
      }
      
      function artigos()
      {
         @session_start();
         $db = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Meus Artigos";
         
         
         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }
         
         
            $listagem = '<div class="faq_wrapper"><div class="panel-group" id="accordion">';
            
            $sql = "SELECT
                     artigos.id AS artigo_id
                     , artigos.titulo AS titulo
                     , artigos.slug AS slug
                     , artigos_categorias.titulo AS categoria
                     , DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') AS dataCadastro
                     , usuarios.nome AS usuario_nome
                     , artigos.status AS status
                     FROM
                     artigos
                     INNER JOIN artigos_categorias 
                     ON (artigos.categoria_id = artigos_categorias.id)
                     INNER JOIN usuarios 
                     ON (artigos.usuario_id = usuarios.id) 
                     WHERE artigos.usuario_id = ".$_SESSION['id']." ";
            
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               $artigo_id = $db->f("artigo_id");
               $titulo = $db->f("titulo");
               $slug = $db->f("slug");
               $categoria = $db->f("categoria");
               $dataCadastro = $db->f("dataCadastro");
               $usuario_nome = $db->f("usuario_nome");
               $situacao = $db->f("status");
               
               switch ($situacao)
               {
                  case "0":
                     $situacao = "Aguardando Aprova&ccedil;&atilde;o";
                  break;

                  case "1":
                     $situacao = "Publicado";
                  break;

                  case "2":
                     $situacao = "Recusado";
                  break;
               
               }
               
               
               $listagem .= ' <a data-accordion="accordion-content-'.$i.'" href="#" class="accordion-toggle-first">
                              <i class="accordion-icon-left fa fa-pencil-alt color-red1-light"></i>
                              '.$titulo.'
                              <i class="accordion-icon-right fa fa-arrow-down"></i>
                          </a>
                          <div id="accordion-content-'.$i.'" class="accordion-content bottom-10">
                        <a href="'.ABS_LINK.'perfil/delArtigo/'.$artigo_id.'" onclick="return(confirm(\'Deseja excluir o artigo?\'))"  class="icon icon-xs icon-round bg-red2-dark"><i class="fa fa-trash"></i></a>
                        <a style="color:#fff;" href="'.ABS_LINK.'perfil/edtArtigo/'.$artigo_id.'" class="icon icon-xs icon-round bg-twitter"><i class="fa fa-edit"></i></a>
                        <a style="color:#fff;"href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="icon icon-xs icon-round bg-whatsapp regularbold"><i class="fa fa-play"></i></a>
                          </div>';

               
               $db->next_record();
            }
            
            $listagem .= '</div></div>';


            $sql = "SELECT COUNT(id) AS total, SUM(likes) AS curtidas FROM artigos WHERE usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $totalArtigos = $db->f("total");
            $totalCurtidas = $db->f("curtidas");

            $sql = "SELECT COUNT(id) AS total FROM artigos_usuarios_curtidas_bookmarks WHERE usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $totalArtigosMarcados = $db->f("total");

            $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $totalCursos = $db->f("total");

            $box_meus_dados = $this->boxMeusDados();
         
            $this->cabecalho();                                                                            
            $GLOBALS["base"]->template = new template();

            $GLOBALS["base"]->template->set_var("box_meus_dados",$box_meus_dados);
            $GLOBALS["base"]->template->set_var("listagem",$listagem);

            $GLOBALS["base"]->write_design_specific('perfil.tpl' , 'artigos');                       
            $GLOBALS["base"]->template = new template();                                                  
            $this->footer();                                                                               
         
      }

      function artigosMarcados()
      {
         @session_start();
         $db = new db();
         $db2 = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Artigos Salvos";
         
         
         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }
         
         
            $listagem = '<div class="faq_wrapper"><div class="panel-group" id="accordion">';
            
            $sql = "	SELECT
                     artigos.id AS artigo_id
                     , artigos.titulo AS titulo
                     , artigos.slug AS slug
                     , artigos_categorias.titulo AS categoria
                     , DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') AS dataCadastro
                     , artigos.status AS status
                     , artigos.usuario_id AS usuario_id
                     FROM
                     artigos, artigos_categorias, artigos_usuarios_curtidas_bookmarks
                     WHERE artigos.categoria_id = artigos_categorias.id 
                     AND artigos.id = artigos_usuarios_curtidas_bookmarks.artigo_id
                     AND artigos_usuarios_curtidas_bookmarks.bookmark = 1
                     AND artigos_usuarios_curtidas_bookmarks.usuario_id = ".$_SESSION['id']." ";
            
            
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               $artigo_id = $db->f("artigo_id");
               $titulo = $db->f("titulo");
               $slug = $db->f("slug");
               $categoria = $db->f("categoria");
               $dataCadastro = $db->f("dataCadastro");
               $situacao = $db->f("status");
               $usuario_id = $db->f("usuario_id");

               $sql2 = "SELECT nome FROM usuarios WHERE id =  ".$usuario_id." ";   
               $db2->query($sql2,__LINE__,__FILE__);
               $db2->next_record();
               $usuario_nome = $db2->f("nome");
               
               switch ($situacao)
               {
                  case "0":
                     $situacao = "Aguardando Aprova&ccedil;&atilde;o";
                  break;

                  case "1":
                     $situacao = "Publicado";
                  break;

                  case "2":
                     $situacao = "Recusado";
                  break;
               
               }
               
               
               $listagem .= ' <a data-accordion="accordion-content-'.$i.'" href="#" class="accordion-toggle-first">
                              <i class="accordion-icon-left fa fa-pencil-alt color-red1-light"></i>
                             '.$titulo.'  
                              <i class="accordion-icon-right fa fa-arrow-down"></i>
                          </a>
                          <div id="accordion-content-'.$i.'" class="accordion-content bottom-10"><br>Publicado em '.$dataCadastro.' <br> por: '.$usuario_nome.' <br> em '.$categoria.'<br><br>
                        <a href="'.ABS_LINK.'home/bookmarkArtigo/'.$artigo_id.'" onclick="return(confirm(\'Deseja remover o artigo dos seus artigos salvos?\'));" class="icon icon-xs icon-round bg-red2-dark"><i class="fa fa-trash"></i></a>
                        <a style="color:#fff;" href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="icon icon-xs icon-round bg-whatsapp regularbold"><i class="fa fa-play"></i></a>
                          </div>';

               
               $db->next_record();
            }
            
            $listagem .= '</div></div>';


            $box_meus_dados = $this->boxMeusDados();

         
            $this->cabecalho();                                                                            
            $GLOBALS["base"]->template = new template();

            $GLOBALS["base"]->template->set_var("box_meus_dados",$box_meus_dados);
            $GLOBALS["base"]->template->set_var("listagem",$listagem);

            $GLOBALS["base"]->write_design_specific('perfil.tpl' , 'artigosMarcados');                       
            $GLOBALS["base"]->template = new template();                                                  
            $this->footer();                                                                               
         
      }

      function novoArtigo()
      {
         @session_start();
         $db = new db();
         $db2 = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Novo Artigo";
         
         
         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }
         
         

         
         

            $sql = "SELECT COUNT(id) AS total, SUM(likes) AS curtidas FROM artigos WHERE usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $totalArtigos = $db->f("total");
            $totalCurtidas = $db->f("curtidas");

            $sql = "SELECT COUNT(id) AS total FROM artigos_usuarios_curtidas_bookmarks WHERE usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $totalArtigosMarcados = $db->f("total");

            $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $totalCursos = $db->f("total");


            $listagem_categorias = '';

		   $sql = "SELECT * FROM artigos_categorias WHERE status = 1 ORDER BY titulo ASC";
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();
	
		   for($i = 0; $i < $db->num_rows(); $i++)
		   {
			   $listagem_categorias .= "<option value='".$db->f("id")."'>".$db->f("titulo")."</option>";
	
			   $db->next_record();
	
		   }
         
         $avatar = 'http://www.placehold.it/600x400/EFEFEF/AAAAAA&amp;text=sem+imagem+em+destaque';
 
         
            $box_meus_dados = $this->boxMeusDados();
         
            $this->cabecalho();                                                                            
            $GLOBALS["base"]->template = new template();
            $GLOBALS["base"]->template->set_var("box_meus_dados",$box_meus_dados);
            $GLOBALS["base"]->template->set_var("listagem_categorias",$listagem_categorias);
            $GLOBALS["base"]->template->set_var("listagem",$listagem);
            $GLOBALS["base"]->template->set_var("avatar",$avatar);

            $GLOBALS["base"]->write_design_specific('perfil.tpl' , 'novoArtigo');                       
            $GLOBALS["base"]->template = new template();                                                  
            $this->footer();                                                                               
         
      }
      
      function insertArtigo()
      {
         @session_start();
         $db = new db();
         $db2 = new db();

         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }
         

         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $categoria = $this->blockrequest($_REQUEST['categoria']);
         $tags = $this->blockrequest($_REQUEST['tags']);
         $conteudo = $_REQUEST['conteudo'];
         $slug = $this->slugify($titulo);
         

         
         $sql = "INSERT INTO artigos (titulo,
                slug,
                conteudo,
                dataCadastro,
                categoria_id,
                usuario_id,
                status,
                tags) 
                VALUES ('".$titulo."',
                '".$slug."',
               '".addslashes($conteudo)."',
               NOW(),
               ".$categoria.",
               ".$_SESSION['id'].",
               0,
               '".$tags."')";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $artigo_id = $db->get_last_insert_id("artigos","id");

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensão do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome único para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficará
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE artigos SET imagem_destaque = 'files/artigos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$artigo_id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}

            
            $sql = "SELECT nome FROM usuarios WHERE id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $autor = $db->f("nome");
            
             $corpo = $this->mailTemaple("Novo artigo aguardando aprova&ccedil;&atilde;o","Acesse o gerenciador para aprovar.","<strong>T&iacute;tulo:</strong> ".$titulo."<br><strong>Autor:</strong> ".$autor."<br><br><strong>Resumo:</strong> ".substr($conteudo,0,450)."(...)");

            $this->email("daniel.sales@dunadesign.com.br","Novo artigo para aprovar - Biblia para casais",$corpo);
			
			/*
            $sql = "SELECT titulo FROM artigos_categorias WHERE id = ".$categoria." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $categoria_nome = $db->f("titulo");
            /*
             *  Envia os emails de notificação informando que um novo artigo foi publicado
             */
            /*
            $sql = "SELECT id, nome, email FROM usuarios WHERE alert_daily = 1 ORDER BY id ASC ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               $id = $db->f("id");
               $nome = $db->f("nome");
               $email_usuario = $db->f("email");

                 $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "Um novo artigo foi publicado no portal.<br><br><strong>".  utf8_encode($titulo)."</strong><br><br><p>Publicado em ".date("d/m/Y")."</p> <p>Em: ".utf8_encode($categoria_nome)."</p><p>Resumo:</p> ".substr($conteudo,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br/artigos/artigo/".$slug."\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");
               
               $this->email($email_usuario,"Novo artigo publicado - Biblia para casais",$corpo);               
               
               $db->next_record();
            }
            
			*/
			
            
         
            $this->notificacao("Parabéns! Seu artigo foi enviado. Assim que for aprovado, será publicado.", "green");
            header("Location: ".ABS_LINK."perfil/novoArtigo");
         
      }
      
      function updateArtigo()
      {
			@session_start();
			$db = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Editar Artigo";
         
         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $categoria = $this->blockrequest($_REQUEST['categoria']);
         $tags = $this->blockrequest($_REQUEST['tags']);
         $conteudo = $_REQUEST['conteudo'];
         $slug = $this->slugify($titulo);
         $artigo_id = $_REQUEST['artigo_id'];

         // Verifica a propriedade do artido sendo editado
         $sql = "SELECT artigos.id AS artigo_id
                 FROM artigos WHERE usuario_id = ".$_SESSION['id']." ";

            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            if($db->num_rows() == 0)
            {
               header("Location: ".ABS_LINK."home");         
               die();
            }


         
         $sql = "UPDATE artigos SET titulo = '".$titulo."',
                 slug = '".$slug."',
                 conteudo = '".addslashes($conteudo)."',
                 categoria_id = ".$categoria.",
                 tags = '".$tags."',
                 status = 0 
                 WHERE id = ".$artigo_id." LIMIT 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensão do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome único para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficará
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/artigos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE artigos SET imagem_destaque = 'files/artigos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$artigo_id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}

         
            $this->notificacao("Parabéns! Seu artigo foi editado e enviado. Assim que for aprovado, será publicado.", "green");
            header("Location: ".ABS_LINK."perfil/novoArtigo");
         
         
      }

      function cursosMarcados()
      {
         @session_start();
         $db = new db();
         $db2 = new db();

         $_SESSION['pagina'] = "perfil";
         $_SESSION['titulo_pagina'] = "Cursos Salvos";
         
         
         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }
         
         
            $listagem = '<div class="faq_wrapper"><div class="panel-group" id="accordion">';
            
            $sql = "	SELECT
                     cursos.id AS curso_id
                     , cursos.titulo AS titulo
                     , cursos.slug AS slug
                     , cursos_categorias.titulo AS categoria
                     , DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') AS dataCadastro
                     , cursos.status AS status
                     FROM
                     cursos, cursos_categorias, cursos_usuarios_curtidas_bookmarks
                     WHERE cursos.categoria_id = cursos_categorias.id 
                     AND cursos.id = cursos_usuarios_curtidas_bookmarks.curso_id
                     AND cursos_usuarios_curtidas_bookmarks.bookmark = 1
                     AND cursos_usuarios_curtidas_bookmarks.usuario_id = ".$_SESSION['id']." ";
            
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               $curso_id = $db->f("curso_id");
               $titulo = $db->f("titulo");
               $slug = $db->f("slug");
               $categoria = $db->f("categoria");
               $dataCadastro = $db->f("dataCadastro");
               $situacao = $db->f("status");
               
               
               
               $listagem .= '<a data-accordion="accordion-content-'.$i.'" href="#" class="accordion-toggle-first">
                              <i class="accordion-icon-left fa fa-graduation-cap color-red1-light"></i>
                              '.$titulo.'
                              <i class="accordion-icon-right fa fa-arrow-down"></i>
                          </a>
                          <div id="accordion-content-'.$i.'" class="accordion-content bottom-10"><br>Publicado em '.$dataCadastro.' | em '.$categoria.'<br><br> 
                        <a href="'.ABS_LINK.'home/bookmarkCurso/'.$curso_id.'" onclick="return(confirm(\'Deseja remover o curso dos seus cursos salvos?\'))" class="icon icon-xs icon-round bg-red2-dark"><i class="fa fa-trash"></i></a>
                        <a style="color:#fff;" href="'.ABS_LINK.'cursos/curso/'.$slug.'" class="icon icon-xs icon-round bg-whatsapp regularbold"><i class="fa fa-play"></i></a>
                             
                          </div> ';

               $db->next_record();
            }
            
            $listagem .= '</div></div>';


            $box_meus_dados = $this->boxMeusDados();

         
            $this->cabecalho();                                                                            
            $GLOBALS["base"]->template = new template();

            $GLOBALS["base"]->template->set_var("box_meus_dados",$box_meus_dados);
            $GLOBALS["base"]->template->set_var("listagem",$listagem);

            $GLOBALS["base"]->write_design_specific('perfil.tpl' , 'cursosMarcados');                       
            $GLOBALS["base"]->template = new template();                                                  
            $this->footer();                                                                               
         
      }
      
      

	}                                                                                                     





?>