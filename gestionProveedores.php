<!DOCTYPE html>
<?php
require('funciones.php');
session_start();
conexion();
if(isset($_SESSION['login'])){
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gesti&oacute;n de Proveedores</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="theme.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="mainAdmin.php">Waka-s</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                        <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
                        <li><a href="rendimiento.php">Visualizaci&oacuten de Rendimiento</a></li>
                        <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operaciones<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                        <li><a href="nuevaHE.php">Nueva Hoja de Especificaciones</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informaci&oacuten Interna<span class="caret"></span></a>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contactos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="gestionClientes.php">Clientes</a></li>
                        <li><a href="gestionProveedores.php">Proveedores</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php
if(isset($_POST['guardar'])){
    $agregar="INSERT INTO Proveedor(idProveedor, nombre, Direccion) VALUES('".$_POST['idProv']."','".$_POST['nombre']."','".$_POST['direc']."')";
    $agregar1=mysql_query($agregar);
}
if(isset($_POST['actualizar'])){
    $actualziar="UPDATE Proveedor SET nombre = '".$_POST['nombre']."' WHERE idProveedor = '".$_POST['idProv']."'";
    $actualziar1=mysql_query($actualziar);
    $actualziar4="UPDATE Proveedor SET Direccion = '".$_POST['direccion']."' WHERE idProveedor = '".$_POST['idProv']."'";
    $actualziar5=mysql_query($actualziar4);
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
}
if(isset($_GET['eliminarRelacionIns'])) {
    $eliminar1 = "DELETE FROM ProveedorInsumos WHERE idProveedor = '".$_GET['eliminarRelacionIns']."'";
    $resutlt2 = mysql_query($eliminar1);
}
if(isset($_GET['eliminarRelacionMat'])) {
    $eliminar1 = "DELETE FROM MaterialProveedor WHERE idProveedor = '".$_GET['eliminarRelacionMat']."'";
    $resutlt2 = mysql_query($eliminar1);
}
if(isset($_GET['eliminarRelacionProc'])) {
    $eliminar1 = "DELETE FROM ProveedorSubproceso WHERE idProveedor = '".$_GET['eliminarRelacionProc']."'";
    $resutlt2 = mysql_query($eliminar1);
}
?>
<section class="container">
    <table class='table table-hover table-condensed'>
        <thead>
        <tr>
            <th>idProveedor</th>
            <th>Nombre</th>
            <th>Direcci&oacute;n</th>
            <th></th>
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
                                    <th>".$fila['idProveedor']."</th>
                                    <th>".$fila['nombre']."</th>
                                    <th>".$fila['Direccion']."</th>
                            ";
            echo "
                                    <td><a href='fichaProveedor.php?idProveedor=".$fila['idProveedor']."'>Ver Ficha</a></td>
                                    <td><a href='actualizarProveedor.php?idProveedor=".$fila['idProveedor']."'>Modificar</a></td>
                                    <td><a href='gestionProveedores.php?eliminarProveedor=".$fila['idProveedor']."'>Eliminar</a></td>
                                </tr>
                            ";
        }
        ?>
        </tbody>
    </table>
</section>

<div class="container">
    <form action="agregarProveedor.php">
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Agregar Proveedor">
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>