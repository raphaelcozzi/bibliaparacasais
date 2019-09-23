<?php
require_once("modules/home.php");  

class contato extends home
{
	public function main()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "contato";
         $_SESSION['titulo_pagina'] = "Contato";

		
			

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('nome',$_SESSION['nome']);
			$GLOBALS["base"]->template->set_var('email',$_SESSION['email']);
			$GLOBALS["base"]->template->set_var('telefone',$_SESSION['telefone']);
		   $GLOBALS["base"]->write_design_specific('contato.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
   
	function send()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "contato";
         $_SESSION['titulo_pagina'] = "Contato";
         
         $nome = $_SESSION['nome'];
         $email = $_SESSION['email'];
         $telefone = $_REQUEST['telefone'];
         $assunto = $this->blockrequest($_REQUEST['assunto']);
         $mensagem = $this->blockrequest($_REQUEST['mensagem']);
         
         
         $msg .= 'Nova mensagem de contato enviada pelo aplicativo';
         $msg .= '<br><br>';
         $msg .= '<strong>Nome:</strong> '.$nome;
         $msg .= '<br>';
         $msg .= '<strong>Email:</strong> '.$email;
         $msg .= '<br>';
         $msg .= '<strong>Telefone:</strong> '.$telefone;
         $msg .= '<br>';
         $msg .= '<strong>Assunto:</strong> '.$assunto;
         $msg .= '<br><br>';
         $msg .= '<strong>Mensagem:</strong> '.$mensagem;
         $msg .= '<br><br>';
         $msg .= '<hr>';
         $msg .= '<br><br><br>';
         $msg .= 'Mensagem enviada atrav&eacute;s do aplicativo para Android em '.date("d/m/Y").' &agrave;s '.date("H:i:s").' IP: '.$_SERVER['REMOTE_ADDR'];
         
         $destino = 'contato@bibliaparacasais.com.br';
         
          $this->email($destino,"Fale conosco - Biblia para casais",$msg);

		
         $this->notificacao("Mensagem enviada com sucesso!", "green");
              
            
            
            
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
         
			$GLOBALS["base"]->template->set_var('nome',$_SESSION['nome']);
			$GLOBALS["base"]->template->set_var('email',$_SESSION['email']);
			$GLOBALS["base"]->template->set_var('telefone',$_SESSION['telefone']);
		   $GLOBALS["base"]->write_design_specific('contato.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
            
	}
      
}
	
   ?>