<?php
require_once("modules/home.php");  

class livros extends home
{
	public function main()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "livros";
         $_SESSION['titulo_pagina'] = "Livros";
         
          if(!isset($_SESSION['ver_vrs_id']))
            $vrs_id = 2;
          else
             $vrs_id = $_SESSION['ver_vrs_id'];

          switch($vrs_id)
         {
            case 1:
               $sigla = "aa";
            break;

            case 2:
               $sigla = "acf";
            break;

            case 3:
               $sigla = "nvi";
            break;
         
            case 4:
               $sigla = "tb";
            break;

            case 5:
               $sigla = "ol";
            break;

            case 7:
               $sigla = "asv";
            break;

            case 8:
               $sigla = "kjv";
            break;

         }
         
         $sql = "SELECT vrs_nome FROM versoes WHERE vrs_id = ".$vrs_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows() > 0)
         {
            $vrs_nome = $db->f("vrs_nome");

          //  $this->notificacao("Versão da Bíblia alterado para ".$vrs_nome." ", "green");
            //header("Location: ".$origem);
            header("Location: ".ABS_LINK.$sigla);
         }
         else 
         {
            header("Location: ".ABS_LINK);
         }

         
         // Foi alterado, sendo comentado todo o restante do código antigo, para que ao clicar no link "/livros" do menu sempre carregue a sigla da versão na URL, excluindo-se assim o antigo "/livros".
         
         /*
         
			
		$sql = "SELECT liv_id, liv_nome, liv_abreviado FROM livros WHERE liv_tes_id = 1 ORDER BY liv_posicao ASC";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
         $velho_testamento .= '<div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="'.ABS_LINK.'livros/livro/'.$db->f("liv_abreviado").'"><i class="material-icons">description</i> 
                                           '.$db->f("liv_nome").'</a></p>
                                        </div>
                                    </div>';
         
   		$db->next_record();
      }
      
		$sql = "SELECT liv_id, liv_nome, liv_abreviado FROM livros WHERE liv_tes_id = 2 ORDER BY liv_posicao ASC";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
         $novo_testamento .= '<div class="list-group-item">
                                        <div class="row-content">
                                            <p class="list-group-item-heading"><a href="'.ABS_LINK.'livros/livro/'.$db->f("liv_abreviado").'"><i class="material-icons">description</i> 
                                           '.$db->f("liv_nome").'</a></p>
                                        </div>
                                    </div>';
         
   		$db->next_record();
      }
      
      
      
         $sql = "SELECT vrs_nome FROM versoes WHERE vrs_id = ".$_SESSION['ver_vrs_id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $vrs_nome = $db->f("vrs_nome");
			

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

         $GLOBALS["base"]->template->set_var('velho_testamento' ,$velho_testamento);      
         $GLOBALS["base"]->template->set_var('novo_testamento' ,$novo_testamento);      
         $GLOBALS["base"]->template->set_var('versao_atual' ,$vrs_nome);      

         $GLOBALS["base"]->template->set_var('msg2' ,"");
         $GLOBALS["base"]->template->set_var('msg_error' ,"");
         $GLOBALS["base"]->template->set_var("ABS_LINK",ABS_LINK);
         $GLOBALS["base"]->template->set_var("ANALYTICS",ANALYTICS);
         $GLOBALS["base"]->template->set_var('TITULO_SISTEMA' ,TITULO_SISTEMA);
		   $GLOBALS["base"]->write_design_specific('livros.tpl' , 'main');
			//$GLOBALS["base"]->template = new template();
			//$this->footer();
          * 
          * 
          */
	}
   
   function livro()
   {
      @session_start();
      $db = new db();

      $liv_abreviado = $this->blockrequest($_REQUEST['id']);
      $liv_abreviado_titulo = $this->blockrequest($_REQUEST['id']);
      $_SESSION['pagina'] = "livros";
      
      
      @$subid = $this->blockrequest($_REQUEST['subid']);
       
      $sql = "SELECT liv_id, liv_nome FROM livros WHERE liv_abreviado = '".$liv_abreviado."' LIMIT 1";
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      $liv_nome = $db->f("liv_nome");
      $liv_nome_titulo = $liv_nome;
      $liv_id = $db->f("liv_id");
      
      
      if(!isset($_REQUEST['subid'])) // Mostra a view do livro
      {


         $sql = "SELECT ver_capitulo FROM versiculos WHERE ver_liv_id = ".$liv_id." AND ver_vrs_id = ".$_SESSION['ver_vrs_id']." GROUP BY ver_capitulo";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         $itens_linha = 0;

         for($i = 0; $i < $db->num_rows(); $i++)
         {

            $ver_capitulo = $db->f("ver_capitulo");

            if($itens_linha == 0)
            {
               $listagem_capitulos .= '<div style="white-space:nowrap;" id="linha_capitulos">';
            }

               $listagem_capitulos .= '<div style="width:10%; float:left;">
                  <a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'" style="font-size:25px;">'.$ver_capitulo.'</a>
               </div>';

            $itens_linha++;

            if($itens_linha == 10)
            {
               $itens_linha = 0;
               $listagem_capitulos .= '</div>';
            }   

            $db->next_record();

            }
         
         // Últimas Respostas No Livro      
         $sql = "SELECT SUBSTR(comentarios.conteudo,1,30) AS resposta,
         comentarios.id AS id,
         livros.liv_abreviado AS liv_abreviado
         FROM comentarios, comentarios_contexto_referencia, livros
         WHERE comentarios.id = comentarios_contexto_referencia.comentario_id
         AND comentarios_contexto_referencia.contexto_id = livros.liv_id
         AND comentarios.tipo = 2
         AND comentarios.status = 1 
         AND livros.liv_abreviado = '".$liv_abreviado."'
         ORDER BY comentarios.id DESC LIMIT 0,5";   
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
           $liv_abreviado = $db->f("liv_abreviado");
           
           $listagem_ultimas_respostas .= '<li><a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'#'.$db->f("id").'">'.$db->f("resposta").'...</a></li>';

            $db->next_record();
         }
         
         // Comentários Recentes em LIVROS
         $sql = "SELECT SUBSTR(comentarios.conteudo,1,30) AS resposta,
         comentarios.id AS id,
         versiculos.ver_capitulo AS ver_capitulo,
         livros.liv_abreviado AS liv_abreviado,
         livros.liv_nome AS liv_nome,
         usuarios.nome AS nome_usuario
         FROM comentarios, comentarios_contexto_referencia, livros, versiculos, usuarios
         WHERE comentarios.id = comentarios_contexto_referencia.comentario_id
         AND comentarios_contexto_referencia.contexto_id = livros.liv_id
         AND livros.liv_id = versiculos.ver_liv_id
         AND comentarios.usuario_id = usuarios.id
         AND (comentarios.tipo = 2) 
         AND comentarios.status = 1 
         GROUP BY comentarios.id
         ORDER BY comentarios.id DESC LIMIT 0,10";   
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $liv_abreviado = $db->f("liv_abreviado");
            $ver_capitulo = $db->f("ver_capitulo");
            $liv_nome = $db->f("liv_nome");
            $nome_usuario = $db->f("nome_usuario");
         
         $comentarios_recentes .= '<div class="list-group-item">
                                            <div class="row-topic">
                                                <header class="topic-title clearfix">
                                                    <h3><a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'">'.$db->f("resposta").'...</a></h3>
                                                    <small>Em '.$liv_nome.'</small>
                                                    <small>por '.$nome_usuario.'</small>
                                                </header>
                                            </div>
                                        </div><div class="list-group-separator"></div>';
          $db->next_record();
        }
         
            $listagem_comentarios = $this->getComentarios(2,$liv_abreviado_titulo,0,"");
            
            
         $sql = "SELECT versiculos.ver_id AS contexto_id
               FROM livros, versiculos
               WHERE livros.liv_id = versiculos.ver_liv_id
               AND versiculos.ver_capitulo = 1
               AND versiculos.ver_liv_id = 1
               AND versiculos.ver_vrs_id = ".$_SESSION['ver_vrs_id']."
               ORDER BY ver_id ASC LIMIT 1";   
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $contexto_id = $db->f("contexto_id");   
            
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
                                                <input type="hidden" name="contexto_id" value="'.$contexto_id.'">
                                                <input type="hidden" name="comentario_tipo" value="2">
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
            
            $_SESSION['titulo_pagina'] = $liv_nome_titulo;


            $this->cabecalho();                                                                            
            $GLOBALS["base"]->template = new template();
            $GLOBALS["base"]->template->set_var('box_comentar_post',$box_comentar_post);
            $GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
            $GLOBALS["base"]->template->set_var('comentarios_recentes',$comentarios_recentes);
            $GLOBALS["base"]->template->set_var('listagem_ultimas_respostas',$listagem_ultimas_respostas);
            $GLOBALS["base"]->template->set_var('listagem_capitulos',$listagem_capitulos);
            $GLOBALS["base"]->template->set_var('liv_nome',$liv_nome);
            $GLOBALS["base"]->template->set_var('liv_nome_titulo',$liv_nome_titulo);
            $GLOBALS["base"]->write_design_specific('livros.tpl' , 'livro');
            $GLOBALS["base"]->template = new template();
            $this->footer();
      }
      else // Mostra a view dos versículos do capítulo escolhido
      {
         $ver_capitulo = $subid;
         $ver_capitulo_titulo = $ver_capitulo;

         $sql = "SELECT ver_versiculo, ver_texto FROM versiculos 
                WHERE ver_liv_id = ".$liv_id."
                AND ver_vrs_id = ".$_SESSION['ver_vrs_id']." 
                AND ver_capitulo = ".$ver_capitulo." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
             $txt_whatsapp_share = urlencode("'".$db->f('ver_texto')."' - ".$liv_nome." ".$ver_capitulo.":".$db->f('ver_versiculo')." - Visite: https://www.bibliaparacasais.com.br");
            
             $listagem_versiculos .= '<p>'.$db->f('ver_versiculo').' '.$db->f('ver_texto').'<a style="float: right;" href="https://wa.me/?text='.$txt_whatsapp_share.'" target="_blank"><img src="assets/images/wp-share.png"></a></p><hr>';
            
            $db->next_record();
         }
         
         
         // Exceção para Apocalipse
         if($liv_abreviado != "ap")
         {
            $sql = "SELECT liv_nome, liv_abreviado FROM livros 
                     WHERE liv_posicao = (SELECT liv_posicao+1 FROM livros 
                     WHERE liv_abreviado = '".$liv_abreviado."' )";
         }
         else
         {
            $sql = "SELECT liv_nome, liv_abreviado FROM livros 
                     WHERE liv_posicao = 1";
         }
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $proximo_livro = $db->f("liv_nome");
         $proximo_livro_abreviado = $db->f("liv_abreviado");

         // Exceção para Gênesis
         if($liv_abreviado != "gn")
         {
            $sql = "SELECT liv_nome, liv_abreviado FROM livros 
                     WHERE liv_posicao = (SELECT liv_posicao-1 FROM livros 
                     WHERE liv_abreviado = '".$liv_abreviado."' )";
         }
         else
         {
            $sql = "SELECT liv_nome, liv_abreviado FROM livros 
                     WHERE liv_posicao = 66";
         }
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $livro_anterior = $db->f("liv_nome");
         $livro_anterior_abreviado = $db->f("liv_abreviado");

         // Últimas Respostas No Capítulo
         $sql = "SELECT SUBSTR(comentarios.conteudo,1,30) AS resposta,
               comentarios.id AS id,
               versiculos.ver_capitulo AS ver_capitulo,
               livros.liv_abreviado AS liv_abreviado
               FROM comentarios, comentarios_contexto_referencia, livros, versiculos
               WHERE comentarios.id = comentarios_contexto_referencia.comentario_id
               AND comentarios_contexto_referencia.contexto_id = livros.liv_id
               AND livros.liv_id = versiculos.ver_liv_id
               AND comentarios.tipo = 3
               AND comentarios.status = 1
               AND versiculos.ver_capitulo = ".$ver_capitulo."
               AND versiculos.ver_liv_id = ".$liv_id."
              GROUP BY comentarios.id 
              ORDER BY comentarios.id DESC LIMIT 0,5";   
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $liv_abreviado = $db->f("liv_abreviado");
            $ver_capitulo = $db->f("ver_capitulo");
            
           $listagem_ultimas_respostas .= '<li><a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'#'.$db->f("id").'">'.$db->f("resposta").'...</a></li>';

            $db->next_record();
         }
         
         
         // Comentários Recentes em CAPÍTULOS
         $sql = "SELECT SUBSTR(comentarios.conteudo,1,30) AS resposta,
         comentarios.id AS id,
         versiculos.ver_capitulo AS ver_capitulo,
         livros.liv_abreviado AS liv_abreviado,
         livros.liv_nome AS liv_nome,
         usuarios.nome AS nome_usuario
         FROM comentarios, comentarios_contexto_referencia, livros, versiculos, usuarios
         WHERE comentarios.id = comentarios_contexto_referencia.comentario_id
         AND comentarios_contexto_referencia.contexto_id = versiculos.ver_id
         AND livros.liv_id = versiculos.ver_liv_id
         AND comentarios.usuario_id = usuarios.id
         AND (comentarios.tipo = 3) 
         AND comentarios.status = 1 
         GROUP BY comentarios.id
         ORDER BY comentarios.id DESC LIMIT 0,10";   
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

         for($i = 0; $i < $db->num_rows(); $i++)
         {
            $liv_abreviado = $db->f("liv_abreviado");
            $ver_capitulo = $db->f("ver_capitulo");
            $liv_nome = $db->f("liv_nome");
            $nome_usuario = $db->f("nome_usuario");
            
         
         $comentarios_recentes .= '<div class="list-group-item">
                                            <div class="row-topic">
                                                <header class="topic-title clearfix">
                                                    <h3><a href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'">'.$db->f("resposta").'...</a></h3>
                                                    <small>Em '.$liv_nome.'</small>
                                                    <small>Cap&iacute;tulo '.$ver_capitulo.'</small>
                                                    <small>por '.$nome_usuario.'</small>
                                                </header>
                                            </div>
                                        </div><div class="list-group-separator"></div>';
          $db->next_record();
        }

         $listagem_comentarios = $this->getComentarios(3,$liv_abreviado_titulo,$ver_capitulo_titulo,"");

         
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
                                                <input type="hidden" name="contexto_id" value="'.$ver_capitulo_titulo.'">
                                                <input type="hidden" name="comentario_tipo" value="3">
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
         $_SESSION['titulo_pagina'] = $liv_nome_titulo." ".$ver_capitulo_titulo;
         
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();
         $GLOBALS["base"]->template->set_var('box_comentar_post',$box_comentar_post);
         $GLOBALS["base"]->template->set_var('listagem_comentarios',$listagem_comentarios);
         $GLOBALS["base"]->template->set_var('comentarios_recentes',$comentarios_recentes);
         $GLOBALS["base"]->template->set_var('listagem_ultimas_respostas',$listagem_ultimas_respostas);
         $GLOBALS["base"]->template->set_var('livro_anterior_abreviado',$livro_anterior_abreviado);
         $GLOBALS["base"]->template->set_var('livro_anterior',$livro_anterior);
         $GLOBALS["base"]->template->set_var('proximo_livro_abreviado',$proximo_livro_abreviado);
         $GLOBALS["base"]->template->set_var('proximo_livro',$proximo_livro);
         $GLOBALS["base"]->template->set_var('listagem_versiculos',$listagem_versiculos);
         $GLOBALS["base"]->template->set_var('liv_nome',$liv_nome);
         $GLOBALS["base"]->template->set_var('liv_nome_titulo',$liv_nome_titulo);
         $GLOBALS["base"]->template->set_var('liv_abreviado',$liv_abreviado);
         $GLOBALS["base"]->template->set_var('liv_abreviado_titulo',$liv_abreviado_titulo);
         $GLOBALS["base"]->template->set_var('ver_capitulo',$ver_capitulo);
         $GLOBALS["base"]->template->set_var('ver_capitulo_titulo',$ver_capitulo_titulo);
         $GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->write_design_specific('livros.tpl' , 'capitulo');
         $GLOBALS["base"]->template = new template();
         $this->footer();
         
      }
      
      
   }
   
   
}
	
   ?>