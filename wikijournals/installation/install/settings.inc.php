<?php

    // -------------------------------------------------------------------------
    // 1. GENERAL SETTINGS
    // -------------------------------------------------------------------------
    // *** system mode (demo|debug|production)
    define("EI_MODE", "production");
    
    // *** version number
    define("EI_VERSION", "3.1.2");

    // *** check for PHP minimum version number (true, false) -
    //     checks if minimum required version of PHP runs on a server
    define("EI_CHECK_PHP_MINIMUM_VERSION", true);
    define("EI_PHP_MINIMUM_VERSION", "5.2.3");
    
    // *** check or not config directory for writability
    define("EI_CHECK_CONFIG_DIR_WRITABILITY", true);

    // *** language: en - English, es - Spanish
    define("EI_DEFAULT_LANGUAGE", "en");
    // *** array of available languages
    //     to not show dropdown box with languages define it as empty
    //     $arr_active_languages = array()
    $arr_active_languages = array("en"=>"English",
                                  "es"=>"Spanish",
                                  "de"=>"German");

    // *** allow collecting info for magic quotes
    define("EI_CHECK_MAGIC_QUOTES", true);

    // *** allow collecting info for email settings
    define("EI_CHECK_MAIL_SETTINGS", true);
    
    
    // -------------------------------------------------------------------------
    // 2. DATABASE SETTINGS
    // -------------------------------------------------------------------------
    // *** force database creation
    define("EI_DATABASE_CREATE", true);

    // *** define database type
    // *** to check installed drivers use: print_r(PDO::getAvailableDrivers());
    //     mysql          - MySql,
    //     pgsql          - PostgreSQL
    //     sqlite/sqlite2 - SQLite 
    //     oci            - Oracle
    //     cubrid         - Cubrid
    //     firebird       - Firebird/Interbase 6
    //     dblib          - FreeTDS / Microsoft SQL Server / Sybase
    //     ibm            - IBM DB2
    //     informix       - IBM Informix Dynamic Server
    //     odbc           - ODBC v3 (IBM DB2, unixODBC and win32 ODBC)
    define("EI_DATABASE_TYPE", "mysql");

    // *** check for database engine minimum version number (true, false) -
    //     checks if minimum required version of database engine runs on a server
    define("EI_CHECK_DB_MINIMUM_VERSION", true);
    define("EI_DB_MINIMUM_VERSION", "5.0.2");    
        
    // *** admin username and password (true, false) - get admin username and password
    define("EI_USE_USERNAME_AND_PASWORD", false);        
    // *** encrypt or not admin password true|false
    define("EI_USE_PASSWORD_ENCRYPTION", false);        
    // *** type of encryption - AES|MD5
    define("EI_PASSWORD_ENCRYPTION_TYPE", "AES");        
    // *** password encryption key for AES encryption
    define("EI_PASSWORD_ENCRYPTION_KEY", "php_easy_installer");
    
    
    // -------------------------------------------------------------------------
    // 3. CONFIG PARAMETERS
    // -------------------------------------------------------------------------
    // *** config file directory - directory, where config file must be
    //     for ex.: "../common/" or "common/" - according to directory hierarchy and relatively to install.php file
    define("EI_CONFIG_FILE_DIRECTORY", "config/");

    // *** config file name - output file with config parameters (database, username etc.)
    define("EI_CONFIG_FILE_NAME", "LocalSettings.php");
    // *** according to directory hierarchy (you may add/remove "../" before EI_CONFIG_FILE_DIRECTORY)
    define("EI_CONFIG_FILE_PATH", EI_CONFIG_FILE_DIRECTORY.EI_CONFIG_FILE_NAME);

    // *** specifies whether to allow new installation
    define("EI_ALLOW_NEW_INSTALLATION", true);        
    // *** specifies whether to allow update
    define("EI_ALLOW_UPDATE", true);        
    // *** specifies whether to allow un-installation
    define("EI_ALLOW_UN_INSTALLATION", true);        

    // *** sql dump file - file that includes SQL statements for instalation
    define("EI_SQL_DUMP_FILE_CREATE", "sql_dump/wikijournalscreate.sql");
    define("EI_SQL_DUMP_FILE_UPDATE", "sql_dump/wikijournalsupdate.sql");
    define("EI_SQL_DUMP_FILE_UN_INSTALL", "sql_dump/wikijpournalsun-install.sql");

    // *** defines using of utf-8 encoding and collation for SQL dump file
    define("EI_USE_ENCODING", true);
    define("EI_DUMP_FILE_ENCODING", "utf8");
    define("EI_DUMP_FILE_COLLATION", "utf8_unicode_ci");               
    
    // *** allow manual installation
    define("EI_ALLOW_MANUAL_INSTALLATION", true);
    // *** manual installation text file
    define("EI_MANUAL_INSTALLATION_DIR", "install/manual/");    
    $arr_manual_installations = array("en"=>"manual.en.txt",
                                      "es"=>"manual.es.txt",
                                      "de"=>"manual.de.txt");
    

    // -------------------------------------------------------------------------
    // 4. CONFIG TEMPLATE PARAMETERS
    // -------------------------------------------------------------------------
    // *** config file name - config template file name
    define("EI_CONFIG_FILE_TEMPLATE", "config.tpl");
   
    
    // -------------------------------------------------------------------------
    // 5. APPLICATION PARAMETERS
    // -------------------------------------------------------------------------
    // *** application name
    define("EI_APPLICATION_NAME", "Wikijournals");
    // *** application version number
    define("EI_APPLICATION_VERSION", "v1.0");
    
    // *** default start file name - application start file
    define("EI_APPLICATION_START_FILE", "../index.php");
    
    // *** license agreement page
    define("EI_LICENSE_AGREEMENT_PAGE", "install/license/license.txt");    
   
    // *** additional text after successful installation
    define("EI_POST_INSTALLATION_TEXT", "Please copy the file LocalSettings.php from the config directory to the application directory (f.e. /wikijournals)");
    
?>