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
                            <h3>Reporte de Rendimiento Mensual de Máquina</h3>
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
                <section class='container'>
                    <div>
                        <label for='maquina'>Máquina Seleccionada:</label>";
                    $maq=selectTableWhere('maquina','idmaquina',"'".$_POST['idmaq1']."'");
                    while ($fil=mysql_fetch_array($maq)){
                        echo "<span id='maquina'> ".$fil['descripcion']."</span>";
                    }
echo "
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
$horasenwakas1=0;
$horasenwakas=0;
$horastrabajo=0;
$tiempomuerto=0;
$tiempoefectivo=0;
$rendimientomaquinames=0;
$horastotaleswakas=0;
$tiempoefectivototal=0;
$result=mysql_query("SELECT DISTINCT fecha FROM empleadolote WHERE idMaquina='".$_POST['idmaq1']."' AND fecha LIKE '".$_POST['mes']."/%%/".$_POST['año']."'");
while ($fila=mysql_fetch_array($result)){
    echo "<tr>";
    echo "<td>".$fila['fecha']."</td>";
    $result2=mysql_query("SELECT DISTINCT idEmpleado FROM empleadolote WHERE idMaquina='".$_POST['idmaq1']."' AND fecha ='".$fila['fecha']."'");
    while ($fila2=mysql_fetch_array($result2)){
        $result1=selectTableWhere2('RegistroIngresoSalida','idEmpleado',"'".$fila2['idEmpleado']."'",'fecha',"'".$fila['fecha']."'");
        while ($fila1=mysql_fetch_array($result1)) {
            $horaIngreso = explode(":", $fila1['horaIngreso']);
            $horaSalida = explode(":", $fila1['horaSalida']);
            $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
            $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
            $horasalidabreak=explode(":", $fila1['salidaBreak']);
            $horaingresobreak=explode(":", $fila1['ingresoBreak']);
            $minutosSalidaBreak=($horasalidabreak[0] * 60) + $horasalidabreak[1];
            /*echo $minutosSalidaBreak." ";*/
            $minutosIngresoBreak=($horaingresobreak[0] * 60) + $horaingresobreak[1];
            /*echo $minutosIngresoBreak." ";*/
            $tiempobreak=$minutosIngresoBreak-$minutosSalidaBreak;
            /*echo $tiempobreak." ";*/
            $horastrabajo = ($minutosSalida - $minutosIngreso)-($minutosIngresoBreak-$minutosSalidaBreak);
            $horasenwakas=$horastrabajo/60;
            $horasenwakas1=round($horasenwakas,2,1);
            /*echo $fila1['horaIngreso'] . " ";
            echo $fila1['horaSalida'] . " ";
            echo "$minutosIngreso ";
            echo "$minutosSalida ";
            echo "$horastrabajo ";*/
            $horastotaleswakas=$horastotaleswakas+$horastrabajo;
            $horastotaleswakas1=round(($horastotaleswakas/60),2,1);
        }
        echo "<td>".$horastotaleswakas1." horas</td>";
        $result4=selectTableWhere2('empleadoactividadmuerta','idEmpleado',"'".$fila2['idEmpleado']."'",'idMaquina',"'".$_POST['idmaq1']."'");
        while ($fila4=mysql_fetch_array($result4)){
            $tiempomuerto=$tiempomuerto+$fila4['tiempo'];
        }
        $tiempoefectivo=$horastrabajo-$tiempomuerto;
        $tiempoefectivototal=$tiempoefectivototal+$tiempoefectivo;
    }
    $rendimientomaquinames=($tiempoefectivototal/$horastotaleswakas)*100;
    $rendimientomaquinames1=round($rendimientomaquinames,2,1);
    echo "<td>".$rendimientomaquinames1." %</td>";
    echo "
            <td>
                <form action='reporterendimientodiamaq.php' method='post'>
                    <input type='hidden' name='idmaq' value='".$_POST['idmaq1']."' readonly>
                    <input type='hidden' name='fecha' value='".$fila['fecha']."' readonly>
                    <input type='submit' name='rendidario' value='Ver Detalle' class='btn-link'>
                </form>
            </td>
    ";
    echo "</tr>";
}
echo "
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
    ";
?>
<section class='container'>
    <form action='reporterendimientomaqmenspdf.php' method='post' class='form-horizontal col-sm-12'>
        <input type='hidden' name='idmaq1' value="<?php echo $_POST['idmaq1'];?>" readonly>
        <input type='hidden' name='mes' value="<?php echo $_POST['mes'];?>" readonly>
        <input type='hidden' name='mes' value="<?php echo $_POST['año'];?>" readonly>
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