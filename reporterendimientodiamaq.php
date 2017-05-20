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
                            <h3>Reporte de Rendimiento de Máquina</h3>
                        </div>";


echo "                
                    </div>
                </section>
                <hr>
                <section class='container'>
                    <div class='col-sm-12'>
                        <h4>Rendimiento Bruto de Máquina del ".$_POST['fecha']."</h4>
                    </div>
                    <hr>
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Máquina</th>
                                    <th>Operador</th>
                                    <th>Tiempo del Turno</th>
                                    <th>Tiempo Operativo</th>
                                    <th>Tiempo Muerto</th>
                                    <th>Rendimiento</th>
                                </tr>
                            </thead>
                            <tbody>";
                            $horasenwakas1=0;
                            $horasenwakas=0;
                            $horastrabajo=0;
                            $tiempomuerto=0;
                            $tiempoefectivo=0;
                            $rendimientomaquina=0;
                            $result2=mysql_query("SELECT DISTINCT idEmpleado FROM empleadolote WHERE idMaquina='".$_POST['idmaq']."' AND fecha='".$_POST['fecha']."'");
                            while ($fila2=mysql_fetch_array($result2)){
                                echo "<tr>";
                                $result12=selectTableWhere('Maquina','idMaquina',"'".$_POST['idmaq']."'");
                                while ($fila12=mysql_fetch_array($result12)){
                                    echo "<td>".$fila12['descripcion']."</td>";
                                }
                                $result3=selectTableWhere('Empleado','idEmpleado',"'".$fila2['idEmpleado']."'");
                                while ($fila3=mysql_fetch_array($result3)){
                                    echo "<td>".$fila3['nombres']." ".$fila3['apellidos']."</td>";
                                }
                                $result1=selectTableWhere2('RegistroIngresoSalida','idEmpleado',"'".$fila2['idEmpleado']."'",'fecha',"'".$_POST['fecha']."'");
                                while ($fila1=mysql_fetch_array($result1)) {
                                    $horaIngreso = explode(":", $fila1['horaIngreso']);
                                    $horaSalida = explode(":", $fila1['horaSalida']);
                                    $horasalidabreak=explode(":", $fila1['salidaBreak']);
                                    $horaingresobreak=explode(":", $fila1['ingresoBreak']);
                                    $minutosSalidaBreak=($horasalidabreak[0] * 60) + $horasalidabreak[1];
                                    /*echo $minutosSalidaBreak." ";*/
                                    $minutosIngresoBreak=($horaingresobreak[0] * 60) + $horaingresobreak[1];
                                    /*echo $minutosIngresoBreak." ";*/
                                    $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
                                    $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
                                    $horastrabajo = $minutosSalida - $minutosIngreso;
                                    $tiempobreak=$minutosIngresoBreak-$minutosSalidaBreak;
                                    /*echo $tiempobreak." ";*/
                                    $horasenwakas=($horastrabajo/60)-($tiempobreak/60);
                                    /*echo $horasenwakas." ";*/
                                    $horasenwakas1=round($horasenwakas,2,1);
                                    /*echo $fila1['horaIngreso'] . " ";
                                    echo $fila1['horaSalida'] . " ";
                                    echo "$minutosIngreso ";
                                    echo "$minutosSalida ";
                                    echo "$horastrabajo ";*/
                                    echo "<td>".$horasenwakas1." horas</td>";
                                }
                                $result4=selectTableWhere2('empleadoactividadmuerta','idEmpleado',"'".$fila2['idEmpleado']."'",'idMaquina',"'".$_POST['idmaq']."'");
                                while ($fila4=mysql_fetch_array($result4)){
                                    $tiempomuerto=$tiempomuerto+$fila4['tiempo'];
                                }
                                $tiempoefectivo=$horastrabajo-$tiempomuerto;
                                echo "<td>".$tiempoefectivo." minutos</td>
                                      <td>".$tiempomuerto." minutos</td>
                                ";
                                $rendimientomaquina=($tiempoefectivo/$horastrabajo)*100;
                                $rendimientomaquina1=round($rendimientomaquina,2,1);
                                echo "<td>".$rendimientomaquina1." %</td>";
                                echo "</tr>";
                            }
echo "
                            </tbody>                    
                        </table>
                    </div>
                    <div class='container'>
                        <div>
                            <h4>Actividades Muertas</h4>
                        </div>
                        <br>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Empleado</th>
                                    <th>Actividad Muerta</th>
                                    <th>Descripción</th>
                                    <th>Tiempo</th>
                                </tr>
                            </thead>
                            <tbody>";
                            $result13=selectTableWhere2('empleadoactividadmuerta','idMaquina',"'".$_POST['idmaq']."'",'fecha',"'".$_POST['fecha']."'");
                            while ($fila13=mysql_fetch_array($result13)){
                                echo "<tr>";
                                $emp=selectTableWhere("empleado",'idempleado',"'".$fila13['idEmpleado']."'");
                                while ($empfil=mysql_fetch_array($emp)){
                                    echo "<td>".$empfil['nombres']." ".$empfil['apellidos']."</td>";
                                }
                                $act=selectTableWhere('actividadmuerta','idActividadMuerta',"'".$fila13['idActividadMuerta']."'");
                                while ($actifil=mysql_fetch_array($act)){
                                    echo "<td>".$actifil['descripcion']."</td>";
                                }
                                echo "<td>".$fila13['descripcion']."</td>
                                      <td>".$fila13['tiempo']." min</td>
                                ";
                                echo "</tr>";
                            }
