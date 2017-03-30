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
        <link href="css/bootstrap.min.css" rel="stylesheet">
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
            <form action="gestionGalgas.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Nueva Galga</h3>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="idgalga" class="formlabels col-sm-12">IdGalga:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                            $aux = 0;
                            $result = selectTable("Galgas");
                            while($fila = mysql_fetch_array($result)){
                                $aux++;
                            }
                            $aux++;
                            echo "<input class='textinput-4' id='idgalga' type='text' name= 'idGal' value='GALGA".$aux."' readonly>";
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="desc" class="formlabels col-sm-12">Descripci&oacute;n:</label>
                    </div>
                    <div class="col-sm-7">
                        <input id="desc" type="text" name="descgal" class="textinput-6">
                    </div>
                </div>
                <div class="form-group">
                    <div  class="col-sm-5">
                        <label for="unimedida" class="formlabels col-sm-12">Unidad de Medida:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id="unimedida" name="unimed" class="ddselect-5">
                            <option>Seleccionar</option>
                            <?php
                                $result=selectTable('UnidadMedida');
                                while($fila=mysql_fetch_array($result)){
                                    echo "
                                        <option>".$fila['idUnidadMedida']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="maquina" class="formlabels col-sm-12">Máquina:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id="maquina" name="idmaq" class="ddselect-8">
                            <option>Seleccionar</option>
                            <?php
                                $result1=selectTable('Maquina');
                                while($fila1=mysql_fetch_array($result1)){
                                    echo "
                                        <option value='".$fila1['idMaquina']."'>".$fila1['descripcion']."</option>
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
                            <input class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" name="guardargal" value="Guardar Galga">
                        </div>
                        <div class="col-sm-6">
                            <input formaction="gestionGalgas.php" class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" value="Regresar">
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