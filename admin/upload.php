<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}
$message = "";
if(isset($_POST['submit'])){
    
    $photo = new Photo();
    $photo->title = $_POST["title"];
    $photo->set_file($_FILES["file_upload"]);

    if($photo->save()){
        $message = "Photo saved successfully";
    }else{
        $message = join("<br>", $photo->errors);
    }
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
                                Uploads
                                <small>Subheading</small>
                            </h1>
                            <div class="col-md-6">    
                            <?php echo $message ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="file" name="file_upload">
                                    </div>

                                    <input type="submit" name="submit">
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

  <?php include("includes/footer.php") ?>