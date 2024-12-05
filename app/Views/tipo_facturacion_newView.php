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
        <form action="guardar" method="post"  accept-charset="utf-8" id="form1">
  <?php   $errors = validation_errors();?>
  
            
            <div class="form-group">
    <label for="tipo_facturacion">tipo_facturacion</label>
    <input type="text" class="form-control" id="tipo_facturacion" aria-describedby="tipo_facturacion" placeholder="tipo_facturacion"  name="tipo_facturacion">
     
  </div>
    
  
  <button type="submit" class="btn btn-primary" id="btnSave2">Submit</button>
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
                
                
                $("#form1").validate({
			rules: {
				tipo_facturacion: "required",
			
			},
			messages: {
				tipo_facturacion: "Introducce un tipo de facturación",
				
			},
                    
            submitHandler: function(form){

             let tipo_facturacion=$("#tipo_facturacion").val();
                   
                              $.ajax({
                                type: "POST",
                                  data:{tipo_facturacion:tipo_facturacion},
                                url: "<?php echo baseUrl();?>/tipo_facturacion/guardar",
                                dataType:"html",
                                success: function(respuesta){
                               
                                     $.ajax({
                                    type: "POST",
                                  data:{respuesta:respuesta,controlador:"tipo_facturacion"},
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
               
		}
                    
                    
		});

                
                
              
               $("#btnSave").click(function(){
                       
                     
                        let tipo_facturacion=$("#tipo_facturacion").val();
                   
                              $.ajax({
                                type: "POST",
                                  data:{tipo_facturacion:tipo_facturacion},
                                url: "<?php echo baseUrl();?>/tipo_facturacion/guardar",
                                dataType:"html",
                                success: function(respuesta){
                                    
                                    
                                     $.ajax({
                                    type: "POST",
                                  data:{respuesta:respuesta,controlador:"tipo_facturacion"},
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