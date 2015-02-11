<?php
/*

* Home page: http://vinaget.us
* Blog:	http://blog.vinaget.us
* Script Name: Vinaget 
* Version: 2.6.3
* Description: 
	- Vinaget is script generator premium link that allows you to download files instantly and at the best of your Internet speed.
	- Vinaget is your personal proxy host protecting your real IP to download files hosted on hosters like RapidShare, megaupload, hotfile...
	- You can now download files with full resume support from filehosts using download managers like IDM etc
	- Vinaget is a Free Open Source, supported by a growing community.
* Code LeechViet by VinhNhaTrang
* Developed by ..:: [H] ::..
* Edited by France
*/

##################################### Begin class getinfo #####################################
class getinfo {
	function config(){
		include('config.php');
		$this->self = 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/\?.*$/', '', isset($_SERVER['REQUEST_URI'])? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
		if (!defined('vinaget')){
		  echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://'.$homepage.'">';
		  exit;
		}

		if (!file_exists(".htaccess")) {
			$clog=fopen(".htaccess","a") 
			or die('<CENTER><font color=red size=4>Can\'t find file <B>.htaccess</B></font></CENTER>');
			fwrite($clog,'');
			fclose($clog);
		}
		elseif (filesize(".htaccess") < 200) {

			#----------- Begin create file .htaccess -----------#
			$slashes = explode('/', $this->self);
			$max =  count($slashes)-1;
			$namefolder = "";
			if($max>3) for($i=3;$i<$max;$i++) $namefolder .= "/".$slashes[$i];
			else $namefolder = "/";
			$strhta ="";
			$strhta .= "RewriteEngine on\n";
			$strhta .= "RewriteBase $namefolder\n";
			$strhta .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
			$strhta .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
			$strhta .= "RewriteRule ^(.*)/(.*)/ index.php?file=$2\n";
			$strhta .= "order deny,allow\n";
			$strhta .= '<files ~ "\.(php|php.*|sphp|php3|php4|php5|phtml|cgi|pl|shtml|dhtml|html|htm|txt|dat)$">';
			$strhta .= "\n";
			$strhta .= "deny from all\n";
			$strhta .= "</files>\n";
			$strhta .= "\n";
			$strhta .= "<files add.php>\n";
			$strhta .= "allow from all\n";
			$strhta .= "</files>\n";
			$strhta .= "\n";
			$strhta .= "<files index.php>\n";
			$strhta .= "allow from all\n";
			$strhta .= "</files>\n";
			$strhta .= "\n";
			$strhta .= "<files login.php>\n";
			$strhta .= "allow from all\n";
			$strhta .= "</files>\n";
			$strhta .= "\n";
			$strhta .= "<files log.txt>\n";
			$strhta .= "deny from all\n";
			$strhta .= "</files>\n";
			$strhta .= "\n";
			$strhta .= '<files ~ "^\.">';
			$strhta .= "\n";
			$strhta .= "deny from all\n";
			$strhta .= "</files>";

			$htafile = ".htaccess";
			$fhta = fopen ($htafile, "w")
			or die('<CENTER><font color=red size=3>could not open file! Try to chmod the folder "<B>.htaccess</B>" to 666</font></CENTER>');
			fwrite ($fhta, $strhta)
			or die('<CENTER><font color=red size=3>could not write file! Try to chmod the folder "<B>.htaccess</B>" to 666</font></CENTER>');
			fclose ($fhta); 
			@chmod($htafile, 0666);

			#----------- End create file .htaccess -----------#
		}

		if (!file_exists ($fileinfo_dir)) {
			mkdir($fileinfo_dir, 0777)  
			or die("<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder \"<B>$fileinfo_dir</B>\" to 777</font></CENTER>");
		}
		if (!file_exists ($fileinfo_dir."/tmp" )) {
			mkdir($fileinfo_dir."/tmp", 0777)   
			or die("<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder \"<B>$fileinfo_dir</B>\" to 777</font></CENTER>");
		}
		if (!file_exists ($fileinfo_dir."/online" )) {
			mkdir($fileinfo_dir."/online", 0777)   
			or die("<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder \"<B>$fileinfo_dir</B>\" to 777</font></CENTER>");
		}
		if (!file_exists ($fileinfo_dir."/files" )) {
			mkdir($fileinfo_dir."/files", 0777)   
			or die("<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder \"<B>$fileinfo_dir</B>\" to 777</font></CENTER>");
		}
		if(!file_exists($fileinfo_dir."/index.php")) { 
			$clog=fopen($fileinfo_dir."/index.php","a") 
			or die("<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder \"<B>$fileinfo_dir</B>\" to 777</font></CENTER>");
			fwrite($clog,'<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://'.$homepage.'">');
			fclose($clog);
		}
		if(!file_exists($fileinfo_dir."/files/index.php")) { 
			$clog=fopen($fileinfo_dir."/files/index.php","a") 
			or die("<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder \"<B>$fileinfo_dir</B>\" to 777</font></CENTER>");
			fwrite($clog,'<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://'.$homepage.'">');
			fclose($clog);
		}
		if ($Secure == true) $this->Deny = true;
		foreach ($SecureID as $login_vng)
		if((isset($_COOKIE["secureid"]) && $_COOKIE["secureid"] == md5($login_vng))) {
			$this->Deny = false;
			break;
		}

		$this->Secure = $Secure;
		$this->fileinfo_dir = $fileinfo_dir;
		$this->fileinfo_ext = $fileinfo_ext;
		$this->download_prefix = $download_prefix;
		$this->banned = explode(' ', '.htaccess .htpasswd .php .php3 .php4 .php5 .phtml .asp .aspx .cgi .pl');    // banned filetypes
		$this->unit = 512; 
		$this->limitMBIP = $limitMBIP;
		$this->ttl = $ttl;
		$this->limitPERIP = $limitPERIP; 
        $this->ttl_ip = $ttl_ip; 
		$this->max_jobs_per_ip = $max_jobs_per_ip;  
		$this->max_jobs  = $max_jobs; 
		$this->max_load = $max_load;
		$this->linkdirect = $linkdirect;
		$this->badword = $badword;
		$this->act = $action;
		$this->listfile = $listfile;
		$this->checkacc = $checkacc;
		$this->privatef = $privatefile;
		$this->privateip = $privateip;
		$this->check3x = $checklinksex;
		$this->filecookie = "/".$filecookie;
		$this->colorfn = $colorfilename;
		$this->colorfs = $colorfilesize;
		$this->title = $title;
		$this->debrid = $debrid;
		$this->plugin = $plugin;
		$this->iddowntype = $iddowntype;
		$this->api1 = $api1;
		$this->api2 = $api2;
		$this->api3 = $api3;
		$this->api4 = $api4;
		$this->multiapi = $multiapi;
		$this->shortlink = $shortlink;
	}

