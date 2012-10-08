<?php

/**
 *	Class Database (PDO Extension)
 *  ---------------------------- 
 *  Description : encapsulates database operations & properties with PDO
 *  Updated	    : 09.07.2011
 *  Version     : 1.0.1
 *	Written by  : ApPHP
 *	Syntax (standard)  : $db = new Database($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE);
 *	Syntax (singleton) : $db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE);
 *
 *  PUBLIC           STATIC				 PROTECTED           PRIVATE
 *  -------          ----------          ----------          ---------- 
 *  __construct      GetInstance
 *	__destruct       
 *	Create           
 *	Open             
 *	Close
 *	GetVersion
 *	GetDbDriver
 *	Query
 *	Exec
 *	AffectedRows
 *	RowCount
 *	InsertID
 *	SetEncoding
 *	Error
 *	ErrorCode
 *	ErrorInfo
 *
 *	CHANGE LOG
 *	-----------	
 *  1.0.1
 *  	- added GetDbDriver
 *  	- improved GetVersion()
 *  	- added Create()
 *  	- added GetInstance()
 *  	-	
 *	
 **/

class Database
{
    // connection parameters
	
	private $host = "";
	private $port = "";
	private $db_driver = "";
    private $database = "";
    private $user = "";
    private $password = "";
	private $force_encoding = false;

	private $error = "";
	
	private $affectedRows = "0";

	// database connection handler 
    private $dbh = NULL;
	
	// database statament handler 
	private $sth = NULL;
    
	// static data members	
	private static $objInstance; 


	//==========================================================================
    // Class Constructor
	// 		@param $database_host
	// 		@param $database_name
	// 		@param $database_username
	// 		@param $database_password
	// 		@param $db_driver
	// 		@param $force_encoding
	//==========================================================================
    function __construct($database_host, $database_name, $database_username, $database_password, $db_driver = "", $force_encoding = false)
    {
		$this->host 	 = $database_host;
		$this->port 	 = "";
		
		$host_parts 	 = explode(":", $database_host);		
		if(isset($host_parts[1]) && is_numeric($host_parts[1])){
			$this->host = $host_parts[0];	
			$this->port = $host_parts[1];	
		}
		
		$this->database  = $database_name;   	
		$this->user 	 = $database_username;
		$this->password  = $database_password;
		$this->db_driver = strtolower($db_driver);
		$this->force_encoding = $force_encoding;
	}

	//==========================================================================
    // Class Destructor
	//==========================================================================
    function __destruct()
	{
		// echo 'this object has been destroyed';
    }

    /**
     *	Create database
     */
    public function Create()
    {
		$this->dbh = new PDO($this->db_driver.":host=".$this->host, $this->user, $this->password);
		$this->dbh->exec("CREATE DATABASE IF NOT EXISTS `".$this->database."`;");
		if($this->dbh->errorCode() != "00000"){
			$err = $this->dbh->errorInfo();
			$this->error = $err[2];
			return false; 
		}
		return true; 
	}

    /**
     *	Checks and opens connection with database
     */
    public function Open()
    {
		if(version_compare(PHP_VERSION, '5.0.0', '<') || !defined('PDO::ATTR_DRIVER_NAME')){
			$this->error = "You must have PHP 5 or newer installed to use PHP Data Objects (PDO) extension";
			return false; 
		}

		$port = (!empty($this->port)) ? ";port=".$this->port : "";

		try{
			switch($this->db_driver){
				case "mssql": 
					$this->dbh = new PDO("mssql:host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
				case "sybase": 
					$this->dbh = new PDO("sybase:host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
				case "sqlite":
					$this->dbh = new PDO("sqlite:my/database/path/database.db");
					break;
				case "pgsql":
					$this->dbh = new PDO("pgsql:host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
				case "mysql":
				default:
					$this->dbh = new PDO($this->db_driver.":host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
			}
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(empty($this->dbh)){
				return false;
			}else if($this->force_encoding){
				$this->dbh->exec("set names utf8");
			}
		}catch(PDOException $e){  
			$this->error = $e->getMessage();
			return false; 
		}            

        return true;
    }	
    
    /**
     *	Close connection 
     */
    public function Close()
    {
		$this->sth = null;
		$this->dbh = null;
    }

    /**
     *	Returns database engine version
     */
	public function GetVersion()
	{
		// clean version number from alphabetic characters
		$version = $this->dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
		return preg_replace("/[^0-9,.]/", "", $version);
	}

    /**
     *	Get DB driver
     */
    public function GetDbDriver()
    {
		return $this->db_driver;
    }

    /**
     *	Runs query
     *		@param $query
     */
    public function Query($query = '')
    {
		try{
			$this->sth = $this->dbh->query($query);
			if($this->sth !== FALSE) return true;	
			else return false; 
		}catch(PDOException $e){
			$this->error = $e->getMessage();
			return false; 
		}            
    }

    /**
     *	Exacutes query
     *		@param $query
     */
    public function Exec($query = '')
	{
		$this->affectedRows = $this->dbh->exec($query);		
	}

    /**
     *	Set encoding and collation on database
     *		@param $encoding
     *		@param $collation
     */
    public function SetEncoding($encoding, $collation)
    {		
		if(empty($encoding)) $encoding = "utf8";
        if(empty($collation)) $collation = "utf8_unicode_ci";    
        $sql_variables = array(
                'character_set_client'  =>$encoding,
                'character_set_server'  =>$encoding,
                'character_set_results' =>$encoding,
                'character_set_database'=>$encoding,
                'character_set_connection'=>$encoding,
                'collation_server'      =>$collation,
                'collation_database'    =>$collation,
                'collation_connection'  =>$collation
        );
        foreach($sql_variables as $var => $value){
            $sql = "SET $var=$value;";
            $this->Query($sql);
        }        
    }

    /**
     *	Returns affected rows after exec()
     */
    public function AffectedRows()
    {
		return $this->affectedRows;
    }	

    /**
     *	Returns rows count for query()
     */
    public function RowCount()
    {
		return $this->stm->rowCount(); 
    }		

    /**
     *	Returns last insert ID
     */
	public function InsertID()
    {
		return $this->dbh->lastInsertId();
    }

    /**
     *	Returns error 
     */
    public function Error()
    {
		return $this->error;		
    }
	
    /**
     *	Returns error code
     */
    public function ErrorCode()
    {
		return $this->dbh->errorCode();
    }

    /**
     *	Returns error code
     */
    public function ErrorInfo()
    {
		return $this->sth->errorInfo();
    }
 
 
	//==========================================================================
    // Returns DB instance or create initial connection 
	// 		@param $database_host
	// 		@param $database_name
	// 		@param $database_username
	// 		@param $database_password
	// 		@param $db_driver
	// 		@param $force_encoding
	//==========================================================================
	public static function GetInstance($database_host, $database_name, $database_username, $database_password, $db_driver = "", $force_encoding = false)
	{
		if(!self::$objInstance){
			self::$objInstance = new Database($database_host, $database_name, $database_username, $database_password, $db_driver, $force_encoding);
        }         
        return self::$objInstance; 
	}
	
}
?>