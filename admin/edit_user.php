<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}

  $user_object = new User;
  $user_object = User::find_by_id($_GET["id"]);

  if(isset($_POST['update'])){

    $user_object->username = $_POST['username'];
    $user_object->first_name = $_POST['first_name'];
    $user_object->last_name = $_POST['last_name'];
    $user_object->password = $_POST['password'];

    if(empty($_FILES["user_image"])){
      $user_object->save();
    }else{

      $user_object->set_file($_FILES["user_image"]);
      $user_object->upload_photo();  
      $user_object->save();  
    }    
  }

  if(isset($_GET["id"])){    
    
    $username = $user_object->username;
    $first_name = $user_object->first_name;
    $last_name = $user_object->last_name;
    $password = $user_object->password;
    $image = $user_object->image_path_and_placeholder();
    
  }else{
    redirect("users.php");
  }
?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include("includes/top_nav.php"); ?>

            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                
                <?php include('includes/photo_library_modal.php'); ?>

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                            USERS
                                <small>Edit User</small>
                            </h1>
                                <form action="" method="post" enctype="multipart/form-data">   
                                    <div class="col-md-6 user_image_box">
                                        <a data-toggle="modal" data-target="#photo-modal" href=""><img class="img-responsive" src="<?=$image?> "></a>
                                    </div> 

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <input type="file" name="user_image">
                                        </div>                                       
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" class="form-control" value="<?=$username?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name">First Name</label>
                                            <input value="<?=$first_name?>" type="text" name="first_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input value="<?=$last_name?>" type="text" name="last_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" value="<?=$password?>" name="password" class="form-control">
                                        </div>                                        
                                          <input type="submit" name="update" class="btn btn-primary" value="Update">
                                          <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?=$user_object->id?>">Delete</a>
                                    </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

  <?php include("includes/footer.php"); ?>