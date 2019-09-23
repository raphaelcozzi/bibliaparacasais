<?php
require_once("modules/home.php");


class notificacoes  extends home                                                                    
{              

   function main()
   {
      
         @session_start();
                        
			if($_SESSION['adm_id'] != $_SESSION['adm_boss'])
			$this->valida_privilegios();
			
			$db = new db();
                     $sql = "SELECT id, notification_title, notification_text, notification_extra, DATE_FORMAT(notification_date, '%d/%m/%Y %H:%i:%s') AS notification_date, qtd_envios FROM notificacoes ORDER BY id DESC ";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
         
			for($i = 0; $i < $db->num_rows(); $i++)
			{
				$id = $db->f("id");
				$notification_title = $db->f("notification_title");
				$notification_text = $db->f("notification_text");
				$notification_extra = $db->f("notification_extra");
				$notification_date = $db->f("notification_date");
                           $qtd_envios = $db->f("qtd_envios");
            
				$listagem .= '<tr> 
										<td>'.$notification_title.'</td>
										<td>'.$notification_text.'</td>
										<td>'.$notification_extra.'</td> 
										<td>'.$notification_date.'</td> 
										<td>'.$qtd_envios.'</td> 
										<td><a href="notificacoes/exclui/'.$id.'" onclick="return(confirm(\'Deseja excluir o registro? \'))">Excluir</a></td>										
									</tr>';
            
            
   			$db->next_record();

         }

         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->template->set_var("listagem",$listagem);
         $GLOBALS["base"]->write_design_specific('notificacoes.tpl' , 'main');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                            

   }
      
      function novo()
      {
            @session_start();
                        
			
         $this->cabecalho();                                                                            
         $GLOBALS["base"]->template = new template();       
         $GLOBALS["base"]->write_design_specific('notificacoes.tpl' , 'novo');                       
         $GLOBALS["base"]->template = new template();                                                  
         $this->footer();                                                                           

         
      }
      
      
      function send()
      {
         
         @session_start();
         $db = new db();

         $this->sendPush($_REQUEST['title'], $_REQUEST['message'], $_REQUEST['link']);
/*
           $this->notificacao("Notificação enviada com sucesso!.","green");
            header("Location: ".ABS_LINK."notificacoes/novo");
 */
      }

       function exclui()
      {
			@session_start();
         $db = new db();
         
         
         $id = $_REQUEST['id'];
         
         $sql = "DELETE FROM notificacoes  WHERE id = ".$id." LIMIT 1";
			$db->query($sql,__LINE__,__FILE__);
			$db->next_record();
        
         $this->notificacao("Registro  removido com sucesso.","green");
         header("Location: ".ABS_LINK."notificacoes");
         
      }

     
      
 }


?>