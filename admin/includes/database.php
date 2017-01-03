<?php 
require_once("new_config.php");

class Database {
	public $connection;

	function __construct(){
		$this->open_db_connection();
	}

	public function open_db_connection(){	
		$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(mysqli_connect_errno()){
			die("Connection Failed: ". mysqli_error());
		}
	}

	public function query($sql){
		$result= mysqli_query($this->connection, $sql);
		
		return $result;
	}

	public function confirm_query($result){
		if(!$result){
			die("Query Failed");
		}
	}
}

$database = new Database();



?>