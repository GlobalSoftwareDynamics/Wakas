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
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">

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

        <?php
        if(isset($_POST['guardar'])){
            $agregar="INSERT INTO ciudad(idCiudad, idPais, nombre) VALUES ('".$_POST['idciudad']."','".$_POST['idpais']."','".$_POST['nombre']."')";
            $agregar1=mysql_query($agregar);
            if ( !empty( $error = mysql_error() ) )
            {
                echo 'Mysql error '. $error ."<br />\n";
            }else{
                echo "<br>
                <div class='container'>
                    <div class='alert alert-success' role='alert'>
                        <p><strong>Ciudad Agregada Exitosamente</strong></p>
                    </div>
                </div>
                ";
            }
        }
        if(isset($_GET['eliminarCiudad'])){
            $eliminar="DELETE FROM ciudad WHERE idCiudad ='".$_GET['eliminarCiudad']."'";
            $eliminar1=mysql_query($eliminar);
        }
        ?>

        <section class="container col-sm-6">
            <form action="otrosciudad.php" method="post" class="form-horizontal jumbotron col-sm-10 col-sm-offset-1">
                <div>
                    <h3>Nueva Ciudad</h3>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="idciu" class="formlabels1 col-sm-12">id Ciudad:</label>
                    </div>
                    <div class="col-sm-12">
                        <?php
                        $aux = 0;
                        $result = selectTable("Ciudad");
                        while($fila = mysql_fetch_array($result)){
                            $aux++;
                        }
                        $aux++;
                        echo "<input class='textinput-6' id='idciu' type='text' name= 'idciudad' value='".$aux."' readonly>";
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div  class="col-sm-12">
                        <label for="nom" class="formlabels1 col-sm-12">Nombre de la Ciudad:</label>
                    </div>
                    <div class="col-sm-12">
                        <input id="nom" class="textinput-12" type="text" name="nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="pais" class="formlabels1 col-sm-12">Seleccione Pa&iacute;s:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="pais" name="idpais" class="ddselect-12">
                            <option>Seleccionar País</option>
                            <?php
                            $result=selectTable("Pais");
                            while ($fila=mysql_fetch_array($result)){
                                echo "
                                <option value='".$fila['idPais']."'>".$fila['pais']."</option>
                            ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input formaction="menuagregarotros.php" class="btn btn-default col-sm-10 col-sm-offset-1" type="submit" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input class="btn btn-success col-sm-10 col-sm-offset-1" type="submit" name="guardar" value="Agregar">
                    </div>
                </div>
            </form>
        </section>
        <section class="container col-sm-6">
            <div class="container col-sm-10 col-sm-offset-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>País</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result1=selectTable('Ciudad');
                    while ($fila1=mysql_fetch_array($result1)){
                        $result2=selectTableWhere('Pais','idPais',"'".$fila1['idPais']."'");
                        while ($fila2=mysql_fetch_array($result2)){
                            echo "
                            <tr>
                                <td>".$fila1['nombre']."</td>
                                <td>".$fila2['pais']."</td>
                                <td><a href='otrosciudad.php?eliminarCiudad=".$fila1['idCiudad']."'>Eliminar</a></td>
                            </tr>
                        ";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
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