	function notice(){
		echo '<blink><font color=#AB0000>'._autodel.' <B>'.Tools_get::convert_time($this->ttl*60).'</B>. '._autodel1.' <B>'.$this->limitPERIP.'</B> '._autodel2.' <B>'.Tools_get::convert_time($this->ttl_ip*60).'</B> '._autodel3.' <B>1</B> IP</font></blink><BR>'; 

		$this->CheckMBIP();
		$MB1IP = $this->countMBIP;
		if($MB1IP >= 1024) $MB1IP = round($MB1IP/1024, 1)." GB";
		else $MB1IP = $MB1IP." MB";
		$thislimitMBIP =	round($this->limitMBIP/1024,0) .' GB';

		echo "Your IP: ".$_SERVER['REMOTE_ADDR'].". Your jobs: ".$this->lookup_ip($_SERVER['REMOTE_ADDR'])." (max: ".$this->max_jobs_per_ip.")."._Total1." ".$MB1IP ." (max: ".$thislimitMBIP.").<BR>";

		echo "File size limit: $this->max_size_other_host MB. Total jobs: ".count($this->jobs)." (max: $this->max_jobs). Server load: ".$this->get_load()." (max allowed: $this->max_load). Users online: ".Tools_get::useronline();
	}

	function showplugin(){
		foreach ($this->acc as $host => $value) {
			$xout = array('');
			$xout = $this->acc[$host]['accounts'];
			$max_size = $this->acc[$host]['max_size'];
			$plugin = str_replace("_",".",$this->plugin) ;
			$plugin = str_replace(".php",'',$plugin) ;
			if (empty($xout[0])==false && empty($host)==false){
				if($this->debrid==true && $host==$plugin)
				{
					$hosts[]= '<span class="plugincollst"><font color=#00aeff>' .$host. '</font> '.count($xout).'</span><br/>';
				}
				else
				{ 
					$hosts[]=  '<span class="plugincollst">' .$host . ' '.count($xout).'</span><br/>';
				}
			}
		}
		if(isset($hosts)){
			if(count($hosts)>4){
				for ($i=0; $i < 5; $i++) echo "$hosts[$i]";
				echo "<div id=showacc style='display: none;'>";
				for ($i=5; $i < count($hosts); $i++) echo "$hosts[$i]";
				echo "</div>";
			}
			else for ($i=0; $i < count($hosts); $i++) echo "$hosts[$i]";
			if(count($hosts)>4) echo "<a onclick=\"showOrHide();\" href=\"javascript:void(0)\" style='TEXT-DECORATION: none'><font color=#FF6600><div id='moreacc'>"._moreacc."</div></font></a>";
		}
		return false;
	}
	function load_jobs(){
		if (isset($this->jobs)) return;
		$dir = opendir($this->fileinfo_dir."/files/");
		$this->lists = array();
		while ($file = readdir($dir)){
			if (substr($file,-strlen($this->fileinfo_ext)-1) == "." . $this->fileinfo_ext){
				$this->lists[] = $this->fileinfo_dir."/files/" . $file;
			}
		}
		closedir($dir);
		$this->jobs = array();
		if (count($this->lists)){
			sort($this->lists);
			foreach ($this->lists as $file){
				$contentsfile = @file_get_contents($file);
				$jobs_data = @json_decode($contentsfile, true);	
				if (is_array($jobs_data)){
					$this->jobs = array_merge($this->jobs,$jobs_data);
				}
			}
				
		}
	}

	function save_jobs(){
		if (!isset($this->jobs) || is_array($this->jobs)==false)return;
		### clean jobs ###
		$oldest = time() - $this->ttl*60;
		$delete = array();
		foreach ($this->jobs as $key=>$job) {
			if ($job['mtime'] < $oldest) {
				$delete[] = $key;
			}
		}
		foreach ($delete as $url) {
			unset($this->jobs[$url]);
		}
		### clean jobs ###
		$namedata = $timeload = explode(" ", microtime());
		$namedata = $namedata[1]*1000 + round($namedata[0]*1000);
		$this->fileinfo = $this->fileinfo_dir."/files/" .$namedata. "." . $this->fileinfo_ext;
		$tmp = @json_encode($this->jobs);
		$fh = fopen($this->fileinfo, 'w') or die('<CENTER><font color=red size=3>Could not open file ! Try to chmod the folder "<B>'.$this->fileinfo_dir."/files/".'</B>" to 777</font></CENTER>');
		fwrite($fh, $tmp);
		fclose($fh);
		@chmod($this->fileinfo, 0666);
		if (count($this->lists)) foreach ($this->lists as $file) if (file_exists($file)) @unlink($file);
		return true;
	}

	function load_cookies(){
		if (isset($this->cookies)){
    		return;
		}
		$this->cookies_data = @file_get_contents($this->fileinfo_dir.$this->filecookie);
		$this->cookies = @json_decode($this->cookies_data, true);;	
		if (! is_array($this->cookies))
		{
			$this->cookies = array();
			$this->cookies_data = 'wtf';
		}
	}

	function get_cookie($site){
		$cookie="";
		if(isset($this->cookies) && count($this->cookies)>0){
			foreach ($this->cookies as $ckey=>$cookies){
				if ($ckey === $site){
					$cookie = $cookies['cookie'];
					break;
				}
			}
		}
		return $cookie;
	}

	function save_cookies($site,$cookie){
		if (!isset($this->cookies)) return;
		if($site){
			$cookies = array(
					'cookie'	=> $cookie,
					'time'	=> time(),
			); 
			$this->cookies[$site] = $cookies;
		}
		$tmp = json_encode($this->cookies);
		if ($tmp !== $this->cookies_data){
			$this->cookies_data = $tmp;
			$fh = fopen($this->fileinfo_dir.$this->filecookie, 'w') 
			or die('<CENTER><font color=red size=3>Could not open file ! Try to chmod the folder "<B>'.$this->fileinfo_dir.'</B>" to 777</font></CENTER>');
			fwrite($fh, $this->cookies_data) 
			or die('<CENTER><font color=red size=3>Could not write file ! Try to chmod the folder "<B>'.$this->fileinfo_dir.'</B>" to 777</font></CENTER>');
			fclose($fh);
			@chmod($this->fileinfo_dir.$this->filecookie, 0666);
			return true;	
		}
	}

	function get_load($i = 0){
		$load = array('0', '0', '0');
		if (@file_exists('/proc/loadavg')){
			if ($fh = @fopen('/proc/loadavg', 'r')){
				$data = @fread($fh, 15);
				@fclose($fh);
				$load = explode(' ', $data);
			}
		}
		else{
			if ($serverstats = @exec('uptime')){
				if (preg_match('/(?:averages)?\: ([0-9\.]+),?[\s]+([0-9\.]+),?[\s]+([0-9\.]+)/', $serverstats, $matches)){
					$load = array($matches[1], $matches[2], $matches[3]);
				}
			}
		}
		return $i==-1 ? $load : $load[$i];
	}
	function lookup_ip($ip){
		$this->load_jobs();
		$cnt = 0;
		foreach ($this->jobs as $job)
		{
			if ($job['ip'] === $ip) $cnt++;
		}
		return $cnt;
	}
    	function Checkjobs() {
		$REMOTE_ADDR = $_SERVER ['REMOTE_ADDR'];
		$heute = 0;
		$xhandle = opendir ( $this->fileinfo_dir."/tmp");
		while ( $buin = readdir ($xhandle)) {
			if (stristr($buin, "$REMOTE_ADDR" )) {
				$heute++;}
		}
		return $heute;
		closedir ( $xhandle );
	}
	function get_account($service){
		$acc = '';
		if (isset($this->acc[$service])){
			$service = $this->acc[$service];
			$this->max_size = $service['max_size'];
			if(count($service['accounts'])>0) $acc = $service['accounts'][rand(0, count($service['accounts'])-1)];
		}
		return $acc;
	}

