 <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

                        <?php

                        /*$users= User::find_all_users();                            
                        foreach ($users as $user) {
                        echo $user->username. "<br>";
                        }*/

                        /*FIND USER BY ID */
                        /*$result_set = User::find_user_by_id(2);                             
                        $objuser = User::instantiation($result_set);                            
                        echo $objuser->id;*/

                        $user = new User();
                        
                        $user->id = 9;

                        $user->delete();



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