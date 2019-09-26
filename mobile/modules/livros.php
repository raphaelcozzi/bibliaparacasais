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
			
		$sql = "SELECT liv_id, liv_nome, liv_abreviado FROM livros WHERE liv_tes_id = 1 ORDER BY liv_posicao ASC";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
         $velho_testamento .= '<li class="versiculo"><a onClick="javascript:location=\''.ABS_LINK.'livros/livro/'.$db->f("liv_abreviado").'\';" href="'.ABS_LINK.'livros/livro/'.$db->f("liv_abreviado").'">'.$db->f("liv_nome").'<i class="fa fa-angle-right"></i></a></li>';
         
   		$db->next_record();
      }
      
		$sql = "SELECT liv_id, liv_nome, liv_abreviado FROM livros WHERE liv_tes_id = 2 ORDER BY liv_posicao ASC";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
         
         $novo_testamento .= '<li class="versiculo"><a onClick="javascript:location=\''.ABS_LINK.'livros/livro/'.$db->f("liv_abreviado").'\';" href="'.ABS_LINK.'livros/livro/'.$db->f("liv_abreviado").'">'.$db->f("liv_nome").'<i class="fa fa-angle-right"></i></a></li>';
         
         
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
			$GLOBALS["base"]->template = new template();
			$this->footer();
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

            $listagem_capitulos .= '<li class="versiculo"><a onClick="javascript:location=\''.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'\'" href="'.ABS_LINK.'livros/livro/'.$liv_abreviado.'/'.$ver_capitulo.'">'.  $liv_nome_titulo.' '.$ver_capitulo.'<i class="fa fa-angle-right"></i></a></li>';
               

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
                                                <input type="hidden" name="contexto_id" value="'.$contexto_id.'">
                                                <input type="hidden" name="comentario_tipo" value="2">
                                                <input type="hidden" name="comentario_id_referencia" value="0">
                                                    <textarea name="comentario" style="width:100%; border:1px solid #e4e4e4; height:100px;" rows="3" id="textArea" required ></textarea>
                                                    <a href="javascript:void(0);" onClick="document.comentar_post.submit();" class="button button-xs button-center-large button-round-large bg-facebook top-20 bottom-10">Comentar</a>
                                                   </form>
                                    </div><!-- end row -->
                                </div><!-- end answer -->
                                <!-- end topic-meta -->                              
               </div><br><br>';
         
         
            
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
            $listagem_versiculos .= '<li class="versiculo">'.$db->f('ver_versiculo').' '.$db->f('ver_texto').'<div style="float:right;"><a href="#" data-menu="menu-share'.$i.'" class="header-icon header-icon-1"><i class="fa fa-share-alt"></i></a></div></li>';
            
            
            $txt_whatsapp_share = urlencode("'".$db->f('ver_texto')."' - ".$liv_nome." ".$ver_capitulo.":".$db->f('ver_versiculo')." - Visite: www.bibliaparacasais.com.br");
            
            $listagem_versiculos_boxes .= '<div id="menu-share'.$i.'" class="menu menu-box-bottom menu-box-detached round-large" data-menu-height="260" data-menu-effect="menu-over">
        <div class="content bottom-0">
            <div class="menu-title"><h1>Compartilhe</h1><p class="color-highlight">Compartilhe para seus amigos</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
            <div class="divider bottom-0"></div>
        </div>
        <div class="link-list link-list-1 left-15 right-15">
            <a href="#" onclick="return shareOverrideOGMeta(\'https://bibliaparacasais.com.br\', \''.$liv_nome.' '.$ver_capitulo.': '.$db->f('ver_versiculo').' \', \''.$db->f('ver_texto').' '.$liv_nome.' '.$ver_capitulo.': '.$db->f('ver_versiculo').' - Visite: www.bibliaparacasais.com.br \', \'https://bibliaparacasais.com.br/assets/images/biblia-sagrada-online-para-casais-redonda.png\');">
                <i class="font-18 fab fa-facebook color-facebook"></i>
                <span class="font-13">Facebook</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="#" class="shareToTwitter">
                <i class="font-18 fab fa-twitter-square color-twitter"></i>
                <span class="font-13">Twitter</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="whatsapp://send?text='.$txt_whatsapp_share.'" target="_blank class="shareToWhatsApp">
                <i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
                <span class="font-13">WhatsApp</span>
                <i class="fa fa-angle-right"></i>
            </a>   
        </div>
    </div>

    <div class="menu-hider"></div>
</div>';
            
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


         $listagem_comentarios = $this->getComentarios(3,$liv_abreviado_titulo,$ver_capitulo_titulo,"");

 
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
                                                <input type="hidden" name="contexto_id" value="'.$ver_capitulo_titulo.'">
                                                <input type="hidden" name="comentario_tipo" value="3">
                                                <input type="hidden" name="comentario_id_referencia" value="0">
                                                    <textarea name="comentario" style="width:100%; border:1px solid #e4e4e4; height:100px;" rows="3" id="textArea" required ></textarea>
                                                    <a href="javascript:void(0);" onClick="document.comentar_post.submit();" class="button button-xs button-center-large button-round-large bg-facebook top-20 bottom-10">Comentar</a>
                                                   </form>
                                    </div><!-- end row -->
                                </div><!-- end answer -->
                                <!-- end topic-meta -->                              
               </div><br><br>';
         
         
           
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
         $GLOBALS["base"]->template->set_var('listagem_versiculos_boxes',$listagem_versiculos_boxes);
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