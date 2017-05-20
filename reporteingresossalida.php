<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();
if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="Waka-s">
    <meta name="application-name" content="Waka-s">
    <meta name="theme-color" content="#ef4a43">
    <title>Gesti&oacute;n de Personal</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

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

<section class="container">
    <form action="reporteingresossalida.php" method="post" class="form-horizontal jumbotron col-sm-12">
        <div class="form-group col-sm-6">
            <div class="col-sm-5">
                <label for="filtroEmpleado" class="formlabels col-sm-12">Buscar por DNI:</label>
            </div>
            <div class="col-sm-7">
                <input type="text" id="filtroEmpleado" name="filtroEmpleado" class="textinput-12">
            </div>
        </div>
        <div>
            <input type="hidden" name="mes" value="<?php echo $_POST['mes']; ?>">
            <input type="hidden" name="año" value="<?php echo $_POST['año']; ?>">
        </div>
        <div class="form-group col-sm-6">
                <div class="col-sm-6">
                    <input class="btn btn-success col-sm-10 col-sm-offset-2 boton" type="submit" name="buscaremp" value="Buscar">
                </div>
                <div class="col-sm-6">
                    <input class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" value="Eliminar Filtro">
                </div>
        </div>
    </form>
</section>

<hr>

<?php

if(isset($_POST['buscaremp'])){
    echo "
            <section class='container'>
                <div>
                    <label for='colab'>Colaborador:</label>";
    $result2=selectTableWhere('empleado','idEmpleado',"'".$_POST['filtroEmpleado']."'");
    while ($fila2=mysql_fetch_array($result2)){
        echo "
                    <span id='colab'>".$fila2['nombres']." ".$fila2['apellidos']." (DNI:".$_POST['filtroEmpleado'].")</span>";
    }
    echo "
                </div>
            </section>
            <hr>
            <section class='container'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora de Ingreso</th>
                            <th>Salida a Refrigerio</th>
                            <th>Entrada de Refrigerio</th>
                            <th>Hora de Salida</th>
				         </tr>
			        </thead>
			        <tbody>
        ";
    $result = mysql_query("SELECT * FROM RegistroIngresoSalida WHERE idEmpleado = ".$_POST['filtroEmpleado']." AND fecha LIKE '".$_POST['mes']."/%%/".$_POST['año']."'");
    while($fila=mysql_fetch_array($result)){
        echo "
                        <tr>
                            <td>".$fila['fecha']."</td>
                            <td>".$fila['horaIngreso']."</td>
                            <td>".$fila['salidaBreak']."</td>
            ";
        echo "
                            <td>".$fila['ingresoBreak']."</td>
                            <td>".$fila['horaSalida']."</td>
                        </tr>
            ";
    }
    echo "
                    </tbody>
		        </table>
		    </section>
		    <hr>
		    <section class='container'>
		        <form method='post' action='reporteingresossalidapdf.php' class='form-horizontal col-sm-12'>
		            <div>
                        <input type='hidden' name='mes' value='".$_POST['mes']."'>
                        <input type='hidden' name='año' value='".$_POST['año']."'>
                        <input type='hidden' name='filtroEmpleado' value='".$_POST['filtroEmpleado']."'>
                    </div>
                    <div class='col-sm-12'>
                        <input type='submit' class='btn btn-primary col-sm-4 col-sm-offset-4' name='pdf' value='Descargar PDF'>
                    </div>
                </form>
            </section>
        ";
}else{
    unset($_POST['buscaremp']);
    unset($_POST['filtroEmpleado']);
    echo "
            <div class='container'>
                 <table class='table table-hover table-condensed'>
                     <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Hora de Ingreso</th>
                                <th>Salida a Refrigerio</th>
                                <th>Entrada de Refrigerio</th>
                                <th>Hora de Salida</th>
				            </tr>
			        </thead>
			        <tbody>
        ";
    $result = mysql_query("SELECT * FROM RegistroIngresoSalida WHERE fecha LIKE '".$_POST['mes']."/%%/".$_POST['año']."'");
    while($fila = mysql_fetch_array($result)) {
        echo "
                             <tr>
                                <td>".$fila['fecha']."</td>
                                <td>".$fila['idEmpleado']."</td>
                                ";
        $result2=selectTableWhere('empleado','idEmpleado',"'".$fila['idEmpleado']."'");
        while ($fila2=mysql_fetch_array($result2)){
            echo "
                                <td>".$fila2['nombres']."</td>
                                <td>".$fila2['apellidos']."</td>
                                ";
        }
        echo "
                                <td>".$fila['horaIngreso']."</td>
                                <td>".$fila['salidaBreak']."</td>
                                <td>".$fila['ingresoBreak']."</td>
                                <td>".$fila['horaSalida']."</td>                                
                            </tr>
                ";
    }
    echo "
                   </tbody>
                </table>
            </div>
            <br>
        ";
}
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