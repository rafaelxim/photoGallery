<?php include("admin/includes/header.php"); ?>
<?php

include("includes/header.php");
$photos = Photo::find_all();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();

?>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

            <div class="thumbnails row">
                <?php foreach ($photos as $photo): ?>
                    
                        <div class="col-xs-6 col-md-3">
                            <a href="photo.php?id=<?=$photo->id ?>" class="thumbnail">
                                <img class="img-responsive front-img" src="admin/<?=$photo->picture_path(); ?>" alt="">

                            </a>
                        </div>
                <?php endforeach; ?>
            </div>

            </div>


        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
