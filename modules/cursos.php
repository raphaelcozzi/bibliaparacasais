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
      /*
      if(!isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK."cadastro");
         die();
      }
       */  
         $_SESSION['pagina'] = "cursos";
         $_SESSION['titulo_pagina'] = "Cursos";
         
         
         $sql = "SELECT id, titulo FROM cursos_categorias ORDER BY titulo ASC";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $categoria_id = $db->f("id");
            $categoria_titulo = $db->f("titulo");
			
            $listagem_sugestoes_cursos .= '<aside class="topic-list">
                                       <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                   <div class="panel panel-default">
                                       <article class="well btn-group-sm clearfix">
                                           <div class="featured-grade btn btn-info btn-fab">
                                               <i class="material-icons">school</i>
                                               <div class="ripple-container"></div>
                                           </div>
                                           <div class="panel-heading" role="tab" id="headingOne">
                                               <div class="panel-title">
                                                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$i.'" aria-expanded="true" aria-controls="collapseOne'.$i.'">
                                                       <header class="topic-title clearfix">
                                                           <h3> '.$categoria_titulo.'</h3>
                                                       </header>
                                                   </a>
                                               </div>
                                           </div>
                                           <div id="collapseOne'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                               <div class="panel-body">';
            
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
            
            
                           $listagem_sugestoes_cursos .= '<a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><img src="'.$curso_imagem_destaque.'" alt="" class="img-responsive" width="100%"></a>';
                           $listagem_sugestoes_cursos .= '<a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><h4>'.$curso_titulo.'</h4></a><hr>';

                           $db2->next_record();
                          
                        }

                                 
                           $listagem_sugestoes_cursos .= '</div>
                                               <!-- end panel-body -->
                                           </div>
                                           <!-- end panel-collapse -->
                                       </article>
                                       <!-- end article well -->
                                   </div>
                                   <!-- end panel -->
                               <!-- end panel-group -->
                           </aside>';
   
            $db->next_record();
            
         }

         

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
   
            $listagem_cursos_recentes .= '<div class="post_unico">'; 


            $listagem_cursos_recentes .= '<a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><img src="'.$curso_imagem_destaque.'" alt="" class="img-responsive" width="100%"></a>';
            $listagem_cursos_recentes .= '<a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><h4>'.$curso_titulo.'</h4></a><hr>';

            $listagem_cursos_recentes .= '</div>'; 
   
            $db2->next_record();

         }
         
         
         
      if(isset($_SESSION['id']))
         $box_meus_dados = $this->boxMeusDados();
      else
         $box_meus_dados = "";

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

			$GLOBALS["base"]->template->set_var('listagem_cursos_recentes',$listagem_cursos_recentes);
			$GLOBALS["base"]->template->set_var('listagem_sugestoes_cursos',$listagem_sugestoes_cursos);
			$GLOBALS["base"]->template->set_var('box_meus_dados',$box_meus_dados);
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
 /*     
      if(!isset($_SESSION['id']))
      {
         $this->javascriptRedirect(ABS_LINK."home");
         die();
      }
 */
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

				  if($db->num_rows() == 0)
				  	header("Location: ".ABS_LINK."home/naoencontrado");


                     $curso_id = $db->f('cursos_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
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
                         $tags .='<ul class="list-inline tags">';

                        for($ta = 0; $ta < count($tagsArray); $ta++)
                        {

                           $tags .='<li><a href="'.ABS_LINK.'cursos/'.$categoria_id.'">'.$tagsArray[$ta].'</a></li>';

                        }

                     $tags .='</ul>';
                   }
                   else
                   {
                     $tags .='';
                   }
                     
                     
         if($imagem_destaque != "")
         {
            $imagem_destaque = '<img src="'.$imagem_destaque.'" alt="" class="img-responsive" width="100%">';
         }
                     
                     
         $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$curso_id." ";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         $total_comentarios = $db2->f('total_comentarios');
         
         if(isset($_SESSION['logado']))
            {
               $box_comentar_post = '<div class="row">
                    <div class="col-md-12">
                        <aside class="topic-page topic-list blog-list forum-list single-forum">
                           <article class="well btn-group-sm clearfix">
                     <div class="forum-answer topic-desc clearfix" id="reply" >
                                    <div class="row">
                                        <div class="col-sm-2 text-center publisher-wrap">
                                            <img src="'.$_SESSION['avatar'].'" alt="" class="avatar img-circle img-responsive">
                                            <h5>'.$_SESSION['nome'].'</h5>
                                            <small class="online">Online</small>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="textArea" class="col-md-9 control-label">Comentar:</label>
                                                <div class="col-md-10">
                                                <form action="home/setComentarios" method="post" name="comentar">
                                                <input type="hidden" name="contexto_id" value="'.$curso_id.'">
                                                <input type="hidden" name="comentario_tipo" value="4">
                                                <input type="hidden" name="comentario_id_referencia" value="0">
                                                    <textarea name="comentario" class="form-control" rows="3" id="textArea" required ></textarea>
                                                   <button type="submit" class="btn btn-raised btn-info gr">Enviar</button>
                                                   </form>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end answer -->
                                <!-- end topic-meta -->                              
                           </article>                
                        </aside>
                    </div>
               </div>';
            }
            else
            {
               $box_comentar_post = '<div class="row">
                    <div class="col-md-12">
                        <aside class="topic-page topic-list blog-list forum-list single-forum">
                           <article class="well btn-group-sm clearfix">
                     <div class="forum-answer topic-desc clearfix" id="reply" >
                                    <div class="row">
                                        <div class="col-md-10"><h4>&Eacute; preciso entrar para comentar.</h4>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end answer -->
                                <!-- end topic-meta -->                              
                           </article>                
                        </aside>
                    </div>
               </div>';
            }

               $_SESSION['titulo_pagina'] = $titulo;

         
               $sql = "SELECT cursos.titulo AS titulo, 
                       cursos.slug AS slug, 
                       DATE_FORMAT(cursos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       cursos_categorias.titulo AS categoria
                       FROM cursos, cursos_categorias
                       WHERE cursos.categoria_id = cursos_categorias.id 
                       ORDER BY cursos.id DESC LIMIT 0,5";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
			

                  for($i = 0; $i < $db->num_rows(); $i++)
                  {
                     
                     $titulo2 = $db->f('titulo');
                     $slug2 = $db->f('slug');
                     $dataCadastro2 = $db->f('dataCadastro');
                     $categoria2 = $db->f('categoria');
                     
                     $listagem_cursos_recentes .= '<div class="list-group-item">
                                                        <div class="row-topic">
                                                            <header class="topic-title clearfix">
                                                                <h3><a href="'.ABS_LINK.'cursos/curso/'.$slug2.'">'.$titulo2.'</a></h3>
                                                                <small>Em '.$categoria2.'</small>
                                                                <small>'.$dataCadastro2.'</small>
                                                            </header>
                                                        </div>
                                                    </div><div class="list-group-separator"></div>';
                     
                     $db->next_record();
                  }
            
            
         
         
         

         
                          if(isset($_SESSION['logado']))
                          {
                             
                             
                              // Verifica se o usuário que está logado curtiu, descurtiu ou marcou o comentário               
                              $sql4 = "SELECT curtiu, descurtiu, bookmark FROM cursos_usuarios_curtidas_bookmarks
                                      WHERE usuario_id = ".$_SESSION['id']." AND curso_id = ".$curso_id." ";    
                              
                              $db4->query($sql4,__LINE__,__FILE__);
                              $db4->next_record();
                              $like = $db4->f("curtiu");
                              $deslike = $db4->f("descurtiu");
                              $bookmark = $db4->f("bookmark");

                              if($like == "1")
                              {
                                 $likeCurtido = 'style="background-color:#7fc7ff;"';
                                 $likeCurtidoIconColor = 'style="color:#ffffff;" ';
                              }
                              else
                              {
                                 $likeCurtido = '';
                                 $likeCurtidoIconColor = '';
                              }


                              if($deslike == "1")
                              {
                                 $deslikeCurtido = 'style="background-color:#7fc7ff;"';
                                 $deslikeCurtidoIconColor = 'style="color:#ffffff;" ';
                              }
                              else
                              {
                                 $deslikeCurtido = '';
                                 $deslikeCurtidoIconColor = '';
                              }

                              if($bookmark == "1")
                              {
                                 $bookmarkFeito = 'style="background-color:#7fc7ff;"';
                                 $bookmarkFeitoIconColor = 'style="color:#ffffff;" ';
                              }
                              else
                              {
                                 $bookmarkFeito = '';
                                 $bookmarkFeitoIconColor = '';
                              }
                             
                             
               
                                    $box_social .= '<footer class="topic-footer clearfix">
                                                   <div class="pull-left">
                                                   <div class="customshare">
                                                       <a '.$likeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'home/likeCurso/'.$curso_id.'" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                           <i '.$likeCurtidoIconColor.' class="material-icons">thumb_up</i>
                                                       </a>
                                                       <a '.$deslikeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'home/deslikeCurso/'.$curso_id.'" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                           <i '.$deslikeCurtidoIconColor.' class="material-icons">thumb_down</i>
                                                       </a>
                                                       <!--<a '.$bookmarkFeito.' class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'home/bookmarkCurso/'.$curso_id.'" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                           <i '.$bookmarkFeitoIconColor.' class="material-icons">bookmark_border</i>
                                                       </a>-->';
                                    
                                    
                                    $box_social .= '</div></div>
                                 <!-- end left -->
                                 <div class="pull-right">
                                     <div class="customshare">
                                         <div class="list">
                                             <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                 <ul class="list-inline">
                                                     <li><a target="_blank" href="https://wa.me/?text='.urlencode($titulo.' - https://www.bibliaparacasais.com.br/cursos/curso/'.$slug.' - Compartilhado via bibliaparacasais.com.br').'" class="wat"><i class="fa fa-whatsapp"></i></a></li>
                                                     <li><a href="javascript:void(0);" class="fb" onclick="shareFacebook(\'https://www.bibliaparacasais.com.br/cursos/curso/'.$slug.'\',\'.$conteudo.\');"><i class="fa fa-facebook"></i></a></li>
                                                     <li><a href="http://twitter.com/share?text='.substr($titulo.' - '.$conteudo,0,140).'&url=https://www.bibliaparacasais.com.br/cursos/curso/'.$slug.'" target="_blank"" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </footer>
                             <!-- ITEM FIM -->';

                                    $box_social .= '<hr><div style="white-space:nowrap;"><a style="width:50%;" href="'.ABS_LINK.'cursos/aula/'.$slug.'" class="btn btn-raised btn-info gr">Iniciar o Curso</a>';

                                    $box_social .= '<a style="width:50%;"  href="'.ABS_LINK.'home/bookmarkCurso/'.$curso_id.'" class="btn btn-raised btn-info gr">Salvar para depois</a></div>';

                                    
                                    
                           }
                          else
                          {
                                    $box_social .= '<footer class="topic-footer clearfix">
                                                   <div class="pull-left">
                                                   <div class="customshare">
                                                       <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                           <i class="material-icons">thumb_up</i>
                                                       </a>
                                                       <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                           <i class="material-icons">thumb_down</i>
                                                       </a>
                                                       <a  class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                           <i class="material-icons">bookmark_border</i>
                                                       </a>';



                                    $box_social .= '</div></div>
                                 <!-- end left -->
                                 <div class="pull-right">
                                     <div class="customshare">
                                         <div class="list">
                                             <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                 <ul class="list-inline">
                                                     <li><a href="'.ABS_LINK.'cadastro" class="wat"><i class="fa fa-whatsapp"></i></a></li>
                                                     <li><a href="'.ABS_LINK.'cadastro" class="fb" ><i class="fa fa-facebook"></i></a></li>
                                                     <li><a href="'.ABS_LINK.'cadastro" target="_blank"" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </footer><!-- end tpic-desc -->
                             <!-- ITEM FIM -->';
                             
                          }
                          
          if($duracao != "1")
             $s = "s";
          else
             $s = "";
          
          
         $sql2 = "SELECT id, titulo, imagem_destaque, slug FROM cursos
                 WHERE status = 1 AND categoria_id = ".$categoria_id."
                 ORDER BY id DESC LIMIT 0,20";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
         {
            $curso_id = $db2->f("id");
            $curso_titulo = $db2->f("titulo");
            $curso_imagem_destaque = $db2->f("imagem_destaque");
            $curso_slug = $db2->f("slug");
   
            $cursos_relacionados .= '<div class="post_unico2">'; 


            $cursos_relacionados .= '<a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><img src="'.$curso_imagem_destaque.'" alt="" class="img-responsive" width="100%"></a>';
            $cursos_relacionados .= '<a href="'.ABS_LINK.'cursos/curso/'.$curso_slug.'"><h4>'.$curso_titulo.'</h4></a>';

            $cursos_relacionados .= '</div>'; 
   
            $db2->next_record();

         }
          
          
          
          
         $quantos_completaram = 0;
          
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE concluido = 1 AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows()>0)
            $quantos_completaram = $db->f("total");

          
      if(isset($_SESSION['id']))
         $box_meus_dados = $this->boxMeusDados();
      else
         $box_meus_dados = "";
          
          
          $listagem_comentarios = $this->getComentarios(4,0,0,$slug,0,"");
                          
         
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->template->set_var('box_meus_dados',$box_meus_dados);
         $GLOBALS["base"]->template->set_var('cursos_relacionados',$cursos_relacionados);
         $GLOBALS["base"]->template->set_var('quantos_completaram',$quantos_completaram);
         $GLOBALS["base"]->template->set_var('s',$s);
         $GLOBALS["base"]->template->set_var('duracao',$duracao);
         $GLOBALS["base"]->template->set_var('tags',$tags);
         $GLOBALS["base"]->template->set_var('total_curtidas',$curtidas);
         $GLOBALS["base"]->template->set_var('box_social',$box_social);
         $GLOBALS["base"]->template->set_var('listagem_cursos_recentes',$listagem_cursos_recentes);
         $GLOBALS["base"]->template->set_var('box_comentar_post',$box_comentar_post);
			$GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
			$GLOBALS["base"]->template->set_var('artigo_id',$artigo_id);
			$GLOBALS["base"]->template->set_var('titulo',$titulo);
			$GLOBALS["base"]->template->set_var('slug',$slug);
			$GLOBALS["base"]->template->set_var('imagem_destaque',$imagem_destaque);
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
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $resumo = $db->f('resumo');
                     $tagsArray = explode(",", $db->f("tags"));
                     $duracao = $db->f('duracao');
                     $curtidas = $db->f('curtidas');

         
         
         if($imagem_destaque != "")
         {
            $imagem_destaque = '<img src="'.$imagem_destaque.'" alt="" class="img-responsive" width="100%">';
         }
         else
         {
            $imagem_destaque = '';
         }
         
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
            
            $listagem_dias .= '<aside class="topic-list">
                                       <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                   <div class="panel panel-default">
                                       <article class="well btn-group-sm clearfix">';
            
            
            // Verifica se o usuário concluiu o topico
            
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
            
            
                     if($totalFeitosPeloUsuario >= $totalTopicosDia)                      
                           $listagem_dias .= '<div class="featured-grade btn btn-info btn-fab"><i class="material-icons">check_circle</i><div class="ripple-container"></div>
                                           </div>';   
                                                       
                                 $listagem_dias .= '<div class="panel-heading" role="tab" id="headingOne">
                                               <div class="panel-title">
                                                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$i2.'" aria-expanded="true" aria-controls="collapseOne'.$i2.'">
                                                       <header class="topic-title clearfix">
                                                       <div style="float:left;">  <h3> Dia '.$inicio.' </h3></div>  <div style="float:right;">'.date('d/m/Y', strtotime('+'.($inicio-1).' days', strtotime($dataCadastro))).'</div>
                                                       </header>
                                                   </a>
                                               </div>
                                           </div>
                                           <div id="collapseOne'.$i2.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                               <div class="panel-body"><hr>';
            

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
                                                   

                                                  $listagem_dias .= '<div class="checkbox">
                                                <label><input disabled type="checkbox" name="topic_'.$topico_id.'"  id="topic_'.$topico_id.'" value="1" ';
                                                  
                                                  
                                                  if($feitoPeloUsuario > 0)
                                                   $listagem_dias .= ' checked="checked" ';
                                                  
                                               $listagem_dias .= '>
                                                <a href="'.ABS_LINK.'cursos/topico/'.$topico_slug.'"><small>'.$topico_titulo.'</small></a></label></div><br>';
   
                                                  $db->next_record();
                                                }

                                               $listagem_dias .= '</div>
                                               <!-- end panel-body -->
                                           </div>
                                           <!-- end panel-collapse -->
                                       </article>
                                       <!-- end article well -->
                                   </div>
                                   <!-- end panel -->
                               <!-- end panel-group -->
                           </aside>';
         
                $inicio++;
               $db2->next_record();
         }
         
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

         $GLOBALS["base"]->template->set_var('listagem_dias',$listagem_dias);

         $GLOBALS["base"]->template->set_var('quantos_completaram',$quantos_completaram);
         $GLOBALS["base"]->template->set_var('dataCadastro',$dataCadastro);
         $GLOBALS["base"]->template->set_var('total_comentarios',$total_comentarios);
         $GLOBALS["base"]->template->set_var('categoria',$categoria);
         $GLOBALS["base"]->template->set_var('total_curtidas',$curtidas);
         $GLOBALS["base"]->template->set_var('s',$s);
         $GLOBALS["base"]->template->set_var('duracao',$duracao);
         $GLOBALS["base"]->template->set_var('titulo',$titulo);
         $GLOBALS["base"]->template->set_var('imagem_destaque',$imagem_destaque);
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->template->set_var('box_meus_dados',$box_meus_dados);
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
         $video = $db->f('video');

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
                                          
                     
         if($imagem_destaque != "")
         {
            $imagem_destaque = '<img src="'.$imagem_destaque.'" alt="" class="img-responsive" width="100%">';
         }
                     
        

         $_SESSION['titulo_pagina'] = $titulo;

          
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE concluido = 1 AND curso_id = ".$curso_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows()>0)
            $quantos_completaram = $db->f("total");

          
          $box_meus_dados = $this->boxMeusDados();

          
         // Video do Youtube
                  if(strpos($video, "youtube") || strpos($video, "youtu"))
                  {
                        if($video != "" && strlen($video) > 5)
                        {

                           $videoid = explode("v=",$video);
                           $videoid = $videoid[1];


                           $conteudo .= '<div style="padding:56.25% 0 0 0;position:relative;"><iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="https://www.youtube.com/embed/'.$videoid.'?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
                        }

                  }


                  // Video do Vimeo
                  if(strpos($video, "vimeo"))
                  {
                        if($video != "" && strlen($video) > 5)
                        {

                           $videoid = explode("vimeo.com/",$video);
                           $videoid = $videoid[1];


                          $conteudo .= '<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/'.$videoid.'?color=ffffff&badge=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>';
                        }

                  }         
          
         
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->template->set_var('imagem_destaque',$imagem_destaque);
         $GLOBALS["base"]->template->set_var('curso_titulo',$curso_titulo);
         $GLOBALS["base"]->template->set_var('curso_slug',$curso_slug);
         $GLOBALS["base"]->template->set_var('box_meus_dados',$box_meus_dados);
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
}
	
   ?>