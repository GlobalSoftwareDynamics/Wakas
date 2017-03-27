<!DOCTYPE html>

<html lang="es">

<?php
session_start();
require('funciones.php');
$con=mysql_connect("localhost","root","");
if($con){
    $bd=mysql_select_db("wakas",$con);
    if(!$bd) echo "No existe la bd";
}else{
    echo "No existe la conexi&oacute;n";
}

if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
    ?>
    <head>
        <meta charset="UTF-8">
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

    <!-- Seleecionar Subproceso -->
    <section class="container">
        <h3>Agregar Fotografía de Producto (Máximo 1)</h3>
        <hr>
        <?php
        echo "<form action='uploadfotoproducto.php' method='post' enctype='multipart/form-data' class='form-horizontal jumbotron col-sm-6 col-sm-offset-3'>";
        echo "<input type='hidden' name='idProd' value='".$_POST['idProd']."'>";
        echo "
            <div class='col-sm-12'>
                <input type='file' name='fileToUpload' id='fileToUpload'>
            </div>
            <hr>
        ";
        echo "<input type='submit' value='Upload Image' name='submit' class='btn btn-default col-sm-8 col-sm-offset-2'>";
        echo "</form>";
        ?>
        <br>
    </section>

    <hr>

    <section class="container">
        <h3>Agregar Fotografía de Etiquetado y Embolsado (Máximo 4)</h3>
        <hr>
        <?php
                    echo "<form action='upload.php' method='post' enctype='multipart/form-data' class='form-horizontal jumbotron col-sm-6 col-sm-offset-3'>";
                    echo "<input type='hidden' name='idProd' value='".$_POST['idProd']."'>";
                    echo "
                        <div class='col-sm-12'>
                            <input type='file' name='fileToUpload' id='fileToUpload'>
                        </div>
                        <hr>
                    ";
                    echo "<input type='submit' value='Upload Image' name='submit' class='btn btn-default col-sm-8 col-sm-offset-2'>";
                    echo "</form>";
        ?>
        <br>
    </section>

<hr>

    <section class="container">
    <form method="post" action="HEFinal.php">
        <div class="col-sm-12">
            <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
            <input type="submit" value="Finalizar" name="Finalizar" class="btn btn-default col-sm-4 col-sm-offset-4">
        </div>
    </form>
    </section>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

</html>




