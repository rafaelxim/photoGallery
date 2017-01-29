<?php 

/**
* 
*/
class Photo extends Db_object
{

	protected static $db_table_fields = array("title", "description", "filename", "type", "size", "alternate_text", "caption");
	public $id;
	public $title;
	public $description;
	public $filename;
	public $type;
	public $size;
	public $alternate_text;
	public $caption;

	protected static $db_table = "photo";

	public $tmp_path;
	public $upload_directory = "images";
	public $errors = array();
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
			$this->filename = basename($file["name"]);
			$this->size = $file["size"];
			$this->type = $file["type"];
			$this->tmp_path = $file["tmp_name"];
		}
	}

	public function picture_path(){

		return $this->upload_directory.DS. $this->filename;
	}

	public function save(){

		if($this->id){

			$this->update();
		}else{

			if(!empty($this->errors)){
				return false;
			}

			if(empty($this->filename) || empty($this->tmp_path)){
				$this->errors[] = "The file was not available";
			}

			$target_path = SITE_ROOT.DS."admin".DS.$this->upload_directory.DS.$this->filename;

			if(file_exists($target_path)){

				$this->errors[] = "This file already exists";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)){
				if($this->create()){
					unset($this->tmp_path);
					return true;
				}else{
					$this->errors[] = "The file directory does not have the right permissions";
					return false;
				}
			}
		}
	}

	public function delete_photo(){
		if($this->delete()){

			$target_path = SITE_ROOT.DS."admin".DS. $this->picture_path();
			return unlink($target_path) ? true : false ; 
		}else{

			return false;
		}
	}

}//class End

 ?>