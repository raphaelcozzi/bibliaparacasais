<?php 

/* CONFIGURAÇÕES DE BANCO DE DADOS */
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
/*
$baseUrl = "/dev/biblia/manager/";

$host = "localhost"; // servidor
$user = "root"; // usuario
$password = ""; // senha
$database = "biblia"; // banco de dados
$dbdriver = "mysql"; // tipo do banco mysql
*/


define("CAMINHO_ABSOLUTO_RAIZ","/home/bibliaparacasais/public_html");
define("LINK_ORIGINAL","https://www.bibliaparacasais.com.br");


$baseUrl = "/";

$host = "localhost";
$user = "bibliapa__us3r"; 
$password = "6r7QnJfq50#P"; 
$database = "bibliapa_base";
$dbdriver = "mysql"; 


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
define("HTTPS",1); /* HTTPS 1 ou 0 */
define("CONFIG_SCRIPT_PATH" , "/");
define("CONFIG_DEBUG" , 0); /* Debug ativo? */
define("CONFIG_ENVIRONMENT_FRAMESET" , 1);

if(isset($_SESSION['idioma']))
	define("CONFIG_LANG" , $_SESSION['idioma']); /* Idioma padrão do usuário */ 
else
	define("CONFIG_LANG" , "pt_br"); /* Idioma padrão do sistema */ 

define("LOADING_BAR" , 1); /* Barra de loading ativa ou não */
define("ACTIVE_GRANTEES" , 1); /* Permissionamento ativo ou não */
define("USE_AVATAR" , 1); /* Avatar de usuário ativo ou não */
define("DB_USED" , 1); /* MySql = 1 Oracle = 2 Sql Server = 3 */
define("MYSQL_SHOW_ERROR" , 1); /* Show mysql error? */


/* CÓDIGO DE RASTREIO DO GOOGLE ANALYTICS */

$analytics_code = "";


/*********************************************** NÃO MEXER A PARTIR DAQUI ************************************************/
$path = (getcwd());


define("ANALYTICS" , $analytics_code);
define("CONFIG_PATH" , $path);

if(HTTPS == 1)
define("ABS_LINK" , "https://".$_SERVER['HTTP_HOST'].$baseUrl);
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