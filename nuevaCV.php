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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
            <nav class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="mainAdmin.php" id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s</a>
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
                                        <option>".$fila1['idIncoterm']."</option>
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
                                        <option value='".$fila2['idMetodoPago']."'>".$fila2['idMetodoPago']."</option>
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
                                        <option value='".$fila3['idVia']."'>".$fila3['idVia']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input class="btn btn-success col-sm-6 col-sm-offset-3" type="submit" name="guardar" value="Continuar">
                    </div>
                </div>
            </form>
        </section>

        <script src="js/bootstrap.min.js"></script>
 			
    </body>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>