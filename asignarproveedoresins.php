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
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
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
        if(isset($_POST['asignar'])){
            $agregar2="INSERT INTO ProveedorInsumos(idProveedor, idInsumo, costo) VALUES ('".$_POST['idProv']."','".$_POST['idIns']."','-')";
            $agregar3=mysql_query($agregar2);
            if ( !empty( $error = mysql_error() ) )
            {
                echo 'Mysql error '. $error ."<br />\n";
            }else{
                echo "<br>";
                echo "<div class='container'>
                        <div class='alert alert-success' role='alert'>
                            <p><strong>Proveedor Asignado Exitosamente</strong></p>
                        </div>
                      </div>
                ";
            }
        }
        ?>

        <section class="container">
            <form action="asignarproveedoresins.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Asignar Proveedor de Insumo</h3>
                </div>
                <hr>
                <?php
                    if(isset($_GET['idInsumo'])){
                        echo "
                                <input type='hidden' name='idIns' value=".$_GET['idInsumo']." readonly>
                            ";
                    }
                    if(isset($_POST['asignar'])){
                        echo "
                                <input type='hidden' name='idIns' value=".$_POST['idIns']." readonly>
                            ";
                    }
                ?>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <label for="proveedor" class="formlabels1 col-sm-12">Seleccionar Proveedor:</label>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <select name="idProv" id="proveedor" class="ddselect-12">
                            <?php
                                $result=selectTable('Proveedor');
                                while ($fila=mysql_fetch_array($result)){
                                    echo "
                                        <option value='".$fila['idProveedor']."'>".$fila['nombre']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="col-sm-5">
                        <label for="cost" class="formlabels col-sm-12">Precio de Venta:</label>
                    </div>
                    <div class="col-sm-7">
                        <input id="cost" type="text" name="costo" class="textinput-3">
                    </div>
                </div>-->
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <input formaction="gestionInsumos.php" class="btn btn-default col-sm-10 col-sm-offset-2" type="submit" value="Regresar">
                        </div>
                        <div class="col-sm-4">
                            <input formaction="gestionProveedores.php" class="btn btn-default col-sm-10 col-sm-offset-2" type="submit" value="Ir a Proveedores">
                        </div>
                        <div class="col-sm-4">
                            <input class="btn btn-success col-sm-10 col-sm-offset-2" type="submit" name="asignar" value="Asignar">
                        </div>
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