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
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
        </header>

        <section>
            <form action="gestionOP.php" method="post">
                <div>
                    <h4>Buscar &Oacute;rden de Producci&oacute;n</h4>
                </div>
                <div>
                    <label for="fechabusq">Indique la Fecha:</label>
                </div>
                <div>
                    <input id="fechabusq" type="text" name="fecha">
                </div>
                <div>
                    <span>* La fecha debe estar en formato mm/dd/aa</span>
                </div>
                <div>
                    <input class="btn btn-default" type="submit" name="buscar" value="Buscar">
                    <input class="btn btn-default" type="submit" name="eliminarfiltro" value="Eliminar Filtro">
                </div>
            </form>
        </section>

        <section>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>idOrdenProducción</th>
                        <th>Contrato</th>
                        <th>Fecha de Creaci&oacute;n</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_POST['buscar'])){
                            echo "
                                <tr>
                            ";
                                $result=selectTableWhere('OrdenProduccion','fechaCreacion',"'".$_POST['fecha']."'");
                                while ($fila=mysql_fetch_array($result)){
                                    echo "
                                                <tr>
                                                <td>".$fila['idOrdenProduccion']."</td>
                                                <td>".$fila['idContrato']."</td>                                                                            
                                                <td>" . $fila['fechaCreacion'] . "</td>
                                                <td>
                                                    <form action='verOP1.php' method='post'>
                                                        <input type='hidden' name='ordenprod' value='".$fila['idOrdenProduccion']."'>
                                                        <input type='submit' class='btn btn-link' value='Ver Detalle'>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action='verCV.php' method='post'>
                                                        <input type='hidden' name='contrato' value='".$fila['idContrato']."'>
                                                        <input type='submit' class='btn btn-link' value='Ver Confirmación de Venta'>
                                                    </form>
                                                </td>
                                    ";
                                    echo "
                                        </tr>
                                    ";
                                }
                        }else{
                            $result=selectTable('OrdenProduccion');
                            while ($fila=mysql_fetch_array($result)){
                                echo "
                                            <tr>
                                            <td>".$fila['idOrdenProduccion']."</td>
                                            <td>".$fila['idContrato']."</td>                                                                            
                                            <td>".$fila['fechaCreacion']."</td>
                                            <td>
                                                <form action='verOP1.php' method='post'>
                                                    <input type='hidden' name='ordenprod' value='".$fila['idOrdenProduccion']."'>
                                                    <input type='submit' class='btn btn-link' value='Ver Detalle'>
                                                </form>
                                            </td>
                                            <td>
                                                <form action='verCV.php' method='post'>
                                                    <input type='hidden' name='contrato' value='".$fila['idContrato']."'>
                                                    <input type='submit' class='btn btn-link' value='Ver Confirmación de Venta'>
                                                </form>
                                            </td>
                                ";
                                echo "
                                    </tr>
                                ";
                            }
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
