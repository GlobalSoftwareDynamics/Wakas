<!DOCTYPE html>
<?php
require('funciones.php');
session_start();
conexion();
if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gesti&oacute;n de Proveedores</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

</head>

<body>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                            <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
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
if(isset($_POST['guardar'])){
    $agregar="INSERT INTO Proveedor(idProveedor, nombre, Direccion) VALUES('".$_POST['idProv']."','".$_POST['nombre']."','".$_POST['direc']."')";
    $agregar1=mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_POST['actualizar'])){
    $actualziar="UPDATE Proveedor SET nombre = '".$_POST['nombre']."' WHERE idProveedor = '".$_POST['idProv']."'";
    $actualziar1=mysql_query($actualziar);
    $actualziar4="UPDATE Proveedor SET Direccion = '".$_POST['direccion']."' WHERE idProveedor = '".$_POST['idProv']."'";
    $actualziar5=mysql_query($actualziar4);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_GET['eliminarProveedor'])) {
    $eliminar1 = "DELETE FROM MaterialProveedor WHERE idProveedor = '".$_GET['eliminarProveedor']."'";
    $resutlt2 = mysql_query($eliminar1);
    $eliminar2 = "DELETE FROM ProveedorInsumos WHERE idProveedor = '".$_GET['eliminarProveedor']."'";
    $resutlt3 = mysql_query($eliminar2);
    $eliminar1 = "DELETE FROM ProveedorSubproceso WHERE idProveedor = '".$_GET['eliminarProveedor']."'";
    $resutlt2 = mysql_query($eliminar1);
    $eliminar = "DELETE FROM Proveedor WHERE idProveedor = '".$_GET['eliminarProveedor']."'";
    $resutlt1 = mysql_query($eliminar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_GET['eliminarRelacionIns'])) {
    $eliminar1 = "DELETE FROM ProveedorInsumos WHERE idProveedor = '".$_GET['eliminarRelacionIns']."'";
    $resutlt2 = mysql_query($eliminar1);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_GET['eliminarRelacionMat'])) {
    $eliminar1 = "DELETE FROM MaterialProveedor WHERE idProveedor = '".$_GET['eliminarRelacionMat']."'";
    $resutlt2 = mysql_query($eliminar1);
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
            <th>idProveedor</th>
            <th>Nombre</th>
            <th>Direcci&oacute;n</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result=selectTable('Proveedor');
        while($fila=mysql_fetch_array($result)){
            echo "
                                <tr>
                                    <td>".$fila['idProveedor']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['Direccion']."</td>
                            ";
            echo "
                                    <td><a href='fichaProveedor.php?idProveedor=".$fila['idProveedor']."'>Ver Ficha</a></td>
                                    <td><a href='actualizarProveedor.php?idProveedor=".$fila['idProveedor']."'>Modificar</a></td>
                                </tr>
                            ";
        }
        ?>
        </tbody>
    </table>
</section>
<hr>
<div class="container">
    <form action="agregarProveedor.php" class="form-horizontal col-sm-12">
        <div class="form-group col-sm-12">
            <input class="btn btn-success col-sm-4 col-sm-offset-4" type="submit" value="Agregar">
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>