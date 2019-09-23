<?php
require_once("modules/home.php");  

class pesquisa extends home
{
	public function main()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "pesquisa";
         $_SESSION['titulo_pagina'] = "Pesquisa";
			
			if(!isset($_REQUEST['q']))
         {
            $titulo_resultado_pesquisa = '';
            $listagem_pesquisa = '';
            $q = '';
            $bibliaSelected = " ";
            $artigosSelected = " checked='checked' ";
            $botao_mais = '';
         }
         else
         {
            
            $botao_mais = '<ul class="pager">
                                <li> <a href="#" id="loadMore">Carregar Mais</a></li>
                            </ul>';
            
               $titulo_resultado_pesquisa = '<div class="container">
                        <div class="topic-desc row-fluid clearfix" style="background-color: #FFFFFF; margin-top: 15px;">
                         <div class="col-md-12">
                            <h2>RESULTADO DA PESQUISA</h2>
                         </div>

                        </div>
                  </div>';
            
            $termo = $this->blockrequest($_REQUEST['q']);
            $q = $termo;
            

            if($_REQUEST['tipo'] == "artigos" || !isset($_REQUEST['tipo']))
            {
               $bibliaSelected = " ";
               $artigosSelected = " checked='checked' ";
               $artigos = "1";
               $biblia = "0";
            }
            else
            {
               $bibliaSelected = " checked='checked' ";
               $artigosSelected = " ";
               $artigos = "0";
               $biblia = "1";
            }
            
            

            // Busca só em artigos
            if($artigos == "1")
            {

               $sql = "SELECT artigos.id AS artigo_id, 
                       artigos.titulo AS titulo, 
                       artigos.slug AS slug, 
                       artigos.conteudo AS conteudo, 
                       artigos.imagem_destaque AS imagem_destaque, 
                       artigos.categoria_id AS categoria_id, 
                       DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') as dataCadastro, 
                       artigos_categorias.titulo AS categoria, 
                       usuarios.nome AS nome_usuario 
                       FROM artigos, artigos_categorias, usuarios 
                       WHERE artigos.categoria_id = artigos_categorias.id 
                       AND artigos.usuario_id = usuarios.id 
                       AND (artigos.titulo LIKE '%".$termo."%' OR artigos.conteudo LIKE '%".$termo."%') 
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
                     $cateogira_id = $db->f('cateogira_id');


                     $sql2 = "SELECT COUNT(id) AS total_comentarios FROM comentarios_contexto_referencia WHERE contexto_id = ".$artigo_id." ";
                     $db2->query($sql2,__LINE__,__FILE__);
                     $db2->next_record();
                     $total_comentarios = $db2->f('total_comentarios');

                     $listagem_pesquisa .= '<div class="post_unico" >';


                     $listagem_pesquisa .= '<!-- ITEM --><article class="well clearfix"><div class="topic-desc row-fluid clearfix">';

                     if($imagem_destaque != "")
                        $listagem_pesquisa .='<div class="col-sm-4"><img src="'.$imagem_destaque.'" alt="" class="img-responsive img-thumbnail"></div>';

                                          $listagem_pesquisa .= '
                                          <div class="col-sm-8">
                                              <h4><a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" title="'.$titulo.'">'.$titulo.'</a></h4>
                                              <div class="blog-meta clearfix">
                                                  <small>'.$dataCadastro.'</small>
                                                  <small><a href="#">'.$total_comentarios.' Coment&aacute;rios</a></small>
                                                  <small>em <a href="#">'.$categoria.'</a></small>
                                                  <small>por <a href="#"> '.$nome_usuario.'</a></small>
                                              </div>
                                              <p> '.substr($conteudo,0,226).'...</p>
                                              <a href="'.ABS_LINK.'artigos/artigo/'.$slug.'" class="readmore" title="">Continuar lendo &rightarrow;</a>
                                          </div>
                                      </div>
                                      <!-- end tpic-desc -->

                                      <footer class="topic-footer clearfix">
                                          <div class="pull-left">
                                              <ul class="list-inline tags">
                                                  <li><a href="'.ABS_LINK.'artigos">Artigos</a></li>
                                                  <li><a href="'.ABS_LINK.'artigos/'.$cateogira_id.'">'.$categoria.'</a></li>
                                              </ul>
                                              <!-- end tags -->
                                          </div>

                                          <div class="pull-right">
                                              <div class="customshare">
                                              </div>
                                          </div>
                                      </footer>
                                      <!-- end topic -->
                                  </article>
                                 <!-- ITEM -->';


                     $listagem_pesquisa .= '</div>';

                     $db->next_record();
                  }
                  
                  
            }


