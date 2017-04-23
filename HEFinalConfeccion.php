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

<body >
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
        <div class="col-sm-2">
            <nav class="navbar navbar-default navbar-fixed-side">
                <!-- normal collapsible navbar markup -->
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Secciones disponibles</a>
                </div>
                <div class="collapse navbar-collapse">
                    <form method="post">
                        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="HEFinal.php" value="Sección General">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="HEFinalTejido.php" value="Sección Tejido">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="HEFinalLavSec.php" value="Sección Lavado y Secado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="HEFinalConfeccion.php" value="Sección Confección">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="HEFinalEtiqEmb.php" value="Sección Etiquetado y Embolsado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="HEFinalTiempos.php" value="Sección Tiempos y Secuencia">
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <div class="col-sm-10">
            <!-- Page Contents -->
            <section class="container-fluid">
                <div class="col-sm-2">
                    <div>
                        <img style="margin-top:25px" width="auto" height="70" src="image/LogoWakas.png"/>
                    </div>
                </div>
                <div class="col-sm-5" id="descripcionbrand">
                    <div>
                        <br><b><span style="margin-top: 20px">Waka-s Textiles Finos SAC</span></span></b>
                    </div>
                    <div>
                        <span>Urb. Francisco Mostajo G-25</span>
                    </div>
                    <div>
                        <span>04002 Arequipa - Peru</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="titulo">
                        <h3>Hoja de Especificaciones</h3>
                    </div>
                    <div>
                        <h4 class='desctitulo'>MOD <?php echo $_POST['idProd']; ?></h4>
                    </div>
                </div>
            </section>

            <hr>

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <?php
                            $idSubProcesoCaracteristica = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO30' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $idSubProcesoCaracteristica[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['descripcion'] === 'Observaciones de Confeccion'){
                                    } elseif ($fila2['descripcion'] === 'Componente'){
                                        echo "<th>Parte</th>";
                                    } elseif ($fila2['descripcion'] === 'Maquina- Hoja Tiempos'){
                                    } elseif ($fila2['descripcion'] === 'Tiempo'){
                                    } else {
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
                        $auxindicacion = 0;
                        $componente = array();
                        $procedimiento = array();
                        $indicacion = array();
                        $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while($fila = mysql_fetch_array($result)){
                            $result2 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ORDER BY LENGTH (id) ASC");
                            while($fila2 = mysql_fetch_array($result2)){
                                if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC23'){   //CAMBIAR AL DEJAR FIJO!!!!!
                                    $componente[$auxcomp] = $fila2['valor'];
                                    $auxcomp++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC24'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $procedimiento[$auxproced] = $fila2['valor'];
                                    $auxproced++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC25'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $indicacion[$auxindicacion] = $fila2['valor'];
                                    $auxindicacion++;
                                }
                            }
                        }
                        for($j = 0; $j < $auxcomp; $j++){
                            echo "<tr>";
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$componente[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    echo "<td class='tdobservacion'>".$fila2['descripcion']."</td>";
                                }
                            }
                            $result = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$procedimiento[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                echo "<td>".$fila   ['descripcion']."</td>";
                            }
                            echo "<td>".$indicacion[$j]."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="thobservacion">Observaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $aux = 0;
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $componente = $fila3['idComponente'];
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica");
                            while ($fila4 = mysql_fetch_array($result4)){
                                for($j=0;$j<count($idSubProcesoCaracteristica);$j++){
                                    if($idSubProcesoCaracteristica[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'observacion'){
                                            if($fila4['valor']===''||$fila4['valor']===null){

                                            }else {
                                                if ($aux === 0) {
                                                    $aux++;
                                                } else {
                                                    echo "</tr>";
                                                }
                                                echo "<tr>";
                                                echo "<td class='tdobservacion'>" . $fila4['valor'] . "</td>";
                                            }
                                        } else {
                                        }
                                    }
                                }
                            }
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
    <form action="heconfeccionfinalpdf.php" method="post" class="form-horizontal col-sm-12">
        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
        <input type="submit" class="btn btn-default col-sm-4 col-sm-offset-4" name="pdf" value="Descargar PDF">
    </form>
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