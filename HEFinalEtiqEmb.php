<!DOCTYPE html>

<html>

<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoja de Especificaci&oacuten</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
</head>

<body >
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
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
                        <input type="submit" class="btn-link" formaction="HEFinal.php" value="Sección General">
                        <input type="submit" class="btn-link" formaction="HEFinalTejido.php" value="Sección Tejido">
                        <input type="submit" class="btn-link" formaction="HEFinalLavSec.php" value="Sección Lavado y Secado">
                        <input type="submit" class="btn-link" formaction="HEFinalConfeccion.php" value="Sección Confección">
                        <input type="submit" class="btn-link" formaction="HEFinalEtiqEmb.php" value="Sección Etiquetado y Embolsado">
                        <input type="submit" class="btn-link" formaction="HEFinalTiempos.php" value="Sección Tiempos y Secuencia">
                    </form>
                </div>
            </nav>
        </div>
        <div class="col-sm-9 col-lg-10">
            <!-- Page Contents -->
            <section class="container">
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="6">Etiquetado y Embolsado</th>
                        </tr>
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
                                    echo "<th>".$fila2['descripcion']."</th>";
                                }
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $aux = 0;
                        $aux2 = 0;
                        $contenido = array();
                        $subprocesocaracteristica = array();
                        $tipocontenido = array();
                        $compespec = array();
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $compespec[$aux2] = $fila3['idComponenteEspecifico'];
                            $aux2++;
                        }
                        for($j = 0; $j<count($compespec);$j++){
                            $result4 = mysql_query("SELECT DISTINCT pcpspc.* FROM `PCPSPC`,`SubProcesoCaracteristica` WHERE pcpspc.idSubProcesoCaracteristica = subprocesocaracteristica.idSubProcesoCaracteristica AND subprocesocaracteristica.idProcedimiento = 'PROCEDIMIENTO26' AND pcpspc.idComponenteEspecifico = '".$compespec[$j]."'");
                            while ($fila4 = mysql_fetch_array($result4)) {
                                $contenido[$aux] = $fila4['valor'];
                                $subprocesocaracteristica[$aux] = $fila4['idSubProcesoCaracteristica'];
                                $result5 = mysql_query("SELECT * FROM SubProcesoCaracteristica WHERE idSubProcesoCaracteristica = '" . $fila4['idSubProcesoCaracteristica'] . "'");
                                while ($fila5 = mysql_fetch_array($result5)) {
                                    $tipocontenido[$aux] = $fila5['tipo'];
                                }
                                $aux++;
                            }
                        }
                        $entradas = $aux/4;
                        for ($i = 0; $i < $entradas; $i++) {
                            echo "<tr>";
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$contenido[$i]."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    echo "<td>".$fila2['descripcion']."</td>";
                                }
                            }
                            echo "<td>".$contenido[$i+$entradas]."</td>";
                            $result = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$contenido[$i+$entradas]."'");
                            while($fila = mysql_fetch_array($result)){
                                echo "<td>".$fila['descripcion']."</td>";
                            }
                            echo "<td>".$contenido[$i+($entradas*2)]."</td>";
                            echo "<td>".$contenido[$i+($entradas*3)]."</td>";
                            /*echo "<td>".$contenido[$i]."</td>";
                            echo "<td>".$contenido[$i+$entradas]."</td>";
                            echo "<td>".$contenido[$i+($entradas*2)]."</td>";
                            echo "<td>".$contenido[$i+($entradas*3)]."</td>";*/
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="container">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Fotografía de Embolsado y Etiquetado</th>
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
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
</body>
</html>