	function GetCookies($content){
		preg_match_all('/Set-Cookie: (.*);/U',$content,$temp);
		$cookie = $temp[1];
		$cookies = implode('; ',$cookie);
		return $cookies;
	}
	function lookup_job($hash){
		$this->load_jobs();
		foreach ($this->jobs as $key=>$job)
		{
			if ($job['hash'] === $hash) return $job;
		}
		return false;
	}
}
##################################### End class getinfo #######################################


##################################### Begin class stream_get ##################################
class stream_get extends getinfo {
	function stream_get(){
		$this->config();
		include("account.php");
		$this->load_jobs();
		$this->load_cookies();
		$this->cookie = '';
		if (isset($_REQUEST['file'])) $this->download();
		if (isset($_COOKIE['owner'])){
			$this->owner = $_COOKIE['owner'];
		}
		else{
			$this->owner = intval(rand()*10000);
			setcookie('owner', $this->owner, 0);	
		}
	}
	function download(){      
		error_reporting (0);
		if (! $job = $this->lookup_job($_REQUEST['file'])) {
			sleep(15);
			header("HTTP/1.1 404 Not Found");
			die(_errorget);
		}
		if (($_SERVER['REMOTE_ADDR'] !== $job['ip']) && $this->privateip==true) {
			sleep(5);
			die(_errordl);
		}

		$link = '';
		$filesize = $job['size'];
		$filename = $this->download_prefix.Tools_get::convert_name($job['filename']);
		$directlink = urldecode($job['directlink']['url']);
		$this->cookie = $job['directlink']['cookies'];
		
		if (preg_match('#^http://([a-z0-9]+\.)?wupload\.com/#', $directlink)) {
			$data = $this->curl($directlink,$this->cookie,'');
			if(preg_match('/ocation: (.*)/', $data, $match))  $link=trim($match[1]);
			else header("HTTP/1.1 404 Not Found");
		}
		else
			$link = $directlink;
		if(!$link) {
			sleep(15);
			header("HTTP/1.1 404 Not Found");
			die(_erroracc);
		}
		$range = '';
		if (isset($_SERVER['HTTP_RANGE'])) {
			$range = substr($_SERVER['HTTP_RANGE'], 6);
		}
		$port = 80;
		$schema = parse_url(trim($link));
		$host= $schema['host'];
		$scheme = "http://";
		//list($path1, $path2)  = explode($schema['path'], $link);		
		//$path = $schema['path'].$path2;
		$gach = explode("/", $link);
		list($path1, $path)  = explode($gach[2], $link);
		if(isset($schema['port'])) $port = $schema['port'];
		elseif ($schema['scheme'] == 'https') {
			$scheme = "ssl://";
			$port = 443;
		}
		if ($scheme != "ssl://") {
			$scheme = "";
		}
		$hosts = $scheme . $host . ':' . $port;
		$fp = @stream_socket_client ($hosts, $errno, $errstr, 120, STREAM_CLIENT_CONNECT );
		if (!$fp) {
			sleep(15);
			header("HTTP/1.1 404 Not Found");
			die ("HTTP/1.1 404 Not Found");
		}
	
		$data = "GET {$path} HTTP/1.1\r\n";
		$data .= "User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:5.0) Gecko/20100101 Firefox/5.0\r\n";
		$data .= "Host: {$host}\r\n";
		$data .= "Accept: */*\r\n";
		$data .= $this->cookie ? "Cookie: ".$this->cookie."\r\n" : '';
		if (!empty($range)) $data .= "Range: bytes={$range}\r\n";
		$data .= "Connection: Close\r\n\r\n";
		@stream_set_timeout($fp, 2);
		fputs($fp, $data);
		fflush($fp);
		$header = '';
		do {
			$header .= stream_get_line($fp, $this->unit);
		} 
		while (strpos($header, "\r\n\r\n" ) === false);
		// Must be fresh start
		if( headers_sent() )
		die('Headers Sent');
		// Required for some browsers
		if(ini_get('zlib.output_compression'))
		ini_set('zlib.output_compression', 'Off'); 
		header("Pragma: public"); // required 
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Cache-Control: private",false); // required for certain browsers 
		header("Content-Transfer-Encoding: binary"); 
		header("Accept-Ranges: bytes");
		if(stristr($header,"TTP/1.0 200 OK") || stristr($header,"TTP/1.1 200 OK")) {
			$filesize = trim ($this->cut_str ($header, "Content-Length:", "\n" ));
			if(stristr($header,"filename")) {
				$filename = trim ($this->cut_str ( $header, "filename", "\n" ) );
				$filename = preg_replace("/(\"\;\?\=|\"|=|\*|UTF-8|\')/","",$filename);	
			}
			$filename = $this->download_prefix.Tools_get::convert_name($filename);
			header("HTTP/1.1 200 OK");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".$filename);
			header("Content-Length: {$filesize}");
		}
		elseif(stristr($header,"TTP/1.1 206") || stristr($header,"TTP/1.0 206")) {
			sleep(1);
			$new_length = trim ($this->cut_str ($header, "Content-Length:", "\n" ));
			$new_range = trim ($this->cut_str ($header, "Content-Range:", "\n" ));
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: $new_range");
		}
		else { 
			sleep(15);
			header("HTTP/1.1 404 Not Found");
			die ("HTTP/1.1 404 Not Found");
		}
		
		$tmp = explode("\r\n\r\n", $header);
		if ($tmp[1]) {
			print $tmp[1];
		}
		while (!feof($fp) && (connection_status()==0)) {
			$recv = @stream_get_line($fp, $this->unit);
			@print $recv;
			@flush();
			@ob_flush();
		}
		fclose($fp);
		exit;
	}

