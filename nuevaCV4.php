<!doctype HTML>
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
    <title>Nueva Confirmaci&oacute;n de Venta</title>
    <link href="css/bootstrap.css" rel="stylesheet">
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

        <?php
            if(isset($_POST['eliminar'])){
                $eliminar = "DELETE FROM precio WHERE idContrato = '".$_POST['contrato']."' AND idProducto = '".$_POST['producto']."'";
                $result2=mysql_query($eliminar);
            }

            if(isset($_POST['agregar'])) {
                $agregar = "INSERT INTO precio(idContrato, idProducto, precio) VALUES ('" . $_POST['contrato'] . "','" . $_POST['producto'] . "','" . $_POST['precio'] . "')";
                $agregar1=mysql_query($agregar);
            }
        ?>
        <section class="container">
            <div class="col-sm-6">
                <form action="nuevaCV4.php" method="post" class="form-horizontal jumbotron col-sm-12">
                    <div>
                        <h3>Paso 4: Asignación de Precios</h3>
                    </div>
                    <hr>
                    <input type="hidden" name="contrato" value="<?php echo $_POST['contrato']; ?>">
                    <input type='hidden' name='idcodificacionTalla' value="<?php echo $_POST['idcodificacionTalla']; ?>">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <label for="selproducto" class="formlabels1 col-sm-12">Producto:</label>
                        </div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <select name="producto" id="selproducto" class="ddselect-12">
                                <option>Seleccionar</option>
                                <?php
                                $result="SELECT DISTINCT idProducto FROM ConfirmacionVentaProducto WHERE idContrato ='".$_POST['contrato']."'";
                                $query=mysql_query($result);
                                while($fila=mysql_fetch_array($query)){
                                    echo "
                                            <option>".$fila['idProducto']."</option>
                                        ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <label for="precioprod" class="formlabels1 col-sm-12">Precio:</label>
                        </div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <input id="precioprod" type="text" name="precio" class="textinput-12">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <input type="submit" name="agregar" class="btn btn-success col-sm-10 col-sm-offset-1" value="Agregar Precio">
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-primary col-sm-10 col-sm-offset-1" formaction="CVFinal.php" name="finalizar" value="Finalizar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 jumbotron">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>idProducto</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result1=selectTableWhere('Precio','idContrato',"'".$_POST['contrato']."'");
                    while ($fila1=mysql_fetch_array($result1)){
                        echo "
                                <tr>
                                    <td>".$fila1['idProducto']."</td>
                                    <td>".$fila1['precio']."</td>
                                    <td>
                                        <form action='nuevaCV4.php' method='post'>
                                            <input type='hidden' name='contrato' value='".$_POST['contrato']."'>
                                            <input type='hidden' name='idcodificacionTalla' value='".$_POST['idcodificacionTalla']."'>
                                            <input type='hidden' name='producto' value='".$fila1['idProducto']."'>
                                            <input type='submit' name='eliminar' value='Eliminar' class='btn-link'>
                                        </form>
                                    </td>
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