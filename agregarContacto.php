<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();
mysql_query("SET NAMES 'utf8'");
$pais=SelectTable('Pais');
if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">

            <script>
                function getCiudad(val) {
                    $.ajax({
                        type: "POST",
                        url: "get_ciudad.php",
                        data:'pais_id='+val,
                        success: function(data){
                            $("#listaciudad").html(data);
                        }
                    });
                }
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

        <?php
            if(isset($_POST['guardarcli'])){
                $agregar = "INSERT INTO cliente(idCliente, nombre, estado) VALUES ('".$_POST['idCli']."','".$_POST['nombrecli']."','1')";
                $agregar1 = mysql_query($agregar);
            }
        ?>

        <section class="container">
            <form action="vercontactos.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Ingreso de Datos de Contacto</h3>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="nombre" class="formlabels col-sm-12">Nombres:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="nombre" id="nombre" class="textinput-6">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="apellido" class="formlabels col-sm-12">Apellidos:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="apellido" class="textinput-6" id="apellido">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="pais" class="formlabels col-sm-12">País:</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="pais" id="pais" onChange="getCiudad(this.value);" class="ddselect-5">
                            <option>Pais</option>
                            <?php
                            while($fila=mysql_fetch_array($pais)){
                                echo "
                                    <option value=".$fila['idPais'].">".$fila['pais']."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="listaciudad" class="formlabels col-sm-12">Ciudad:</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="ciudad" id="listaciudad" class="ddselect-5">
                            <option>Ciudad</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="direccion" class="formlabels col-sm-12">Dirección:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="direccion" name="direccion" class="textinput-12">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="tele" class="formlabels col-sm-12">Teléfono:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text"  id="tele" name="tel" class="textinput-4">
                    </div>
                </div>
                <?php
                    $aux2 = 0;
                    $result1 = selectTable("Direccion");
                    while($fila2 = mysql_fetch_array($result1)){
                        $aux2++;
                    }
                    $aux2++;
                    echo "<input type='hidden' name= 'idDir' value='".$aux2."' readonly>";
                ?>
                <input type="hidden" name="cliente" value="<?php echo $_POST['idCli'] ?>">
                <hr>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" formaction="gestionClientes.php" name="regresar" value="Regresar" class="btn btn-default col-sm-6 col-sm-offset-3">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" name="guardar" value="Agregar" class="btn btn-success col-sm-6 col-sm-offset-3">
                    </div>

                </div>
            </form>
        </section>

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
