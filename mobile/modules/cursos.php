<?php
require_once("modules/home.php");  

class cursos extends home
{
	public function main()
	{
      @session_start();
      $db = new db();
      $db2 = new db();
      $db3 = new db();

      if(!isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK."home");
         die();
      }
         
         $_SESSION['pagina'] = "cursos";
         $_SESSION['titulo_pagina'] = "Cursos";
         
         
         $sql = "SELECT id, titulo FROM cursos_categorias WHERE id IN (SELECT DISTINCT(categoria_id) FROM cursos) ORDER BY titulo ASC";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $categoria_id = $db->f("id");
            $categoria_titulo = $db->f("titulo");
            
            
            $listagem_sugestoes_cursos .= '<h1>'.$categoria_titulo.'</h1>
                                 <div class="double-slider owl-carousel owl-no-dots top-15 bottom-50">';
			
            
                        $sql2 = "SELECT id, titulo, imagem_destaque, slug FROM cursos
                                WHERE categoria_id = ".$categoria_id." AND status = 1 
                                ORDER BY id DESC";
                        $db2->query($sql2,__LINE__,__FILE__);
                        $db2->next_record();
                        for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
                        {
                           $curso_id = $db2->f("id");
                           $curso_titulo = $db2->f("titulo");
                           $curso_imagem_destaque = $db2->f("imagem_destaque");
                           $curso_slug = $db2->f("slug");
                           
                           
                           $listagem_sugestoes_cursos .= '<div>
                    <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><div class="caption round-medium shadow-large" style="height:210px;">
                        <div class="caption-bottom">
                            <h4 class="color-white center-text uppercase ultrabold bottom-40"></h4>
                        </div>
                        <div class="caption-overlay bg-gradient"></div>
                        <img class="caption-image owl-lazy" data-src="'.LINK_ORIGINAL.'/'.$curso_imagem_destaque.'" style="width:auto !important; height:100% !important; overflow: auto !important;">
                    </div><center style="margin-top:-20px;"><strong>'.strtoupper($curso_titulo).'</strong></center>
                    <!--<div class="under-slider-button">
                        <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'" class="button button-center-medium button-xs button-round-large bg-highlight shadow-large bottom-10">'.$curso_titulo.'</a>
                    </div>-->
                </a></div>';
                           
                           

                           $db2->next_record();
                          
                        }

                                 
                           $listagem_sugestoes_cursos .= '</div>';
   
