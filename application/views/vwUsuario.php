<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <title>Fondo de Inversión</title>
  </head>
  <body>
	<div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4 text-center">Fondo de Inversión</h1>
                        <p class="lead text-center">Usuario: <?php echo $this->session->userdata("usuario"); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <ul class="nav nav-pills nav-justified bg-info">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo site_url("ctrMontos"); ?>">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo site_url("ctrEstadisticas"); ?>">Estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo site_url("ctrUsuarios"); ?>">Usuario</a>
                    </li>
                </ul>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Cambiar Contraseña
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="actual">Contraseña Actual: </label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="actual">
                                    </div>
                                    <div class="form-group">
                                        <label for="nueva">Nueva Contraseña: </label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="nueva">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmacion">Confirmar Nueva Contraseña: </label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="confirmacion">
                                    </div>
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('¿Confirma que desea cambiar su contraseña?')">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col">                
                <a href="<?php echo site_url("ctrUsuarios/Baja"); ?>"><button type="button" class="btn btn-secondary btn-lg btn-block" onclick="return confirm('¿Confirma que desea dar de baja su cuenta?')">Eliminar Cuenta</button></a>
                <br>
                <a href="<?php echo site_url("ctrUsuarios/Salir"); ?>"><button type="button" class="btn btn-primary btn-lg btn-block" onclick="return confirm('¿Confirma que desea salir?')">Cerrar Sesión</button></a>
            </div>
        </div>
	</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  </body>
</html>