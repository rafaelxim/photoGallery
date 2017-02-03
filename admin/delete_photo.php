<?php 
require_once("includes/init.php");
if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php 
if(empty($_GET["id"])) {
	redirect("photos.php");
}

$photo = Photo::find_by_id($_GET["id"]);

if($photo){

	$photo->delete_photo();
        $msg = "<div class='alert alert-danger'>
                <strong>Success ! </strong> Photo deleted.
              </div>" ; 
        $session->message($msg);
	redirect("photos.php");
}else{
	redirect("photos.php");
}




 ?>
