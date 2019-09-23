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

class ws extends home
{

   
	public function main()
	{
			@session_start();
			$db = new db();
			
   }
   
   function getNewArticle()
   {
      /*
       *  Novo artigo publicado
       */
      
			@session_start();
			$db = new db();
   }
   
   function getNewCurso()
   {
      /*
       *  Novo curso publicado
       */
			@session_start();
			$db = new db();
   }
   
   function getCommentLike($id_usuario)
   {
      /*
       * Alguém curtiu seu comentário
       */
			@session_start();
			$db = new db();
      
   }
   
   function getCommentResponse($id_usuario)
   {
      /*
       * Alguém respondeu seu comentário
       */
			@session_start();
			$db = new db();
   }
   
   function getLikeArticle($id_usuario)
   {
     /*
      * Alguém curtiu seu artigo
      */ 
			@session_start();
			$db = new db();

         }
   
   function getCommentArticle($id_usuario)
   {
      /*
       * Alguém respondeu seu artigo
       */
   }
}

?>