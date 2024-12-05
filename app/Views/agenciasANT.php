<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="row mt-3">
    <a href="agencias/nuevo" class="btn btn-info">Nuevo</a>
     <table class="table table-bordered" id="agencies">       <thead>
   <tr>
             <th>Id</th>
             <th>Name</th>
             <th>Email</th>
          </tr>
       </thead>
       <tbody>
          <?php if($agencies): ?>
          <?php foreach($agencies as $agencies1): ?>
          <tr>
             <td><?php echo $agencies1['id']; ?></td>
             <td><?php echo $agencies1['name']; ?></td>
             <td><?php echo $agencies1['email']; ?></td>
              <td><a href="agencias/editar?id=<?php echo $agencies1['id'];?>">Editar</a></td>
              <td><a href="eliminar?id=<?php echo $agencies1['id'];?>">Eliminar</a></td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
</div>
</body>
</html>