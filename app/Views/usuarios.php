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

                        <div class="row mt-3">
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
                                        <th>firstname</th>
                                        <th>lastname</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  SELECT `id_user`, `act_user`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at` FROM `users` WHERE 1-->
                                    <?php if ($users): ?>
                                        <?php foreach ($users as $u): ?>
                                            <tr id="fila<?php echo $u['id_user']; ?>">
                                                <td><?php echo $u['id_user']; ?></td>
                                                <td><?php echo $u['firstname']; ?></td>
                                                <td><?php echo $u['lastname']; ?></td>
                                                <td><a href="users/editar?id=<?php echo $u['id_user']; ?>">Editar</a></td>

                                                <td><a href="#" id="eliminar<?php echo $u['id_user']; ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                                            </tr>


                                            <script>
                                                $(document).ready(function() {


                                                    $("#eliminar<?php echo $u['id_user']; ?>").click(function() {

                                                        $.ajax({
                                                            type: "GET",
                                                            data: {
                                                                id: "<?php echo $u['id_user']; ?>",
                                                                controlador: "users"
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
                    url: "<?php echo base_url('users/importar') ?>",
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