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
        <title>Nueva Confirmaci&oacute;n de Venta</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link href="css/Formularios.css" rel="stylesheet">
            
        <script>
            $(function() {
                $( "#datepicker" ).datepicker();
            });
            $(function() {
                $( "#datepicker2" ).datepicker();
            });
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

        <section class="container">
            <form action="nuevaCV2.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Paso 1: Datos de Envío</h3>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="selcliente" class="formlabels col-sm-12">Cliente:</label>
                    </div>
                    <div class="col-sm-8">
                        <select id="selcliente" name="cliente" class="ddselect-10">
                            <option>Seleccionar</option>
                            <?php
                                $result=selectTable("Contacto");
                                while($fila=mysql_fetch_array($result)){
                                    echo "
                                        <option value=".$fila['idContacto'].">".$fila['idCliente']." - ".$fila['nombre']." ".$fila['apellido']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="datepicker" class="formlabels col-sm-12">Fecha:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="textinput-4" id="datepicker" name="date">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inco" class="formlabels col-sm-12">Incoterm:</label>
                    </div>
                    <div class="col-sm-8">
                        <select id="inco" class="ddselect-4" name="incoterm">
                            <option>Seleccionar</option>
                            <?php
                                $result1=selectTable("Incoterms");
                                while($fila1=mysql_fetch_array($result1)){
                                    echo "
                                        <option value='".$fila1['idIncoterm']."'>".$fila1['descripcion']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="metodo" class="formlabels col-sm-12">Método de Pago:</label>
                    </div>
                    <div class="col-sm-8">
                        <select id="metodo" class="ddselect-8" name="payment">
                            <option>Seleccionar</option>
                            <?php
                                $result2=selectTable("MetodoPago");
                                while($fila2=mysql_fetch_array($result2)){
                                    echo "
                                        <option value='".$fila2['idMetodoPago']."'>".$fila2['descripcion']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="ourship" class="formlabels col-sm-12">Código de Contrato:</label>
                    </div>
                    <div class="col-sm-8">
                        <input id="ourship" type="text" name="contrato" class="textinput-6">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="refe" class="formlabels col-sm-12">Código de Referencia:</label>
                    </div>
                    <div class="col-sm-8">
                        <input id="refe" class="textinput-6" type="text" name="referencia">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="datepicker2" class="formlabels col-sm-12">Fecha de Envío:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="textinput-4" id="datepicker2" name="shipdate">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="viaenvio" class="formlabels col-sm-12">Vía:</label>
                    </div>
                    <div class="col-sm-8">
                        <select id="viaenvio" class="ddselect-4" name="via">
                            <option>Seleccionar</option>
                            <?php
                                $result3=selectTable("Via");
                                while($fila3=mysql_fetch_array($result3)){
                                    echo"
                                        <option value='".$fila3['idVia']."'>".$fila3['descripcion']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="codif" class="formlabels col-sm-12">Codificación de Talla:</label>
                    </div>
                    <div class="col-sm-8">
                        <select id="codif" class="ddselect-6" name="idcodificacionTalla">
                            <option>Seleccionar</option>
                            <?php
                            $result3=selectTable("CodificacionTalla");
                            while($fila3=mysql_fetch_array($result3)){
                                echo"
                                        <option value='".$fila3['idcodificacionTalla']."'>".$fila3['descripcion']."</option>
                                    ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input class="btn btn-primary col-sm-6 col-sm-offset-3" type="submit" name="guardar" value="Siguiente">
                    </div>
                </div>
            </form>
        </section>
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