    function CheckMBIP(){
		$this->countMBIP = 0;
		$this->totalMB = 0;
		$this->timebw = 0;
		$timedata =time();
		foreach ($this->jobs as $job){
			if ($job['ip'] == $_SERVER['REMOTE_ADDR']) {
				$this->countMBIP = $this->countMBIP + $job['size']/1024/1024;
				if($job['mtime'] < $timedata )  $timedata = $job['mtime'];
				$this->timebw = $this->ttl*60 + $timedata -time();
			}
			if($this->privatef==false){
				$this->totalMB = $this->totalMB + $job['size']/1024/1024;
				$this->totalMB = round($this->totalMB);
			}
			else {
				if ($job['owner'] == $this->owner) {
					$this->totalMB = $this->totalMB + $job['size']/1024/1024;
					$this->totalMB = round($this->totalMB);
				}
			}

		}
		$this->countMBIP = round($this->countMBIP);
		if ($this->countMBIP >= $this->limitMBIP) return false;
		return true;
	}
	function curl($url,$cookies,$post,$header=1){
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, $header);
		if ($cookies) curl_setopt($ch, CURLOPT_COOKIE, $cookies);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:5.0) Gecko/20100101 Firefox/5.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER,$url); 
		if ($post){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
		$page = curl_exec( $ch);
		curl_close($ch); 
		return $page;
	}
	function cut_str($str, $left, $right)  {
		$str = substr ( stristr ( $str, $left ), strlen ( $left ) );
		$leftLen = strlen ( stristr ( $str, $right ) );
		$leftLen = $leftLen ? - ($leftLen) : strlen ( $str );
		$str = substr ( $str, 0, $leftLen );
		return $str;
	}

	function GetCookies($content){
		preg_match_all('/Set-Cookie: (.*);/U',$content,$temp);
		$cookie = $temp[1];
		$cookies = implode('; ',$cookie);
		return $cookies;
	}
	function GetAllCookies($page) {
		$lines = explode("\n", $page);
		$retCookie = "";
		foreach ($lines as $val) 
		{
			preg_match('/Set-Cookie: (.*)/',$val,$temp);
			if (isset($temp[1]))
			{
				if ($cook = substr($temp[1], 0, stripos($temp[1], ';')))
						$retCookie .= $cook . ";";
			}
		}
		return $retCookie;
    }
	function mf_str_conv($str_or)
	{
		$str_or = stripslashes($str_or);
		if (!preg_match("/unescape\(\W([0-9a-f]+)\W\);\w+=([0-9]+);[^\^]+\)([0-9\^]+)?\)\);eval/", $str_or, $match)) return $str_or;
		$match[3] = $match[3] ? $match[3] : "";
		$str_re = "";
		for ($i = 0; $i < $match[2]; $i++){
			$c = HexDec(substr($match[1], $i*2, 2));
			eval ("\$c = \$c".$match[3].";");
			$str_re .= chr($c);
		}
		$str_re = str_replace($match[0], stripslashes($str_re), $str_or);
		if (preg_match("/unescape\(\W([0-9a-f]+)\W\);\w+=([0-9]+);[^\^]+\)([0-9\^]+)?\)\);eval/", $str_re, $dummy))
			$str_re = $this->mf_str_conv($str_re);
		return $str_re;
	}

	function main(){
		Tools_get::clean_ip();
		if ($this->get_load() > $this->max_load){
			echo '<center><b><i><font color=red>'._svload.'</font></i></b></center>';
			return;
		}
		if (isset($_POST['urllist'])) {
			$url = $_POST['urllist'];
			$url = str_replace("\r", "",  $url);
			$url = str_replace("\n", "",  $url);
			$url = str_replace("<", "",  $url);
			$url = str_replace(">", "",  $url);
			$url = str_replace(" ", "",  $url);
		}
		if (isset($url)&& strlen($url) > 10){
			if(substr($url,0,4)=='www.')$url = "http://".$url;
			if(!$this->check3x) $dlhtml = $this->get($url);
			else{
				################### CHECK 3X #########################
				$check3x = false;
				if(strpos($url,"|not3x")) $url = str_replace("|not3x","",$url) ;
				else{
					$data =  $this->curl("http://www.google.com/search?q=$url", "", "");
					$totalbadword = count ($this->badword);
					for($i = 0; $i < $totalbadword; $i++){
						if (stristr($data, $this->badword[$i])) {	
							$check3x = true;
							break;
						}
					}			
				}
				if($check3x == false) $dlhtml = $this->get($url);
				else {
					$dlhtml = '<B><font color=red>'._issex.' </font><a href=http://www.google.com.vn/search?q='.$url.'><font color=#00CC00>'.$url.'</font></a><br><font color=#FFCC00>'._ifnot.' </font><font color=#0066CC>'.$url.'</font><font color=#FF3300>|</font><font color=#ff9999 face=Arial>not3x</font></b><BR>';
					unset($check3x);
				}
				################### CHECK 3X #########################
			}
		}
		else $dlhtml =  "<b><a href=".$url." style='TEXT-DECORATION: none'><font color=red face=Arial size=2><s>".$url."</s></font></a> <img src=images/chk_error.png width='15' alt='errorlink'> <font color=#ffcc33><B>"._errorlink."</B></font><BR>";
		echo $dlhtml;
	}
	function get($url){
		$this->CheckMBIP();
		if (count($this->jobs) >= $this->max_jobs){
			$dlhtml = '<center><b><i><font color=red>'._manyjob.'</font></i></b></center>';
			return $dlhtml;
		}
		if ($this->countMBIP >= $this->limitMBIP){
			$dlhtml = '<center><b><i><font color=red>'._limitfile1.' '.round($this->limitMBIP/1024,2).' GB '._limitfile4.' '.$this->ttl.' '._limitfile3.' '._plwait.' <font color=green size=4>'.Tools_get::convert_time($this->timebw).'</font></font></i></b></center>';
			return $dlhtml;
		}
		if ($this->Checkjobs() >= $this->limitPERIP){
			$lasttime = time();
			$opentmp = opendir ($this->fileinfo_dir."/tmp");
			while ( $infofile = readdir ( $opentmp ) ) {
				if ($infofile == "." || $infofile == "..") {continue;}
				if (stristr($infofile,$_SERVER['REMOTE_ADDR'])) {
					$timedl = filemtime ( $this->fileinfo_dir."/tmp/$infofile" );
					if($timedl < $lasttime ) $lasttime = $timedl;
				}
			}
			closedir ($opentmp);	
			$lefttime = $this->ttl_ip*60 -time() + $lasttime;
			$lefttime = Tools_get::convert_time($lefttime);
			$dlhtml = '<center><b><i><font color=red>'._limitfile1.' '.$this->limitPERIP.' '._limitfile2.' '.Tools_get::convert_time($this->ttl*60).' '._limitfile3.' '._plwait.' <font color=green size=4>'.$lefttime.'</font></font></i></b></center>';
			return $dlhtml;
		}
		if ($this->lookup_ip($_SERVER['REMOTE_ADDR']) >= $this->max_jobs_per_ip){
			$dlhtml = '<center><b><i><font color=red>'._limitip.'</font></i></b></center>';
			return $dlhtml;
		}
		$url = trim($url);
		if (empty($url)) return;
		$Original = $url;
		$link = "";
		$user = ''; $pass = ''; $cookie = '';
		$report = false;
		include ("hosts/hosts.php");
		ksort($host);
		foreach ($host as $file => $site){
			$site = substr($site,0,-4);
			$site = str_replace("_",".",$site) ;
			if (preg_match('%'.$site.'%U', $Original)){
				include ('hosts/'.$host[$file]);
				break;
			}
		}
		
		if(!$link){
			$user = ''; $pass = ''; $cookie = '';
			if($this->debrid) include ('hosts/debrid/'.$this->plugin);
		}
		if($report) {
			return $report;
		}
		if(!$link){
			$size_name = Tools_get::size_name($Original, "");
			$filesize =  $size_name[0];
			$filename = $size_name[1];
			$this->max_size = $this->max_size_other_host;
			if($size_name[0]>1024*100) $link=$url;
			else {
				$dlhtml = "<b><a href=".$Original." style='TEXT-DECORATION: none'><font color=red face=Arial size=2>".$Original."</font></a>  <font color=#ffcc33 face=Arial size=2>"._notsupport."</font></b><BR>";
				return $dlhtml;
			}
		}
		$hosting = Tools_get::site_hash($Original);

		if(!isset($filesize)) {
			$dlhtml = "<b><a id='notsupport' href=".$Original." style='TEXT-DECORATION: none'><font color=#ffcc33 face=Arial size=2>".$Original."</font></a></b> ".str_replace("hosting",$hosting,_notdl)."<BR>";
			return $dlhtml;
		}
		if(!isset($this->max_size)) $this->max_size = $this->max_size_other_host;
		if($filesize >=(1024*1024*1024)) $msize = round($filesize/(1024*1024*1024), 2)." GB";
		elseif ($filesize >=(1024*1024)) $msize = round($filesize/(1024*1024), 2)." MB";
		elseif ($filesize >=1024) $msize = round($filesize/(1024), 2)." KB";
		else $msize = $filesize." B";
		$filename =Tools_get::convert_name($filename);
		$filename = str_replace($this->banned, '.xxx', $filename);

		$hash = md5($_SERVER['REMOTE_ADDR'].$Original);
		if ($hash === false) {
			$dlhtml = ('<center><b><i><font color=red>'._cantjob.'</font></i></b></center>');
			return $dlhtml;
		}
		if ($filesize > $this->max_size*1024*1024) {
			$dlhtml = '<center><b><font color=#00CC00>'.$Original.'</font> <font color=red>'.round($filesize/(1024*1024),2).' MB '._filebig.' </font><font color=#3399FF>'._allowed.'</font> <font color=#FFCC00>'.$this->max_size.' MB</font></b></center>';
			return $dlhtml;
		}
		if (($this->countMBIP+$filesize/(1024*1024)) >= $this->limitMBIP){
			$dlhtml = '<center><b><i><font color=red>'._limitfile1.' '.round($this->limitMBIP/1024,2).' GB '._limitfile4.' '.Tools_get::convert_time($this->ttl*60).' '._limitfile3.' '._plwait.' <font color=green size=4>'.Tools_get::convert_time($this->timebw).'</font></font></i></b></center>';
			return $dlhtml;
		}
		if ($this->Checkjobs() >= $this->limitPERIP){
			$lasttime = time();
			$opentmp = opendir ( $this->fileinfo_dir."/tmp");
			while ( $infofile = readdir ( $opentmp ) ) {
				if ($infofile == "." || $infofile == "..") {continue;}
				if (stristr($infofile,$_SERVER['REMOTE_ADDR'])) {
					$timedl = filemtime ( $this->fileinfo_dir."/tmp/$infofile" );
					if($timedl < $lasttime ) $lasttime = $timedl;
				}
			}
			closedir ($opentmp);	
			$lefttime = $this->ttl_ip*60 -time() + $lasttime;
			$lefttime = Tools_get::convert_time($lefttime);
			$dlhtml = '<center><b><i><font color=red>'._limitfile1.' '.$this->limitPERIP.' '._limitfile2.' '.Tools_get::convert_time($this->ttl*60).' '._limitfile3.' '._plwait.' <font color=green size=4>'.$lefttime.'</font></font></i></b></center>';
			return $dlhtml;
		}
		$job = array(
			'hash'		=> substr(md5($hash), 0, 10),
           		'path'		=> substr(md5(rand()), 0, 5),
			'filename'	=> urlencode($filename),
			'size'		=> $filesize,
			'msize'		=> $msize,
			'mtime'		=> time(),
			'speed'		=> 0,
			'url'		=> urlencode($Original),
			'owner'		=> $this->owner,
			'ip'		=> $_SERVER['REMOTE_ADDR'],
			'type'		=> 'direct',
			'directlink'	=> array(
			'url'		=> urlencode($link),
			'cookies'	=> $this->cookie,
				),
		);
		$this->jobs[$hash] = $job;
		$this->save_jobs();
		$tiam = time().rand(0,999);
		mkdir ( $this->fileinfo_dir."/tmp/$_SERVER[REMOTE_ADDR].$tiam", 0777 )   
		or die('<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder "<B>tmp</B>" to 777</font></CENTER>');
		
		$gach = explode('/', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		$sv_name = "";
		for ($i=0;$i <count($gach)-1; $i++) $sv_name .= $gach[$i]."/";
		$filename = preg_replace("/( |[|])/","_",$filename);
		if($this->linkdirect==false){
			if($this->iddowntype==true){
			$downloadstyle = 'http://'.$sv_name.'?file='.$job['hash'];
			}else{
			$downloadstyle = 'http://'.$sv_name.$hosting.'/'.$job['hash'].'/'.urlencode($filename);
			}
			}else{
			$downloadstyle = $link;
		}
		if(empty($this->shortlink)==false){
			if($this->multiapi==true){
				$one = file_get_contents($this->api1.$downloadstyle);
				$two = file_get_contents($this->api2.$one);
				$three = file_get_contents($this->api3.$two);
				$lik = file_get_contents($this->api4.$three);
			}elseif ($this->multiapi==false){
				$lik = file_get_contents($this->api1.$downloadstyle);
			}
		}else{
		$lik = $downloadstyle;
		}
		echo " <br>"; 
        echo "<input name='1' type='text' size='100' value='[center][b][URL=".$lik."]".$this->title." | [color=".$this->colorfn."]".$filename."[/color][color=".$this->colorfs. "] ($msize) [/color][/url][/b][/center]' onClick='1.select();' onfocus='this.select()'>";
        echo " <br>"; 
		$dlhtml =  "<b><a title='click here to download' href='$lik' style='TEXT-DECORATION: none' target='$tiam'> <font color='#00CC00'>".$filename."</font> <font color='#FF66FF'> ($msize) </font></a></b>";
		return $dlhtml;
	}
	function datecmp($a, $b){
		return ($a[1] < $b[1]) ? 1 : 0;
	}
	function fulllist() {
		$act="";
		if($this->act['delete']==true) { $act.='<option value="del">'._del.'</option>'; }
		if($this->act['rename']==true)  { $act.='<option value="ren">'._rname.'</option>';}
		if ($act != ""){
			if ((isset($_POST['checkbox'][0]) && $_POST['checkbox'][0] != null) || isset($_POST['renn']) || isset($_POST['remove'])){ 
				echo '<table style="width: 500px; border-collapse: collapse" border="1" align="center"><tr><td><center>';
				switch ($_POST['option']){
					case 'del': $this->deljob(); break;
					case 'ren': $this->renamejob(); break;
				}
				if (isset($_POST['renn'])) $this->renamejob();
				if (isset($_POST['remove'])) $this->deljob();
				echo "</center></td></tr></table><br>";
			}
		}
		else echo '</select>';
		$files = array();
		foreach ($this->jobs as $job) {
			if ($job['owner']!=$this->owner  && $this->privatef==true) continue;
			$files[] = array(urldecode($job['url']), $job['mtime'], $job['hash'], urldecode($job['filename']),$job['size'],$job['ip'],$job['msize']);
		}	
		if (count($files)==0) { echo "<Center>"._notfile."<br><a href='$this->self'> ["._main."] </a></center>"; return;}
		echo "<script type=\"text/javascript\">function setCheckboxes(act){elts = document.getElementsByName(\"checkbox[]\");var elts_cnt  = (typeof(elts.length) != 'undefined') ? elts.length : 0;if (elts_cnt){ for (var i = 0; i < elts_cnt; i++){elts[i].checked = (act == 1 || act == 0) ? act : (elts[i].checked ? 0 : 1);} }}</script>";
		echo "<center><a href=javascript:setCheckboxes(1)> Check All </a> | <a href=javascript:setCheckboxes(0)> Un-Check All </a> | <a href=javascript:setCheckboxes(2)> Invert Selection </a></center><br>";	
		echo "<center><form action='$this->self' method='post' name='flist'><select onchange='javascript:void(document.flist.submit());'name='option'>";

		if ($act == "") echo "<option value=\"dis\"> "._acdis." </option>"; else echo '<option selected="selected">'._ac.'</option>'.$act;
		echo '</select>';

		echo '<div style="overflow: auto; height: auto; max-height: 450px; width: 800px;"><table id="table_filelist" class="filelist" align="left" cellpadding="3" cellspacing="1" width="100%"><thead><tr class="flisttblhdr" valign="bottom"><td id="file_list_checkbox_title" class="sorttable_checkbox">&nbsp;</td><td class="sorttable_alpha"><b>'._name.'</b></td><td><b>'._Original.'</b></td><td><b>'._Size.'</b></td><td><b>'._Date.'</b></td></tr></thead><tbody>';

		usort($files, array($this, 'datecmp'));
		$data = "";
		foreach ($files as $file){
			$timeago = Tools_get::convert_time(time() - $file[1]). " "._ago;
			if (strlen($file[3]) > 80) $file[3]= substr($file[3],0,70);
			$hosting = substr(Tools_get::site_hash($file[0]),0,15);
			$data .= "<tr class='flistmouseoff' align='center'><td><input name='checkbox[]' value='$file[2]+++$file[3]' type='checkbox'></td><td><a href='".Tools_get::site_hash($file[0])."/$file[2]/$file[3]' style='font-weight: bold; color: rgb(0, 0, 0);'>$file[3]</a></td><td><a href='$file[0]' style='color: rgb(0, 0, 0);'>".Tools_get::site_hash($file[0])."</a></td><td title='$file[5]'>".$file[6]."</td><td><a href=http://www.google.com/search?q=$file[0] title='"._kickcheck."' target='$file[1]'><font color=#000000>$timeago</font></a></center></td></tr>";

		}
		$this->CheckMBIP();
		echo $data;
		$totalall = $this->totalMB;
		if($totalall >= 1024) $totalall = round($totalall/1024, 1)." GB";
		else $totalall = $totalall." MB";
		$MB1IP = $this->countMBIP;
		if($MB1IP >= 1024) $MB1IP = round($MB1IP/1024, 1)."GB";
		else $MB1IP = $MB1IP."MB";
		$thislimitMBIP =	round($this->limitMBIP/1024,0);
		$timereset = Tools_get::convert_time($this->ttl*60);
		
		echo "</tbody><tbody><tr class='flisttblftr'><td>&nbsp;</td><td>"._Total.":</td><td></td><td>$totalall</td><td>&nbsp;</td></tr></tbody></table>
		</div></form><center><b>"._Total1." $MB1IP/$thislimitMBIP GB - "._Total2." $timereset</b>.</center><br>";

		//echo "<center><br><a href='$this->self'> [Back to main] </a> &nbsp;&nbsp;&nbsp; <a href='#'> [Back to top]</a></center>";
	}
	function deljob(){	
		if($this->act['delete']==false) return;
		if (isset($_POST['checkbox'])){
			echo "<form action='$this->self' method='post'>";
			for ($i=0; $i < count($_POST['checkbox']); $i++){
				$temp = explode("+++",$_POST['checkbox'][$i]);
				$ftd = $temp[0];
				$name = $temp[1];
				echo "<br><b> $name </b>";
				echo '<input type="hidden" name="ftd[]" value="'.$ftd.'" />';
				echo '<input type="hidden" name="name[]" value="'.$name.'" />';
			}
			echo "<br><br><input type='submit' value='"._del."' name='remove'/> &nbsp; <input type='submit' value='"._canl."' name='Cancel'/><BR><BR>";
		}
		if (isset($_POST['remove'])){	
			echo "<BR>";
			for ($i=0; $i < count($_POST['ftd']); $i++){
				$ftd = $_POST['ftd'][$i];
				$name = $_POST['name'][$i];
				$key = "";
				foreach ($this->jobs as $url=>$job){
					if ($job['hash'] == $ftd){
						$key = $url;
						break;
					}
				}
				if($key){
					unset($this->jobs[$key]);
					echo "<center>File: <b>$name</b> "._deld;
				}
				else echo "<center>File: <b>$name</b> "._notF; 
				echo "</center>";
			}
			echo "<BR>";
			$this->save_jobs();
		}
		if (isset($_POST['Cancel'])){	
			$this->fulllist();
		}
	}

	function renamejob(){	
		if($this->act['rename']==false) return;
		if (isset($_POST['checkbox'])){
			echo "<form action='$this->self' method='post'>";
			for ($i=0; $i < count($_POST['checkbox']); $i++) {
				$temp = explode("+++",$_POST['checkbox'][$i]);
				$name = $temp[1];
				echo "<br><b> $name </b>";
				echo '<input type="hidden" name="hash[]" value="'.$temp[0].'" />';
				echo '<input type="hidden" name="name[]" value="'.$name.'" />';
				echo '<br>'._nname.': <input type="text" name="nname[]" value="'.$name.'"/ size="70"><br>';
			}
			echo "<br><input type='submit' value='"._rname."' name='renn'/> &nbsp; <input type='submit' value='"._canl."' name='Cancel'/><BR><BR>";
		}
		if (isset($_POST['renn'])){
			for ($i=0; $i < count($_POST['name']); $i++) {
				$orname = $_POST['name'][$i];
				$hash = $_POST['hash'][$i];
				$nname = $_POST['nname'][$i];
				$nname =Tools_get::convert_name($nname);
				$nname = str_replace($this->banned,'',$nname);
				if ($nname == "") { echo "<BR>"._bname."<BR><BR>"; return; }
				else {
					echo "<br>";
					$key = "";
					foreach ($this->jobs as $url=>$job){
						if ($job['hash'] == $hash){	
							$key = $url;
							//$hash = $this->create_hash($key,$nname);
							$jobn = array(
								'hash'	=> $job['hash'],
								'path'	=> $job['path'],
								'filename'	=> urlencode($nname),
								'size'	=> $job['size'],
								'msize'	=> $job['msize'],
								'mtime'	=> $job['mtime'],
								'speed'	=> 0,
								'url'	=> $job['url'],
								'owner'	=> $job['owner'],
								'ip'	=> $job['ip'],
								'type'	=> 'direct',
								'directlink'	=> array(
									'url'	=> $job['directlink']['url'],
									'cookies'=> $job['directlink']['cookies'],
								),
							); 
						}	
					}
					if($key){
						$this->jobs[$key] = $jobn;
						$this->save_jobs();
						echo "File <b>$orname</b> "._rnameto." <b>$nname</b>";
					}
					else echo "File <b>$orname</b> "._notF;
					echo "<br><br>";
				}
			}
		}
		if (isset($_POST['Cancel'])){	
			$this->fulllist();
		}
	}

}
##################################### End class stream_get ###################################


