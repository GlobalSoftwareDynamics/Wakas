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
    <title>Gestion Caracteristicas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
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

<!-- Insert/Eliminación de datos de agregarCaracteristica.php-->

<?php
if(isset($_POST['insertar'])){
    $result = mysql_query("SELECT * FROM Caracteristica WHERE idCaracteristica = '".$_POST['selectcaracteristica']."'");
    while($fila = mysql_fetch_array($result)){
        $tipo = $fila['tipo'];
    }
    $agregar = "INSERT INTO SubProcesoCaracteristica (idSubprocesoCaracteristica, idProcedimiento, idCaracteristica, tipo) VALUES ('".$_POST['idSubprocesoCaracteristica']."','".$_POST['idProcedimiento']."','".$_POST['selectcaracteristica']."','".$tipo."')";
    $agregar1 = mysql_query($agregar);
}
if(isset($_POST['eliminar'])){
    $eliminar = "DELETE FROM SubProcesoCaracteristica WHERE idProcedimiento = '".$_POST['idProcedimiento']."' AND idCaracteristica = '".$_POST['caracteristica']."'";
    $eliminar1 = mysql_query($eliminar);
}
?>

<!-- Tabla de Características-->

<section class="container">
    <div>
        <h3>Caracter&iacute;sticas de <?php
            $result=selectTableWhere('SubProceso','idProcedimiento',"'".$_POST['idProcedimiento']."'");
            while($fila = mysql_fetch_array($result)){
                echo $fila['descripcion'];
            }
            ?>
        </h3>
        <div class="alert alert-warning" role="alert">
            <strong>Recuerde!</strong> La Característica #1 debe ser siempre "Componente" para cualquier combinación de Proceso/Subproceso.
        </div>
    </div>
    <hr>
    <div>
        <table class='table table-hover'>
            <thead>
            <tr>
                <th>#</th>
                <th>Caracter&iacute;stica</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $aux = 1;
                $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = '".$_POST['idProcedimiento']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                //$result=selectTableWhere('SubProcesoCaracteristica','idProcedimiento',"'".$_POST['idProcedimiento']."'");
                while ($fila=mysql_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>".$aux."</td>";
                        $aux++;
                        $result2=selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                        while($fila2=mysql_fetch_array($result2)){
                            echo "<td>".$fila2['descripcion']."</td>";
                        }
                        echo "<td><form method='post' action='#'>
                                    <input type='submit' class='btn-link' name='eliminar' value='Eliminar'>
                                    <input type='hidden' name='idProcedimiento' value='".$_POST['idProcedimiento']."'>
                                    <input type='hidden' name='caracteristica' value='".$fila['idCaracteristica']."'>
                              </form></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<hr>

<section class='container'>
    <div class="container">
        <form action="agregarCaracteristica.php" method="post" class="form-horizontal col-sm-12">
            <div>
                <input type="hidden" name="idProceso" value="<?php echo $_POST['idProceso']?>">
                <input type="hidden" name="idProcedimiento" value="<?php echo $_POST['idProcedimiento']?>">
                <input class='btn btn-default col-sm-3 col-sm-offset-2' type="submit" name="agregar" value="Agregar Caracter&iacute;stica">
                <input class="btn btn-default col-sm-3 col-sm-offset-2" type="submit" name="regresar" value="Regresar" formaction="gestionSubprocesos.php">
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
