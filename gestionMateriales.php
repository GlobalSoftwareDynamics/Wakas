<!DOCTYPE html>

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
        <title>Gesti&oacute;n de Materiales</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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

		<section class="container">
			<form action="gestionMateriales.php" method="post">
				<div>
                    <div>
                        <label for="buscarmat">Buscar Material:</label>
                    </div>
                    <div>
                        <select id="buscarmat" name="filtroMaterial">
                            <option>Seleccionar Material</option>
                            <?php
                                $datos=selectTable("Material");
                                while($opcion=mysql_fetch_array($datos)){
                                    echo "
                                        <option>".$opcion['material']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" name="buscarmat" value="Buscar">
                    <input class="btn btn-success" type="submit" value="Eliminar Filtro">
                </div>
			</form>
		</section>

		<?php

            if(isset($_GET['eliminarMaterial'])) {
                $eliminar1 = "DELETE FROM MaterialProveedor WHERE idMaterial = '".$_GET['eliminarMaterial']."'";
                $resutlt2 = mysql_query($eliminar1);
                $eliminar = "DELETE FROM material WHERE idMaterial = '".$_GET['eliminarMaterial']."'";
                $resutlt1 = mysql_query($eliminar);
            }

            if(isset($_POST['guardarmat'])){
                $agregar = "INSERT INTO material(idMaterial, idUnidadMedida, material) VALUES ('".$_POST['idMat']."','".$_POST['unimed']."','".$_POST['descmat']."')";
                $agregar1 = mysql_query($agregar);
            }

            if(isset($_POST['actualizarmat'])){
                $actualziar="UPDATE material SET idUnidadMedida = '".$_POST['unimed']."' WHERE idMaterial = '".$_POST['idMat']."'";
                $actualziar1=mysql_query($actualziar);
                $actualziar2="UPDATE material SET material = '".$_POST['descmat']."' WHERE idMaterial = '".$_POST['idMat']."'";
                $actualziar3=mysql_query($actualziar2);
            }

            if(isset($_POST['buscarmat'])){
                echo "
                    <div class='container'>
                        <table class='table table-hover table-condensed'>
                            <thead>
                                <tr>
                                    <th>idMaterial</th>
                                    <th>Descrici&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
                $result = selectTableWhere('Material','material',"'".$_POST['filtroMaterial']."'");
                while($fila=mysql_fetch_array($result)){
                    echo "
                                <tr>
                                    <td>".$fila['idMaterial']."</td>
                                    <td>".$fila['material']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td><a href='asignarproveedormat.php?idMaterial=".$fila['idMaterial']."'>Asignar Proveedores</a></td>
                                    <td><a href='actualizarMaterial.php?idMaterial=".$fila['idMaterial']."'>Modificar</a></td>
                                    <td><a href='gestionMateriales.php?eliminarMaterial=".$fila['idMaterial']."'>Eliminar</a></td>
                                </tr>
                    ";
                }
                echo "
                            </tbody>
                        </table>
                    </div>
                    <div class='container'>
                         <form>
                              <button class='btn btn-success' formaction='agregarMaterial.php'>Agregar Material</button>
                         </form>
                    </div>
                ";
            }else{
                unset($_POST['buscarmat']);
                unset($_POST['filtroMaterial']);
                echo "
                    <div class='container'>
                        <table class='table table-hover table-condensed'>
                            <thead>
                                <tr>
                                    <th>idMaterial</th>
                                    <th>Descrici&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
                $result = selectTable("Material");
                while($fila = mysql_fetch_array($result)) {
                    echo "
                                 <tr>
                                    <td>".$fila['idMaterial']."</td>
                                    <td>".$fila['material']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td><a href='asignarproveedormat.php?idMaterial=".$fila['idMaterial']."'>Asignar Proveedores</a></td>
                                    <td><a href='actualizarMaterial.php?idMaterial=".$fila['idMaterial']."'>Modificar</a></td>
                                    <td><a href='gestionMateriales.php?eliminarMaterial=".$fila['idMaterial']."'>Eliminar</a></td>
                                </tr>
                    ";
                }
                    echo "
                         </tbody>
                       </table>
                    </div>
                    <div class='container'>
                        <form>
                            <button class='btn btn-success' formaction='agregarMaterial.php'>Agregar Material</button>
                        </form>
                    </div>
                ";
            }
        ?>

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>

    </body>

</html>
<?php
    }else{
        echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
    }
?> 
