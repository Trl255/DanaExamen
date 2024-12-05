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

                <div class="page-content-wrapper">

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

                        <?php var_dump($cliente); ?>

                        <div class="row mt-3">
                            <!-- Botones alineados con separación -->
                            <div class="col-md-12">
                                <div class="btn-group" role="group" aria-label="Botones de acción">
                                    <!-- <a href="cliente/nuevo" class="btn btn-info mr-2">Nuevo</a> -->
                                     
                                    <a href="clientes/nuevo" class="btn btn-info mr-2">Nuevo</a>
                                    <a href="clientes/exportar" class="btn btn-warning">Exportar</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <form id="form-upload-cliente" method="post" autocomplete="off">
                            <div class="sub-result"></div>
                            <div class="form-group">
                                <label class="control-label">Choose File <small class="text-danger">*</small></label>
                                <!-- Input redimensionado para un tamaño adecuado -->
                                <input type="file" class="form-control form-control-sm" id="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required style="max-width: 300px;">
                                <small class="text-danger">Upload excel or csv file only.</small>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <div class="user-loader" style="display: none;">
                                        <i class="fa fa-spinner fa-spin"></i> <small>Please wait ...</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="btnUpload">Upload</button>
                            </div>
                        </form>

                        <table class="table table-bordered" id="agencies">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>ID Comercios</th>
                                    <th>Email</th>
                                    <th>Razón Social</th>
                                    <th>Nombre</th>
                                    <th>NIF-CIF-NIE</th>
                                    <th>Atendido</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($cliente): ?>
                                    <?php foreach ($cliente as $tipo): ?>
                                        <tr id="fila<?php echo $tipo['id']; ?>">
                                            <td><?php echo $tipo['id']; ?></td>
                                            <td><?php echo $tipo['id_comercios']; ?></td>
                                            <td><?php echo $tipo['email']; ?></td>
                                            <td><?php echo $tipo['razon_social']; ?></td>
                                            <td><?php echo $tipo['nombre']; ?></td>
                                            <td><?php echo $tipo['cif_nif_nie']; ?></td>
                                            <td><?php echo $tipo['atendido']; ?></td>
                                            <td>
                                                <a href="<?php echo baseUrl(); ?>/cliente/editar?id=<?php echo $tipo['id']; ?>"><i class="fa-solid fa-pen-fancy"></i></a>
                                                &nbsp;<a href="<?php echo baseUrl(); ?>/cliente/editar2?id=<?php echo $tipo['id']; ?>"><i class="fa-solid fa-pen-fancy text-info"></i></a>
                                                <a href="#" id="eliminar<?php echo $tipo['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="#" id="eliminar2<?php echo $tipo['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="<?php echo baseUrl(); ?>/cliente/imprimir?id=<?php echo $tipo['id']; ?>"><i class="fa-solid fa-print"></i></a>
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
                                                                url: "<?php echo baseUrl(); ?>/cliente/eliminar",
                                                                dataType: "html",
                                                                success: function(respuesta) {
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
                                                            controlador: "cliente"
                                                        },
                                                        url: "<?php echo baseUrl(); ?>/borrar",
                                                        dataType: "html",
                                                        success: function(respuesta) {
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
            $("body").on("submit", "#form-upload-cliente", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('cliente/importar') ?>",
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