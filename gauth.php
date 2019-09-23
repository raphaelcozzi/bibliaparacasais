<?php
@session_start();

require_once("config.php");  

require_once('3rd_party/google-api/google-login-api.php');  
		
			  
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
				 
				 $_SESSION['g_nome'] = $user_info["name"];
				 $_SESSION['g_email'] = $user_info["email"];
				 $_SESSION['g_picture'] = $user_info["picture"];
				 $_SESSION['g_id'] = $user_info["id"];
				 
				 header("Location: index.php?module=login&method=googleLogin");
			  
			  
		
?>