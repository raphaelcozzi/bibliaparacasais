<?php
require_once("modules/home.php");  

class googleLogin extends home
{
	function main()
	{
		require_once('3rd_party/google-api/google-login-api.php');  
		
			  die("> ".$_GET['code']);
			  
				 if(isset($_GET['code'])) {
					try {
					   $gapi = new GoogleLoginApi();
		
					   // Get the access token 
					   $data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
					   // Get user information
					   $user_info = $gapi->GetUserProfileInfo($data['access_token']);
					}
					catch(Exception $e) {
					   echo $e->getMessage();
					   exit();
					}
				 }
				 
				 $nome = $user_info["name"];
				 $email = $user_info["email"];
				 $picture = $user_info["picture"];
				 $id = $user_info["id"];
				 
				 echo ">> ".$nome;
			  
			  die();
		
	}
}

?>