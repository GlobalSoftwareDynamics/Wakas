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
    <title>Gesti&oacute;n de Repuestos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

</head>
<body>

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

<section class="container">
    <form action="gestionRepuestos.php" method="post" class="form-horizontal jumbotron col-sm-12">
        <div class="form-group col-sm-6">
            <div class="col-sm-5">
                <label for="filtroRepuesto" class="formlabels col-sm-12">Buscar Repuesto:</label>
            </div>
            <div class="col-sm-7">
                <input type="text" name="filtroRepuesto" id="filtroRepuesto" class="textinput-12">
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="col-sm-6">
                <input class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" name="buscarrep" value="Buscar">
            </div>
            <div class="col-sm-6">
                <input formaction="gestionRepuestos.php" class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" value="Eliminar Filtro">
            </div>
        </div>
    </form>
</section>

<hr>


<?php
if(isset($_GET['eliminarRepuesto'])) {
    $eliminar1 = "DELETE FROM RepuestosMaquina WHERE idRepuestos = '".$_GET['eliminarRepuesto']."'";
    $resutlt2 = mysql_query($eliminar1);
    $eliminar = "DELETE FROM repuestos WHERE idRepuestos = '".$_GET['eliminarRepuesto']."'";
    $resutlt1 = mysql_query($eliminar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_POST['guardarrep'])){
    $agregar = "INSERT INTO repuestos(idRepuestos, descripcion, idUnidadMedida) VALUES ('".$_POST['idRep']."','".$_POST['descrep']."','".$_POST['unimed']."')";
    $agregar1 = mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_POST['actualizarrep'])){
    $actualziar="UPDATE repuestos SET descripcion = '".$_POST['descrep']."' WHERE idRepuestos = '".$_POST['idRep']."'";
    $actualziar1=mysql_query($actualziar);
    $actualziar4="UPDATE repuestos SET idUnidadMedida = '".$_POST['unimed']."' WHERE idRepuestos = '".$_POST['idRep']."'";
    $actualziar5=mysql_query($actualziar4);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_POST['buscarrep'])){
    echo "
                <section class='container'>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>idRepuesto</th>
                                <th>Descripci&oacute;n</th>
                                <th>Unidad de Medida</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
            ";
    $result = selectTableWhereLikeSingle('Repuestos','descripcion',"'".$_POST['filtroRepuesto']."'");
    while($fila=mysql_fetch_array($result)){
        echo "
                                <tr>
                                    <td>".$fila['idRepuestos']."</td>
                                    <td>".$fila['descripcion']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td><a href='asignarRepuestos.php?idRepuestos=".$fila['idRepuestos']."'>Asignar a M&aacute;quina</a></td>
                                    <td><a href='actualizarRepuestos.php?idRepuestos=".$fila['idRepuestos']."'>Modificar</a></td>
                                </tr>
                    ";
    }
    echo "
                        </tbody>
                    </table>
                </section>
                
                <hr>
                
                <section class='container'>
               	 	 <form class='form-horizontal col-sm-12'>
               	 	    <div class='form-group'>
                            <button class='btn btn-default col-sm-4 col-sm-offset-4' formaction='agregarRepuesto.php'>Agregar Repuesto</button>
                        </div>
                     </form>
                </section>
            ";
}else{
    unset($_POST['buscarrep']);
    unset($_POST['filtroRepuesto']);
    echo "
                    <section class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idRepuesto</th>
                                    <th>Descripci&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
            ";
    $result = selectTable("Repuestos");
    while($fila = mysql_fetch_array($result)) {
        echo "
                                 <tr>
                                    <td>".$fila['idRepuestos']."</td>
                                    <td>".$fila['descripcion']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td><a href='asignarRepuestos.php?idRepuestos=".$fila['idRepuestos']."'>Asignar a M&aacute;quina</a></td>
                                    <td><a href='actualizarRepuestos.php?idRepuestos=".$fila['idRepuestos']."'>Modificar</a></td>
                                </tr>
                    ";
    }
    echo "
                     </tbody>
                   </table>
                </section>
            		<hr>
                <section class='container'>
                    <form class='form-horizontal col-sm-12'>
               	 	    <div class='form-group'>
                            <button class='btn btn-default col-sm-4 col-sm-offset-4' formaction='agregarRepuesto.php'>Agregar Repuesto</button>
                        </div>
                     </form>
                </section>
            ";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>