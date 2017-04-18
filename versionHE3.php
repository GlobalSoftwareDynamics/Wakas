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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
    <link href="css/Formatos.css" rel="stylesheet">
    <link href="css/Tablas.css" rel="stylesheet">
</head>

<body>
<header><nav class="navbar navbar-inverse">
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
            <section class="container col-sm-12">
                <div>
                    <form method="post" action="#">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="6" class="thobservacion">Tejido</th>
                        </tr>
                        <tr>
                            <?php
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO1' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['tipo']==='observacion'){
                                    }elseif($fila2['tipo']==='tiempo'){
                                        echo "<th></th>";
                                    }else{
                                        echo "<th>".$fila2['descripcion']."</th>";
                                    }

                                }
                            }
                            ?>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $eliminar = 0;
                        $punteroeliminar = 0;
                        $aux = 0;
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $componente = $fila3['idComponente'];
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica");
                            while ($fila4 = mysql_fetch_array($result4)){
                                if(isset($_GET['EliminarFila'])&&($_GET['EliminarFila']===$fila4['fila'])){
                                        //Quitar PKs a tabla TallaMedida! ALTER TABLE tallamedida DROP PRIMARY KEY;
                                    $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=0");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC1'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC3'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC4'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC5'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC6'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC7'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila4['fila']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC37'");
                                    $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=1");
                                    if ( !empty( $error = mysql_error() ) )
                                    {
                                        echo 'Mysql error '. $error ."<br />\n";
                                    }
                                    echo "<input type='hidden' name='idProd' value='".$_POST['idProd']."'>";
                                }else{
                                    for($j=0;$j<count($caracteristicas);$j++){
                                        if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                            if($tipo[$j] === 'componente'){
                                                $eliminar++;
                                                echo "<tr>";
                                                $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                    $result6 = mysql_query("SELECT * FROM Material WHERE idMaterial = '".$fila3['idMaterial']."'");
                                                    while($fila6 = mysql_fetch_array($result6)){
                                                        echo "<td>".$fila6['material']."</td>";
                                                    }
                                                }
                                            } elseif ($tipo[$j] === 'maquina'){
                                                $result5 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                }
                                            } elseif ($tipo[$j] === 'galga'){
                                                $galgas = array();
                                                $galgas = explode(',',$fila4['valor']);
                                                echo "<td>";
                                                for($i=0;$i<count($galgas);$i++){
                                                    $result5 = mysql_query("SELECT * FROM Galgas WHERE idGalgas = '".$galgas[$i]."'");
                                                    while ($fila5 = mysql_fetch_array($result5)){
                                                        echo $fila5['Descripcion'];
                                                    }
                                                    if(($i+1) < count($galgas)){
                                                        echo ", ";
                                                    }
                                                }
                                                echo "</td>";
                                            }elseif ($tipo[$j] === 'observacion'){
                                            }elseif ($tipo[$j] === 'comprobaciontejido'){
                                                echo "<td>".$fila4['valor']."</td>";
                                                echo "<td><input type='submit' name='EliminarFila' class='btn-link' value='Eliminar' formaction='versionHE3.php?EliminarFila=".$fila4['fila']."'></td>";
                                                echo "<input type='hidden' name='idProd' value='".$_POST['idProd']."'>";
                                                echo "</tr>";
                                            } else {
                                                echo "<td>".$fila4['valor']."</td>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </section>

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="5" class="thobservacion">Requerimiento Promedio de Material</th>
                        </tr>
                        <tr>
                            <th>Componente</th>
                            <th>Material</th>
                            <th>Color</th>
                            <th>Unidad de Medida</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cantidadMaterial = 0;
                        $k = 0;
                        $resumenMateriales = array();
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $componente = $fila3['idComponente'];
                            echo "<tr>";
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."'");
                            while ($fila4 = mysql_fetch_array($result4)){
                                for($j=0;$j<count($caracteristicas);$j++){
                                    if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'componente'){
                                            $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                echo "<td>".$fila5['descripcion']."</td>";
                                            }
                                        }
                                    }
                                }

                            }
                            $result4 = mysql_query("SELECT * FROM Material WHERE idMaterial = '".$fila3['idMaterial']."'");
                            while ($fila4 = mysql_fetch_array($result4)){
                                echo "<td>".$fila4['material']."</td>";
                                echo "<td>".$fila3['idColor']."</td>";
                                echo "<td>".$fila4['idUnidadMedida']."</td>";
                                echo "<td>".$fila3['cantidadMaterial']."</td>";
                                if(isset($resumenMateriales[$fila3['idMaterial']][$fila3['idColor']])){
                                    $resumenMateriales[$fila3['idMaterial']][$fila3['idColor']] += $fila3['cantidadMaterial'];
                                }else{
                                    $resumenMateriales[$fila3['idMaterial']][$fila3['idColor']] = $fila3['cantidadMaterial'];
                                }
                            }
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
                            <th colspan="3" class="thobservacion">Resumen de Materiales</th>
                        </tr>
                        <tr>
                            <th>Material</th>
                            <th>Color</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $materialRepetido = array();
                        $colorRepetido = array();
                        $puntero = 0;
                        mysql_data_seek($result3, 0);
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."' ORDER BY `productocomponentesprenda`.`idMaterial` ASC") ;
                        while ($fila3 = mysql_fetch_array($result3)){
                            $bandera = false;
                            echo "<tr>";
                            $materialRepetido[$puntero] = $fila3['idMaterial'];
                            $colorRepetido[$puntero] = $fila3['idColor'];
                            for($l = 0; $l<$puntero;$l++){
                                if($materialRepetido[$l] === $fila3['idMaterial'] && $colorRepetido[$l] === $fila3['idColor']){
                                    $bandera = true;
                                }
                            }
                            if($bandera){

                            }else{
                                $result4 = mysql_query("SELECT * FROM Material WHERE idMaterial = '".$fila3['idMaterial']."'");
                                while($fila4 = mysql_fetch_array($result4)){
                                    echo "<td>".$fila4['material']."</td>";
                                    echo "<td>".$fila3['idColor']."</td>";
                                    echo "<td>".$resumenMateriales[$fila3['idMaterial']][$fila3['idColor']]."</td>";
                                }
                            }
                            $puntero++;
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
                                for($j=0;$j<count($caracteristicas);$j++){
                                    if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
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

            <hr>
            <section class="container">
                <div>
                    <div class="form-group">
                        <form method="post" action="#">
                            <input type="hidden" name='idProd' value="<?php echo $_POST['idProd']?>">
                            <input type="hidden" name='selectproceso' value="PROCESO1">
                            <input type="hidden" name='selectsubproceso' value="PROCEDIMIENTO1">
                            <?php
                            $query = mysql_query("SELECT * FROM Producto WHERE idProducto = '".$_POST['idProd']."'");
                            while($row = mysql_fetch_array($query)){
                                $selectcodificaciontalla = $row['idcodificacionTalla'];
                            }
                            echo "<input type='hidden' name='selectcodificaciontalla' value='".$selectcodificaciontalla."'>";
                            ?>
                            <input type="submit" name="add" value="Agregar Valor" class="btn btn-default col-sm-3 col-sm-offset-3" formaction="versionHE3add.php">
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
</body>
</html>