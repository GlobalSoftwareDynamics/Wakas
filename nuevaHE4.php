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
                <div class="col-sm-6">
                    <input class="btn btn-default col-sm-12" type="submit" value="Finalizar" name="finalizar" formaction="nuevaHE6.php">
                </div>
                <div class="col-sm-6">
                    <input class="btn btn-default col-sm-12" type="submit" value="Valores de Subproceso" name="siguiente" formaction="nuevaHE5.php">
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