##################################### Begin class Tools_get ###################################
class Tools_get extends getinfo {
	function clean_ip() {
		$xhandle = opendir ($this->fileinfo_dir."/tmp");
		while ($buin = readdir ($xhandle)) {
			if ($buin == "." || $buin == "..") {
					continue;
			}
			if(file_exists($this->fileinfo_dir."/tmp/$buin")){
				$xd = filemtime ($this->fileinfo_dir."/tmp/$buin" );
				$altr = time() - $this->ttl_ip*60;
				if ($xd < $altr )  {
					if (is_dir ($this->fileinfo_dir."/tmp/$buin" )){
						rmdir ($this->fileinfo_dir."/tmp/$buin" );
					} else {
						unlink ($this->fileinfo_dir."/tmp/$buin" );
					}
				}	
			}
		}
		closedir ( $xhandle );		
	}
	function useronline() {
		$useronline = 0;
		if(!file_exists($this->fileinfo_dir."/online/".$_SERVER['REMOTE_ADDR'])) 	mkdir ($this->fileinfo_dir."/online/".$_SERVER['REMOTE_ADDR'], 0777 ) or die('<CENTER><font color=red size=4>Could not create folder! Try to chmod the folder "<B>online</B>" to 777</font></CENTER>');
		$openfolder = opendir ($this->fileinfo_dir."/online");
		while ($folder = readdir ($openfolder)) {
			if ($folder == "." || $folder == "..") continue;
			if(file_exists($this->fileinfo_dir."/online/$folder")){
				$filemtime = filemtime ($this->fileinfo_dir."/online/$folder" );
				$timedel = $filemtime + 30;
				if (time() > $timedel )  {
					if (is_dir ($this->fileinfo_dir."/online/$folder" )){
						rmdir ($this->fileinfo_dir."/online/$folder" );
					} else {
						unlink ($this->fileinfo_dir."/online/$folder" );
					}
				}
				else $useronline++;
			}
		}
		closedir ( $openfolder );
		return $useronline;
	}
	function size_name($link,$cookie){
		if(!$link || !stristr($link,'http')) return;
		$port = 80;
		$schema = parse_url(trim($link));
		$host= $schema['host'];
		$scheme = "http://";
		if(empty($schema['path']))  return;
		$gach = explode("/", $link);
		list($path1, $path)  = explode($gach[2], $link);
		if(isset($schema['port'])) $port = $schema['port'];
		elseif ($schema['scheme'] == 'https') {
			$scheme = "ssl://";
			$port = 443;
		}
		if ($scheme != "ssl://") {
			$scheme = "";
		}
		$data = "GET {$path} HTTP/1.1\r\n";
		$data .= "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:10.0) Gecko/20100101 Firefox/10.0\r\n";
		$data .= "Host: {$host}\r\n";
		$data .= $cookie ? "Cookie: $cookie\r\n" : '';
		$data .= "Connection: Close\r\n\r\n";
		$errno = 0;
		$errstr = "";

		$hosts = $scheme . $host . ':' . $port;
		$fp = @stream_socket_client ($hosts, $errno, $errstr, 120, STREAM_CLIENT_CONNECT );
		if (! $fp) return -1;

		fputs ( $fp, $data );
		fflush ( $fp );
		$header = "";
		do {
			$header .= fgets ( $fp, 8192 );
		} while ( strpos ( $header, "\r\n\r\n" ) === false );

		##################################
		/*
		while (!feof($fp) && (connection_status()==0)) {
			$recv = @stream_get_line($fp, 8192);
			@print $recv;
			//usleep(10000);
			@flush();
			@ob_flush();
		}
		echo $header;
		*/
		##########################
		if(stristr($header,"TTP/1.0 200 OK") || stristr($header,"TTP/1.1 200 OK") || stristr($header,"TTP/1.1 206")) 
			$filesize = trim ($this->cut_str ( $header, "Content-Length:", "\n" ) );
		else $filesize = -1;
		$filename = "";
		if(stristr($header,"filename")) {
			$filename = trim ($this->cut_str ( $header, "filename", "\n" ) );
			//$filename=str_replace("\"","",$filename);
			$filename = preg_replace("/(\"\;\?\=|\"|=|\*|UTF-8|\')/","",$filename);
		}
		else $filename = substr(strrchr($link, '/'), 1);
		return array($filesize,$filename);
	}

