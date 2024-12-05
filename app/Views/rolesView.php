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
                                    <h4 class="page-title">Roles</h4>
                                </div>
                            </div>
                        </div>



                        <!-- end page title end breadcrumb -->



                        <div class="row mt-3">
                            <a href="roles/nuevo" class="btn btn-info">Nuevo</a>&nbsp; <a href="roles/exportar" class="btn btn-info">Exportar</a>


                            <form id="form-upload-user" method="post" autocomplete="off">
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

                            <table class="table table-bordered" id="agencies">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Role</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($roles): ?>
                                        <?php foreach ($roles as $rol): ?>
                                            <tr id="fila<?php echo $rol['id']; ?>">
                                                <td><?php echo $rol['id']; ?></td>
                                                <td><?php echo $rol['role']; ?></td>

                                                <td><a href="<?php echo baseUrl(); ?>/roles/editar?id=<?php echo $rol['id']; ?>"><i class="fa-solid fa-pen-fancy"></i></a>&nbsp;
                                                    <a href="#" id="eliminar<?php echo $rol['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>

                                            </tr>
                                            <script>
                                                $(document).ready(function() {



                                                    $("#eliminar<?php echo $rol['id']; ?>").click(function() {

                                                        $.ajax({
                                                            type: "GET",
                                                            data: {
                                                                id: "<?php echo $rol['id']; ?>",
                                                                controlador: "roles"
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
            $("body").on("submit", "#form-upload-user", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('roles/importar') ?>",
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