<?php

$Secure = true;
$SecureID = array(		#Write a password 
"betheleaf",
);

$homepage = "";
$fileinfo_dir = "data";
$fileinfo_ext = "dat";
$filecookie = "cookie.php";

$multiapi = flase;
$shortlink = false;

$api1 = "http://mini-url.nl/gen.php?url=";			#put your api of shortener
$api2 = "http://mini-url.nl/gen.php?url=";			#put your api of shortener
$api3 = "http://mini-url.nl/gen.php?url=";			#put your api of shortener
$api4 = "http://mini-url.nl/gen.php?url=";			#put your api of shortener

$iddowntype = true;		# you can change download link types
$linkdirect = false;	# you can change

$download_prefix = "";
$limitMBIP = 200*1024;		# limit load file for 1 IP (MB)
$ttl = 60*6;			# time to live (in minutes)
$limitPERIP = 100;		# limit file per mins, chmod 777 to folder tmp (files)
$ttl_ip = 50;			# limit load file per time (in minutes)
$max_jobs_per_ip = 100000;	# total jobs for 1 IP  per time live
$max_jobs = 1000000;		# max total jobs in this host   
$max_load = 50;			# max server load (%)
$title = "[color=green]Enjoy Downloading[/color]";
$colorfilename = "red";
$colorfilesize = "blue";

$listfile = true;		# enable/disable all user can see list files.
$privatefile = false;		# enable/disable other people can see your file in the list files
$privateip = false;		# enable/disable other people can download your file.
$checkacc = true;		# enable/disable all user can use check account.
$checklinksex = true;		# enable/disable check link 3x,porn...

$action = array(		# action with file in server files, set to true to enable, set to false to disable
'rename' => true,
'delete' => true,
);

$debrid = true;	#enable/disable get link with debrid plugin
//$plugin = 'alldebrid_com.php';
//$plugin = 'linksnappy_com.php';
//$plugin = 'real-debrid_com.php';
//$plugin = 'conexaomega_com.php';
//$plugin = 'multi-debrid_com.php';
//$plugin = 'downmasters_com.php';		# Working with cookie
//$plugin = 'premiumize_me.php';
//$plugin = 'rehost_to.php';
$plugin = 'simply-debrid_com.php';		# Working with cookie
//$plugin = 'superlinksbr_com.php';
//$plugin = 'rpnet_biz.php';

# List of Bad Words, you can add more
$badword = array("porn","jav ","Uncensored","xxx japan","tora.tora","tora-tora","SkyAngle","Sky_Angel","Sky.Angel","Incest","fuck","Virgin","PLAYBOY","Adult","tokyo hot","Gangbang","BDSM","Hentai","lauxanh","homosexual","bitch" ,"Torture","Nurse","phim 18+"," Hentai","Sex Videos","Adult","Adult XXX","XXX movies","Free Sex","hardcortrue","rape","jav4u","javbox","jav4you","akiba-online.com","JAVbest.OreRG","X-JAV","cnnwe.com","J4v.Us","J4v.Us","teendaythi.com","entnt.com","khikhicuoi.us","sex-scandal.us","hotavxxx.com");

require_once ('languages.php');
?>