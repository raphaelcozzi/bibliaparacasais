<?php                                                              
function valida_privilegios($id_secao)
	{
		/* M�todo para valida��o de permiss�o por �rea */
		if(!in_array($_SESSION['privilegios']["area_".$id_secao.""],$_SESSION['privilegios']))
			header("Location: index.php?module=home&method=main");
		else
		{
				if($_SESSION['privilegios']["area_".$id_secao.""]["ler"] == 0)
				{
					header("Location: index.php?module=home&method=main");
				}
				if($_SESSION['privilegios']["area_".$id_secao.""]["escrever"] == 0)
					$_SESSION['botao_inserir'] = 0;
				else
				    $_SESSION['botao_inserir'] = 1;
	
				
				if($_SESSION['privilegios']["area_".$id_secao.""]["alterar"] == 0)
					$_SESSION['botao_alterar'] = 0;
				else
				    $_SESSION['botao_alterar'] = 1;


				if($_SESSION['privilegios']["area_".$id_secao.""]["excluir"] == 0)
					$_SESSION['botao_excluir'] = 0;
				else
				    $_SESSION['botao_excluir'] = 1;

		}
					
	}

	function split_querystring()
	{
		$arrayRequest = split("&" , $_SERVER["QUERY_STRING"]);
		for ($i = 0 ; $i < count($arrayRequest) ; $i++)
		{
			$pos_igual = strpos($arrayRequest[$i] , "=");
			$variavel = substr($arrayRequest[$i] , 0 , $pos_igual);
			$valor = substr($arrayRequest[$i] , $pos_igual + 1, strlen($arrayRequest[$i]));
			$_REQUEST[$variavel] = $valor;

			echo "<br>(1)arg n ".$i." : ".$variavel." - ".$_REQUEST[$variavel];
		}
	}
	
	function encrypt($string)
	{
		//return $string;
		//$string = mt_rand(100000, 999999).$string.mt_rand(100000, 999999);
		$encoded_data = base64_encode($string);
		return strrev($encoded_data);
	}
	function decrypt($string)
	{
		$decoded = base64_decode(strrev($string));
		//$decoded = substr($decoded , 6 , strlen($decoded) - 12);
		return $decoded;
	}
	function decrypt_querystring()
	{

		$_SERVER["QUERY_STRING"] = decrypt($_SERVER["QUERY_STRING"]);
		$arrayRequest = split("&" , $_SERVER["QUERY_STRING"]);
		for ($i = 0 ; $i < count($arrayRequest) ; $i++)
		{
			$pos_igual = strpos($arrayRequest[$i] , "=");
			$variavel = substr($arrayRequest[$i] , 0 , $pos_igual);
			$valor = substr($arrayRequest[$i] , $pos_igual + 1, strlen($arrayRequest[$i]));
			$_REQUEST[$variavel] = $valor;

			//echo "<br>(1)arg n ".$i." : ".$variavel." - ".$_REQUEST[$variavel];
		}
	}
    function microtime_float()
    {
       list($usec, $sec) = explode(" ", microtime());
       return ((float)$usec + (float)$sec);
    }
    function remove_string_symbols($str_orig)
    {
        $str_orig = preg_replace('/(�|�|�|�|�)/' , 'a' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�)/' , 'e' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�)/' , 'i' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�|�)/' , 'o' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�)/' , 'u' , $str_orig);

        $str_orig = preg_replace('/(�|�|�|�|�)/' , 'A' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�)/' , 'E' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�)/' , 'I' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�|�)/' , 'O' , $str_orig);
        $str_orig = preg_replace('/(�|�|�|�)/' , 'U' , $str_orig);

		$str_orig = str_replace('�' , 'c' , $str_orig);
 		$str_orig = str_replace('�' , 'C' , $str_orig);
 		$str_orig = str_replace('.' , '' , $str_orig);
 
		$str_orig = preg_replace('/( |&|=|\+|-|>|<|\*|%|\$|#|@|!|"|~|�)/' , '_' , $str_orig);
        return $str_orig;
    }
    function get_data_clean($data)
	{
		$exp = explode(" ", $data);
		$exp1 = explode("-", $exp[0]); 
		$exp[1] = substr($exp[1], 0, 5);
		$data = "$exp1[2]/$exp1[1]/$exp1[0] - $exp[1]";
		return $data;
	}
    function get_data_clean_abrev($data)
	{
		$exp = explode(" ", $data);
		$exp1 = explode("-", $exp[0]); 
		$exp[1] = substr($exp[1], 0, 5);
		$ano = substr($exp1[0] , 2 , 2);
		$data = "$exp1[2]/$exp1[1]/$ano";
		return $data;
	}
	function get_mes($mes)
	{
		$mes_array = array("01" => "Janeiro", "02" => "Fevereiro", "03" => "Mar�o", "04" => "Abril",
						   "05" => "Maio", "06" => "Junho", "07" => "Julho", "08" => "Agosto", 
						   "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");	
		return $mes_array[$mes];
	}
	function get_mes_abrev($mes)
	{
		$mes_array = array("01" => "Jan", "02" => "Fev", "03" => "Mar", "04" => "Abr",
						   "05" => "Mai", "06" => "Jun", "07" => "Jul", "08" => "Ago", 
						   "09" => "Set", "10" => "Out", "11" => "Nov", "12" => "Dez");	
		return $mes_array[$mes];
	}
	
	if (function_exists(strtolower2))
	{
	}else{
		function strtolower2($value) 
	{
		return (strtolower(strtr( $value, UC_CHARS, LC_CHARS )));
	}	
	}
	if(function_exists(get_data)){
	} else {
	    function get_data($data)
		{
			$exp = explode(" ", $data);
			$exp1 = explode("-", $exp[0]); 
			$exp[1] = substr($exp[1], 0, 5);
			$data = "[$exp1[2]/$exp1[1]/$exp1[0] - $exp[1]]";
			return $data;
		}
	}
	
	if (function_exists(pluralize))
	{
	}else{
		function pluralize($busca)
		{
			$palavras = array();
		  
			$strx = explode(" ", $busca);
		  
			reset($strx);
			while (list($key, $val) = each($strx))
			{
				// adiciona a propria palavra
				$palavras[] = trim($val);
				
				// troca �es por �o
				if (ereg("�es$", $val) )
					$palavras[] = ereg_replace("�es$", "�o", $val);
					
				// troca �es por �os
				if (ereg("�es$", $val) )
					$palavras[] = ereg_replace("�es$", "�os", $val);
						
				// troca �o por �es
				if (ereg("�o$", $val) )
					$palavras[] = ereg_replace("�o$", "�es", $val);
					
				// troca �o por �os
				if (ereg("�o$", $val) )
					$palavras[] = ereg_replace("�o$", "�os", $val);	
				
				// troca �o por �es
				if (ereg("�o$", $val) )
					$palavras[] = ereg_replace("�o$", "�es", $val);	
				
				// troca �e por �es
				if (ereg("�e$", $val) )
					$palavras[] = ereg_replace("�e$", "�es", $val);
				
				// OS -> AS
				if (ereg("os$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("os$", "as", $val);
				
				// AS -> OS
				if (ereg("as$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("as$", "os", $val);	
						
				// OS -> O
				if (ereg("os$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("os$", "o", $val);
					
				// OS -> A
				if (ereg("os$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("os$", "a", $val);	
						
				// O -> OS
				if (ereg("o$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("o$", "os", $val);
				
				// AS -> A
				if (ereg("as$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("as$", "a", $val);
				
				// AS -> O
				if (ereg("as$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("as$", "o", $val);		
				
				// A -> AS
				if (ereg("a$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("a$", "as", $val);
				
				// I -> IS
				if (ereg("i$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("i$", "is", $val);
				
				// IS -> IL
				if (ereg("is$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("is$", "il", $val);
				
				// EL -> EIS (marcello)
				if (ereg("el$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("el$", "eis", $val);			
		
				// AL -> AIS (marcello)
				if (ereg("al$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("al$", "ais", $val);			
		
				// IL -> IS
				if (ereg("il$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("il$", "is", $val);			
		
				// E -> ES
				if (ereg("e$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("e$", "es", $val);
					
				// ES -> E
				if (ereg("es$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("es$", "e", $val);		
					
				// U -> US
				if (ereg("u$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("u$", "us", $val);
				
				// �U -> �IS
				if (ereg("�u$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("�u$", "�is", $val);
				
				// EU -> EIS
				if (ereg("eu$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("eu$", "eis", $val);		
				
				// EI -> EIS
				if (ereg("ei$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("ei$", "eis", $val);
						
				// R -> RES
				if (ereg("r$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("r$", "res", $val);
					
				// M -> NS
				if (ereg("m$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("m$", "ns", $val);
				
				// NS -> M
				if (ereg("ns$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("ns$", "m", $val);
					
				// O -> A
				if (ereg("o$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("o$", "a", $val);
					
				// O -> AS
				if (ereg("o$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("o$", "as", $val);	
				
				// A -> O
				if (ereg("a$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("a$", "o", $val);
					
				// A -> OS
				if (ereg("a$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("a$", "os", $val);
				
				// EL -> EIS
				if (ereg("el$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("el$", "eis", $val);
				
				// �L -> �IS
				if (ereg("�l$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("�l$", "�is", $val);
				
				// EI -> EIS
				if (ereg("ei$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("ei$", "eis", $val);	
					
				// AL -> AIS
				if (ereg("al$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("al$", "ais", $val);
				
				// RES -> AR
				if (ereg("res$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("res$", "ar", $val);	
					
				// OR -> ORES
				if (ereg("or$", $val) AND !ereg("�o$", $val) )
					$palavras[] = ereg_replace("or$", "ores", $val);							
			}
		
			$palavras = array_unique($palavras);
			return $palavras;
		}
	}


	
	
	
	
	
	

	
	
	
$mes_array = array("01" => "Janeiro", "02" => "Fevereiro", "03" => "Mar�o", "04" => "Abril",
				   "05" => "Maio", "06" => "Junho", "07" => "Julho", "08" => "Agosto", 
				   "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");

define( "UC_CHARS", "����������������������֌؊����ݎ�" ); // If you need more, add
define( "LC_CHARS", "���������������������������������" ); // If you need more, add

function zero_antes_old($string,$tamanho)
{
  if( strlen($string) < $tamanho ):
	  $zeros = '';
		for( $i=1;$i<=($tamanho - (strlen($string)));$i++ ):
		  $zeros .= '0';
		endfor;
		return $zeros.$string; 
	endif;
}


function zero_antes($string)
{
  if($string < 10 )
	$string = "0$string";
	return $string;
}
/*
//funcao que corrige erro ao converter a letras para minusculas
function strtolower2($value) {
  return (
   strtolower(
     strtr( $value, UC_CHARS, LC_CHARS )
   )
  );
}
*/
//funcao que corrige erro ao converter a letras para maiusculas
	if (function_exists(strtoupper2))
	{
	}else{
		function strtoupper2($value) {
		  return (
		   strtoupper(
		     strtr( $value, LC_CHARS, UC_CHARS )
		   )
		  );
		}
	}

function get_produto_area($id){

	$qr = mysql_db_query("coad", "SELECT descricao FROM produtos_areas WHERE id = '$id'");
	$rs = mysql_fetch_object($qr);
	$area = $rs->descricao;
	
	return $area;
}

if (function_exists(protect))
{

}else{

	function protect($string)
	{ 
    	return base64_encode(serialize($string));
	} 

}


if (function_exists(unprotect))
{

}else{

	function unprotect($string)
	{ 
    	return unserialize(base64_decode($string));
	}

}

function generatePassword ($length = 8)
{

  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
    
  // set up a counter
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  // done!
  return $password;

}

if(function_exists(get_data)){
 
 } else {
 
 function get_data($data){
  $exp = explode(" ", $data);
  $exp1 = explode("-", $exp[0]); 
  $exp[1] = substr($exp[1], 0, 5);
  $data = "[$exp1[2]/$exp1[1]/$exp1[0] - $exp[1]]";
  return $data;
 }
}

if(function_exists(get_data2)){

} else {

	function get_data2($data){
		$exp = explode(" ", $data);
		$exp1 = explode("-", $exp[0]);
		$data = "$exp1[2]-$exp1[1]-$exp1[0]";
		return $data;
	}
}

if(function_exists(get_data3)){

} else {

	function get_data3($data){
		$exp = explode(" ", $data);
		$exp1 = explode("-", $exp[0]);
		$data = "$exp1[2]/$exp1[1]/$exp1[0]";
		return $data;
	}
}

if(function_exists(get_data4)){

} else {

	function get_data4($data){
		$exp = explode(" ", $data);
		$exp1 = explode("-", $exp[0]);
		$data = "$exp1[2]";
		return $data;
	}
}

if(function_exists(get_indice)){

} else {

	function get_indice($idc){
		$qry	= mysql_query("SELECT descricao FROM lista_indices WHERE valor LIKE '$idc'");
		$rs		= mysql_fetch_array($qry);
		
		$nome	= $rs[descricao];
		
		return $nome;
	}
}

function get_grupo_noticia($noticia){

	$query	= mysql_query("SELECT id_grupo FROM noticias_conteudo WHERE id_noticia = '$noticia'");
	$rs		= mysql_fetch_object($query);
	
	$grupo	= $rs->id_grupo;
	
	return $grupo;
	
}

if (function_exists(removeaccents))
{

}else{

	function removeaccents($string)
	{
		return strtr(
		strtr($string, '�������������������������������������������������������������', 'SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy_'),
		array('�' => 'TH', '�' => 'th', '�' => 'DH', '�' => 'dh', '�' => 'ss', '�' => 'OE', '�' => 'oe', '�' => 'AE', '�' => 'ae', '�' => 'u'));
	}
}

	if (function_exists(limpa_texto))
	{
	}else{
		function limpa_texto($text){
	    // normalize white space
	      $text = eregi_replace("[[:space:]]+", " ", $text);
	      $text = str_replace("> <",">\r\r<",$text);
	         $text = str_replace("<br>","<br>\r",$text);
	
	
	            // keep tags, strip attributes
	         $text = ereg_replace("<p [^>]*BodyTextIndent[^>]*>([^\n|\n\015|\015\n]*)</p>","<p>\\1</p>",$text);
	         $text = eregi_replace("<p [^>]*margin-left[^>]*>([^\n|\n\015|\015\n]*)</p>","<blockquote>\\1</blockquote>",$text);
	         $text = str_replace("&nbsp;","",$text);
	
	            //clean up whatever is left inside <p> and <li>
	          $text = eregi_replace("<p align=\"center\">","@",$text);
	//        $text = eregi_replace("<p [^>]*>","<p>",$text);
	         $text = eregi_replace("<li [^>]*>","<li>",$text);
	
	            // kill unwanted tags
		     $text = eregi_replace("<SMALL>","",$text);
		     $text = eregi_replace("<H1[^>]*>","@",$text);
		     $text = eregi_replace("<H2[^>]*>","@",$text);
		     $text = eregi_replace("<H3[^>]*>","@",$text);
		     $text = eregi_replace("<H4[^>]*>","@",$text);
	
		     $text = eregi_replace("</SMALL>","",$text);
		     $text = eregi_replace("</?H1[^>]*>","@",$text);
		     $text = eregi_replace("</?H2[^>]*>","@",$text);
		     $text = eregi_replace("</?H3[^>]*>","@",$text);
		     $text = eregi_replace("</?H4[^>]*>","@",$text);
		     $text = eregi_replace("</?span[^>]*>","",$text);
	         $text = eregi_replace("</?body[^>]*>","",$text);
	         $text = eregi_replace("</?div[^>]*>","",$text);
	         $text = eregi_replace("<\![^>]*>","",$text);
	         $text = eregi_replace("</?[a-z]\:[^>]*>","",$text);
	
	            // kill style and on mouse* tags 
	         $text = eregi_replace("([ \f\r\t\n\'\"])style=[^>]+", "\\1", $text);
	         $text = eregi_replace("([ \f\r\t\n\'\"])on[a-z]+=[^>]+", "\\1", $text);
	
	            //remove empty paragraphs
	         $text = str_replace("<p></p>","",$text);
	         
	            //remove closing </html>
	         $text = str_replace("</html>","",$text);
	
	            //clean up white space again
	  $text = eregi_replace("[[:space:]]+", " ", $text);
	    $text = str_replace("> <",">\r\r<",$text);
	         $text = str_replace("<br>","<br>\r",$text);
			 
			 
				$text = ereg_replace("<P>", "<P align=justify>", $text);
				$text = ereg_replace("<p>", "<P align=justify>", $text);
				$text = eregi_replace("@","<p align=\"center\">",$text);
				$text = ereg_replace("<\/FONT>", " ", $text);
				$text = ereg_replace("<FONT[^>]*>", " ", $text);
				$text = ereg_replace("<\/font>", " ", $text);
				$text = ereg_replace("<font[^>]*>", " ", $text);
				$text = eregi_replace("<table ", "<table class=\"texto-link-tit\" ", $text);
				$text = eregi_replace("<TABLE ", "<table class=\"texto-link-tit\" ", $text);
				$text = eregi_replace("<br /> _", "@ _", $text);
				$text = eregi_replace("_<br />", "_@", $text);
				$text = eregi_replace("--<br />", "--@", $text);
				$text = eregi_replace("\.<br />", ".@", $text);
				$text = eregi_replace("\:<br />", ":@", $text);
				$text = eregi_replace("\;<br />", ";@", $text);
				
				$text = eregi_replace("\) <br />", ")@", $text);
				$text = eregi_replace("_ <br />", "_@", $text);
				$text = eregi_replace("-- <br />", "--@", $text);
				$text = eregi_replace("\. <br />", ".@", $text);
				$text = eregi_replace("\: <br />", ":@", $text);
				$text = eregi_replace("\; <br />", ";@", $text);
	
				$text = eregi_replace("\.<BR>", ".@", $text);
				$text = eregi_replace("\:<BR>", ":@", $text);
				$text = eregi_replace("\;<BR>", ";@", $text);
	
				$text = eregi_replace("\. <BR>", ".@", $text);
				$text = eregi_replace("\: <BR>", ":@", $text);
				$text = eregi_replace("\; <BR>", ";@", $text);
	
				$text = eregi_replace("<BR>", " ", $text);
				$text = eregi_replace("<br />", " ", $text);
				$text = eregi_replace("@", "<br /><br />", $text);
	        	$text = eregi_replace("\.\.\.\.\.\.\.\.\.\.\.\.\.\.\.\.\.", "", $text);
	
	$text = ereg_replace("WIDTH=\"+[[:alnum:]]+\"", "width=570", $text);
	$text = ereg_replace("whidth=+[[:alnum:]]+", "width=570", $text);
			
			
			return $text;
		}
	}

	if (function_exists(limpa_texto_atc))
	{
	}else{
		function limpa_texto_atc($text){
	    // normalize white space
	 //        $text = eregi_replace("[[:space:]]+", " ", $text);
	 //        $text = str_replace("> <",">\r\r<",$text);
	         $text = str_replace("<br>","<br>\r",$text);
	
	
	            // keep tags, strip attributes
	         $text = ereg_replace("<p [^>]*BodyTextIndent[^>]*>([^\n|\n\015|\015\n]*)</p>","<p>\\1</p>",$text);
	         $text = eregi_replace("<p [^>]*margin-left[^>]*>([^\n|\n\015|\015\n]*)</p>","<blockquote>\\1</blockquote>",$text);
	         $text = str_replace("&nbsp;","",$text);
	
	            //clean up whatever is left inside <p> and <li>
	          $text = eregi_replace("<p align=\"center\">","@",$text);
	//        $text = eregi_replace("<p [^>]*>","<p>",$text);
	         $text = eregi_replace("<li [^>]*>","<li>",$text);
	
	            // kill unwanted tags
		     $text = eregi_replace("<SMALL>","",$text);
		     $text = eregi_replace("<H1[^>]*>","@",$text);
		     $text = eregi_replace("<H2[^>]*>","@",$text);
		     $text = eregi_replace("<H3[^>]*>","@",$text);
		     $text = eregi_replace("<H4[^>]*>","@",$text);
	
		     $text = eregi_replace("</SMALL>","",$text);
		     $text = eregi_replace("</?H1[^>]*>","@",$text);
		     $text = eregi_replace("</?H2[^>]*>","@",$text);
		     $text = eregi_replace("</?H3[^>]*>","@",$text);
		     $text = eregi_replace("</?H4[^>]*>","@",$text);
		     $text = eregi_replace("</?span[^>]*>","",$text);
	         $text = eregi_replace("</?body[^>]*>","",$text);
	         
					 $text = eregi_replace("</?div[^>]*>","",$text);
	         $text = eregi_replace("<\![^>]*>","",$text);
	         $text = eregi_replace("</?[a-z]\:[^>]*>","",$text);
	
	            // kill style and on mouse* tags 
	         $text = eregi_replace("([ \f\r\t\n\'\"])style=[^>]+", "\\1", $text);
	         $text = eregi_replace("([ \f\r\t\n\'\"])on[a-z]+=[^>]+", "\\1", $text);
	
	            //remove empty paragraphs
	         $text = str_replace("<p></p>","",$text);
	         
	            //remove closing </html>
	         $text = str_replace("</html>","",$text);
	
	            //clean up white space again
	 //        $text = eregi_replace("[[:space:]]+", " ", $text);
	    //     $text = str_replace("> <",">\r\r<",$text);
	         $text = str_replace("<br>","<br>\r",$text);
	
				$text = eregi_replace("@","<p align=\"center\">",$text);
				$text = ereg_replace("<\/FONT>", " ", $text);
				$text = ereg_replace("<FONT[^>]*>", " ", $text);
				$text = ereg_replace("<\/font>", " ", $text);
				$text = ereg_replace("<font[^>]*>", " ", $text);
				$text = eregi_replace("<table ", "<table class=\"texto-link-tit\" ", $text);
				$text = eregi_replace("<TABLE ", "<table class=\"texto-link-tit\" ", $text);
				$text = eregi_replace("@", "<br /><br />", $text);
	      //Isto foi retirado porque estava dando problema em um informativo ATC no
				//qual esta fun��o abaixo suprimia os pontilhados que neste caso deveriam ser
				//visualizado
			  //mcm 10/10/2005 - 16:50
				//$text = eregi_replace("\.\.\.\.\.\.\.\.\.\.\.\.\.\.\.\.\.", "", $text);
	
	$text = ereg_replace("WIDTH=\"+[[:alnum:]]+\"", "width=470", $text);
	$text = ereg_replace("whidth=+[[:alnum:]]+", "width=470", $text);
			$text = stripslashes($text);
			
			return $text;
		}
	}	
	if (function_exists(troca_caracter_especial))
	{
	}else{
		function troca_caracter_especial($var)
{
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';   
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';   
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';

   if( array_key_exists( $var,$vetor_troca ) ):
     return($vetor_troca["$var"]);
   else:
     return($var);  
   endif;         
}
	}
	if (function_exists(limpa_texto))
	{
	}else{
		function formata_nome($var)
{
   // D� um lowercase() na vari�vel toda
   $var = strtolower($var);
   $var2 = ''; 

   for( $j=0;$j<strlen($var);$j++ ):
     $var2 .= troca_caracter_especial($var[$j]);
   endfor;

   $var = $var2;
   $tmp = explode(" ",$var);
   $knome = "";

   for($i=0;$i<count($tmp);$i++):
     if (($tmp[$i]=='e') or ($tmp[$i] == "de") or ($tmp[$i] == "da") or ($tmp[$i] == "do") or ($tmp[$i] == "di") or ($tmp[$i] == "dos") or ($tmp[$i]=="ii") or ($tmp[$i]=="iii") or ($tmp[$i]=="vi") or ($tmp[$i]=="iv") or ($tmp[$i]=="ix") or ($tmp[$i]=="xx")):
        $compara = strtoupper($tmp[$i]);

        if (($compara=="II") or ($compara=="III") or ($compara=="VI") or ($compara=="IV") or ($compara=="IX") or ($compara=="XX")):
           $knome_upper = strtoupper($tmp[$i]);
           $knome .= " ".$knome_upper;
        else:
           $knome .= " ".$tmp[$i];
        endif;
     else:
        $knome_upper = ucfirst($tmp[$i]);
        $knome .= " ".$knome_upper;
     endif;
   endfor;

   $knome = trim($knome);
   return($knome);
}
	}
	
//Retornar por quantos vezes o valor em quest�o pode ser dividido levanto
//em considera��o o numero minimo de parcelas e o valor minimo de cada parcela
function loja_nr_vezes( $vl_total,$vl_parcela_minima,$nr_parcela )
{  	
	$retorno = floor( $vl_total / $vl_parcela_minima );
	if( $vl_total < ($vl_parcela_minima * 2 ) ):
	  return 0;
	endif;	
	if( $retorno > $nr_parcela ):
	  return $nr_parcela;
	else:
	  return $retorno;
	endif;	
}

function troca_caracter_upper($var)
{
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';   
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';   
   $vetor_troca['�']='�';
   $vetor_troca['�']='�';

   if( array_key_exists( $var,$vetor_troca ) ):
     return $vetor_troca["$var"];
   else:
     return strtoupper($var);  
   endif;         
}

function upper( $str )
{
  $str_retorno = '';
	for( $i=0;$i<strlen($str);$i++ ):
	  $str_retorno .= troca_caracter_upper($str[$i]);		
	endfor;
	return $str_retorno;
}

if (!function_exists(prepara_busca)){

	function prepara_busca( $string ){
	
		$string = strtolower2(trim($string));
		$string = ereg_replace(" nos ", " ", $string);
		$string = ereg_replace(" nas ", " ", $string);
		$string = ereg_replace(" dos ", " ", $string);
		$string = ereg_replace(" das ", " ", $string);
		$string = ereg_replace(" aos ", " ", $string);
		$string = ereg_replace(" de ", " ", $string);
		$string = ereg_replace(" da ", " ", $string);
		$string = ereg_replace(" do ", " ", $string);
		$string = ereg_replace(" com ", " ", $string);
		$string = ereg_replace(" em ", " ", $string);
		$string = ereg_replace(" e ", " ", $string);
		$string = ereg_replace(" a ", " ", $string);
		$string = ereg_replace(" o ", " ", $string);
		$string = ereg_replace(" ou ", " ", $string);
		$string = ereg_replace(" para ", " ", $string);
		$string = ereg_replace(" por ", " ", $string);
		$string = ereg_replace(" pela ", " ", $string);
		$string = ereg_replace(" no ", " ", $string);
		$string = ereg_replace(" na ", " ", $string);
		$string = ereg_replace(" pelas ", " ", $string);
		$string = ereg_replace("-", " ", $string);
		$string = ereg_replace(" ", " ", $string);
		$string = ereg_replace(" ", " ", $string);
		$string = ereg_replace("\.", "", $string);
		$string = ereg_replace("\,", "", $string);
		$string = ereg_replace(" E ", " ", $string);
		return $string;
	}	
}

if (!function_exists(br_date)){

	function br_date($data){
	  
 	 if( strlen($data) == 19 ):
	  $tmp1 = explode(" ",$data);
		$tmp = explode("-",$tmp1[0]);
		$ano = $tmp[0];
		$mes = $tmp[1];
		$dia = $tmp[2];
		return $dia.'/'.$mes.'/'.$ano.' '.$tmp1[1];
	elseif( (strlen($data) == 10)&&($data != '0000-00-00') ):
	  $tmp = explode("-",$data);
		$ano = $tmp[0];
		$mes = $tmp[1];
		$dia = $tmp[2];
		return $dia.'/'.$mes.'/'.$ano;
	else:
	  return '';		
	endif;
	}
}
	
if (!function_exists(br_date2)){

	function br_date2($data){
	  
	  if( strlen($data) == 19 ):
		  $tmp1 = explode(" ",$data);
			$tmp = explode("-",$tmp1[0]);
			$ano = $tmp[0];
			$ano = $ano[2].$ano[3];
			$mes = $tmp[1];
			$dia = $tmp[2];
			return $dia.'/'.$mes.'/'.$ano.' '.$tmp1[1];
		elseif( (strlen($data) == 10)&&($data != '0000-00-00') ):
		  $tmp = explode("-",$data);
			$ano = $tmp[0];
			$ano = $ano[2].$ano[3];
			$mes = $tmp[1];
			$dia = $tmp[2];
			return $dia.'/'.$mes.'/'.$ano;
		else:
		  return '';		
		endif;
	}
}




		function replace_accentos_por_normais($var)
		{
			$var = ereg_replace("[����]","A",$var);
			$var = ereg_replace("[����]","a",$var);
			$var = ereg_replace("[���]","E",$var);
			$var = ereg_replace("[���]","e",$var);
			$var = ereg_replace("[���]","I",$var);
			$var = ereg_replace("[���]","i",$var);
			$var = ereg_replace("[����]","O",$var);
			$var = ereg_replace("[�����]","o",$var);
			$var = ereg_replace("[���]","U",$var);
			$var = ereg_replace("[���]","u",$var);
			$var = str_replace("�","C",$var);
			$var = str_replace("�","c",$var);
			return $var;
		}



?>
