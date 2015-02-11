<?php

class dl_nitroflare_com extends Download {

	public function CheckAcc($cookie){
		$data = $this->lib->curl("https://www.nitroflare.com/member?s=premium", $cookie, "");
		if(stristr($data, '<strong style="color: green;">Active</strong>')) 
			return array(true, "Time Left: ".$this->lib->cut_str($data, '<label>Time Left</label><strong>','</strong></div>'). "<br>". $this->lib->cut_str($data, '<label>Daily Limit</label><strong>','</strong></div>'));
		elseif(stristr($data, 'Inactive')) return array(false, "accfree");
		else return array(false, "accinvalid");
	}
	
	public function Login($user, $pass){
		$page = $this->lib->curl("https://www.nitroflare.com/login", "", "");
		$ck = $this->lib->GetCookies($page);
		$token = $this->lib->cut_str($page, 'hidden" name="token" value="', '" />');
		$data = $this->lib->curl("https://www.nitroflare.com/login", $ck, "email={$user}&password={$pass}&login=&token={$token}");
		$cookie = $this->lib->GetCookies($data);
		return $cookie;
	}
	
    public function Leech($url) {
		$data = $this->lib->curl($url,$this->lib->cookie,"");
		if(preg_match('/location: (.*)/', $data, $matches)) $data = $this->lib->curl("https://www.nitroflare.com".trim($matches[1]),$this->lib->cookie,"");
		if((stristr($data, "This file has been removed due to inactivity")) || (stristr($data, "File doesn't exist")))  $this->error("dead", true, false, 2);
		elseif(preg_match('@https?:\/\/\w+\.nitroflare\.com\/d\/[^"\'><\r\n\t]+@i', $data, $invo))
		return trim($invo[0]);
		return false;
    }

}

/*
* Open Source Project
* Vinaget by ..::[H]::..
* Version: 2.7.0
* Nitroflare.com Download Plugin 
* Downloader Class By [FZ]
* Created: invokermoney [09.12.14]
*/
?>