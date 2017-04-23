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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

    <script>
        function getSubproceso(val) {
            $.ajax({
                type: "POST",
                url: "get_subproceso.php",
                data:'idProceso='+val,
                success: function(data){
                    $("#selectsubproceso").html(data);
                }
            });
        }
    </script>
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

<!-- Insert de datos -->



<!-- Seleecionar Subproceso -->

<section class="container">
    <div>
        <h3>Paso 4: Selección de Procesos y Subprocesos para <?php echo $_POST['idProd']?></h3>
    </div>
    <hr>
    <form action="#" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <label for="selectproceso" class="formlabels col-sm-12">Proceso:</label>
                </div>
                <div class="col-sm-7">
                    <?php
                    $result = selectTable("proceso");
                    echo "<select name='selectproceso' id='selectproceso' onChange='getSubproceso(this.value,selectsubproceso.value);' class='ddselect-10'>";
                    echo "<option>Seleccionar</option>";
                    while($fila = mysql_fetch_array($result)){
                        if($fila['tipo']==='1'){
                            $aux = $fila['idProceso'];
                            echo "<option value=".$fila['idProceso'].">".$fila['descripcion']."</option>";
                        }else{

                        }
                    }
                    echo "</select>";
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <label for="selectsubproceso" class="formlabels col-sm-12">Subproceso:</label>
                </div>
                <div class="col-sm-7">
                    <select name="selectsubproceso" id="selectsubproceso" class="ddselect-10">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
                <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
                <div class="col-sm-6">
                    <input class="btn btn-default col-sm-12" type="submit" value="Regresar" name="Regresar" formaction="nuevaHE3.php">
                </div>
                <div class="col-sm-6">
                    <input class="btn btn-success col-sm-12" type="submit" value="Valores de Subproceso" name="siguiente" formaction="nuevaHE5.php">
                </div>
                <hr><br>
                <div class="col-sm-12">
                    <input class="btn btn-primary col-sm-6 col-sm-offset-3" type="submit" value="Finalizar" name="finalizar" formaction="nuevaHE6.php">
                </div>
            </div>
        </div>
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