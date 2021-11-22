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

		<div class="row">
			<div class="col">
                <br>
                <br>

                <form class="form-inline" method="post" action="">
                    <label for="fecha" class="my-1 mr-2">Fecha: </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="fecha" name="fecha" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd/mm/aaaa">  
                    </div>    
                
                    <br>

                    <label for="monto" class="my-1 mr-2">Monto: </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="monto" name="monto">   
                    </div>
                
                    <button type="submit" class="btn btn-primary mb-2">Actualizar</button>

                    <?php if(isset($fechaIncompleta) and !empty($fechaIncompleta)){
                            echo $fechaIncompleta;
                            file_put_contents("log.txt", "aaa");}
                     ?>
				    <?php echo "&nbsp &nbsp &nbsp".form_error("fecha", "<small class=\"text-danger\">","</small>"); ?>
                    <?php echo "&nbsp".form_error("monto", "<small class=\"text-danger\">","</small>"); ?>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
                <br>
                
                <div class="table-responsive" id="lstmontos">
                    <table class="table table-bordered table-striped">
                        <?php 
                        if(isset($montos) and !empty($montos))
                        {
                        ?>
                            <thead class="thead-dark">
                                <td class="text-center"><button type="button" class="btn btn-link sort" data-sort="idMonto">#</button></td>
                                <td class="text-center"><button type="button" class="btn btn-link sort" data-sort="fecha">Fecha</button></td>
                                <td class="text-center"><button type="button" class="btn btn-link sort" data-sort="monto">Monto</button></td>
                                <td class="text-center"><button type="button" class="btn btn-link sort disabled" data-sort="diferencia">Diferencia</button></td>
                                <td class="text-center"><button type="button" class="btn btn-link sort disabled" data-sort="editar">Editar</button></td>
                                <td class="text-center"><button type="button" class="btn btn-link sort disabled" data-sort="eliminar">Eliminar</button></td>
                            </thead>
                        <?php
                        }
                        ?>
                        <tbody class="list">
                            <?php 
                            if(isset($montos) and !empty($montos))
                            {
                                foreach($montos as $m)
                                { 
                            ?>
                                    <tr>
                                        <td class="text-center idMonto"><?php echo $m["IDMonto"];?></td>
                                        <td class="text-center fecha"><?php echo date("d-m-Y", strtotime($m["Fecha"])); ?></td>
                                        <td class="text-right monto">$<?php echo $m["Monto"];?></td>

                                        <td class="text-right diferencia">
                                            <?php 
                                            if($m["Diferencia"])
                                            {
                                            ?>
                                                <?php echo $m["Diferencia"];?>
                                                <?php 
                                                if($m["Diferencia"] <= 0)
                                                {
                                                ?>
                                                    <i class="bi bi-caret-down-fill text-danger"></i>
                                                <?php 
                                                }
                                                else
                                                {
                                                ?>
                                                    <i class="bi bi-caret-up-fill text-success"></i>
                                                <?php 
                                                } 
                                                ?>
                                            <?php 
                                            } 
                                            ?>
                                        </td>
                                        
                                        <td class="text-center col-sm-1"><a href="#" class="text-danger"><i class="bi bi-pencil editar"></i></i></a></td>
                                        <td class="text-center col-sm-1 eliminar"><a href="<?php echo site_url("ctrMontos/Borrar/".$m["IDMonto"]); ?>" class="text-danger" id="btnEliminar" onclick="return confirm('¿Confirma que desea eliminar el movimiento?')"><i class="bi bi-x-circle"></i></a></td>
                                    </tr>
                            <?php 
                                }
                            } 
                            else
                            {
                            ?>
                                <tr>
                                    <td class="text-center col-md-12">No hay datos</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
			</div>
		</div>

        <div class="modal" tabindex="-1" id="modEditar">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <label for="editID">ID: </label>

                                <input type="text" class="form-control" id="editID" aria-describedby="emailHelp" name="editID" readonly="true">

                            <br>
                            <label for="editFecha">Fecha: </label>
                            <input type="text" class="form-control" id="editFecha" aria-describedby="emailHelp" name="editFecha" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd/mm/aaaa">
                            <br>
                            <label for="editMonto">Monto: </label>
                            <input type="text" class="form-control" id="editMonto" aria-describedby="emailHelp" name="editMonto">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

	</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>/dist/jquery.inputmask.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#fecha').inputmask();
            $('#editFecha').inputmask();

            var options = {
                valueNames: [ 'idMonto', 'fecha', 'monto', 'diferencia', 'editar', 'eliminar' ]
            };

            var userList = new List('lstmontos', options);

            $('.editar').on('click', function(){
                $('input[type="text"]').val('');

                $('#modEditar').modal();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                $('#editID').val(data[0]);
                $('#editFecha').val(data[1]);

                var monto = data[2].toString();
                $('#editMonto').val(monto.replace('$', ''));
            });
        });
    </script>
  </body>
</html>