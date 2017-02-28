<!doctype html>
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
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
            <form action="gestionInsumos.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Actualizar Insumo</h3>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="idinsumo" class="formlabels col-sm-12">IdInsumo:</label>
                    </div>
                    <div class="col-sm-9">
                        <?php
                            echo "
                                <input class='textinput-4' id='idinsumo' type='text' name='idIns' value='".$_GET['idInsumo']."' readonly>
                            ";
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="desc" class="formlabels col-sm-12">Descripci&oacute;n:</label>
                    </div>
                    <div class="col-sm-9">
                        <?php
                            $valor=selectTableWhere("Insumos","idInsumo","'".$_GET['idInsumo']."'");
                            while($fila=mysql_fetch_array($valor)){
                                echo "
                                    <input class='textinput-12' id='desc' type='text' name='descins' value='".$fila['descripcion']."'>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="uni" class="formlabels col-sm-12">Unidad de Medida:</label>
                    </div>
                    <div class="col-sm-9">
                        <select id="uni" name="unimed" class="ddselect-5">
                            <option>Seleccionar</option>
                            <?php
                                $valor=selectTable('UnidadMedida');
                                while($fila=mysql_fetch_array($valor)){
                                    echo "
                                    <option>" . $fila['idUnidadMedida'] . "</option>
                                ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <input class='btn btn-success col-sm-6 col-sm-offset-3' type="submit" name="actualizarins" value="Guardar Cambios">
                        </div>
                        <div class="col-sm-6">
                            <input formaction="gestionInsumos.php" class='btn btn-success col-sm-6 col-sm-offset-3' type="submit" value="Regresar">
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
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

