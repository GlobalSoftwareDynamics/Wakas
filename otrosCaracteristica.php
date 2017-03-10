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
    <form action="#" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
        <div>
            <h3>Nueva Caracter&iacute;stica</h3>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="idCaracteristica" class="formlabels col-sm-12">idCaracteristica:</label>
            </div>
            <div class="col-sm-7">
                <?php
                $aux = 0;
                $result = selectTable("Caracteristica");
                while($fila = mysql_fetch_array($result)){
                    $aux++;
                }
                $aux++;
                echo "<input class='textinput-5' id='idCaracteristica' type='text' name= 'idCaracteristica' value='CARAC".$aux."' readonly>";
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="Descripcion" class="formlabels col-sm-12">Descripcion:</label>
            </div>
            <div class="col-sm-7">
                <input class="textinput-10" id="Descripcion" type="text" name="descripcion">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="selecttipo" class="formlabels col-sm-12">Tipo:</label>
            </div>
            <div class="col-sm-7">
                <select name="selecttipo" id="selecttipo" class="ddselect-6">
                    <option value="componente">Componente</option>
                    <option value="maquina">Maquina</option>
                    <option value="insumo">Insumo</option>
                    <option value="idinsumo">ID Insumo</option>
                    <option value="material">Material</option>
                    <option value="galga">Galga</option>
                    <option value="fotografia">Fotograf&iacute;a</option>
                    <option value="color">Color</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <input class="btn btn-default boton col-sm-6 col-sm-offset-3"type="submit" name="guardar" value="Agregar">
                </div>
                <div class="col-sm-6">
                    <input formaction="menuagregarotros.php" class="btn btn-default boton col-sm-6 col-sm-offset-3" type="submit" value="Regresar">
                </div>
            </div>
        </div>
    </form>
</section>

<?php
if(isset($_POST['guardar'])){
    $agregar="INSERT INTO Caracteristica VALUES ('".$_POST['idCaracteristica']."','".$_POST['descripcion']."','".$_POST['selecttipo']."')";
    $agregar1=mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }else{
        echo "<br>";
        echo "<div class='alert alert-success' role='alert'>";
        echo 	"<p> <strong>Actividad Muerta Agregada Exitosamente</strong></p>";
        echo " </div>";
    }
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
