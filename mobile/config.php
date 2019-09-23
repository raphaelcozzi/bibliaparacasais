<?php 
      @session_start();// Define a versão padrão da bíblia como 1 (Almeida Revisada Imprensa Bíblica)
      if(!isset($_SESSION['ver_vrs_id']))
      {
         $_SESSION['ver_vrs_id'] = 1;
      }
      
define("LINK_ORIGINAL","https://www.bibliaparacasais.com.br");      
define("CAMINHO_ABSOLUTO_RAIZ","/home/bibliaparacasais/public_html");
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
/* CONFIGURAÇÕES DE BANCO DE DADOS */

// local


$baseUrl = "/dev/biblia/mobile/";
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "biblia";
$dbdriver = "mysql"; 


// web
/*
$baseUrl = "/mobile";

$host = "localhost";
$user = "bibliapa__us3r"; 
$password = "6r7QnJfq50#P"; 
$database = "bibliapa_base";
$dbdriver = "mysql"; 
*/
/* Google App Client Id */
define('CLIENT_ID', '188471943471-94gmm2gtkd67n7309h2l72aciek5ooml.apps.googleusercontent.com');

/* Google App Client Secret */
define('CLIENT_SECRET', 'oAlp8H6SXYxKjC74TuA-JxuH');

/* Google App Redirect Url */
define('CLIENT_REDIRECT_URL', 'https://mobile.bibliaparacasais.com.br/gauth.php');


/* CONFIGURAÇÕES DE EMAIL PADRÃO */

define("USER_EMAIL","contato@bibliaparacasais.com.br"); // Email de autenticação
define("SENHA_EMAIL","r2AFhX0O0vdt"); // Senha do email
define("HOST_EMAIL","mail.bibliaparacasais.com.br"); // Servidor de autenticação

define("SENDER_EMAIL","contato@bibliaparacasais.com.br"); // Remetente
define("NOME_EMAIL","Bíblia de Estudos para Casais"); // Nome do remetente
define("PORT_EMAIL","465"); // Porta de autenticação
define("AUTH_EMAIL",true); // Autenticação no envio (true ou false)

/* CONFIGURAÇÕES GERAIS */

define("TITULO_SISTEMA","Biblia de Estudo para Casais"); /* Titulo do sistema/serviço */
define("HTTPS",0); /* HTTPS 1 ou 0 */
define("CONFIG_SCRIPT_PATH" , "/");
define("CONFIG_DEBUG" , 0); /* Debug ativo? */
define("CONFIG_ENVIRONMENT_FRAMESET" , 1);

if(isset($_SESSION['idioma']))
	define("CONFIG_LANG" , $_SESSION['idioma']); /* Idioma padrão do usuário */ 
else
	define("CONFIG_LANG" , "pt_br"); /* Idioma padrão do sistema */ 

define("LOADING_BAR" , 1); /* Barra de loading ativa ou não */
define("ACTIVE_GRANTEES" , 0); /* Permissionamento ativo ou não */
define("USE_AVATAR" , 1); /* Avatar de usuário ativo ou não */
define("DB_USED" , 1); /* MySql = 1 Oracle = 2 Sql Server = 3 */
define("MYSQL_SHOW_ERROR" , 0); /* Show mysql error? */


/* CÓDIGO DE RASTREIO DO GOOGLE ANALYTICS */

$analytics_code = "";


/*********************************************** NÃO MEXER A PARTIR DAQUI ************************************************/
$path = (getcwd());


define("ANALYTICS" , $analytics_code);
define("CONFIG_PATH" , $path);

if(HTTPS == 1)
define("ABS_LINK" , "https://mobile.bibliaparacasais.com.br/");
else
define("ABS_LINK" , "http://".$_SERVER['HTTP_HOST'].$baseUrl);

/*MYSQL CONFIG*/
define("MYSQL_CONFIG_HOST"     , $host);
define("MYSQL_CONFIG_DATABASE" , $database);
define("MYSQL_CONFIG_USERNAME" , $user);
define("MYSQL_CONFIG_PASSWORD" , $password);


/*ORACLE CONFIG*/
define("ORACLE_CONFIG_HOST"     , $host);
define("ORACLE_CONFIG_DATABASE" , $database);
define("ORACLE_CONFIG_USERNAME" , $user);
define("ORACLE_CONFIG_PASSWORD" , $password);

/*SQL SERVER CONFIG*/
define("SQLSERVER_CONFIG_HOST"     , $host);
define("SQLSERVER_CONFIG_DATABASE" , $database);
define("SQLSERVER_CONFIG_USERNAME" , $user);
define("SQLSERVER_CONFIG_PASSWORD" , $password);

?>