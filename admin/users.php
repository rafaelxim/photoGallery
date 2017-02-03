<?php include("includes/header.php"); 
if(!$session->is_signed_in()){
    redirect("login.php");
}


$users = User::find_all();

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
                            <p><?=$session->message ?> </p>
                            <h1 class="page-header">
                                Users                                
                            </h1>
                            <a class="btn btn-primary" href="add_user.php">Add User</a>
                            
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($users as $user){
                                            echo "<tr>
                                                    <td>{$user->id}</td>
                                                    <td>
                                                        <img class='admin_user_thumbnail user_image' src='{$user->image_path_and_placeholder()}'>
                                                        
                                                    </td>
                                                    
                                                    <td>{$user->username}
                                                    <div class='pictures_link'>
                                                            <a href= 'delete_user.php?id={$user->id}'> Delete </a>
                                                            <a href= 'edit_user.php?id={$user->id}'> Edit</a>
                                                            
                                                    </div>
                                                    </td>
                                                    <td>{$user->first_name}</td>
                                                    <td>{$user->last_name} </td>
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