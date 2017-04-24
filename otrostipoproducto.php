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
    <link href="css/Formularios.css" rel="stylesheet">
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
if(isset($_POST['guardar'])){
    $agregar="INSERT INTO tipoproducto(idTipoProducto,descripcion, tamanoLote, digitoID) VALUES ('".$_POST['idtipoprod']."','".$_POST['descripcion']."','".$_POST['tamanolote']."','".$_POST['digitoID']."')";
    $agregar1=mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }else{
        echo "<br>
                <div class='container'>
                    <div class='alert alert-success' role='alert'>
                        <p><strong>Tipo de Producto Agregado Exitosamente</strong></p>
                    </div>
                </div>
        ";
    }
}
if(isset($_GET['eliminarTipoProducto'])){
    $eliminar="DELETE FROM tipoproducto WHERE idTipoProducto ='".$_GET['eliminarTipoProducto']."'";
    $eliminar1=mysql_query($eliminar);
}
?>

<section class="container col-sm-6">
    <form action="otrostipoproducto.php" method="post" class="form-horizontal jumbotron col-sm-10 col-sm-offset-1">
        <div>
            <h3>Nuevo Tipo de Producto</h3>
        </div>
        <hr>
        <?php
        $aux = 0;
        $result = selectTable("TipoProducto");
        while($fila = mysql_fetch_array($result)){
            $aux++;
        }
        $aux++;
        echo "<input class='textinput-6' type='text' name='idtipoprod' value='".$aux."' readonly>";
        ?>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="formlabels1 col-sm-12" for="idtipo">Tipo de Producto:</label>
            </div>
            <div class="col-sm-12">
                <input id="idtipo" class="textinput-12" type="text" name="descripcion">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="formlabels1 col-sm-12" for="tamano">Tama&ntilde;o de Lote:</label>
            </div>
            <div class="col-sm-12">
                <input id="tamano" class="textinput-6" type="text" name="tamanolote">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="formlabels1 col-sm-12" for="digitoID">Dígito de Identificación:</label>
            </div>
            <div class="col-sm-12">
                <input id="digitoID" class="textinput-6" type="text" name="digitoID">
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-6">
                <input formaction="menuagregarotros.php" class="btn btn-default col-sm-10 col-sm-offset-1" type="submit" value="Regresar">
            </div>
            <div class="col-sm-6">
                <input class="btn btn-default col-sm-10 col-sm-offset-1" type="submit" name="guardar" value="Agregar">
            </div>
        </div>
    </form>
</section>
<section class="container col-sm-6">
    <div class="container col-sm-10 col-sm-offset-1">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Tamaño de Lote</th>
                <th>Digito Inicial</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result1=selectTable('TipoProducto');
            while ($fila1=mysql_fetch_array($result1)){
                echo "
                            <tr>
                                <td>".$fila1['descripcion']."</td>
                                <td>".$fila1['tamanoLote']."</td>
                                <td>".$fila1['digitoID']."</td>
                                <td><a href='otrostipoproducto.php?eliminarTipoProducto=".$fila1['idTipoProducto']."'>Eliminar</a></td>
                            </tr>
                        ";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>