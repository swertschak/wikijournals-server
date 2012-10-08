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
################################################################################

	session_start();
	
	require_once("shared.inc.php");    
    require_once("settings.inc.php");
	require_once("database.inc.php"); 
    require_once("functions.inc.php");	
	require_once("languages.inc.php");	
    
	$program_already_installed = false;
    if(file_exists("../".EI_CONFIG_FILE_PATH)){        
		$program_already_installed = true;
		///header("location: ../".EI_APPLICATION_START_FILE);
        ///exit;
	}
	
	if(EI_MODE == "debug") error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    
	$completed = false;
	$error_mg  = array();
	$task      = isset($_POST['task']) ? $_POST['task'] : "";
		
	if($task == "step2"){

		$username				= isset($_POST['username']) ? stripcslashes($_POST['username']) : "";
		$password				= isset($_POST['password']) ? stripcslashes($_POST['password']) : "";
		$database_host			= isset($_POST['database_host']) ? prepare_input($_POST['database_host']) : "";
		$database_name			= isset($_POST['database_name']) ? prepare_input($_POST['database_name']) : "";
		$database_username		= isset($_POST['database_username']) ? prepare_input($_POST['database_username']) : "";
		$database_password		= isset($_POST['database_password']) ? prepare_input($_POST['database_password']) : "";
		$database_prefix    	= isset($_POST['database_prefix']) ? stripcslashes($_POST['database_prefix']) : "";
		$install_type			= isset($_POST['install_type']) ? $_POST['install_type'] : "create";
		$password_encryption 	= isset($_POST['password_encryption']) ? $_POST['password_encryption'] : EI_PASSWORD_ENCRYPTION_TYPE;
		if($install_type == "update"){
			$sql_dump_file = EI_SQL_DUMP_FILE_UPDATE;
		}else if($install_type == "un-install"){
			$sql_dump_file = EI_SQL_DUMP_FILE_UN_INSTALL;
		}else{
			$sql_dump_file = EI_SQL_DUMP_FILE_CREATE;
		}		
						
		if(empty($database_host)) $error_mg[] = lang_key("alert_db_host_empty");	
		if(empty($database_name)) $error_mg[] = lang_key("alert_db_name_empty"); 
		if(empty($database_username)) $error_mg[] = lang_key("alert_db_username_empty"); 	
		//if (empty($database_password)) $error_mg[] = lang_key("alert_db_password_empty");
		if($install_type != "un-install"){
			if(EI_USE_USERNAME_AND_PASWORD && empty($username)) $error_mg[] = lang_key("alert_admin_username_empty");
			if(EI_USE_USERNAME_AND_PASWORD && empty($password)) $error_mg[] = lang_key("alert_admin_password_empty");
		}
		
		if(empty($error_mg)){		
			if(EI_MODE == "demo"){
				if($database_host == "localhost" && $database_name == "db_name" && $database_username == "test" && $database_password == "test"){
					$completed = true; 
				}else{
					$error_mg[] = lang_key("alert_wrong_testing_parameters");
				}
			}else{				
				$db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE);
				if(EI_DATABASE_CREATE && ($install_type == "create") && !$db->Create()){
					$error_mg[] = $db->Error();					
				}else if($db->Open()){
					if(EI_CHECK_DB_MINIMUM_VERSION && (version_compare($db->GetVersion(), EI_DB_MINIMUM_VERSION, '<'))){
						$alert_min_version_db = lang_key("alert_min_version_db");
						$alert_min_version_db = str_replace("_DB_VERSION_", "<b>".EI_DB_MINIMUM_VERSION."</b>", $alert_min_version_db);
						$alert_min_version_db = str_replace("_DB_CURR_VERSION_", "<b>".$db->GetVersion()."</b>", $alert_min_version_db);
						$alert_min_version_db = str_replace("_DB_", "<b>".$db->GetDbDriver()."</b>", $alert_min_version_db);
						$error_mg[] = $alert_min_version_db;
					}else{
						// read sql dump file
						$sql_dump = file_get_contents($sql_dump_file);
						if($sql_dump != ""){
							if(false == ($db_error = apphp_db_install($sql_dump_file))){
								if(EI_MODE != "debug") $error_mg[] = lang_key("error_sql_executing");								
							}else{
								// write additional operations here, like setting up system preferences etc.
								// ...
								$completed = true;
								
								// now try to create file and write information
								$config_file = file_get_contents(EI_CONFIG_FILE_TEMPLATE);
								$config_file = str_replace("<DB_HOST>", $database_host, $config_file);
								$config_file = str_replace("<DB_NAME>", $database_name, $config_file);
								$config_file = str_replace("<DB_USER>", $database_username, $config_file);
								$config_file = str_replace("<DB_PASSWORD>", $database_password, $config_file);
								$config_file = str_replace("<DB_PREFIX>", $database_prefix, $config_file);
								$config_file = str_replace("<ENCRYPTION>", (EI_USE_PASSWORD_ENCRYPTION) ? "true" : "false", $config_file);			
								$config_file = str_replace("<ENCRYPTION_TYPE>", $password_encryption, $config_file);			
								$config_file = str_replace("<ENCRYPT_KEY>", EI_PASSWORD_ENCRYPTION_KEY, $config_file);
								
								@chmod("../".EI_CONFIG_FILE_PATH, 0755);
								$f = @fopen("../".EI_CONFIG_FILE_PATH, "w+");
								if(!@fwrite($f, $config_file) > 0){
									$error_mg[] = str_replace("_CONFIG_FILE_PATH_", EI_CONFIG_FILE_PATH, lang_key("error_can_not_open_config_file")); 
								}
								@fclose($f);
								if($install_type == "un-install") @unlink("../".EI_CONFIG_FILE_PATH);
								///@chmod("../".EI_CONFIG_FILE_DIRECTORY, 0644);									
							}							
						}else{
							$error_mg[] = str_replace("_SQL_DUMP_FILE_", $sql_dump_file, lang_key("error_can_not_read_file")); 
						}						
					}
				}else{
					if(EI_MODE == "debug"){
						$error_mg[] = str_replace("_ERROR_", "<br />Error: ".$db->Error(), lang_key("error_check_db_connection")); 
					}else{
						$error_mg[] = str_replace("_ERROR_", "", lang_key("error_check_db_connection")); 
					}						
				}
			}			
		}
	}
        
