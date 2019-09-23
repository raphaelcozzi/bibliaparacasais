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
         
         if(isset($_REQUEST['id']))
         {
            
            
            $inicio = 0;

            if(!isset($_SESSION['mais_artigos']))
               $_SESSION['mais_artigos'] = 0;


            $_SESSION['mais_artigos'] = $_SESSION['mais_artigos']+4;


            $limite =  $_SESSION['mais_artigos'];
            
         }
         else 
         {
            $inicio = 0;
            $limite = 4;
         }


         

         $listagem_artigos = '';
         
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
                       ORDER BY artigos.id DESC LIMIT ".$inicio.",".$limite." ";
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

                    // $listagem_artigos .= '<div class="post_unico">';
                      $listagem_artigos .= '<div>';


                                          $listagem_artigos .= '<div class="timeline-item">
                         <i class="fa fa-sticky-note bg-facebook shadow-large timeline-icon"></i>
                         <div class="timeline-item-content-full round-small">
                            <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'">';

                      if($imagem_destaque != "")
                         $listagem_artigos .= '<img data-src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" alt="'.$titulo.'" src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" class="preload-image responsive-image"></a>';

                      $listagem_artigos .= '<h5 class="thin center-text">
                               <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'"> <strong>'.$titulo.'</strong></a>
                            </h5><small>'.substr($conteudo,0,226).'...</small>
                            <br><br>
                            <small>Em '.$dataCadastro.' | '.$total_comentarios.' Comentários | em '.$categoria.' | por '.$nome_usuario.'</small>';

                      if($db->f("tags") != "")
                      {
                         for($ta = 0; $ta < count($tags); $ta++)
                         {
                            $listagem_artigos .= '<a href="'.ABS_LINK.'artigos/tag/'.$tags[$ta].'">#'.$tags[$ta].'</a>  ';
                         }
                    }                            

                   $listagem_artigos .= '<a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="button button-xs button-center-large button-round-large bg-facebook top-20 bottom-10">leia mais</a></div>
                    </div>';


                     $listagem_artigos .= '</div>';
                     
                     
                     
                     $db->next_record();
                  }
                  
                // CATEGORIAS DE ARTIGOS

                  $sql = "SELECT artigos_categorias.titulo AS titulo,
                  artigos_categorias.imagem AS imagem,
                  artigos_categorias.id AS id_categoria 
                  FROM artigos_categorias 
                  GROUP BY artigos_categorias.id
                  ORDER BY id DESC";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
                  
                  $nc = 0;

                  for($i = 0; $i < $db->num_rows(); $i++)
                  {
                     $titulo = $db->f("titulo");
                     $imagem = $db->f("imagem");
                     $id_categoria = $db->f("id_categoria");
                     $slug = $db->f("slug");
                     
                     $numcor = $nc+1;
                     if($numcor >= 10)
                        $nc = 0;
                     
                     
                     if($db->f("imagem") != "" && strlen($db->f("imagem")) > 10)
                        $imagem_destaque = LINK_ORIGINAL.'/'.$db->f("imagem");
                     else
                        $imagem_destaque = 'images/pictures/cat_curso'.($numcor).'.jpg';
                     
                     
                     $listagem_categorias_artigos .= ' <div>
                      <div class="caption round-medium shadow-huge bottom-15"  style="height:210px;">
                          <div class="caption-bottom">
                              <h3 class="color-white center-text bolder bottom-0">'.$titulo.'</h3>

                              <a href="'.ABS_LINK.'artigos/categoria/'.$id_categoria.'" class="button button-full left-10 right-10 button-xxs button-round-large bg-highlight shadow-large bottom-10">ver artigos</a>
                          </div>
                          <div class="caption-overlay bg-gradient"></div>
                          <img class="caption-image owl-lazy" data-src="'.$imagem_destaque.'"  style="width:auto !important; height:100% !important; overflow: auto !important;">
                      </div>
                  </div>';
                     
                     $nc++;

                     $db->next_record();
                  }
                  
                  $listagem_artigos .= '<center>
                  <a href="'.ABS_LINK.'artigos/main/1" id="loadMore">Carregar Mais</a>
         </center>';
                  
                  
                  
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('txt_tag',"");
			$GLOBALS["base"]->template->set_var('emCategoria',"");
			$GLOBALS["base"]->template->set_var('listagem_categorias_artigos',$listagem_categorias_artigos);
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
                       artigos.slug AS slug, 
                       artigos.conteudo AS conteudo, 
                       artigos.imagem_destaque AS imagem_destaque, 
                       artigos.categoria_id AS categoria_id, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       usuarios.nome AS nome_usuario, 
                       artigos.usuario_id AS autor,
                       artigos.likes AS total_curtidas,
                       artigos.tags AS tags,
                       artigos.video AS video
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id 
                       AND artigos.slug = '".$slug."' ";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();

                     $artigo_id = $db->f('artigo_id');
                     $titulo = $db->f('titulo');
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
                     $video= $db->f('video');
                     

                     if($db->f("tags") != "")
                     {
                        for($ta = 0; $ta < count($tagsArray); $ta++)
                        {

                           $tags .='<a href="'.ABS_LINK.'artigos/'.$categoria_id.'">#'.$tagsArray[$ta].'</a>&nbsp;';
                        }
                   }
                   else
                   {
                     $tags .='';
                   }
                     
                     
                     
         $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$artigo_id." ";
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         $total_comentarios = $db2->f('total_comentarios');
			
            if(isset($_SESSION['logado']))
            {
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
                                                <input type="hidden" name="contexto_id" value="'.$artigo_id.'">
                                                <input type="hidden" name="comentario_tipo" value="1">
                                                <input type="hidden" name="comentario_id_referencia" value="0">
                                                    <textarea name="comentario" style="width:100%; border:1px solid #e4e4e4; height:100px;" rows="3" id="textArea" required ></textarea>
                                                    <a href="javascript:void(0);" onClick="document.comentar_post.submit();" class="button button-xs button-center-large button-round-large bg-facebook top-20 bottom-10">Comentar</a>
                                                   </form>
                                    </div><!-- end row -->
                                </div><!-- end answer -->
                                <!-- end topic-meta -->                              
               </div><br><br>';
            }
           
              // $_SESSION['titulo_pagina'] = $titulo;
               $_SESSION['titulo_pagina'] = "Artigo";

         
               
            
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

                              $likeCurtido = 'bg-dark1-light';
                              $deslikeCurtido = 'bg-dark1-light';
                              $bookmarkFeito = 'bg-dark1-light';

                              if($like == "1")
                                 $likeCurtido = 'bg-twitter regularbold';

                              if($deslike == "1")
                                 $deslikeCurtido = 'bg-twitter regularbold';

                              if($bookmark == "1")
                                 $bookmarkFeito = 'bg-red2-dark';

                              
                              
                              $box_social .= '<!-- CURTIR --><a href="'.ABS_LINK.'home/likeArtigo/'.$artigo_id.'" class=" icon icon-xs icon-round '.$likeCurtido.'"><i class="fa fa-thumbs-up"></i></a>
                                             <!-- DESCURTIR --><a href="'.ABS_LINK.'home/deslikeArtigo/'.$artigo_id.'" class=" icon icon-xs icon-round '.$deslikeCurtido.'"><i class="fa fa-thumbs-down"></i></a>
                                             <!-- SALVAR --><a href="'.ABS_LINK.'home/bookmarkArtigo/'.$artigo_id.'" class=" icon icon-xs icon-round '.$bookmarkFeito.'"><i class="fa fa-bookmark"></i></a>';
                             


                              if($_SESSION['id'] == $autor)
                              {
                                 $box_social .= '<!-- EXCLUIR --><a onclick="return(confirm(\'Deseja excluir o artigo?\'))" href="'.ABS_LINK.'perfil/delArtigo/'.$artigo_id.'" class=" icon icon-xs icon-round bg-red2-dark"><i class="fa fa-trash"></i></a>
                                                 <!-- EDITAR --><a href="'.ABS_LINK.'perfil/edtArtigo/'.$artigo_id.'" class="icon icon-xs icon-round bg-twitter"><i class="fa fa-edit"></i></a>';
                              }
                                       
                                       
                              $box_social .= '<div style="float:right;"><!-- WHATSAPP --><a target="_blank" href="whatsapp://send?text='.urlencode($titulo.' - '.$conteudo.' - Compartilhado via bibliaparacasais.com.br').'" class="icon icon-xs icon-round bg-whatsapp regularbold"><i class="fab fa-whatsapp"></i></a>
                                      <!-- FACEBOOK --><a href="javascript:void(0);" onclick="shareFacebook(\'https://www.bibliaparacasais.com.br\',\'.$conteudo.\');" class="shareToFacebook icon icon-xs icon-round bg-facebook regularbold"><i class="fab fa-facebook-f"></i></a>
                                      <!-- TWITTER --><a href="http://twitter.com/share?text='.substr($titulo.' - '.$conteudo,0,140).'&url=https://www.bibliaparacasais.com.br&counturl=URL&via='.$nome_usuario.'" target="_blank" class="shareToTwitter icon icon-xs icon-round bg-twitter regularbold"><i class="fab fa-twitter"></i></a></div>';

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


                           $_SESSION['videoid'] = '<iframe class="video_small"   id="video_small" src="https://www.youtube.com/embed/'.$videoid.'?controls=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                           $_SESSION['videoidfull'] = '<iframe class="video_full"    id="video_full"  style="transform: rotate(90deg); -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); margin-top: 115px; margin-left: -110px;" width="560" height="60%" src="https://www.youtube.com/embed/'.$videoid.'?controls=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

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


                           $_SESSION['videoid'] = '<iframe class="video_small"   id="video_small" src="https://player.vimeo.com/video/'.$videoid.'?autoplay=1&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe><script src="https://player.vimeo.com/api/player.js"></script>';

                          $_SESSION['videoidfull'] =  '<iframe class="video_full"    id="video_full" src="https://player.vimeo.com/video/'.$videoid.'?autoplay=1&title=0&byline=0&portrait=0" style=" margin-top: 115px; margin-left: -110px; transform: rotate(90deg); -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); " width="560" height="60% frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe><script src="https://player.vimeo.com/api/player.js"></script>';


                          $conteudo .= '<a href="#" data-menu="menu-video"><img src="images/play.png" style="width:100%; margin-top:10px; position:absolute; z-index:9999999;"><img src="https://i.vimeocdn.com/video/'.$videoid.'.jpg"` alt=""  width="100%" /></a>';
                        }

                  }         
         
                          
                          
         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
         $GLOBALS["base"]->template->set_var('tags',$tags);
         $GLOBALS["base"]->template->set_var('total_curtidas',$total_curtidas);
         $GLOBALS["base"]->template->set_var('box_social',$box_social);
         $GLOBALS["base"]->template->set_var('box_comentar_post',$box_comentar_post);
			$GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
			$GLOBALS["base"]->template->set_var('artigo_id',$artigo_id);
			$GLOBALS["base"]->template->set_var('titulo',$titulo);
			$GLOBALS["base"]->template->set_var('slug',$slug);
			$GLOBALS["base"]->template->set_var('imagem_destaque',LINK_ORIGINAL.'/'.$imagem_destaque); 
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
   
   function categoria()
	{
    		@session_start();
			$db = new db();
			$db2 = new db();
	
         $_SESSION['pagina'] = "artigo";
         $_SESSION['titulo_pagina'] = "Artigos";
         
         $id_categoria = $_REQUEST['id'];
         
         
                  $sql = "SELECT artigos_categorias.titulo AS categoriaTitulo FROM artigos_categorias WHERE artigos_categorias.id = ".$id_categoria." ";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
                  $emCategoria = "em: <br>".$db->f("categoriaTitulo");
			

         
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
                       AND artigos.categoria_id = ".$id_categoria."
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


                                          $listagem_artigos .= '<div class="timeline-item">
                         <i class="fa fa-sticky-note bg-facebook shadow-large timeline-icon"></i>
                         <div class="timeline-item-content-full round-small">
                            <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'">';

                      if($imagem_destaque != "")
                         $listagem_artigos .= '<img data-src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" alt="'.$titulo.'" src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" class="preload-image responsive-image"></a>';

                      $listagem_artigos .= '<h5 class="thin center-text">
                               <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'"> <strong>'.$titulo.'</strong></a>
                            </h5><small>'.substr($conteudo,0,226).'...</small>
                            <br><br>
                            <small>Em '.$dataCadastro.' | '.$total_comentarios.' Comentários | em '.$categoria.' | por '.$nome_usuario.'</small>';

                      if($db->f("tags") != "")
                      {
                         for($ta = 0; $ta < count($tags); $ta++)
                         {
                            $listagem_artigos .= '<a href="'.ABS_LINK.'artigos/tag/'.$tags[$ta].'">#'.$tags[$ta].'</a>  ';
                         }
                    }                            

                   $listagem_artigos .= '<a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="button button-xs button-center-large button-round-large bg-facebook top-20 bottom-10">leia mais</a></div>
                    </div>';


                     $listagem_artigos .= '</div>';
                     
                     
                     $db->next_record();
                  }
                  
                // CATEGORIAS DE ARTIGOS

                  $sql = "SELECT artigos_categorias.titulo AS titulo,
                  artigos_categorias.id AS id_categoria 
                  FROM artigos_categorias 
                  GROUP BY artigos_categorias.id
                  ORDER BY id DESC";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
                  
                  $nc = 0;

                  for($i = 0; $i < $db->num_rows(); $i++)
                  {
                     $titulo = $db->f("titulo");
                     $id_categoria = $db->f("id_categoria");
                     $slug = $db->f("slug");
                     
                     $numcor = $nc+1;
                     if($numcor >= 10)
                        $nc = 0;
                     
                     $listagem_categorias_artigos .= ' <div>
                      <div class="caption round-medium shadow-huge bottom-15">
                          <div class="caption-bottom">
                              <h3 class="color-white center-text bolder bottom-0">'.$titulo.'</h3>

                              <a href="'.ABS_LINK.'artigos/categoria/'.$id_categoria.'" class="button button-full left-10 right-10 button-xxs button-round-large bg-highlight shadow-large bottom-10">ver artigos</a>
                          </div>
                          <div class="caption-overlay bg-gradient"></div>
                          <img class="caption-image owl-lazy" data-src="images/pictures/cat_curso'.($numcor).'.jpg">
                      </div>
                  </div>';
                     
                     $nc++;

                     $db->next_record();
                  }
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('txt_tag',"");
			$GLOBALS["base"]->template->set_var('emCategoria',$emCategoria);
			$GLOBALS["base"]->template->set_var('listagem_categorias_artigos',$listagem_categorias_artigos);
			$GLOBALS["base"]->template->set_var('listagem_artigos',$listagem_artigos);
		   $GLOBALS["base"]->write_design_specific('artigos.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
   
}
	
   ?>