<? require_once("../functions/data.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>{SUBJECT}</title>
		
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: none;margin: 0;padding: 0;background-color: #FAFAFA;width: 100%;">
    	<center>
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="margin: 0;padding: 0;background-color: #FAFAFA;height: 100%;width: 100%;">
            	<tr>
                	<td align="center" valign="top" style="border-collapse: collapse;">
                        <!-- // Begin Template Preheader \ -->
                        <table border="0" cellpadding="10" cellspacing="0" width="600" id="templatePreheader" style="background-color: #FAFAFA;">
                            <tr>
                                <td valign="top" class="preheaderContent" style="border-collapse: collapse;">
                                
                                	<!-- // Begin Module: Standard Preheader  -->
                                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                    	<tr>
                                        	<td valign="top" style="border-collapse: collapse;">
                                            	<div mc:edit="std_preheader_content" style="color: #505050;font-family: Arial;font-size: 10px;line-height: 100%;text-align: left;">{TEASER}</div>
                                            </td>
                                        </tr>
                                    </table>
                                	<!-- // End Module: Standard Preheader  -->
                                
                                </td>
                            </tr>
                        </table>
                        <!-- // End Template Preheader \ -->
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer" style="border: 1px solid #DDDDDD;background-color: #FFFFFF;">
                            <tr>
                                <td align="center" valign="top" style="border-collapse: collapse;">
                                    <!-- // Begin Template Header \ -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader" style="background-color: #FFFFFF;border-bottom: 0;">
                                        <tr>
                                            <td class="headerContent" style="border-collapse: collapse;color: #202020;font-family: Arial;font-size: 34px;font-weight: bold;line-height: 100%;padding: 0;text-align: left;vertical-align: middle;">
                                            
                                                <!-- // Begin Module: Standard Header Image \ -->
                                                <img src="http://<? echo data("domain"); ?>/includes/mailer/images/header.jpg" style="border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;max-width:600px;" id="headerImage campaign-icon" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />
                                                <!-- // End Module: Standard Header Image \ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top" style="border-collapse: collapse;">
                                    <!-- // Begin Template Body \ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                    	<tr>
                                        	<td valign="top" style="border-collapse: collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td valign="top" class="bodyContent" style="border-collapse: collapse;background-color: #FFFFFF;">
                                            
                                                            <!-- // Begin Module: Standard Content \ -->
                                                            <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td valign="top" style="border-collapse: collapse;">
			                                                            <div mc:edit="std_content00" style="color: #505050;font-family: Arial;font-size: 14px;line-height: 150%;text-align: left;">{MAINCONTENT}</div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <!-- // End Module: Standard Content \ -->
                                                            
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top" style="border-collapse: collapse;">
                                </td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>