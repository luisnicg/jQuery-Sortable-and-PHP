<?php


class cbSQLConnectConfig extends PDO {
	
	 	protected $actualStatement;
		
		protected static $qs;
		protected static $user;
		protected static $pwd;
		protected static $options; 
		protected static $fetchMode;
	 	protected static $driverDB;
		
		public function __construct($driver, $host, $port = 3306, $database, $user, $pwd, $options = array()){
			
			cbSQLConnectConfig::$qs =  $this->ConnectionStringGenerator($driver, $host, $port, $database);
			cbSQLConnectConfig::$user = $user;
			cbSQLConnectConfig::$pwd = $pwd;
			cbSQLConnectConfig::$options = $options;
			
			
			parent::__construct(cbSQLConnectConfig::$qs, cbSQLConnectConfig::$user, cbSQLConnectConfig::$pwd, cbSQLConnectConfig::$options);
			
			
		}
		
		public static function CreatePDOInstance(){
			
			
			
			return new PDO( cbSQLConnectConfig::$qs,  cbSQLConnectConfig::$user,  cbSQLConnectConfig::$pwd,  cbSQLConnectConfig::$options);
			
		}
		
		protected function getConnectionString(){
			return $this->qs;
		}
		
		public function getTable(){
			
		
			preg_match("/dbname=([aA-zZ0-9]+)/", $this->qs, $mt);
			
			return $mt[1];
		
		}
		
		private  function ConnectionStringGenerator($driver, $host, $port, $database){
			
			switch( (int) $driver){
			
			 case cbSQLConnectVar::DB_MYSQL:
			 cbSQLConnectConfig::$driverDB = "mysql";
			 break;
			 
			 case cbSQLConnectVar::DB_POSTGRE:
			 cbSQLConnectConfig::$driverDB = "psgre";
			 
			 default:
			 cbSQLConnectConfig::$driverDB = "mysql";
			 break;
			 
			}
			
			
			$connectionstring = sprintf("%s:host=%s;port=%d;dbname=%s", cbSQLConnectConfig::$driverDB, $host, $port, $database);
			
			return $connectionstring;
			
			
		}

	
}




?>