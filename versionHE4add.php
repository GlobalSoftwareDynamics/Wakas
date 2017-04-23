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
    echo "No existe la conexi&oacute;n";
}

if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">

        <script>
            function getMaterial(val) {
                $.ajax({
                    type: "POST",
                    url: "get_material.php",
                    data:'idComponente='+val,
                    success: function(data){
                        $("#material").html(data);
                    }
                });
            }

            function getGalga(val) {
                $.ajax({
                    type: "POST",
                    url: "get_galga.php",
                    data:'idMaquina='+val,
                    success: function(data){
                        $("#galga").html(data);
                    }
                });
            }

            function getInsumo(val) {
                $.ajax({
                    type: "POST",
                    url: "get_insumo.php",
                    data:'idInsumo='+val,
                    success: function(data){
                        $("#idinsumo").html(data);
                    }
                });
            }

            function getProcedimiento(val) {
                $.ajax({
                    type: "POST",
                    url: "get_procedimiento.php",
                    data:'idProcedimiento='+val,
                    success: function(data){
                        $("#idProcedimiento").html(data);
                    }
                });
            }
        </script>
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

    <!-- Insert de datos -->

    <?php
    if(isset($_POST['Agregar'])){
        $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = '".$_POST['selectsubproceso']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
        mysql_data_seek($result, 0);
        while($fila = mysql_fetch_array($result)){
            if($_POST['selectsubproceso'] === 'PROCEDIMIENTO32'){
                $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                mysql_data_seek($result2, 0);
                while($fila2 = mysql_fetch_array($result2)){
                    if($fila['tipo']==="componente"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectcomponente']."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    } elseif ($fila['tipo']==="maquina"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquina']."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    } elseif ($fila['tipo']==="procedimiento"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    } elseif ($fila['tipo']==="galga"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $galgas = array();
                        foreach ($_POST['galga'] as $galga) {
                            $galgas[] = mysql_real_escape_string($galga);
                        }

                        $galgas_unidas = join(",",$galgas);
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$galgas_unidas."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    } elseif ($fila['tipo']==="insumo"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else{
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="insumo1"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo1']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else{
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo1']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="insumo2"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo2']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else{
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo2']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="otro"||$fila['tipo']==="cantidad"||$fila['tipo']==='observacion'||$fila['tipo']==='comprobaciontejido'||$fila['tipo']==='tiempo') {
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST[$fila2['idCaracteristica']]."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else {
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST[$fila2['idCaracteristica']]."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="ProcedimientoTiempos") {
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else {
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="maquinatiempo") {
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquinatiempo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else {
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquinatiempo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    }
                }
            }else{
                $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                mysql_data_seek($result2, 0);
                while($fila2 = mysql_fetch_array($result2)){
                    if($fila['tipo']==="componente"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectcomponente']."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                        if($fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC17' || $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC1' || $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC8'){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+1)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC32' , '".$_POST['selectcomponente']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                            switch ($fila['idSubProcesoCaracteristica']){
                                case "SUBPROCESOCARAC1":
                                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+2)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC34' , 'PROCEDIMIENTO1','".$_POST['fila']."')",$con);
                                    if(!$insertar){
                                        echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                                    }
                                    break;
                                case "SUBPROCESOCARAC8":
                                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+2)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC34' , 'PROCEDIMIENTO2','".$_POST['fila']."')",$con);
                                    if(!$insertar){
                                        echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                                    }
                                    break;
                                case "SUBPROCESOCARAC17":
                                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+2)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC34' , 'PROCEDIMIENTO6','".$_POST['fila']."')",$con);
                                    if(!$insertar){
                                        echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                                    }
                                    break;
                            }
                        }
                    } elseif ($fila['tipo']==="maquina"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquina']."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                        if($fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC18' || $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC4' || $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC14'){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+1)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC35' , '".$_POST['selectmaquina']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                            /*$insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+2)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC36' , '0')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }*/
                        }
                    } elseif ($fila['tipo']==="procedimiento"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    } elseif ($fila['tipo']==="galga"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $galgas = array();
                        foreach ($_POST['galga'] as $galga) {
                            $galgas[] = mysql_real_escape_string($galga);
                        }

                        $galgas_unidas = join(",",$galgas);
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$galgas_unidas."','".$_POST['fila']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    } elseif ($fila['tipo']==="insumo"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else{
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="insumo1"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo1']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else{
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo1']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="insumo2"){
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo2']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else{
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo2']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="otro"||$fila['tipo']==="cantidad"||$fila['tipo']==='observacion'||$fila['tipo']==='comprobaciontejido'||$fila['tipo']==='tiempo') {
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        $bandera = false;
                        if(isset($_POST['selectcomponente'])){
                            if($fila['tipo']==='tiempo'){
                                $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo)."','".$_POST['selectcomponente']."','SUBPROCESOCARAC36','".$_POST[$fila2['idCaracteristica']]."','".$_POST['fila']."')",$con);
                                if(!$insertar){
                                    echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                                }
                                $bandera = true;
                            }
                            if($bandera === false){
                                $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST[$fila2['idCaracteristica']]."','".$_POST['fila']."')",$con);
                                if(!$insertar){
                                    echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                                }
                            }
                        } else {
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST[$fila2['idCaracteristica']]."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="ProcedimientoTiempos") {
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else {
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    } elseif ($fila['tipo']==="maquinatiempo") {
                        $result3 = mysql_query("SELECT * FROM PCPSPC");
                        $conteo = 0;
                        while($fila3 = mysql_fetch_array($result3)){
                            $conteo++;
                        }
                        $conteo++;
                        if(isset($_POST['selectcomponente'])){
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquinatiempo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        } else {
                            $result5 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila5 = mysql_fetch_array($result5)){
                                if($fila5['idComponente'] === "COMPONENTE1"){
                                    $componente = $fila5['idComponenteEspecifico'];
                                }
                            }
                            $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquinatiempo']."','".$_POST['fila']."')",$con);
                            if(!$insertar){
                                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                            }
                        }
                    }
                }
            }
        }
    }

    ?>

    <!-- Seleecionar Subproceso -->
    <section class="container">
        <div>
            <h3>Paso 5: Selección de Datos para Proceso</h3>
        </div>
    </section>
    <hr>

    <section class="container">
        <!-- Contenido Real -->
        <div>
            <form method="post" action="#" class="form-horizontal jumbotron col-sm-12">
                <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']; ?>">
                <input type="hidden" name="selectproceso" value="<?php echo $_POST['selectproceso']; ?>">
                <input type="hidden" name="selectsubproceso" value="<?php echo $_POST['selectsubproceso']; ?>">
                <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
                <br>
                <div class="form-group">
                    <table class="table table-bordered" style="background: whitesmoke">
                        <?php
                        $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = '".$_POST['selectsubproceso']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                        echo "
                
                    <thead>
                        <tr class='bordes'>";
                        mysql_data_seek($result, 0);
                        while($fila = mysql_fetch_array($result)){
                            $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                            while($fila2 = mysql_fetch_array($result2)){
                                if($fila2['descripcion'] === 'Componente' && $_POST['selectsubproceso'] === 'PROCEDIMIENTO30'){
                                    echo "<th class='border'>Parte</th>";
                                } elseif($fila2['descripcion'] === 'Componente' && $_POST['selectsubproceso'] === 'PROCEDIMIENTO32'){
                                    echo "<th class='border'>Componente/Parte</th>";
                                } else {
                                    echo "<th class='border'>".$fila2['descripcion']."</th>";
                                }
                            }
                        }
                        echo "</tr>
                    </thead>
                    <tbody>";
                        echo "<tr class='bordes'>";
                        mysql_data_seek($result, 0);
                        while($fila = mysql_fetch_array($result)){

                            $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                            mysql_data_seek($result2, 0);
                            while($fila2 = mysql_fetch_array($result2)){
                                echo "<td>";
                                if($fila['tipo']==="componente"){
                                    if($_POST['selectsubproceso']==='PROCEDIMIENTO26'){
                                        echo "<span>Prenda</span>";
                                        $result3 = selectTableWhere3("productocomponentesprenda","idProducto","'".$_POST['idProd']."'",'estado','1','tipoComponente','1');
                                        while($fila3 = mysql_fetch_array($result3)){
                                            $result4 = selectTableWhere("componentesprenda","idComponente","'".$fila3['idComponente']."'");
                                            while($fila4 = mysql_fetch_array($result4)){
                                                if($fila4['descripcion']==='Prenda'){
                                                    echo "<input type='hidden' name='selectcomponente' id='selectcomponente' value='".$fila3['idComponenteEspecifico']."'>";
                                                }
                                            }
                                        }
                                        echo "</td>";
                                    } elseif ($_POST['selectsubproceso'] === 'PROCEDIMIENTO30'){
                                        echo "<select name='selectcomponente' id='selectcomponente' onChange='getMaterial(this.value)' class='ddselect-12'>";
                                        echo "<option>Seleccionar</option>";
                                        $result3 = selectTableWhere3("productocomponentesprenda","idProducto","'".$_POST['idProd']."'",'estado','1','tipoComponente','2');
                                        while($fila3 = mysql_fetch_array($result3)){
                                            $result4 = selectTableWhere("componentesprenda","idComponente","'".$fila3['idComponente']."'");
                                            while($fila4 = mysql_fetch_array($result4)){
                                                echo "<option value='".$fila3['idComponenteEspecifico']."'>".$fila4['descripcion']."</option>";
                                            }
                                        }
                                        echo "</select>";
                                        echo "</td>";
                                    } elseif ($_POST['selectsubproceso'] === 'PROCEDIMIENTO32'){
                                        echo "<select name='selectcomponente' id='selectcomponente' onChange='getMaterial(this.value)' class='ddselect-12'>";
                                        echo "<option>Seleccionar</option>";
                                        $result3 = selectTableWhere2("productocomponentesprenda","idProducto","'".$_POST['idProd']."'",'estado','1');
                                        while($fila3 = mysql_fetch_array($result3)){
                                            $result4 = selectTableWhere("componentesprenda","idComponente","'".$fila3['idComponente']."'");
                                            while($fila4 = mysql_fetch_array($result4)){
                                                echo "<option value='".$fila3['idComponenteEspecifico']."'>".$fila4['descripcion']."</option>";
                                            }
                                        }
                                        echo "</select>";
                                        echo "</td>";
                                    } else{
                                        echo "<select name='selectcomponente' id='selectcomponente' onChange='getMaterial(this.value)' class='ddselect-12'>";
                                        echo "<option>Seleccionar</option>";
                                        $result3 = selectTableWhere3("productocomponentesprenda","idProducto","'".$_POST['idProd']."'",'estado','1','tipoComponente','1');
                                        while($fila3 = mysql_fetch_array($result3)){
                                            $result4 = selectTableWhere("componentesprenda","idComponente","'".$fila3['idComponente']."'");
                                            while($fila4 = mysql_fetch_array($result4)){
                                                echo "<option value='".$fila3['idComponenteEspecifico']."'>".$fila4['descripcion']."</option>";
                                            }
                                        }
                                        echo "</select>";
                                        echo "</td>";
                                    }
                                } elseif ($fila['tipo']==="material"){
                                    echo "<span id='material'></span>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='maquina'){
                                    echo "<select name='selectmaquina' id='selectmaquina' onChange='getGalga(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTableWhere("maquinasubproceso","idProcedimiento","'".$_POST['selectsubproceso']."'");
                                    while($fila3 = mysql_fetch_array($result3)){
                                        $result4 = selectTableWhere("maquina","idMaquina","'".$fila3['idMaquina']."'");
                                        while($fila4 = mysql_fetch_array($result4)){
                                            echo "<option value='".$fila3['idMaquina']."'>".$fila4['descripcion']."</option>";
                                        }
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='galga'){
                                    echo "<select name='galga[]' multiple='multiple' id='galga' class='ddselect-12'>
                                                <option value='-'>Seleccionar</option>
                                          </select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='insumo') {
                                    echo "<select name='selectinsumo' id='selectinsumo'  onchange='getInsumo(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTable("Insumos");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idInsumo'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='insumo1') {
                                    echo "<select name='selectinsumo1' id='selectinsumo1'  onchange='getInsumo(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTable("Insumos");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idInsumo'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='insumo2') {
                                    echo "<select name='selectinsumo2' id='selectinsumo2'  onchange='getInsumo(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTable("Insumos");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idInsumo'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif($fila['tipo']==='idinsumo') {
                                    echo "<span id='idinsumo'></span>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='procedimiento'){
                                    echo "<select name='selectprocedimiento' id='selectprocedimiento' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    mysql_data_seek($result3, 0);
                                    $result3 = mysql_query("SELECT * FROM SubProceso WHERE idProceso = 'PROCESO4'");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idProcedimiento'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='ProcedimientoTiempos'){
                                    echo "<select name='selectprocedimiento' id='selectprocedimiento'  onchange='getProcedimiento(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTable("SubProceso");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idProcedimiento'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='IdProcedimiento'){
                                    echo "<span id='idProcedimiento'></span>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='maquinatiempo'){
                                    echo "<select name='selectmaquinatiempo' id='selectmaquinatiempo' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTable("Maquina");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idMaquina'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } else {
                                    $otros = true;
                                    echo "<input type='text' name='".$fila2['idCaracteristica']."' class='textinput-12'>";
                                    echo "</td>";
                                }
                            }
                        }
                        echo "</tr>";
                        echo "</tbody>";
                        ?>
                    </table>
                </div>

                <hr>

                <?php
                $indice = 0;
                $query = mysql_query("SELECT * FROM PCPSPC");
                while($row = mysql_fetch_array($query)){
                    $indice++;
                }
                echo "<input type='hidden' name='fila' value='".$indice."'>";
                ?>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <input type="submit" name="Volver" value="Volver" class="btn btn-default col-sm-8 col-sm-offset-2" formaction="versionHE4.php">
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" name="Agregar" value="Agregar" class="btn btn-success col-sm-8 col-sm-offset-2">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>