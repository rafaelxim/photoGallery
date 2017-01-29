<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}


$comments = Comment::find_all();

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
                                Comments                                
                            </h1>
                                                        
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($comments as $comment){
                                            echo "<tr>
                                                    <td>{$comment->id}</td>
                                                    <td>{$comment->author}</td>
                                                    <td>{$comment->body}
                                                    <p><a href='delete_comment.php?id={$comment->id}'>Delete Comment</a> </p>
                                                    </td>
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