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
    <title>Ver Orden de Producción</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="lib/barcode/JsBarcode.all.min.js"></script>

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

<section class="container">
    <div>
        <h3>Creación de Códigos de Barras</h3>
    </div>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>idLote</th>
                <th>Código</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $indice=0;
            $result1="SELECT * FROM lote WHERE idOrdenProduccion ='".$_POST['idop']."' ORDER BY posicion";
            $result=mysql_query($result1);
            while ($fila=mysql_fetch_array($result)){
                $bar=$fila['idLote'];
                echo "<tr>";
                echo "<td>".$bar."</td>";
                echo "<td><canvas id='".$indice."'></canvas></td>";
                ?>
                <script>
                    $(document).ready(function () {
                        $("#<?php echo $indice;?>").JsBarcode("<?php echo $bar;?>");
                    });
                </script>
                <?php
                $indice++;
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>
<hr>
<section class="container">
    <form class="form-horizontal" method="post">
        <div class="form-group jumbotron">
            <div>
                <h4>Agregar Observación para Tarjetas</h4>
            </div>
            <hr>
            <div class="col-sm-6 col-sm-offset-3 ">
                <textarea id="obs" rows="3" name="observacion" class="areainput-12"></textarea>
            </div>
        </div>
        <div class="col-sm-4">
            <input type="submit" class="btn btn-default col-sm-8 col-sm-offset-2" formaction="gestionOP.php" value="Regresar">
        </div>
        <div class="col-sm-4">
            <input type="button" onclick="uploadEx()" value="Descargar Códigos" class="btn btn-primary col-sm-8 col-sm-offset-2">
        </div>
        <div class="col-sm-4">
            <input type="hidden" name="idop" value="<?php echo $_POST['idop'];?>" readonly>
            <input type="submit" class="btn btn-primary col-sm-8 col-sm-offset-2" name="tarjetas" value="Descargar Tarjetas" formaction="tarjetasOPpdf.php">
        </div>
    </form>
</section>
<br>
<form method="post" accept-charset="utf-8" name="form1">
    <input name="hidden_data" id='hidden_data' type="hidden"/>
    <input name="name" id='name' type="hidden"/>
    <input name="op" id='op' type="hidden" value="<?php echo $_POST['idop'];?>"/>
</form>
<script>
    function uploadEx() {
        for ($i=0; $i<<?php echo $indice+1?>; $i++) {

                var canvas = document.getElementById($i);
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                document.getElementById('name').value = $i+1;
                var fd = new FormData(document.forms["form1"]);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_data.php', true);

                xhr.upload.onprogress = function (e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');

                    }
                };

                xhr.onload = function () {

                };
                xhr.send(fd);
            }
        }

</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>