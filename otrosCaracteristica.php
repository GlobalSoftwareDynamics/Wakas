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
    <link href="css/Tablas.css" rel="stylesheet">

</head>

<body>
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

<?php
if(isset($_POST['guardar'])){
    $agregar="INSERT INTO Caracteristica VALUES ('".$_POST['idCaracteristica']."','".$_POST['descripcion']."','".$_POST['selecttipo']."')";
    $agregar1=mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }else{
        echo "<br>
                    <div class='container col-sm-12'>
                        <div class='alert alert-success' role='alert'>
                            <p><strong>Caracterítica Agregada Exitosamente</strong></p>
                        </div>
                    </div>
                ";
    }
}
if(isset($_GET['eliminarCaracteristica'])){
    $eliminar="DELETE FROM caracteristica WHERE idCaracteristica ='".$_GET['eliminarCaracteristica']."'";
    $eliminar1=mysql_query($eliminar);
}
?>
<section class="container col-sm-7">
    <form action="#" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
        <div>
            <h3>Nueva Caracter&iacute;stica</h3>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <label for="idCaracteristica" class="formlabels1 col-sm-12">idCaracteristica:</label>
            </div>
            <div class="col-sm-12">
                <?php
                $aux = 0;
                $result = selectTable("Caracteristica");
                while($fila = mysql_fetch_array($result)){
                    $aux++;
                }
                $aux++;
                echo "<input class='textinput-6' id='idCaracteristica' type='text' name= 'idCaracteristica' value='CARAC".$aux."' readonly>";
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label for="Descripcion" class="formlabels1 col-sm-12">Descripcion:</label>
            </div>
            <div class="col-sm-12">
                <input class="textinput-12" id="Descripcion" type="text" name="descripcion">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label for="selecttipo" class="formlabels1 col-sm-12">Tipo:</label>
            </div>
            <div class="col-sm-12">
                <select name="selecttipo" id="selecttipo" class="ddselect-12">
                    <option value="componente">Componente</option>
                    <option value="maquina">Maquina</option>
                    <option value="insumo">Insumo</option>
                    <option value="idinsumo">ID Insumo</option>
                    <option value="material">Material</option>
                    <option value="galga">Galga</option>
                    <option value="fotografia">Fotograf&iacute;a</option>
                    <option value="color">Color</option>
                    <option value="fotografiaproducto">Fotografía de Producto</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-6">
                <input formaction="menuagregarotros.php" class="btn btn-default boton col-sm-10 col-sm-offset-1" type="submit" value="Regresar">
            </div>
            <div class="col-sm-6">
                <input class="btn btn-success boton col-sm-10 col-sm-offset-1"type="submit" name="guardar" value="Agregar">
            </div>
        </div>
    </form>
</section>

<section class="container col-sm-5">
    <div class="container col-sm-10 col-sm-offset-1">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Descripción</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result1=selectTable('Caracteristica');
            while ($fila1=mysql_fetch_array($result1)){
                echo "
                            <tr>
                                <td>".$fila1['descripcion']."</td>
                                <td><a href='otrosCaracteristica.php?eliminarCaracteristica=".$fila1['idCaracteristica']."'>Eliminar</a></td>
                            </tr>
                        ";
            }
            ?>
            </tbody>
        </table>
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
