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
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formatos.css" rel="stylesheet">
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
<?php
$lote=strtoupper ($_POST["idlote"]);
?>
<section class='container-fluid'>
    <div class='col-sm-1'>
        <div>
            <img width='110' height='110' src='image/logowakas.jpg'/>
        </div>
    </div>
    <div class='col-sm-6' id='descripcionbrand'>
        <div>
            <span id='brand'>W<span class='alfa'>&alpha;</span>k<span class='alfa'>&alpha;</span>-s <span id='subbrand'>Textiles Finos SAC</span></span>
        </div>
        <div>
            <span>Urb. Francisco Mostajo G-25</span>
        </div>
        <div>
            <span>04002 Arequipa - Peru</span>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='titulo'>
            <h3>Detalle de Lote</h3>
        </div>
        <div>
            <h4 class='desctitulo'>
                <?php
                echo $lote;
                ?>
            </h4>
        </div>
    </div>
</section>
<hr>
<section class="container">
    <div class="col-sm-12">
        <label for='avance'>Avance del Lote:</label>
        <span id='avance'><?php echo $_POST['avance']?></span>
    </div>
    <hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Empleado</th>
                <th>Procedimiento</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result=selectOrderedTableWhere('EmpleadoLote','idLote',"'".$lote."'",'fecha');
        while ($fila=mysql_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$fila['fecha']."</td>";
            $result1=selectTableWhere('Empleado','idEmpleado',"'".$fila['idEmpleado']."'");
            while ($fila1=mysql_fetch_array($result1)){
                echo "<td>".$fila1['nombres']." ".$fila1['apellidos']."</td>";
            }
            $result2=selectTableWhere('SubProceso','idProcedimiento',"'".$fila['idProcedimiento']."'");
            while ($fila2=mysql_fetch_array($result2)){
                echo "<td>".$fila2['descripcion']."</td>";
            }
            echo "<td>".$fila['cantidad']."</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
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