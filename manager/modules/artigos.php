<?php
require_once("modules/home.php");

class artigos  extends home                                                                    
{              
		function main()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
			$db2 = new db();
         
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
            
				$listagem .= '<tr> 
										<td><img src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" width="60"></td>
										<td>'.$titulo.'</td>
										<td>'.$categoria.'</td>
										<td>'.$dataCadastro.'</td> 
										<td>'.$situacao.'</td> 
										<td>'.$autor.'</td> 
										<td>'.$likes.'</td> 
										<td>'.$comentarios.'</td> 
										<td><a href="artigos/edita/'.$id.'" >Editar</a></td>
										<td><a href="artigos/exclui/'.$id.'" onclick="return(confirm(\'Deseja excluir o artigo '.$titulo.' ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem",$listagem);
         $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'main');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

			
		}

      
		function novo()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();

		   $sql = "SELECT * FROM artigos_categorias WHERE status = 1 ORDER BY titulo ASC";
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();
	
		   for($i = 0; $i < $db->num_rows(); $i++)
		   {
			   $listagem_categorias .= "<option value='".$db->f("id")."'>".$db->f("titulo")."</option>";
	
			   $db->next_record();
	
		   }

         $listagem_situacoes .= '<option value="1" selected="selected">Publicado</option>';


         $listagem_situacoes .= '<option value="0">Pendente</option>';
                     

         
         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem_categorias",$listagem_categorias);
         $GLOBALS["base"]->template->set_var("listagem_situacoes",$listagem_situacoes);
         $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'novo');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

			
		}
      

		function categorias()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
         
         $sql = "SELECT id, titulo FROM artigos_categorias WHERE id <> 32 ORDER BY titulo ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$titulo = $db->f("titulo");
            
				$listagem .= '<tr> 
										<td>'.$titulo.'</td>
										<td><a href="artigos/editaCategoria/'.$id.'" >Editar</a></td>
										<td><a href="artigos/excluiCategoria/'.$id.'" onclick="return(confirm(\'Deseja excluir a categoria '.$titulo.' ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		$GLOBALS["base"]->template->set_var("listagem",$listagem);
		$GLOBALS["base"]->write_design_specific('artigos.tpl' , 'categorias');                       
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                           

			
		}
      
      function novoCategoria()
      {
			@session_start();

         if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var('avatar' , "http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=NENHUMA");  
         $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'novoCategoria');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
      }
      
      function insereCategoria()
      {
			@session_start();

         $db = new db();
         
         $titulo = $_REQUEST['titulo'];
         
         // Verifica se já não existe uma categorai com mesmo nome
         $sql = "SELECT titulo FROM artigos_categorias WHERE titulo = '".$titulo."' ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         if($db->num_rows() == 0)
         {  // Cria a nova categoria
            $sql = "INSERT INTO artigos_categorias(titulo) VALUES ('".$titulo."')";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            
            $id_categoria = $db->get_last_insert_id("artigos_categorias","id");
            
            
            
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
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


					$sql = "UPDATE artigos_categorias SET imagem = 'files/artigos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$id_categoria." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}            
            
            
            
            $this->notificacao("Categoria cadastrada com sucesso.","green");
            header("Location: ".ABS_LINK."artigos/categorias");
            
         }
         else
         {
            $this->notificacao("Categoria existente. Escolha outro nome.","red");
            header("Location: ".ABS_LINK."artigos/novoCategoria");
         }
      }
      
      function editaCategoria()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         
         $sql = "SELECT titulo, imagem FROM artigos_categorias WHERE id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         $titulo = $db->f("titulo");
         $imagem = $db->f("imagem");
         
         
         if($imagem != "" && strlen($imagem) > 10)
            $imagem = "https://www.bibliaparacasais.com.br/".$imagem;
         else
            $imagem = "http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=NENHUMA";

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("titulo",$titulo);
         $GLOBALS["base"]->template->set_var("avatar",$imagem);
         $GLOBALS["base"]->template->set_var("id",$id);
         $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'editaCategoria');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
         
      }
      
      function updateCategoria()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         $titulo = $_REQUEST['titulo'];
         
         $sql = "UPDATE artigos_categorias SET titulo = '".$titulo."' WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
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


					$sql = "UPDATE artigos_categorias SET imagem = 'files/artigos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}            
         

            $this->notificacao("Categoria atualizada com sucesso.","green");
            header("Location: ".ABS_LINK."artigos/categorias");

      }
      
      function excluiCategoria()
      {
	 @session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         
         $sql = "DELETE FROM artigos_categorias  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         // Atualiza os artigos para "Sem Categoria", nos artigos que possuiam a categoria que foi excluida
         $sql = "UPDATE artigos SET categoria_id = 32 WHERE categoria_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Categoria removida com sucesso.","green");
         header("Location: ".ABS_LINK."artigos/categorias");
         
      }
      
      function edita()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         
         $artigo_id = $this->blockrequest($_REQUEST['id']);
			
               $sql = "SELECT artigos.id AS artigo_id, 
                       artigos.titulo AS titulo, 
                       artigos.slug AS slug, 
                       artigos.video AS video, 
                       artigos.status AS status, 
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
                       AND artigos.id = '".$artigo_id."' ";
               
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                     $artigo_id = $db->f('artigo_id');
                     $titulo = $db->f('titulo');
                     $video = $db->f('video');
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
                     $status = $db->f('status');

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
                     
         $listagem_situacoes = '<option value="0" ';
         
         if($status == "0")
            $listagem_situacoes .= ' selected="selected" ';
         
         $listagem_situacoes .= '>Pendente</option>';
                     

         $listagem_situacoes .= '<option value="1" ';
         
         if($status == "1")
            $listagem_situacoes .= ' selected="selected" ';
         
         $listagem_situacoes .= '>Publicado</option>';
         
         
         
         /* Comentários feitos no artigo */
         
         $sql = 'SELECT comentarios.id AS idComentario,
                        comentarios.conteudo AS conteudo,
                        DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                        usuarios.nome AS nome_usuario,
                        usuarios.avatar AS avatar,
                        usuarios.online AS online,
                        comentarios.likes AS likes,
                        comentarios.deslikes AS deslikes,
                        comentarios.usuario_id AS autor,
                        comentarios.status AS situacao
                        FROM comentarios, usuarios, comentarios_contexto_referencia, artigos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND artigos.id = comentarios_contexto_referencia.contexto_id
                        AND artigos.id = '.$artigo_id.'
                        /* AND comentarios.tipo = 1 */
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
            
            
				$listagem_comentarios .= '<tr> 
										<td><img src="'.LINK_ORIGINAL.'/'.$avatar.'" width="60"></td>
										<td>'.$nome_usuario.'</td>
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

         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var('avatar' , $imagem_destaque);  
         $GLOBALS["base"]->template->set_var('artigo_id' , $artigo_id);  
         $GLOBALS["base"]->template->set_var('titulo' , $titulo);  
         $GLOBALS["base"]->template->set_var('video' , $video);  
         $GLOBALS["base"]->template->set_var('tags' , $tags);  
         $GLOBALS["base"]->template->set_var('listagem_comentarios' , $listagem_comentarios);  
         $GLOBALS["base"]->template->set_var('listagem_situacoes' , $listagem_situacoes);  
         $GLOBALS["base"]->template->set_var('nome_usuario' , $nome_usuario);  
         $GLOBALS["base"]->template->set_var('conteudo' , $conteudo);  
         $GLOBALS["base"]->template->set_var('autor' , $autor);  
         $GLOBALS["base"]->template->set_var('listagem_categorias' , $listagem_categorias);  
         $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'edita');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
         
      }
      
      function updateArtigo()
      {
			@session_start();
			$db = new db();

         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $categoria = $this->blockrequest($_REQUEST['categoria']);
         $tags = $this->blockrequest($_REQUEST['tags']);
         $conteudo = $_REQUEST['conteudo'];
         $slug = $this->slugify($titulo);
         $artigo_id = $_REQUEST['artigo_id'];
         $situacao = $_REQUEST['situacao'];
         $video = $_REQUEST['video'];

         
         $sql = "UPDATE artigos SET titulo = '".$titulo."',
                 slug = '".$slug."',
                 conteudo = '".addslashes($conteudo)."',
                 categoria_id = ".$categoria.",
                 tags = '".$tags."',
                 video = '".$video."',
                 status = ".$situacao." 
                 WHERE id = ".$artigo_id." LIMIT 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
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
				
				if($situacao == "1")
				{
						$sql = "SELECT titulo FROM artigos_categorias WHERE id = ".$categoria." ";
						$db->query($sql,__LINE__,__FILE__);
						$db->next_record();
						$categoria_nome = $db->f("titulo");
						/*
						 *  Envia os emails de notificação informando que um novo artigo foi publicado
						 */
						
						$sql = "SELECT id, nome, email FROM usuarios WHERE alert_daily = 1 ORDER BY id ASC ";
						$db->query($sql,__LINE__,__FILE__);
						$db->next_record();
						for($i = 0; $i < $db->num_rows(); $i++)
						{
						   $id = $db->f("id");
						   $nome = $db->f("nome");
						   $email_usuario = $db->f("email");
			
							 $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "Um novo artigo foi publicado no portal.<br><br><strong>".  $titulo."</strong><br><br><p>Publicado em ".date("d/m/Y")."</p> <p>Em: ".$categoria_nome."</p><p>Resumo:</p> ".substr($conteudo,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br/artigos/artigo/".$slug."\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");
						   
						   $this->email($email_usuario,"Novo artigo publicado - Biblia para casais",$corpo);               
						   
						   $db->next_record();
						}
						
					
				}

         
            $this->notificacao("Artigo atualizado com sucesso", "green");
            header("Location: ".ABS_LINK."artigos");
         
      }
      
      
      function excluiComentario()
      {
	  @session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         $artigo_id = $_REQUEST['subid'];
         
         $sql = "DELETE FROM comentarios  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM comentarios_contexto_referencia WHERE comentario_id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Comentario removido com sucesso.","green");
         header("Location: ".ABS_LINK."artigos/edita/".$artigo_id."");
         
      }

      function aprovaComentario()
      {
			@session_start();
         $db = new db();
         
         
         $id = $_REQUEST['id'];
         $artigo_id = $_REQUEST['subid'];
         
         $sql = "UPDATE comentarios SET status = 1 WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Comentario aprovado com sucesso.","green");
         header("Location: ".ABS_LINK."artigos/edita/".$artigo_id."");
         
      }
      
      function insereArtigo()
      {
         @session_start();
         $db = new db();
         $db2 = new db();


         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $categoria = $this->blockrequest($_REQUEST['categoria']);
         $tags = $this->blockrequest($_REQUEST['tags']);
         $conteudo = $_REQUEST['conteudo'];
         $slug = $this->slugify($titulo);
         $situacao = $_REQUEST['situacao'];
         $video = $_REQUEST['video'];
 
         
         $sql = "INSERT INTO artigos (titulo,
                slug,
                conteudo,
                dataCadastro,
                categoria_id,
                usuario_id,
                status,
                tags,
                video) 
                VALUES ('".$titulo."',
                '".$slug."',
               '".addslashes($conteudo)."',
               NOW(),
               ".$categoria.",
               ".$_SESSION['adm_id'].",
               ".$situacao.",
               '".$tags."',
                '".$video."')";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $artigo_id = $db->get_last_insert_id("artigos","id");

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
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
            
            
            $sql = "SELECT titulo FROM artigos_categorias WHERE id = ".$categoria." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $categoria_nome = $db->f("titulo");
            /*
             *  Envia os emails de notificação informando que um novo artigo foi publicado
             */
            
            $sql = "SELECT id, nome, email FROM usuarios WHERE alert_daily = 1 ORDER BY id ASC ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               $id = $db->f("id");
               $nome = $db->f("nome");
               $email_usuario = $db->f("email");

                 $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "Um novo artigo foi publicado no portal.<br><br><strong>".  $titulo."</strong><br><br><p>Publicado em ".date("d/m/Y")."</p> <p>Em: ".$categoria_nome."</p><p>Resumo:</p> ".substr($conteudo,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br/artigos/artigo/".$slug."\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");
               
               $this->email($email_usuario,"Novo artigo publicado - Biblia para casais",$corpo);               
               
               $db->next_record();
            }
            
            $this->sendPush("Um novo artigo foi publicado no portal", "Um novo artigo foi publicado:  ".$titulo,  "https://mobile.bibliaparacasais.com.br/artigos/artigo/".$slug);
            
            
   
            

         
            $this->notificacao("Parabens! Seu artigo foi publicado.", "green");
            header("Location: ".ABS_LINK."artigos");
         
      }

     
        function exclui()
      {
	 @session_start();
         $db = new db();
         $db2 = new db();
         
         
         $id = $_REQUEST['id'];
         
         $sql = "DELETE FROM artigos  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         
         $sql = "DELETE FROM artigos_usuarios_curtidas_bookmarks WHERE artigo_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $sql = "SELECT comentario_id FROM comentarios_contexto_referencia WHERE contexto_id = ".$id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
       {
            $sql2 = "DELETE FROM comentarios WHERE id = ".$db->f("comentario_id")." ";
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();

            $db->next_record();
        }
         

         $this->notificacao("Artigo removido com sucesso.","green");
         header("Location: ".ABS_LINK."artigos");
         
      }

      
 }


?>