            // Busca só na bíblia
            if($biblia == "1")
            {
               $sql = "SELECT versiculos.ver_id AS ver_id, 
                  versiculos.ver_texto AS ver_texto,
                  versiculos.ver_capitulo,
                  livros.liv_nome AS liv_nome,
                  livros.liv_abreviado AS liv_abreviado
                  FROM versiculos, livros 
                  WHERE versiculos.ver_liv_id = livros.liv_id 
                  AND versiculos.ver_texto LIKE '%".$termo."%' 
                 GROUP BY versiculos.ver_id ORDER BY versiculos.ver_id DESC LIMIT 0,250";
                  $db->query($sql,__LINE__,__FILE__);
                  $db->next_record();
               
                  for($i = 0; $i < $db->num_rows(); $i++)
                  {

                     $ver_id = $db->f('ver_id');
                     $ver_texto = $db->f('ver_texto');
                     $ver_capitulo = $db->f('ver_capitulo');
                     $liv_nome = $db->f('liv_nome');
                     $liv_abreviado = $db->f('liv_abreviado');



                     $listagem_pesquisa .= '<div class="post_unico" >';


                     $listagem_pesquisa .= '<!-- ITEM --><article class="well clearfix"><div class="topic-desc row-fluid clearfix">';

                     $listagem_pesquisa .='<div class="col-sm-4"><img src="images/icon_biblia.jpg" alt="" class="img-responsive img-thumbnail"></div>';

                                          $listagem_pesquisa .= '
                                          <div class="col-sm-8">
                                              <h4><a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'" title="'.$liv_nome.'">'.$liv_nome.' '.$ver_capitulo.'</a></h4>
                                              <div class="blog-meta clearfix">
                                                  <small>em <a href="#">'.$liv_nome.' '.$ver_capitulo.'</a></small>
                                              </div>
                                              <p> '.substr($ver_texto,0,226).'...</p>
                                              <a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'" class="readmore" title="">Continuar lendo &rightarrow;</a>
                                          </div>
                                      </div>
                                      <!-- end tpic-desc -->

                                      <footer class="topic-footer clearfix">
                                          <div class="pull-left">
                                              <ul class="list-inline tags">
                                                  <li><a href="'.ABS_LINK.'artigos">B&iacute;blia</a></li>
                                                  <li><a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'">'.$liv_nome.'</a></li>
                                              </ul>
                                              <!-- end tags -->
                                          </div>

                                          <div class="pull-right">
                                              <div class="customshare">
                                              </div>
                                          </div>
                                      </footer>
                                      <!-- end topic -->
                                  </article>
                                 <!-- ITEM -->';


                     $listagem_pesquisa .= '</div>';

                     $db->next_record();
                  }
            
            }
            
            
            if(isset($_REQUEST['q']) && $db->num_rows() == 0)
            {
               $botao_mais = '';

                  $titulo_resultado_pesquisa = '<div class="container">
                           <div class="topic-desc row-fluid clearfix" style="background-color: #FFFFFF; margin-top: 15px;">
                            <div class="col-md-12">
                               <h2>NADA ENCONTRADO</h2>
                            </div>

                           </div>
                     </div>';
               
            }
               
            
            
         }

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('botao_mais',$botao_mais);
			$GLOBALS["base"]->template->set_var('bibliaSelected',$bibliaSelected);
			$GLOBALS["base"]->template->set_var('artigosSelected',$artigosSelected);
			$GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
			$GLOBALS["base"]->template->set_var('q',$q);
			$GLOBALS["base"]->template->set_var('listagem_pesquisa',$listagem_pesquisa);
			$GLOBALS["base"]->template->set_var('titulo_resultado_pesquisa',$titulo_resultado_pesquisa);
		   $GLOBALS["base"]->write_design_specific('pesquisa.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
}
	
   ?>