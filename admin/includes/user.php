<?php 
class User{

	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;
	protected static $db_table = "users";

	public static function instantiation($the_record){
		$the_object = new self;
        
        foreach ($the_record as $attribute => $value) {
             	if($the_object->has_the_attribute($attribute)){
             		$the_object->$attribute = $value;
             	}
             }     

        return $the_object;
	}

	public static function find_all_users(){
		return self::find_this_query("select * from users");

	}

	public static function find_user_by_id($id){
		$result_array= self::find_this_query("select * from users where id={$id}");

		return !empty($result_array) ? array_shift($result_array) : false ;		
	}

	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * from users WHERE username = '{$username}' AND password = '{$password}'";
		$result_array = self::find_this_query($sql);
		return !empty($result_array) ? array_shift($result_array) : false ;	
	}

	public static function find_this_query($sql){
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();

		while($row = mysqli_fetch_array($result_set)){
			$object_array[] = self::instantiation($row);
		}
		return $object_array;

	}

	private function has_the_attribute($attribute){
		$obj_properties = get_object_vars($this); //pega todos os atributos da classe e joga num array
		return array_key_exists($attribute, $obj_properties); // verifica se a array tem o $attribute
	}

	public function create(){
		global $database;
		$sql = "INSERT INTO ".self::$db_table." (username, password, first_name, last_name) ";
		$sql.= "VALUES ('";
		$sql.= $database->escape_string($this->username). "', '";
		$sql.= $database->escape_string($this->password). "', '";
		$sql.= $database->escape_string($this->first_name). "', '";
		$sql.= $database->escape_string($this->last_name). "')";


		if($database->query($sql)){
			$this->id = $database->the_inserted_id();
			return true;

		}else{

			return false;

		}
	}

	public function update(){
		global $database;
		$sql = "UPDATE  ".self::$db_table."  SET 
		username='".$database->escape_string($this->username)."', 
		password='".$database->escape_string($this->password)."', 
		first_name='".$database->escape_string($this->first_name)."', 
		last_name='".$database->escape_string($this->last_name)."'" ;
		$sql.=" WHERE id = ".$this->id ;
		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
	}

	public function delete(){
		global $database;
		$sql = "DELETE FROM  ".self::$db_table."  ";
		$sql .= "WHERE id = {$this->id}";
		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false ;

	}

	public function save(){
		(isset($this->id)) ? $this->update() : $this->create();
	}


}// End of Class User



 ?>