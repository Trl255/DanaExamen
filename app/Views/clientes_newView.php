<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("menu.php"); ?>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <?php include("topbar.php"); ?>
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

                        <!-- `id_clientes`, `nombre_comercial`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `id_provincias`, `id_localidades`, `direccion`, `numero`, 
                         `piso`, `escalera`, `cp`, `telefono`, `email`, `id_operadores`, `atendido`, `created_at`, `updated_at`  -->
                        <div class="row mt-3">
                            <div class="col-4">

                                <form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form1">

                                    <div class="form-group">
                                        <label for="id_clientes">id_clientes</label>
                                        <input type="text" class="form-control" id="id_clientes" name="id_clientes" placeholder="id_clientes">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_comercial">nombre_comercial</label>
                                        <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" placeholder="Introduzca nombre comercial">
                                    </div>

                                    <div class="form-group">
                                        <label for="razon_social">razon_social</label>
                                        <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Introduzca razon social">
                                    </div>

                                    <div class="form-group">
                                        <label for="cif_nif_nie">cif_nif_nie</label>
                                        <input type="text" class="form-control" id="cif_nif_nie" name="cif_nif_nie" placeholder="Introduzca su cif nif nie">
                                    </div>

                                    <div class="form-group">
                                        <label for="telefono">telefono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduzca su telefono">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="telefono">

                                    </div>

                                    <div class="form-group">
                                        <label for="id_provincias">id_provincias</label>
                                        <input type="text" class="form-control" id="id_provincias" aria-describedby="id_provincias" placeholder="id_provincias" name="id_provincias">

                                    </div>
                                    <div class="form-group">
                                        <label for="id_operadores">id_operadores</label>
                                        <input type="text" class="form-control" id="id_operadores" aria-describedby="id_operadores" placeholder="id_operadores" name="id_operadores">

                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="file_logo">file_logo</label>
                                        <input type="file" class="form-control" id="file_logo" aria-describedby="file_logo" name="file_logo">

                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label for="id_tipo_facturacion">Tipo facturacion</label>
                                        <?php
                                        //      echo form_dropdown('id_tipo_facturacion', $optionsTipoFacturacion, set_value('id_tipo_facturacion'), 'class="form-control" id="id_tipo_facturacion"');
                                        ?>

                                    </div> -->


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


    <?php include("scripts.php"); ?>
    <script>
        $(document).ready(function() {
            $("#form1").validate({
                rules: {
                    id_operadores: {
                        required: true,

                    },


                },
                messages: {
                    id_operadores: "Introducce un nombre de id_operadores",

                },

                submitHandler: function(form) {

                    let formData = new FormData($('#form1')[0]);

                    $.ajax({
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formData,
                        url: "<?php echo baseUrl(); ?>/clientes/guardar",
                        dataType: "html",
                        success: function(respuesta) {

                            $.ajax({
                                type: "POST",
                                data: {
                                    respuesta: respuesta,
                                    controlador: "clientes"
                                },
                                url: "<?php echo baseUrl(); ?>/infoAccion",
                                dataType: "html",
                                success: function(respuesta) {
                                      //alert(respuesta);
                                    $('body').append(respuesta);


                                }
                            });

                        }



                    });

                }


            });








            $("#btnSave").click(function() {

                var formData = new FormData($('#form1')[0]);
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "POST",
                    data: formData,
                    url: "<?php echo baseUrl(); ?>/clientes/guardar",
                    dataType: "html",
                    success: function(respuesta) {
                        //alert(respuesta);
                        $.ajax({
                            type: "POST",
                            data: {
                                respuesta: respuesta,
                                controlador: "clientes"
                            },
                            url: "<?php echo baseUrl(); ?>/info",
                            dataType: "html",
                            success: function(respuesta) {
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