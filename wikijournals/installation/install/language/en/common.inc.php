<?php
//------------------------------------------------------------------------------ 
//*** English (en)
//------------------------------------------------------------------------------ 

$arrLang = array();

$arrLang['alert_min_version_db'] = "This program requires at least version _DB_VERSION_ of _DB_ installed (current version is _DB_CURR_VERSION_). You cannot proceed the installation.";
$arrLang['alert_min_version_php'] = "This program requires at least version _PHP_VERSION_ of PHP installed (current version is _PHP_CURR_VERSION_). You cannot proceed the installation.";
$arrLang['alert_directory_not_writable'] = "The directory <b>_FILE_DIRECTORY_</b> is not writable! <br />You must grant 'write' permissions (access rights 0755 or 777, depending on your system settings) to this directory before you start the installation!";
$arrLang['alert_unable_to_install'] = "Unable to install this application because an application with the same identity is already installed. You may only <b>Update</b> or <b>Uninstall</b> it.";
$arrLang['alert_required_fields'] = "Items marked with an asterisk are required";
$arrLang['alert_db_host_empty'] = "Database host cannot be empty! Please re-enter.";
$arrLang['alert_db_name_empty'] = "Database name cannot be empty! Please re-enter.";
$arrLang['alert_db_username_empty'] = "Database username cannot be empty! Please re-enter.";
$arrLang['alert_db_password_empty'] = "Database password cannot be empty! Please re-enter.";
$arrLang['alert_admin_username_empty'] = "Admin username cannot be empty! Please re-enter.";
$arrLang['alert_admin_password_empty'] = "Admin password cannot be empty! Please re-enter.";
$arrLang['alert_wrong_testing_parameters'] = "Testing parameters are wrong! Please enter valid parameters.";
$arrLang['alert_remove_files'] = "For security reasons, please remove <b>install.php</b> file and <b>install/</b> folder from your server!";

$arrLang['error_sql_executing'] = "SQL execution error! Please Turn debug mode On and check carefully a syntax of your SQL dump file.";
$arrLang['error_can_not_open_config_file'] = "Database was successfully created! cannot open configuration file _CONFIG_FILE_PATH_ to save info.";
$arrLang['error_can_not_read_file'] = "Could not read file _SQL_DUMP_FILE_! Please check if a file exists.";
$arrLang['error_check_db_exists'] = "Database connection error! Please check if your database exists and access allowed for user <b>_DATABASE_USERNAME_</b>._ERROR_<br />";
$arrLang['error_check_db_connection'] = "Database connecting error! Please check your connection parameters._ERROR_<br />";

$arrLang['admin_access_data'] = "Admin access data";
$arrLang['admin_access_data_descr'] = "(you need this to enter the protected admin area)";
$arrLang['admin_login'] = "Admin Login";
$arrLang['admin_login_info'] = "Your username must be at least 6 characters long and case-sensitive. Please do not enter accented characters.";
$arrLang['admin_password'] = "Admin Password";
$arrLang['admin_password_info'] = "We recommend that your password is not a word you can find in the dictionary, includes both capital and lower case letters, and contains at least one special character (1-9, !, *, _, etc.).";
$arrLang['asp_tags'] = "Asp Tags";
$arrLang['build_date'] = "Build Date";
$arrLang['cancel_installation'] = "Cancel Installation";
$arrLang['click_start_button'] = "Click on Start button to continue";
$arrLang['click_to_start_installation'] = "Click to start installation";
$arrLang['checked'] = "Checked";
$arrLang['continue_installation'] = "Continue Installation";
$arrLang['database_host'] = "Database Host";
$arrLang['database_host_info'] = "Hostname or IP-address of the database server. The database server can be in the form of a hostname (and/or port address), such as db1.myserver.com, or localhost:5432, or as an IP-address, such as 192.168.0.1";
$arrLang['database_name'] = "Database Name";
$arrLang['database_name_info'] = "Database Name. The database used to hold the data. An example of database name is 'testdb'.";
$arrLang['database_username'] = "Database Username";
$arrLang['database_username_info'] = "Database username. The username used to connect to the database server. An example of username is 'test_123'.";
$arrLang['database_password'] = "Database Password";
$arrLang['database_password_info'] = "Database password. The password is used together with the username, which forms the database user account.";
$arrLang['database_prefix'] = "Database Prefix (optional)";
$arrLang['database_prefix_info'] = "Database prefix. Used to set the unique prefix for database tables and prevent one type of data from interfering with another. An example of database prefix is 'abc_'.";
$arrLang['disabled'] = "disabled";
$arrLang['error'] = "Error";
$arrLang['getting_system_info'] = "Getting System Info";
$arrLang['file_successfully_rewritten'] = "The _CONFIG_FILE_ file was successfully re-written and database updated.";
$arrLang['file_successfully_deleted'] = "The _CONFIG_FILE_ file was successfully deleted and database removed.";
$arrLang['file_successfully_created'] = "The _CONFIG_FILE_ file was successfully created.";
$arrLang['follow_the_wizard'] = "Follow the <b>Wizard</b> to setup your database";
$arrLang['installation_guide'] = "Installation Guide";
$arrLang['installation_type'] = "Installation Type";
$arrLang['language'] = "Language";
$arrLang['license'] = "License";
$arrLang['loading'] = "loading";
$arrLang['magic_quotes_gpc'] = "Magic Quotes for GPC (Get/Post/Cookie)";
$arrLang['magic_quotes_runtime'] = "Magic Quotes Runtime";
$arrLang['magic_quotes_sybase'] = "Magic Quotes are in Sybase-style";
$arrLang['new_installation_of'] = "New Installation of";
$arrLang['new'] = "New";
$arrLang['password_encryption'] = "Password Encryption";
$arrLang['perform_manual_installation'] = "Perform a <b>Manual</b> Installation";
$arrLang['php_version'] = "PHP Version";
$arrLang['proceed_to_login_page'] = "Proceed to login page"; 
$arrLang['safe_mode'] = "Safe Mode";
$arrLang['sendmail_from'] = "Sendmail From";
$arrLang['sendmail_path'] = "Sendmail Path";
$arrLang['server_api'] = "Server API";
$arrLang['session_support'] = "Session Support";
$arrLang['short_open_tag'] = "Short Open Tag";
$arrLang['smtp'] = "SMTP";
$arrLang['smtp_port'] = "SMTP Port";
$arrLang['step_1_database_import'] = "Step 1. Database Import";
$arrLang['step_1_database_import_error'] = "Step 1. Database Import (error)";
$arrLang['step_2_installation_completed'] = "Step 2. Installation Completed!";
$arrLang['step_2_updating_completed'] = "Step 2. Updating Completed!";
$arrLang['step_2_uninstallation_completed'] = "Step 2. Uninstallation Completed!";
$arrLang['system'] = "System";
$arrLang['system_architecture'] = "System Architecture";
$arrLang['test_database_connection'] = "Test database connection";
$arrLang['unknown'] = "Unknown";
$arrLang['uninstall'] = "Uninstall";
$arrLang['update'] = "Update";
$arrLang['virtual_directory_support'] = "Virtual Directory Support";
    
?>