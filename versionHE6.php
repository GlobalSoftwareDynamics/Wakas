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
    <meta name="apple-mobile-web-app-title" content="Waka-s">
    <meta name="application-name" content="Waka-s">
    <meta name="theme-color" content="#ef4a43">
    <title>Hoja de Especificaci&oacuten</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
    <link href="css/Formatos.css" rel="stylesheet">
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
                        $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC27'");
                        $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC28'");
                        $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC29'");
                        $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC30'");
                        $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE fila = '".$_GET['EliminarFila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC31'");
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
                            <?php
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO26' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;

                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['descripcion'] === 'Componente'){
                                    }elseif($fila2['descripcion'] === 'Maquina- Hoja Tiempos'){
                                    }elseif($fila2['descripcion'] === 'Tiempo'){
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
                        $auxinsumo = 0;
                        $auxmaquina = 0;
                        $auxcantidades = 0;
                        $auxfila = 0;
                        $auxobservacion = 0;
                        $componente = array();
                        $insumo = array();
                        $maquina = array();
                        $cantidades = array();
                        $filaElegida = array();
                        $observaciones = array();
                        $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while($fila = mysql_fetch_array($result)){
                            $result2 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ORDER BY LENGTH (id) ASC");
                            while($fila2 = mysql_fetch_array($result2)){
                                if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC27'){   //CAMBIAR AL DEJAR FIJO!!!!!
                                    $componente[$auxcomp] = $fila2['valor'];
                                    $auxcomp++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC28'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    //28 no se guarda en la bd, es IdInsumo
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC29'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $insumo[$auxinsumo] = $fila2['valor'];
                                    //Procedimiento = IdInsumo
                                    $auxinsumo++;
                                    $filaElegida[$auxfila] = $fila2['fila'];
                                    $auxfila++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC30'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    //Cantidad
                                    $cantidades[$auxcantidades] = $fila2['valor'];
                                    $auxcantidades++;
                                } elseif($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC31'){
                                    //Observacion
                                    $observaciones[$auxobservacion] = $fila2['valor'];
                                    $auxobservacion++;
                                }
                            }
                        }
                        for($j = 0; $j < $auxcomp; $j++){
                            echo "<tr>";
                            $result = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$insumo[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                echo "<td>".$fila['idInsumo']."</td>";
                                echo "<td>".$fila['descripcion']."</td>";
                            }
                            echo "<td>".$cantidades[$j]."</td>";
                            echo "<td>".$observaciones[$j]."</td>";
                            echo "<form method='post' action='#'>";
                            echo "<td><input type='submit' value='Eliminar' class='btn-link' formaction='versionHE6.php?EliminarFila=".$filaElegida[$j]."'></td>";
                            echo "<input type='hidden' value='".$_POST['idProd']."' name='idProd'>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="container col-sm-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="thobservacion">Fotografía de Embolsado y Etiquetado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        for($i=0;$i<4;$i++){
                            $file = null;
                            $filenamejpg = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.jpg';
                            $filenamejpeg = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.jpeg';
                            $filenamegif = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.gif';
                            $filenamepng = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.png';
                            if(file_exists($filenamejpg)){
                                $file=$filenamejpg;
                            } elseif(file_exists($filenamejpeg)){
                                $file=$filenamejpeg;
                            } elseif(file_exists($filenamegif)){
                                $file=$filenamegif;
                            } elseif(file_exists($filenamepng)){
                                $file=$filenamepng;
                            }
                            if($file === null){
                            }else{
                                echo "<td><img src='".$file."' alt='Fotografia de Embolsado' height='200' width='auto'/></td>";
                            }
                        }
                        ?>

                    </tr>
                    </tbody>
                </table>

            </section>
            <section class="container">
                <hr>
                <?php
                echo "<form action='upload2.php' method='post' enctype='multipart/form-data'>
                            <input type='hidden' name='idProd' value='".$_POST['idProd']."'>
                            <div>
                                <input type='file' name='fileToUpload' id='fileToUpload'>
                            </div>
                            <hr>
                            <input type='submit' value='Subir Imagen' name='submit' class='btn btn-primary'>
                          </form>";
                ?>
                <br>
            </section>
        </div>
    </div>
</div>

<hr>
<section class="container col-sm-9 col-sm-offset-3">
    <form action="versionHE6add.php" method="post" class="form-horizontal col-sm-12">
        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
        <input type="hidden" value="PROCESO6" name="selectproceso">
        <input type="hidden" value="PROCEDIMIENTO26" name="selectsubproceso">
        <input type="submit" class="btn btn-success col-sm-4 col-sm-offset-4" name="addEE" value="Agregar Valores">
    </form>
    <br>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<footer class="panel-footer navbar-fixed-bottom">
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
</body>
</html>