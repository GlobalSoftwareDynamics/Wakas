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
    <title>Gestion Procedimientos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Tablas.css" rel="stylesheet">
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
<?php
if(isset($_POST['guardarproc'])){
    $agregar = "INSERT INTO Proceso(idProceso, descripcion) VALUES ('".$_POST['idProc']."','".$_POST['desc']."')";
    $agregar1 = mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}

if(isset($_POST['actualizar'])) {
    $actualizar = mysql_query("UPDATE Proceso SET descripcion = '".$_POST['Descripcion']."' WHERE idProceso = '".$_POST['idProceso']."'");
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }else{
        echo "<div class=\"alert alert-success\" role=\"alert\">
                Proceso actualizado satisfactoriamente.
              </div>";
    }
}
?>
</section>

<section>
    <div class='container'>
        <table class='table table-hover'>
            <thead>
                <tr>
                    <th>idProceso</th>
                    <th>Descripción</th>
                    <th>Ver Subprocesos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result=selectTable('Proceso');
            while ($fila=mysql_fetch_array($result)){
                echo "<tr>";
                    echo "<td>".$fila['idProceso']."</td>";
                    echo "<td>".$fila['descripcion']."</td>";
                    echo "  
                          <form method='post'>
                          <td>
                              <input class=' btn-link' type='submit' formaction='gestionSubprocesos.php' value='Ver'>
                              <input type='hidden' name='idProceso' value='".$fila['idProceso']."'>   
                          </td>";
                    echo "<td><input type='submit' value='Modificar' class='btn-link' formaction='actualizarProceso.php'></td>
                        </form>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<hr>

<section>
        <div class='container'>
            <form action="agregarProceso.php" class="form-horizontal">
                <div class="col-sm-6">
                    <input class='btn btn-default col-sm-4 col-sm-offset-4' type="submit" name="agregar" value="Agregar Proceso">
                </div>
                <div class="col-sm-6">
                    <input class='btn btn-default col-sm-4 col-sm-offset-4' type="submit" name="regresar" value="Regresar" formaction="mainadmin.php">
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
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
