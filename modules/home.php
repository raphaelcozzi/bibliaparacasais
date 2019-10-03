<?php 

/*******************************************************************************************************************
*                                                                                                                  *
*		CLASSE PRINCIPAL QUE MONTA O CABEÇALHO E O RODAPE                                                          *
*		TODA CLASSE QUE CONTENHA MÉTODOS QUE EXIBAM UM CONTEUDO NA TELA DEVEM SEGUIR O SEGUINTE PADRÃO:            *
*                                                                                                                  *
*			require_once("modules/home.php");                                                                      *
*		                                                                                                           *
*			class exemplo extends home                                                                             *
*			{                                                                                                      *
*				function main()                                                                                    *
*				{                                                                                                  * 
*					                                                                                               *
*					$this->cabecalho();                                                                            *
*					$GLOBALS["base"]->template = new template();                                                   *
*					echo $GLOBALS["base"]->write_design_specific('exemplo.tpl' , 'exemplo');                       * 
*					$GLOBALS["base"]->template = new template();                                                   *
*					$this->footer();                                                                               *
*				}                                                                                                  * 
*			}                                                                                                      *
*                                                                                                                  *
********************************************************************************************************************/

class home
{
	public function main()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "home";
         $_SESSION['titulo_pagina'] = "In&iacute;cio";
			

         
         
         /* VERSÍCULO DO DIA */
         
         $vers = mt_rand(1,29028);
         
         $sql = "SELECT versiculos.ver_texto, livros.liv_nome, 
                 versiculos.ver_capitulo, 
                 versiculos.ver_versiculo,
                 livros.liv_abreviado
                 FROM versiculos, livros 
                 WHERE versiculos.ver_liv_id = livros.liv_id
                 AND versiculos.ver_vrs_id = ".$_SESSION['ver_vrs_id']." 
                 ORDER BY RAND() LIMIT 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         
         $ver_texto = $db->f("ver_texto");
         $liv_nome = $db->f("liv_nome");
         $ver_capitulo = $db->f("ver_capitulo");
         $ver_versiculo = $db->f("ver_versiculo");
         $liv_abreviado = $db->f("liv_abreviado");
         
         $versiculo = "<h1 style='text-shadow: 5px 5px 3px #333;'>&quot;".$ver_texto."&quot;</h1>
                       <p style='text-shadow: 5px 5px 3px #333;'>".$liv_nome." ".$ver_capitulo.":".$ver_versiculo."</p>";
         

         $versiculo2 = "<h1 style='color:rgba(255,0,0,0);'>&quot;".$ver_texto."&quot;</h1>
                       <p  style='color:rgba(255,0,0,0);'>".$liv_nome." ".$ver_capitulo.":".$ver_versiculo."</p>";

         $txt_whatsapp_share = urlencode("'".$ver_texto."' - ".$liv_nome." ".$ver_capitulo.":".$ver_versiculo." - Visite: www.bibliaparacasais.com.br");
         
          
         
         if(isset($_SESSION['ver_vrs_id']))
            $vrs_id = $this->blockrequest($_SESSION['ver_vrs_id']);
         else
            $vrs_id = 2;
         
         
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

         
         
         $link_livro = $sigla."/".$liv_abreviado."/".$ver_capitulo;
         
         
         $box_meus_dados = $this->boxMeusDados();

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
                       ORDER BY artigos.id DESC LIMIT 0,3";
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



                     $listagem_artigos_recentes .= '<!-- ITEM --><aside class="topic-list"><article class="well clearfix"><div class="topic-desc row-fluid clearfix">';

                     if($imagem_destaque != "")
                        $listagem_artigos_recentes .='<div class="col-sm-4"><img src="'.$imagem_destaque.'" alt="" class="img-responsive img-thumbnail"></div>';

                                          $listagem_artigos_recentes .= '<div class="col-sm-8">
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
                                              $listagem_artigos_recentes .='<ul class="list-inline tags">';

                                             for($ta = 0; $ta < count($tags); $ta++)
                                             {

                                                $listagem_artigos_recentes .='<li><a href="'.ABS_LINK.'artigos/tag/'.$tags[$ta].'">'.$tags[$ta].'</a></li>';

                                             }
                                                          
