<!Doctype html>
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
        <title>Gestión de Galgas</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Tablas.css" rel="stylesheet">

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
            if(isset($_POST['eliminar'])) {
                $eliminarcont="UPDATE galgas SET estado = '0' WHERE idGalgas = '".$_POST['idgalgas']."'";
                $eliminarcont1=mysql_query($eliminarcont);
            }

            if(isset($_POST['guardargal'])){
                $agregar = "INSERT INTO galgas(idGalgas, descripcion, idUnidadMedida, idMaquina, estado) VALUES ('".$_POST['idGal']."','".$_POST['descgal']."','".$_POST['unimed']."','".$_POST['idmaq']."','1')";
                $agregar1 = mysql_query($agregar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }

            if(isset($_POST['actualizargal'])){
                $actualziar="UPDATE galgas SET descripcion = '".$_POST['descgal']."' WHERE idGalgas = '".$_POST['idGal']."'";
                $actualziar1=mysql_query($actualziar);
                $actualziar4="UPDATE galgas SET idUnidadMedida = '".$_POST['unimed']."' WHERE idGalgas = '".$_POST['idGal']."'";
                $actualziar5=mysql_query($actualziar4);
                $actualziar6="UPDATE galgas SET idMaquina = '".$_POST['idmaq']."' WHERE idGalgas = '".$_POST['idGal']."'";
                $actualziar7=mysql_query($actualziar6);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }
        ?>

        <section class="container">
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>idGalga</th>
                        <th>Descripci&oacute;n</th>
                        <th>Unidad de Medida</th>
                        <th>M&aacute;quina</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $result = mysql_query("SELECT * FROM galgas WHERE estado = '1' ORDER BY LENGTH(idGalgas)");
                    while($fila=mysql_fetch_array($result)){
                        echo "
                                <tr>
                                    <td>".$fila['idGalgas']."</td>
                                    <td>".$fila['Descripcion']."</td> 
                                    <td>".$fila['idUnidadMedida']."</td>
                        ";
                        $result2=selectTableWhere("Maquina","idMaquina","'".$fila['idMaquina']."'");
                        while ($fila2=mysql_fetch_array($result2)){
                            echo "
                                    <td>".$fila2['descripcion']."</td>
                            ";
                        }
                        echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idgalgas' value='".$fila['idGalgas']."'>
                                            <input type='submit' class='btn-link' name='modificar' value='Modificar' formaction='actualizarGalga.php'>
                                        </form>
                                    </td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idgalgas' value='".$fila['idGalgas']."'>
                                            <input type='submit' class='btn-link' name='eliminar' value='Eliminar' formaction='gestionGalgas.php'>
                                        </form>
                                    </td>
                                </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
        </section>
        <hr>
        <div class='container'>
            <form method="post">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input formaction="gestionMaquinas.php" class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input formaction="agregarGalga.php" class="btn btn-success col-sm-6 col-sm-offset-3" type="submit" value="Agregar">
                    </div>
                </div>
            </form>
        </div>

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
