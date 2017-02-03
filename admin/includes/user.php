<?php 
class User extends Db_object{

	protected static $db_table_fields = array("username", "password", "first_name", "last_name", "user_image");
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $upload_directory = "images";
	public $errors = array();
	public $image_placeholder = "http://placehold.it/400x400&text=image";

	protected static $db_table = "users";
	public $upload_errors_array = array(
			UPLOAD_ERR_OK => "There is no Error",
			UPLOAD_ERR_INI_SIZE => "The file is too Big",
			UPLOAD_ERR_FORM_SIZE=> "Max_file_size exceded",
			UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
			UPLOAD_ERR_NO_FILE => "No file was uploaded",
			UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder", 
			UPLOAD_ERR_CANT_WRITE => "Failed to write on the disk",
			UPLOAD_ERR_EXTENSION => "A PHP extension stoped the file upload"
		);

	


	public function set_file($file){
		//Checka os possiveis erros no upload
		if(empty($file) || !$file || !is_array($file)){

			$this->errors[] = "There was no files uploads here";
			return false;
		}else if($file["error"] != 0){

			$this->errors[] = $this->upload_errors_array[$file["error"]];
			return false;
		}else{
			//Seta as propriedades
			$this->user_image = basename($file["name"]);
			$this->size = $file["size"];
			$this->type = $file["type"];
			$this->tmp_path = $file["tmp_name"];
		}
	}

	public function upload_photo(){
			if(!empty($this->errors)){
				return false;
			}

			if(empty($this->user_image) || empty($this->tmp_path)){
				$this->errors[] = "The file was not available";
			}

			$target_path = SITE_ROOT.DS."admin".DS.$this->upload_directory.DS.$this->user_image;

			if(file_exists($target_path)){

				$this->errors[] = "This file already exists";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)){

					unset($this->tmp_path);
					return true;				
			}else{
					$this->errors[] = "The file directory does not have the right permissions";
					return false;
				}


	}


	public function image_path_and_placeholder(){
		return (empty($this->user_image)) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
	}

	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * from ".self::$db_table." WHERE username = '{$username}' AND password = '{$password}'";
		$result_array = self::find_by_query($sql);
		return !empty($result_array) ? array_shift($result_array) : false ;	
	}

	public function ajax_save_user_image($user_image, $user_id){

		global $database;

		$this->user_image = $user_image;
		$this->id = $user_id;
		
		$sql = "UPDATE users SET user_image = '{$this->user_image}' 
		 WHERE id = {$this->id} ";

		$update_image = $database->query($sql);

		echo $this->image_path_and_placeholder();
	}
	
}// End of Class User



 ?>