	function site_hash($url){
		     if(strpos($url,"rapidshare.com"))		$site = "RS"; //rename_prefix
		else if(strpos($url,"megaupload.com"))		$site = "MU";
		else if(strpos($url,"filefactory.com"))		$site = "FF";
		else if(strpos($url,"fileserve.com"))		$site = "FS";
		else if(strpos($url,"hotfile.com"))		$site = "HF";	
		else if(strpos($url,"megavideo.com"))		$site = "MV";
		else if(strpos($url,"netload.in"))		$site = "NL";
		else if(strpos($url,"filesonic.com"))		$site = "FSN";
		else if(strpos($url,"depositfiles.com"))	$site = "DF";
		else if(strpos($url,"uploading.com"))		$site = "ULD";
		else if(strpos($url,"easy-share.com"))		$site = "E-S";
		else if(strpos($url,"filesonic"))		$site = "FSN";
		else if(strpos($url,"mediafire.com"))		$site = "MF";
		else if(strpos($url,"rapidgator.net"))		$site = "rapidgator";
		else if(strpos($url,"ryushare.com"))		$site = "ryushare";
		else if(strpos($url,"up.4share.vn"))		$site = "4share.vn";
		else {
			$schema = parse_url($url);
			$site = preg_replace("/(www.|.com|.net|.biz|.info|.org|.us|.vn|.jp|.fr|.in|.to)/","",$schema['host']);
		}
		return $site;
	}