            $db->next_record();
            
         }

         
         
         // NOVOS CURSOS
         
         $listagem_cursos_recentes .= '<h1>Novos Cursos</h1>
                                 <div class="double-slider owl-carousel owl-no-dots top-15">';

         $sql2 = "SELECT id, titulo, imagem_destaque, slug FROM cursos
                 WHERE status = 1
                 ORDER BY id DESC LIMIT 0,20";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
         {
            $curso_id = $db2->f("id");
            $curso_titulo = $db2->f("titulo");
            $curso_imagem_destaque = $db2->f("imagem_destaque");
            $curso_slug = $db2->f("slug");
            
            $listagem_cursos_recentes .= '<div>
                    <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><div class="caption round-medium shadow-large" style="height:210px;">
                        <div class="caption-bottom">
                            <h4 class="color-white center-text uppercase ultrabold bottom-40"></h4>
                        </div>
                        <div class="caption-overlay bg-gradient"></div>
                        <img class="caption-image owl-lazy" data-src="'.LINK_ORIGINAL.'/'.$curso_imagem_destaque.'" style="width:auto !important; height:100% !important; overflow: auto !important;">
                    </div><center style="margin-top:-20px;"><strong>'.strtoupper($curso_titulo).'</strong></center>
                    <!--<div class="under-slider-button">
                        <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'" class="button button-center-medium button-xs button-round-large bg-highlight shadow-large bottom-10">'.$curso_titulo.'</a>
                    </div>-->
                </a></div>';
            

            $db2->next_record();

         }
         
         $listagem_cursos_recentes .= '</div>';
         

         // MEUS CURSOS
            
            $sql = "SELECT cursos.titulo,
            cursos.slug as slug,
            cursos.id as curso_id
            FROM cursos, cursos_usuarios 
            WHERE cursos.id = cursos_usuarios.curso_id 
            AND cursos_usuarios.usuario_id = ".$_SESSION['id']." 
            ORDER BY cursos_usuarios.dataCadastro DESC";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               
               $curso_titulo = $db->f("titulo");
               $curso_slug = $db->f("slug");
      
               $listagem_meus_cursos .= '<li><a onClick="javascript:location=\''.ABS_LINK.'cursos/curso/'.$curso_slug.'\';" href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'">'.$curso_titulo.'<i class="fa fa-angle-right"></i></a></li>';
               
              $db->next_record();
            }
         
         
         
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

			$GLOBALS["base"]->template->set_var('emCategoria',"");
			$GLOBALS["base"]->template->set_var('listagem_meus_cursos',$listagem_meus_cursos);
			$GLOBALS["base"]->template->set_var('listagem_cursos_recentes',$listagem_cursos_recentes);
			$GLOBALS["base"]->template->set_var('listagem_sugestoes_cursos',$listagem_sugestoes_cursos);
		   $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
   function curso()
   {
      @session_start();
      $db = new db();
      $db2 = new db();
      $db4 = new db();
      
      if(!isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK."home");
         die();
      }

         $_SESSION['pagina'] = "cursos";
         
         $slug = $this->blockrequest($_REQUEST['id']);
         
               $sql = "SELECT cursos.id AS cursos_id, 
                       cursos.titulo AS titulo, 
                       cursos.slug AS slug, 
                       cursos.conteudo AS conteudo, 
                       cursos.resumo AS resumo, 
                       cursos.imagem_destaque AS imagem_destaque, 
                       cursos.categoria_id AS categoria_id, 
                       DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       cursos_categorias.titulo AS categoria, 
                       cursos.tags AS tags,
                       cursos.likes AS curtidas,
                       cursos.duracao AS duracao 
                       FROM cursos, cursos_categorias
                       WHERE cursos.categoria_id = cursos_categorias.id 
                       AND cursos.slug = '".$slug."' ";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                     $curso_id = $db->f('cursos_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $imagem_destaque_src = LINK_ORIGINAL."/".$db->f('imagem_destaque');
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $resumo = $db->f('resumo');
                     $tagsArray = explode(",", $db->f("tags"));
                     $duracao = $db->f('duracao');
                     $curtidas = $db->f('curtidas');
                     

                     if($db->f("tags") != "")
                     {
                        for($ta = 0; $ta < count($tagsArray); $ta++)
                        {
                           $tags .='<a href="'.ABS_LINK.'cursos/'.$categoria_id.'">#'.$tagsArray[$ta].'</a>';
                        }
                     }
                   else
                   {
                     $tags .='';
                   }
                     
                     
         if($imagem_destaque != "")
         {
            $imagem_destaque = '<img src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" alt="" class="img-responsive" width="100%">';
         }
                     
                     
         $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$curso_id." ";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         $total_comentarios = $db2->f('total_comentarios');
         
         
      $box_comentar_post = '<div style="background-color:#fff; padding:5px;" class="round-small">
            <div id="reply" >
                           <div class="row">
                               <div align="center">
                                   <img src="'.$_SESSION['avatar'].'"  alt="" style=" border-radius: 50%; width:60px;">
                                   <h5>'.$_SESSION['nome'].'</h5>
                                   <small class="online">Online</small>
                               </div>

                                       <label for="textArea" class="col-md-9 control-label">Comentar:</label>
                                       <form action="home/setComentarios" method="post" name="comentar_post">
                                       <input type="hidden" name="contexto_id" value="'.$curso_id.'">
                                       <input type="hidden" name="comentario_tipo" value="4">
                                       <input type="hidden" name="comentario_id_referencia" value="0">
                                           <textarea name="comentario" style="width:100%; border:1px solid #e4e4e4; height:100px;" rows="3" id="textArea" required ></textarea>
                                           <a href="javascript:void(0);" onClick="document.comentar_post.submit();" class="button button-xs button-center-large button-round-large bg-facebook top-20 bottom-10">Comentar</a>
                                          </form>
                           </div><!-- end row -->
                       </div><!-- end answer -->
                       <!-- end topic-meta -->                              
      </div><br><br>';
         
        
             //  $_SESSION['titulo_pagina'] = $titulo;
               $_SESSION['titulo_pagina'] = "Curso";

         
         
         

                             
                             
                  // Verifica se o usuário que está logado curtiu, descurtiu ou marcou o comentário               
                  $sql4 = "SELECT curtiu, descurtiu, bookmark FROM cursos_usuarios_curtidas_bookmarks
                          WHERE usuario_id = ".$_SESSION['id']." AND curso_id = ".$curso_id." ";    

                  $db4->query($sql4,__LINE__,__FILE__);
                  $db4->next_record();
                  $like = $db4->f("curtiu");
                  $deslike = $db4->f("descurtiu");
                  $bookmark = $db4->f("bookmark");

                  $likeCurtido = 'bg-dark1-light';
                  $deslikeCurtido = 'bg-dark1-light';
                  $bookmarkFeito = 'bg-dark1-light';

                  if($like == "1")
                     $likeCurtido = 'bg-twitter regularbold';

                  if($deslike == "1")
                     $deslikeCurtido = 'bg-twitter regularbold';

                  if($bookmark == "1")
                     $bookmarkFeito = 'bg-red2-dark';


                  $box_social = '<a href="'.ABS_LINK.'home/likeCurso/'.$curso_id.'" class="icon icon-xs icon-round '.$likeCurtido.'"><i class="fa fa-thumbs-up"></i></a>
               <a href="'.ABS_LINK.'home/deslikeCurso/'.$curso_id.'" class="icon icon-xs icon-round '.$deslikeCurtido.'"><i class="fa fa-thumbs-down"></i></a>
                  <a href="'.ABS_LINK.'home/bookmarkCurso/'.$curso_id.'" class="icon icon-xs icon-round '.$bookmarkFeito.'"><i class="fa fa-bookmark"></i></a>';
               
                          
          if($duracao != "1")
             $s = "s";
          else
             $s = "";
          
          
            
            
            $cursos_relacionados .= '<h1>Cursos Relacionados</h1>
                                 <div class="double-slider owl-carousel owl-no-dots top-15">';
			
            
                        $sql2 = "SELECT id, titulo, imagem_destaque, slug FROM cursos
                                WHERE categoria_id = ".$categoria_id." AND status = 1 
                                ORDER BY id DESC";
                        $db2->query($sql2,__LINE__,__FILE__);
                        $db2->next_record();
                        for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
                        {
                           
                           $cursos_relacionados .= '<div>
                    <a href="'.ABS_LINK.'cursos/curso/'.$db2->f("slug").'"><div class="caption round-medium shadow-large" style="height:210px;">
                        <div class="caption-bottom">
                            <h4 class="color-white center-text uppercase ultrabold bottom-40"></h4>
                        </div>
                        <div class="caption-overlay bg-gradient"></div>
                        <img class="caption-image owl-lazy" data-src="'.LINK_ORIGINAL.'/'.$db2->f("imagem_destaque").'" style="width:auto !important; height:100% !important; overflow: auto !important;">
                    </div><center style="margin-top:-20px;"><strong>'.strtoupper($db2->f("titulo")).'</strong></center>
                    <!--<div class="under-slider-button">
                        <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'" class="button button-center-medium button-xs button-round-large bg-highlight shadow-large bottom-10">'.$db2->f("titulo").'</a>
                    </div>-->
                </a></div>';
                           
                           

                           $db2->next_record();
                          
                        }

                                 
                           $cursos_relacionados .= '</div>';
   
          
          
          
         $quantos_completaram = 0;
          
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE concluido = 1 AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows()>0)
            $quantos_completaram = $db->f("total");

          
          $listagem_comentarios = $this->getComentarios(4,0,0,$slug,0,"");
          
                          
         
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->template->set_var('curso_id',$curso_id);
         $GLOBALS["base"]->template->set_var('cursos_relacionados',$cursos_relacionados);
         $GLOBALS["base"]->template->set_var('quantos_completaram',$quantos_completaram);
         $GLOBALS["base"]->template->set_var('s',$s);
         $GLOBALS["base"]->template->set_var('duracao',$duracao);
         $GLOBALS["base"]->template->set_var('tags',  $tags);
         $GLOBALS["base"]->template->set_var('total_curtidas',$curtidas);
         $GLOBALS["base"]->template->set_var('box_social',$box_social);
         $GLOBALS["base"]->template->set_var('box_comentar_post',$box_comentar_post);
			$GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
			$GLOBALS["base"]->template->set_var('titulo',$titulo);
			$GLOBALS["base"]->template->set_var('slug',$slug);
			$GLOBALS["base"]->template->set_var('imagem_destaque',$imagem_destaque_src);
			$GLOBALS["base"]->template->set_var('dataCadastro',$dataCadastro);
			$GLOBALS["base"]->template->set_var('categoria',$categoria);
			$GLOBALS["base"]->template->set_var('nome_usuario',$nome_usuario);
			$GLOBALS["base"]->template->set_var('resumo',nl2br($resumo));
			$GLOBALS["base"]->template->set_var('categoria_id',$categoria_id);
			$GLOBALS["base"]->template->set_var('total_comentarios',$total_comentarios);
		   $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'curso');
			$GLOBALS["base"]->template = new template();
			$this->footer();
      
   }
   
   function aula()
   {
         @session_start();
         $db = new db();
         $db2 = new db();
         $db4 = new db();

         if(!isset($_SESSION['id']))
         {
            $this->javascriptRedirect(ABS_LINK."home");
            die();
         }

         $_SESSION['pagina'] = "cursos";
         $_SESSION['titulo_pagina'] = "Curso";     
        
         $slug = $this->blockrequest($_REQUEST['id']);
         
         // Pega o ID do curso
         $sql = "SELECT id FROM cursos WHERE slug = '".$slug."' ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $curso_id = $db->f("id");
         
         
         // Veririfica se o usuário já não está cadastrado no curso
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE usuario_id = ".$_SESSION['id']." AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $total = $db->f("total");
         if($total == 0)
         {
            // Cadastra o usuario no curso
            $sql = "INSERT INTO cursos_usuarios (curso_id, usuario_id, dataCadastro) VALUES (".$curso_id.",".$_SESSION['id'].",NOW())";   
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
         }
         
         // Busca os dados do curso para exibição
               $sql = "SELECT cursos.id AS cursos_id, 
                       cursos.titulo AS titulo, 
                       cursos.slug AS slug, 
                       cursos.conteudo AS conteudo, 
                       cursos.resumo AS resumo, 
                       cursos.imagem_destaque AS imagem_destaque, 
                       cursos.categoria_id AS categoria_id, 
                       DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       cursos_categorias.titulo AS categoria, 
                       cursos.tags AS tags,
                       cursos.likes AS curtidas,
                       cursos.duracao AS duracao 
                       FROM cursos, cursos_categorias
                       WHERE cursos.categoria_id = cursos_categorias.id 
                       AND cursos.slug = '".$slug."' ";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                     $curso_id = $db->f('cursos_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $dataCadastroCurso = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $resumo = $db->f('resumo');
                     $tagsArray = explode(",", $db->f("tags"));
                     $duracao = $db->f('duracao');
                     $curtidas = $db->f('curtidas');

         
         
         
          if($duracao != "1")
             $s = "s";
          else
             $s = "";

         $box_meus_dados = $this->boxMeusDados();

         $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$curso_id." ";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         $total_comentarios = $db2->f('total_comentarios');
         
         $quantos_completaram = 0;
          
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE concluido = 1 AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows()>0)
            $quantos_completaram = $db->f("total");

         
         // Pega a data de cadastro do usuario no curso
         $sql = "SELECT DATE_FORMAT(dataCadastro, '%d-%m-%Y') AS dataCadastro, DATE_FORMAT(dataCadastro, '%d/%m/%Y') AS data_cadastro, concluido AS concluido
                 FROM cursos_usuarios WHERE usuario_id = ".$_SESSION['id']." AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         
         $data_dia = $db->f("data_cadastro");
         $dataCadastro = $db->f("dataCadastro");
         $concluido = $db->f("concluido");
         
         $inicio = 1;

         
         $sql2 = "SELECT id AS dia_id FROM cursos_dias WHERE curso_id = ".$curso_id." ORDER BY dia_numero ASC";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
         {
            
            $dia_id = $db2->f("dia_id");
            
                                             
            
            
            // Total de topicos do dia
            $sql4 = "SELECT COUNT(id) AS total FROM cursos_topicos WHERE curso_id = ".$curso_id." AND dia_id = ".$dia_id." ";
            $db4->query($sql4,__LINE__,__FILE__);
            $db4->next_record();
            $totalTopicosDia = $db4->f("total");
            
            
           // Total de topicos feitos pelo usuario 
            
            
            
            $sql4 = "SELECT COUNT(cursos_topicos_usuarios.id) AS total FROM cursos_topicos_usuarios, cursos_topicos
                  WHERE  cursos_topicos_usuarios.topico_id = cursos_topicos.id
                  AND cursos_topicos_usuarios.curso_id = ".$curso_id."
                  AND cursos_topicos_usuarios.usuario_id = ".$_SESSION['id']."
                  AND cursos_topicos.dia_id = ".$dia_id." ";

            $db4->query($sql4,__LINE__,__FILE__);
            $db4->next_record();
            $totalFeitosPeloUsuario = $db4->f("total");
            
                     
                        $listagem_dias .= '<a data-accordion="accordion-content-'.$i2.'" href="#" ';
                        
                        if($totalFeitosPeloUsuario >= $totalTopicosDia)
                           $listagem_dias .= ' style="font-weight:bold; color:#4bab18;" ';
                        
                        if($i2 == 0)
                         $listagem_dias .= 'class="accordion-toggle-first" ';
                        
                        

                           $listagem_dias .= '>';
                           
                           if($totalFeitosPeloUsuario >= $totalTopicosDia)
                             $listagem_dias .= '<i class="accordion-icon-left fa fa-check color-green1"></i>';
                              
                          else    
                             $listagem_dias .= '<i class="accordion-icon-left fa fa-graduation-cap color-red1-light"></i>';
                             
                             
                             $listagem_dias .= 'Dia '.$inicio.'  <div style="float:right;">'.date('d/m/Y', strtotime('+'.($inicio-1).' days', strtotime($dataCadastro))).'</div>
                              <i class="accordion-icon-right fa fa-arrow-down"></i>
                          </a>
                          <div id="accordion-content-'.$i2.'" class="accordion-content bottom-10">
                               <div class="search-trending content-boxed shadow-large">  
                                  <div class="content bottom">
                                          <ul class="bottom-15">';

            
            
                                                $sql = "SELECT id AS topico_id, titulo AS topico_titulo, slug AS topico_slug
                                                        FROM cursos_topicos WHERE curso_id = ".$curso_id." AND dia_id = ".$dia_id." ";
                                                $db->query($sql,__LINE__,__FILE__);
                                                $db->next_record();
                                                for($i = 0; $i < $db->num_rows(); $i++)
                                                {
                                                   $topico_id = $db->f("topico_id");
                                                   $topico_titulo = $db->f("topico_titulo");
                                                   $topico_slug = $db->f("topico_slug");
                                                   
                                                   
                                                   // Verifica se o usuário já fez o tópico
                                                      $sql4 = "SELECT COUNT(id) AS total FROM cursos_topicos_usuarios
                                                            WHERE  topico_id = ".$topico_id."
                                                            AND usuario_id = ".$_SESSION['id']." ";
                                                      $db4->query($sql4,__LINE__,__FILE__);
                                                      $db4->next_record();
                                                      $feitoPeloUsuario = $db4->f("total");
                                                   
                                                      
                                                      $listagem_dias .= '<li><a href="'.ABS_LINK.'cursos/topico/'.$topico_slug.'" onClick="javascript:location=\''.ABS_LINK.'cursos/topico/'.$topico_slug.'\';" ';
                                                      
                                                      
                                                      if($feitoPeloUsuario > 0)
                                                       $listagem_dias .= 'style="font-weight:bold; color:#4bab18;" '; 
                                                      
                                                      
                                                      $listagem_dias .= ' "><input type="checkbox" class="fac fac-checkbox fac-default" ';
                                                      

                                                   if($feitoPeloUsuario > 0)
                                                      $listagem_dias .= ' checked="checked" ';
                                                      
                                                      $listagem_dias .= ' disabled type="checkbox" name="topic_'.$topico_id.'"  id="topic_'.$topico_id.'" value="1" >&nbsp; '.$topico_titulo.'<i class="fa fa-angle-right"></i></a></li>';
                                                      
   
                                                  $db->next_record();
                                                }

                                               $listagem_dias .= '</ul></div></div></div>';
         
                $inicio++;
               $db2->next_record();
         }
         
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

         $GLOBALS["base"]->template->set_var('listagem_dias',$listagem_dias);

         $GLOBALS["base"]->template->set_var('quantos_completaram',$quantos_completaram);
         $GLOBALS["base"]->template->set_var('dataCadastro',$dataCadastroCurso);
         $GLOBALS["base"]->template->set_var('total_comentarios',$total_comentarios);
         $GLOBALS["base"]->template->set_var('categoria',$categoria);
         $GLOBALS["base"]->template->set_var('total_curtidas',$curtidas);
         $GLOBALS["base"]->template->set_var('s',$s);
         $GLOBALS["base"]->template->set_var('duracao',$duracao);
         $GLOBALS["base"]->template->set_var('titulo',$titulo);
         $GLOBALS["base"]->template->set_var('imagem_destaque',LINK_ORIGINAL."/".$imagem_destaque);
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
		   $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'aula');
			$GLOBALS["base"]->template = new template();
			$this->footer();
      
   }
   
   function ajax_topico()
   {
			@session_start();
			$db = new db();

	      $topico_id = $this->blockrequest($_GET['topicid']);
	      $curso_id = $this->blockrequest($_GET['curso_id']);


		   $sql = "INSERT INTO cursos_topicos_usuarios(curso_id, topico_id, usuario_id) VALUES (".$curso_id.",".$topico_id.",".$_SESSION['id'].")";
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();
   }
   
   function topico()
   {
       @session_start();
      $db = new db();
      $db2 = new db();
      $db4 = new db();
      
      if(!isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK."home");
         die();
      }

         $_SESSION['pagina'] = "cursos";
         
         $slug = $this->blockrequest($_REQUEST['id']);
         
         $sql = "SELECT id, titulo, conteudo, curso_id, imagem_destaque, video FROM cursos_topicos WHERE slug = '".$slug."' ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $topico_id = $db->f("id");
         $titulo = $db->f("titulo");
         $conteudo = $db->f("conteudo");
         $curso_id = $db->f("curso_id");
         $imagem_destaque = $db->f("imagem_destaque");
         $video = $db->f("video");
         
         

         $sql = "SELECT cursos.id AS cursos_id, 
                 cursos.titulo AS titulo, 
                 cursos.slug AS slug, 
                 cursos.conteudo AS conteudo, 
                 cursos.resumo AS resumo, 
                 cursos.imagem_destaque AS imagem_destaque, 
                 cursos.categoria_id AS categoria_id, 
                 DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                 cursos_categorias.titulo AS categoria, 
                 cursos.tags AS tags,
                 cursos.likes AS curtidas,
                 cursos.duracao AS duracao 
                 FROM cursos, cursos_categorias
                 WHERE cursos.categoria_id = cursos_categorias.id 
                 AND cursos.id = ".$curso_id." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

               $curso_id = $db->f('cursos_id');
               $curso_titulo = $db->f('titulo');
               $curso_slug = $db->f('slug');
               $curso_imagem_destaque = $db->f('imagem_destaque');
               $curso_dataCadastro = $db->f('dataCadastro');
               $curso_categoria = $db->f('categoria');
               $curso_conteudo = $db->f('conteudo');
               $curso_categoria_id = $db->f('categoria_id');
               $curso_resumo = $db->f('resumo');
               $curso_tagsArray = explode(",", $db->f("tags"));
               $curso_duracao = $db->f('duracao');
               $curso_curtidas = $db->f('curtidas');
                                          
                     
        

         //$_SESSION['titulo_pagina'] = $titulo;
          $_SESSION['titulo_pagina'] = "Curso";     

          
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE concluido = 1 AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows()>0)
            $quantos_completaram = $db->f("total");

         
         // Video do Youtube
         if(strpos($video, "youtube") || strpos($video, "youtu"))
         {
               if($video != "" && strlen($video) > 5)
               {

                  $videoid = explode("v=",$video);
                   $videoid = $videoid[1];
                  $videoid = explode("&",$videoid);
                  $videoid = $videoid[0];
                  
                  
                  $_SESSION['videoid'] = '<iframe  id="video_small"  src="https://www.youtube.com/embed/'.$videoid.'?controls=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                  $_SESSION['videoidfull'] = '<iframe  id="video_full" style="transform: rotate(90deg); -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); margin-top: 115px; margin-left: -110px;" width="560" height="60%" src="https://www.youtube.com/embed/'.$videoid.'?controls=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

                  
                  $conteudo .= '<a href="#" data-menu="menu-video"><img src="images/play.png" style="width:100%; margin-top:10px; position:absolute; z-index:9999999;"><img src="https://img.youtube.com/vi/'.$videoid.'/0.jpg" width="100%"></a>';
               }
            
         }
         
         
         // Video do Vimeo
         if(strpos($video, "vimeo"))
         {
               if($video != "" && strlen($video) > 5)
               {

                  $videoid = explode("vimeo.com/",$video);
                  $videoid = $videoid[1];

                  
                  $_SESSION['videoid'] = '<iframe  id="video_small" src="https://player.vimeo.com/video/'.$videoid.'?autoplay=1&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe><script src="https://player.vimeo.com/api/player.js"></script>';
                  
                 $_SESSION['videoidfull'] =  '<iframe  id="video_full" src="https://player.vimeo.com/video/'.$videoid.'?autoplay=1&title=0&byline=0&portrait=0" style=" margin-top: 115px; margin-left: -110px; transform: rotate(90deg); -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); " width="560" height="60% frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe><script src="https://player.vimeo.com/api/player.js"></script>';
                 
                 
                 $conteudo .= '<a href="#" data-menu="menu-video"><img src="images/play.png" style="width:100%; margin-top:10px; position:absolute; z-index:9999999;"><img src="https://i.vimeocdn.com/video/'.$videoid.'.jpg"` alt=""  width="100%" /></a>';
               }
            
         }         
         
         
         
         
         
         
         
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->template->set_var('imagem_destaque',LINK_ORIGINAL."/".$imagem_destaque);
         $GLOBALS["base"]->template->set_var('curso_titulo',$curso_titulo);
         $GLOBALS["base"]->template->set_var('curso_slug',$curso_slug);
         $GLOBALS["base"]->template->set_var('video',$video);
			$GLOBALS["base"]->template->set_var('topico_id',$topico_id);
			$GLOBALS["base"]->template->set_var('titulo',$titulo);
			$GLOBALS["base"]->template->set_var('slug',$slug);
			$GLOBALS["base"]->template->set_var('conteudo',nl2br($conteudo));
		   $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'topico');
			$GLOBALS["base"]->template = new template();
			$this->footer();
     
   }
   
   function concluitopic()
   {
			@session_start();
			$db = new db();
			$db2 = new db();

	      $topico_slug = $this->blockrequest($_REQUEST['id']);
         
         // Busca o ID do topico e do curso
         $sql = "SELECT curso_id, id AS topico_id FROM cursos_topicos WHERE slug = '".$topico_slug."' ";
		   $db->query($sql,__LINE__,__FILE__);
		   $db->next_record();
         if($db->num_rows() > 0)
         {
            $curso_id = $db->f("curso_id");
            $topico_id = $db->f("topico_id");
            
            $sql2 = "SELECT slug FROM cursos WHERE id = '".$curso_id."' ";
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();
            $curso_slug = $db2->f("slug");

            // verifica se ja nao completou o topico
            $sql = "SELECT COUNT(id) AS total FROM cursos_topicos_usuarios WHERE topico_id = ".$topico_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            // caso nao, completa
            if($db->f("total") == 0)
            {
               $sql = "INSERT INTO cursos_topicos_usuarios(curso_id, topico_id, usuario_id) VALUES (".$curso_id.",".$topico_id.",".$_SESSION['id'].")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
         }
         
         $this->notificacao("Parabéns! Você concluiu mais um tópico do curso.", "green");
         header("Location: ".ABS_LINK."cursos/aula/".$curso_slug);         
         
      
   }
   
   function categoria()
	{
      @session_start();
      $db = new db();
      $db2 = new db();
      $db3 = new db();

      if(!isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK."home");
         die();
      }
         
         $_SESSION['pagina'] = "cursos";
         $_SESSION['titulo_pagina'] = "Cursos";
         
         $id_categoria = $_REQUEST['id'];
         
         $sql = "SELECT cursos_categorias.titulo AS categoriaTitulo FROM cursos_categorias WHERE cursos_categorias.id = ".$id_categoria." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $emCategoria = "em: <br>".$db->f("categoriaTitulo");
         
         
         
         $sql = "SELECT id, titulo FROM cursos_categorias WHERE id = ".$id_categoria."  ORDER BY titulo ASC";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $categoria_id = $db->f("id");
            $categoria_titulo = $db->f("titulo");
            
            
            $listagem_sugestoes_cursos .= '<h1>'.$categoria_titulo.'</h1>
                                 <div class="double-slider owl-carousel owl-no-dots top-15">';
			
            
                        $sql2 = "SELECT id, titulo, imagem_destaque, slug FROM cursos
                                WHERE categoria_id = ".$categoria_id." AND status = 1 
                                ORDER BY id DESC";
                        $db2->query($sql2,__LINE__,__FILE__);
                        $db2->next_record();
                        for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
                        {
                           $curso_id = $db2->f("id");
                           $curso_titulo = $db2->f("titulo");
                           $curso_imagem_destaque = $db2->f("imagem_destaque");
                           $curso_slug = $db2->f("slug");
                           
                           
                           
                           $listagem_sugestoes_cursos .= '<div>
                                        <div class="caption round-medium shadow-huge bottom-15">
                                            <div class="caption-bottom">
                                                <h3 class="color-white center-text bolder bottom-0">'.$curso_titulo.'</h3>

                                                <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'" class="button button-full left-10 right-10 button-xxs button-round-large bg-highlight shadow-large bottom-10">ver</a>
                                            </div>
                                            <div class="caption-overlay bg-gradient"></div>
                                            <img class="caption-image owl-lazy" data-src="'.LINK_ORIGINAL.'/'.$curso_imagem_destaque.'" style="height:150px;">
                                        </div>
                                    </div>';
                           

                           $db2->next_record();
                          
                        }

                                 
                           $listagem_sugestoes_cursos .= '</div>';
   
            $db->next_record();
            
         }

         
         
         // NOVOS CURSOS
         
         $listagem_cursos_recentes .= '<h1>Novos Cursos</h1>
                                 <div class="double-slider owl-carousel owl-no-dots top-15">';

         $sql2 = "SELECT id, titulo, imagem_destaque, slug FROM cursos
                 WHERE status = 1
                 ORDER BY id DESC LIMIT 0,20";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
         {
            $curso_id = $db2->f("id");
            $curso_titulo = $db2->f("titulo");
            $curso_imagem_destaque = $db2->f("imagem_destaque");
            $curso_slug = $db2->f("slug");
   
            $listagem_cursos_recentes .= '<div>
                         <div class="caption round-medium shadow-huge bottom-15">
                             <div class="caption-bottom">
                                 <h3 class="color-white center-text bolder bottom-0">'.$curso_titulo.'</h3>

                                 <a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'" class="button button-full left-10 right-10 button-xxs button-round-large bg-highlight shadow-large bottom-10">ver</a>
                             </div>
                             <div class="caption-overlay bg-gradient"></div>
                             <img class="caption-image owl-lazy" data-src="'.LINK_ORIGINAL.'/'.$curso_imagem_destaque.'"  style="height:150px;">
                         </div>
                     </div>';
            

            $db2->next_record();

         }
         
         $listagem_cursos_recentes .= '</div>';
         

         // MEUS CURSOS
            
            $sql = "SELECT cursos.titulo,
            cursos.slug as slug,
            cursos.id as curso_id
            FROM cursos, cursos_usuarios 
            WHERE cursos.id = cursos_usuarios.curso_id 
            AND cursos_usuarios.usuario_id = ".$_SESSION['id']." 
            ORDER BY cursos_usuarios.dataCadastro DESC";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            for($i = 0; $i < $db->num_rows(); $i++)
            {
               
               $curso_titulo = $db->f("titulo");
               $curso_slug = $db->f("slug");
      
               $listagem_meus_cursos .= '<li><a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'">'.$curso_titulo.'<i class="fa fa-angle-right"></i></a></li>';
               
              $db->next_record();
            }
         
         
         
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

			$GLOBALS["base"]->template->set_var('emCategoria',$emCategoria);
			$GLOBALS["base"]->template->set_var('listagem_meus_cursos',$listagem_meus_cursos);
			$GLOBALS["base"]->template->set_var('listagem_cursos_recentes',$listagem_cursos_recentes);
			$GLOBALS["base"]->template->set_var('listagem_sugestoes_cursos',$listagem_sugestoes_cursos);
		   $GLOBALS["base"]->write_design_specific('cursos.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
}
	
   ?>