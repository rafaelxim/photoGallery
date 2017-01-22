<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}



if(isset($_GET["id"])){

    $photo_object = Photo::find_by_id($_GET["id"]);

    if(isset($_POST["update"])){
    
        $photo_object->title = $_POST["title"];
        $photo_object->caption = $_POST["caption"];
        $photo_object->alternate_text = $_POST["alternate_text"];
        $photo_object->description = $_POST["description"];
        $photo_object->save();
    }
    
     
}else{
    redirect("photos.php");
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
                                Photos
                                <small>Subheading</small>
                            </h1>
                                <form action="" method="post">    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control" value="<?=$photo_object->title  ?>">
                                        </div>

                                        <div class="form-group">
                                            <a class="thumbnail" href="#"><img src="<?= $photo_object->picture_path(); ?> " alt=""></a>
                                        </div>

                                        <div class="form-group">
                                            <label for="caption">Caption</label>
                                            <input type="text" name="caption" class="form-control" value="<?=$photo_object->caption  ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="alternate_text">Alternate Text</label>
                                            <input type="text" name="alternate_text" class="form-control" value="<?=$photo_object->alternate_text  ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" cols="30" rows="15" class="form-control"><?=$photo_object->description  ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4" >
                                        <div  class="photo-info-box">
                                            <div class="info-box-header">
                                               <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                            </div>
                                        <div class="inside">
                                          <div class="box-inner">
                                             <p class="text">
                                               <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                              </p>
                                              <p class="text ">
                                                Photo Id: <span class="data photo_id_box">34</span>
                                              </p>
                                              <p class="text">
                                                Filename: <span class="data">image.jpg</span>
                                              </p>
                                             <p class="text">
                                              File Type: <span class="data">JPG</span>
                                             </p>
                                             <p class="text">
                                               File Size: <span class="data">3245345</span>
                                             </p>
                                          </div>
                                          <div class="info-box-footer clearfix">
                                            <div class="info-box-delete pull-left">
                                                <a  href="delete_photo.php?id=<?php echo $_GET["id"] ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                            </div>
                                            <div class="info-box-update pull-right ">
                                                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                            </div>   
                                          </div>
                                        </div>          
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

  <?php include("includes/footer.php"); ?>