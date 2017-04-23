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
            if(isset($_POST['eliminar'])){
                $eliminar = "DELETE FROM ConfirmacionVentaProducto WHERE idProducto = '".$_POST['producto']."' AND idColor = '".$_POST['color']."' 
                AND idTalla = '".$_POST['talla']."' AND idMaterial = '".$_POST['material']."'";
                $resutlt = mysql_query($eliminar);
            }
        ?>
        <section class="container">
            <div>
                <h3>Paso 3: Confirmación de Productos Seleccionados</h3>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Talla</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result=selectTableWhere('ConfirmacionVentaProducto','idContrato',"'".$_POST['contrato']."'");
                    while($fila=mysql_fetch_array($result)){
                        echo "
                                <tr>
                                    <td>".$fila['idProducto']."</td>
                            ";
                        $result2=selectTableWhere('Talla','idTalla',"'".$fila['idTalla']."'");
                        while ($fila3=mysql_fetch_array($result2)){
                            echo "
                                <td>".$fila3['descripcion']."</td>
                            ";
                            $idcodif=$fila3['idcodificacionTalla'];
                        }
                        $result1=selectTableWhere('Material','idMaterial',"'".$fila['idMaterial']."'");
                        while ($fila2=mysql_fetch_array($result1)){
                            echo "
                                    <td>".$fila2['material']."</td>
                                ";
                        }
                        echo "
                                    <td>".$fila['idColor']."</td>
                                    <td>
                                        <form action='nuevaCV3.php' method='post'>
                                            <input type='hidden' name='contrato' value='".$_POST['contrato']."'>
                                            <input type='hidden' name='producto' value='".$fila['idProducto']."'>
                                            <input type='hidden' name='color' value='".$fila['idColor']."'>
                                            <input type='hidden' name='talla' value='".$fila['idTalla']."'>
                                            <input type='hidden' name='material' value='".$fila['idMaterial']."'>
                                            <input type='hidden' name='idcodificacionTalla' value='".$idcodif."'>
                                            <input type='submit' class='btn-link' name='eliminar' value='Eliminar'>
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
        <hr>
        <section class="container">
            <form action="nuevaCV4.php" method="post">
                <input type="hidden" name="contrato" value="<?php echo $_POST['contrato']; ?>">
                <input type="hidden" name="idcodificacionTalla" value="<?php echo $_POST['idcodificacionTalla']; ?>">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-default col-sm-4 col-sm-offset-4" formaction="nuevaCV2.php" name="regresar" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-primary col-sm-4 col-sm-offset-4" name="siguiente" value="Siguiente">
                    </div>
                </div>
            </form>
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
    