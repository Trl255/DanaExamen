<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    
<!-- SELECT `id_user`, `act_user`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at` FROM `users` WHERE 1-->    
<div class="row mt-3">
     <div class="col-4">
        <form action="guardar" method="post"  accept-charset="utf-8">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"  name="email">
    
  </div>
  <div class="form-group">
    <label for="firstname">firstname</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="name">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    
    </div>
  </div>

</body>
</html>