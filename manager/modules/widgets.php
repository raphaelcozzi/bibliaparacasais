<?php

require_once("modules/home.php");

	class widgets  extends home                                                                    
    {              

		function main()
		{
			@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
			$db1 = new db();
			$db2 = new db();
			$db3 = new db();
			$db4 = new db();

			$sql = "SELECT id, content, nome, position FROM widgets ORDER BY id DESC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");			
				$content = $db->f("content");			
				$nome = $db->f("nome");
				$position = $db->f("position");
				
				
				$listagem .= '<tr> 
										<td>'.$nome.'</td>
										<td>'.$position.'</td>
										<td><a href="widgets/edita/'.$db->f("id").'" >Editar</a></td>
										<td><a href="widgets/exclui/'.$db->f("id").'" onclick="return(confirm(\'Deseja excluir o widget '.$db->f("nome").' ? \'))">Excluir</a></td>										
									</tr>';
				
				
				
				
				$db->next_record();
			}


		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		
		$GLOBALS["base"]->template->set_var("listagem",$listagem);
													
		$GLOBALS["base"]->write_design_specific('widgets.tpl' , 'main');                       
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                           

			
		}

				
	function novo()
	{
		@session_start();
		$db = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                
                
		   $sql = "SELECT id, description FROM widgets_positions ORDER BY description ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$listagem_positions .= "<option value='".$db->f("id")."' ";
				
				if($db->f("id") == $position)
					$listagem_positions .= "selected='selected'";
				
				$listagem_positions .= ">".$db->f("description")."</option>";			
	
				$db->next_record();

			}

				$listagem_status .= "<option value='0' ";
				
				if($widget_status == "0")
					$listagem_status .= "selected='selected'";
				
				$listagem_status .= ">Inativo</option>";			
	         

				$listagem_status .= "<option value='1' ";
				
				if($widget_status == "1")
					$listagem_status .= "selected='selected'";
				
				$listagem_status .= ">Ativo</option>";			
            


		$this->cabecalho();                                                                            
		$GLOBALS["base"]->template = new template();       
		$GLOBALS["base"]->template->set_var('listagem_status',$listagem_status);
		$GLOBALS["base"]->template->set_var('listagem_positions',$listagem_positions);
		$GLOBALS["base"]->write_design_specific('widgets.tpl' , 'novo');                                            
		$GLOBALS["base"]->template = new template();                                                  
		$this->footer();                                                                               
		
	}


	function insere()
	{
		
	
		@session_start();
		$db = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                
		$db = new db();
	
		$nome = $this->blockrequest($_REQUEST['nome']);
		$position = $this->blockrequest($_REQUEST['position']);
		$content = $_REQUEST['content'];
		$widget_status = $_REQUEST['status'];

		   $sql = "INSERT INTO widgets
                     (nome,
                     content,
                     POSITION,
                     dataCadastro,
                     status)
                     VALUES ('".$nome."',
                     '".addslashes($content)."',
                     ".$position.",
                     NOW(),
                     ".$widget_status.") ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
			$id_widget = $db->get_last_insert_id("widgets","id");
			

       $this->notificacao("Widgets cadastrado com sucesso!", "green");
       
		header("Location: ".ABS_LINK."/widgets");   
		
	   }
	   
	   function edita()
	   {
			@session_start();
			$db = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                        
                        
			$id = $this->blockrequest($_REQUEST['id']);	
			
			$sql = "SELECT id, content, nome, position, status FROM widgets WHERE id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
			
         $content = $db->f("content");			
         $nome = $db->f("nome");
         $position = $db->f("position");
         $widget_status = $db->f("status");
	
			
	
		   $sql = "SELECT id, description FROM widgets_positions ORDER BY description ASC";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$listagem_positions .= "<option value='".$db->f("id")."' ";
				
				if($db->f("id") == $position)
					$listagem_positions .= "selected='selected'";
				
				$listagem_positions .= ">".$db->f("description")."</option>";			
	
				$db->next_record();

			}

         
				$listagem_status .= "<option value='0' ";
				
				if($widget_status == "0")
					$listagem_status .= "selected='selected'";
				
				$listagem_status .= ">Inativo</option>";			
	         

				$listagem_status .= "<option value='1' ";
				
				if($widget_status == "1")
					$listagem_status .= "selected='selected'";
				
				$listagem_status .= ">Ativo</option>";			
            
            
			$this->cabecalho();                                                                            
			$GLOBALS["base"]->template = new template();       
			
			$GLOBALS["base"]->template->set_var("listagem_status",$listagem_status);
			$GLOBALS["base"]->template->set_var("nome",$nome);
			$GLOBALS["base"]->template->set_var("content",$content);
			$GLOBALS["base"]->template->set_var("status",$status);
			$GLOBALS["base"]->template->set_var("listagem_positions",$listagem_positions);
			$GLOBALS["base"]->template->set_var("id",$id);

			$GLOBALS["base"]->write_design_specific('widgets.tpl' , 'edita');                       
			$GLOBALS["base"]->template = new template();                                                  
			$this->footer();                                                                               
		   
	   }
	


		function update()
		{

			@session_start();
			$db = new db();
			$db4 = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
                            $this->valida_privilegios();
                        
         $nome = $this->blockrequest($_REQUEST['nome']);
         $position = $this->blockrequest($_REQUEST['position']);
         $content = $_REQUEST['content'];
   		$widget_status = $_REQUEST['status'];

			$id = $this->blockrequest($_REQUEST['id']);	

         $sql = "UPDATE widgets
               SET nome = '".$nome."',
               content = '".addslashes($content)."',
               position = ".$position.",
               status = ".$widget_status."
               WHERE id = ".$id." ";   
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

			
         $this->notificacao("Widget atualizado com sucesso!", "green");
			header("Location: ".ABS_LINK."/widgets");	
		}
		
		function exclui()
		{
			@session_start();
			$db = new db();

			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
             $this->valida_privilegios();
                        
          $id = $this->blockrequest($_REQUEST['id']);	
         
			$sql = "DELETE FROM widgets WHERE id = ".$id." ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();

         $this->notificacao("Widget Excluido com sucesso!", "green");
			header("Location: ".ABS_LINK."/widgets");	
			
		}
		
}                                                                                                     





?>