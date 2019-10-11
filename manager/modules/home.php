<?php 
require_once("modules/GCM.php");

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
			
			// Artigos Pendentes de Aprovação
         $sql = "SELECT artigos.id AS id,
               artigos.imagem_destaque AS imagem_destaque,
               artigos.titulo AS titulo,
               artigos_categorias.titulo AS categoria,
               DATE_FORMAT(artigos.dataCadastro,'%d/%m/%Y') AS dataCadastro,
               artigos.status AS situacao,
               usuarios.nome AS autor, 
               artigos.likes AS likes 
               FROM artigos, artigos_categorias, usuarios 
               WHERE /* artigos.categoria_id = artigos_categorias.id
               AND */ artigos.status = 0
               AND artigos.usuario_id = usuarios.id 
               ORDER BY artigos.id ASC ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$titulo = $db->f("titulo");
				$dataCadastro = $db->f("dataCadastro");
				$autor = $db->f("autor");
				$imagem_destaque = $db->f("imagem_destaque");

            if($imagem_destaque =="")
               $imagem_destaque = "http://www.placehold.it/60x60/EFEFEF/AAAAAA&amp;text=NENHUMA";
           
            
				$listagem_artigos_pendentes .= '<tr>
                           <td><img src="'.LINK_ORIGINAL.'/'.$imagem_destaque.'" width="60"></td>
										<td>'.$titulo.'</td>
										<td>'.$dataCadastro.'</td> 
										<td>'.$autor.'</td> 
										<td><a href="artigos/edita/'.$id.'" >Editar</a></td>
									</tr>';
            
            
   			$db->next_record();

         }
         
         // Comentários pendentes de aprovação
                 $sql = 'SELECT comentarios.id AS idComentario,
                        comentarios.conteudo AS conteudo,
                        DATE_FORMAT(comentarios.dataCadastro,"%d/%m/%Y") AS data_comentario,
                        usuarios.nome AS nome_usuario,
                        usuarios.avatar AS avatar,
                        comentarios.usuario_id AS autor,
                        comentarios.status AS situacao,
                        comentarios.tipo AS tipo,
                        comentarios_contexto_referencia.contexto_id,
                        comentarios.tipo
                        FROM comentarios, usuarios, comentarios_contexto_referencia, artigos 
                        WHERE comentarios.usuario_id = usuarios.id 
                        AND comentarios.id = comentarios_contexto_referencia.comentario_id
                        AND artigos.id = comentarios_contexto_referencia.contexto_id
                        AND comentarios.status = 0
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
				$situacao = $db->f("situacao");
				$tipo = $db->f("tipo");
            $contexto_id = $db->f("contexto_id");
            switch($tipo)
            {
               case "1":
                  $onde = "Artigo";
                  
                  $sql2 = "SELECT titulo FROM artigos WHERE id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo");
               break;

               case "2":
                  $onde = "Livro";
                  $sql2 = "SELECT livros.liv_nome AS titulo, versiculos.ver_capitulo FROM livros, versiculos WHERE livros.liv_id = versiculos.ver_liv_id AND versiculos.ver_id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo");
               break;

               case "3":
                  $onde = "Cap&iacute;tulo";
                  $sql2 = "SELECT livros.liv_nome AS titulo, versiculos.ver_capitulo FROM livros, versiculos WHERE livros.liv_id = versiculos.ver_liv_id AND versiculos.ver_id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo")." ".$db2->f("ver_capitulo");
               break;

               case "4":
                  $onde = "Curso";
                  $sql2 = "SELECT titulo FROM cursos WHERE id = ".$contexto_id." ";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();
                  $tituloContexto = $db2->f("titulo");
               break;
            
            }
            
            if(substr($avatar, 0,4) != "http")
               $avatar = LINK_ORIGINAL.'/'.$avatar;
            else
               $avatar = $avatar;      
            
            
            
				$listagem_comentarios_pendentes .= '<tr> 
										<td><img src="'.$avatar.'" width="60"></td>
										<td>'.$tituloContexto.'</td>
										<td>'.$data_comentario.'</td>
										<td>'.$conteudo.'</td>';

                              switch($situacao)
                              {
                                 case "0":
                                    $listagem_comentarios_pendentes .= '<td><a href="artigos/aprovaComentario/'.$idComentario.'/'.$contexto_id.'" onclick="return(confirm(\'Confirma aprovar o comentario?\'))">APROVAR</a></td>';
                                 break;

                                 case "1":
                                     $listagem_comentarios_pendentes .= "<td>Aprovado</td>";
                                 break;
                              }
            
            																
									 $listagem_comentarios_pendentes .= '<td><a href="artigos/excluiComentario/'.$idComentario.'/'.$contexto_id.'" onclick="return(confirm(\'Deseja excluir o comentario?\'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }
         
         // Novos usuários cadastrados
			
			$sql = "SELECT
                  usuarios.id AS id
                  , usuarios.nome
                  , usuarios.email
                  , usuarios.origem
                  , usuarios.status AS situacao
                  , DATE_FORMAT(usuarios.data_cadastro,'%d/%m/%Y') AS data_cadastro
                  , planos.titulo AS plano
                  , cidades.cidade AS cidade
                  , estados.prefixo AS estado
                  FROM
                  usuarios,
                  cidades,
                  estados,
                  planos
                  WHERE usuarios.id_plano = planos.id
                  AND usuarios.estado = estados.id
                  AND usuarios.cidade = cidades.id
                  AND cidades.id_estados = estados.id
                  ORDER BY usuarios.id DESC LIMIT 100";
				
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id_usuario = $db->f("id");			
				$nome = $db->f("nome");			
				$email = $db->f("email");
				$cidade = $db->f("cidade");
				$estado = $db->f("estado");
				$origem = $db->f("origem");
				$situacao = $db->f("situacao");
				$plano = $db->f("plano");
				$data_cadastro = $db->f("data_cadastro");
            
            switch($situacao)
            {
               case "1":
                  $situacao = "Ativo";
               break;

               case "5":
                  $situacao = "Pendente de Ativar";
               break;

               case "0":
                  $situacao = "Banido";
               break;

               case "2":
                  $situacao = "Conta Desativada";
               break;
            
            }
				
				$listagem_novos_usuarios .= '<tr> 
										<td>'.$nome.'</td>
										<td>'.$email.'</td>
										<td>'.$origem.'</td>
										<td>'.$situacao.'</td>
										<td>'.$plano.'</td> 
										<td>'.$data_cadastro.'</td> 
										<td><a href="contas/edita/'.$id_usuario.'" >Editar</a></td>
										<td><a href="contas/exclui/'.$id_usuario.'" onclick="return(confirm(\' !! ATENÇÃO !! \n\n Deseja excluir o usuario '.$nome.' ?  \n\n ESTA AÇÃO NÃO PODERÁ SER DESFEITA \'))">Excluir</a></td>										
									</tr>';
				
				
				
				
				$db->next_record();
			}
         
         // Atividade Recente
         $sql = "SELECT log.id AS id, log.acao, DATE_FORMAT(log.data,'%d/%m/%Y') AS data, usuarios.nome AS nome_usuario 
                 FROM log, usuarios 
                 WHERE log.id_usuario = usuarios.id 
                 ORDER BY log.id DESC LIMIT 0,200";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$acao = $db->f("acao");
				$nome_usuario = $db->f("nome_usuario");
				$data = $db->f("data");
            
				$listagem_atividade_recente .= '<tr> 
										<td>'.$nome_usuario.'</td>
										<td>'.$acao.'</td>
										<td>'.$data.'</td> 
										<td><a href="registros/exclui/'.$id.'" onclick="return(confirm(\'Deseja excluir o registro de log ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();

			$GLOBALS["base"]->template->set_var('listagem_novos_usuarios',$listagem_novos_usuarios);
			$GLOBALS["base"]->template->set_var('listagem_atividade_recente',$listagem_atividade_recente);
			$GLOBALS["base"]->template->set_var('listagem_artigos_pendentes',$listagem_artigos_pendentes);
			$GLOBALS["base"]->template->set_var('listagem_comentarios_pendentes',$listagem_comentarios_pendentes);
		    $GLOBALS["base"]->write_design_specific('home.tpl' , 'main_home');
			$this->footer();
	}
	
	
	function busca()
	{
		header("Location: home");	
	}
	
