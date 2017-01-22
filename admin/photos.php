<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}


$photos = Photo::find_all();

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
                            
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>ID</th>
                                            <th>Filename</th>
                                            <th>Title</th>
                                            <th>Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($photos as $photo){
                                            echo "<tr>
                                                    <td>
                                                        <img class='admin_photo_thumbnail' src='{$photo->picture_path()}'>
                                                        <div class='pictures_link'>
                                                            <a href= 'delete_photo.php?id={$photo->id}'> Delete </a>
                                                            <a href= 'edit_photo.php?id={$photo->id}'> Edit</a>
                                                            <a href= '#'> View</a>
                                                        </div>
                                                    </td>
                                                    <td>{$photo->id}</td>
                                                    <td>{$photo->filename}</td>
                                                    <td>{$photo->title}</td>
                                                    <td>{$photo->size} </td>
                                                </tr>";
                                        } 
                                        ?>
                                        
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

  <?php include("includes/footer.php"); ?>