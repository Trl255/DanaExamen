<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="row mt-3">
     <div class="col-4">
         
        <form action="actualizar" method="post"  accept-charset="utf-8">
    <input type="hidden" id="id" name="id"   value="<?php echo $ag["id"];?>">        
            
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"  name="email" value="<?php echo $ag["email"];?>">
    
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="name"  value="<?php echo $ag["name"];?>">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    
    </div>
  </div>

</body>
</html>