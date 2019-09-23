<?php
require_once("modules/home.php");  

class licenca extends home
{
	public function main()
	{
			@session_start();
			$db = new db();
			$db2 = new db();
			$db3 = new db();
			
         $_SESSION['pagina'] = "licenca";
         $_SESSION['titulo_pagina'] = "Licen&ccedil;a";
			
			

			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();
			$GLOBALS["base"]->template->set_var('',$var);
		   $GLOBALS["base"]->write_design_specific('licenca.tpl' , 'main');
			$GLOBALS["base"]->template = new template();
			$this->footer();
	}
}
	
   ?>