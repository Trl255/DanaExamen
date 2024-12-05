
  <link href="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.css" rel="stylesheet"> 
    <script src="http://localhost/codeigniter4-framework-2849e7f/assets/js/jquery.min.js"></script>
<script src="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
<script>
    $(function(){
      
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
                                  data:{id:<?php echo $id;?>},
                                url: "<?php echo baseUrl();?>/<?php echo $controlador;?>/eliminar",
                                dataType:"html",
                                success: function(respuesta){
                                    
                                    //si la solicitud es hecha éxitosamente entonces la respuesta representa los datos
                                        if(respuesta==1){
                                             $('#fila<?php echo $id;?>').hide();
                                            
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
</script>