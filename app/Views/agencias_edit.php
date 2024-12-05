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
                            
                            
                            
                            <!-- end page title end breadcrumb -->
                            
                            
                            <div class="row mt-3">
     <div class="col-4">
         
        <form action="actualizar" method="post"  accept-charset="utf-8">
    <input type="hidden" id="id" name="id"   value="<?php echo $ag["id"];?>">        
            
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"  name="email" value="<?php echo $ag["email"];?>">
    
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="name"  value="<?php echo $ag["name"];?>">
  </div>
  
  <button type="button" class="btn btn-primary" id="btnEdit">Submit</button>
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
        
        <script>
        
            $( document ).ready(function() {
                
              
               $("#btnEdit").click(function(){
                        let id=$("#id").val();
                        let email=$("#email").val();
                        let name=$("#name").val();
                   
                              $.ajax({
                                type: "POST",
                                  data:{id:id,email:email,name:name},
                                url: "<?php echo baseUrl();?>/agencias/actualizar",
                                dataType:"html",
                                success: function(respuesta){
                                    
                                    
                                     $.ajax({
                                    type: "POST",
                                  data:{respuesta:respuesta,controlador:"agencias"},
                                url: "<?php echo baseUrl();?>/info",
                                dataType:"html",
                                success: function(respuesta){
                                  //  alert(respuesta);
                                    $('body').append(respuesta);
                                   
                                            }
                                        });
                                    
                                    
                                    
                                  //  alert(respuesta);
                                    //$('body').append(respuesta);
                                    
                              
                                }
                            
                       
                
                });  
               
               
                
            });
                  });
        </script>

    </body>
</html>