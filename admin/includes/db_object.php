<?php 

/**
* AQUI, É USADO static:: pois está na classe PAI se for usado self::, vai dar erro
quando o método ou propriedade for chamada na classe filho.
*/
class Db_object {

	public static function find_all(){
		return static::find_by_query("select * from ".static::$db_table." " );

	}

	//Acha os dados segundo o id passado e retorna o OBJETO já com os atributos setados
	public static function find_by_id($id){
		$result_array= static::find_by_query("select * from ".static::$db_table." where id={$id}");

		return !empty($result_array) ? array_shift($result_array) : false ;		
	}

	//Retorna um OBJETO com as colunas definidas pelo SQL passado
	public static function find_by_query($sql){
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();

		while($row = mysqli_fetch_array($result_set)){
			$object_array[] = static::instantiation($row);
		}
		return $object_array;

	}




	//Instancia o resultado de uma fetch_array, criando um objeto com os atributos setados.
	public static function instantiation($the_record){

		$calling_class = get_called_class();
		$the_object = new $calling_class;
        
        foreach ($the_record as $attribute => $value) {
             	if($the_object->has_the_attribute($attribute)){
             		$the_object->$attribute = $value;
             	}
             }     

        return $the_object;
	}

	//Verifica se o objeto tem determinada propriedade
	private function has_the_attribute($attribute){
		$obj_properties = get_object_vars($this); //pega todos os atributos da classe e joga num array
		return array_key_exists($attribute, $obj_properties); // verifica se a array tem o $attribute
	}


	//Retorna uma array com as propriedades definidas em db_table_fields
	protected function properties(){
		//return get_object_vars($this);
		$properties = array();
		foreach (static::$db_table_fields as $db_field) {
			if(property_exists($this, $db_field)){
				$properties[$db_field] = $this->$db_field;
			}
		}
		return $properties;
	}

	//Limpa as propriedades com escape_string
	protected function clean_properties(){
		global $database;
		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			$clean_properties[$key] =$database->escape_string($value) ;
		}

		return $clean_properties;

	}

	public function create(){
		global $database;

		$properties = $this->clean_properties();

		$sql = "INSERT INTO ".static::$db_table."(". implode(", ", array_keys($properties)).")";
		$sql.= "VALUES (";
		$sql.= "'".implode("', '", array_values($properties))."'";
		$sql.= " )";
		if($database->query($sql)){
			$this->id = $database->the_inserted_id();
			return true;

		}else{

			return false;

		}
	}

	public function update(){
		global $database;
		$properties= $this->clean_properties();
		$properties_pair = array();

		foreach ($properties as $key => $value) {
			$properties_pair[] = "{$key} = '{$value}'";
		}

		$sql = "UPDATE  ".static::$db_table."  SET ";
		$sql .= implode(", ", $properties_pair);
		$sql.=" WHERE id = ".$this->id ;
		
		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
	}

	public function delete(){
		global $database;
		$sql = "DELETE FROM  ".static::$db_table."  ";
		$sql .= "WHERE id = {$this->id}";
		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false ;

	}

	public function save(){
		(isset($this->id)) ? $this->update() : $this->create();
	}

	public static function count_all(){

		global $database;
		$sql = "SELECT COUNT(*) FROM ".static::$db_table;
		$result_set = $database->query($sql);
		$row = mysqli_fetch_array($result_set);

		return array_shift($row);

	} 
	
}// class bracket


 ?>