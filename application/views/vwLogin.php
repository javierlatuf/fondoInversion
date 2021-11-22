<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Fondo Inversión</title>
    
    
  </head>
  <body class="bg-secondary">
    <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-4">
            <br>
              <div class="card">
              <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4 text-center">Fondo de Inversión</h1>
                    </div>
                </div>
              <div class="card-body">
                <h5 class="card-title text-center">Ingreso al sistema</h5>
                <?php // echo validation_errors(); ?>
                <?php
                  if(isset($OP)){
                    switch($OP){
                      case "MAL":
                        ?>
                          <div class="alert alert-danger" role="alert">
                            Complete los datos del formulario
                          </div>
                        <?php
                        break;
                      
                      case "INCORRECTO":
                          ?>
                            <div class="alert alert-danger" role="alert">
                              Usuario o Pass incorrecta
                            </div>
                          <?php
                          break;
  
                    }

                  }
                ?>
                <form method="post">
                  <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" value="">
                    <?php echo form_error('usuario', '<small class="text-danger">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password">
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                  </div>
                  
                  <button type="submit" class="btn btn-primary btn-lg btn-block" name="ingresar">Ingresar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>