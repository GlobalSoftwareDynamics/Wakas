<!DOCTYPE html>

<html lang="es">

<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoja de Especificaci&oacuten</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-sm-3">
            <nav class="navbar navbar-default navbar-fixed-side">
                <!-- normal collapsible navbar markup -->
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Secciones disponibles</a>
                </div>
                <div class="collapse navbar-collapse">
                    <form method="post">
                        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE2.php" value="Sección Medidas">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE3.php" value="Sección Tejido">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE4.php" value="Sección Lavado y Secado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE5.php" value="Sección Confección">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE6.php" value="Sección Etiquetado y Embolsado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE7.php" value="Sección Tiempos y Secuencia">
                        </div>
                    </form>
                </div>
            </nav>
        </div>

        <div class="col-sm-9 col-sm-9">
            <!-- your page content -->
            <?php
            if(isset($_GET['EliminarFila'])){
                $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=0");
                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC32'");
                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC33'");
                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC34'");
                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC35'");
                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC36'");
                $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=1");
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }
            ?>

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="6">Hoja de Tiempos y Secuencias</th>
                        </tr>
                        <tr>
                            <?php
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO32' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;

                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['descripcion'] === 'Componente'){
                                    }else{
                                        echo "<th>".$fila2['descripcion']."</th>";
                                    }

                                }
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $auxcomp = 0;
                        $auxproced = 0;
                        $auxmaquina = 0;
                        $auxtiempo = 0;
                        $auxfila = 0;
                        $componente = array();
                        $procedimiento = array();
                        $maquina = array();
                        $tiempo = array();
                        $filaElegida = array();
                        $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while($fila = mysql_fetch_array($result)){
                            $result2 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ORDER BY LENGTH (id) ASC");
                            while($fila2 = mysql_fetch_array($result2)){
                                if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC32'){   //CAMBIAR AL DEJAR FIJO!!!!!
                                    $componente[$auxcomp] = $fila2['valor'];
                                    $auxcomp++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC34'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $procedimiento[$auxproced] = $fila2['valor'];
                                    $auxproced++;
                                    $filaElegida[$auxfila] = $fila2['fila'];
                                    $auxfila++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC35'||$fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC39'||$fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC41'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $maquina[$auxmaquina] = $fila2['valor'];
                                    $auxmaquina++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC36'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $tiempo[$auxtiempo] = $fila2['valor'];
                                    $auxtiempo++;
                                }
                            }
                        }
                        for($j = 0; $j < $auxcomp; $j++){
                            echo "<tr>";
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$componente[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    $prenda = $fila2['descripcion'];
                                }
                            }
                            $result = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$procedimiento[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                echo "<td>".$fila['idProcedimiento']."</td>";
                                $result2 = mysql_query("SELECT * FROM Proceso WHERE idProceso = '".$fila['idProceso']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    echo "<td>".$fila2['descripcion']."-".$fila['descripcion']."-".$prenda."</td>";
                                }
                            }
                            $result = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$maquina[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                echo "<td>".$fila['descripcion']."</td>";
                            }
                            echo "<td>".$tiempo[$j]."</td>";
                            echo "<form method='post' action='#'>";
                            echo "<td><input type='submit' value='Eliminar' class='btn-link' formaction='versionHE7.php?EliminarFila=".$filaElegida[$j]."'></td>";
                            echo "<input type='hidden' value='".$_POST['idProd']."' name='idProd'>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>

<hr>
<section class="container col-sm-9 col-sm-offset-3">
    <form action="versionHE7add.php" method="post" class="form-horizontal col-sm-12">
        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
        <input type="hidden" value="PROCESO8" name="selectproceso">
        <input type="hidden" value="PROCEDIMIENTO32" name="selectsubproceso">
        <input type="submit" class="btn btn-default col-sm-4 col-sm-offset-4" name="addTiempos" value="Agregar Valores">
    </form>
    <br>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
</body>
</html>