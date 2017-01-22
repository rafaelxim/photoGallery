<?php 
class User extends Db_object{

	protected static $db_table_fields = array("username", "password", "first_name", "last_name");
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	protected static $db_table = "users";

	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * from ".self::$db_table." WHERE username = '{$username}' AND password = '{$password}'";
		$result_array = self::find_by_query($sql);
		return !empty($result_array) ? array_shift($result_array) : false ;	
	}
	
}// End of Class User



 ?>