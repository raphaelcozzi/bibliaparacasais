<?php
require_once("modules/home.php");  

class termosdeuso extends home
{
	public function main()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "termosdeuso";
         $_SESSION['titulo_pagina'] = "Termos de Uso";
			
			

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('',$var);
		   $GLOBALS["base"]->write_design_specific('termosdeuso.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}

	function licenca()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "licenca";
         $_SESSION['titulo_pagina'] = "Licença de Uso";
			
			

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('',$var);
		   $GLOBALS["base"]->write_design_specific('termosdeuso.tpl' , 'licenca');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
   
   
   }
	
   ?>