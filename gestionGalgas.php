<!Doctype html>
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
        <title>Gestión de Galgas</title>
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

        <?php
            if(isset($_GET['eliminarGalga'])) {
                $eliminar = "DELETE FROM galgas WHERE idGalgas = '".$_GET['eliminarGalga']."'";
                $resutlt1 = mysql_query($eliminar);
            }

            if(isset($_POST['guardargal'])){
                $agregar = "INSERT INTO galgas(idGalgas, descripcion, idUnidadMedida, idMaquina) VALUES ('".$_POST['idGal']."','".$_POST['descgal']."','".$_POST['unimed']."','".$_POST['idmaq']."')";
                $agregar1 = mysql_query($agregar);
            }

            if(isset($_POST['actualizargal'])){
                $actualziar="UPDATE galgas SET descripcion = '".$_POST['descgal']."' WHERE idGalgas = '".$_POST['idGal']."'";
                $actualziar1=mysql_query($actualziar);
                $actualziar4="UPDATE galgas SET idUnidadMedida = '".$_POST['unimed']."' WHERE idGalgas = '".$_POST['idGal']."'";
                $actualziar5=mysql_query($actualziar4);
                $actualziar6="UPDATE galgas SET idMaquina = '".$_POST['idmaq']."' WHERE idGalgas = '".$_POST['idGal']."'";
                $actualziar7=mysql_query($actualziar6);
            }
        ?>

        <section class="container">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <th>idGalga</th>
                        <th>Descripci&oacute;n</th>
                        <th>Unidad de Medida</th>
                        <th>M&aacute;quina</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $result = selectTable('Galgas');
                    while($fila=mysql_fetch_array($result)){
                        echo "
                                <tr>
                                    <td>".$fila['idGalgas']."</td>
                                    <td>".$fila['Descripcion']."</td> 
                                    <td>".$fila['idUnidadMedida']."</td>
                        ";
                        $result2=selectTableWhere("Maquina","idMaquina","'".$fila['idMaquina']."'");
                        while ($fila2=mysql_fetch_array($result2)){
                            echo "
                                    <td>".$fila2['descripcion']."</td>
                            ";
                        }
                        echo "
                                    <td><a href='actualizarGalga.php?idGalgas=".$fila['idGalgas']."'>Modificar</a></td>
                                    <td><a href='gestionGalgas.php?eliminarGalga=".$fila['idGalgas']."'>Eliminar</a></td>
                                </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
        </section>

        <div class='container'>
            <form method="post">
                <input formaction="agregarGalga.php" class="btn btn-success" type="submit" value="Agregar Galga">
                <input formaction="gestionMaquinas.php" class="btn btn-default" type="submit" value="Regresar a M&aacute;quinas">
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>

    </body>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
