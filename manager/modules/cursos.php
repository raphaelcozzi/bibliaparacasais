<?php
require_once("modules/home.php");

class cursos  extends home                                                                    
{              
		function main()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
			$db2 = new db();
         
         $sql = "SELECT cursos.id AS id,
               cursos.imagem_destaque AS imagem_destaque,
               cursos.titulo AS titulo,
               cursos_categorias.titulo AS categoria,
               cursos.duracao AS duracao,
               DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') AS dataCadastro,
               cursos.status AS situacao,
               cursos.likes AS likes 
               FROM cursos, cursos_categorias 
               WHERE cursos.categoria_id = cursos_categorias.id 
               ORDER BY cursos.id DESC ";
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
				$likes = $db->f("likes");
				$duracao = $db->f("duracao");
            
            switch($situacao)
            {
               case "0":
                  $situacao = "Arquivado";
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


            $sql2 = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE curso_id = ".$id." ";
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();
            $inscritos = $db2->f("total");
            
            $sql2 = "SELECT COUNT(id) AS total FROM cursos_topicos WHERE curso_id = ".$id." ";
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();
            $topicos = $db2->f("total");
                    
				$listagem .= '<tr> 
										<td><img src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" width="60"></td>
										<td>'.$titulo.'</td>
										<td>'.$categoria.'</td>
										<td>'.$topicos.'</td> 
										<td>'.$inscritos.'</td> 
										<td>'.$situacao.'</td> 
										<td>'.$likes.'</td> 
										<td>'.$comentarios.'</td> 
										<td>'.$duracao.'</td> 
										<td>'.$dataCadastro.'</td> 
										<td><a href="cursos/edita/'.$id.'" >Editar</a></td>
										<td><a href="cursos/exclui/'.$id.'" onclick="return(confirm(\'Deseja excluir o curso '.$titulo.' ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem",$listagem);
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'main');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

			
		}

      

		function categorias()
		{
			@session_start();
                        
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
         
         $sql = "SELECT id, titulo FROM cursos_categorias WHERE id <> 31 ORDER BY titulo ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$titulo = $db->f("titulo");
            
				$listagem .= '<tr> 
										<td>'.$titulo.'</td>
										<td><a href="cursos/editaCategoria/'.$id.'" >Editar</a></td>
										<td><a href="cursos/excluiCategoria/'.$id.'" onclick="return(confirm(\'Deseja excluir a categoria '.$titulo.' ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem",$listagem);
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'categorias');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

		}
      
      function editaCategoria()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         
         $sql = "SELECT titulo, imagem FROM cursos_categorias WHERE id = ".$id." ";
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
         $GLOBALS["base"]->template->set_var("avatar",$imagem);
         $GLOBALS["base"]->template->set_var("titulo",$titulo);
         $GLOBALS["base"]->template->set_var("id",$id);
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'editaCategoria');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
      }
      
      function updateCategoria()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         $titulo = $_REQUEST['titulo'];
         
         $sql = "UPDATE cursos_categorias SET titulo = '".$titulo."' WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE cursos_categorias SET imagem = 'files/cursos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}
         

            $this->notificacao("Categoria atualizada com sucesso.","green");
            header("Location: ".ABS_LINK."cursos/categorias");
      }
      
      function excluiCategoria()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         
         $sql = "DELETE FROM cursos_categorias  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         // Atualiza os cursos para "Sem Categoria", nos cursos que possuiam a categoria que foi excluida
         $sql = "UPDATE cursos SET categoria_id = 31 WHERE categoria_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Categoria removida com sucesso.","green");
         header("Location: ".ABS_LINK."cursos/categorias");
         
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
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'novoCategoria');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
      }

      function insereCategoria()
      {
			@session_start();

         $db = new db();
         
         $titulo = $_REQUEST['titulo'];
         
         // Verifica se já não existe uma categorai com mesmo nome
         $sql = "SELECT titulo FROM cursos_categorias WHERE titulo = '".$titulo."' ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         if($db->num_rows() == 0)
         {  // Cria a nova categoria
            $sql = "INSERT INTO cursos_categorias(titulo) VALUES ('".$titulo."')";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $id_categoria = $db->get_last_insert_id("cursos_categorias","id");
            
            
            
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE cursos_categorias SET imagem = 'files/cursos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$id_categoria." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}            
            
            
            $this->notificacao("Categoria cadastrada com sucesso.","green");
            header("Location: ".ABS_LINK."cursos/categorias");
            
         }
         else
         {
            $this->notificacao("Categoria existente. Escolha outro nome.","red");
            header("Location: ".ABS_LINK."cursos/novoCategoria");
         }
      }

      function edita()
      {
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['id'];
         
         $curso_id = $this->blockrequest($_REQUEST['id']);
			
               $sql = "SELECT cursos.id AS curso_id, 
                       cursos.titulo AS titulo, 
                       cursos.slug AS slug, 
                       cursos.status AS status, 
                       cursos.duracao AS duracao, 
                       cursos.resumo AS conteudo, 
                       cursos.tags AS tags, 
                       cursos.imagem_destaque AS imagem_destaque, 
                       cursos.categoria_id AS categoria_id, 
                       DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       cursos_categorias.titulo AS categoria, 
                       cursos.likes AS total_curtidas
                       FROM cursos, cursos_categorias
                       WHERE cursos.categoria_id = cursos_categorias.id 
                       AND cursos.id = ".$curso_id." ";
               
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                     $curso_id = $db->f('curso_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $total_curtidas = $db->f('total_curtidas');
                     $tags = $db->f('tags');
                     $status = $db->f('status');
                     $duracao = $db->f('duracao');

                     $listagem_categorias = '';

                     $sql = "SELECT * FROM cursos_categorias ORDER BY titulo ASC";
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
         
         $listagem_situacoes .= '>Arquivado</option>';
                     

         $listagem_situacoes .= '<option value="1" ';
         
         if($status == "1")
            $listagem_situacoes .= ' selected="selected" ';
         
         $listagem_situacoes .= '>Publicado</option>';
         
         
         
         /* Comentários feitos no curso */
         
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
                        FROM comentarios, usuarios, comentarios_contexto_referencia, cursos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND cursos.id = comentarios_contexto_referencia.contexto_id
                        AND cursos.id = '.$curso_id.'
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
                                    $listagem_comentarios .= '<td><a href="cursos/aprovaComentario/'.$idComentario.'/'.$artigo_id.'" onclick="return(confirm(\'Confirma aprovar o comentario?\'))">APROVAR</a></td>';
                                 break;

                                 case "1":
                                     $listagem_comentarios .= "<td>Aprovado</td>";
                                 break;
                              }
            
            																
									 $listagem_comentarios .= '<td><a href="cursos/excluiComentario/'.$idComentario.'/'.$artigo_id.'" onclick="return(confirm(\'Deseja excluir o comentario?\'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         /* Tópicos do curso */
         
         $sql = "SELECT id AS topico_id, titulo, dia_id AS dia FROM cursos_topicos WHERE curso_id = ".$curso_id."
                 ORDER BY dia_id ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$topico_id = $db->f("topico_id");
				$dia = $db->f("dia");
				$titulo_topico = $db->f("titulo");
            
            
				$listagem_topicos .= '<tr> 
										<td>'.$titulo_topico.'</td>
										<td>'.$dia.'</td>
            						<td><a href="cursos/editaTopico/'.$curso_id.'/'.$topico_id.'" >Editar</a></td>
										<td><a href="cursos/excluiTopico/'.$curso_id.'/'.$topico_id.'" onclick="return(confirm(\'Deseja excluir o topico '.$titulo_topico.' ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }
         
         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var('duracao' , $duracao);  
         $GLOBALS["base"]->template->set_var('avatar' , $imagem_destaque);  
         $GLOBALS["base"]->template->set_var('curso_id' , $curso_id);  
         $GLOBALS["base"]->template->set_var('titulo' , $titulo);  
         $GLOBALS["base"]->template->set_var('tags' , $tags);  
         $GLOBALS["base"]->template->set_var('listagem_topicos' , $listagem_topicos);  
         $GLOBALS["base"]->template->set_var('listagem_comentarios' , $listagem_comentarios);  
         $GLOBALS["base"]->template->set_var('listagem_situacoes' , $listagem_situacoes);  
         $GLOBALS["base"]->template->set_var('conteudo' , $conteudo);  
         $GLOBALS["base"]->template->set_var('listagem_categorias' , $listagem_categorias);  
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'edita');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
         
      }
      
      function updateCurso()
      {
         
			@session_start();
			$db = new db();

         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $categoria = $this->blockrequest($_REQUEST['categoria']);
         $tags = $this->blockrequest($_REQUEST['tags']);
         $conteudo = $_REQUEST['conteudo'];
         $slug = $this->slugify($titulo);
         $curso_id = $_REQUEST['curso_id'];
         $situacao = $_REQUEST['situacao'];
         $duracao = $_REQUEST['duracao'];

         
         $sql = "UPDATE cursos SET titulo = '".$titulo."',
                 slug = '".$slug."',
                 resumo = '".addslashes($conteudo)."',
                 categoria_id = ".$categoria.",
                 tags = '".$tags."',
                 status = ".$situacao.", 
                 duracao = ".$duracao." 
                 WHERE id = ".$curso_id." LIMIT 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE cursos SET imagem_destaque = 'files/cursos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$curso_id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}
            
            
            $sql = "DELETE FROM cursos_dias WHERE curso_id = ".$curso_id." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            for($i = 1; $i <= $duracao; $i++)
            {
               $sql = "INSERT INTO cursos_dias (curso_id, dia_numero) VALUES (".$curso_id.",".$i.") ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
            }

         
            $this->notificacao("Curso atualizado com sucesso", "green");
            header("Location: ".ABS_LINK."cursos");
      }
  
		function novo()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();

		   $sql = "SELECT * FROM cursos_categorias ORDER BY titulo ASC";
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();
	
		   for($i = 0; $i < $db->num_rows(); $i++)
		   {
			   $listagem_categorias .= "<option value='".$db->f("id")."'>".$db->f("titulo")."</option>";
	
			   $db->next_record();
	
		   }

         $listagem_situacoes .= '<option value="1" selected="selected">Publicado</option>';


         $listagem_situacoes .= '<option value="0">Arquivado</option>';
                     

         
         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem_categorias",$listagem_categorias);
         $GLOBALS["base"]->template->set_var("listagem_situacoes",$listagem_situacoes);
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'novo');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

		}
      
      function insereCurso()
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
         $curso_id = $_REQUEST['curso_id'];
         $situacao = $_REQUEST['situacao'];
         $duracao = $_REQUEST['duracao'];

         
         $sql = "INSERT INTO cursos (titulo,
                slug,
                resumo,
                dataCadastro,
                categoria_id,
                status,
                tags,
                duracao) 
                VALUES ('".$titulo."',
                '".$slug."',
               '".addslashes($conteudo)."',
               NOW(),
               ".$categoria.",
               ".$situacao.",
               '".$tags."',
               ".$duracao.")";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $curso_id = $db->get_last_insert_id("cursos","id");

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE cursos SET imagem_destaque = 'files/cursos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$curso_id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}

            for($i = 1; $i <= $duracao; $i++)
            {
               $sql = "INSERT INTO cursos_dias (curso_id, dia_numero) VALUES (".$curso_id.",".$i.") ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
            }
            
            $sql = "SELECT titulo FROM cursos_categorias WHERE id = ".$categoria." ";
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

                 $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "Um novo curso foi publicado no portal.<br><br><strong>".  $titulo."</strong><br><br><p>Publicado em ".date("d/m/Y")."</p> <p>Em: ".$categoria_nome." </p><p>Resumo:</p>".substr($conteudo,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br/cursos/curso/".$slug."\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");
               
               $this->email($email_usuario,"Novo curso publicado - Biblia para casais",$corpo);               
               
               $db->next_record();
            }
            
            $this->sendPush("Um novo curso foi publicado no portal", "Um novo curso foi publicado:  ".$titulo,  "https://mobile/bibliaparacasais.com.br/cursos/curso/".$slug);
         
            $this->notificacao("Parabens! Seu curso foi publicado. Inclua os t&oacute;picos par ao seu curso.", "green");
            header("Location: ".ABS_LINK."cursos/edita/".$curso_id);
         
         
      }
      
      function exclui()
      {
			@session_start();
         $db = new db();
         
         
         $id = $_REQUEST['id'];
         
         $sql = "DELETE FROM cursos  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM cursos_dias WHERE curso_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         $sql = "DELETE FROM cursos_topicos WHERE curso_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         $sql = "DELETE FROM cursos_topicos_usuarios WHERE curso_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM cursos_usuarios WHERE curso_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         $sql = "DELETE FROM cursos_usuarios_curtidas_bookmarks WHERE curso_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM cursos_videos WHERE curso_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         

         $this->notificacao("Curso removido com sucesso.","green");
         header("Location: ".ABS_LINK."cursos");
         
      }
      
       function excluiComentario()
      {
			@session_start();
         $db = new db();
         
         
         $id = $_REQUEST['id'];
         $curso_id = $_REQUEST['subid'];
         
         $sql = "DELETE FROM comentarios  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $sql = "DELETE FROM comentarios_contexto_referencia WHERE comentario_id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Comentario removido com sucesso.","green");
         header("Location: ".ABS_LINK."cursos/edita/".$curso_id."");
         
      }

      function aprovaComentario()
      {
			@session_start();
         $db = new db();
         
         
         $id = $_REQUEST['id'];
         $curso_id = $_REQUEST['subid'];
         
         $sql = "UPDATE comentarios SET status = 1 WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         
         $this->notificacao("Comentario aprovado com sucesso.","green");
         header("Location: ".ABS_LINK."cursos/edita/".$curso_id."");
         
      }

      function editaTopico()
      {
         
			@session_start();
         $db = new db();
         
         $id = $_REQUEST['subid'];
         $curso_id = $this->blockrequest($_REQUEST['id']);
			
         $sql = "SELECT titulo, conteudo, dia_id, imagem_destaque, video FROM cursos_topicos WHERE id = ".$id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $titulo = $db->f("titulo");
         $imagem_destaque = $db->f("imagem_destaque");
         $conteudo = $db->f("conteudo");
         $dia_id = $db->f("dia_id");
         $video = $db->f("video");
         
            if($imagem_destaque =="")
               $imagem_destaque = "http://www.placehold.it/60x60/EFEFEF/AAAAAA&amp;text=NENHUMA";
         

         $sql = "SELECT dia_numero FROM cursos_dias WHERE id = ".$dia_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $dia = $db->f("dia_numero");

         $sql = "SELECT duracao FROM cursos WHERE id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $duracao_curso = $db->f("duracao");

         
         $sql = "SELECT id, dia_numero FROM cursos_dias WHERE curso_id = ".$curso_id." ORDER BY dia_numero ASC ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
		   {
            $listagem_dias .= '<option value="'.$db->f("id").'" ';
            if($db->f("id") == $dia_id)
               $listagem_dias .= ' selected="selected" ';
            
            $listagem_dias .= '>'.$db->f("dia_numero").'</option>';
            
            $db->next_record();
         }
         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var('video' , $video);  
         $GLOBALS["base"]->template->set_var('avatar' , $imagem_destaque);  
         $GLOBALS["base"]->template->set_var('curso_id' , $curso_id);  
         $GLOBALS["base"]->template->set_var('topico_id' , $id); 
         $GLOBALS["base"]->template->set_var('titulo' , $titulo);  
         $GLOBALS["base"]->template->set_var('listagem_dias' , $listagem_dias);  
         $GLOBALS["base"]->template->set_var('conteudo' , $conteudo);  
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'editaTopico');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
      }
      
      function updateTopico()
      {
         
			@session_start();
			$db = new db();

         $id = $_REQUEST['topico_id'];
         $curso_id = $this->blockrequest($_REQUEST['curso_id']);
         
         
         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $dia = $this->blockrequest($_REQUEST['dia']);
         $conteudo = $_REQUEST['conteudo'];
         $video = $_REQUEST['video'];
         $slug = $this->slugify($titulo);

         
         $sql = "UPDATE cursos_topicos SET titulo = '".$titulo."',
                 slug = '".$slug."',
                 video = '".$video."',
                 conteudo = '".addslashes($conteudo)."'
                 WHERE id = ".$id." LIMIT 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE cursos_topicos SET imagem_destaque = 'files/cursos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}
            
            
         
            $this->notificacao("Topico atualizado com sucesso", "green");
            header("Location: ".ABS_LINK."cursos/edita/".$curso_id);
         
      }
      
      function novoTopico()
      {
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
         
         $curso_id = $_REQUEST['id'];

         $sql = "SELECT duracao FROM cursos WHERE id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $duracao_curso = $db->f("duracao");

         
         $sql = "SELECT id, dia_numero FROM cursos_dias WHERE curso_id = ".$curso_id." ORDER BY dia_numero ASC ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
		   {
            $listagem_dias .= '<option value="'.$db->f("id").'" ';
            if($db->f("id") == $dia_id)
               $listagem_dias .= ' selected="selected" ';
            
            $listagem_dias .= '>'.$db->f("dia_numero").'</option>';
            
            $db->next_record();
         }
                     
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("curso_id",$curso_id);
         $GLOBALS["base"]->template->set_var("listagem_dias",$listagem_dias);
         $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'novoTopico');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           
         
      }
      
      function insereTopico()
      {
         @session_start();
         $db = new db();
         $db2 = new db();


         $id = $_REQUEST['topico_id'];
         $curso_id = $this->blockrequest($_REQUEST['curso_id']);
         
         
         $avatar = $_FILES['avatar'];
         $titulo = $this->blockrequest($_REQUEST['titulo']);
         $dia = $this->blockrequest($_REQUEST['dia']);
         $conteudo = $_REQUEST['conteudo'];
         $slug = $this->slugify($titulo);
         $video = $_REQUEST['video'];
         
         $sql = "INSERT INTO cursos_topicos (titulo,slug,conteudo, curso_id, dia_id, video) 
                 VALUES ('".$titulo."','".$slug."','".addslashes($conteudo)."',".$curso_id.",".$dia.",'".$video."')";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         $topico_id = $db->get_last_insert_id("cursos_topicos","id");
         
				if($_FILES['avatar']['name'] != "")
				{
	
					// Pega extensÃ£o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf|doc|xls|docx|xlsx|zip|rar){1}$/i", $_FILES["avatar"]["name"], $ext);
			
					// Gera um nome Ãºnico para a imagem
					$arquivo = md5(uniqid(time())) . "." . $ext[1];
			
					// Caminho de onde a imagem ficarÃ¡
					$imagem_dir = CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m")."/".$arquivo;

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y"), 0777, true);
               }
               

               if (!file_exists(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"))) {
                   mkdir(CAMINHO_ABSOLUTO_RAIZ."/files/cursos/".date("Y")."/".date("m"), 0777, true);
               }
			

               // Faz o upload da imagem
					
					if($ext[1] != "")
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagem_dir);
					}


					$sql = "UPDATE cursos_topicos SET imagem_destaque = 'files/cursos/".date("Y")."/".date("m")."/".$arquivo."' WHERE id = ".$topico_id." LIMIT 1 ";				
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					
				}
            
            
         
            $this->notificacao("Parabens! Seu topico foi publicado no curso.", "green");
            header("Location: ".ABS_LINK."cursos/edita/".$curso_id);
         
         
      }
      
      function excluiTopico()
      {
			@session_start();
         $db = new db();
         
         
         $curso_id = $_REQUEST['id'];
         $id = $_REQUEST['subid'];
         
         
         $sql = "DELETE FROM cursos_topicos WHERE id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
         $sql = "DELETE FROM cursos_topicos_usuarios WHERE topico_id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $this->notificacao("Topico removido com sucesso.","green");
         header("Location: ".ABS_LINK."cursos/edita/".$curso_id);
         
      }
    
 }


?>