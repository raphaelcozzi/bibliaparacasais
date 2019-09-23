<?php
session_start();
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\GraphLocation;
// init app with app id and secret
FacebookSession::setDefaultApplication( '302328724009353','7ffcb1b7dc82399b9a1ac3abc0cb5ec8' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('https://mobile.bibliaparacasais.com.br/3rd_party/sdk-facebook/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
 $request = new FacebookRequest( $session, 'GET', '/me?locale=pt_BR&fields=id,name,email' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  
  $loc = $response->getGraphObject(GraphLocation::className());
  
  $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
  $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
  $fbemail = $graphObject->getProperty('email');    // To Get Facebook email ID
  $fbpais = $loc->getCountry();    // To Get Facebook Country

   $_SESSION['FB_ID'] = $fbid;           
   $_SESSION['FB_NOME'] = $fbfullname;
   $_SESSION['FB_EMAIL'] =  $fbemail;
   $_SESSION['FB_PAIS'] =  $fbpais;
       
    /* ---- header location after session ----*/
       // Redireciona para a verificação se a conta já está cadastrada.
  header("Location: https://mobile.bibliaparacasais.com.br/index.php?module=login&method=facebookLogin");
} else {
  $loginUrl = $helper->getLoginUrl(array('scope' => 'email'));
 header("Location: ".$loginUrl);
}
?>