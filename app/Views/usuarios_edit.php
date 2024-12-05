<!DOCTYPE html>
<html lang="en">
    <?php include("head.php");?>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include("menu.php");?>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php include("topbar.php");?>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">Zoogler</a></li>
                                                <li class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Dashboard</h4>
                                    </div>
                                </div>
                            </div>
    
<!-- SELECT `id_user`, `act_user`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at` FROM `users` WHERE 1-->    
<div class="row mt-3">
     <div class="col-4">
        <form action="guardar" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"  name="email" value="<?php echo $user["email"];?>">
    
  </div>
  <div class="form-group">
    <label for="firstname">firstname</label>
    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="name" value="<?php echo $user["firstname"];?>">
  </div>
            
 <div class="form-group">
    <label for="lastname">lastname</label>
    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" value="<?php echo $user["lastname"];?>">
  </div>
            
<div class="form-group">
    <label for="password">password</label>
    <input type="text" class="form-control" id="password" name="password" placeholder="password">
  </div>
            
            <div class="form-group">
    <label for="act_user">Activo</label>
    <input type="number " class="form-control" id="act_user" name="act_user" placeholder="act_user">
  </div>
            
    <div class="form-group">      
      <label for="id_roles">Role</label>
            <?php
echo form_dropdown('id_roles',$optionsRoles,$user["id_roles"], 'class="form-control" id="id_roles"');
            ?>
           
            </div> 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    
    </div>
  </div>
                            
                            <!-- end row -->
                            
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <footer class="footer">
                    © 2022 Zoogler by Mannatthemes.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        
        <?php include("scripts.php");?>
        
        
        

    </body>
</html>
