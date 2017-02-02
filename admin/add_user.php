<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}

  if(isset($_POST["create"])){

    $user_object = new User;
    $user_object->username = $_POST["username"];
    $user_object->first_name = $_POST["first_name"];
    $user_object->last_name = $_POST["last_name"];
    $user_object->password = $_POST["password"];

    
    $user_object->set_file($_FILES["user_image"]);
    $user_object->upload_photo();

    $user_object->save();

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

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                USER
                                <small>Add User</small>    
                            </h1>
                                <form action="" method="post" enctype="multipart/form-data">    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="file" name="user_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name">First Name</label>
                                            <input type="text" name="first_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>                                        
                                          <input type="submit" name="create" class="btn btn-primary">
                                    </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

  <?php include("includes/footer.php"); ?>