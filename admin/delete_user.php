<?php 
require_once("includes/init.php");
if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php 
if(empty($_GET["id"])) {
	redirect("users.php");
}

$user = User::find_by_id($_GET["id"]);

if($user){

	$user->delete();
        $msg = "<div class='alert alert-danger'>
                <strong>Deleted!</strong> User deleted.
              </div>";
        $session->message($msg);
        
	redirect("users.php");
}else{
	redirect("users.php");
}




 ?>
