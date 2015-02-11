		<?php date_default_timezone_set('Etc/GMT+5');		?>
		<!--
			TO EDIT TIME TO HOST NORMAL TIME REMOVE the date_default_timezone_set('Etc/GMT-8')
			-->
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">
		<head>
			<link rel="SHORTCUT ICON" href="images/vngicon.png" type="image/x-icon" />
			<title><?php printf($obj->lang['title'],$obj->lang['version']); ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="keywords" content="<?php printf($obj->lang['version']); ?>, download, get, vinaget, file, generator, premium, link, sharing, bitshare.com, crocko.com, depositfiles.com, extabit.com, filefactory.com, filepost.com, filesmonster.com, freakshare.com, gigasize.com, hotfile.com, jumbofiles.com, letitbit.net, mediafire.com, megashares.com, netload.in, oron.com, rapidgator.net, rapidshare.com, ryushare.com, sendspace.com, share-online.biz, shareflare.net, uploaded.to, uploading.com" />
			<link title="Rapidleech Style" href="<?php echo $skin;?>/images/style.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
			<script type="text/javascript" language="javascript" src="images/jquery-1.7.1.min.js"></script>
			<script type="text/javascript" src="images/ZeroClipboard.js"></script>
			<script type="text/javascript" src="images/sprintf.js"></script>
			<script type="text/javascript" language="javascript">
				var loadimg = "loading_black.gif";
				var loadcolor = "#FFFF99";
				var title = '<?php echo $obj->title; ?>';
				var colorname = '<?php echo $obj->colorfn; ?>';
				var colorfile = '<?php echo $obj->colorfs; ?>';
				var lang = new Array();
				<?php 
				foreach($obj->lang as $key=>$val){
					$val = str_replace("'", "\'", $val);
					echo "lang['{$key}'] = '{$val}'; ";
				}
				?>
			</script> 
			<!--
			<center><img src="images/logo.png" alt="RapidLeech PlugMod" border="0" /></center><br />
			-->
			<div id="showlistlink" class="showlistlink" align="center">
				<div style="border:1px BLACK solid; width:960px; padding:5px; margin-top:50px;">
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
								
								
								<tr><td height="100%" style="padding:3px;">
									<script id="sid0010000072320349474">(function() {function async_load(){s.id="cid0010000072320349474";s.src='http://st.chatango.com/js/gz/emb.js';s.style.cssText="width:180px;height:450px;";s.async=true;s.text='{"handle":"referencemeg","styles":{"b":100,"v":0,"w":0}}';var ss = document.getElementsByTagName('script');for (var i=0, l=ss.length; i < l; i++){if (ss[i].id=='sid0010000072320349474'){ss[i].id +='_';ss[i].parentNode.insertBefore(s, ss[i]);break;}}}var s=document.createElement('script');if (s.async==undefined){if (window.addEventListener) {addEventListener('load',async_load,false);}else if (window.attachEvent) {attachEvent('onload',async_load);}}else {async_load();}})();</script>
									</div><br />
									<br>
									<div class="cell-plugin"><?php printf($obj->lang['premium']); ?></div>
									<table border="0">
										<tr><td height="100%" style="padding:3px;">
											<div dir="rtl" align="left" style="padding-left:5px;">
												<?php showPlugin(); ?>
											</div>
										</td></tr>
									</table><br />
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
							<td class="cell-nav"><a class="ServerFiles" href="./"><?php printf($obj->lang['main']); ?></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=donate"><?php printf($obj->lang['donate']); ?></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=listfile"><?php printf($obj->lang['listfile']); ?></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=check"><?php printf($obj->lang['check']); ?></a></td>
							<?php if ($obj->Secure || $obj->isadmin()) 
							echo '<td class="cell-nav"><a class="ServerFiles" href="./?id=admin"> '.$obj->lang['admin'].'</a></td>'; ?>
							<?php if ($obj->Secure) 
							echo '<td class="cell-nav"><a class="ServerFiles" href="./login.php?go=logout"> '.$obj->lang['log'].'</a></td>'; ?>
						</tr>
						<table class='table1' border='0' cellPadding='0' cellSpacing='0'>			<br>	<tr><td class="td11"><?php printf($obj->lang['version']); ?></td></tr>
					<tr><td>
						<table width="500" align="center">
							<tbody><tr><td align="center">
						<tr><td height="5px"></td></tr>
						<tr><td width="25px"></td></tr>
						<tr><td align="center">
						<?php 
						#---------------------------- begin list file ----------------------------#
						if ((isset($_GET['id']) && $_GET['id']=='listfile') || isset($_POST['listfile']) || isset($_POST['option']) || isset($_POST['renn']) || isset($_POST['remove']))  {
							if($obj->listfile || $obj->isadmin())$obj->fulllist();
							else echo "<BR><BR><font color=red size=2>".$obj->lang['notaccess']."</b></font>";
						}
						#---------------------------- end list file ----------------------------#

						#---------------------------- begin donate  ----------------------------#
						else if (isset($_GET['id']) && $_GET['id']=='donate') { 
?>
							<div align="center">
								<BR><div id="wait"><font color="#FF3300"><?php printf($obj->lang['donations1']); ?><br/><?php printf($obj->lang['donations2']); ?></font></div>
								<BR><form action="javascript:donate(document.getElementById('donateform'));" name="donateform" id="donateform">
									<table>
										<tr>
											<td>
												<?php printf($obj->lang['acctype']); ?> 
												<select name='type' id='type'>
												<?php
												foreach($host as $key => $val) {
													if(!$val['alias']){
														require_once ('hosts/' . $val['file']);
														if(method_exists($val['class'], "CheckAcc")) echo "<option value='{$key}'>{$key}</option>";
													}
												}
												?>
												</select>
											</td>
											<td>
												&nbsp; &nbsp; &nbsp; <input type="text" name="accounts" id="accounts" value="" size="50"><br />
											</td>
											<td>&nbsp; &nbsp; &nbsp; <input type=submit value="<?php printf($obj->lang['sbdonate']); ?>">
											</td>
										</tr>
									</table>
								</form>
								<div id="check"><font color=#FF6600>user:pass</font> or <font color=#FF6600>cookie</font></div><BR><BR>
							</div>
<?php					
						}
						#---------------------------- end donate  ----------------------------#

						#---------------------------- begin check  ---------------------------#
						else if (isset($_GET['id']) && $_GET['id']=='check'){
							if($obj->checkacc || $obj->isadmin()) include("checkaccount.php");
							else echo "<BR><BR><font color=red size=2>".$obj->lang['notaccess']."</b></font>";
						}
						#---------------------------- end check  ------------------------------#
						
						#---------------------------- begin admin  ---------------------------#
						else if (isset($_GET['id']) && $_GET['id']=='admin'){
							if($obj->isadmin()) include("admin.php");
							else echo "<BR><BR><font color=red size=2>".$obj->lang['notaccess']."</b></font>";
						}
						#---------------------------- end admin  ------------------------------#
						
						#---------------------------- begin get  ------------------------------#
						else {
?>
							<form action="javascript:get(document.getElementById('linkform'));" name="linkform" id="linkform">
								<font color="#FF3300"><b><font color="#FFFF66"><?php printf($obj->lang['homepage']);?></font> - <?php printf($obj->lang['welcome']);?></b></font>
								<?php if($obj->isadmin()){
									$obj->last_version = $obj->getversion();
									if($obj->last_version > $obj->current_version)
										echo '<br><font color="#dbac58"><b>'.sprintf($obj->lang['update1']).'</b> - <a href="http://www.rapidleech.com/index.php/topic/14663-dev-vinaget-v270-beta/">'.sprintf($obj->lang['update2'],$obj->last_version).'</a></font>'; 
								}
								?>
								<br><font face=Arial size=1><span style="font-familty: Arial; color: #FFFFFF; font-size: 10px">Example: http://www.megaupload.com/?d=ABCDEXYZ<font size="3">|</font>password</span></font><BR>
								<textarea id='links' style='width:550px;height:100px;' name='links'></textarea><BR>
								<input type="submit"  id ='submit' value='<?php printf($obj->lang['sbdown']); ?>'/>&nbsp;&nbsp;&nbsp;
								<input type="button" onclick="reseturl();return false;" value="Reset">&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="autoreset" id="autoreset" checked>&nbsp;Auto reset&nbsp;&nbsp;&nbsp;
							</form><BR><BR>
							<div id="dlhere" align="left" style="display: none;">
								<BR><hr /><small style="color:#55bbff"><?php printf($obj->lang['dlhere']); ?></small>
								<div align="right"><a onclick="return bbcode('bbcode');" href="javascript:void(0)" style='TEXT-DECORATION: none'><font color=#FF6600>BB code</font></a>&nbsp;&nbsp;&nbsp;
								<a onclick="return makelist(document.getElementById('showresults').innerHTML);" href="javascript:void(0)" style='TEXT-DECORATION: none'><font color=#FF6600>Make List</font></a></div>
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

			<table width="60%" align="center" cellpadding="0" cellspacing="0">
				<tr><td>
					<div align="center" style="color:#ccc">
						<hr />
						<!-- Start Server Info -->
						<?php showStat();?>
						<!-- End Server Info -->
						<hr />
						<script type="text/javascript" language="javascript" src="ajax.js?ver=1.0"></script> 
						<BR>
						<BR>
						<BR>
					<!-- footer -->
		<script src="images/ajaxmf.js?ver=1.0" type="text/javascript"></script>
		<div align='center' class='copyright fixed' id='footer'>
			<table cellspacing="8" id="gfooter">
				<tr>
					<td width="42%"><span style="color:#00053D;" class="good" title="Showing The Time & Date"><b></b></span></td>
					<td width="13%" align="center" nowrap="nowrap">Powered by <a href="http://vinaget.us"><?php printf($obj->lang['sitetile']); ?></a></td>
					<td width="45%" align="right" nowrap="nowrap"></td>
			</table>
		</div>
	<!-- /footer -->	
					</div>
				</td></tr>
			</table>
		</body>
	</html>