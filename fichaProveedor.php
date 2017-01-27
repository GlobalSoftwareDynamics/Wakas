<!doctype html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ficha Proveedor</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

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
</nav><br>

    <section class="container">
        <div>
            <div>
                <label>Nombre del Proveedor:</label>
            </div>
            <div>
                <span>
                    <?php
                    $result=selectTableWhere('Proveedor','idProveedor',"'".$_GET['idProveedor']."'");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                ".$fila['nombre']."
                            ";
                    }
                    ?>
                </span>
            </div>
        </div>
        <div>
            <div>
                <label>Direcci&oacute;n del Proveedor:</label>
            </div>
            <div>
                <span>
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
        </div>
    </section>

    <section class="container">
        <h5>Insumos que Provee</h5>
        <table class="table table-bordered">
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
                                     <td>".$fila['costo']."</td>
                                     <td><a href='gestionProveedores.php?eliminarRelacionIns=".$fila['idProveedor']."'>Eliminar</a></td>
                                 </tr>
                                ";
                    }
                    ?>
            </tbody>
        </table>
    </section>

    <section class="container">
        <h5>Materiales que Provee</h5>
        <table class="table table-bordered">
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
                                        <td>".$fila['costo']."</td>
                                        <td><a href='gestionProveedores.php?eliminarRelacionMat=".$fila['idProveedor']."'>Eliminar</a></td>
                                    </tr>
                                    ";
                    }
                    ?>
            </tbody>
        </table>
    </section>

    <section class="container">
        <h5>Procesos que Provee</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Proceso</th>
                    <th>Procedimiento</th>
                    <th>Detalle</th>
                    <th>Costo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result=selectTableWhere('ProveedorSubproceso','idProveedor',"'".$_GET['idProveedor']."'");
                while ($fila=mysql_fetch_array($result)){
                    echo "
                                    <tr>
                                ";
                    $result1=selectTableWhere('Subproceso','idProcedimiento',"'".$fila['idProcedimiento']."'");
                    while ($fila1=mysql_fetch_array($result1)){
                        $result2=selectTableWhere('Proceso','idProceso',"'".$fila1['idProceso']."'");
                        while ($fila2=mysql_fetch_array($result2)){
                            echo "
                                            <td>".$fila2['descripcion']."</td>
                                        ";
                        }
                        echo "
                                                <td>".$fila1['descripcion']."</td>
                                            ";
                    }
                    echo "
                                            <td>".$fila['costo']."</td>
                                            <td><a href='gestionProveedores.php?eliminarRelacionProc=".$fila['idProveedor']."'>Eliminar</a></td>
                                        </tr>
                                        ";
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
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
