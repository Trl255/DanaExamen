<?php $url_abs="http://localhost/codeigniter4-framework-2849e7f/";?>
<!DOCTYPE html>
<html lang="en">
    <head>
   <style>
     *{margin: 0;padding: 0;}
     @page{size: 595pt 842pt;}
     table,tr,td,h1{
         margin: 0pt;
         padding: 0pt;
     }
     .paginaA4{
          height: 842pt;
         width:595pt;
         margin: 0;
         padding: 0;
     }
     .cabecera{
         width:100%;
         background-color: transparent;
          background-image: url("<?php echo $url_abs;?>assets/images/media/img-2.jpg");
         border-bottom: 1px solid #333;
         color:#fff;
     }
     .cabecera td.contenedor{
         
         height: 100pt;
     }
     .pie{
         width:100%;
         background-color:transparent;
         background-image: url("<?php echo $url_abs;?>assets/images/media/img-7.jpg");
         background-position:bottom;
         background-repeat: no-repeat;
         background-size:auto;
          border-top: 1px solid #333;
     }
     .pie td.contenedor{
          width:100%;
          height: 98pt;
         color:#fff;
         text-align: center;
     } 
     
     .contenido{
         width:100%;
     }
     .contenido td.contenedor{
         vertical-align: top;
         height:642pt;
     }
     .logo{
         width:80pt;
         height: auto;
         margin-left: 10pt;
     }
      .cab1{
         width: 80pt;
         text-align: center;
     }
     .cab2{
         width: 350pt;
         text-align: center;
     }
      .cab3{
         width: 80pt;
         text-align: center;
     }
       
        .ficha{
                margin-top: 10pt;
                margin-left: 10pt;
                
            }
            .ficha th{
                font-size: 18pt;
                padding: 10pt;
                font-weight: 300;
                background: #d2d2d2;
            }
             .ficha td{
                font-size: 18pt;
                padding: 10pt;
                 border: 1px solid #d2d2d2;
            }
     
</style>
</head>
<body>
    <table class="paginaA4" cellspacing=0 cellpadding=0>
<tr class="cabecera">
    <td class="contenedor">
        <table>
            <tr>
            <td class="cab1"><img src="<?php echo $url_abs;?>assets/images/companies/tataB.png" class="logo"></td>
            <td  class="cab2"><h1>TOP SECRET</h1></td>
            <td class="cab3">
                <table>
                    <tr><td>luismenatobar@gmail.com</td></tr>
                     <tr><td>+34 900 100 100</td></tr>
                </table>    
            </td>
            </tr>
        </table>
    </td>
</tr>  
    
<tr class="contenido"><td class="contenedor">
   
    
    <table class="ficha" cellspacing=0 cellpadding=0>
        <tr><th>Id:</th><td><?php echo $tipo["id"];?></td></tr>
        <tr><th>Tipo facturacion:</th><td> <input type="text" class="form-control" id="tipo_facturacion" aria-describedby="tipo_facturacion" placeholder="tipo_facturacion"  name="tipo_facturacion" value="<?php echo $tipo["tipo_facturacion"];?>"></td></tr>
    </table>
    
</td></tr>     
<tr class="pie"><td class="contenedor"><h1>@copyright 2024</h1></td></tr> 
</table>


</body>
</html>
  
            

