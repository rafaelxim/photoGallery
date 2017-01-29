<?php 

/**
* 
*/
class Comment extends Db_object
{

	protected static $db_table_fields = array("author", "photo_id", "body");
	public $id;
	public $photo_id;
	public $author;
	public $body;


	protected static $db_table = "comments";

	public static function create_comment($photo_id, $author, $body){

		if(!empty($photo_id) && !empty($author) && !empty($body)){

			$comment = new Comment;
			$comment->photo_id = $photo_id;
			$comment->author = $author;
			$comment->body = $body;

			return $comment;
		}else{
			return false;
		}

	}

	public static function find_comments($photo_id = 0){

		global $database;

		$sql = "SELECT * FROM comments WHERE photo_id =". $database->escape_string($photo_id)." ORDER BY photo_id ASC"; 
		return self::find_by_query($sql);
	} 
}//class End

 ?>