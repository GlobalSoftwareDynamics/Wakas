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

    /*echo $_POST['dni1']." " ;
    echo $_POST['mes']." " ;*/
    $hoy=date("m/d/Y");
    /*echo $hoy." ";*/
    $año=explode("/",$hoy);
    /*echo $año[2]." ";*/
    echo "
        <section class='container-fluid'>
                    <div class='col-sm-2'>
                        <div>
                            <img style='margin-top:25px' width='auto' height='70' src='image/LogoWakas.png'/>
                        </div>
                    </div>
                    <div class='col-sm-5' id='descripcionbrand'>
                        <div>
                            <br><b><span style='margin-top: 20px'>Waka-s Textiles Finos SAC</span></b>
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
                            <h3>Reporte de Rendimiento Mensual</h3>
                        </div>
                        <div>
                            <h4 class='desctitulo'>";
                            $res=selectTableWhere('Empleado','idEmpleado',"'".$_POST['dni1']."'");
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
                        <label for='date'>Mes Seleccionado:</label>";
                        $nombremes="";
                            switch ($_POST['mes']) {
                                case "01":
                                    $nombremes = "Enero";
                                    break;
                                case "02":
                                    $nombremes = "Febrero";
                                    break;
                                case "03":
                                    $nombremes = "Marzo";
                                    break;
                                case "04":
                                    $nombremes = "Abril";
                                    break;
                                case "05":
                                    $nombremes = "Mayo";
                                    break;
                                case "06":
                                    $nombremes = "Junio";
                                    break;
                                case "07":
                                    $nombremes = "Julio";
                                    break;
                                case "08":
                                    $nombremes = "Agosto";
                                    break;
                                case "09":
                                    $nombremes = "Septiembre";
                                    break;
                                case "10":
                                    $nombremes = "Octubre";
                                    break;
                                case "11":
                                    $nombremes = "Noviembre";
                                    break;
                                case "12":
                                    $nombremes = "Diciembre";
                                    break;
                            }
    echo "
                        <span id='date'>".$nombremes."</span>
                    </div>
                </section>
                <br>
                <section class='container'>
                    <div>
                        <h4>Resumen de Rendimientos Diarios</h4>
                    </div>
                    <br>
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tiempo Trabajado (Horas)</th>
                                    <th>Rendimiento</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>";
    $rendimientomestotal=0;
    $aux=0;
    $rendmes="SELECT * FROM RegistroIngresoSalida WHERE idEmpleado ='".$_POST['dni1']."' AND fecha LIKE '".$_POST['mes']."/%%/".$_POST['año']."'";
    $query=mysql_query($rendmes);
    while ($filames=mysql_fetch_array($query)){
            echo "<tr>";
            $horaIngreso = explode(":", $filames['horaIngreso']);
            $horaSalida = explode(":", $filames['horaSalida']);
            $horasalidabreak=explode(":", $filames['salidaBreak']);
            $horaingresobreak=explode(":", $filames['ingresoBreak']);
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
            $tiempohoras=round($horasenwakas,2,1);
            /*echo $fila1['horaIngreso'] . " ";
            echo $fila1['horaSalida'] . " ";
            echo "$minutosIngreso ";
            echo "$minutosSalida ";
            echo "$horastrabajo ";*/
                    echo "
                        <td>".$filames['fecha']."</td>
                        <td>".$tiempohoras."</td>
                    ";
            $result2="SELECT * FROM caracteristica WHERE descripcion = 'Tiempo'";
            $query1=mysql_query($result2);
            while ($fila2=mysql_fetch_array($query1)){
                $idcaractiempo=$fila2['idCaracteristica'];
                /*echo $idcaractiempo." ";*/
            }
            $result3=selectTableWhere('SubProceso','descripcion','"Hoja de Tiempos y Secuencia"');
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

            $rendmes1="SELECT * FROM empleadolote WHERE idEmpleado ='".$filames['idEmpleado']."' AND fecha LIKE '".$filames['fecha']."'";
            $result1=mysql_query($rendmes1);
            while ($fila5=mysql_fetch_array($result1)){
                    /*echo $fila5['idComponenteEspecifico']. " ";*/
                    $result6=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila5['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                    while ($fila6=mysql_fetch_array($result6)){
                        $idpcpspc=$fila6['fila'];
                        $result10=selectTableWhere('PCPSPC','fila',"'".$idpcpspc."'");
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
        $rendimiento1=round($rendimiento,2,1);
        /*echo $rendimiento." ";*/
        echo "
                        <td>".$rendimiento1." %</td>
        ";
        echo "
            <td>
                <form action='reporterendimientodia.php' method='post'>
                    <input type='hidden' name='dni' value='".$_POST['dni1']."' readonly>
                    <input type='hidden' name='fecha' value='".$filames['fecha']."' readonly>
                    <input type='submit' name='rendidario' value='Ver Detalle' class='btn-link'>
                </form>
            </td>
            </tr>
        ";
    $rendimientomestotal=$rendimientomestotal+$rendimiento;
    $aux++;
    }
    $rendimientofinaltotal=$rendimientomestotal/$aux;
    $rendimientofinaltotal1=round($rendimientofinaltotal,2,1);
    echo "
            <tr>
                <td colspan='2' style='text-align: left; font-weight: bold;'>Rendimiento Mensual</td>
                <td>".$rendimientofinaltotal1." %</td>
            </tr>
    ";
    echo "
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
    ";
?>
<section class='container'>
    <form action='reporterendimientomenspdf.php' method='post' class='form-horizontal col-sm-12'>
        <input type='hidden' name='dni1' value="<?php echo $_POST['dni1'];?>" readonly>
        <input type='hidden' name='mes' value="<?php echo $_POST['mes'];?>" readonly>
        <input type='hidden' name='año' value="<?php echo $_POST['año'];?>" readonly>
        <input type='submit' class='btn btn-primary col-sm-4 col-sm-offset-4' name='pdf' value='Descargar PDF'>
    </form>
</section>
<br>
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