<?php
//require_once("modules/home.php");  

class login
{
	
	/** OS SEGUINTES DADOS DO USUÁRIO SÃO ARMAZENADOS EM SESSÕES:
	*
	*				$_SESSION['logado'] = "rRJ4fvbvtvgcf";
	*				$_SESSION['id']
	*				$_SESSION['nome']		
	*				$_SESSION['email']
	*				$_SESSION['alert_daily']
	*				$_SESSION['boss']
	*				$_SESSION['idioma']		
	*				$_SESSION['avatar']		
	*				$_SESSION['pagina']		
    */
	
	
	function main()
	{
		$db = new db();

		@session_start();
      
      if(isset($_SESSION['id']))
      {
         header("Location: ".ABS_LINK."home");
         die();
      }
      
      $google_login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

   		$GLOBALS["base"]->template->set_var('google_login_url' ,$google_login_url);      
			$GLOBALS["base"]->template->set_var("ANALYTICS",ANALYTICS);
			$GLOBALS["base"]->template->set_var('msg_error' , '');
         
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
               $cor = "green1";
               $icone = "fa-check";
              break;

              case "red":
               $cor = "red2";
               $icone = "fa-times-circle";
              break;

              case "blue":
               $cor = "blue2";
               $icone = "fa-cog";
              break;

              case "yellow":
               $cor = "yellow1";
               $icone = "fa-exclamation-triangle";
              break;
           
           }
        }
      
      
      $mess = '<br><div class="shadow-large alert alert-small alert-round-medium bg-'.$cor.'-dark" style="z-index:99999;">
                <i class="fa '.$icone.'"></i>
                <span>'.$mensagem.'</span>
                <i class="fa fa-times"></i>
            </div>';

                $GLOBALS["base"]->template->set_var('msg' ,$mess);

            unset($_SESSION['msg']);
      }
      else
                $GLOBALS["base"]->template->set_var('msg' ,'');
			
         $GLOBALS["base"]->write_design_specific('login.tpl' , 'login');


	}
		
	
	function logar()
	{	
		/**
		*	Método principal de login ao sistema
		*/

		$db = new db();
		$db2 = new db();
		
		@session_start();
		
		$login = $_POST['login'];
		$senha = $_POST['senha'];
      
      $_SESSION['msg'] = "";
		
		$login = $this->blockrequest($login);
		$senha = $this->blockrequest($senha);	

      
		if($_POST['login'] && $_POST['senha'])
		{	
			$sql = "SELECT * FROM usuarios
					WHERE ( email = '".$login."' AND senha = MD5('".$senha."')) AND (status = 1) limit 1";
         
									
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
					
			if($db->num_rows() > 0)
			{
            
					/* Guarda em sessão todos os parâmetros utéis do usuário */
					$_SESSION['logado'] = "rRJ4fvbvtvgcf";
					$_SESSION['id'] = $db->f("id");		
					$_SESSION['nome'] = $db->f("nome");		
					$_SESSION['email'] = $db->f("email");
					$_SESSION['alert_daily'] = $db->f("alert_daily");		
					$_SESSION['boss'] = $db->f("usuario_master");		
					$_SESSION['idioma'] = $db->f("idioma");
               
               
               // cria um cookie e grava no banco
   
           //    $cookievalue = substr(md5(md5(time()).rand(6,9)),0,10);
               $cookievalue = $_SESSION['id'];	
               setcookie('bibliapcid', $cookievalue, (time() + (30 * 24 * 3600)));
               
               $sql = "INSERT INTO user_session
                        (id_usuario,
                        session_id,
                        ip,
                        dataCadastro)
                        VALUES (".$_SESSION['id'].",
                        '".$cookievalue."',
                        '".$_SERVER['REMOTE_ADDR']."',
                        NOW()) ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
               
               
               if(substr($db->f("avatar"),0,4) == "http")
                       $_SESSION['avatar'] = $db->f("avatar");
               else
   					$_SESSION['avatar'] = LINK_ORIGINAL."/".$db->f("avatar");		
	
               $_SESSION['telefone'] = $db->f("telefone");		
               
               $sql = "UPDATE usuarios SET online = 1 WHERE id = ".$_SESSION['id']." LIMIT 1";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
               
               if(ACTIVE_GRANTEES == 1)
                  $this->gera_permissoes($_SESSION['id']); // Chama a função que define as áreas que o usuário tem acesso.
			

				if($db->f("avatar") == "")
            {
					$avatar = 'http://www.placehold.it/60x60/EFEFEF/AAAAAA&amp;text=sem+imagem';
					$_SESSION['avatar'] = $avatar;		
            }
				else
            {
					$avatar = $db->f("avatar");
					$_SESSION['avatar'] = $db->f("avatar");		
            }
					
					
					if(date("H") > 00 && date("H") < 12)
						$saudacao = "Bom dia";

					if(date("H") >= 12 && date("H") < 18)
						$saudacao = "Boa tarde";


					if(date("H") >= 18 && date("H") <= 23)
						$saudacao = "Boa noite";

				
               $this->notificacao($saudacao.", ".$_SESSION['nome']."! Seja Bem-vindo(a)!", "green");
      //   		header("Location: ".ABS_LINK."/home");
               $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];
               header("Location: ".ABS_LINK."home");

			}
         else 
         {
            $sql = "SELECT * FROM usuarios
                  WHERE ( email = '".$login."' AND senha = MD5('".$senha."')) AND (status = 5) limit 1";
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            
            
            if($db->num_rows() > 0)
            {
         		header("Location: ".ABS_LINK."cadastro/unconfirmed");
               
            }
            else
            {
               $this->notificacao("Dados de acesso incorretos!", "red");
         		header("Location: ".ABS_LINK."login");
               
            }
            
         }
		}
			
	}
	
			
	function logout()
	{
      @session_start();	
		$db = new db();
      
      if(!$_SESSION['id'])
      {
         header("Location: ".ABS_LINK."login");
         die();
      }

      $sql = "UPDATE usuarios SET online = 0 WHERE id = ".$_SESSION['id']." LIMIT 1";
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      
      
      $sql = "DELETE FROM user_session WHERE id_usuario = '".$_SESSION['id']."' ";
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      
      setcookie('bibliapcid');
      $_COOKIE['bibliapcid'] = "";
      

		unset($_COOKIE['bibliapcid']);
		unset($_SESSION['id']);
		unset($_SESSION['nome']);
		unset($_SESSION['email']);
		unset($_SESSION['telefone']);
		unset($_SESSION['logado']);
		unset($_SESSION['alert_daily']);
		unset($_SESSION['boss']);
		unset($_SESSION['idioma']);
      unset($_SESSION['FB_ID']);
      unset($_SESSION['FB_EMAIL']);
      unset($_SESSION['FB_NOME']);
      unset($_SESSION['FB_PAIS']);
      unset($_SESSION['FB_FOTO']);
      unset($_SESSION['g_id']);
      unset($_SESSION['g_email']);
      unset($_SESSION['g_nome']);
      unset($_SESSION['g_picture']);

		session_destroy();

      header("Location: ".ABS_LINK."login");
		
	}

	function check_login()
	{
		@session_start();
       if(!isset($_COOKIE['bibliapcid']) || $_COOKIE['bibliapcid'] == "" || strlen($_COOKIE['bibliapcid']) < 5)
      {
            if($_SESSION['id'] == 0 || !$_SESSION['id'])
            {
               header("Location: ".ABS_LINK."/login/logout");
            }
            if($_SESSION['logado'] <> "rRJ4fvbvtvgcf" || !$_SESSION['logado'])
            {
               header("Location: ".ABS_LINK."/login");
            }
         }
		
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

			$p7 = str_replace("<"," ",$p6);
			$p8 = str_replace(">"," ",$p7);
			$p9 = str_replace("'","/'",$p8);
			$p10 = str_replace("id","",$p9);
			$p11 = str_replace("id","",$p10);
			$p12 = str_replace(" or ","",$p11);
			$p13 = str_replace(" and ","",$p12);
			$p14 = str_replace("<>","",$p13);
			$p15 = str_replace("> 0","",$p14);
			$p15 = str_replace("--","",$p15);

			$str = $p15;
			
			return $str;
		}
		
	function gera_permissoes($func)
	{
		@session_start();
		
		$db = new db();
		
		// GUARDA A SESSÃO COM O ARRAY DE PERMISSÕES DAS ÁREAS DO ADMIN
		// GUARDA A SESSÃO COM O ARRAY DE PERMISSÕES DAS ÁREAS DO ADMIN
		// GUARDA A SESSÃO COM O ARRAY DE PERMISSÕES DAS ÁREAS DO ADMIN

		$sql_privilegios = "SELECT
							id_usuario
							,id_menu
							,allow
						FROM privilegios
						WHERE id_usuario = ".$func." 
						order by id_menu asc";

		$db->query($sql_privilegios,__LINE__,__FILE__);				
		$db->next_record();

		$_SESSION['grantees'] = array();
		
		for($i = 0; $i < $db->num_rows(); $i++)
		{
				
				$_SESSION['grantees']["area_".$db->f("id_menu")] = $db->f("allow");
				
				$db->next_record();
		}
			
								
	}

	
   function notificacao($mensagem,$cor)
   {
      $_SESSION['msg'] = array("mensagem"=>$mensagem,"tm"=>$cor,"mt"=>"air");
   }

   /*
    * Método que executa o login autenticado pelo Facebook
    */
   function facebookLogin()
   {
      $db = new db();
      $db2 = new db();
      $db3 = new db();

      @session_start();
      $fb_id = $_SESSION['FB_ID']; // Id do Facebook
      $fb_email = $_SESSION['FB_EMAIL']; // Email do Facebook
      $fb_nome = $_SESSION['FB_NOME']; // Nome do facebook
      $fb_pais = $_SESSION['FB_PAIS']; // Pais do usuário do facebook
      $_SESSION['FB_FOTO'] = 'https://graph.facebook.com/'.$fb_id.'/picture?width=300';
      $fb_foto = $_SESSION['FB_FOTO']; // Foto de Perfil do usuário do facebook

      // Verifica se o email que está tentando logar através do Facebook já existe na base

      $sql = "SELECT * FROM usuarios WHERE email = '".$fb_email."' LIMIT 1 ";
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      if($db->num_rows() > 0)
      {

         // Se existir o email, verifica se o login do facebook que está tentando acessar é o mesmo cadastrado no banco
         $sql2 = "SELECT * FROM usuarios WHERE email = '".$fb_email."' AND fb_id = '".$fb_id."' LIMIT 1"; 
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         if($db2->num_rows() == 0)
         {
            // Se o login que está vindo do facebook não for o mesmo do email cadastrado, 
            // retorna mensagem dizendo que o email já é cadastrado.
            // Nesse caso, o email pode ter sido cadastrado por outro usuário antes.
            
            
            $this->notificacao("O Email do seu Facebook já é cadastrado.", "red");
            header("Location: ".ABS_LINK."cadastro");
            die();
         }
         else
         {
               // CASO 1: USUÁRIO JÁ EFETUOU LOGIN PELO FACEBOOK ANTES E ESTÁ RETORNANDO. O BANCO DE DADOS JÁ POSSUI SEUS DADOS.
               // Se já estiver cadastrado, redireciona para o dashboard, e carrega as informações que já estão no banco

               // Atualiza a foto de perfil com base na foto do Facebook

               $sql3 = "UPDATE usuarios SET avatar = '".$fb_foto."', online = 1 WHERE id = ".$db2->f("id")." LIMIT 1 " ;   
               $db3->query($sql3,__LINE__,__FILE__);
               $db3->next_record();

					/* Guarda em sessão todos os parâmetros utéis do usuário */
					$_SESSION['logado'] = "rRJ4fvbvtvgcf";
					$_SESSION['id'] = $db->f("id");		
					$_SESSION['nome'] = $db->f("nome");		
					$_SESSION['email'] = $db->f("email");
					$_SESSION['alert_daily'] = $db->f("alert_daily");		
					$_SESSION['boss'] = $db->f("usuario_master");		
					$_SESSION['idioma'] = $db->f("idioma");		
					$_SESSION['avatar'] = $db->f("avatar");
               
               
               // cria um cookie e grava no banco
          //     $cookievalue = substr(md5(md5(time()).rand(6,9)),0,10);
               $cookievalue = $_SESSION['id'];	
               setcookie('bibliapcid', $cookievalue, (time() + (30 * 24 * 3600)));
               
               $sql = "INSERT INTO user_session
                        (id_usuario,
                        session_id,
                        ip,
                        dataCadastro)
                        VALUES (".$_SESSION['id'].",
                        '".$cookievalue."',
                        '".$_SERVER['REMOTE_ADDR']."',
                        NOW()) ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
		
               
               if(ACTIVE_GRANTEES == 1)
                  $this->gera_permissoes($_SESSION['id']); // Chama a função que define as áreas que o usuário tem acesso.


            if($db2->f("avatar") == "")
               $avatar = 'http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=sem+imagem';
            else
               $avatar = $db2->f("avatar");


               if(date("H") > 00 && date("H") < 12)
                  $saudacao = "Bom dia";

               if(date("H") >= 12 && date("H") < 18)
                  $saudacao = "Boa tarde";


               if(date("H") >= 18 && date("H") <= 23)
                  $saudacao = "Boa noite";

                  $this->dolog($_SESSION['nome']." efetuou login via Facebook. ID: ".$_SESSION['id']);

                  $this->notificacao($saudacao.", ".$_SESSION['nome']."! Seja Bem-vindo(a)!", "green");
//            		header("Location: ".ABS_LINK."/home");
                  $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];
                  header("Location: ".ABS_LINK."home");

                  
                  die(); 
         }


      }
      else
      {
         // CASO 2: USUÁRIO ESTÁ SE LOGANDO PELO FACEBOOK PELA PRIMEIRA VEZ
         // Como não existe cadastro no bando de dados, cadastra o usuário e em seguida redireciona para o dashboard, 
         // carregando as informaões do banco
            $nome = $fb_nome;
            $email = $fb_email;
            $estado = 7;
            $cidade = 6779;
            $endereco = "";
            $pais = "Brasil";

            /* GERA A SENHA PROVISÓRIA */
            $senha = substr(md5(md5(time()).rand(6,9)),0,10);

            $sql = "INSERT INTO usuarios 
                  (nome, 
                email, 
                senha, 
                estado, 
                data_cadastro, 
                status, 
                cidade, 
                alert_daily, 
                endereco, 
                pais,
                fb_id,
                avatar,
                origem,
				ip_origem) 
               VALUES ('".$nome."', 
                '".$email."', 
                MD5('".$senha."'), 
                ".$estado.", 
                NOW(), 
                1, 
                ".$cidade.",
                0, 
                '".$endereco."',
                '".$pais."',
                '".$fb_id."',
                '".$fb_foto."',
                'app/Facebook',
				'".$_SERVER['REMOTE_ADDR']."')";

            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $id_usuario = $db->get_last_insert_id("usuarios","id");
            $_SESSION['id'] = $id_usuario;

            $sql = "UPDATE usuarios 
            SET usuario_master = ".$id_usuario." 
            WHERE id = ".$id_usuario." LIMIT 1 "; 
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            // Define o plano de assinatura do usuário. Como padrão, é sempre 1 (Free)  
            $sql = "UPDATE usuarios SET id_plano = 1 WHERE id = ".$id_usuario." LIMIT 1 "; 
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            // Define os privilégios de acesso do usuário
            
            if(ACTIVE_GRANTEES == 1)
            {
               $sql = "SELECT id FROM menu_itens ORDER BY id ASC";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               for($i = 0; $i < $db->num_rows(); $i++)
               {
                  $sql2 = "INSERT INTO privilegios (id_menu, id_usuario, allow) VALUES (".$db->f("id").",$id_usuario,1)";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();

                  $db->next_record();
               }
            }


            /* Envia um e-mail confirmando o cadastro */

            $msg = "Parab&eacute;ns, ".$nome.", agora voc&ecirc; j&aacute; pode utilizar o ".TITULO_SISTEMA."!<br>";
            $msg .= "Guarde seus dados:<br><br>";
            $msg .= "Login: ".$email;
            $msg .= "<br>";
            $msg .= "Senha: ".$senha;
            $msg .= "<br>";
            $msg .= "<br>";
            $msg .= "Lembre-se de alterar sua senha futuramente.";
            $msg .= "<br>";
            $msg .= "<br>";

            $msg .= "<strong>Seu cadastro foi feito atrav&eacute;s do Facebook, por isso voc&ecirc; n&atilde;o precisa validar seu email!</strong>";
            $msg .= "<br>";
            $msg .= "<br>";
            $msg .= "Atenciosamente,<br>Equipe ".TITULO_SISTEMA."";
            $msg .= "<br>";
            $msg .= "Copyright 2019 - ".date("Y")." ".TITULO_SISTEMA."";
            $msg .= "<br>";
            $msg .= "<br>";
            $msg .= ABS_LINK;


            $subject = "Obrigado pelo seu cadastro - ".TITULO_SISTEMA." ";

            $this->email($email, $subject, $msg);
            $this->dolog($nome." efetuou o cadastro atraves do Facebook. ID: ".$id_usuario);

            header("Location: ".ABS_LINK."/cadastro/continuar");

            die();
      }

   }
   
    function googleLogin()
   {
       
      $db = new db();
      $db2 = new db();
      $db3 = new db();
      

      @session_start();
      $google_id = $_SESSION['g_id'];
      $google_email =  $_SESSION['g_email'];
      $google_nome =  $_SESSION['g_nome'];
      $google_foto = $_SESSION['g_picture'];

      // Verifica se o email que está tentando logar através do Google já existe na base

      $sql = "SELECT * FROM usuarios WHERE email = '".$google_email."' LIMIT 1 ";
      $db->query($sql,__LINE__,__FILE__);
      $db->next_record();
      if($db->num_rows() > 0)
      {

         // Se existir o email, verifica se o login do facebook que está tentando acessar é o mesmo cadastrado no banco
         $sql2 = "SELECT * FROM usuarios WHERE email = '".$google_email."' AND google_id = '".$google_id."' LIMIT 1"; 
         $db2->query($sql2,__LINE__,__FILE__);
         $db2->next_record();
         if($db2->num_rows() == 0)
         {
            // Se o login que está vindo do Google não for o mesmo do email cadastrado, 
            // retorna mensagem dizendo que o email já é cadastrado.
            // Nesse caso, o email pode ter sido cadastrado por outro usuário antes.
            
            
            $this->notificacao("O Email do seu Google já é cadastrado.", "red");
             header("Location: ".ABS_LINK."login");
            die();
         }
         else
         {
               // CASO 1: USUÁRIO JÁ EFETUOU LOGIN PELO GOOGLE ANTES E ESTÁ RETORNANDO. O BANCO DE DADOS JÁ POSSUI SEUS DADOS.
               // Se já estiver cadastrado, redireciona para o dashboard, e carrega as informações que já estão no banco

               // Atualiza a foto de perfil com base na foto do Google, para caso ele tenha mudado desde a última vez que se logou

               $sql3 = "UPDATE usuarios SET avatar = '".$google_foto."', online = 1 WHERE id = ".$db2->f("id")." LIMIT 1 " ;   
               $db3->query($sql3,__LINE__,__FILE__);
               $db3->next_record();

					/* Guarda em sessão todos os parâmetros utéis do usuário */
					$_SESSION['logado'] = "rRJ4fvbvtvgcf";
					$_SESSION['id'] = $db->f("id");		
					$_SESSION['nome'] = $db->f("nome");		
					$_SESSION['email'] = $db->f("email");
					$_SESSION['alert_daily'] = $db->f("alert_daily");		
					$_SESSION['boss'] = $db->f("usuario_master");		
					$_SESSION['idioma'] = $db->f("idioma");		
					$_SESSION['avatar'] = $db->f("avatar");
               
               
               // cria um cookie e grava no banco
          //     $cookievalue = substr(md5(md5(time()).rand(6,9)),0,10);
               
               $cookievalue = $_SESSION['id'];	
               setcookie('bibliapcid', $cookievalue, (time() + (30 * 24 * 3600)));
               
               $sql = "INSERT INTO user_session
                        (id_usuario,
                        session_id,
                        ip,
                        dataCadastro)
                        VALUES (".$_SESSION['id'].",
                        '".$cookievalue."',
                        '".$_SERVER['REMOTE_ADDR']."',
                        NOW()) ";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               
               
               if(ACTIVE_GRANTEES == 1)
                  $this->gera_permissoes($_SESSION['id']); // Chama a função que define as áreas que o usuário tem acesso.


            if($db2->f("avatar") == "")
               $avatar = 'http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=sem+imagem';
            else
               $avatar = $db2->f("avatar");


               if(date("H") > 00 && date("H") < 12)
                  $saudacao = "Bom dia";

               if(date("H") >= 12 && date("H") < 18)
                  $saudacao = "Boa tarde";


               if(date("H") >= 18 && date("H") <= 23)
                  $saudacao = "Boa noite";

		
                 $this->dolog($_SESSION['nome']." efetuou login via Google. ID: ".$_SESSION['id']);
				  
				  

                  $this->notificacao($saudacao.", ".$_SESSION['nome']."! Seja Bem-vindo(a)!", "green");
//            		header("Location: ".ABS_LINK."/home");
                  $origem = $_SESSION["path_de_navegacao"][count($_SESSION["path_de_navegacao"])-2];
                  header("Location: ".ABS_LINK."home");

                  
                  die(); 
         }


      }
      else
      {
         // CASO 2: USUÁRIO ESTÁ SE LOGANDO PELO GOOGLE PELA PRIMEIRA VEZ
         // Como não existe cadastro no bando de dados, cadastra o usuário e em seguida redireciona para o dashboard, 
         // carregando as informaões do banco
            $nome = $google_nome;
            $email = $google_email;
            $estado = 7;
            $cidade = 6779;
            $endereco = "";
            $pais = "Brasil";

            /* GERA A SENHA PROVISÓRIA */
            $senha = substr(md5(md5(time()).rand(6,9)),0,10);

            $sql = "INSERT INTO usuarios 
                  (nome, 
                email, 
                senha, 
                estado, 
                data_cadastro, 
                status, 
                cidade, 
                alert_daily, 
                endereco, 
                pais,
                google_id,
                avatar,
                origem,
				ip_origem) 
               VALUES ('".$nome."', 
                '".$email."', 
                MD5('".$senha."'), 
                ".$estado.", 
                NOW(), 
                1, 
                ".$cidade.",
                0, 
                '".$endereco."',
                '".$pais."',
                '".$google_id."',
                '".$google_foto."',
                'app/Google',
				'".$_SERVER['REMOTE_ADDR']."')";

            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();
            $id_usuario = $db->get_last_insert_id("usuarios","id");
            $_SESSION['id'] = $id_usuario;

            $sql = "UPDATE usuarios 
            SET usuario_master = ".$id_usuario." 
            WHERE id = ".$id_usuario." LIMIT 1 "; 
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            // Define o plano de assinatura do usuário. Como padrão, é sempre 1 (Free)  
            $sql = "UPDATE usuarios SET id_plano = 1 WHERE id = ".$id_usuario." LIMIT 1 "; 
            $db->query($sql,__LINE__,__FILE__);
            $db->next_record();

            // Define os privilégios de acesso do usuário
            
            if(ACTIVE_GRANTEES == 1)
            {
               $sql = "SELECT id FROM menu_itens ORDER BY id ASC";
               $db->query($sql,__LINE__,__FILE__);
               $db->next_record();
               for($i = 0; $i < $db->num_rows(); $i++)
               {
                  $sql2 = "INSERT INTO privilegios (id_menu, id_usuario, allow) VALUES (".$db->f("id").",$id_usuario,1)";
                  $db2->query($sql2,__LINE__,__FILE__);
                  $db2->next_record();

                  $db->next_record();
               }
            }


            /* Envia um e-mail confirmando o cadastro */

            $msg = "Parab&eacute;ns, ".$nome.", agora voc&ecirc; j&aacute; pode utilizar o ".TITULO_SISTEMA."!<br>";
            $msg .= "Guarde seus dados:<br><br>";
            $msg .= "Login: ".$email;
            $msg .= "<br>";
            $msg .= "Senha: ".$senha;
            $msg .= "<br>";
            $msg .= "<br>";
            $msg .= "Lembre-se de alterar sua senha futuramente.";
            $msg .= "<br>";
            $msg .= "<br>";

            $msg .= "<strong>Seu cadastro foi feito atrav&eacute;s do Google, por isso voc&ecirc; n&atilde;o precisa validar seu email!</strong>";
            $msg .= "<br>";
            $msg .= "<br>";
            $msg .= "Atenciosamente,<br>Equipe ".TITULO_SISTEMA."";
            $msg .= "<br>";
            $msg .= "Copyright 2019 - ".date("Y")." ".TITULO_SISTEMA."";
            $msg .= "<br>";
            $msg .= "<br>";
            $msg .= ABS_LINK;


            $subject = "Obrigado pelo seu cadastro - ".TITULO_SISTEMA." ";

            $this->email($email, $subject, $msg);
            $this->dolog($nome." efetuou o cadastro atraves do Google. ID: ".$id_usuario);

            header("Location: ".ABS_LINK."/cadastro/continuar");

            die();
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
 
		function dolog($acao)
		{
			@session_start();
			$db = new db();

			$sql = "INSERT INTO log (id_usuario, acao, data) VALUES (".$_SESSION['id'].", '".$acao."', NOW())";			
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
		}
      
 }

?>