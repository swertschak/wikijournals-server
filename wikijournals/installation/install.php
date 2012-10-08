<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP EasyInstaller Pro version 3.1.2                                      #
##  Developed by:  ApPHP <info@apphp.com>                                      #
##  License:       GNU LGPL v.3                                                #
##  Site:          http://www.apphp.com/php-easyinstaller/                     #
##  Copyright:     ApPHP EasyInstaller (c) 2009-2011. All rights reserved.     #
##                                                                             #
##  Additional modules (embedded):                                             #
##  -- jQuery (JavaScript Library)                           http://jquery.com #
##                                                                             #
################################################################################
   
    session_start();   

    require_once("install/settings.inc.php");
	require_once("install/functions.inc.php");
	require_once("install/languages.inc.php");	

	$program_already_installed = false;
    if(file_exists(EI_CONFIG_FILE_PATH)){ 
		$program_already_installed = true;
		///header("location: ".EI_APPLICATION_START_FILE);
        ///exit;
	}
        
    ob_start();
    
	if(function_exists('phpinfo')) @phpinfo(-1);
    $phpinfo = array('phpinfo' => array());
    if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
    foreach($matches as $match){
        if(strlen($match[1])){
            $phpinfo[$match[1]] = array();
		}else if(isset($match[3])){
            $phpinfo[end(array_keys($phpinfo))][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
		}else{
            $phpinfo[end(array_keys($phpinfo))][] = $match[2];
		}
    }
	
	$is_error = false;
	$error_mg = array();
	if(EI_CHECK_PHP_MINIMUM_VERSION && (version_compare(phpversion(), EI_PHP_MINIMUM_VERSION, '<'))){	
		$is_error = true;
		$alert_min_version_php = lang_key('alert_min_version_php');
		$alert_min_version_php = str_replace("_PHP_VERSION_", EI_PHP_MINIMUM_VERSION, $alert_min_version_php);
		$alert_min_version_php = str_replace("_PHP_CURR_VERSION_", phpversion(), $alert_min_version_php);
		$error_mg[] = $alert_min_version_php;
	}
	if(EI_CHECK_CONFIG_DIR_WRITABILITY && !is_writable(EI_CONFIG_FILE_DIRECTORY)){
		$is_error = true;
		$error_mg[] = str_replace("_FILE_DIRECTORY_", EI_CONFIG_FILE_DIRECTORY, lang_key('alert_directory_not_writable'));
	}
	
	$phpversion = function_exists("phpversion") ? "<span class='found'>".phpversion()."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	
	$system = isset($phpinfo['phpinfo']['System']) ? "<span class='found'>".$phpinfo['phpinfo']['System']."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$system_architecture = isset($phpinfo['phpinfo']['Architecture']) ? "<span class='found'>".$phpinfo['phpinfo']['Architecture']."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$build_date = isset($phpinfo['phpinfo']['Build Date']) ? "<span class='found'>".$phpinfo['phpinfo']['Build Date']."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$server_api = isset($phpinfo['phpinfo']['Server API']) ? "<span class='found'>".$phpinfo['phpinfo']['Server API']."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$vd_support = isset($phpinfo['phpinfo']['Virtual Directory Support']) ? $phpinfo['phpinfo']['Virtual Directory Support'] : lang_key('unknown');
	$vd_support = ($vd_support == "enabled") ? "<span class='found'>".$vd_support."</span>" : "<span class='disabled'>".$vd_support."</span>";
	$asp_tags 	= isset($phpinfo['PHP Core']) ? "<span class='found'>".$phpinfo['PHP Core']['asp_tags'][0]."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$safe_mode 	= isset($phpinfo['PHP Core']) ? "<span class='found'>".$phpinfo['PHP Core']['safe_mode'][0]."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$short_open_tag = isset($phpinfo['PHP Core']) ? "<span class='found'>".$phpinfo['PHP Core']['short_open_tag'][0]."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$session_support      = isset($phpinfo['session']['Session Support']) ? $phpinfo['session']['Session Support'] : lang_key('unknown');
	$session_support      = ($session_support == "enabled") ? "<span class='found'>".$session_support."</span>" : "<span class='disabled'>".$session_support."</span>";
	
	if(EI_CHECK_MAGIC_QUOTES){
		$magic_quotes_gpc     = ini_get("magic_quotes_gpc") ? "<span class='found'>On</span>" : "<span class='disabled'>Off</span>";
		$magic_quotes_runtime = ini_get("magic_quotes_runtime") ? "<span class='found'>On</span>" : "<span class='disabled'>Off</span>";
		$magic_quotes_sybase  = ini_get("magic_quotes_sybase") ? "<span class='found'>On</span>" : "<span class='disabled'>Off</span>";									
	}
	
	$smtp 	 		= (ini_get("SMTP") != "") ? "<span class='found'>".ini_get("SMTP")."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$smtp_port	 	= (ini_get("smtp_port") != "") ? "<span class='found'>".ini_get("smtp_port")."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$sendmail_from 	= (ini_get("sendmail_from") != "") ? "<span class='found'>".ini_get("sendmail_from")."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	$sendmail_path 	= (ini_get("sendmail_path") != "") ? "<span class='found'>".ini_get("sendmail_path")."</span>" : "<span class='unknown'>".lang_key('unknown')."</span>";
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?php echo lang_key("installation_guide"); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="install/css/styles.css"></link>
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="install/css/stylesIE.css"></link>
	<![endif]-->
	<script type="text/javascript">
		var EI_LOCAL_PATH = "install/language/<?php echo $curr_lang; ?>/";
	</script>
	<script type="text/javascript" src="install/js/main.js"></script>
	<script type="text/javascript" src="install/js/jquery-1.4.2.min.js"></script>
</head>
<body>
<table align="center" width="70%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr><td>&nbsp;</td></tr>
<tr>
    <td class="text" valign="top">
        <h2><?php echo lang_key("new_installation_of"); ?> <?php echo EI_APPLICATION_NAME." ".EI_APPLICATION_VERSION;?>!</h2>

        <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
			<td class="text">
				<?php if(EI_ALLOW_MANUAL_INSTALLATION){ ?>
					<input type="radio" name="install_type" id="install_type_wizard" onclick="toggleInstructions(1)" checked='checked' /><label for="install_type_wizard"><?php echo lang_key("follow_the_wizard"); ?></label>
					<input type="radio" name="install_type" id="install_type_manual" onclick="toggleInstructions(2)" /><label for="install_type_manual"><?php echo lang_key("perform_manual_installation"); ?></label>
				<?php }else{ ?>
					<?php echo lang_key("follow_the_wizard"); ?>
				<?php } ?>
			</td>                
			<td class="text" align="right" valign="middle">
				<?php
					if(count($arr_active_languages) > 1){
						echo lang_key("language").": ";
						echo "<select onchange=\"javascript:goTo('install.php?lang='+this.value)\">";
						foreach($arr_active_languages as $key => $val){
							echo "<option ".(($key == $curr_lang) ? "selected=selected" : "")." value='".$key."'>".$val."</option>";
						}
						echo "</select>";						
					}
				?>
				
			</td>                
		</tr>
		<tr><td colspan="2" nowrap="nowrap" height="8px"></td></tr>
        <tr>
            <td class="gray_table" colspan="2">                
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr><td class="ltcorner"></td><td></td><td class="rtcorner"></td></tr>
                <tr>
                    <td></td>
                    <td align="middle">                       
					    <div id="divWizard">
							<table class="text" width="99%" cellspacing="2" cellpadding="0" border="0">
							<tbody>
							<tr>
								<td align="left" colspan="2"><h4><?php echo lang_key("getting_system_info"); ?></h4></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("php_version"); ?></b>: <i><?php echo $phpversion; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr><td colspan="2" nowrap height="9px"></td></tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("system"); ?></b>: <i><?php echo $system; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("system_architecture"); ?></b>: <i><?php echo $system_architecture; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("build_date"); ?></b>: <i><?php echo $build_date; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("server_api"); ?></b>: <i><?php echo $server_api; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("virtual_directory_support"); ?></b>: <i><?php echo $vd_support; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("asp_tags"); ?></b>: <i><?php echo $asp_tags; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("safe_mode"); ?></b>: <i><?php echo $safe_mode; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("short_open_tag"); ?></b>: <i><?php echo $short_open_tag; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("session_support"); ?></b>: <i><?php echo $session_support; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>

							<?php if(EI_CHECK_MAGIC_QUOTES){ ?>
							<tr><td colspan="2" nowrap height="9px"></td></tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("magic_quotes_gpc"); ?></b>: <i><?php echo $magic_quotes_gpc; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("magic_quotes_runtime"); ?></b>: <i><?php echo $magic_quotes_runtime; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("magic_quotes_sybase"); ?></b>: <i><?php echo $magic_quotes_sybase; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<?php } ?>

							<?php if(EI_CHECK_MAIL_SETTINGS){ ?>
							<tr><td colspan="2" nowrap height="9px"></td></tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("smtp"); ?></b>: <i><?php echo $smtp; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("smtp_port"); ?></b>: <i><?php echo $smtp_port; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("sendmail_from"); ?></b>: <i><?php echo $sendmail_from; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<tr>
								<td><b>&#8226; <?php echo lang_key("sendmail_path"); ?></b>: <i><?php echo $sendmail_path; ?></i></td>
								<td><span class='checked'><?php echo lang_key("checked"); ?>!</span></td>
							</tr>
							<?php } ?>
							
							<tr><td colspan="2">&nbsp;</td></tr>
							<?php
								if(!$is_error){
									echo ($program_already_installed) ? "<tr><td align='left' colspan='2'><span class='alert'>* ".lang_key("alert_unable_to_install")."</span></td></tr>" : "";									
								}else{								
									if($is_error){
										foreach($error_mg as $msg){
											echo "<tr><td colspan='2' align='left'><span class='alert'>&#8226; ".$msg."</span></td></tr>";
										}								
									}
								}
							?>
							</tbody>
							</table>
							
							<?php if(!$is_error){ ?>
								<table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
								<tr>
									<td align="left" valign="middle" width="70px">
										<a href="install/step1.php"><img class="form_button" src="install/language/<?php echo $curr_lang;?>/buttons/button_start.gif" name="submit" id='button_start' onmouseover="buttonOver('button_start')" onmouseout="buttonOut('button_start')" title="<?php echo lang_key("click_to_start_installation"); ?>" alt="" /></a>
									</td>
									<td align="left" valign="middle">
										<?php
											if(!$is_error){
												echo " - &nbsp;".lang_key("click_start_button");
											}
										?>										
									</td>
								</tr>
								</table>						
							<?php } ?>
						</div>
						
						<?php
							if(EI_ALLOW_MANUAL_INSTALLATION){
								echo "<div id='divManually'>";
								include_once(EI_MANUAL_INSTALLATION_DIR.$arr_manual_installations[$curr_lang]);
								echo "</div>";
							}
						?>
						
					</td>
                    <td></td>
                </tr>
				<tr><td class="lbcorner"></td><td></td><td class="rbcorner"></td></tr>
                </tbody>
                </table>
            </td>
        </tr>
        </tbody>
        </table>
		
        <?php include_once("install/footer.php"); ?>        
    </td>
</tr>
</tbody>
</table>                 
</body>
</html>