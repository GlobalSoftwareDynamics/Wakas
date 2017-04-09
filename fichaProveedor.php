<!doctype html>
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
    <title>Ficha Proveedor</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Formatos.css" rel="stylesheet">
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
                                <li><a href="estadoproceso.php">Visualizaci&oacuten de Estado de Proceso</a></li>
                                <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operaciones<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                                <li><a href="nuevaHE.php">Nueva Hoja de Especificaciones</a></li>
                                <li><a href="OPnueva.php">Nueva Orden de Producción</a></li>
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

    <section class="container-fluid">
        <div class="col-sm-1">
            <div>
                <img width="110" height="110" src="image/logowakas.jpg"/>
            </div>
        </div>
        <div class="col-sm-5" id="descripcionbrand">
            <div>
                <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
            </div>
            <div>
                <span>Urb. Francisco Mostajo G-25</span>
            </div>
            <div>
                <span>04002 Arequipa - Peru</span>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="titulo">
                <h3>Ficha de Proveedor</h3>
            </div>
            <div>
                <?php
                $result=selectTableWhere('Proveedor','idProveedor',"'".$_GET['idProveedor']."'");
                while ($fila=mysql_fetch_array($result)){
                    echo "
                            <h4 class='desctitulo'>PROV ".$fila['nombre']."</h4>
                        ";
                }
                ?>
            </div>
        </div>
    </section>
    <hr>
    <section class="container">
        <div>
            <label for="direccion">Direcci&oacute;n del Proveedor:</label>
            <span id="direccion">
                <?php
                $result=selectTableWhere('Proveedor','idProveedor',"'".$_GET['idProveedor']."'");
                while ($fila=mysql_fetch_array($result)){
                    echo "
                         ".$fila['Direccion']."
                    ";
                }
                ?>
            </span>
        </div>
    </section>

    <section class="container" id="tabla">
        <label>Insumos que Provee:</label>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>IdInsumo</th>
                    <th>Descripci&oacute;n</th>
                    <th>Costo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $result=selectTableWhere('ProveedorInsumos','idProveedor',"'".$_GET['idProveedor']."'");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                    <td>".$fila['idInsumo']."</td>                             
                                ";
                        $result1=selectTableWhere('Insumos','idInsumo',"'".$fila['idInsumo']."'");
                        while ($fila1=mysql_fetch_array($result1)){
                            echo "
                                            <td>".$fila1['descripcion']."</td>
                                        ";
                        }
                        echo "
                                     <td>S/. ".$fila['costo']."</td>
                                     <td><a href='gestionProveedores.php?eliminarRelacionIns=".$fila['idProveedor']."'>Eliminar</a></td>
                                 </tr>
                                ";
                    }
                    ?>
            </tbody>
        </table>
    </section>

    <section class="container" id="tabla">
        <label>Materiales que Provee:</label>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>idMaterial</th>
                    <th>Descripci&oacute;n</th>
                    <th>Costo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $result=selectTableWhere('MaterialProveedor','idProveedor',"'".$_GET['idProveedor']."'");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                        <td>".$fila['idMaterial']."</td>                             
                                    ";
                        $result1=selectTableWhere('Material','idMaterial',"'".$fila['idMaterial']."'");
                        while ($fila1=mysql_fetch_array($result1)){
                            echo "
                                            <td>".$fila1['material']."</td>
                                        ";
                        }
                        echo "
                                        <td>S/. ".$fila['costo']."</td>
                                        <td><a href='gestionProveedores.php?eliminarRelacionMat=".$fila['idProveedor']."'>Eliminar</a></td>
                                    </tr>
                                    ";
                    }
                    ?>
            </tbody>
        </table>
    </section>
    <hr>
    <section class="container">
        <form action="fichaProveedorpdf.php" method="post" class="form-horizontal col-sm-12">
            <input type="hidden" name="idproveedor" value="<?php echo $_GET['idProveedor']?>" readonly>
            <input class="btn btn-primary col-sm-4 col-sm-offset-4" type="submit" name="pdf" value="Descargar PDF">
        </form>
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
