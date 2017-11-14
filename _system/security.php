<?php
/* _SYSTEM.SECURITY */
/*****************************************************************/

/**
  * List of function within SECURITY
  * prevent_direct_access_Security()
  * is_logged_in_Security()
  *	encrypt_Security($pure_string,$encryption_key)
  * decrypt_Security($encrypted_string, $encryption_key) 
  * sanitize_Security($input)
  *	detect_city_state_Security($ip) 
  * detect_ip_address_Security()
*/


/**
  * @desc	no direct access to php page
  * @param	
  * @return 
*/
	function prevent_direct_access_Security()
	{
		if($_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF'])
		{
			header("Location: 404.php");
		}
	}
/*****************************************************************/



/**
  * @desc	check that user is logged in
  * @param	
  * @return 
*/
	function is_logged_in_Security() 
	{		
		$inactive = LOGIN_TIMEOUT; // set timeout period in seconds (located in /_system/config.php)
		
		if(!isset($_SESSION['users.is_logged_in']))
		{
			session_destroy();
			header( 'Location: '.site_Url().'login/view.php?message=login' );
			exit;
		}
		
		// check to see if $_SESSION['timeout'] is set
		if(isset($_SESSION['timeout']) ) {
			$session_life = time() - $_SESSION['timeout'];
			if($session_life > $inactive)
				{ 
				// go to login page when idle
				session_destroy(); 
				header( 'Location: '.site_Url().'login/view.php?message=timed_out' ); 
			}
		}
		$_SESSION['timeout'] = time();
	}
/*****************************************************************/

/**
  * @desc	Returns an encrypted & utf8-encoded
  * @param	$pure_string, $encryption_key
  * @return $encrypted_string
*/
	function encrypt_Security($sData, $sKey)
	{ 
    	$sResult = ''; 
    	for($i=0;$i<strlen($sData);$i++)
		{ 
        	$sChar    = substr($sData, $i, 1); 
        	$sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1); 
        	$sChar    = chr(ord($sChar) + ord($sKeyChar)); 
        	$sResult .= $sChar; 
    	} 
		
		return encode_base64($sResult); 
} 
/*****************************************************************/

/**
  * @desc	Returns decrypted original string
  * @param	$encrypted_string, $encryption_key
  * @return $decrypted_string
*/
	function decrypt_Security($sData, $sKey)
	{ 
    	$sResult = ''; 
    	$sData   = decode_base64($sData); 
    	for($i=0;$i<strlen($sData);$i++)
		{ 
        	$sChar    = substr($sData, $i, 1); 
        	$sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1); 
        	$sChar    = chr(ord($sChar) - ord($sKeyChar)); 
        	$sResult .= $sChar; 
    	} 
    	
		return $sResult; 
} 
/*****************************************************************/


/**
  * @desc	access from within this function only
  * @param	$sData
  * @return $sBase64
*/
	function encode_base64($sData)
	{ 
		$sBase64 = base64_encode($sData); 
		return strtr($sBase64, '+/', '-_'); 
	} 
	
	function decode_base64($sData)
	{ 
		$sBase64 = strtr($sData, '-_', '+/'); 
		return base64_decode($sBase64); 
	}  
/*****************************************************************/



/**
  * @desc	Sanitize database inputs, trim and addslashes
  * @param	$input
  * @return $output
*/
	function sanitize_Security($input) {
		if (is_array($input)) {
			foreach($input as $var=>$val) {
				$output[$var] = sanitize_Security($val);
			}
		}
		else {
			if (get_magic_quotes_gpc()) {
				$input = stripslashes($input);
			}
			$input  = cleanInput_Security($input);
			$output = mysql_real_escape_string($input);
		}
		return $output;
	}

	function cleanInput_Security($input,$extra_option=FALSE) {
	
	  $search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	  );
	
		$output = preg_replace($search, '', $input);
		$output = trim($output);			
		$output = addslashes($output);
		mysqli_real_escape_string($_SESSION['connection'], $output);
		if($extra_option != FALSE and $extra_option = 'encrypt')
		{
			$output = encrypt_Security(trim($output),ENCRYPTION_KEY);
		}
			
		return $output;
	  }
/*****************************************************************/

/**
  * @desc	get IP addres of user even if user behind proxy server 
  * @param	
  * @return $ip
*/
	function detect_ip_address_Security()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
/*****************************************************************/



/**
  * @desc	Detects the location of users IP address
  * @param	$ip
  * @return $location (city and state)
  * @WARNING - this is the IP location, not exacly where the user is
*/
	function detect_city_state_Security($ip) 
	{ 
        $default = 'UNKNOWN';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $curlopt_useragent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }

        if( $city!='' && $state!='' ){
          $location = $city . ', ' . $state;
          return $location;
        }else{
          return $default; 
        }
        
    }
/*****************************************************************/

?>