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
        <div class="col-sm-3">
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
                            <input type="submit" class="btn-link btn-links" formaction="versionHE2.php" value="Sección Medidas">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="versionHE3.php" value="Sección Tejido">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="versionHE4.php" value="Sección Lavado y Secado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="versionHE5.php" value="Sección Confección">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="versionHE6.php" value="Sección Etiquetado y Embolsado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link btn-links" formaction="versionHE7.php" value="Sección Tiempos y Secuencia">
                        </div>
                    </form>
                </div>
            </nav>
        </div>

        <div class="col-sm-9">
            <!-- your page content -->
            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="8" class="thobservacion">Lavado</th>
                        </tr>
                        <tr>
                            <?php
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO2' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
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
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $aux = 0;
                        $cantidades = array();
                        $insumo = 0;
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $conteo = 0;
                            $componente = $fila3['idComponente'];
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY idComponenteEspecifico ASC, LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila4 = mysql_fetch_array($result4)){
                                if(isset($_GET['EliminarLavado'])&&($_GET['EliminarLavado']===$fila3['idComponenteEspecifico'])){
                                    //Quitar PKs a tabla TallaMedida! ALTER TABLE tallamedida DROP PRIMARY KEY;
                                    $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=0");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC8'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC9'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC10'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC11'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC12'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC13'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC14'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC15'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC16'");
                                    $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC38'");
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
                                                echo "<tr>";
                                                $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                }
                                            } elseif ($tipo[$j] === 'maquina'){
                                                $result5 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                }
                                            } elseif ($tipo[$j] === 'insumo1'){
                                                $result5 = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                    $insumo = $fila5['descripcion'];
                                                }
                                            } elseif ($tipo[$j] === 'insumo2'){
                                                $result5 = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                    $insumo = $fila5['descripcion'];
                                                }
                                            } elseif ($tipo[$j] === 'cantidad'){
                                                if(isset($cantidades[$insumo])){
                                                    $cantidades[$insumo] += $fila4['valor'];
                                                }else{
                                                    $cantidades[$insumo] = $fila4['valor'];
                                                }
                                                echo "<td>".$fila4['valor']."</td>";
                                            } elseif ($tipo[$j] === 'observacion'){
                                            }else {
                                                echo "<td>".$fila4['valor']."</td>";
                                                $conteo++;
                                                if($conteo>1){
                                                    echo "<form method='post' action='#'>";
                                                    echo "<td><input type='submit' name='EliminarLavado' class='btn-link' value='Eliminar' formaction='versionHE4.php?EliminarLavado=".$fila3['idComponenteEspecifico']."'></td>";
                                                    echo "<input type='hidden' value='".$_POST['idProd']."' name='idProd'>";
                                                    echo "</form>";
                                                    echo "</tr>";
                                                }
                                            }
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

            <section class="container">
                <form action="versionHE4add.php" method="post" class="form-horizontal">
                    <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
                    <input type="hidden" value="PROCESO2" name="selectproceso">
                    <input type="hidden" value="PROCEDIMIENTO2" name="selectsubproceso">
                    <input type="submit" class="btn btn-success col-sm-4 col-sm-offset-4" name="addlavado" value="Agregar Valores">
                </form>
                <br>
            </section>

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="5" class="thobservacion">Secado</th>
                        </tr>
                        <tr>
                            <?php
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO6' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;

                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['tipo']==='observacion'){
                                    }elseif($fila2['tipo']==='tiempo'){
                                    }
                                    else{
                                        echo "<th>".$fila2['descripcion']."</th>";
                                    }
                                }
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $conteo = 0;
                            $componente = $fila3['idComponente'];
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY id");
                            if(isset($_GET['EliminarSecado'])&&($_GET['EliminarSecado']===$fila3['idComponenteEspecifico'])){
                                //Quitar PKs a tabla TallaMedida! ALTER TABLE tallamedida DROP PRIMARY KEY;
                                $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=0");
                                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC17'");
                                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC18'");
                                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC19'");
                                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC20'");
                                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC21'");
                                $sqleliminar = mysql_query("DELETE FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC22'");
                                $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=1");
                                if ( !empty( $error = mysql_error() ) )
                                {
                                    echo 'Mysql error '. $error ."<br />\n";
                                }
                                echo "<input type='hidden' name='idProd' value='".$_POST['idProd']."'>";
                            }else{
                                while ($fila4 = mysql_fetch_array($result4)){
                                    for($j=0;$j<count($caracteristicas);$j++){
                                        if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                            if($tipo[$j] === 'componente'){
                                                echo "<tr>";
                                                $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                }
                                            } elseif ($tipo[$j] === 'maquina'){
                                                $result5 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['descripcion']."</td>";
                                                }
                                            } elseif ($tipo[$j] === 'galga'){
                                                $result5 = mysql_query("SELECT * FROM Galgas WHERE idGalgas = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    echo "<td>".$fila5['Descripcion']."</td>";
                                                }
                                            } elseif ($tipo[$j] === 'observacion'){
                                            } else {
                                                echo "<td>".$fila4['valor']."</td>";
                                                $conteo++;
                                                if($conteo>1){
                                                    echo "<form method='post' action='#'>";
                                                    echo "<td><input type='submit' name='EliminarSecado' class='btn-link' value='Eliminar' formaction='versionHE4.php?EliminarSecado=".$fila3['idComponenteEspecifico']."'></td>";
                                                    echo "<input type='hidden' value='".$_POST['idProd']."' name='idProd'>";
                                                    echo "</form>";
                                                    echo "</tr>";
                                                }
                                            }
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

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="3" class="thobservacion">Resumen de Insumos de Lavado</th>
                        </tr>
                        <tr>
                            <th>Insumo</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = mysql_query("SELECT * FROM Insumos");
                        while($fila = mysql_fetch_array($result)){
                            if(isset($cantidades[$fila['descripcion']])){
                                echo "<tr>";
                                echo "<td>".$fila['descripcion']."</td>";
                                echo "<td>".$fila['idUnidadMedida']."</td>";
                                echo "<td>".$cantidades[$fila['descripcion']]."</td>";
                                echo "</tr>";
                            }
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="container">
                <form action="versionHE4add.php" method="post" class="form-horizontal">
                    <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
                    <input type="hidden" value="PROCESO2" name="selectproceso">
                    <input type="hidden" value="PROCEDIMIENTO6" name="selectsubproceso">
                    <input type="submit" class="btn btn-success col-sm-4 col-sm-offset-4" name="addsecado" value="Agregar Valores">
                </form>
                <br>
            </section>

        </div>
    </div>
</div>

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