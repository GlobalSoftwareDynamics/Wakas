<!DOCTYPE html>

<html>

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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script>
        function getSubproceso(val) {
            $.ajax({
                type: "POST",
                url: "get_subproceso.php",
                data:'idProceso='+val,
                success: function(data){
                    $("#selectsubproceso").html(data);
                    $.ajax({
                        type: "POST",
                        url: "get_tablasubproceso.php",
                        data:'idSubproceso='+val2,
                        success: function (data) {
                            $("#tablaSubproceso").html(data);
                        }
                    })
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

<!-- Insert de datos -->



<!-- Seleecionar Subproceso -->

<section class="container">
    <form action="#" method="post">
        <div class="form-group">
            <div>
                <label for="selectproceso">Seleccionar Proceso</label>
            </div>
            <div>
                <?php
                $result = selectTable("proceso");
                echo "<select name='selectproceso' id='selectproceso' onChange=\"getSubproceso(this.value);\">";
                echo "<option>Seleccionar</option>";
                while($fila = mysql_fetch_array($result)){
                    $aux = $fila['idProceso'];
                    echo "<option value=".$fila['idProceso'].">".$fila['descripcion']."</option>";
                }
                echo "</select>";
                ?>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="selectsubproceso">Seleccionar Subproceso</label>
            </div>
            <div>
                <select name="selectsubproceso" id="selectsubproceso">
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Agregar" name="agregarsubproceso">
            <input class="btn btn-default" type="submit" value="Siguiente" name="siguiente" formaction="nuevaHE5.php">
        </div>
    </form>
</section>

<!-- Tabla para Visualizar -->

<section class="container">
    <table id="tablaSubproceso">

    </table>
</section>

<!-- Tabla para Agregar -->

<section class="container">

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

    <?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

</html>