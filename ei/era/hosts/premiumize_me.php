<?php
/*
$account = trim($this->get_account('premiumize.me'));
if (stristr($account,':')) list($user, $pass) = explode(':',$account);
else $cookie = $account;
if(empty($cookie)==false || ($user && $pass)){
	for ($j=0; $j < 2; $j++){
		$data = $this->curl("https://api.premiumize.me/pm-api/v1.php?method=directdownloadlink&params[login]=".$user."&params[pass]=".$pass."&params[link]=".$url, "", "", 0);
		$page = @json_decode($data, true);
		if ($page['status'] == 200) {
			if(isset($page['result']['location'])) {
				$link = trim($page['result']['location']);
				$size_name = Tools_get::size_name($link, "");
				if($size_name[0] > 200) {
					$filesize = $size_name[0];
					$filename = $size_name[1];
					break;
				}
				else $link = "";
			}
		}
		elseif ($page['status'] == 400) die("<font color=red><b>".$page['statusmessage']."</b></font>");
		else {
			$cookie = "";
			$this->save_cookies("premiumize.me", "");
		}
	}
}
*/
class dl_premiumize_me extends Download {

	/*public function CheckAcc($cookie){
		$data = $this->lib->curl("http://rapidgator.net/profile/index", "lang=en;{$cookie}", "");
		if(stristr($data, '<a href="/article/premium">Free</a>')) return array(false, "accfree");
		elseif(stristr($data, 'Premium till')) {
			$oob = $this->lib->curl("http://rapidgator.net/file/79674811", "lang=en;{$cookie}", "");
			if(stristr($oob, 'You have reached quota of downloaded information')) return array(true, "Until ".$this->lib->cut_str($data, 'Premium till','<span'). "<br> Account out of BW");
			else return array(true, "Until ".$this->lib->cut_str($data, 'Premium till','<span')." <br/>Bandwith available:" .$this->lib->cut_str($this->lib->cut_str($data, 'Bandwith available</td>','<div style='), '<td>','</br>'));
		}
		else return array(false, "accinvalid");
	}*/
	
	/*public function Login($user, $pass){
		$data = $this->lib->curl("https://api.premiumize.me/pm-api/v1.php?method=directdownloadlink&params[login]=".$user."&params[pass]=".$pass."&params[link]=".$url, "", "", 0);
		$page = @json_decode($data, true);
		$cookie = "lang=en;".$this->lib->GetCookies($data);
		return $cookie;
	}*/
	
    public function Leech($user, $pass, $url) {
		$data = $this->lib->curl("https://api.premiumize.me/pm-api/v1.php?method=directdownloadlink&params[login]=".$user."&params[pass]=".$pass."&params[link]=".$url, "", "", 0);
		$page = @json_decode($data, true);
		if ($page['status'] == 400) $this->error("<font color=red><b>".$page['statusmessage']."</b></font>");
		else if ($page['status'] == 200) {
			if(isset($page['result']['location'])) {
				$link = trim($page['result']['location']);
				return trim($link);
			}
		}
		return false;
    }

}
/*
* Home page: http://vinaget.us
* Blog:	http://blog.vinaget.us
* Script Name: Vinaget 
* Version: 2.7.0 rev81
* Created: rayyan2005
*/
?>