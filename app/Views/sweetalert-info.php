
  <link href="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.css" rel="stylesheet"> 
    <script src="http://localhost/codeigniter4-framework-2849e7f/assets/js/jquery.min.js"></script>
<script src="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
<script>
    $(function(){
      
               
                                                let timerInterval;
                                                Swal.fire({
                                                  title: "<?php echo $mensaje;?>",
                                                  html: "I will close in <b></b> milliseconds.",
                                                  timer: 2000,
                                                  timerProgressBar: true,
                                                  didOpen: () => {
                                                    Swal.showLoading();
                                                    const timer = Swal.getPopup().querySelector("b");
                                                    timerInterval = setInterval(() => {
                                                      timer.textContent = `${Swal.getTimerLeft()}`;
                                                    }, 100);
                                                  },
                                                  willClose: () => {
                                                    clearInterval(timerInterval);
                                                  }
                                                }).then((result) => {
                                                  /* Read more about handling dismissals below */
                                                  if (result.dismiss === Swal.DismissReason.timer) {
                                                     <?php if($error==0){?>
                                                      location.href="<?php echo baseUrl();?>/<?php echo $controlador;?>";  
                                                      <?php }?>
                                                     
                                                  }
                                                });
                                           
                                        });
   
</script>