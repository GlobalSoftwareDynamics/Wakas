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
    echo "No existe la conexi�n";
}

if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">
        <link href="css/Formatos.css" rel="stylesheet">

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
    <!-- Insert de datos NuevaHE -->
    <?php
    if(isset($_POST['creacion'])){
        $insertar = mysql_query("INSERT INTO producto (idProducto, idProvisional, idTipoProducto, idCliente, fechaCreacion, creador, observaciones, descripcionGeneral, idgenero, idcodificacionTalla) VALUES ('".$_POST['idProd']."', '".$_POST['idProv'].
            "', '".$_POST['selecttipo']."', '".$_POST['selectidcliente']."', '".$_POST['date']."', '".$_POST['selectempleado']."', '".$_POST['observGen']."', '".$_POST['descrGen']."', '".$_POST['selectgenero']."','".$_POST['selectcodificaciontalla']."')",$con);
        if(!$insertar){
            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
        }
    }
    ?>

    <!-- Insert de datos Medidas -->
    <?php
    if(isset($_POST['Agregar'])){
        $result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$_POST['selectcodificaciontalla']."'");
        while ($fila = mysql_fetch_array($result)){
            if(isset($_POST[$fila['idTalla']])){
                $insertar = mysql_query("INSERT INTO TallaMedida (idProducto, idTalla, idMedida, valor) VALUES ('".$_POST['idProd']."','".$fila['idTalla']."','".$_POST['selectmedida']."','".$_POST[$fila['idTalla']]."')");
            }
        }

        $insertar = mysql_query("INSERT INTO ProductoMedida (idProducto, idMedida, tolerancia, observacion) VALUES ('".$_POST['idProd']."','".$_POST['selectmedida']."','".$_POST['tolerancia']."','".$_POST['observacion']."')");
    }
    ?>

    <!-- Eliminar datos Medidas -->
    <?php
    if(isset($_POST['borrar'])){
        $eliminar = mysql_query("DELETE FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$_POST['medidaEliminar']."'");
        $eliminar = mysql_query("DELETE FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$_POST['medidaEliminar']."'");
    }
    ?>

    <!-- Tabla de Datos de NuevaHE2 -->
    <section class="container">
        <div>
            <h3>Paso 2: Medidas y Tallas</h3>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <?php
                    $result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$_POST['selectcodificaciontalla']."' ORDER BY LENGTH (idTalla) ASC");
                    while ($fila = mysql_fetch_array($result)){
                        echo "<th>".$fila['descripcion']."</th>";
                    }
                    ?>
                    <th>Unidad</th>
                    <th>T(+/-)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = mysql_query("SELECT DISTINCT idMedida FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."'  ORDER BY LENGTH (idTalla) ASC");
                while($fila = mysql_fetch_array($result)){
                    echo "<tr>";

                    $result2 = mysql_query("SELECT * FROM Medida WHERE idMedida = '".$fila['idMedida']."'");
                    while($fila2 = mysql_fetch_array($result2)){
                        echo "<td class='tdobservacion'>".$fila2['descripcion']."</td>";
                        echo "<td>".$fila2['idMedida']."</td>";
                        $unidadMedida = $fila2['idUnidadMedida'];
                    }
                    $result3 = mysql_query("SELECT * FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$fila['idMedida']."' ORDER BY LENGTH (idTalla) ASC");
                    while ($fila3 = mysql_fetch_array($result3)){
                        echo "<td>".$fila3['valor']."</td>";
                    }
                    echo "<td>".$unidadMedida."</td>";
                    $result4 = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$fila['idMedida']."'");
                    while ($fila4 = mysql_fetch_array($result4)){
                        echo "<td>".$fila4['tolerancia']."</td>";
                    }
                    echo "<form method='post' action='#'>";
                    echo "<td><input type='submit' value='Eliminar' name='borrar' class='btn-link'></td>";
                    echo "<input type='hidden' name='medidaEliminar' value='".$fila['idMedida']."'>";
                    echo '<input type="hidden" name="idProd" value="'.$_POST['idProd'].'">
                          <input type="hidden" name="selectcodificaciontalla" value="'.$_POST['selectcodificaciontalla'].'">';
                    echo "</form>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th class="thobservacion">Observaciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."'");
                while ($fila = mysql_fetch_array($result)){
                    if($fila['observacion'] === '' ||$fila['observacion'] === null ){
                    }else{
                        echo "<tr><td class='tdobservacion'>".$fila['observacion']."</td></tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <hr>

    <section class="container">
        <div>
            <form method="post" action="#" class="form-horizontal jumbotron col-sm-12">
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 25%">Medida</th>
                            <?php
                            $result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$_POST['selectcodificaciontalla']."' ORDER BY LENGTH (idTalla) ASC");
                            while ($fila = mysql_fetch_array($result)){
                                echo "<th>".$fila['descripcion']."</th>";
                            }
                            ?>
                            <th>T(+/-)</th>
                            <th>Observación</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><select name="selectmedida" class="form-control">
                                    <?php
                                    $result2 = mysql_query("SELECT * FROM Medida");
                                    while ($fila2 = mysql_fetch_array($result2)){
                                        echo "<option value='".$fila2['idMedida']."'>".$fila2['descripcion']."</option>";
                                    }
                                    ?>
                                </select></td>
                            <?php
                            mysql_data_seek($result, 0);
                            while ($fila = mysql_fetch_array($result)){
                                echo "<td><input type='text' class='form-control' name='".$fila['idTalla']."'></td>";
                            }
                            echo "<td><input type='text' class='form-control' name='tolerancia'></td>";
                            echo "<td><input type='text' class='form-control' name='observacion'></td>";
                            ?>
                            <td><input type="submit" name="Agregar" value="Agregar" class="btn btn-success"></td>
                            <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']?>">
                            <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>

    <hr>

    <section class="container">
        <form action="nuevaHE3.php" method="post" class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
                <input type="hidden" name="idProd" value="<?php echo $_POST['idProd'] ?>">
                <input class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" value="Regresar" formaction="versionHE2.php">
            </div>
        </form>
    </section>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>