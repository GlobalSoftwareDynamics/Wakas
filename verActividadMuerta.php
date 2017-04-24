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
    <title>Waka-s Textiles Finos S.A.</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>

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
        <form action="verActividadMuerta.php" method="post" class="form-horizontal jumbotron col-sm-12">
            <div class="form-group col-sm-6">
                <div class="col-sm-5">
                    <label for="datepicker" class="formlabels col-sm-12">Indique la Fecha:</label>
                </div>
                <div class="col-sm-7">
                    <input type="text" name="fecha" id="datepicker" class="ddselect-12" value="mm/dd/aa">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" name="buscar" value="Buscar">
                    </div>
                    <div class="col-sm-6">
                        <input class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" name="eliminarfiltro" value="Eliminar Filtro">
                    </div>
                </div>
            </div>
        </form>
</section>
<hr>
<section class="container">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Actividad Muerta</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Tiempo Estandar</th>
                    <th>Tiempo Real</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST['buscar'])){
                    $result=selectTableWhere('EmpleadoActividadMuerta','fecha',"'".$_POST['fecha']."'");
                    while ($fila=mysql_fetch_array($result)){
                        $result2 = selectTableWhere("Empleado","idEmpleado","'".$fila['idEmpleado']."'");
                        while($fila2=mysql_fetch_array($result2)){
                            $nombreEmpleado = $fila2['nombres']." ".$fila2['apellidos'];
                        }
                        $result2 = selectTableWhere("ActividadMuerta","idActividadMuerta","'".$fila['idActividadMuerta']."'");
                        while($fila2=mysql_fetch_array($result2)){
                            $actividaddescripcion = $fila2['descripcion'];
                            $tiempoestandar = $fila2['tiempoEstandar'];
                        }
                        echo            "<tr>
                                            <td>".$nombreEmpleado."</td>
                                            <td>".$actividaddescripcion."</td>
                                            <td>".$fila['descripcion']."</td>
                                            <td>".$fila['fecha']."</td>
                                            <td>".$tiempoestandar."</td>
                                            <td>".$fila['tiempo']."</td>
                                        </tr>
                                        ";
                    }
                }else{
                    $result=selectTable('EmpleadoActividadMuerta');
                    while ($fila=mysql_fetch_array($result)){
                        $result2 = selectTableWhere("Empleado","idEmpleado","'".$fila['idEmpleado']."'");
                        while($fila2=mysql_fetch_array($result2)){
                            $nombreEmpleado = $fila2['nombres']." ".$fila2['apellidos'];
                        }
                        $result2 = selectTableWhere("ActividadMuerta","idActividadMuerta","'".$fila['idActividadMuerta']."'");
                        while($fila2=mysql_fetch_array($result2)){
                            $actividaddescripcion = $fila2['descripcion'];
                            $tiempoestandar = $fila2['tiempoEstandar'];
                        }

                        echo            "<tr>
                                            <td>".$nombreEmpleado."</td>
                                            <td>".$actividaddescripcion."</td>
                                            <td>".$fila['descripcion']."</td>
                                            <td>".$fila['fecha']."</td>
                                            <td>".$tiempoestandar."</td>
                                            <td>".$fila['tiempo']."</td>
                                        </tr>
                                        ";
                    }
                }
                ?>
                </tbody>
            </table>
</section>

<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