echo "
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
                <section class='container'>
                    <div class='container'>
                        <h4>Rendimiento de la Producción</h4>
                    </div>
                    <hr>";
                    $rendimientodeproduccion=0;
                    $result5=mysql_query("SELECT DISTINCT idEmpleado FROM empleadolote WHERE idMaquina='".$_POST['idmaq']."' AND fecha='".$_POST['fecha']."'");
                    while ($fila5=mysql_fetch_array($result5)){
                        echo "
                            <div class='container'>
                                <div class='container'>
                                    <h5>Turno llevado por: ";
                        $result3=selectTableWhere('Empleado','idEmpleado',"'".$fila5['idEmpleado']."'");
                        while ($fila3=mysql_fetch_array($result3)){
                            echo $fila3['nombres']." ".$fila3['apellidos'];
                        }
                        echo "
                                    </h5>
                                </div>
                            </div>
                            <br>
                            <div class='container'>
                                <table class='table table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Lote</th>
                                            <th>Producto</th>
                                            <th>Componente</th>
                                            <th>Cantidad</th>
                                            <th>Tiempo</th>
                                            <th>Tiempo Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        ";
                        $tiempocantidad=0;
                        $tiempoproduccion=0;
                        $tiempoesperadoproduccion=0;
                        $tiempolote=0;
                        $cantidadlote=0;
                        $tiempoesperadoproducciontotal=0;
                        $result6=selectTableWhere3('empleadolote','idEmpleado',"'".$fila5['idEmpleado']."'",'idMaquina',"'".$_POST['idmaq']."'",'fecha',"'".$_POST['fecha']."'");
                        while ($fila6=mysql_fetch_array($result6)){
                            echo "<tr>";
                            echo "<td>".$fila6['idLote']."</td>
                                  <td>".$fila6['idProducto']."</td>
                            ";
                            $result7=selectTableWhere('productocomponentesprenda','idComponenteEspecifico',"'".$fila6['idComponenteEspecifico']."'");
                            while ($fila7=mysql_fetch_array($result7)){
                                $result8=selectTableWhere('componentesprenda','idComponente',"'".$fila7['idComponente']."'");
                                while ($fila8=mysql_fetch_array($result8)){
                                    echo "<td>".$fila8['descripcion']."</td>";
                                }
                            }
                            $result11=selectTableWhere('Lote','idLote',"'".$fila6['idLote']."'");
                            while ($fila11=mysql_fetch_array($result11)){
                                $cantidadlote=$fila11['cantidad'];
                            }
                            echo "<td>".$fila6['cantidad']."</td>";
                            $result9=mysql_query("SELECT DISTINCT fila FROM PCPSPC WHERE idComponenteEspecifico='".$fila6['idComponenteEspecifico']."' AND valor='".$_POST['idmaq']."'");
                            while ($fila9=mysql_fetch_array($result9)){
                                $filapcpspc=$fila9['fila'];
                                $result10=mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico='".$fila6['idComponenteEspecifico']."' AND idSubProcesoCaracteristica='SUBPROCESOCARAC36' AND fila='".$filapcpspc."'");
                                while ($fila10=mysql_fetch_array($result10)){
                                    echo "<td>".$fila10['valor']." min</td>";
                                    $tiempocantidad=$fila6['cantidad']*$fila10['valor'];
                                    $tiempoesperadoproduccion=$cantidadlote*$fila10['valor'];
                                    $tiempoproduccion=$tiempoproduccion+$tiempocantidad;
                                    $tiempoesperadoproducciontotal=$tiempoesperadoproducciontotal+$tiempoesperadoproduccion;
                                }
                            }
                            echo "<td>".$tiempoproduccion." min</td>";
                            echo "</tr>";
                        }
                        $rendimientodeproduccion=($tiempoproduccion/$tiempoesperadoproducciontotal)*100;
                        $rendimientodeproduccion1=round($rendimientodeproduccion,2,1);
                        echo "
                            <tr>
                                <th>Rendimiento de Producción</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>".$rendimientodeproduccion1." %</th>
                            </tr>
                        ";
                        echo "
                                        </tbody>
                                    </table>                
                                </div>
                        ";
                    }
echo "                                    
                </section>
            ";
echo "
                <section class='container'>
                    <form action='reporterendimientomaqdiapdf.php' method='post' class='form-horizontal col-sm-12'>
                        <input type='hidden' name='idmaq' value='".$_POST['idmaq']."' readonly>
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