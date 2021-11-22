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
            <div class="col-sm-12">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Acumulado: $<?php echo $acumulado; ?></h5>               
                    </div>
                </div>
            </div>
        </div>
        
        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Mayor Monto</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($mayorMonto) and !empty($mayorMonto))
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white"><?php echo date("d-m-Y", strtotime($mayorMonto["Fecha"])); ?></p></td>
                                        <td><p class="card-text text-right text-white">$<?php echo $mayorMonto["Monto"]; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Menor Monto</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($menorMonto) and !empty($menorMonto))
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white"><?php echo date("d-m-Y", strtotime($menorMonto["Fecha"])); ?></p></td>
                                        <td><p class="card-text text-right text-white">$<?php echo $menorMonto["Monto"]; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Mayor Alza</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($mayorAlza) and !empty($mayorAlza))
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white"><?php echo date("d-m-Y", strtotime($mayorAlza["Fecha"])); ?></p></td>
                                        <td><p class="card-text text-right text-white">$<?php echo $mayorAlza["Diferencia"]; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Mayor Caída</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($mayorBaja) and !empty($mayorBaja))
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white"><?php echo date("d-m-Y", strtotime($mayorBaja["Fecha"])); ?></p></td>
                                        <td><p class="card-text text-right text-white">$<?php echo $mayorBaja["Diferencia"]; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Mayor Diferencia (valor absoluto)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($mayorDif) and !empty($mayorDif))
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white"><?php echo date("d-m-Y", strtotime($mayorDif["Fecha"])); ?></p></td>
                                        <td><p class="card-text text-right text-white">$<?php echo $mayorDif["Diferencia"]; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Menor Diferencia (valor absoluto)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($menorDif) and !empty($menorDif))
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white"><?php echo date("d-m-Y", strtotime($menorDif["Fecha"])); ?></p></td>
                                        <td><p class="card-text text-right text-white">$<?php echo $menorDif["Diferencia"]; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="card text-black bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Monto Promedio</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($promedioMontos) and !empty($promedioMontos))
                                    {
                                    ?>
                                        <td><p class="card-text text-right text-black">$<?php echo $promedioMontos; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-black">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Diferencia Promedio (valor absoluto)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    if(isset($promedioDif) and !empty($promedioDif))
                                    {
                                    ?>
                                        <td><p class="card-text text-right text-white">$<?php echo $promedioDif; ?></p></td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td><p class="card-text text-center text-white">No hay datos</p></td> 
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>                
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Evolución</h5>
                            <?php 
                            if(isset($fechas) and isset($montos) and !empty($fechas) and !empty($montos))
                            {
                            ?>
                                <canvas id="myChart" width="400" height="200"></canvas>
                            <?php
                            }
                            else
                            {
                            ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <td><p class="card-text text-center text-black">No hay datos</p></td> 
                                    </tr>
                                </table>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                <?php
                    if(isset($fechas) and isset($montos) and !empty($fechas) and !empty($montos))
                    {
                        $str = "[";
                        foreach($fechas as $f)
                        {
                            $str = $str."'".date("d-m-Y", strtotime($f["Fecha"]))."', ";
                        }
                        $str = substr($str, 0, -1);
                        $str = $str."],";
                        //file_put_contents("log.txt", $str);
                    }
                    else
                        $str = "[]";
                ?>
                labels: <?php echo $str; ?>
                //['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],

                datasets: [{
                    label: 'Monto',
                    <?php
                        if(isset($fechas) and isset($montos) and !empty($fechas) and !empty($montos))
                        {
                            $str2 = "[";
                            foreach($montos as $m)
                            {
                                $str2 = $str2."'".$m["Monto"]."', ";
                            }
                            $str2 = substr($str2, 0, -1);
                            $str2 = $str2."],";
                            //file_put_contents("log.txt", $str2);
                        }
                        else
                            $str2 = "[]";
                    ?>
                    data: <?php echo $str2; ?>
                    //[12, 19, 3, 5, 2, 3],
                    
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
  </body>
</html>