?>	


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?php echo lang_key("installation_guide"); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/styles.css"></link>
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="css/stylesIE.css"></link>
	<![endif]-->
	<script type="text/javascript">
		var EI_LOCAL_PATH = "language/<?php echo $curr_lang; ?>/";
	</script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
</head>
<body>
    
<table align="center" width="70%" cellspacing="0" cellpadding="2" border="0">
<tbody>
<tr><td>&nbsp;</td></tr>
<tr>
    <td class="text" valign="top">
        <h2><?php echo lang_key("new_installation_of"); ?> <?php echo EI_APPLICATION_NAME." ".EI_APPLICATION_VERSION;?>!</h2>
        
        <?php echo lang_key("follow_the_wizard"); ?><br /><br />
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td class="gray_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr><td class="ltcorner"></td><td></td><td class="rtcorner"></td></tr>
                <tr>
                    <td></td>
                    <td align="middle">
                        <table class="text" width="99%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
						<?php
						if(!$completed){							
						?>
							<tr>
								<td align="left">
									<h4><?php echo lang_key("step_1_database_import_error"); ?></h4>
								</td>
							</tr>
							<?php
								foreach($error_mg as $msg){
									echo "<tr><td class='text' align='left'><span style='color:#bb5500;'>&#8226; ".$msg."</span></td></tr>";
								}
							?>
							<tr><td nowrap height="25px">&nbsp;</td></tr>
							<tr>
								<td align="left">	
									<img class="form_button" src="language/<?php echo $curr_lang;?>/buttons/button_back.gif" name="button_back" id="button_back" onmouseover="buttonOver('button_back')" onmouseout="buttonOut('button_back')" alt="" onclick="javascript: history.go(-1);" />
									&nbsp;&nbsp;&nbsp;&nbsp;
									<img class="form_button" src="language/<?php echo $curr_lang;?>/buttons/button_retry.gif" name="button_retry" id="button_retry" onmouseover="buttonOver('button_retry')" onmouseout="buttonOut('button_retry')" alt="" onclick="javascript: location.reload();" />
								</td>
							</tr>							
						<?php } else {?>
							<tr><td>&nbsp;</td></tr>						
							<?php if($install_type == "update"){ ?>
								<tr><td align="left"><h4><?php echo lang_key("step_2_updating_completed"); ?></h4></td></tr>
								<tr><td>&nbsp;</td></tr>	
								<tr>
									<td align="left">
										<?php echo str_replace("_CONFIG_FILE_", EI_CONFIG_FILE_PATH, lang_key("file_successfully_rewritten")); ?><br />
										<?php echo EI_POST_INSTALLATION_TEXT; ?><br />
										<span class='alert'><?php echo lang_key("alert_remove_files"); ?></span>
										<br /><br />
										<?php if(EI_APPLICATION_START_FILE != ""){ ?><a href="<?php echo "../".EI_APPLICATION_START_FILE;?>"><?php echo lang_key("proceed_to_login_page"); ?></a><?php } ?>
									</td>
								</tr>									
							<?php }else if($install_type == "un-install"){ ?>
								<tr><td align="left"><h4><?php echo lang_key("step_2_uninstallation_completed"); ?></h4></td></tr>
								<tr><td>&nbsp;</td></tr>	
								<tr>
									<td align="left">
										<?php echo str_replace("_CONFIG_FILE_", EI_CONFIG_FILE_PATH, lang_key("file_successfully_deleted")); ?><br /><br />
										<span class='alert'><?php echo lang_key("alert_remove_files"); ?></span>
										<br /><br />
										<?php if(EI_APPLICATION_START_FILE != ""){ ?><a href="<?php echo "../".EI_APPLICATION_START_FILE;?>"><?php echo lang_key("proceed_to_login_page"); ?></a><?php } ?>
									</td>
								</tr>															
							<?php }else{ ?>									
								<tr><td align="left"><h4><?php echo lang_key("step_2_installation_completed"); ?></h4></td></tr>
								<tr><td>&nbsp;</td></tr>	
								<tr>
									<td align="left">
										<?php echo str_replace("_CONFIG_FILE_", EI_CONFIG_FILE_PATH, lang_key("file_successfully_created")); ?><br />
										<?php echo EI_POST_INSTALLATION_TEXT; ?><br />
										<span class='alert'><?php echo lang_key("alert_remove_files"); ?></span>
										<br /><br />
										<?php if(EI_APPLICATION_START_FILE != ""){ ?><a href="<?php echo "../".EI_APPLICATION_START_FILE;?>"><?php echo lang_key("proceed_to_login_page"); ?></a><?php } ?>
									</td>
								</tr>															
							<?php } ?>
						<?php } ?>
                        </tbody>
                        </table>
                        <br />
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
				
		<?php include_once("footer.php"); ?>        
    </td>
</tr>
</tbody>
</table>

</body>
</html>