	function convert($filesize){
		$filesize = str_replace(",",".",$filesize);
		if(preg_match('/^([0-9]{1,4}+(\.[0-9]{1,2})?)/', $filesize,$value)){
			if(stristr($filesize,"TB"))		$value = $value[1]*1024*1024*1024*1024;
			elseif(stristr($filesize,"GB")) $value = $value[1]*1024*1024*1024;
			elseif(stristr($filesize,"MB")) $value = $value[1]*1024*1024;
			elseif(stristr($filesize,"KB")) $value = $value[1]*1024;
			else $value = $value[1];
		}
		else $value = 0;
		return $value;
	}

	function uft8html2utf8( $s ) {
		if ( !function_exists('uft8html2utf8_callback') ) {
			 function uft8html2utf8_callback($t) {
					 $dec = $t[1];
			if ($dec < 128) {
			  $utf = chr($dec);
			} else if ($dec < 2048) {
			  $utf = chr(192 + (($dec - ($dec % 64)) / 64));
			  $utf .= chr(128 + ($dec % 64));
			} else {
			  $utf = chr(224 + (($dec - ($dec % 4096)) / 4096));
			  $utf .= chr(128 + ((($dec % 4096) - ($dec % 64)) / 64));
			  $utf .= chr(128 + ($dec % 64));
			}
			return $utf;
			 }
		}                               
		return preg_replace_callback('|&#([0-9]{1,});|', 'uft8html2utf8_callback', $s );                                
	}

