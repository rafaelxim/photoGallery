<?php 
class User{

	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;

	public static function instantiation($the_record){
		$the_object             = new self;
        /*$the_object->username   = $result['username'];
        $the_object->first_name = $result['first_name'];
        $the_object->last_name  = $result['last_name'];
        $the_object->password   = $result['password'];
        $the_object->id         = $result['id']; */ 

        foreach ($the_record as $attribute => $value) {
             	if($the_object->has_the_attribute($attribute)){
             		$the_object->attribute = $value;
             	}
             }     

        return $the_object;
	}

	public static function find_all_users(){
		return self::find_this_query("select * from users");

	}

	public static function find_user_by_id($id){
		$result_set= self::find_this_query("select * from users where id={$id}");
		$result = mysqli_fetch_array($result_set);
		return $result;	
				
	}

	public static function find_this_query($sql){
		global $database;
		$result_set = $database->query($sql);
		return $result_set;
	}

	private function has_the_attribute($attribute){
		$obj_properties = get_object_vars($this); //pega todos os atributos da classe e joga num array
		return array_key_exists($attribute, $obj_properties); // verifica se a array tem o $attribute
	}
}



 ?>