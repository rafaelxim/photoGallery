<?php include("admin/includes/header.php"); ?>
<?php

include("includes/header.php");
//$photos = Photo::find_all();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql= "SELECT * FROM photo 
LIMIT {$items_per_page} 
OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);




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

            <div class="row">
             <div class="text-center">
                    <ul class="pagination pagination-centered">
                        <?php
                        if($paginate->page_total() > 1){


                            if($paginate->has_previous()){
                                echo "<li class= 'previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                            }else{
                                echo "<li class='disabled previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                            }


                            for ($i=1; $i<=$paginate->page_total() ; $i++) { 
                                
                                if($i == $paginate->current_page){
                                    echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                                }else{
                                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                                }
                            }

                            if($paginate->has_next()){
                                echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                            }else{
                                echo "<li class='disabled next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                            }
                        }

                          ?>
                    </ul>
                </div>
            </div>

            </div>


        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
