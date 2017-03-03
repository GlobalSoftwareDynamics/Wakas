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
        <title>Gesti&oacute;n de M&aacute;quinas</title>
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

		<?php
            if(isset($_GET['eliminarMaquina'])) {
            $eliminar1 = "DELETE FROM RepuestosMaquina WHERE idMaquina = '".$_GET['eliminarMaquina']."'";
            $resutlt2 = mysql_query($eliminar1);
            $eliminar = "DELETE FROM maquina WHERE idMaquina = '".$_GET['eliminarMaquina']."'";
            $resutlt1 = mysql_query($eliminar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }else{
                    echo "<br>";
                    echo "<div class='alert alert-success' role='alert'>";
                    echo 	"<p> <strong>Máquina Eliminada Exitosamente</strong></p>";
                    echo " </div>";
                }
            }

            if(isset($_POST['guardarmaq'])){
            $agregar = "INSERT INTO maquina(idMaquina, descripcion, costoFijo) VALUES ('".$_POST['idMaq']."','".$_POST['descmaq']."','".$_POST['costo']."')";
            $agregar1 = mysql_query($agregar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }else{
                    echo "<br>";
                    echo "<div class='alert alert-success' role='alert'>";
                    echo 	"<p> <strong>Máquina Agregada Exitosamente</strong></p>";
                    echo " </div>";
                }
            }

            if(isset($_POST['actualizarmaq'])){
            $actualziar2="UPDATE maquina SET descripcion = '".$_POST['descmaq']."' WHERE idMaquina = '".$_POST['idMaq']."'";
            $actualziar3=mysql_query($actualziar2);
            $actualziar4="UPDATE maquina SET costoFijo = '".$_POST['costo']."' WHERE idMaquina = '".$_POST['idMaq']."'";
            $actualziar5=mysql_query($actualziar4);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }else{
                    echo "<br>";
                    echo "<div class='alert alert-success' role='alert'>";
                    echo 	"<p> <strong>Máquina Actualizada Exitosamente</strong></p>";
                    echo " </div>";
                }
            }

            if(isset($_GET['eliminarRepuestos'])) {
                $eliminar1 = "DELETE FROM RepuestosMaquina WHERE idMaquina = '".$_GET['eliminarRepuestos']."'";
                $resutlt2 = mysql_query($eliminar1);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }else{
                    echo "<br>";
                    echo "<div class='alert alert-success' role='alert'>";
                    echo 	"<p> <strong>Repuesto Eliminado Exitosamente</strong></p>";
                    echo " </div>";
                }
            }
        ?>

        <section class="container">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>idM&aacute;quina</th>
						<th>Descripci&oacute;n</th>
						<th>Costo Fijo</th>
                        <th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$result = selectTable("maquina");
						while($fila = mysql_fetch_array($result)) {
							echo "
								<tr>
										<td>".$fila['idMaquina']."</td>
										<td>".$fila['descripcion']."</td>
										<td>".$fila['costoFijo']."</td>
										<td><a href='verrepuestos.php?idMaquina=".$fila['idMaquina']."'>Repuestos</a>
										<td><a href='actualizarmaquina.php?idMaquina=".$fila['idMaquina']."'>Modificar</a>
										<td><a href='gestionMaquinas.php?eliminarMaquina=".$fila['idMaquina']."'>Eliminar</a>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
            <hr>
			<div class='container'>
                <form>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <button class="btn btn-success col-sm-6 col-sm-offset-3" formaction="agregarMaquina.php">Agregar M&aacute;quina</button>
                        </div>
                        <div class="col-sm-6">
                            <button class='btn btn-success col-sm-6 col-sm-offset-3' formaction="gestionGalgas.php">Gestionar Galgas</button>
                        </div>
                    </div>
                </form>
            </div>
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
