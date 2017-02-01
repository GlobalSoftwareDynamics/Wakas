<!doctype HTML>
<?php
session_start();
require('funciones.php');
conexion();
if(isset($_SESSION['login'])){
?>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Confirmaci&oacute;n de Venta</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
            <div>
                <h3>Paso 4: Asignación de Precios</h3>
            </div>
            <form action="nuevaCV4.php" method="post">
                <input type="hidden" name="contrato" value="<?php echo $_POST['contrato']; ?>">
                <div>
                    <div>
                        <label for="selproducto">Producto:</label>
                    </div>
                    <div>
                        <select name="producto" id="selproducto">
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
                <div>
                    <div>
                        <label for="precioprod">Precio:</label>
                    </div>
                    <div>
                        <input type="text" name="precio">
                    </div>
                </div>
                <div>
                    <input type="submit" name="agregar" class="btn btn-default" value="Agregar Precio">
                </div>
            </form>
            <form action="CVFinal.php" method="post">
                <input type="hidden" name="contrato" value="<?php echo $_POST['contrato']; ?>">
                <input type="submit" class="btn btn-default" name="finalizar" value="Finalizar">
            </form>
        </section>

        <section class="container">
            <table>
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
                                            <input type='hidden' name='producto' value='".$fila1['idProducto']."'>
                                            <input type='submit' name='eliminar' value='Eliminar' class='btn btn-link'>
                                        </form>
                                    </td>
                                </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </section>

    </body>

</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>