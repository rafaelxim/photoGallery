 <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

                        <?php

                        $user = User::find_by_id(10);
                        echo $user->username;

                        /*$users= User::find_all();                            
                        foreach ($users as $user) {
                        echo $user->username. "<br>";
                        }*/

                        /*FIND USER BY ID */
                        /*$result_set = User::find_user_by_id(2);                             
                        $objuser = User::instantiation($result_set);                            
                        echo $objuser->id;*/

                        /*$user = new User();
                        $user->username = "Cana";
                        $user->first_name = "João";
                        $user->last_name = "Canalha";
                        $user->password = "7";
                        //$user->id =12 ; 
                        $user->create();*/

                        /*$photos = Photo::find_all();
                        foreach ($photos as $photo) {
                            echo $photo->title;
                        }*/

                        /*$photo = new Photo();
                        $photo->title = "Cana da Boa";
                        $photo->description = "Caninha da Roça exportada da região noroeste da Venezuela";
                        $photo->size = 200;
                        $photo->type = "jpeg";
                        $photo->filename = "cana.jpeg";
                        
                        $photo->create();*/

                        echo INCLUDE_PATH;

                        ?>


                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->