                                          $listagem_artigos_recentes .='</ul>';
                                        }
                                           $listagem_artigos_recentes .='<!-- end tags -->
                                          </div>

                                          <div class="pull-right">
                                              <div class="customshare">
                                              </div>
                                          </div>
                                      </footer>
                                      <!-- end topic -->
                                  </article></aside>
                                 <!-- ITEM -->';



                  $db->next_record();
                     
               }



         $this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

         $GLOBALS["base"]->template->set_var('listagem_artigos_recentes',  $listagem_artigos_recentes);
         $GLOBALS["base"]->template->set_var('box_meus_dados',  $box_meus_dados);
         $GLOBALS["base"]->template->set_var('txt_whatsapp_share',  $txt_whatsapp_share);
         $GLOBALS["base"]->template->set_var('versiculo_dia2',  $versiculo2);
         $GLOBALS["base"]->template->set_var('versiculo_dia',  $versiculo);
         $GLOBALS["base"]->template->set_var('link_livro',  $link_livro);
			$GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
         $GLOBALS["base"]->write_design_specific('home.tpl' , 'main');
			$this->footer();
	}
	
	
   function cabecalho()
	{	
		@session_start();
		$db = new db();
		
      // Define a versão padrão da bíblia como 1 (Almeida Revisada Imprensa Bíblica)
      if(!isset($_SESSION['ver_vrs_id']))
      {
         $_SESSION['ver_vrs_id'] = 1;
      }
		
		
		if(isset($_SESSION['msg']))
      {
         
         @$mensagem = $_SESSION['msg']["mensagem"];
         $tm =  $_SESSION['msg']["tm"];
         $float =  $_SESSION['msg']["float"];
         
         
        if($tm != "")
        {
           switch($tm)
           {
              case "green":
               $cor = "18823a";
              break;

              case "red":
               $cor = "ba1d20";
              break;

              case "blue":
               $cor = "4963e5";
              break;

              case "yellow":
               $cor = "ffed28";
              break;
           
           }
        }
        else
        {
            $estilo = '';
        }
         
         $estilo = 'style="background-color:#'.$cor.';" ';
         
          $estilo = '';
            
      $mess = '<section class="topbar-panel panel hidden-xs">
                  <span class="clickable btn btn-raised btn-info"><i class="fa fa-angle-up"></i></span>
                  <div class="panel-body">
                      <div class="topbar" '.$estilo.'>
                          <div class="container">
                              <div class="row">
                                  <div class="col-md-12 text-center">
                                      <p>'.$mensagem.'</p>
                                  </div>
                              </div>
                          </div>
                      </div> 
                  </div>
              </section>';

                $GLOBALS["base"]->template->set_var('msg' ,$mess);

            unset($_SESSION['msg']);
      }
      else
                $GLOBALS["base"]->template->set_var('msg' ,'');
		if(USE_AVATAR == 1)
		{
			
			if(isset($_SESSION['logado']))
         {
            $sql = "SELECT avatar FROM usuarios WHERE id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            if($db->f("avatar") == "")
               $_SESSION['avatar'] = "http://www.placehold.it/60x60/EFEFEF/AAAAAA&amp;text=sem+foto";
            else
               $_SESSION['avatar'] = $db->f("avatar");
         }

		}

		$GLOBALS["base"]->template->set_var('usuario_nome' ,$_SESSION['nome']);
		$GLOBALS["base"]->template->set_var('email' ,$_SESSION['email']);
		
		
		/* Define o titulo da pagina que aparece no meio preto no cabeÃ§alho */
		
		if($_REQUEST['module'])
		{
			$linkMenu = "index.php?module=".$_REQUEST['module']."&method=".$_REQUEST['method'];
			
			$sql = "SELECT descricao FROM menu_itens WHERE link LIKE '%".$linkMenu."%' LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			if($db->num_rows() > 0)
				$page_title = $db->f("descricao");
			else
			{
				if(($_REQUEST['module'] == "home" && $_REQUEST['method'] == "main") || !$_REQUEST['module'])
					$page_title = PAGINA_INICIAL;
				else
					$page_title = "";
			}
		}
		else
		{
			$page_title = "";
		}
      $pagina_atual = $_SERVER['PHP_SELF'];
		$GLOBALS["base"]->template->set_var('pagina_atual' ,$ti);
		$GLOBALS["base"]->template->set_var('titulo_pagina' ,$_SESSION['titulo_pagina']);
		$GLOBALS["base"]->template->set_var('ABS_LINK' ,ABS_LINK);
		$GLOBALS["base"]->template->set_var('TITULO_SISTEMA' ,TITULO_SISTEMA);
		$GLOBALS["base"]->template->set_var('page_title' ,$page_title);
		$GLOBALS["base"]->template->set_var('module_busca' ,$_REQUEST['module']);


		if($_REQUEST['q'])
			$q = $_REQUEST['q'];
		else
			$q = "Buscar";
				
		$GLOBALS["base"]->template->set_var('q', $q);

		$this->breadcrumbs();
		
		$this->monta_menu();


		if(isset($_SESSION['logado']))
         $this->notifications($_SESSION['id']);

		echo $GLOBALS["base"]->write_design_specific('home.tpl' , 'cabecalho');
	}
	
	function footer()
	{
		@session_start();
		$db = new db();

      
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
      
      $google_login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

      
		$GLOBALS["base"]->template->set_var('google_login_url' ,$google_login_url);      
		$GLOBALS["base"]->template->set_var('velho_testamento' ,$velho_testamento);      
		$GLOBALS["base"]->template->set_var('novo_testamento' ,$novo_testamento);      
      
      $GLOBALS["base"]->template->set_var('msg2' ,"");
		$GLOBALS["base"]->template->set_var('msg_error' ,"");
      $GLOBALS["base"]->template->set_var("ABS_LINK",ABS_LINK);
      $GLOBALS["base"]->template->set_var("ANALYTICS",ANALYTICS);
		$GLOBALS["base"]->template->set_var('TITULO_SISTEMA' ,TITULO_SISTEMA);
		$GLOBALS["base"]->write_design_specific('home.tpl' , 'footer');
	}

		
		/* MÉTODOS DE TRATAMENTO DE MOEDAS */
		/* MÉTODOS DE TRATAMENTO DE MOEDAS */
		/* MÉTODOS DE TRATAMENTO DE MOEDAS */
		/* MÉTODOS DE TRATAMENTO DE MOEDAS */
		
		function decimal_to_brasil_real($valor)
		{
			/* ESPERA RECEBER O FORMATO 1000.00 
				
				Converte valor de decimal (15,2) com duas casas decimais para o formato de moeda Real do Brasil (R$)
			
			*/

			$valor = number_format($valor,2);
			$valor = str_replace(",",".",$valor);
			$valor = substr($valor,0,(strlen($valor)-3)).str_replace(".",",",substr($valor,(strlen($valor)-3),1)).substr($valor,(strlen($valor)-2),2);

			return $valor;	
		}
		
		function real_brasil_to_decimal($valor)
		{
			
			/*
				ESPERA RECEBER O FORMATO 1.000,00
				
				Converte valor em real do Brasil para decimal (15,2) com duas casas decimais
			*/
			
			$v = str_replace(".","",$valor);
			$v = str_replace(",",".",$v);
			
			return $v;			
		}

		function diasemana($data) 
		{
				
			/* $data DD/MM/YYYY */	
			
			$ano =  substr("$data", 6, 4);
			$mes =  substr("$data", 4, 2);
			$dia =  substr("$data", 0, 2);
		
			$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
		
			switch($diasemana) 
			{
				case"0": $diasemana = "Domingo";       break;
				case"1": $diasemana = "Segunda-feira"; break;
				case"2": $diasemana = "Terca-feira";   break;
				case"3": $diasemana = "Quarta-feira";  break;
				case"4": $diasemana = "Quinta-feira";  break;
				case"5": $diasemana = "Sexta-feira";   break;
				case"6": $diasemana = "S&aacute;bado";        break;
			}
		
		
			return $diasemana;
			//echo "$diasemana";
		}
		
		function blockrequest($param)
		{
			/*
				Retira todas as tags html da string;
				Retira qualquer isntrução SQL da string
			*/
			
			$str = strip_tags($param);

			$p1 = str_replace("INSERT"," ",$str);
			$p2 = str_replace("DELETE"," ",$p1);
			$p3 = str_replace("UPDATE"," ",$p2);
			$p4 = str_replace("TRUNCATE"," ",$p3);
			$p5 = str_replace("DUMP"," ",$p4);
			$p6 = str_replace("DROP"," ",$p5);
			$p6 = str_replace("SELECT"," ",$p6);

			$p7 = str_replace("<"," ",$p6);
			$p8 = str_replace(">"," ",$p7);
			$p9 = str_replace("'","",$p8);
			$p10 = str_replace(" id ","",$p9);
			$p11 = str_replace("id>","",$p10);
			$p12 = str_replace(" or ","",$p11);
			$p13 = str_replace(" and ","",$p12);
			$p14 = str_replace("<>","",$p13);
			$p15 = str_replace("> 0","",$p14);
			$p15 = str_replace("--","",$p15);

			$str = $p15;
			
			return $str;
		}
		
		function dolog($acao)
		{
			@session_start();
			$db = new db();

			$sql = "INSERT INTO log (id_usuario, acao, data) VALUES (".$_SESSION['id'].", '".$acao."', NOW())";			
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
		}
		
		
		function breadcrumbs()
		{
			@session_start();
			$db = new db();

			$breadcrumbs = ' <li><a href="'.ABS_LINK.'">In&iacute;cio</a> <i class="fa fa-angle-right"></i></li>';
			
			if(
				($_REQUEST['module'] && $_REQUEST['method']) 
				&& 
				($_REQUEST['module'] != "home")
			 )	
				{
				$linkMenu = $_REQUEST['module']."/".$_REQUEST['method'];			
			
	
				$sql = "SELECT id_area, descricao FROM menu_itens WHERE link LIKE '%".$linkMenu."%' LIMIT 1 ";
				$db->query($sql,__LINE__,__FILE__);
				$db->next_record();
				if($db->num_rows() > 0)
				{
					$menuItem = $db->f("descricao");
					$idArea = $db->f("id_area");
					
					$sql = "SELECT descricao FROM areas WHERE id = ".$idArea." ";
					$db->query($sql,__LINE__,__FILE__);
					$db->next_record();
					$area = $db->f("descricao");
					
					
					$breadcrumbs .= '<li><a href="javascript:void(0);">'.$area.'</a> <i class="fa fa-angle-right"></i></li>';
					$breadcrumbs .= '<li><a href="javascript:void(0);">'.$menuItem.'</a> <i class="fa fa-angle-right"></i></li>';
				}

			}

			$GLOBALS["base"]->template->set_var('breadcrumbs' ,$breadcrumbs);
		}

	function monta_menu()
	{
		@session_start();
		
		$db = new db();
		
		if($_REQUEST['module'] && $_REQUEST['method'])
			$uri = $_REQUEST['module']."/".$_REQUEST['method'];
		else
			$uri = "";

      if(isset($_SESSION['logado']))
      {
         $nivelAcesso = "1,2";
      }
      else
      {
         $nivelAcesso = "0 ,2";
      }
      
       $menu = '<ul class="nav navbar-nav">';
      
		$sql = "SELECT id, descricao, link FROM menu_itens WHERE nivelAcesso IN (".$nivelAcesso.") ";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
			$menu .= '<li ';
         
         if($_SESSION['pagina'] ==  str_replace("/", "", $db->f("link")))
            $menu .= ' class="active" ';
         
         $menu .= '><a href="'.$db->f("link").'">'.$db->f("descricao").'</a></li>';
	
			$db->next_record();
		}
      
      $menu .= '<li class="dropdown hasmenu">
                                    <a href="javascript:void(0)" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Vers&atilde;o <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                       <li><a href="'.ABS_LINK.'home/alteraVersao/1">Almeida Revisada Imprensa B&iacute;blica</a></li>
                                        <li><a href="'.ABS_LINK.'home/alteraVersao/2">Almeida Corrigida e Revisada Fiel</a></li>
                                        <li><a href="'.ABS_LINK.'home/alteraVersao/3">Nova Vers&atilde;o Internacional</a></li>
                                        <li><a href="'.ABS_LINK.'home/alteraVersao/4">Sociedade B&iacute;blica Brit&acirc;nica</a></li>
                                        <li><a href="'.ABS_LINK.'home/alteraVersao/7">American Standard Version</a></li>
                                        <li><a href="'.ABS_LINK.'home/alteraVersao/8">King James</a></li>
                                        <li><a href="'.ABS_LINK.'home/alteraVersao/5">O Livro</a></li>
                                    </ul>
                                </li>
                            </ul>';
      
                           if(!isset($_SESSION['logado']))
                           {
                              $menu .= '<ul class="nav navbar-nav navbar-right">
                                   <li><a href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"><i class="material-icons">lock</i> Entrar ou Cadastrar-se</a></li>
                               </ul>';
                           }
                            else 
                            {
                               $menu .= '<ul class="nav navbar-nav" style="float:right; white-space: nowrap;" >
                                <li style="margin-top:-20px;"><a href="javascript:void(0)"><img width="60" src="'.$_SESSION['avatar'].'" alt="" class="avatar img-circle" id="avatarLogin"></a></li>
                                <li><a href="'.ABS_LINK.'perfil">'.$_SESSION['nome'].' | </a></li><li><a href="'.ABS_LINK.'login/logout" onclick="signOut();" >Sair</a></li>
                              
                           </ul>';
                            }

	

			$GLOBALS["base"]->template->set_var("menu",$menu);
		
	}
	
	

	function email($to,$subject,$message,$anexo = "")
	{
		require_once('class.phpmailer.php');
		
		$mail = new phpmailer();
      
      //$mail->SMTPSecure = 'ssl';
      $mail->IsSMTP();
		$mail->Encoding      = "8bit";
		$mail->CharSet       = "iso-8859-1";
		$mail->Sender        = "contato@bibliaparacasais.com.br";
		$mail->FromName		 = "Biblia de Estudos para Casais";   
		$mail->Host          = "mail.bibliaparacasais.com.br";
		$mail->Helo          = "EHLO";
		$mail->SMTPAuth      = false;
		$mail->Username      = "contato@bibliaparacasais.com.br";
		$mail->Password      = "r2AFhX0O0vdt";
		$mail->Port          = 587;
		$mail->AddReplyTo("contato@bibliaparacasais.com.br", "Biblia de Estudos para Casais");
		$mail->Mailer        = "smtp";
		$mail->IsHTML(true);
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $message;
		
		if($anexo != "")
			$mail->AddAttachment($anexo);

		if(!$mail->Send())
			die("erro no envio!");
		
	}
	
	function notifications($id_usuario)
	{
		@session_start();
		$db = new db();

		$total_pending_notifications = 0;

		$sql = "SELECT DATE_FORMAT(data,'%d/%m%/%Y %H:%i') as data,
				title,
				icon,
				link,
				label,
				status 
				FROM notifications 
				WHERE id_usuario = ".$_SESSION['id']."  
				ORDER BY id DESC";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
			$link = $db->f("link");
			$data = $db->f("data");
			$label = $db->f("label");
			$icon = $db->f("icon");
			$title = $db->f("title");
			$status = $db->f("status");
			$data = explode(" ",$data);
			
			if($status == "1")
			{
				$icon = 'check';
				$label = 'success';	
			}

			if($status == "0")
			{
				$icon = 'envelope';
				$label = 'danger';	
			}
			
			// mensagens do dia
			if($data[0] == date("d/m/Y"))
				$data_label = TX_HOJE." ".TX_AS.$data[1]." hs";
			elseif($data[0] == date("d/m/Y",strtotime("-1 day")))
				$data_label = TX_ONTEM." ".TX_AS.$data[1]." hs";
			elseif($data[0] == date("d/m/Y",strtotime("+1 day")))
				$data_label = TX_AMANHA." ".TX_AS.$data[1]." hs";
			else
				$data_label = $data[0]." ".TX_AS.$data[1]." hs";


			$html_notifications .= '<li>
							<a href="'.$link.'">
							<span class="details">
								<span class="label label-sm label-icon label-'.$label.'">
									<i class="fa fa-'.$icon.'"></i>
								</span> '.$title.' </span>
								<div style="background-color:#000; color:#fff; height:20px; font-size:11px; width:100px; float:right;">'.$data_label.'</div>
								</a>
								
							</li>';

			if($status == "0")	
				$total_pending_notifications++;

			$db->next_record();

		}
		
		
		
		if($total_pending_notifications > 0)
			$total_pending_notifications = ' <span class="badge badge-danger">'.$total_pending_notifications.'</span>';
		else	
			$total_pending_notifications = '';
		
		$GLOBALS["base"]->template->set_var('total_pending_notifications',$total_pending_notifications);
		$GLOBALS["base"]->template->set_var('html_notifications',$html_notifications);
		
	}
	
	function leNotification($idNotification)
	{
		@session_start();
		$db = new db();
		
		$sql = "UPDATE notifications SET status = 1 WHERE id = ".$idNotification." AND id_usuario = ".$_SESSION['id']." ";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		
	}
	
      function notificacao($mensagem,$cor)
      {
         $_SESSION['msg'] = array("mensagem"=>$mensagem,"tm"=>$cor,"mt"=>"air");
      }
      
      function emailSandbox()
      {
         $slug = "teste-1-2-3";
         
         $this->email("raphaelcozzi@gmail.com","Teste",$corpo);
      }
      
      function alteraVersao()
      {
         @session_start();
         
         if(isset($_REQUEST['id']))
            $vrs_id = $this->blockrequest($_REQUEST['id']);
         else
            $vrs_id = 1;

         $_SESSION['ver_vrs_id'] = $vrs_id;

         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];
         
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

         $db = new db();

         $sql = "SELECT vrs_nome FROM versoes WHERE vrs_id = ".$vrs_id." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->num_rows() > 0)
         {
            $vrs_nome = $db->f("vrs_nome");

            $this->notificacao("Versão da Bíblia alterado para ".$vrs_nome." ", "green");
            //header("Location: ".$origem);
            header("Location: ".ABS_LINK.$sigla);
         }
         else 
         {
            header("Location: ".ABS_LINK);
         }
         

      }
      
      function getComentarios($contexto, $liv_abreviado = 0, $ver_capitulo = 0, $slug = "", $pag = 1)
      {
         @session_start();
         $db = new db();
         $db2 = new db();
         $db3 = new db();
         $db4 = new db();
         

         $listagem_comentarios = '';
        
         $total_reg = 4;

         $inicio = $pag - 1;
         $inicio = $inicio * $total_reg;
         
         switch ($contexto)
         {
            case 1: // artigos
               /*
               $pagPrefix = "artigos/artigo/".$slug;
               
               $sqlGeral = 'SELECT COUNT(comentarios.id) AS total
                        FROM comentarios, usuarios, comentarios_contexto_referencia, artigos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND artigos.id = comentarios_contexto_referencia.contexto_id
                        AND artigos.slug = "'.$slug.'"
                        AND comentarios.status = 1 
                        AND comentarios.tipo = 1
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC';
                * 
                */
                        
               
               $sql = 'SELECT comentarios.id AS id,
                        comentarios.conteudo AS conteudo,
                        DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                        usuarios.nome AS nome_usuario,
                        usuarios.avatar AS avatar,
                        usuarios.online AS online,
                        comentarios.likes AS likes,
                        comentarios.deslikes AS deslikes,
                        comentarios.usuario_id AS autor
                        FROM comentarios, usuarios, comentarios_contexto_referencia, artigos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND artigos.id = comentarios_contexto_referencia.contexto_id
                        AND artigos.slug = "'.$slug.'"
                        AND comentarios.status = 1 
                        AND comentarios.tipo = 1
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC /* LIMIT '.$inicio.', '.$total_reg.' */';
               
               
            break;

            case 2: // Livro
               /*
               $pagPrefix = "livros/livro/".$liv_abreviado;

               $sqlGeral = 'SELECT COUNT(comentarios.id) AS total
                     FROM comentarios, usuarios, comentarios_contexto_referencia, livros 
                     WHERE comentarios.usuario_id = usuarios.id 
                     AND comentarios.id = comentarios_contexto_referencia.comentario_id
                     AND livros.liv_id = comentarios_contexto_referencia.contexto_id
                     AND livros.liv_abreviado = "'.$liv_abreviado.'"
                     AND comentarios.status = 1 
                     AND comentarios.tipo = 2
                     AND comentarios.comentario_id_referencia = 0
                     ORDER BY comentarios.id DESC';
                * 
                */

               $sql = 'SELECT comentarios.id AS id,
                     comentarios.conteudo AS conteudo,
                     DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                     usuarios.nome AS nome_usuario,
                     usuarios.avatar AS avatar,
                     usuarios.online AS online,
                     comentarios.likes AS likes,
                     comentarios.deslikes AS deslikes,
                     comentarios.usuario_id AS autor
                     FROM comentarios, usuarios, comentarios_contexto_referencia, livros 
                     WHERE comentarios.usuario_id = usuarios.id 
                     AND comentarios.id = comentarios_contexto_referencia.comentario_id
                     AND livros.liv_id = comentarios_contexto_referencia.contexto_id
                     AND livros.liv_abreviado = "'.$liv_abreviado.'"
                     AND comentarios.status = 1 
                     AND comentarios.tipo = 2
                     AND comentarios.comentario_id_referencia = 0
                     ORDER BY comentarios.id DESC /* LIMIT '.$inicio.', '.$total_reg.' */';
            break;

            case 3: // Capítulo
               
               /*
               $pagPrefix = "livros/livro/".$liv_abreviado."/".$ver_capitulo;

               $sqlGeral = 'SELECT COUNT(comentarios.id) AS total
                        FROM comentarios, usuarios, comentarios_contexto_referencia, versiculos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND versiculos.ver_id = comentarios_contexto_referencia.contexto_id
                        AND versiculos.ver_capitulo = '.$ver_capitulo.'
                        AND versiculos.ver_vrs_id = '.$_SESSION["ver_vrs_id"].'   
                        AND comentarios.status = 1 
                        AND comentarios.tipo = 3
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC';
                * 
                */

               $sql = 'SELECT comentarios.id AS id,
                        comentarios.conteudo AS conteudo,
                        DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                        usuarios.nome AS nome_usuario,
                        usuarios.avatar AS avatar,
                        usuarios.online AS online,
                        comentarios.likes AS likes,
                        comentarios.deslikes AS deslikes,
                        comentarios.usuario_id AS autor
                        FROM comentarios, usuarios, comentarios_contexto_referencia, versiculos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND versiculos.ver_id = comentarios_contexto_referencia.contexto_id
                        AND versiculos.ver_capitulo = '.$ver_capitulo.'
                        AND versiculos.ver_vrs_id = '.$_SESSION["ver_vrs_id"].'    
                        AND comentarios.status = 1 
                        AND comentarios.tipo = 3
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC /* LIMIT '.$inicio.', '.$total_reg.' */ ';
               
            break;
         

            case 4: // Curso
               
               /*
               $pagPrefix = "cursos/curso/".$slug;
               
               $sqlGeral = 'SELECT COUNT(comentarios.id) AS total
                        FROM comentarios, usuarios, comentarios_contexto_referencia, cursos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND cursos.id = comentarios_contexto_referencia.contexto_id
                        AND cursos.slug = "'.$slug.'"
                        AND comentarios.status = 1 
                        AND comentarios.tipo = 1
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC';
                * 
                */
                        
               
               $sql = 'SELECT comentarios.id AS id,
                        comentarios.conteudo AS conteudo,
                        DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                        usuarios.nome AS nome_usuario,
                        usuarios.avatar AS avatar,
                        usuarios.online AS online,
                        comentarios.likes AS likes,
                        comentarios.deslikes AS deslikes,
                        comentarios.usuario_id AS autor
                        FROM comentarios, usuarios, comentarios_contexto_referencia, cursos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND cursos.id = comentarios_contexto_referencia.contexto_id
                        AND cursos.slug = "'.$slug.'"
                        AND comentarios.status = 1 
                        AND comentarios.tipo = 4
                        AND comentarios.comentario_id_referencia = 0
                        ORDER BY comentarios.id DESC /* LIMIT '.$inicio.', '.$total_reg.' */';
               
               
            break;
         
         }
         
         /*
         $db3->query($sqlGeral,__LINE__,__FILE__);
         $db3->next_record();
         $totalRegistros = $db3->f("total");
         
         
         $totalPaginas = $totalRegistros / $total_reg;
         $totalPaginas = round($totalPaginas);
         */
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         for($i = 0; $i < $db->num_rows(); $i++)
         {
            
            $idComentario = $db->f("id");
            $conteudo = $db->f("conteudo");
            $data_comentario = $db->f("data_comentario");
            $nome_usuario = $db->f("nome_usuario");
            $avatar = $db->f("avatar");
            $online = $db->f("online");
            $likes = $db->f("likes");
            $deslikes = $db->f("deslikes");
            $comentario_id_referencia = $db->f("comentario_id_referencia");
            $autor = $db->f("autor");
            
            if($online == "1")
                 $onlineOffline = "online";

            if($online == "0")
                 $onlineOffline = "offline";
               
         
               // COMENTARIO UNICO

               $listagem_comentarios .= '<div class="post_unico"><article class="well btn-group-sm clearfix">
                                          <div class="col-sm-2 text-center publisher-wrap">
                                              <img src="'.$avatar.'" alt="" class="avatar img-circle img-responsive">
                                              <h5>'.$nome_usuario.'</h5>
                                              <small class="'.$onlineOffline.'">'.$onlineOffline.'</small>
                                          </div>
                                          <div class="col-sm-10">
                                              <div class="blog-meta clearfix">
                                                  <small>'.$likes.' curtidas</small>
                                                  <small>em '.$data_comentario.'</small>
                                              </div>

                                              <p>'.$conteudo.'</p>



                                          </div>';
                          if(isset($_SESSION['logado']))
                          {
                              // Verifica se o usuário que está logado curtiu, descurtiu ou marcou o comentário               
                              $sql4 = "SELECT curtiu, descurtiu, bookmark FROM comentarios_usuarios_curtidas_bookmarks
                                      WHERE usuario_id = ".$_SESSION['id']." AND comentario_id = ".$idComentario." ";               
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
                          }
               
                                          
                           // Só mostra o link para comentar se o usuário estiver logado               
                          if(isset($_SESSION['logado']))                
                             $listagem_comentarios .= '<a href="javascript:void(0);" onClick="mostraFormReply(\'formResponder_'.$idComentario.'\')" class="readmore" title="">Responder →</a>';
               
                          
                          if(isset($_SESSION['logado']))
                          {
               
                                    $listagem_comentarios .= '<div class="topic-meta clearfix">
                                                   <div class="pull-left">
                                                       <a '.$likeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="home/like/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                           <i '.$likeCurtidoIconColor.' class="material-icons">thumb_up</i>
                                                       </a>
                                                       <a '.$deslikeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="home/deslike/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                           <i '.$deslikeCurtidoIconColor.' class="material-icons">thumb_down</i>
                                                       </a>
                                                       <a '.$bookmarkFeito.' class="btn btn-default btn-fab btn-fab-mini" href="home/bookmark/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                           <i '.$bookmarkFeitoIconColor.' class="material-icons">bookmark_border</i>
                                                       </a>';


                                    if($_SESSION['id'] == $autor)
                                    {
                                                      $listagem_comentarios .= '<a class="btn btn-default btn-fab btn-fab-mini" href="javascript:void(0);" onClick="mostraFormReply(\'formEdit_'.$idComentario.'\')" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                           <i class="material-icons">create</i>
                                                       </a>
                                                       <a class="btn btn-default btn-fab btn-fab-mini" onclick="return(confirm(\'Deseja excluir o coment&aacute;rio?\'))" href="'.ABS_LINK.'home/delComentario/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                                     <i class="material-icons">delete</i>
                                                            </a>';
                                    }


                                    $listagem_comentarios .= '</div>
                                 <!-- end left -->
                                 <div class="pull-right">
                                     <div class="customshare">
                                         <div class="list">
                                             <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                 <ul class="list-inline">
                                                     <li><a target="_blank" href="https://wa.me/?text='.urlencode($conteudo.' - Compartilhado via bibliaparacasais.com.br.').'" class="wat"><i class="fa fa-whatsapp"></i></a></li>
                                                     <li><a href="javascript:void(0);" class="fb" onclick="shareFacebook(\'https://www.bibliaparacasais.com.br\',\'.$conteudo.\');"><i class="fa fa-facebook"></i></a></li>
                                                     <li><a href="http://twitter.com/share?text='.substr($conteudo,0,140).'&url=https://www.bibliaparacasais.com.br&counturl=URL&via='.$nome_usuario.'" target="_blank"" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div><!-- end tpic-desc -->
                             <!-- ITEM FIM -->';
                          }
                          else
                          {
                                    $listagem_comentarios .= '<div class="topic-meta clearfix">
                                                   <div class="pull-left">
                                                       <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                           <i class="material-icons">thumb_up</i>
                                                       </a>
                                                       <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                           <i class="material-icons">thumb_down</i>
                                                       </a>
                                                       <a  class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                           <i class="material-icons">bookmark_border</i>
                                                       </a>';



                                    $listagem_comentarios .= '</div>
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
                             </div><!-- end tpic-desc -->
                             <!-- ITEM FIM -->';
                             
                          }
                           
                           

                if(isset($_SESSION['logado']))
                {
                  // BOX DE RESPONDER AO COMENTÁRIO
                  $listagem_comentarios .= ' <!-- HIDDEN ANSWER BOX -->
                                         <div class="forum-answer topic-desc clearfix" id="formResponder_'.$idComentario.'" style="display:none;">
                                             <div class="row">
                                                 <div class="col-sm-2 text-center publisher-wrap">
                                                     <img src="'.$_SESSION['avatar'].'" alt="" class="avatar img-circle img-responsive">
                                                     <h5>'.$_SESSION['nome'].'</h5>
                                                     <small class="online">Online</small>
                                                 </div>

                                                 <div class="col-md-10">
                                                     <div class="form-group">
                                                         <label for="textArea" class="col-md-2 control-label">Responder:</label>
                                                         <div class="col-md-10">
                                                         <form action="home/setComentarios" method="post" name="comentar">
                                                              <input type="hidden" name="contexto_id" value="0">
                                                               <input type="hidden" name="comentario_tipo" value="0">
                                                               <input type="hidden" name="comentario_id_referencia" value="'.$idComentario.'">
                                                                   <textarea name="comentario" class="form-control" rows="3" id="textArea" required ></textarea>
                                                             <button type="submit" class="btn btn-raised btn-info gr">Responder</button>
                                                         </form>    
                                                         </div>
                                                     </div>
                                                 </div><!-- end col -->
                                             </div><!-- end row -->
                                          </div><!-- end answer -->
                                          <!-- HIDDEN ANSWER BOX -->';

                  
                  
                  // BOX DE EDIÇÃO DO COMENTÁRIO
                  $listagem_comentarios .= ' <!-- HIDDEN EDIT BOX -->
                                         <div class="forum-answer topic-desc clearfix" id="formEdit_'.$idComentario.'" style="display:none;">
                                             <div class="row">
                                                 <div class="col-sm-2 text-center publisher-wrap">
                                                     <img src="'.$_SESSION['avatar'].'" alt="" class="avatar img-circle img-responsive">
                                                     <h5>'.$_SESSION['nome'].'</h5>
                                                     <small class="online">Online</small>
                                                 </div>

                                                 <div class="col-md-10">
                                                     <div class="form-group">
                                                         <label for="textArea" class="col-md-2 control-label">Editar resposta:</label>
                                                         <div class="col-md-10">
                                                         <form action="home/edtComentario" method="post" name="comentar">
                                                              <input type="hidden" name="comentario_id" value="'.$idComentario.'">
                                                                   <textarea name="comentario" class="form-control" rows="3" id="textArea" required >'.$conteudo.'</textarea>
                                                             <button type="submit" class="btn btn-raised btn-info gr">Atualizar</button>
                                                         </form>    
                                                         </div>
                                                     </div>
                                                 </div><!-- end col -->
                                             </div><!-- end row -->
                                          </div><!-- end answer -->
                                          <!-- HIDDEN EDIT BOX -->';
                  
                  
                }



               $listagem_comentarios .= '<h4>RESPOSTAS AO COMENT&Aacute;RIO:</h4><hr>';





             // RESPOSTAS AO COMENTÁRIO (SE HOUVER)
               
            $sql2 = 'SELECT comentarios.id AS id,
                     comentarios.conteudo AS conteudo,
                     DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                     usuarios.nome AS nome_usuario,
                     usuarios.avatar AS avatar,
                     usuarios.online AS online,
                     comentarios.likes AS likes,
                     comentarios.deslikes AS deslikes,
                     comentarios.usuario_id AS autor
                     FROM comentarios, usuarios
                     WHERE comentarios.usuario_id = usuarios.id 
                     AND comentarios.status = 1 
                     AND comentarios.comentario_id_referencia = '.$idComentario.'
                     ORDER BY comentarios.id DESC';
            $db2->query($sql2,__LINE__,__FILE__);
            $db2->next_record();
            for($i2 = 0; $i2 < $db2->num_rows(); $i2++)
            {

               $idComentario = $db2->f("id");
               $conteudo = $db2->f("conteudo");
               $data_comentario = $db2->f("data_comentario");
               $nome_usuario = $db2->f("nome_usuario");
               $avatar = $db2->f("avatar");
               $online = $db2->f("online");
               $likes = $db2->f("likes");
               $deslikes = $db2->f("deslikes");
               $comentario_id_referencia = $db2->f("comentario_id_referencia");
               $autor = $db2->f("autor");

               if($online == "1")
                    $onlineOffline = "online";

               if($online == "0")
                    $onlineOffline = "offline";
               
               
               
                if(isset($_SESSION['logado']))
                {
               
                     // Verifica se o usuário que está logado curtiu, descurtiu ou marcou o comentário               
                     $sql4 = "SELECT curtiu, descurtiu, bookmark FROM comentarios_usuarios_curtidas_bookmarks
                             WHERE usuario_id = ".$_SESSION['id']." AND comentario_id = ".$idComentario." ";               
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
                }
               
               
               $listagem_comentarios .= '<!--RESPOSTA AO COMENTARIO-->
                                 <div class="topic-desc row-fluid clearfix">
                                          <div class="col-sm-2 text-center publisher-wrap">
                                              <img src="'.$avatar.'" alt="" class="avatar img-circle img-responsive">
                                              <h5>'.$nome_usuario.'</h5>
                                              <small class="'.$onlineOffline.'">'.$onlineOffline.'</small>
                                          </div>
                                          <div class="col-sm-10">

                                              <div class="blog-meta clearfix">
                                                  <small><a href="javascript:void(0)">'.$likes.' curtidas</a></small>
                                                  <small>em '.$data_comentario.'</small>
                                              </div>

                                              <p>'.$conteudo.'</p>
                                          </div>';
               
               
                           if(isset($_SESSION['logado']))
                           {

                                $listagem_comentarios .= '<div class="topic-meta clearfix">
                                          <div class="pull-left">
                                              <a '.$likeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="home/like/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                  <i '.$likeCurtidoIconColor.' class="material-icons">thumb_up</i>
                                              </a>
                                              <a '.$deslikeCurtido.' class="btn btn-default btn-fab btn-fab-mini" href="home/deslike/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                  <i '.$deslikeCurtidoIconColor.' class="material-icons">thumb_down</i>
                                              </a>
                                              <a '.$bookmarkFeito.' class="btn btn-default btn-fab btn-fab-mini" href="home/bookmark/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                  <i '.$bookmarkFeitoIconColor.' class="material-icons">bookmark_border</i>
                                              </a>';
               
                                    if($_SESSION['id'] == $autor)
                                    {
                                                      $listagem_comentarios .= '<a class="btn btn-default btn-fab btn-fab-mini" href="javascript:void(0);" onClick="mostraFormReply(\'formEdit_'.$idComentario.'\')" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                           <i class="material-icons">create</i>
                                                       </a>
                                                       <a class="btn btn-default btn-fab btn-fab-mini" onclick="return(confirm(\'Deseja excluir o coment&aacute;rio?\'))"  href="'.ABS_LINK.'home/delComentario/'.$idComentario.'" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                                     <i class="material-icons">delete</i>
                                                            </a>';
                                    }

               
                                       $listagem_comentarios .= '</div>
                                          <!-- end left -->

                                          <div class="pull-right">
                                              <div class="customshare">
                                                  <div class="list">
                                                      <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                          <ul class="list-inline">
                                                               <li><a  target="_blank" href="https://wa.me/?text='.urlencode($conteudo.' - Compartilhado via bibliaparacasais.com.br').'" class="wat"><i class="fa fa-whatsapp"></i></a></li>
                                                               <li><a href="javascript:void(0);" class="fb" onclick="shareFacebook(\'https://www.bibliaparacasais.com.br\',\'.$conteudo.\');"><i class="fa fa-facebook"></i></a></li>
                                                               <li><a href="http://twitter.com/share?text='.substr($conteudo,0,140).'&url=https://www.bibliaparacasais.com.br&counturl=URL&via='.$nome_usuario.'" target="_blank"" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div><!-- end tpic-desc -->
                                      </div>
                                      <!--RESPOSTA AO COMENTARIO FIM -->'; 
                                       
                  // BOX DE EDIÇÃO DO COMENTÁRIO
                  $listagem_comentarios .= ' <!-- HIDDEN EDIT BOX -->
                                         <div class="forum-answer topic-desc clearfix" id="formEdit_'.$idComentario.'" style="display:none;">
                                             <div class="row">
                                                 <div class="col-sm-2 text-center publisher-wrap">
                                                     <img src="'.$_SESSION['avatar'].'" alt="" class="avatar img-circle img-responsive">
                                                     <h5>'.$_SESSION['nome'].'</h5>
                                                     <small class="online">Online</small>
                                                 </div>

                                                 <div class="col-md-10">
                                                     <div class="form-group">
                                                         <label for="textArea" class="col-md-2 control-label">Editar resposta:</label>
                                                         <div class="col-md-10">
                                                         <form action="home/edtComentario" method="post" name="comentar">
                                                              <input type="hidden" name="comentario_id" value="'.$idComentario.'">
                                                                   <textarea name="comentario" class="form-control" rows="3" id="textArea" required >'.$conteudo.'</textarea>
                                                             <button type="submit" class="btn btn-raised btn-info gr">Atualizar</button>
                                                         </form>    
                                                         </div>
                                                     </div>
                                                 </div><!-- end col -->
                                             </div><!-- end row -->
                                          </div><!-- end answer -->
                                          <!-- HIDDEN EDIT BOX -->';
                                       
                                       
                           }
                           else
                           {
                                $listagem_comentarios .= '<div class="topic-meta clearfix">
                                          <div class="pull-left">
                                              <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Curtir">
                                                  <i class="material-icons">thumb_up</i>
                                              </a>
                                              <a  class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Descurtir">
                                                  <i class="material-icons">thumb_down</i>
                                              </a>
                                              <a class="btn btn-default btn-fab btn-fab-mini" href="'.ABS_LINK.'cadastro" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                                  <i  class="material-icons">bookmark_border</i>
                                              </a>';
               

               
                                       $listagem_comentarios .= '</div>
                                          <!-- end left -->

                                          <div class="pull-right">
                                              <div class="customshare">
                                                  <div class="list">
                                                      <div class="btn btn-default btn-fab btn-fab-mini"><i class="material-icons">share</i>
                                                          <ul class="list-inline">
                                                              <li><a href="'.ABS_LINK.'cadastro" class="tw"><i class="fa fa-twitter"></i></a></li>
                                                              <li><a href="'.ABS_LINK.'cadastro" class="fb"><i class="fa fa-facebook"></i></a></li>
                                                              <li><a href="'.ABS_LINK.'cadastro" class="gp"><i class="fa fa-google-plus"></i></a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div><!-- end tpic-desc -->
                                      </div>
                                      <!--RESPOSTA AO COMENTARIO FIM -->'; 
                              
                           }

                  $db2->next_record();

              }



               $listagem_comentarios .= '</article></div>';

            $db->next_record();
         }


         $anterior = $pag-1;
         $proximo = $pag+1;         
         
         // PAGINAÇÃO
       /*  $listagem_comentarios .= '<article class="well clearfix">
                                            <ul class="pagination">';
         

            if($pag == 0 || $pag == 1)      
               $listagem_comentarios .= '<li class="disabled"><a href="javascript:void(0)">&laquo;</a></li>';
            else
               $listagem_comentarios .= '<li><a href="'.ABS_LINK.''.$anterior.'">&laquo;</a></li>';
                  
            
            for($i = 1; $i <= $totalPaginas; $i++)
            {
               $listagem_comentarios .= '<li ';
               
               if($i == $pag)
                     $listagem_comentarios .= 'class="active" ';
               
               $listagem_comentarios .= '><a href="'.ABS_LINK.''.$pagPrefix.'/pg'.$i.'">'.$i.'</a></li>';
            }
               

            if($pag == $totalPaginas)               
                $listagem_comentarios .= '<li class="disabled"><a href="javascript:void(0)">&raquo;</a></li>';
            else
               $listagem_comentarios .= '<li><a href="'.ABS_LINK.''.$proximo.'">&raquo;</a></li>';
              
              
                                            
               $listagem_comentarios .='</ul></article>'; */
         
         
         
         
         return $listagem_comentarios;
      }
      
      function setComentarios()
      {
         
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         
         if(isset($_REQUEST['comentario']))
            @$comentario = $this->blockrequest($_REQUEST['comentario']);

         if(isset($_REQUEST['comentario_tipo']))
            @$comentario_tipo = $this->blockrequest($_REQUEST['comentario_tipo']);


         if(isset($_REQUEST['comentario_id_referencia']))
            @$comentario_id_referencia = $this->blockrequest($_REQUEST['comentario_id_referencia']);
         
         
         if(isset($_REQUEST['contexto_id']))
            @$contexto_id = $this->blockrequest($_REQUEST['contexto_id']);
 

         // Por padrão, novos comentários entram com status = 0, pendentes de aprovação da moderação.
         $sql = "INSERT INTO comentarios (tipo, usuario_id, conteudo, dataCadastro, likes, deslikes, comentario_id_referencia, status)
                 VALUES (".$comentario_tipo.", ".$_SESSION['id'].", '".$comentario."', NOW(),0,0, ".$comentario_id_referencia.", 0)";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();

			$id_comentario = $db->get_last_insert_id("comentarios","id");
         
         $sql = "INSERT INTO comentarios_contexto_referencia (comentario_id, contexto_id) VALUES (".$id_comentario.", ".$contexto_id.")";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         
         
         
            
            if($comentario_tipo == "1")
            {
               
               // Envia o email de que alguém respondeu seu artigo
               $sql = "SELECT artigos_categorias.titulo AS titulo, 
                       artigos.usuario_id AS autor,
                       artigos.slug,
                       artigos.titulo AS tituloArtigo,
                       artigos.conteudo AS conteudo
                       FROM artigos, artigos_categorias 
                       WHERE artigos.categoria_id = artigos_categorias.id
                       AND artigos.id = ".$contexto_id." ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               $categoria_nome = $db->f("titulo");
               $autor = $db->f("autor");
               $slug = $db->f("slug");
               $tituloArtigo = $db->f("tituloArtigo");
               $conteudo = $db->f("conteudo");

               $sql = "SELECT usuarios.id AS id, usuarios.nome, usuarios.email 
                      FROM usuarios
                      WHERE  usuarios.alert_daily = 1 AND usuarios.id = ".$autor." ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();

               if($db->num_rows() > 0)
               {
                  $id = $db->f("id");
                  $nome = $db->f("nome");
                  $email_usuario = $db->f("email");
                  $conteudo = $db->f("conteudo");

                  $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "Alguem respondeu seu artigo.<br><br><strong><p>Coment&aacute;rio:</p>".substr($conteudo,0,200)."(..)<br><br><p>Respota:</p> ".substr($comentario,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");

                  $this->email($email_usuario,"Alguem respondeu seu artigo - Biblia para casais",$corpo);               

                  $db->next_record();
               }
               
            }
            else
            {
               // Envia o email de que alguém respondeu seu comentário
               $sql = "SELECT usuarios.id AS id, usuarios.nome, usuarios.email, comentarios.conteudo AS conteudo 
                      FROM usuarios, comentarios 
                      WHERE usuarios.id = comentarios.usuario_id 
                      AND usuarios.alert_daily = 1 
                      AND comentarios.id = ".$contexto_id." ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();

               if($db->num_rows() > 0)
               {
                  $id = $db->f("id");
                  $nome = $db->f("nome");
                  $email_usuario = $db->f("email");
                  $conteudo = $db->f("conteudo");

                  $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "Alguem respondeu seu comentário.<br><br><strong><p>Coment&aacute;rio:</p>".substr($conteudo,0,200)."(..)<br><br><p>Respota:</p> ".substr($comentario,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");

                  $this->email($email_usuario,"Alguem respondeu seu comentario - Biblia para casais",$corpo);               

                  $db->next_record();
               }
               
            }
         
         
          
         $this->notificacao("Coment&aacute;rio enviado com sucesso. Aguardando Aprova&ccedil;&atilde;o.", "green");
         header("Location: ".$origem);         
      
          
      }

      function like()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$comentario_id = $this->blockrequest($_REQUEST['id']);
         
         
         
         // Só deixa ele curtir se ainda não tiver curtido
         $sql = "SELECT COUNT(id) AS total, curtiu AS likes FROM comentarios_usuarios_curtidas_bookmarks
                 WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $likes = $db->f("likes");
         if($db->f("total") == 0)
         {

               $sql = "INSERT INTO comentarios_usuarios_curtidas_bookmarks(usuario_id, curtiu, comentario_id) VALUES (".$_SESSION['id'].", 1, ".$comentario_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "UPDATE comentarios
                       SET likes = likes+1 
                       WHERE id = ".$comentario_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
         }
         else
         {
            
            $sql = "UPDATE comentarios_usuarios_curtidas_bookmarks
                    SET curtiu = 1, descurtiu = 0 
                    WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "UPDATE comentarios
                    SET deslikes = deslikes-1 
                    WHERE id = ".$comentario_id." AND deslikes > 0 LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            if($likes == 0)
            {
            
               $sql = "UPDATE comentarios
                       SET likes = likes+1 
                       WHERE id = ".$comentario_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
            
         }
         
            // Envia o email de que alguém curtiu seu comentário
            $sql = "SELECT usuarios.id AS id, usuarios.nome, usuarios.email, comentarios.conteudo AS conteudo 
                   FROM usuarios, comentarios 
                   WHERE usuarios.id = comentarios.usuario_id 
                   AND usuarios.alert_daily = 1 
                   AND comentarios.id = ".$comentario_id." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
           
            if($db->num_rows() > 0)
            {
               $id = $db->f("id");
               $nome = $db->f("nome");
               $email_usuario = $db->f("email");
               $conteudo = $db->f("conteudo");
               
               $sql = "SELECT nome FROM usuarios WHERE id = ".$_SESSION['id']." ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               $nomeUsuario = $db->f("nome");
               
               

               $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "".$nomeUsuario." curtiu seu coment&aacute;<br><strong><p>Resumo:</p> ".substr($conteudo,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");
               
               $this->email($email_usuario,"Alguem curtiu seu comentario - Biblia para casais",$corpo);               
               
               $db->next_record();
            }
         
         
            $this->notificacao("Voc&ecirc; curtiu o coment&aacute;rio.", "green");
         
         header("Location: ".$origem);         
      }

      function deslike()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$comentario_id = $this->blockrequest($_REQUEST['id']);
         
         
         
         // Só deixa ele descurtir se ainda não tiver descurtido
         $sql = "SELECT COUNT(id) AS total, descurtiu AS deslikes FROM comentarios_usuarios_curtidas_bookmarks
                 WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $deslikes = $db->f("deslikes");
         if($db->f("total") == 0)
         {

               $sql = "INSERT INTO comentarios_usuarios_curtidas_bookmarks(usuario_id, descurtiu, comentario_id) VALUES (".$_SESSION['id'].", 1, ".$comentario_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "UPDATE comentarios
                       SET deslikes = deslikes+1 
                       WHERE id = ".$comentario_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
         }
         else
         {
            
            $sql = "UPDATE comentarios_usuarios_curtidas_bookmarks
                    SET curtiu = 0, descurtiu = 1 
                    WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "UPDATE comentarios
                    SET likes = likes-1 
                    WHERE id = ".$comentario_id."  AND likes > 0 LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            if($deslikes == 0)
            {
               $sql = "UPDATE comentarios
                       SET deslikes = deslikes+1 
                       WHERE id = ".$comentario_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
            
         }


            $this->notificacao("Voc&ecirc; descurtiu o coment&aacute;rio.", "green");

         header("Location: ".$origem);         
      }
      

      function bookmark()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$comentario_id = $this->blockrequest($_REQUEST['id']);
         
         $sql = "SELECT COUNT(id) AS total FROM comentarios_usuarios_curtidas_bookmarks
                 WHERE bookmark = 1
                 AND comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->f("total") == 0)
         {
         
            $sql = "UPDATE comentarios_usuarios_curtidas_bookmarks
                    SET bookmark = 1 
                    WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            if($db->affected_rows() == 0)
            {
               $sql = "INSERT INTO comentarios_usuarios_curtidas_bookmarks(usuario_id, bookmark, comentario_id) VALUES (".$_SESSION['id'].", 1, ".$comentario_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }


            $this->notificacao("Voc&ecirc; marcou o coment&aacute;rio.", "green");
         }
         else
         {
            $sql = "UPDATE comentarios_usuarios_curtidas_bookmarks
                    SET bookmark = 0 
                    WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $this->notificacao("Voc&ecirc; desmarcou o coment&aacute;rio.", "green");
         }
         
         header("Location: ".$origem);         
      }
      
      function delComentario()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$comentario_id = $this->blockrequest($_REQUEST['id']);
         
         $sql = "SELECT COUNT(id) AS total FROM comentarios
                 WHERE id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->f("total") >= 1)
         {
            $sql = "DELETE FROM comentarios WHERE id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            $sql = "DELETE FROM comentarios WHERE comentario_id_referencia = ".$comentario_id." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "DELETE FROM comentarios_usuarios_curtidas_bookmarks WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            $sql = "DELETE FROM comentarios_marcados WHERE comentario_id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            $sql = "DELETE FROM comentarios_contexto_referencia WHERE comentario_id = ".$comentario_id." LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
         }
         
         
         $this->notificacao("Coment&aacute;rio Exclu&iacute;do.", "green");
         header("Location: ".$origem);         
         
         
      }

      function edtComentario()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$comentario_id = $this->blockrequest($_REQUEST['comentario_id']);
         @$comentario = $this->blockrequest($_REQUEST['comentario']);
         
         $sql = "SELECT COUNT(id) AS total FROM comentarios
                 WHERE id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->f("total") >= 1)
         {
            $sql = "UPDATE comentarios SET conteudo = '".$comentario."' WHERE id = ".$comentario_id." AND usuario_id = ".$_SESSION['id']."  LIMIT 1 ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
         }
         
         $this->notificacao("Coment&aacute;rio Atualizado.", "green");
         header("Location: ".$origem);         
      }


      function likeArtigo()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$artigo_id = $this->blockrequest($_REQUEST['id']);
         
         
         
         // Só deixa ele curtir se ainda não tiver curtido
         $sql = "SELECT COUNT(id) AS total, curtiu AS likes FROM artigos_usuarios_curtidas_bookmarks
                 WHERE artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $likes = $db->f("likes");
         if($db->f("total") == 0)
         {

               $sql = "INSERT INTO artigos_usuarios_curtidas_bookmarks(usuario_id, curtiu, artigo_id) VALUES (".$_SESSION['id'].", 1, ".$artigo_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "UPDATE artigos
                       SET likes = likes+1 
                       WHERE id = ".$artigo_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
         }
         else
         {
            
            $sql = "UPDATE artigos_usuarios_curtidas_bookmarks
                    SET curtiu = 1, descurtiu = 0 
                    WHERE artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "UPDATE artigos
                    SET deslikes = deslikes-1 
                    WHERE id = ".$artigo_id." AND deslikes > 0 LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            if($likes == 0)
            {
            
               $sql = "UPDATE artigos
                       SET likes = likes+1 
                       WHERE id = ".$artigo_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
            
         }
         
         
            // Envia o email de que alguém curtiu seu artigo
            $sql = "SELECT artigos_categorias.titulo AS titulo, 
                    artigos.usuario_id AS autor,
                    artigos.slug,
                    artigos.titulo AS tituloArtigo,
                    artigos.conteudo AS conteudo
                    FROM artigos, artigos_categorias 
                    WHERE artigos.categoria_id = artigos_categorias.id
                    AND artigos.id = ".$artigo_id." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $categoria_nome = $db->f("titulo");
            $autor = $db->f("autor");
            $slug = $db->f("slug");
            $tituloArtigo = $db->f("tituloArtigo");
            $conteudo = $db->f("conteudo");
         
            $sql = "SELECT usuarios.id AS id, usuarios.nome, usuarios.email 
                   FROM usuarios
                   WHERE  usuarios.alert_daily = 1 AND usuarios.id = ".$autor." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
           
            if($db->num_rows() > 0)
            {
               $id = $db->f("id");
               $nome = $db->f("nome");
               $email_usuario = $db->f("email");
               
               $sql = "SELECT nome FROM usuarios WHERE id = ".$_SESSION['id']." ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               $nomeUsuario = $db->f("nome");
               
               

               $corpo = $this->mailTemaple("Ol&aacute;, ".$nome.",","", "".$nomeUsuario." curtiu seu artigo.<br><br><strong>".  $tituloArtigo."</strong><br><br><p>Em: ".$categoria_nome."</p><p>Resumo:</p> ".substr($conteudo,0,200)."(..)<br><br>","<a href=\"https://bibliaparacasais.com.br/artigos/artigo/".$slug."\" target=\"_blank\" align=\"center\" class=\"call_to_action_button\">Veja mais</a>");
               
               $this->email($email_usuario,"Alguem curtiu seu artigo - Biblia para casais",$corpo);               
               
               $db->next_record();
            }
         
            $this->notificacao("Voc&ecirc; curtiu o artigo.", "green");
         
         header("Location: ".$origem);         
      }

      function deslikeArtigo()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$artigo_id = $this->blockrequest($_REQUEST['id']);
         
         
         
         // Só deixa ele descurtir se ainda não tiver descurtido
         $sql = "SELECT COUNT(id) AS total, descurtiu AS deslikes FROM artigos_usuarios_curtidas_bookmarks
                 WHERE artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $deslikes = $db->f("deslikes");
         if($db->f("total") == 0)
         {

               $sql = "INSERT INTO artigos_usuarios_curtidas_bookmarks(usuario_id, descurtiu, artigo_id) VALUES (".$_SESSION['id'].", 1, ".$artigo_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "UPDATE artigos
                       SET deslikes = deslikes+1 
                       WHERE id = ".$artigo_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
         }
         else
         {
            
            $sql = "UPDATE artigos_usuarios_curtidas_bookmarks
                    SET curtiu = 0, descurtiu = 1 
                    WHERE artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "UPDATE artigos
                    SET likes = likes-1 
                    WHERE id = ".$artigo_id."  AND likes > 0 LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            if($deslikes == 0)
            {
               $sql = "UPDATE artigos
                       SET deslikes = deslikes+1 
                       WHERE id = ".$artigo_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
            
         }


            $this->notificacao("Voc&ecirc; descurtiu o coment&aacute;rio.", "green");

         header("Location: ".$origem);         
      }
      

      function bookmarkArtigo()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$artigo_id = $this->blockrequest($_REQUEST['id']);
         
         $sql = "SELECT COUNT(id) AS total FROM artigos_usuarios_curtidas_bookmarks
                 WHERE bookmark = 1
                 AND artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->f("total") == 0)
         {
         
            $sql = "UPDATE artigos_usuarios_curtidas_bookmarks
                    SET bookmark = 1 
                    WHERE artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            if($db->affected_rows() == 0)
            {
               $sql = "INSERT INTO artigos_usuarios_curtidas_bookmarks(usuario_id, bookmark, artigo_id) VALUES (".$_SESSION['id'].", 1, ".$artigo_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }


            $this->notificacao("Voc&ecirc; marcou o artigo.", "green");
         }
         else
         {
            $sql = "UPDATE artigos_usuarios_curtidas_bookmarks
                    SET bookmark = 0 
                    WHERE artigo_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $this->notificacao("Voc&ecirc; desmarcou o artigo.", "green");
         }
         
         header("Location: ".$origem);         
      }

   public static function slugify($text)
   {
     // replace non letter or digits by -
     $text = preg_replace('~[^\pL\d]+~u', '-', $text);

     // transliterate
     $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

     // remove unwanted characters
     $text = preg_replace('~[^-\w]+~', '', $text);

     // trim
     $text = trim($text, '-');

     // remove duplicate -
     $text = preg_replace('~-+~', '-', $text);

     // lowercase
     $text = strtolower($text);

     if (empty($text)) {
       return 'n-a';
     }

     return $text;
   }
   
   function javascriptRedirect($url)
   {
      echo '<script language="javascript">location="'.$url.'";</script>';
   }
   
   function boxMeusDados()
   {
      @session_start();
      
      $db = new db();
      
      if(!isset($_SESSION['id']))
         $box = '';
      else
      {


         $sql = "SELECT COUNT(id) AS total, SUM(likes) AS curtidas FROM artigos WHERE usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $totalArtigos = $db->f("total");
         $totalCurtidas = $db->f("curtidas");

         $sql = "SELECT COUNT(id) AS total FROM artigos_usuarios_curtidas_bookmarks WHERE usuario_id = ".$_SESSION['id']." AND bookmark = 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $totalArtigosMarcados = $db->f("total");


         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios_curtidas_bookmarks WHERE usuario_id = ".$_SESSION['id']." AND bookmark = 1";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $totalCursosMarcados = $db->f("total");

         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios WHERE usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $totalCursos = $db->f("total");
         
         $box = '<div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Meus Dados</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group list-group-no-icon">
                                       <!-- CONTENT -->
                                       <div class="list-group-item">
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'perfil/cursos"><i class="material-icons">school</i> Cursos Inscritos</a></h3>
                                                                   <small>total: '.$totalCursos.'</small>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>

                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'perfil/artigos"><i class="material-icons">class</i> Meus Artigos</a></h3>
                                                                   <small>total '.$totalArtigos.'</small>
                                                                   <small>curtidas: '.$totalCurtidas.'</small>
                                                               </header>
                                                           </div>
                                                               <div class="list-group-separator"></div>

                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'perfil/artigosMarcados"><i class="material-icons">bookmark</i> Artigos Salvos</a></h3>
                                                                   <small>total: '.$totalArtigosMarcados.'</small>
                                                               </header>
                                                           </div>
                                                      <div class="list-group-separator"></div>

                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'perfil/cursosMarcados"><i class="material-icons">bookmark</i> Cursos Salvos</a></h3>
                                                                   <small>total: '.$totalCursosMarcados.'</small>
                                                               </header>
                                                           </div>
                                                      <div class="list-group-separator"></div>
                                                           <div class="row-topic">
                                                               <header class="topic-title clearfix">
                                                                   <h3><a href="'.ABS_LINK.'perfil/novoArtigo"><i class="material-icons">create</i> Criar Novo Artigo</a></h3>
                                                               </header>
                                                           </div>
                                                      <div class="list-group-separator"></div>
                                                      
                                                       
                                       <!-- CONTENT -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>';
      }
         
         
         return $box;
   }
   
   
