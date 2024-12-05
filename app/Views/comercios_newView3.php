<!DOCTYPE html>
<html lang="en">
    <?php include("head.php");?>
<style>
    
    .help-block{
        color:#ff0000;
    }    
</style>

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
         
          <?= validation_list_errors() ?>
         <?= set_value('id_tipo_facturacion'); 
         
          $errors = validation_errors();
         
         if (isset($fichero)) {
         var_dump($fichero);
         }
       
         ?>
        
        <form action="guardar3" method="post"  accept-charset="utf-8" enctype="multipart/form-data" id="form1">
  
  <div class="form-group">
    <label for="nombre_comercial">nombre_comercial</label>
    <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" placeholder="nombre_comercial"  value="<?= set_value('nombre_comercial') ?>">
       <?php
       
        if (isset($errors['nombre_comercial'])) {?>
           <?php echo validation_show_error('nombre_comercial');?>
        <?php }
        ?>
  </div>
            
<div class="form-group">
    <label for="razon_social">razon_social</label>
    <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="razon_social" value="<?= set_value('razon_social') ?>">
    <?php if (isset($errors['razon_social'])) {?>
            <span class="text-danger"><?php echo validation_show_error('razon_social');?></span>
        <?php }
        ?>
  </div>
            
 <div class="form-group">
    <label for="cif_nif_nie">cif_nif_nie</label>
    <input type="text" class="form-control" id="cif_nif_nie" name="cif_nif_nie" placeholder="cif_nif_nie" value="<?= set_value('cif_nif_nie') ?>">
     <?php if (isset($errors['cif_nif_nie'])) {?>
            <span class="text-danger"><?php echo validation_show_error('cif_nif_nie');?></span>
        <?php }
        ?>
  </div>
            
<div class="form-group">
    <label for="telefono">telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono" value="<?= set_value('telefono') ?>">
    <?php if (isset($errors['telefono'])) {?>
            <span class="text-danger"><?php echo validation_show_error('telefono');?></span>
        <?php }
        ?>
  </div>
   <div class="form-group">
    <label for="email">Email address</label>
    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"  name="email" value="<?= set_value('email') ?>">
    <?php if (isset($errors['email'])) {?>
            <span class="text-danger"><?php echo validation_show_error('email');?></span>
        <?php }
        ?>
  </div>         
            
   <div class="form-group">
    <label for="persona_contacto">persona_contacto</label>
    <input type="text" class="form-control" id="persona_contacto" aria-describedby="persona_contacto" placeholder="persona_contacto"  name="persona_contacto" value="<?= set_value('persona_contacto') ?>">
    
  </div>        
    <img src="<?php echo $fichero->path;?>"> 
    <div class="form-group">
    <label for="file_logo">file_logo</label>
    <input type="file" class="form-control" id="file_logo" aria-describedby="file_logo" name="file_logo" value="<?= $fichero->path?>">
    <?= form_error('file_logo'); ?>
         <hr>
       <?php if (isset($errors['file_logo'])) {?>
            <span class="text-danger"><?php echo validation_show_error('file_logo');?></span>
        <?php }
        ?>  
        
         
  </div>
            
           <?php //echo form_upload('file_logo',"LOGO",'class="form-control" id="id_tipo_facturacion"')?>
            
<div class="form-group">      
      <label for="id_tipo_facturacion">Tipo facturacion</label>
            <?php
echo form_dropdown('id_tipo_facturacion',$optionsTipoFacturacion,set_value('id_tipo_facturacion'), 'class="form-control" id="id_tipo_facturacion"');
            ?>
           
            </div> 
            
           
  <button type="submit" class="btn btn-primary" id="btnSave">Submit</button>
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