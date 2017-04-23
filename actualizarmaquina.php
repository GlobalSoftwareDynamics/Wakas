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
    
  </head>

	<body>
	    <header>
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
            <form action="gestionMaquinas.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Actualizar Máquina</h3>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="idmaquina" class="formlabels col-sm-12">IdM&aacute;quina:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                            $result2=selectTableWhere("Maquina","idMaquina","'".$_GET['idMaquina']."'");
                            while ($fila2=mysql_fetch_array($result2)){
                                echo "
                                    <input class='textinput-4' id='idmaquina' type='text' value='".$fila2['idMaquina']."' name='idMaq' readonly>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="desmaq" class="formlabels col-sm-12">Descripci&oacute;n:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                            $result3=selectTableWhere("Maquina","idMaquina","'".$_GET['idMaquina']."'");
                            while ($fila3=mysql_fetch_array($result3)){
                                echo "
                                    <input class='textinput-8' id='desmaq' type='text' value='".$fila3['descripcion']."' name='descmaq'>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="costomaq" class="formlabels col-sm-12">Costo Fijo:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                            $result4=selectTableWhere("Maquina","idMaquina","'".$_GET['idMaquina']."'");
                            while ($fila4=mysql_fetch_array($result4)){
                                echo "
                                    <input class='textinput-3' id='costomaq' type='text' value='".$fila4['costoFijo']."' name='costo'>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <input formaction="gestionMaquinas.php" class='btn btn-default col-sm-6 col-sm-offset-3' type="submit" value="Regresar">
                        </div>
                        <div class="col-sm-6">
                            <input class='btn btn-success col-sm-6 col-sm-offset-3' type="submit" name="actualizarmaq" value="Guardar Cambios">
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