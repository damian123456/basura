<?php

class dl_file4sharing_com extends Download {
    
    public function CheckAcc($cookie){
        $data = $this->lib->curl("http://file4sharing.com/?op=my_account", "lang=english;{$cookie}", "");
        if(stristr($data, 'Premium account expire:')) return array(true, "Until ".$this->lib->cut_str($data, 'expire:</TD><TD><b>', '<'));
        else if(stristr($data, 'Username:') && !stristr($data, 'Premium account expire')) return array(false, "accfree");
		else return array(false, "accinvalid");
    }
    
    public function Login($user, $pass){
        $data = $this->lib->curl("http://file4sharing.com/", "lang=english", "op=login&login={$user}&password={$pass}&redirect=");
		return "lang=english;" .$this->lib->GetCookies($data);
    }
	
    public function Leech($url) {
		list($url, $pass) = $this->linkpassword($url);
		$data = $this->lib->curl($url, $this->lib->cookie, "");
		if($pass) {
			$post = $this->parseForm($this->lib->cut_str($data, '<Form name="F1"', '</Form>'));
			$post["password"] = $pass;
			$data = $this->lib->curl($url, $this->lib->cookie, $post);
			if(stristr($data,'Wrong password'))  $this->error("wrongpass", true, false, 2);
			else return trim($this->lib->cut_str($this->lib->cut_str($data, "This direct link will be available", "</a>"), "href=\"", "\">ht"));
		}
		if(stristr($data, 'Password:</b> <input type="password" name="password"')) 	  $this->error("reportpass", true, false);
		elseif(stristr($data, 'The file was deleted by its owner'))    $this->error("dead", true, false, 2);
		elseif(!$this->isredirect($data)) {
			$post = $this->parseForm($this->lib->cut_str($data, '<Form name="F', '</Form'));
			$data = $this->lib->curl($url, $this->lib->cookie, $post);
			return trim($this->lib->cut_str($this->lib->cut_str($data, "This direct link will be available", "</a>"), "href=\"", "\">ht"));
		} 
		else  return trim($this->redirect);
		return false;
    }
	
}

/*
* Open Source Project
* Vinaget by ..::[H]::..
* Version: 2.7.0
* File4sharing.com Download Plugin by giaythuytinh176 [10.1.2014]
* Downloader Class By [FZ]
*/
?>