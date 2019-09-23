<?php
require_once("modules/home.php");

class registros  extends home                                                                    
{              
		function main()
		{
@session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
         $sql = "SELECT log.id AS id, log.acao, DATE_FORMAT(log.data,'%d/%m/%Y') AS data, usuarios.nome AS nome_usuario 
                 FROM log, usuarios 
                 WHERE log.id_usuario = usuarios.id 
                 ORDER BY log.id DESC LIMIT 0,10000";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$acao = $db->f("acao");
				$nome_usuario = $db->f("nome_usuario");
				$data = $db->f("data");
            
				$listagem .= '<tr> 
										<td>'.$nome_usuario.'</td>
										<td>'.$acao.'</td>
										<td>'.$data.'</td> 
										<td><a href="registros/exclui/'.$id.'" onclick="return(confirm(\'Deseja excluir o registro de log ? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem",$listagem);
         $GLOBALS["base"]->write_design_specific('registros.tpl' , 'main');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

			
		}

      function exclui()
      {
			@session_start();
         $db = new db();
         
         
         $id = $_REQUEST['id'];
         
         $sql = "DELETE FROM log  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
        
         $this->notificacao("Registro de log removido com sucesso.","green");
         header("Location: ".ABS_LINK."registros");
         
      }
      
 }


?>