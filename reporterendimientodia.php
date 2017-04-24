<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">
        <link href="css/Formatos.css" rel="stylesheet">
    </head>
    <body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                                <li><a href="gestionOP.php">Visualizaci&oacuten de Órdenes de Producci&oacuten</a></li>
                                <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                                <li><a href="rendimiento.php">Visualizaci&oacuten de Rendimiento</a></li>
                                <li><a href="menuestadoproceso.php">Visualizaci&oacuten de Estado de Proceso</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OPERACIONES<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                                <li><a href="OpcionHE.php">Nueva Hoja de Especificaciones</a></li>
                                <li><a href="OPnueva.php">Nueva Orden de Producción</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INFORMACIÓN INTERNA<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionMateriales.php">Materiales</a></li>
                                <li><a href="gestionMaquinas.php">M&aacutequinas</a></li>
                                <li><a href="gestionInsumos.php">Insumos</a></li>
                                <li><a href="gestionOperarios.php">Empleados</a></li>
                                <li><a href="gestionProcesos.php">Procesos</a></li>
                                <li><a href="gestionRepuestos.php">Repuestos</a></li>
                                <li><a href="menuagregarotros.php">Otros</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONTACTOS<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionClientes.php">Clientes</a></li>
                                <li><a href="gestionProveedores.php">Proveedores</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
    </header>

        <?php

            /*echo $_POST['dni']." " ;
            echo $_POST['fecha']." " ;*/
            $result1=selectTableWhere2('RegistroIngresoSalida','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
            while ($fila1=mysql_fetch_array($result1)) {
                    $horaIngreso = explode(":", $fila1['horaIngreso']);
                    $horaSalida = explode(":", $fila1['horaSalida']);
                    $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
                    $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
                    $horastrabajo = $minutosSalida - $minutosIngreso;
                    $horasenwakas=$horastrabajo/60;
                    $horasenwakas1=round($horasenwakas,2,1);
                    /*echo $fila1['horaIngreso'] . " ";
                    echo $fila1['horaSalida'] . " ";
                    echo "$minutosIngreso ";
                    echo "$minutosSalida ";
                    echo "$horastrabajo ";*/
            }
            $result2="SELECT * FROM caracteristica WHERE descripcion = 'Tiempo'";
            $query=mysql_query($result2);
            while ($fila2=mysql_fetch_array($query)){
                $idcaractiempo=$fila2['idCaracteristica'];
                /*echo $idcaractiempo." ";*/
            }
            $result3=selectTableWhere('SubProceso','idProcedimiento','"PROCEDIMIENTO32"');
            while ($fila3=mysql_fetch_array($result3)){
                $idprocedimientotiempo=$fila3['idProcedimiento'];
                /*echo $idprocedimientotiempo." ";*/
            }
            $result4=selectTableWhere2('SubProcesoCaracteristica','idProcedimiento',"'".$idprocedimientotiempo."'",'idCaracteristica',"'".$idcaractiempo."'");
            while ($fila4=mysql_fetch_array($result4)){
                $idsubprocesocaracteristica=$fila4['idSubProcesoCaracteristica'];
                /*echo $idsubprocesocaracteristica." ";*/
            }
            $sumatiempos=0;
            $tiempoactividad=0;
            $rendimiento=0;
            $result5=selectTableWhere2('EmpleadoLote','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
            while ($fila5=mysql_fetch_array($result5)){
                    /*echo $fila5['idComponenteEspecifico']. " ";*/
                    $result6=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila5['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                    while ($fila6=mysql_fetch_array($result6)){
                        $idpcpspc=$fila6['id']-1;
                        $result10=selectTableWhere('PCPSPC','id',"'".$idpcpspc."'");
                        while ($fila10=mysql_fetch_array($result10)){
                            if ($fila10['valor']=="MAQUINA9"){
                                /*echo $fila6['valor']." ";*/
                                $tiempoactividad=$fila6['valor']*$fila5['cantidad'];
                                /*echo $tiempoactividad." ";*/
                            }
                        }
                    }
                $sumatiempos=$sumatiempos+$tiempoactividad;
                /*echo $sumatiempos." ";*/
            }
            $rendimiento=($sumatiempos/$horastrabajo)*100;
            /*echo $rendimiento." ";*/
            $rendimiento1=round($rendimiento,2,1);
            echo "
                <section class='container-fluid'>
                    <div class='col-sm-2'>
                    <div>
                        <img style='margin-top:25px' width='auto' height='70' src='image/LogoWakas.png'/>
                    </div>
                </div>
                    <div class='col-sm-5' id='descripcionbrand'>
                        <div>
                            <br><b><span style=\"margin-top: 20px\">Waka-s Textiles Finos SAC</span></b>
                        </div>
                        <div>
                            <span>Urb. Francisco Mostajo G-25</span>
                        </div>
                        <div>
                            <span>04002 Arequipa - Peru</span>
                        </div>
                    </div>
                    <div class='col-sm-4'>
                        <div class='titulo'>
                            <h3>Reporte de Rendimiento</h3>
                        </div>
                        <div>
                            <h4 class='desctitulo'>";
                            $res=selectTableWhere('Empleado','idEmpleado',"'".$_POST['dni']."'");
                            while ($fil=mysql_fetch_array($res)){
                                echo $fil['nombres']." ".$fil['apellidos'];
                            }
            echo "                
                            </h4>
                        </div>
                    </div>
                </section>
                <hr>
            ";
            echo "
                <section class='container'>
                    <div>
                        <label for='date'>Fecha Seleccionada:</label>
                        <span id='date'>".$_POST['fecha']."</span>
                    </div>
                </section>
                <br>
                <section class='container'>
                    <div>
                        <label for='date'>Horas Trabajadas:</label>
                        <span id='date'>".$horasenwakas1."</span>
                    </div>
                </section>
                <br>
                <section class='container'>
                    <div>
                        <h4>Resumen de Procedimientos Realizados</h4>
                    </div>
                    <br>
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idProducto</th>
                                    <th>Procedimiento</th>
                                    <th>Componente</th>
                                    <th>Cantidad</th>
                                    <th>Tiempo Estandar</th>
                                    <th>Tiempo Empleado</th>
                                </tr>
                            </thead>
                            <tbody>";
                                $tiempoempleado=0;
                                $result7=selectTableWhere2('EmpleadoLote','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
                                while ($fila7=mysql_fetch_array($result7)){
                                    echo "
                                        <tr>
                                            <td>".$fila7['idProducto']."</td>
                                    ";
                                    $res1=selectTableWhere('SubProceso','idProcedimiento',"'".$fila7['idProcedimiento']."'");
                                    while ($fil2=mysql_fetch_array($res1)){
                                        echo "
                                            <td>".$fil2['descripcion']."</td>
                                        ";
                                    }
                                    $res2=selectTableWhere('ProductoComponentesPrenda','idComponenteEspecifico',"'".$fila7['idComponenteEspecifico']."'");
                                    while ($fil3=mysql_fetch_array($res2)){
                                        $res3=selectTableWhere('ComponentesPrenda','idComponente',"'".$fil3['idComponente']."'");
                                        while ($fil4=mysql_fetch_array($res3)){
                                            echo "
                                                <td>".$fil4['descripcion']."</td>
                                            ";
                                        }
                                    }
                                    echo "
                                        <td>".$fila7['cantidad']."</td>
                                    ";
                                    $result9=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila7['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                                    while ($fila9=mysql_fetch_array($result9)){
                                        $idpcpspc1=$fila9['id']-1;
                                        $result11=selectTableWhere('PCPSPC','id',"'".$idpcpspc1."'");
                                        while ($fila11=mysql_fetch_array($result11)){
                                            if($fila11['valor']=="MAQUINA9"){
                                                echo "
                                                    <td>".$fila9['valor']."</td>
                                                ";
                                                $tiempoempleado=$fila9['valor']*$fila7['cantidad'];
                                                echo "
                                                    <td>".$tiempoempleado."</td>
                                                ";
                                            }
                                        }
                                    }
                                    echo "</tr>";
                                }
            echo "
                <tr>
                    <td colspan='5' style='text-align: left; font-weight: bold;'>Rendimiento del Día</td>
                    <td>".$rendimiento1." %</td>
                </tr>
            ";
            echo "              
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
            ";
            echo "
                <section class='container'>
                    <div>
                        <h4>Actividades Muertas Realizadas</h4>
                    </div>
                    <br>
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Actividad Muerta</th>
                                    <th>Descripción</th>
                                    <th>Tiempo Empleado</th>
                                    <th>Tiempo Estandar</th>
                                </tr>
                            </thead>
                            <tbody>";
                                $sumaactimuerta=0;
                                $res4=selectTableWhere2('EmpleadoActividadMuerta','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
                                while ($fil5=mysql_fetch_array($res4)){
                                    echo "<tr>";
                                    $res5=selectTableWhere('ActividadMuerta','idActividadMuerta',"'".$fil5['idActividadMuerta']."'");
                                    while ($fil6=mysql_fetch_array($res5)){
                                        echo "
                                            <td>".$fil6['descripcion']."</td>
                                            <td>".$fil5['descripcion']."</td>
                                            <td>".$fil5['tiempo']."</td>
                                            <td>".$fil6['tiempoEstandar']."</td>
                                        ";
                                        $sumaactimuerta=$sumaactimuerta+$fil5['tiempo'];
                                    }
                                    echo "</tr>";
                                }
            echo "
                <tr>
                    <td colspan='3' style='text-align: left; font-weight: bold;'>Tiempo Total en Actividades Muertas</td>
                    <td>".$sumaactimuerta."</td>
                </tr>
            ";
            echo "                
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
            ";
            echo "
                <section class='container'>
                    <form action='reporterendimientoindipdf.php' method='post' class='form-horizontal col-sm-12'>
                        <input type='hidden' name='dni' value='".$_POST['dni']."' readonly>
                        <input type='hidden' name='fecha' value='".$_POST['fecha']."' readonly>
                        <input type='submit' class='btn btn-primary col-sm-4 col-sm-offset-4' name='pdf' value='Descargar PDF'>
                    </form>
                </section>
                <br>
            ";
?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    <footer class="panel-footer navbar-fixed-bottom">
        <div class="container col-sm-6 col-sm-offset-3 text-center">
            <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
        </div>
    </footer>
    </body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>