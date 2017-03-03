<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Procedimientos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">

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

<section class="container">
<?php
if(isset($_POST['guardarsubproc'])){
    $agregar = "INSERT INTO Subproceso(idProcedimiento, idProceso, descripcion) VALUES ('".$_POST['idSubProc']."','".$_POST['idProc']."','".$_POST['desc']."')";
    $agregar1 = mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }else{
        echo "<br>";
        echo "<div class='alert alert-success' role='alert'>";
        echo 	"<p> <strong>Subproceso añadido exitosamente</strong></p>";
        echo " </div>";
    }
}
if(isset($_GET['eliminarProceso'])) {
    /*Código para eliminar en cascada todo lo relacionado al Subproceso.*/
}
?>
</section>
<section>
    <div class='container'>
        <h3>Subprocesos de
            <?php
            $result=selectTableWhere('Proceso','idProceso',"'".$_POST['idProceso']."'");
            while($fila=mysql_fetch_array($result)){
                echo $fila['descripcion'];
            }
            ?>
        </h3>
        <table class='table table-hover table-condensed'>
            <thead>
            <tr>
                <!--<th>idProceso</th>
                <th>idSubproceso</th>-->
                <th>Descripción</th>
                <th>Asignar M&aacute;quina</th>
                <th>Editar</th>
                <th>Ver Caracter&iacute;sticas</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result=selectTableWhere('SubProceso','idProceso',"'".$_POST['idProceso']."'");
            while ($fila=mysql_fetch_array($result)){
                echo "<tr>";
                    //echo "<td>".$_POST['idProceso']."</td>";
                    //echo "<td>".$fila['idProcedimiento']."</td>";
                    echo "<td>".$fila['descripcion']."</td>";
                    echo "  <td>
                                <form method='post'>
                                    <input class='btn btn-default' type='submit' formaction='#' value='Asignar'>
                                    <input type='hidden' name='idProceso' value='".$fila['idProceso']."'>
                                </form>                                                                     
                            </td>";
                    echo "<td><a href='#'>Editar</a></td>";
                    echo "  <td>
                                <form method='post'>
                                    <input class='btn btn-default' type='submit' formaction='gestionCaracteristicas.php' value='Ver'>
                                    <input type='hidden' name='idProcedimiento' value='".$fila['idProcedimiento']."'>
                                </form>
                            </td>";
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
        <form action="agregarSubProceso.php" method="post">
            <div>
                <input class='btn btn-success' type="submit" name="agregar" value="Agregar Subproceso">
                <input type='hidden' name='idProceso' value="<?php echo $_POST['idProceso']?>">
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
