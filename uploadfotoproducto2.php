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
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
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
                    <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                                <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
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

    <section class="container">
        <?php
        $target_dir = "Fotografias/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "<div class='container'><span class='alert alert-success col-sm-8 col-sm-offset-2'>Seleccionada una imagen - " . $check["mime"] . ".</span></div>";
                echo "<br>";
                $uploadOk = 1;
            } else {
                echo "<div class='container'><span class='alert alert-danger col-sm-8 col-sm-offset-2'>El documento seleccionado es sospechoso.</span></div><br>";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "<div class='container'><span class='alert alert-danger col-sm-8 col-sm-offset-2'>Lo lamentamos, su fotografía ya ha sido agregada previamente.</span></div><br>";
            $uploadOk = 0;
        }

        /*if ($_FILES["fileToUpload"]["size"] > 1000000) {
            echo "La fotografía que está intentando subir es demasiado grande, intente reducir su tamaño.";
            $uploadOk = 0;
        }*/

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "<div class='container'><span class='alert alert-danger col-sm-8 col-sm-offset-2'>Lo lamentamos, solo se permiten los formatos de imagen jpg, png, jpeg y gif.</span></div><br>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<div class='container'><span class='alert alert-danger col-sm-8 col-sm-offset-2'>Su fotografía no fue subida.</span></div><br>";

        } else {
            $i = 0;
            $dir = 'Fotografias/';
            if ($handle = opendir($dir)) {
                while (($file = readdir($handle)) !== false){
                    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                        $i++;
                }
            }
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = $_POST['idProd'] . '-prod.' . end($temp);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename)) {
                echo "<div class='container'><span class='alert alert-success col-sm-8 col-sm-offset-2'>La fotografía ". basename( $_FILES["fileToUpload"]["name"]). "  fue registrada exitosamente.</span></div><br>";
            } else {
                echo "<div class='container'><span class='alert alert-danger col-sm-8 col-sm-offset-2'>Lo lamentamos, hubo un error subiendo su fotografía.</span></div><br>";
            }
        }
        ?>
        <hr>
        <form method="post" action="versionHE2.php" class="form-horizontal col-sm-6 col-sm-offset-3">
            <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
            <input type="submit" class="btn btn-default col-sm-8 col-sm-offset-2" value="Volver">
        </form>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>




