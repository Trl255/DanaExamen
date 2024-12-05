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
        <form action="#" method="post"  accept-charset="utf-8" enctype="multipart/form-data" id="form1">
  
  <div class="form-group">
    <label for="nombre_comercial">nombre_comercial</label>
    <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" placeholder="nombre_comercial">
  </div>
            
<div class="form-group">
    <label for="razon_social">razon_social</label>
    <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="razon_social">
  </div>
            
 <div class="form-group">
    <label for="cif_nif_nie">cif_nif_nie</label>
    <input type="text" class="form-control" id="cif_nif_nie" name="cif_nif_nie" placeholder="cif_nif_nie">
  </div>
            
<div class="form-group">
    <label for="telefono">telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono">
  </div>
   <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"  name="email">
    
  </div>         
            
   <div class="form-group">
    <label for="persona_contacto">persona_contacto</label>
    <input type="text" class="form-control" id="persona_contacto" aria-describedby="persona_contacto" placeholder="persona_contacto"  name="persona_contacto">
    
  </div>        
            
     <div class="form-group">
    <label for="file_logo">file_logo</label>
    <input type="file" class="form-control" id="file_logo" aria-describedby="file_logo" name="file_logo">
    
  </div>
            
            <div class="form-group">      
      <label for="id_tipo_facturacion">Tipo facturacion</label>
            <?php
echo form_dropdown('id_tipo_facturacion',$optionsTipoFacturacion,set_value('id_tipo_facturacion'), 'class="form-control" id="id_tipo_facturacion"');
            ?>
           
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
				nombre_comercial: {
					required: true,
					minlength: 2
				},
                cif_nif_nie:{
					required: true,
					nifES: true,
                    maxlength:25
				},
			
			},
			messages: {
				nombre_comercial: "Introducce un nombre comercial",
                cif_nif_nie: "Introducce un cif_nif_nie",
				
			},
                    
            submitHandler: function(form){

             let formData = new FormData($('#form1')[0]);
                   
                              $.ajax({
                                cache: false,
                                contentType: false,
                                processData: false,
                                type: "POST",
                                data:formData,
                                url: "<?php echo baseUrl();?>/comercios/guardar",
                                dataType:"html",
                                success: function(respuesta){
                               
                                     $.ajax({
                                    type: "POST",
                                  data:{respuesta:respuesta,controlador:"comercios"},
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
                     
               var formData = new FormData($('#form1')[0]);
                              $.ajax({
                                cache: false,
                                contentType: false,
                                processData: false,
                                type: "POST",
                                data:formData,
                                url: "<?php echo baseUrl();?>/comercios/guardar",
                                dataType:"html",
                                success: function(respuesta){
                                   alert(respuesta);
                                     $.ajax({
                                    type: "POST",
                                  data:{respuesta:respuesta,controlador:"comercios"},
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