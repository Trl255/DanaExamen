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

                        <?php var_dump($tipo_facturacion); ?>

                        <div class="row mt-3">
                            <a href="tipo_facturacion/nuevo" class="btn btn-info">Nuevo</a>
                            &nbsp;<a href="tipo_facturacion/nuevo2" class="btn btn-info">Nuevo 2</a>
                            <hr>
                            <form id="form-upload-tipo_facturacion" method="post" autocomplete="off">
                                <div class="sub-result"></div>
                                <div class="form-group">
                                    <label class="control-label">Choose File <small class="text-danger">*</small></label>
                                    <input type="file" class="form-control form-control-sm" id="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    <small class="text-danger">Upload excel or csv file only.</small>
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <div class="user-loader" style="display: none; ">
                                            <i class="fa fa-spinner fa-spin"></i> <small>Please wait ...</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="btnUpload">Upload</button>
                                </div>
                            </form>
                            <a href="tipo_facturacion/exportar" class="btn btn-warning">Exportar</a>


                            <table class="table table-bordered" id="agencies">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($tipo_facturacion): ?>
                                        <?php foreach ($tipo_facturacion as $tipo): ?>
                                            <tr id="fila<?php echo $tipo['id']; ?>">
                                                <td><?php echo $tipo['id']; ?></td>
                                                <td><?php echo $tipo['tipo_facturacion']; ?></td>

                                                <td><a href="<?php echo baseUrl(); ?>/tipo_facturacion/editar?id=<?php echo $tipo['id']; ?>"><i class="fa-solid fa-pen-fancy"></i></a>
                                                    &nbsp;<a href="<?php echo baseUrl(); ?>/tipo_facturacion/editar2?id=<?php echo $tipo['id']; ?>"><i class="fa-solid fa-pen-fancy text-info"></i></a>
                                                    <a href="#" id="eliminar<?php echo $tipo['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                    <a href="#" id="eliminar2<?php echo $tipo['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>

                                                    <a href="<?php echo baseUrl(); ?>/tipo_facturacion/imprimir?id=<?php echo $tipo['id']; ?>"><i class="fa-solid fa-print"></i></a>
                                                </td>
                                            </tr>
                                            <script>
                                                $(document).ready(function() {

                                                    $("#eliminar<?php echo $tipo['id']; ?>").click(function() {
                                                        Swal.fire({
                                                            title: "Are you sure?",
                                                            text: "You won't be able to revert this!",
                                                            icon: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#3085d6",
                                                            cancelButtonColor: "#d33",
                                                            confirmButtonText: "Yes, delete it!"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {

                                                                $.ajax({
                                                                    type: "GET",
                                                                    data: {
                                                                        id: <?php echo $tipo['id']; ?>
                                                                    },
                                                                    url: "<?php echo baseUrl(); ?>/tipo_facturacion/eliminar",
                                                                    dataType: "html",
                                                                    success: function(respuesta) {

                                                                        //si la solicitud es hecha éxitosamente entonces la respuesta representa los datos
                                                                        if (respuesta == 1) {
                                                                            Swal.fire({
                                                                                title: "Deleted!",
                                                                                text: "Your file has been deleted.",
                                                                                icon: "success"
                                                                            });
                                                                        }
                                                                    }
                                                                });



                                                            }
                                                        });

                                                    });

                                                    $("#eliminar2<?php echo $tipo['id']; ?>").click(function() {

                                                        $.ajax({
                                                            type: "GET",
                                                            data: {
                                                                id: "<?php echo $tipo['id']; ?>",
                                                                controlador: "tipo_facturacion"
                                                            },
                                                            url: "<?php echo baseUrl(); ?>/borrar",
                                                            dataType: "html",
                                                            success: function(respuesta) {
                                                                //  alert(respuesta);
                                                                $('body').append(respuesta);

                                                            }
                                                        });





                                                    });



                                                });
                                            </script>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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
            $("body").on("submit", "#form-upload-tipo_facturacion", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('tipo_facturacion/importar') ?>",
                    data: data,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#btnUpload").prop('disabled', true);
                        $(".user-loader").show();
                    },
                    success: function(result) {
                        alert(result);
                        $("#btnUpload").prop('disabled', false);
                        if ($.isEmptyObject(result.error_message)) {
                            $(".result").html(result.success_message);
                        } else {
                            $(".sub-result").html(result.error_message);
                        }
                        $(".user-loader").hide();
                    }
                });
            });
        });
    </script>



</body>

</html>