	function convert_name($filename){
		$filename =urldecode($filename);
		$filename =Tools_get::uft8html2utf8($filename);
		$filename=str_replace(".html","",$filename) ;
		$filename=str_replace(".htm","",$filename) ;
		$filename=str_replace("www","",$filename);
		$filename=str_replace("WWW","",$filename);
		$filename=str_replace("http","",$filename);
		$filename=str_replace("HTTP","",$filename);
		$filename=str_replace("'","_",$filename);
		$filename=str_replace("@","_",$filename);
		$filename=str_replace("[","_",$filename);
		$filename=str_replace("]","_",$filename);
		if (empty($filename)==true) $hash =  substr(md5(time().$url), 0, 10);
		return $filename;
	}

	function convert_time($time){
		if($time >= 86400) $time = round($time/(60*24*60), 1)." "._days;
		elseif(86400 > $time && $time >= 3600) $time = round($time/(60*60), 1)." "._hours;
		elseif(3600 > $time && $time >= 60) $time = round($time/60, 1)." "._mins;
		else $time = $time." "._sec;

		return $time;
	}
	function report($url,$reason){
		if($reason == "dead"){
			$report ='<b><a href='.$url.' style="TEXT-DECORATION: none"><font color=red face=Arial size=2><s>'.$url.'</s></font></a> <img src=images/chk_error.png width="15" alt="errorlink"> <font color=#ffcc33 face=Arial size=2>'._dead.'</font></b><BR>';
			return $report;
		}
		elseif($reason == "filebig"){
			$report = '<center><b><font color=#00CC00>'.$url.'</font> <font color=red> '._filebig.' </font><font color=#3399FF>'._allowed.'</font> <font color=#FFCC00>200 MB</font></b></center>';
			return $report;
		}
		elseif($reason == "erroracc"){
			$report = '<center><B><a href='.$link.' style="TEXT-DECORATION: none"><font color=#00FF00 face=Arial size=2>'.$link.'</font></a> <img src=images/chk_good.png width="13" alt="g&#1086;&#1086;d_l&#1110;nk"> | <font color=#ffcc33 face=Arial size=2>'.$matches[1].'</font><font color=red face=Arial size=2> '._notwork.'</font></B></center>';

			return $report;
		}
		elseif($reason == "svload"){
			$report = '<b><a href='.$url.' style="TEXT-DECORATION: none" title="please try again"><font color=#969696 face=Arial size=2>'.$url.'</font></a> <img src=images/chk_error.png width="15" alt="errorlink"></b> <font color=#ffcc33 face=Arial >'._again.'</font>';
			return $report;
		}
		elseif($reason == "captchafsn"){
			$report ='
			<h1>Attention!</h1>
			<p><font color=red>We have detected some suspicious behaviour coming from your IP address (<B>'.$_SERVER['REMOTE_ADDR'].'</B>) and have been temporarily blocked. </font></p> 
			<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
			<div id="captchaVerification" class="section CL3">
				<h3><span>Please Enter Captcha: </span></h3>
				<form action="http://www.filesonic.com/report.php" method="post" id="captchaForm">
				<img src="http://www.google.com/recaptcha/api/image?c='.$url.'"><BR>
				<input type="text" name="recaptcha_response_field" value=""/ size="44" maxlength="50">
				<input type="hidden" name="recaptcha_challenge_field" value="'.$url.'" />
				<input type="submit" value="submit"/></form>
			</div>';
			return $report;
		}	
		elseif($reason == "passmu"){
			$report = "<center>"._reportpass."<form action='index.php' method='post'><BR>
				<input type='text' id='password' name='password' width='500px'/><BR>
				<input type='hidden' name='urllist' value='".$url."'/>
				<input type=submit value='"._sbdown."' /></form><BR>
				</form></center>
			";
			return $report;
		}	
		elseif($reason == "captchawu"){
			$report ='
			<h1>Attention!</h1>
			<p><font color=red>We have detected some suspicious behaviour coming from your IP address (<B>'.$_SERVER['REMOTE_ADDR'].'</B>) and have been temporarily blocked. </font></p> 
			<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
			<div id="captchaVerification" class="section CL3">
				<h3><span>Please Enter Captcha: </span></h3>
				<form action="http://www.wupload.com/report.php" method="post" id="captchaForm">
				<img src="http://www.google.com/recaptcha/api/image?c='.$url.'"><BR>
				<input type="text" name="recaptcha_response_field" value=""/ size="44" maxlength="50">
				<input type="hidden" name="recaptcha_challenge_field" value="'.$url.'" />
				<input type="submit" value="submit"/></form>
			</div>';
			return $report;
		}
		elseif($reason == "Unavailable") $reason = _Unavailable;
		elseif($reason == "disabletrial") $reason = _disabletrial;
		elseif($reason == "Adult") $reason = _Adult;
		elseif($reason == "youtube_captcha") $reason = _ytb_captcha;
		elseif($reason == "ErrorLocating") $reason = _ytb_Error;
		$report ='<b><a href='.$url.' style="TEXT-DECORATION: none"><font color=red face=Arial size=2>'.$url.'</font></a> <img src=images/chk_error.png width="15" alt="errorlink"> <font color=#ffcc33 face=Arial size=2>'.$reason.'</font></b><BR>';
		return $report;
	}
}
##################################### End class Tools_get #####################################

?>