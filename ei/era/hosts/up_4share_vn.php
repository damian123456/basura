<?php

class dl_up_4share_vn extends Download {
	
	public function CheckAcc($cookie) {
		
		$data = $this->lib->curl('http://up.4share.vn/member', $cookie, '');
		
		if(stristr($data, '>Tài khoản đã hết hạn')) return array(false, 'accfree');
		
		elseif(stristr($data, '>Ngày hết hạn: <')) return array(true, 'Until ' .$this->lib->cut_str($data, 'Ngày hết hạn: <b>', '<br/><span'). '<br/> Traffic avaiable:' .$this->lib->cut_str($data, 'Bạn còn được download', '<br/'));
		
		else return array(false, 'accinvalid');
	}
	
	public function Login($user, $pass) {
		
		$data = $this->lib->curl('http://up.4share.vn/index/login', '', 'username='.$user.'&password='.$pass.'&remember_login=on&submit= ĐĂNG NHẬP ');
		return $this->lib->GetCookies($data);
	}
	
    public function Leech($link) {
		
		$page = $this->lib->curl($link, $this->lib->cookie, ''); 
		
		if (stristr($page, 'Bạn đợi ít phút để download file này!')) $this->error('Bạn đợi ít phút để download file này!', true, false);
		
		if (stristr($page, 'File is deleted?') || stristr($page,'File không tồn tại?')) $this->error('File is deleted? (' .$this->lib->cut_str($page, 'File is deleted? (', ')<'). ')', true, false, 2);
		
		if (!preg_match('@https?:\/\/sv\d+\.4share\.vn\/\d+\/\?info=[^\'\r\n]+@i', $page, $dlink)) $this->error('Download link not found.', true, false);
		
		return trim($dlink[0]);
		
		return false;
    }

}

/*
* Open Source Project
* Vinaget by ..::[H]::..
* Version: 2.7.0
* 4Share.VN Download Plugin 
* Downloader Class By [FZ]
* Plugin By giaythuytinh176
* Date: 16.7.2013 
* Check account included - 18.7
* Fix login 4share [21.7.2013]
* Support file password by giaythuytinh176 [29.7.2013]
* Fixed check account by giaythuytinh176 [29.7.2013]
*/
?>