function cabecalho()
	{	
		/* Monta o cabeÃ§alho que serÃ¡ comum em todas as pÃ¡ginas do admin */ 
		@session_start();
		$db = new db();
		
		$sql = "SELECT id FROM admin_usuarios WHERE id = ".$_SESSION['adm_boss']." ";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		if($db->num_rows() == 0)
		{
			header("Location: ".ABS_LINK."login/logout");
			die();	
		}
		
		
		if(isset($_SESSION['msg']))
      {
         
           @$mensagem = $_SESSION['msg']["mensagem"];
         $tm =  $_SESSION['msg']["tm"];
         $float =  $_SESSION['msg']["float"];
        
            
        if(!$float || $float == "0") // menssagem no topo
        {        
        
            if($tm)
            {
                switch($tm)
                {
                    case "green":
                    $tipo_msg = 'alert alert-success';
                    break;    
    
                    case "red":
                    $tipo_msg = 'alert alert-danger';
                    break;    
    
                    case "yellow":
                    $tipo_msg = 'alert alert-warning ';
                    break;    
    
                    case "blue":
                    $tipo_msg = 'alert alert-info';
                    break;
                    
                    default: $tipo_msg = 'alert alert-info';     
                    
                }
            }
            else
                $tipo_msg = 'alert alert-info';     
            
            
                @$mess = '<div class="'.$tipo_msg.'">
                           <button class="close" data-dismiss="alert"></button>
                           '.$mensagem.'
                        </div> <div class="portlet-body">';
        }

                $GLOBALS["base"]->template->set_var('msg' ,$mess);

            unset($_SESSION['msg']);
      }
      else
                $GLOBALS["base"]->template->set_var('msg' ,'');
		if(USE_AVATAR == 1)
		{
			
			
			$sql = "SELECT avatar FROM admin_usuarios WHERE id = ".$_SESSION['adm_boss']." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			if($db->f("avatar") == "")
			$GLOBALS["base"]->template->set_var('avatar' ,'<img src="http://www.placehold.it/40x40/EFEFEF/AAAAAA&amp;text=sem+foto" border="0" >');
			else
			$GLOBALS["base"]->template->set_var('avatar' ,'<img src="'.$db->f("avatar").'" class="img-circle" >');

		}

		$GLOBALS["base"]->template->set_var('usuario_nome' ,$_SESSION['adm_nome']);
		$GLOBALS["base"]->template->set_var('email' ,$_SESSION['adm_email']);
		
		
		/* Define o titulo da pagina que aparece no meio preto no cabeÃ§alho */
		
		if($_REQUEST['module'])
		{
			$linkMenu = "index.php?module=".$_REQUEST['module']."&method=".$_REQUEST['method'];
			
			$sql = "SELECT descricao FROM admin_menu_itens WHERE link LIKE '%".$linkMenu."%' LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			if($db->num_rows() > 0)
				$page_title = $db->f("descricao");
			else
			{
				if($_REQUEST['module'] == "home" && $_REQUEST['method'] == "main")
					$page_title = PAGINA_INICIAL;
				else
					$page_title = "";
			}
		}
		else
		{
			$page_title = "";
		}


		$GLOBALS["base"]->template->set_var('ABS_LINK' ,ABS_LINK);
		$GLOBALS["base"]->template->set_var('TITULO_SISTEMA' ,TITULO_SISTEMA." - ".$page_title);
		$GLOBALS["base"]->template->set_var('page_title' ,$page_title);
		$GLOBALS["base"]->template->set_var('module_busca' ,$_REQUEST['module']);


		if($_REQUEST['q'])
			$q = $_REQUEST['q'];
		else
			$q = "Buscar";
				
		$GLOBALS["base"]->template->set_var('q', $q);

		$this->breadcrumbs();
		
		$this->monta_menu();

		$this->notifications($_SESSION['adm_id']);

		echo $GLOBALS["base"]->write_design_specific('home.tpl' , 'cabecalho');
	}
	
	function footer()
	{
		$GLOBALS["base"]->template->set_var('msg2' ,"");

		$GLOBALS["base"]->template->set_var('msg_error' ,"");


		$GLOBALS["base"]->template->set_var('ABS_LINK' ,ABS_LINK);
		$GLOBALS["base"]->template->set_var('TITULO_SISTEMA' ,TITULO_SISTEMA);

		echo '<script language="javascript">document.getElementById("overover").style.display="none";</script>';

		echo $GLOBALS["base"]->write_design_specific('home.tpl' , 'footer');
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

			$sql = "INSERT INTO log (id_usuario, acao, data) VALUES (".$_SESSION['adm_id'].", '".$acao."', NOW())";			
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
		}
		
		
		function breadcrumbs()
		{
			@session_start();
			$db = new db();

			$breadcrumbs = ' <li><a href="home">In&iacute;cio</a> <i class="fa fa-angle-right"></i></li>';
			
			if(
				($_REQUEST['module'] && $_REQUEST['method']) 
				&& 
				($_REQUEST['module'] != "home")
			 )	
				{
				$linkMenu = $_REQUEST['module']."/".$_REQUEST['method'];			
			
	
				$sql = "SELECT id_area, descricao FROM admin_menu_itens WHERE link LIKE '%".$linkMenu."%' LIMIT 1 ";
				$db->query($sql,__LINE__,__FILE__);
				$db->next_record();
				if($db->num_rows() > 0)
				{
					$menuItem = $db->f("descricao");
					$idArea = $db->f("id_area");
					
					$sql = "SELECT descricao FROM admin_areas WHERE id = ".$idArea." ";
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
		/* Monta o menu superior de acordo com as permissÃµes do usuÃ¡rio que estÃ¡ logado */	
		@session_start();
		
		$db = new db();
		$db2 = new db();
		$db3 = new db();
		$db4 = new db();
		$db5 = new db();
		$db6 = new db();
		$db7 = new db();
		$db8 = new db();
		
		if($_REQUEST['module'] && $_REQUEST['method'])
			$uri = $_REQUEST['module']."/".$_REQUEST['method'];
		else
			$uri = "";
			
		$privilegios = $_SESSION['adm_grantees'];
		$menu_itens_access = array();


		$sql = "SELECT id FROM admin_menu_itens";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
         if(ACTIVE_GRANTEES == 1)
         {

            if(array_key_exists("area_".$db->f("id"),$_SESSION['adm_grantees']) && $_SESSION['adm_grantees']["area_".$db->f("id")] == "1")
            {
               array_push($menu_itens_access,$db->f("id"));
            }
         }
         else 
         {
               array_push($menu_itens_access,$db->f("id"));
            
         }

			$db->next_record();
		}
		
		$menu_itens_access = implode(",",$menu_itens_access);
		
		$area_access = array();

		$sql = "SELECT distinct(id_area) FROM admin_menu_itens WHERE id IN (".$menu_itens_access.")";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($i = 0; $i < $db->num_rows(); $i++)
		{
			array_push($area_access,$db->f("id_area"));
	
			$db->next_record();
		}
		
		$area_access = implode(",",$area_access);
		
		/*
		*  Monta o menu dependendo do produto selecionado
		*/
		$menu = "";
		
		if(($_REQUEST['module'] == "home" && $_REQUEST['method'] == "main") || !$_REQUEST['module'])
			$menu .= '<li class="nav-item start active">';
		else
			$menu .= '<li class="nav-item start">';	
		
		$menu .= '<a href="home" class="nav-link ">
            <i class="icon-home"></i>
            <span class="title">'.PAGINA_INICIAL.'</span>
            <span class="arrow"></span>
        </a>';
									
		
		$sql = "SELECT * FROM admin_areas WHERE id IN (".$area_access.") ORDER BY ordem ASC";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		for($f = 0; $f < $db->num_rows(); $f++)
		{


			$sql8 = "SELECT id_area FROM admin_menu_itens WHERE link LIKE '%".$uri."%' AND id IN (".$menu_itens_access.") ORDER BY id ASC";
			$db8->query($sql8,__LINE__,__FILE__);
			$db8->next_record();
			
			// BEGIN AREA ////////
			
			if($db8->f("id_area") ==  $db->f("id"))
				$menu .= '<li class="nav-item  active">';
			else
				$menu .= '<li class="nav-item  ">';
				
			$menu .= '<a href="javascript:;" class="nav-link nav-toggle">';
			$menu .= '<i class="'.$db->f("icon").'"></i>';
            
            $menu .= '<span class="title">'.$db->f("descricao").'</span> <span class="arrow"></span></a>';
			
			// END AREA ////////

			// BEGIN NIVEL 1 ////////
			
			$menu .= '<ul class="sub-menu">';	
			
			$sql2 = "SELECT * FROM admin_menu_itens WHERE nivel = 1 AND id_area = ".$db->f("id")." AND id IN (".$menu_itens_access.")";
			$db2->query($sql2,__LINE__,__FILE__);
			$db2->next_record();
			
			
			for($g = 0; $g < $db2->num_rows(); $g++)
			{

			$menu .= '<li class="nav-item  ';

				if($db2->f("list") == 1)
					$menu .= ' nav-toggle" >';
				else
					$menu .= '" >';
				
				$menu .= ' <a href="'.$db2->f("link").'" class="nav-link ">';
						
						
							$menu .= '<span class="title">'.$db2->f("descricao").'</span>';
						
				$menu .= '</a>';
				
				
			
			$sql3 = "SELECT * FROM admin_menu_itens WHERE nivel = 2 AND id_pai = ".$db2->f("id")." ";
			$db3->query($sql3,__LINE__,__FILE__);
			$db3->next_record();
			$linhas3 = $db3->num_rows();
				
			if($linhas3 > 0)
				$menu .= '<ul class="sub-menu">';

				for($h = 0; $h < $db3->num_rows(); $h++)
				{


		
					$menu .= '<li class="nav-item  ';
		
						if($db3->f("list") == 1)
							$menu .= ' nav-toggle" >';
						else
							$menu .= '" >';
						
						$menu .= ' <a href="'.$db3->f("link").'" class="nav-link ">';
						
						
								
									$menu .= '<span class="title">'.$db3->f("descricao").'</span>';
								
						$menu .= '</a>';




						$sql4 = "SELECT * FROM admin_menu_itens WHERE nivel = 3 AND id_pai = ".$db3->f("id")." ";
						
						$db4->query($sql4,__LINE__,__FILE__);
						$db4->next_record();
						
						$linhas4 = $db4->num_rows();
						
						if($linhas4 > 0)
							$menu .= '<ul class="sub-menu">';

						for($i = 0; $i < $db4->num_rows(); $i++)
						{
							

			
							$menu .= '<li class="nav-item  ';
				
								if($db4->f("list") == 1)
									$menu .= ' nav-toggle" >';
								else
									$menu .= '" >';
								
								$menu .= ' <a href="'.$db4->f("link").'" class="nav-link ">';
								
								
										
										
											$menu .= '<span class="title">'.$db4->f("descricao").'</span>';
										
								$menu .= '</a>';
			
							$menu .= '</li>';
	
	
								$db4->next_record();
						}

						if($linhas4 > 0)
							$menu .= '</ul>';
							
							$menu .= '</li>';

	
					
					$db3->next_record();
				}

						if($linhas3 > 0)
							$menu .= '</ul>';

							$menu .= '</li>';

				
				$db2->next_record();

		
			}

				$menu .= '</ul></li>';				

				// END NIVEL 1 ////////
		
			$db->next_record();
		}
		

			$GLOBALS["base"]->template->set_var("menu",$menu);
		
	}
	
	function valida_privilegios()
	{
		@session_start();
		$db = new db();
		
		if(ACTIVE_GRANTEES == 1)
		{
			$main_module = $_REQUEST['module'];
			$main_method = $_REQUEST['method'];
			$main_url = 'index.php?module='.$main_module.'&method='.$main_method;
			
			
			$sql = "SELECT id FROM admin_menu_itens WHERE link LIKE '%".$main_url."%' LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			if($db->num_rows() > 0)
			{
			
				$id_secao = $db->f("id");
						
				
				/* Método para validação de permissão por área */
				if($_SESSION['adm_grantees']["area_".$id_secao] == 0)
				{
					header("Location: home");
					die();
				}
			}
		}
					
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
				WHERE id_usuario = ".$_SESSION['adm_id']."  
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
		
		$sql = "UPDATE notifications SET status = 1 WHERE id = ".$idNotification." AND id_usuario = ".$_SESSION['adm_id']." ";
		$db->query($sql,__LINE__,__FILE__);
		$db->next_record();
		
	}
	
      function notificacao($mensagem,$cor)
      {
         $_SESSION['msg'] = array("mensagem"=>$mensagem,"tm"=>$cor,"mt"=>"air");
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
      
 function mailTemaple($titulo,$subtitulo = "",$conteudo, $call_to_action = "")
{
   $mailBody = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

function sendPush($title, $msg, $link)
{
   
         @session_start();
         $db = new db();

   
            $sql = "SELECT * FROM users WHERE user_android_token IS NOT NULL AND user_android_token <> ''";
         $db->query($sql,__LINE__,__FILE__);
         $db->next_record();
         
         $qtd_envios = $db->num_rows() ;

            $android_tokens = array();
            $x=0;
            $i=0;
            if ( $db->num_rows() > 0) {
                // output data of each row
             for($i = 0; $i < $db->num_rows(); $i++) 
             {
              $android_tokens[$i][] = $db->f("user_android_token");
              $x++;
              // I need divide the array for 1000 push limit send in one time
              if ($x % 800 == 0) {
                $i++;
              }  
              
              $db->next_record();
              
                }
                
                  
                
            }
            
            $ip= $_SERVER['REMOTE_ADDR'];
            
            $sql = "SELECT * FROM notificacoes WHERE notification_sender_ip = '".$ip."' AND  notification_date > DATE_SUB(NOW(),INTERVAL 5 MINUTE)";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            if ($db->num_rows() > 2) {
               
                     $this->notificacao("Proteção anti flood. Você só pode enviar 3 notificações a cada 5 minutos.","red");
                      header("Location: ".ABS_LINK."notificacoes/novo");
                      die();

            }
            if ($android_tokens != array()) {
                $gcm=new GCM();
                
                $data=array("title"=>$title,"description"=>$msg,"link"=>$link);
                foreach ($android_tokens as $tokens) {
                  $result_android = $gcm->send_notification($tokens,$data);
                  sleep(1);
                }
                

                $sql = "INSERT INTO notificacoes (notification_title, notification_text, notification_extra, notification_sender_ip, notification_date, qtd_envios) VALUES ('$title', '$msg', '$link', '{$_SERVER['REMOTE_ADDR']}', NOW(), ".$qtd_envios.")";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
                          $this->notificacao("Notificação enviada com sucesso!.","green");
                        header("Location: ".ABS_LINK."notificacoes/novo");

            }

}

      	
}

?>