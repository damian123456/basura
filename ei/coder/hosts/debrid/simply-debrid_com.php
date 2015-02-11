<?php
$account = trim($this->get_account('simply-debrid.com'));
if (stristr($account,':')) list($user, $pass) = explode(':',$account);
else $cookie = $account;
if(empty($cookie)==false || ($user && $pass)){
	for ($j=0; $j < 2; $j++){
		if(!$cookie) $cookie = $this->get_cookie("simply-debrid.com");
		if(!$cookie){
		 $youn = $this->curl("https://simply-debrid.com/api.php","","login=1&u=$user&p=$pass");
			$cookie = $this->GetCookies($youn);
			$this->save_cookies("simply-debrid.com",$cookie);
		}
		$this->cookie = $cookie;
		$youn = $this->curl("https://simply-debrid.com/api.php",$cookie,"dl=$url");
		//echo $youn;
		if (trim($youn)=='') die('Link error or not support by simply-debrid.com');
		elseif(preg_match('%(http\:\/\/.*?)%U', $youn, $linkpre) && stristr($youn,"sd.php")){
			$link = $linkpre[1];
			$size_name = Tools_get::size_name($link, $this->cookie);
			//print_r($size_name);
			$filesize = $size_name[0];
			$filename = $size_name[1];
			break;
		}
		else {
			$cookie = "";
			$this->save_cookies("simply-debrid.com","");
		}
	}
}


/*
* Script Name: Vinaget 
* Version: 2.6.3
* Created: Vikky Reddy
* Date : 19/11/2014, Morocco, [GMT +1], 20:46 
*/
?>