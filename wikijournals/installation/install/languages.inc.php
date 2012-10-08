<?php

	$lang = isset($_GET['lang']) ? prepare_input($_GET['lang']) : "";
	
	if(!isset($arr_active_languages)) $arr_active_languages = array();
	
	if(!empty($lang) && array_key_exists($lang, $arr_active_languages)){
		$curr_lang = $_SESSION['curr_lang'] = $lang;
	}else if(isset($_SESSION['curr_lang']) && array_key_exists($_SESSION['curr_lang'], $arr_active_languages)){
		$curr_lang = $_SESSION['curr_lang'];
	}else{
		$curr_lang = EI_DEFAULT_LANGUAGE;
	}
	
	if(file_exists("install/language/".$curr_lang."/common.inc.php")){
		include_once("install/language/".$curr_lang."/common.inc.php");
	}else if(file_exists("language/".$curr_lang."/common.inc.php")){
		include_once("language/".$curr_lang."/common.inc.php");
	}else if(file_exists("../language/".$curr_lang."/common.inc.php")){
		include_once("../language/".$curr_lang."/common.inc.php");
	}else{
		include_once("install/language/en/common.inc.php");    	
	}	

?>