function likeCurso()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$curso_id = $this->blockrequest($_REQUEST['id']);
         
         
         
         // Só deixa ele curtir se ainda não tiver curtido
         $sql = "SELECT COUNT(id) AS total, curtiu AS likes FROM cursos_usuarios_curtidas_bookmarks
                 WHERE curso_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $likes = $db->f("likes");
         if($db->f("total") == 0)
         {

               $sql = "INSERT INTO cursos_usuarios_curtidas_bookmarks(usuario_id, curtiu, curso_id) VALUES (".$_SESSION['id'].", 1, ".$curso_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "UPDATE cursos
                       SET likes = likes+1 
                       WHERE id = ".$curso_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
         }
         else
         {
            
            $sql = "UPDATE cursos_usuarios_curtidas_bookmarks
                    SET curtiu = 1, descurtiu = 0 
                    WHERE curso_id = ".$curso_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "UPDATE cursos
                    SET deslikes = deslikes-1 
                    WHERE id = ".$curso_id." AND deslikes > 0 LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            if($likes == 0)
            {
            
               $sql = "UPDATE cursos
                       SET likes = likes+1 
                       WHERE id = ".$curso_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
            
         }
            $this->notificacao("Voc&ecirc; curtiu o curso.", "green");
         
         header("Location: ".$origem);         
      }

      function deslikeCurso()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$curso_id = $this->blockrequest($_REQUEST['id']);
         
         
         
         // Só deixa ele descurtir se ainda não tiver descurtido
         $sql = "SELECT COUNT(id) AS total, descurtiu AS deslikes FROM cursos_usuarios_curtidas_bookmarks
                 WHERE curso_id = ".$curso_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         $deslikes = $db->f("deslikes");
         if($db->f("total") == 0)
         {

               $sql = "INSERT INTO cursos_usuarios_curtidas_bookmarks(usuario_id, descurtiu, curso_id) VALUES (".$_SESSION['id'].", 1, ".$curso_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();


               $sql = "UPDATE cursos
                       SET deslikes = deslikes+1 
                       WHERE id = ".$curso_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
         }
         else
         {
            
            $sql = "UPDATE cursos_usuarios_curtidas_bookmarks
                    SET curtiu = 0, descurtiu = 1 
                    WHERE curso_id = ".$artigo_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $sql = "UPDATE cursos
                    SET likes = likes-1 
                    WHERE id = ".$curso_id."  AND likes > 0 LIMIT 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            if($deslikes == 0)
            {
               $sql = "UPDATE cursos
                       SET deslikes = deslikes+1 
                       WHERE id = ".$curso_id." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }
            
         }


            $this->notificacao("Voc&ecirc; descurtiu o curso.", "green");

         header("Location: ".$origem);         
      }
      

      function bookmarkCurso()
      {
			@session_start();
			$db = new db();
         
         $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];

         @$curso_id = $this->blockrequest($_REQUEST['id']);
         
         $sql = "SELECT COUNT(id) AS total FROM cursos_usuarios_curtidas_bookmarks
                 WHERE bookmark = 1
                 AND curso_id = ".$curso_id." AND usuario_id = ".$_SESSION['id']." ";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         if($db->f("total") == 0)
         {
         
            $sql = "UPDATE cursos_usuarios_curtidas_bookmarks
                    SET bookmark = 1 
                    WHERE curso_id = ".$curso_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            if($db->affected_rows() == 0)
            {
               $sql = "INSERT INTO cursos_usuarios_curtidas_bookmarks(usuario_id, bookmark, curso_id) VALUES (".$_SESSION['id'].", 1, ".$curso_id.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
            }


            $this->notificacao("Voc&ecirc; salvou o curso.", "green");
         }
         else
         {
            $sql = "UPDATE cursos_usuarios_curtidas_bookmarks
                    SET bookmark = 0 
                    WHERE curso_id = ".$curso_id." AND usuario_id = ".$_SESSION['id']." ";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            $this->notificacao("Voc&ecirc; desmarcou o curso.", "green");
         }
         
         header("Location: ".$origem);         
      }
      
      function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
         $url = 'https://www.googleapis.com/oauth2/v4/token';			

         $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
         $ch = curl_init();		
         curl_setopt($ch, CURLOPT_URL, $url);		
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
         curl_setopt($ch, CURLOPT_POST, 1);		
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
         $data = json_decode(curl_exec($ch), true);
         $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
         if($http_code != 200) 
            throw new Exception('Error : Failed to receieve access token');

         return $data;
      } 
      
