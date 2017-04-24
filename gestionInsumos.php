<!doctype html>
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
        <title>Gesti&oacute;n de Insumos</title>
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
            <div class="col-sm-12">
                <form action="gestionInsumos.php" method="post" class="form-horizontal jumbotron col-sm-12">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-5">
                            <label for="buscarins" class="formlabels col-sm-12">Buscar Insumos:</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" id="buscarins" name="filtroInsumo" class="textinput-12">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <input class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" name="buscarins" value="Buscar">
                            </div>
                            <div class="col-sm-6">
                                <input formaction="gestionInsumos.php" class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" value="Eliminar Filtro">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <hr>
        <?php
            if(isset($_GET['eliminarInsumo'])) {
                $eliminar1 = "DELETE FROM InsumosProveedor WHERE idInsumo = '".$_GET['eliminarInsumo']."'";
                $resutlt2 = mysql_query($eliminar1);
                $eliminar = "DELETE FROM insumos WHERE idInsumo = '".$_GET['eliminarInsumo']."'";
                $resutlt1 = mysql_query($eliminar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }

            if(isset($_POST['guardarins'])){
                $agregar = "INSERT INTO insumos(idInsumo, descripcion, idUnidadMedida) VALUES ('".$_POST['idIns']."','".$_POST['descins']."','".$_POST['unimed']."')";
                $agregar1 = mysql_query($agregar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }

            if(isset($_POST['actualizarins'])){
                $actualziar="UPDATE Insumos SET descripcion = '".$_POST['descins']."' WHERE idInsumo = '".$_POST['idIns']."'";
                $actualziar1=mysql_query($actualziar);
                $actualziar4="UPDATE Insumos SET idUnidadMedida = '".$_POST['unimed']."' WHERE idInsumo = '".$_POST['idIns']."'";
                $actualziar5=mysql_query($actualziar4);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }

            if(isset($_POST['buscarins'])){
                echo "
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idInsumo</th>
                                    <th>Descrici&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th></th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
                $result = selectTableWhereLikeSingle('Insumos','descripcion',"'".$_POST['filtroInsumo']."'");
                while($fila=mysql_fetch_array($result)){
                    echo "
                                <tr>
                                    <td>".$fila['idInsumo']."</td>
                                    <td>".$fila['descripcion']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td><a href='asignarproveedoresins.php?idInsumo=".$fila['idInsumo']."'>Asignar Proveedores</a></td>
                                    <td><a href='actualizarInsumo.php?idInsumo=".$fila['idInsumo']."'>Modificar</a></td>
                                </tr>
                    ";
                }
                echo "
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class='container'>
                         <form class='form-horizontal col-sm-12'>
                         	<div class='col-sm-6'>
                                 <button class='btn btn-default col-sm-6 col-sm-offset-3' formaction='gestionProveedores.php'>Proveedores</button>
                            </div>
                            <div class='col-sm-6'>
                                 <button class='btn btn-success col-sm-6 col-sm-offset-3' formaction='agregarInsumo.php'>Agregar</button>
                            </div>
                         </form>
                    </div>
                ";
            }else{
                unset($_POST['buscarins']);
                unset($_POST['filtroInsumo']);
                echo "
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idInsumo</th>
                                    <th>Descrici&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th></th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
                $result = mysql_query("SELECT * FROM insumos ORDER BY LENGTH(idInsumo)");
                while($fila = mysql_fetch_array($result)) {
                    echo "
                                 <tr>
                                    <td>".$fila['idInsumo']."</td>
                                    <td>".$fila['descripcion']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td><a href='asignarproveedoresins.php?idInsumo=".$fila['idInsumo']."'>Asignar Proveedores</a></td>
                                    <td><a href='actualizarInsumo.php?idInsumo=".$fila['idInsumo']."'>Modificar</a></td>
                                </tr>
                    ";
                }
                echo "
                         </tbody>
                       </table>
                    </div>
                    <hr>
                    <div class='container'>
                         <form class='form-horizontal col-sm-12'>
                         	<div class='col-sm-6'>
                                 <button class='btn btn-primary col-sm-6 col-sm-offset-3' formaction='gestionProveedores.php'>Proveedores</button>
                            </div>
                            <div class='col-sm-6'>
                                 <button class='btn btn-success col-sm-6 col-sm-offset-3' formaction='agregarInsumo.php'>Agregar</button>
                            </div>
                         </form>
                    </div>
                ";
            }
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>
        <br>
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