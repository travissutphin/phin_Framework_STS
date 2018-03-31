<?php
/* _SYSTEM.URL */
/*****************************************************************/


/**
  * @desc	url to the root of the app
  * @param	
  * @return $site_url
*/
	function site_Url()
	{
		$site_url = 'http://'.$_SERVER['HTTP_HOST'].''.APP_DIRECTORY;
		return $site_url;
	}
/*****************************************************************/


/**
  * @desc	dir structure root of the app
  * @param	
  * @return $root_url
*/
	function root_Url()
	{
		$root_url = $_SERVER['DOCUMENT_ROOT'].''.APP_DIRECTORY;
		return $root_url;
	}
/*****************************************************************/


/**
  * @desc	url the user is on
  * @param	
  * @return $root_url
*/
	function current_page_Url()
	{
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on") 
		{	
			$pageURL .= "s";
		}
		
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
/*****************************************************************/

/**
  * @desc	get tiny url
  * @param	
  * @return $data
*/
	function get_tiny_Url($url)  {  
		$ch = curl_init();  
		$timeout = 5;  
		curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
		$data = curl_exec($ch);  
		curl_close($ch);  
		return $data;  
	}
/*****************************************************************/
?>