function GetUserProfileInfo($access_token) {	
	$url = 'https://www.googleapis.com/oauth2/v2/userinfo?fields=name,email,gender,id,picture,verified_email';	
	
	$ch = curl_init();		
	curl_setopt($ch, CURLOPT_URL, $url);		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
	$data = json_decode(curl_exec($ch), true);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);		
	if($http_code != 200) 
		throw new Exception('Error : Failed to get user information');
		
	return $data;
}  

function mailTemaple($titulo,$subtitulo = "",$conteudo, $call_to_action = "")
{
   $mailBody = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt">
  <head>
    <title>B&iacute;blia para Casais | Cursos, estudos, artigos, v&iacute;deos e mais!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180" href="https://bibliaparacasais.com.br/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="https://bibliaparacasais.com.br/favicon.ico" sizes="32x32">
    <link rel="icon" type="image/png" href="https://bibliaparacasais.com.br/favicon.ico" sizes="16x16">
    
    <link rel="shortcut icon" href="https://bibliaparacasais.com.br/favicon.ico">
    <style data-inlinestyle-ignore="true">
            /* CLIENT-SPECIFIC STYLES */
      body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
      table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
      /* ORIGINAL STYLES */
      body { color: #555555; font-family: "Helvetica Neue", "SF UI Text", "Roboto", Helvetica, Arial, sans-serif; height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; text-align: left; background-color: #f4f4f4; }
      .wrapper { width: 100%; background-color: #f4f4f4;}
      table { border-collapse: collapse; border-spacing: 0; }
        .page { width: 100%; max-width:600px; background-color: #f4f4f4; }
        .column { width: 100%; max-width: 500px; background-color: #f4f4f4; }
        .shadow { width: 98%; max-width: 500px; background-color: #ffffff; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.10); border-radius: 3px; text-align: left; }
        .basic { width: 84%; max-width: 420px; text-align: left; }
        .empty { width: 100%; max-width: 500px; margin-bottom: 50px; }
        .list { width: 100%; max-width: 420px; }
        .social { padding: 0 10px; }
      td { vertical-align: top; }
        .td-preview { padding: 20px 0 30px; }
        .td-header { padding-bottom: 20px; }
        .td-family { padding-top: 10px; text-align: center; }
        .td-content-container { padding-bottom: 50px; }
        .td-basic { padding-top: 20px; }
        .td-big-square { padding-top: 40px; }
        .td-passage { border-width: 0px 0px 0px 2px; border-style: solid; border-color: #dddddd; }
        .td-square { width: 100%; max-width: 197px; }
        .td-thumb { width: 28%; max-width: 90px; padding-bottom: 20px; }
        .td-list { padding-bottom: 20px; }
        .td-footnote { padding-bottom: 30px; }
        .td-footer-logo { padding-bottom: 20px; }
        .td-footer-apps { padding: 0px 8px 20px; }
        .td-social { padding: 0px 8px 26px; }
        .td-closing { padding-bottom: 20px; }
        .td-white-button { background-color: #ffffff; }
        .td-support-donate-spacer { max-width: 10px; min-width:10px; }
        .td-cta { margin: 0; padding: 0; color: #ffffff; background-color: #5ba779; border: 1px solid #5ba779; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-cta2 { margin: 0; padding: 0; color: #5ba779; background-color: #ffffff; border: 1px solid #5ba779; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-ctf { margin: 0; padding: 0; color: #4a4f9e; background-color: #ffffff; border: 1px solid #4a4f9e; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-ctt { margin: 0; padding: 0; color: #4898fb; background-color: #ffffff; border: 1px solid #4898fb; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-cti { margin: 0; padding: 0; color: #cd486b; background-color: #ffffff; border: 1px solid #cd486b; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-cte { margin: 0; padding: 0; color: #a47b5b; background-color: #ffffff; border: 1px solid #a47b5b; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-ctd { margin: 0; padding: 0; color: #000000; background-color: #ffffff; border: 1px solid #000000; border-collapse: collapse !important; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px !important; font-size: 15px; text-decoration: none; }
        .td-secondary-cta-l { width: 50%; text-align: left; padding-top: 15px; text-decoration: none; color: #5ba779; }
        .td-secondary-cta-r { width: 50%; text-align: right; padding-top: 15px; text-decoration: none; color: #5ba779; }
      p { color: #555555; font-size: 17px; font-weight: normal; line-height: 25px; }
        .p-boilerplate { color: #979797; font-size: 10px; line-height: 15px; }
        .p-preview { color: #979797; font-size: 10px; margin: 0; line-height: 15px; text-align: center; }
        .buffer { padding-bottom: 40px; margin-bottom: 0; }
        .btn-buffer { padding-bottom: 30px; margin-bottom: 0; }
        .buffer-half { padding-bottom: 20px; margin-bottom: 0; }
        .divider { width: 98%; max-width: 500px; letter-spacing: 6px; line-height: 30px; text-transform: uppercase; text-align: left; }
        .excerpt { color: #979797; font-size: 15px; font-style: italic; line-height: 22px; margin: 0; }
        .featured { color: #555555; font-weight: bold; margin-top: 0; margin-bottom: 8px; text-decoration: none; }
        .p-passage { font-style: italic; padding: 0 0 10px 0; margin: 0; }
        .p-quote { font-style: italic; padding: 0; margin: 0; }
        .p-reference { color: #979797; font-size: 13px; font-style: normal; padding: 0; margin: 0; }
        .sub { color: #979797; font-size: 13px; line-height: 20px; margin: 0; text-decoration: none; }
        .sub-no-desc { color: #979797; font-size: 13px; line-height: 20px; margin: 0; text-decoration: none; padding-bottom: 15px; }
        .list p { margin-top: 0; }
        .side-padding { padding-right: 20px; padding-left: 20px; }
        .p-white-big { color: #ffffff; font-size: 18px; font-weight: 900; margin-bottom: 0; padding: 0px; text-align: center; }
        .p-white-small { color: #ffffff; font-weight: 300; font-size: 15px; line-height: 18px; margin: 0px; padding-bottom: 10px; text-align: center; }
      sup { vertical-align: super; font-size: 11px; vertical-align: baseline; position: relative; top: -0.4em; }
      .p-boilerplate sup { font-size: 8px; }
      h1 { color: #000000; font-size: 30px; font-weight: bold; line-height: 40px; }
      h2 { color: #555555; font-size: 20px; font-weight: bold; line-height: 28px; }
      hr { display:block; height: 1px; border:0; border-top: 1px solid #dddddd; margin: 1em 0; padding: 0; }
      ul { font-size: 17px; font-weight: normal; line-height: 25px; list-style-type: square; padding: 0 0 0 2em; margin-bottom: 40px; }
      li { margin-bottom: 17px; }
      a, a:visited { text-decoration: none; border: 0 none; }
        .a-boilerplate { color: #006dbf; text-decoration: underline; }
        .a-boilerplate:hover, .a-boilerplate:visited  { color: #006dbf; }
        a.primary, a.primary:hover, a.primary:focus { color: #5ba779; text-decoration: none;}
        a.call_to_action_button, a.call_to_action_button:hover, a.call_to_action_button:focus { width: 100%; color: #ffffff; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #5ba779; border-radius: 4px; font-size: 15px; }
        a.call_to_action2_button, a.call_to_action2_button:hover, a.call_to_action2_button:focus { width: 100%; color: #5ba779; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #ffffff; border-radius: 4px; font-size: 15px; }
        a.secondary_cta, a.secondary_cta:hover, a.secondary_cta:focus { color: #5ba779; font-size: 12px; text-decoration: none; }
        a.call_to_facebook_button, a.call_to_facebook_button:hover, a.call_to_facebook_button:focus { width: 100%; color: #4a4f9e; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #ffffff; border-radius: 4px; font-size: 15px; }
        a.call_to_twitter_button, a.call_to_twitter_button:hover, a.call_to_twitter_button:focus { width: 100%; color: #4898fb; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #ffffff; border-radius: 4px; font-size: 15px; }
        a.call_to_instagram_button, a.call_to_instagram_button:hover, a.call_to_instagram_button:focus { width: 100%; color: #cd486b; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #ffffff; border-radius: 4px; font-size: 15px; }
        a.call_to_email_button, a.call_to_email_button:hover, a.call_to_email_button:focus { width: 100%; color: #a47b5b; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #ffffff; border-radius: 4px; font-size: 15px; }
        a.call_to_download_button, a.call_to_download_button:hover, a.call_to_download_button:focus { width: 100%; color: #000000; padding: 12px 0; margin: 0; text-align: center; text-decoration: none; display: inline-block; border: 0 solid #ffffff; border-radius: 4px; font-size: 15px; }
        .a-button-facebook, .a-button-facebook:hover, .a-button-facebook:focus { color: #4a4f9e; display: inline-block; font-size: 15px; border: 1px solid #4a4f9e; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-twitter, .a-button-twitter:hover, .a-button-twitter:focus { color: #4898fb; display: inline-block; font-size: 15px; border: 1px solid #4898fb; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-email, .a-button-email:hover, .a-button-email:focus { color: #a47b5b; display: inline-block; font-size: 15px; border: 1px solid #a47b5b; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-download, .a-button-download:hover, .a-button-download:focus { color: #000000; display: inline-block; font-size: 15px; border: 1px solid #000000; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-pinterest, .a-button-pinterest:hover, .a-button-pinterest:focus { color: #bd081c; display: inline-block; font-size: 15px; border: 1px solid #bd081c; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-instagram, .a-button-instagram:hover, .a-button-instagram:focus { color: #673e36; display: inline-block; font-size: 15px; border: 1px solid #673e36; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-download, .a-button-download:hover, .a-button-download:focus { color: #000000; display: inline-block; font-size: 15px; border: 1px solid #000000; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; text-decoration: none; }
        .a-button-sbb, .a-button-sbb:hover, .a-button-sbb:focus { color: #7a93c5; display: inline-block; font-size: 15px; border: 1px solid #7a93c5; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 7px 12px 7px 7px; margin-bottom: 1em; }
        .a-button-white { color: #555555; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; padding: 12px; background-color: #ffffff; }
        .featured:hover { color: #979797; }
        .sub:hover { color: #555555; }
        .visible { color: #555555; text-decoration: underline; }
        .visible:hover { color: #979797; }
        #outlook a { padding: 0; }
      img { border: 0 none; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        .img-shadow { width: 100%; max-width: 500px; height: auto; border: 0 none;}
        .img-social { width: 100%; max-width: 28px; height: auto; padding-right: 8px; }
        .img-social-gray { width: 100%; max-width: 28px; height: auto; }
        .img-basic { width: 100%; max-width: 420px; border: 0 none; }
        .img-square { width: 100%; max-width: 420px; height: auto; border: 0 none; }
        .img-thumb { width: 100%; max-width: 90px; height: auto; border: 0 none; }
        .img-max { width: 100%; max-width: 500px; border: 0 none; }
      @media screen and (min-width: 601px) {
        .page { width: 600px !important; }
      }
      @media only screen and (max-width: 600px) {
        .td-preview { padding: 10px 0 20px !important; }
        .td-content-container { padding-bottom: 5px !important; }
        .img-basic { width: 100% !important; border: 0 none !important; }
        .img-max { width: 100%; border: 0 none; }
        .td-thumb { width: 33% !important; padding-right: 15px !important; }
        p.divider { margin: 20px 0 15px 0 !important; padding: 0px !important; text-align: center !important; line-height: normal !important; }
        .p-preview { font-size: 8px !important; line-height: 12px !important; }
        .td-footer-logo { padding-top: 20px !important; }
        .td-footer-apps { padding: 0px 15px 20px !important; }
        .td-social { padding: 0px 15px 26px !important; }
        .td-support-donate-spacer { max-width: 25px !important; min-width: 25px !important;}
        .td-mobile { display: block !important; width: 100% !important; }
        .side-padding { padding-right: 0; padding-left: 0; }
      }
      @media only screen and (max-width: 500px) {
        .desktop-only { display: none !important; max-height: 0px !important; overflow: hidden !important; mso-hide: all !important;  } /* responsive line break - only displays on desktop */
      }
      /* ANDROID CENTER FIX */
      div[style*="margin: 16px 0"] { margin:0 !important; }
      /* iOS BLUE LINKS */
      a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
      /* OLD APPLE MAIL FIX */
      .webkit { max-width: 600px; margin: 0 auto; }
    </style>

    <!-- GENERIC DESCRIPTION (FOR GOOGLE, ET. AL.) -->
    <meta name="description" content="Deixe o Desafio Começar!">

    <!-- Gmail Promo Tab annotations code -->
    

    <!-- OPEN GRAPH MARKUP FOR FACEBOOK -->
    <!-- REFER TO https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="fb:app_id" content="105030176203924" />
    <!-- EMAIL SUBJECT, OR PRIMARY HEADLINE -->
    <meta property="og:title" content="Deixe o Desafio Começar!" />
    <!-- PRIMARY CALL TO ACTION (USE ONLY ONE) -->
    <meta property="og:description" content="O Desafio Semestral de 2019 começa AGORA." />
    <!-- THE STATIC URL OF THIS PAGE -->
    <meta property="og:site_name" content="Bibliaparacasais.com.br" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="pt_BR" />
    <!-- REFER TO https://www.facebook.com/translations/FacebookLocales.xml -->
    <meta property="og:locale:alternate" content="" />
    <!-- URL FOR IMAGE YOU WANT TO APPEAR IN SHARE -->
    <!-- IF VIDEO, THIS IS PREVIEW IMAGE -->
    <!-- MAX FILESIZE: 8MB -->
        <!-- HTTPS:// URL VERSION OF ABOVE IMAGE -->
    <meta property="og:image:secure_url" content="https://bibliaparacasais.com.br/images/" />
    <!-- SELECT ONE: image/jpeg OR image/gif OR image/png -->
    <meta property="og:image:type" content="image/jpeg" />
    <!-- PREFERRED: 1200x630 -->
    <!-- ACCEPTABLE: 600x315 -->
    <!-- MIN: 200x200 -->
    <!-- ASPECT RATIO: 1.91:1 (IDEAL) -->
    <!-- PRE-SCRAPE URL USING https://developers.facebook.com/tools/debug/ -->
    <meta property="og:image:width" content="640" />
    <meta property="og:image:height" content="360" />
    <!-- PREFERRED: HTTPS URL (TO PLAY IN-LINE IN NEWSFEED) -->
    <meta property="og:video" content="" />
    <meta property="og:video:secure_url" content="" />
    <!-- SELECT ONE: video/mp4 OR application/x-shockwave-flash -->
    <meta property="og:video:type" content="video/mp4" />
    <meta property="og:video:width" content="" />
    <meta property="og:video:height" content="" />
    <meta property="og:video:height" content="" />

     </head>
  <body>
<!-- BEGIN WRAPPER TABLE -->
    <center class="wrapper">
      <div class="webkit">
        <!--[if (gte mso 9)|(IE)]> <table align="center" border="0" cellspacing="0" cellpadding="0" width="600"> <tr> <td align="center" valign="top" width="600"> <![endif]-->
        <table class="page" align="center" cellpadding="0" cellspacing="0" width="100%">
<!-- BEGIN HEADER -->
          <tr>
            <td>
            <!--[if (gte mso 9)|(IE)]> <table align="center" border="0" cellspacing="0" cellpadding="15" width="500"> <tr> <td align="center" valign="top" width="500"> <![endif]-->
              <table class="column" align="center" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                <tr>
                  <td class="td-header" align="center">
                    <table border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td>
                          <a href="https://www.bibliaparacasais.com.br" target="_blank"><img src="https://bibliaparacasais.com.br/assets/images/biblia-sagrada-online-para-casais-redonda.png" align="center" height="50" style="max-height: 50px;" alt=""></a>
                        </td>
                        <td width="20" style="max-width: 20px; min-width: 20px;">&nbsp;
                          
                        </td>
                        <td style="vertical-align: middle;">
                          <a href="https://bibliaparacasais.com.br" style="font-size:36px; color:#666;" target="_blank">B&iacute;blia para casais</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]-->
            </td>
          </tr>
<!-- END HEADER -->

<!-- BEGIN BODY -->
          <tr>
            <td>
            <!--[if (gte mso 9)|(IE)]> <table align="center" border="0" cellspacing="15" cellpadding="0" width="500"> <tr> <td align="center" valign="top" width="500"> <![endif]-->
              <table class="column" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="td-content-container">
                    <table class="shadow" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>
                          <img src="https://bibliaparacasais.com.br/images/hero.jpg" class="img-max" width="500" alt="Desafio Semestral de 2019 - Mulher lendo Plano num tablete">

                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table class="basic" align="center">
                            <tr>
                              <td >
                                <h1>'.$titulo.'</h1>

                                 '.$conteudo.'
                                <h2>'.$subtitulo.'</h2>

                                </td>
                            </tr>
                          </table>
                          <table class="basic" align="center">
                            <tr>
                              <td>

                                <!-- CALL TO ACTION BUTTON -->
                                <table width="100%" style="width: 100% !important; margin: 0; padding: 0;">
                                  <tr style="padding: 0;">
                                    <td class="td-center-button" style="padding: 23px 0 20px 0;; margin: 0;">
                                      <table style="width: 100%; border-collapse: separate !important; padding: 0;">
                                        <tr style="padding: 0;">
                                          <td class="td-cta">
                                            <center data-parsed="" style="width: 100%;min-width: 0 !important;">
                                              '.$call_to_action.'
                                            </center>
                                          </td>
                                        </tr>
                                        
                                      </table>
                                    </td>
                                    <td style="padding: 0 !important;margin: 0;visibility: hidden;width: 0;border-collapse: collapse !important;"></td>
                                  </tr>
                                </table>
                                
                                <!-- END CALL TO ACTION BUTTON -->

                                </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <hr>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table class="basic" align="center">
                            <tr>
                              <td class="td-footnote" style="text-align: left;">&nbsp;</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>


              </table>
            <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]-->
            </td>
          </tr>
<!-- END BODY -->

<!-- BEGIN FOOTER -->
          <tr>
            <td>
            <!--[if (gte mso 9)|(IE)]> <table align="center" border="0" cellspacing="0" cellpadding="0" width="500"> <tr> <td align="center" valign="top" width="500"> <![endif]-->
              <table class="column footer" align="center">
                <tr>
                  <td align="center" class="td-footer-logo">
                    <a href="https://bibliaparacasais.com.br" style="font-size:36px; color:#666;" target="_blank">B&iacute;blia para casais</a>

                  </td>
                </tr>
                <tr>
                  <td>
                    <table class="social" align="center">
                      <tr>
                        <td align="center">
                        <a href="" target="_blank"><img src="https://bibliaparacasais.com.br/images/app-icon-pt.png"></a><br /><br />
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>
                    <table class="social" align="center">
                      <tr>
                        <td align="center" class="td-social">
                          <a href="#" target="_blank"><img src="https://bibliaparacasais.com.br/images/facebook@2x.png" alt="Facebook" class="img-social-gray" width="28"></a>
                        </td>
                        <td align="center" class="td-social">
                          <a href="#" target="_blank"><img src="https://bibliaparacasais.com.br/images/twitter@2x.png" alt="Twitter" class="img-social-gray" width="28"></a>
                        </td>
                        <td align="center" class="td-social">
                          <a href="#" target="_blank"><img src="https://bibliaparacasais.com.br/images/instagram@2x.png" alt="Instagram" class="img-social-gray" width="28"></a>
                        </td>
                        <td align="center" class="td-social">
                          <a href="#" target="_blank"><img src="https://bibliaparacasais.com.br/images/youtube@2x.png" alt="YouTube" class="img-social-gray" width="28"></a>
                        </td>
                        <td align="center" class="td-social">
                          <a href="#" target="_blank"><img src="https://bibliaparacasais.com.br/images/pinterest@2x.png" alt="Pinterest" class="img-social-gray" width="28"></a>
                        </td>
                        <td align="center" class="td-social">
                          <a href="#" target="_blank"><img src="https://bibliaparacasais.com.br/images/RSS@2x.png" alt="Blog" class="img-social-gray" width="28"></a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" class="td-closing">
                    <table border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td class="td-white-button">
                          <!--<a href="" target="_blank" class="a-button-white" style="border: 1px solid #ffffff;">Suporte</a>-->
                        </td>
                      </tr>
                    </table>
                    <p class="p-boilerplate" style="padding-top: 20px; margin-top: 12px">
                      Você está recebendo este e-mail porque está inscrito<br>nas notifica&ccedil;&otilde;es da B&iacute;blia Sagrada online para Casais.
                    </p>
                    <p class="p-boilerplate">
                      <a href="https://www.bibliaparacasais.com.br" class="a-boilerplate" target="_blank">
                        Atualize suas configurações de notificação</a>
                    </p>
                    <p class="p-boilerplate">
                      &copy;  <a href="http://www.institutoparacasais.com.br">Instituto para Casais.</a> / B&iacute;blia Sagrada online para Casais<br>
                     
                    </p>
                    <p class="p-boilerplate">
                      <a href="https://www.bibliaparacasais.com.br/termosdeuso" class="a-boilerplate" target="_blank">Política de Privacidade</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://www.bibliaparacasais.com.br/termosdeuso" class="a-boilerplate" target="_blank">Termos de Uso</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                      <a href="#" class="a-boilerplate" target="_blank">
                        Cancelar inscrição</a>
                    </p>
                  </td>
                </tr>
              </table>
            <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]-->
            </td>
          </tr>
<!-- END FOOTER -->

        </table>
      <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]-->
      </div>
    </center>
<!-- END WRAPPER  -->

  </body>
</html>';
   
   return $mailBody;
}
	
	function naoencontrado()
	{
		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();
		
		$GLOBALS["base"]->template->set_var('ABS_LINK',ABS_LINK);
		$GLOBALS["base"]->write_design_specific('home.tpl' , 'naoencontrado');
		$this->footer();
	
	}
   
   
   
}
?>