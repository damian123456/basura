		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">
		<head>
			<link rel="SHORTCUT ICON" href="images/dove.png" type="image/x-icon" />
			<title>&#9734 FileDownloader 3.7.0 &#9734 - CboxERA -</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<link title="Rapidleech Style" href="<?php echo $skin;?>/rl_style_pm.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Metal+Mania' rel='stylesheet' type='text/css'>
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
								<tr><td width="140" height="100%"><div class="cell-plugin"><em><em><font face="metal mania" size="4" color="#ADFF2F"><b><?php printf($obj->lang['plugins']); ?></b></em></div></td></tr>
								<tr><td height="100%" style="padding:3px;">
									<div dir="rtl" align="left" style="overflow-y:scroll; height:257px; padding-left:05px;">
									<?php
										foreach ($host as $key => $val){
											echo "<span class='plugincollst'>" .$key."</span><br />";
										}
									?>
									</div><br />
									<div class="cell-plugin"><em><font face="metal mania" size="4" color="#ADFF2F"><b>Accounts</b></em></div>
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
							<td class="cell-nav"><a class="ServerFiles" href="./"><em><font face="metal mania" size="4" color="#ADFF2F"><b><?php printf($obj->lang['main']); ?></b></em></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=donate"><em><font face="metal mania" size="4" color="#ADFF2F"><b><?php printf($obj->lang['donate']); ?></b></em></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=listfile"><em><font face="metal mania" size="4" color="#ADFF2F"><b><?php printf($obj->lang['listfile']); ?></b></em></a></td>
							<td class="cell-nav"><a class="ServerFiles" href="./?id=check"><em><font face="metal mania" size="4" color="#ADFF2F"><b><?php printf($obj->lang['check']); ?></b></em></a></td>
							<?php if ($obj->Secure || $obj->isadmin()) 
							echo '<td class="cell-nav"><a class="ServerFiles" href="./?id=admin"> <em><font face="metal mania" size="4" color="#ADFF2F"><b>'.$obj->lang['admin'].'</b></em></a></td>'; ?>
							<?php if ($obj->Secure) 
							echo '<td class="cell-nav"><a class="ServerFiles" href="./login.php?go=logout"> <em><font face="metal mania" size="4" color="#ADFF2F"><b>'.$obj->lang['log'].'</b></em></a></td>'; ?>
						</tr>
					</tbody></table>
					<table id="tb_content"><tbody>
						<tr><td height="5px"></td></tr>
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
<span style="text-align:center;" id="kwshadow2"><b><span style="font-family: metal mania;font-size:180%;background-image: url(http://i.imgur.com/lGVURbM.gif)">
<font size= "5" color="ffffff">F i l e D o w n l o a d e r   -   3 . 7 . 0</font></a></span><br>
<br>

								<textarea id='links' style='width:600px;height:175px;' name='links'></textarea><BR>
<em><font face="metal mania" size="3" color="#ADFF2F">
<br>
								<input type="submit" class="blkdownbutton" id ='submit' value='<?php printf($obj->lang['sbdown']); ?>'/>&nbsp;&nbsp;&nbsp;
								<input type="button" class="blkdownbutton" onclick="reseturl();return false;" value="Reset">&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="autoreset" id="autoreset" checked>&nbsp;Auto reset&nbsp;&nbsp;&nbsp;
							</form></font></em><BR><BR>
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
	
					</div>
				</td></tr>
			</table>
		</body>
	</html>