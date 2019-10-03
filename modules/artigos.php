<?php
require_once("modules/home.php");  

class artigos extends home
{
	public function main()
	{
    		@session_start();
			$db = new db();
			$db2 = new db();
	
         $_SESSION['pagina'] = "artigo";
         $_SESSION['titulo_pagina'] = "Artigos";
			

         
               $sql = "SELECT artigos.id AS artigo_id, 
                       artigos.titulo AS titulo, 
                       artigos.slug AS slug, 
                       artigos.conteudo AS conteudo, 
                       artigos.imagem_destaque AS imagem_destaque, 
                       artigos.categoria_id AS categoria_id, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       artigos.tags AS tags, 
                       usuarios.nome AS nome_usuario 
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id 
                       ORDER BY artigos.id DESC";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                  for($i = 0; $i < $db->num_rows(); $i++)
                  {

                     $artigo_id = $db->f('artigo_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $nome_usuario = $db->f('nome_usuario');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $tags = $db->f('tags');
                     
                     $tags = explode(",",$tags);


                     $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$artigo_id." ";
                     $db2->query($sql2,__LINE__,__FILE__);
                     $db2->next_record();
                     $total_comentarios = $db2->f('total_comentarios');

                     $listagem_artigos .= '<div class="post_unico" >';


                     $listagem_artigos .= '<!-- ITEM --><article class="well clearfix"><div class="topic-desc row-fluid clearfix">';

                     if($imagem_destaque != "")
                        $listagem_artigos .='<div class="col-sm-4"><img src="'.$imagem_destaque.'" alt="" class="img-responsive img-thumbnail"></div>';

                                          $listagem_artigos .= '<div class="col-sm-8">
                                              <h4><a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" title="'.$titulo.'">'.$titulo.'</a></h4>
                                              <div class="blog-meta clearfix">
                                                  <small>'.$dataCadastro.'</small>
                                                  <small><a href="javascript:void(0)">'.$total_comentarios.' Coment&aacute;rios</a></small>
                                                  <small>em <a href="javascript:void(0)">'.$categoria.'</a></small>
                                                  <small>por <a href="javascript:void(0)"> '.$nome_usuario.'</a></small>
                                              </div>
                                              <p> '.substr($conteudo,0,226).'...</p>
                                              <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="readmore" title="">Continuar lendo &rightarrow;</a>
                                          </div>
                                      </div>
                                      <!-- end tpic-desc -->

                                      <footer class="topic-footer clearfix">
                                          <div class="pull-left">';
                                          
                                          
                                          if($db->f("tags") != "")
                                          {
                                              $listagem_artigos .='<ul class="list-inline tags">';

                                             for($ta = 0; $ta < count($tags); $ta++)
                                             {

                                                $listagem_artigos .='<li><a href="'.ABS_LINK.'artigos/tag/'.$tags[$ta].'">'.$tags[$ta].'</a></li>';

                                             }
                                                          
                                          $listagem_artigos .='</ul>';
                                        }
                                           $listagem_artigos .='<!-- end tags -->
                                          </div>

                                          <div class="pull-right">
                                              <div class="customshare">
                                              </div>
                                          </div>
                                      </footer>
                                      <!-- end topic -->
                                  </article>
                                 <!-- ITEM -->';


                     $listagem_artigos .= '</div>';
                     
                     
                     if($i <= 5)
                     {

                        $listagem_artigos_recentes .= '<div class="list-group-item">
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'artigos/artigo/'.$slug.'">'.$db->f("titulo").'</a></h3>
                                                                   <small>Em '.$categoria.'</small>
                                                                   <small>'.$dataCadastro.'</small>
                                                                   <small>por '.$nome_usuario.'</small>
                                                               </header>
                                                           </div>
                                                       </div><div class="list-group-separator"></div>';
                     }
                     
                     
                     $db->next_record();
                  }
                  
         
         
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('txt_tag',"");
			$GLOBALS["base"]->template->set_var('listagem_artigos_recentes',$listagem_artigos_recentes);
			$GLOBALS["base"]->template->set_var('listagem_artigos',$listagem_artigos);
		   $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
   function artigo()
   {
			@session_start();
			$db = new db();
         $db2 = new db();
         $db4 = new db();

         $_SESSION['pagina'] = "artigo";
         
         $slug = $this->blockrequest($_REQUEST['id']);
			
               $sql = "SELECT artigos.id AS artigo_id, 
                       artigos.titulo AS titulo, 
                       artigos.video AS video, 
                       artigos.slug AS slug, 
                       artigos.conteudo AS conteudo, 
                       artigos.imagem_destaque AS imagem_destaque, 
                       artigos.categoria_id AS categoria_id, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       usuarios.nome AS nome_usuario, 
                       artigos.usuario_id AS autor,
                       artigos.likes AS total_curtidas,
                       artigos.tags AS tags
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id 
                       AND artigos.slug = '".$slug."' ";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
				  
				  if($db->num_rows() == 0)
				  	header("Location: ".ABS_LINK."home/naoencontrado");

                     $artigo_id = $db->f('artigo_id');
                     $titulo = $db->f('titulo');
                     $video = $db->f('video');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $nome_usuario = $db->f('nome_usuario');
                     $conteudo = $db->f('conteudo');
                     $cateogira_id = $db->f('cateogira_id');
                     $autor = $db->f('autor');
                     $total_curtidas = $db->f('total_curtidas');
                     $tagsArray = explode(",", $db->f("tags"));
                     

                     if($db->f("tags") != "")
                     {
                         $tags .='<ul class="list-inline tags">';

                        for($ta = 0; $ta < count($tagsArray); $ta++)
                        {

                           $tags .='<li><a href="'.ABS_LINK.'artigos/'.$categoria_id.'">'.$tagsArray[$ta].'</a></li>';

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
                     
                     
         $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$artigo_id." ";
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
                                                <input type="hidden" name="contexto_id" value="'.$artigo_id.'">
                                                <input type="hidden" name="comentario_tipo" value="1">
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

         
               $sql = "SELECT artigos.titulo AS titulo, 
                       artigos.slug AS slug, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       usuarios.nome AS nome_usuario 
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id 
                       ORDER BY artigos.id DESC LIMIT 0,5";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                  for($i = 0; $i < $db->num_rows(); $i++)
                  {
                     
                     $titulo2 = $db->f('titulo');
                     $slug2 = $db->f('slug');
                     $dataCadastro2 = $db->f('dataCadastro');
                     $categoria2 = $db->f('categoria');
                     $nome_usuario2 = $db->f('nome_usuario');
                     
                     $listagem_artigos_recentes .= '<div class="list-group-item">
                                                        <div class="row-topic">
                                                            <header class="topic-title clearfix">
                                                                <h3><a href="'.ABS_LINK.'artigos/artigo/'.$slug2.'">'.$titulo2.'</a></h3>
                                                                <small>Em '.$categoria2.'</small>
                                                                <small>'.$dataCadastro2.'</small>
                                                                <small>por '.$nome_usuario2.'</small>
                                                            </header>
                                                        </div>
                                                    </div><div class="list-group-separator"></div>';
                     
                     $db->next_record();
                  }
            
            
         $listagem_comentarios = $this->getComentarios(1,0,0,$slug,0,"");
         
         
         

         
                          if(isset($_SESSION['logado']))
                          {
                             
                             
                              // Verifica se o usuário que está logado curtiu, descurtiu ou marcou o comentário               
                              $sql4 = "SELECT curtiu, descurtiu, bookmark FROM artigos_usuarios_curtidas_bookmarks
                                      WHERE usuario_id = ".$_SESSION['id']." AND artigo_id = ".$artigo_id." ";               
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
                                                       <a '.$likeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'home/likeArtigo/'.$artigo_id.'" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                           <i '.$likeCurtidoIconColor.' class="material-icons">thumb_up</i>
                                                       </a>
                                                       <a '.$deslikeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'home/deslikeArtigo/'.$artigo_id.'" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                           <i '.$deslikeCurtidoIconColor.' class="material-icons">thumb_down</i>
                                                       </a>
                                                       <a '.$bookmarkFeito.' class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'home/bookmarkArtigo/'.$artigo_id.'" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                           <i '.$bookmarkFeitoIconColor.' class="material-icons">bookmark_border</i>
                                                       </a>';


                                    if($_SESSION['id'] == $autor)
                                    {
                                                      $box_social .= ' <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'perfil/edtArtigo/'.$artigo_id.'" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                           <i class="material-icons">create</i>
                                                       </a>
                                                       <a class="btn btn-default btn-fab btn-fab-mini" onclick="return(confirm(\'Deseja excluir o artigo?\'))" href="'.ABS_LINK.'perfil/delArtigo/'.$artigo_id.'" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                                     <i class="material-icons">delete</i>
                                                            </a>';
                                    }


                                    $box_social .= '</div></div>
                                 <!-- end left -->
                                 <div class="pull-right">
                                     <div class="customshare">
                                         <div class="list">
                                             <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                 <ul class="list-inline">
                                                     <li><a target="_blank" href="https://wa.me/?text='.urlencode($titulo.' - '.$conteudo.' - Compartilhado via bibliaparacasais.com.br').'" class="wat"><i class="fa fa-whatsapp"></i></a></li>
                                                     <li><a href="javascript:void(0);" class="fb" onclick="shareFacebook(\'https://www.bibliaparacasais.com.br\',\'.$conteudo.\');"><i class="fa fa-facebook"></i></a></li>
                                                     <li><a href="http://twitter.com/share?text='.substr($titulo.' - '.$conteudo,0,140).'&url=https://www.bibliaparacasais.com.br&counturl=URL&via='.$nome_usuario.'" target="_blank"" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </footer>
                             <!-- ITEM FIM -->';
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
                          

                          
         // Video do Youtube
                  if(strpos($video, "youtube") || strpos($video, "youtu"))
                  {
                        if($video != "" && strlen($video) > 5)
                        {

                           $videoid = explode("v=",$video);
                            $videoid = $videoid[1];
                           $videoid = explode("&",$videoid);
                           $videoid = $videoid[0];


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
         $GLOBALS["base"]->template->set_var('tags',$tags);
         $GLOBALS["base"]->template->set_var('total_curtidas',$total_curtidas);
         $GLOBALS["base"]->template->set_var('box_social',$box_social);
         $GLOBALS["base"]->template->set_var('listagem_artigos_recentes',$listagem_artigos_recentes);
         $GLOBALS["base"]->template->set_var('box_comentar_post',$box_comentar_post);
			$GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
			$GLOBALS["base"]->template->set_var('artigo_id',$artigo_id);
			$GLOBALS["base"]->template->set_var('titulo',$titulo);
			$GLOBALS["base"]->template->set_var('slug',$slug);
			$GLOBALS["base"]->template->set_var('imagem_destaque',$imagem_destaque);
			$GLOBALS["base"]->template->set_var('dataCadastro',$dataCadastro);
			$GLOBALS["base"]->template->set_var('categoria',$categoria);
			$GLOBALS["base"]->template->set_var('nome_usuario',$nome_usuario);
			$GLOBALS["base"]->template->set_var('conteudo',nl2br($conteudo));
			$GLOBALS["base"]->template->set_var('categoria_id',$categoria_id);
			$GLOBALS["base"]->template->set_var('total_comentarios',$total_comentarios);
		   $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'artigo');
			$GLOBALS["base"]->template = new template();
			$this->footer();
      
   }
   
   
   // Método que pesquisa artigos por TAG
	public function tag()
	{
    		@session_start();
			$db = new db();
			$db2 = new db();
	
         $_SESSION['pagina'] = "artigo";
         $_SESSION['titulo_pagina'] = "Artigos";
         
         $tags_buscadas = $this->blockrequest($_REQUEST['id']);
			

         
               $sql = "SELECT artigos.id AS artigo_id, 
                       artigos.titulo AS titulo, 
                       artigos.slug AS slug, 
                       artigos.conteudo AS conteudo, 
                       artigos.imagem_destaque AS imagem_destaque, 
                       artigos.categoria_id AS categoria_id, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       artigos.tags AS tags, 
                       usuarios.nome AS nome_usuario 
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id
                       AND artigos.tags LIKE '%".$tags_buscadas."%'
                       ORDER BY artigos.id DESC";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                  for($i = 0; $i < $db->num_rows(); $i++)
                  {

                     $artigo_id = $db->f('artigo_id');
                     $titulo = $db->f('titulo');
                     $slug = $db->f('slug');
                     $imagem_destaque = $db->f('imagem_destaque');
                     $dataCadastro = $db->f('dataCadastro');
                     $categoria = $db->f('categoria');
                     $nome_usuario = $db->f('nome_usuario');
                     $conteudo = $db->f('conteudo');
                     $categoria_id = $db->f('categoria_id');
                     $tags = $db->f('tags');
                     
                     $tags = explode(",",$tags);


                     $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$artigo_id." ";
                     $db2->query($sql2,__LINE__,__FILE__);
                     $db2->next_record();
                     $total_comentarios = $db2->f('total_comentarios');

                     $listagem_artigos .= '<div class="post_unico" >';


                     $listagem_artigos .= '<!-- ITEM --><article class="well clearfix"><div class="topic-desc row-fluid clearfix">';

                     if($imagem_destaque != "")
                        $listagem_artigos .='<div class="col-sm-4"><img src="'.$imagem_destaque.'" alt="" class="img-responsive img-thumbnail"></div>';

                                          $listagem_artigos .= '<div class="col-sm-8">
                                              <h4><a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" title="'.$titulo.'">'.$titulo.'</a></h4>
                                              <div class="blog-meta clearfix">
                                                  <small>'.$dataCadastro.'</small>
                                                  <small><a href="javascript:void(0)">'.$total_comentarios.' Coment&aacute;rios</a></small>
                                                  <small>em <a href="javascript:void(0)">'.$categoria.'</a></small>
                                                  <small>por <a href="javascript:void(0)"> '.$nome_usuario.'</a></small>
                                              </div>
                                              <p> '.substr($conteudo,0,226).'...</p>
                                              <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="readmore" title="">Continuar lendo &rightarrow;</a>
                                          </div>
                                      </div>
                                      <!-- end tpic-desc -->

                                      <footer class="topic-footer clearfix">
                                          <div class="pull-left">';
                                          
                                          
                                          if($db->f("tags") != "")
                                          {
                                              $listagem_artigos .='<ul class="list-inline tags">';

                                             for($ta = 0; $ta < count($tags); $ta++)
                                             {

                                                $listagem_artigos .='<li><a href="'.ABS_LINK.'artigos/tag/'.$tags[$ta].'">'.$tags[$ta].'</a></li>';

                                             }
                                                          
                                          $listagem_artigos .='</ul>';
                                        }
                                           $listagem_artigos .='<!-- end tags -->
                                          </div>

                                          <div class="pull-right">
                                              <div class="customshare">
                                              </div>
                                          </div>
                                      </footer>
                                      <!-- end topic -->
                                  </article>
                                 <!-- ITEM -->';


                     $listagem_artigos .= '</div>';
                     
                     
                     if($i <= 5)
                     {

                        $listagem_artigos_recentes .= '<div class="list-group-item">
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'artigos/artigo/'.$slug.'">'.$db->f("titulo").'</a></h3>
                                                                   <small>Em '.$categoria.'</small>
                                                                   <small>'.$dataCadastro.'</small>
                                                                   <small>por '.$nome_usuario.'</small>
                                                               </header>
                                                           </div>
                                                       </div><div class="list-group-separator"></div>';
                     }
                     
                     
                     $db->next_record();
                  }
                  
         
         
			$this->cabecalho();
         
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('txt_tag',"para \"".$tags_buscadas."\"");
			$GLOBALS["base"]->template->set_var('listagem_artigos_recentes',$listagem_artigos_recentes);
			$GLOBALS["base"]->template->set_var('listagem_artigos',$listagem_artigos);
		   $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
}
	
   ?>