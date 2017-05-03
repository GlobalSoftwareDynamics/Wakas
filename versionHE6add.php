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
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
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
                        if($fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC17' || $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC1' || $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC8'|| $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC23'|| $fila['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC27'){
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
                                case "SUBPROCESOCARAC23":
                                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+2)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC34' , '".$_POST['selectprocedimiento']."','".$_POST['fila']."')",$con);
                                    if(!$insertar){
                                        echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                                    }
                                    break;
                                case "SUBPROCESOCARAC27":
                                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".($conteo+2)."','".$_POST['selectcomponente']."', 'SUBPROCESOCARAC34' , 'PROCEDIMIENTO26','".$_POST['fila']."')",$con);
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
        <?php
		$query = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$_POST['selectsubproceso']."'");
		while($row=mysql_fetch_array($query)){
			$procedimientoelegido = $row['descripcion'];
		}
	?>
        <div>
            <h3>Selección de Datos para Subproceso de <?php echo $procedimientoelegido?></h3>
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
                                        $result4 = selectTableWhere2("maquina","idMaquina","'".$fila3['idMaquina']."'",'estado','1');
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
                                    $result3 = mysql_query("SELECT * FROM Insumos WHERE tipoInsumo = 'Acondicionamiento' AND estado = '1'");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idInsumo'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='insumo1') {
                                    echo "<select name='selectinsumo1' id='selectinsumo1'  onchange='getInsumo(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = mysql_query("SELECT * FROM Insumos WHERE tipoInsumo = 'Lavado' AND estado = '1'");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idInsumo'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='insumo2') {
                                    echo "<select name='selectinsumo2' id='selectinsumo2'  onchange='getInsumo(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = mysql_query("SELECT * FROM Insumos WHERE tipoInsumo = 'Lavado' AND estado = '1'");
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
                                    $result3 = mysql_query("SELECT * FROM SubProceso WHERE idProceso = 'PROCESO4' AND estado = '1'");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idProcedimiento'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='ProcedimientoTiempos'){
                                    echo "<select name='selectprocedimiento' id='selectprocedimiento'  onchange='getProcedimiento(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTableWhere("SubProceso",'estado','1');
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
                                    $result3 = selectTableWhere("Maquina",'estado','1');
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
                            <input type="submit" name="Volver" value="Volver" class="btn btn-default col-sm-8 col-sm-offset-2" formaction="versionHE6.php">
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" name="Agregar" value="Agregar" class="btn btn-success col-sm-8 col-sm-offset-2">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="container">
        <?php
        if($_POST['selectsubproceso']==='PROCEDIMIENTO1'){  //Tejido
            echo '
        <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="6" class="thobservacion">Tejido</th>
                        </tr>
                        <tr>';
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
                    }else{
                        echo "<th>".$fila2['descripcion']."</th>";
                    }

                }
            }
            echo "
        </tr>
        </thead>
        <tbody>";
            $aux = 0;
            $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
            while ($fila3 = mysql_fetch_array($result3)){
                $componente = $fila3['idComponente'];
                $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica");
                while ($fila4 = mysql_fetch_array($result4)){
                    for($j=0;$j<count($caracteristicas);$j++){
                        if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                            if($tipo[$j] === 'componente'){
                                if($aux === 0){
                                    $aux++;
                                }else{
                                    echo "</tr>";
                                }
                                echo "<tr>";
                                $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                while ($fila5 = mysql_fetch_array($result5)){
                                    echo "<td class='tdobservacion'>".$fila5['descripcion']."</td>";
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
                            }elseif ($tipo[$j] === 'tiempo'){
                            } else {
                                echo "<td>".$fila4['valor']."</td>";
                            }
                        }
                    }
                }
            }
            echo "
        </tbody>
        </table>
        </div>";
        }elseif($_POST['selectsubproceso']==='PROCEDIMIENTO2'){     //Lavado
            echo '
        <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="8" class="thobservacion">Lavado</th>
                        </tr>
                        <tr>';

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
                    }else{
                        echo "<th>".$fila2['descripcion']."</th>";
                    }
                }
            }
            echo '
        </tr>
        </thead>
        <tbody>';

            $aux = 0;
            $cantidades = array();
            $insumo = 0;
            $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
            while ($fila3 = mysql_fetch_array($result3)){
                $componente = $fila3['idComponente'];
                $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY idComponenteEspecifico ASC, LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                while ($fila4 = mysql_fetch_array($result4)){
                    for($j=0;$j<count($caracteristicas);$j++){
                        if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                            if($tipo[$j] === 'componente'){
                                if($aux === 0){
                                    $aux++;
                                }else{
                                    echo "</tr>";
                                }
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
                            } elseif ($tipo[$j] === 'tiempo'){
                            } else {
                                echo "<td>".$fila4['valor']."</td>";
                            }
                        }
                    }
                }
            }
            echo '
        </tbody>
        </table>
        </div>';
        }elseif($_POST['selectsubproceso']==='PROCEDIMIENTO6'){     //Secado
            echo '
        <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="5" class="thobservacion">Secado</th>
                        </tr>
                        <tr>';

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
                    } elseif ($fila['tipo'] === 'tiempo'){
                    } else{
                        echo "<th>".$fila2['descripcion']."</th>";
                    }
                }
            }
            echo '
        </tr>
        </thead>
        <tbody>';
            $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
            while ($fila3 = mysql_fetch_array($result3)){
                $componente = $fila3['idComponente'];
                echo "<tr>";
                $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY id");
                while ($fila4 = mysql_fetch_array($result4)){
                    for($j=0;$j<count($caracteristicas);$j++){
                        if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                            if($tipo[$j] === 'componente'){
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

                            } elseif ($tipo[$j] === 'tiempo'){

                            } else {
                                echo "<td>".$fila4['valor']."</td>";
                            }
                        }
                    }
                }
                echo "</tr>";
            }
            echo '
        </tbody>
        </table>
        </div>';
        }elseif($_POST['selectsubproceso']==='PROCEDIMIENTO30'){    //Confeccion
            echo '
        <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>';

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
            echo '
        </tr>
        </thead>
        <tbody>';

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
            echo '
        </tbody>
        </table>
        </div>';
        }elseif($_POST['selectsubproceso']==='PROCEDIMIENTO26'){    //Etiquetado y Embolsado
            echo '
        <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="6" class="thobservacion">Etiquetado y Embolsado</th>
                        </tr>
                        <tr>';

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
            echo '
        </tr>
        </thead>
        <tbody>';

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
                echo "</tr>";
            }
            echo '
        </tbody>
        </table>
        </div>';
        }elseif($_POST['selectsubproceso']==='PROCEDIMIENTO32'){    //Hoja de Tiempos y Secuencia
            echo '
        <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="6">Hoja de Tiempos y Secuencias</th>
                        </tr>
                        <tr>';

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
            echo '
        </tr>
        </thead>
        <tbody>';

            $auxcomp = 0;
            $auxproced = 0;
            $auxmaquina = 0;
            $auxtiempo = 0;
            $auxfila = 0;
            $filaproceso = array();
            $componente = array();
            $procedimiento = array();
            $maquina = array();
            $tiempo = array();
            $string = null;
            $bandera = false;
            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
            while($fila = mysql_fetch_array($result)) {
                if($bandera == false){
                    $string = $string."idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ";
                    $bandera = true;
                }else{
                    $string = $string."OR idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ";
                }
            }
            $query ="SELECT * FROM PCPSPC WHERE ".$string." ORDER BY LENGTH (id)";
            $result2 = mysql_query($query);
            while($fila2 = mysql_fetch_array($result2)){
                if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC32'){   //CAMBIAR AL DEJAR FIJO!!!!!
                    $componente[$auxcomp] = $fila2['valor'];
                    $auxcomp++;
                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC34'){    //CAMBIAR AL DEJAR FIJO!!!!!
                    $procedimiento[$auxproced] = $fila2['valor'];
                    $auxproced++;
                    $filaproceso[$auxfila] = $fila2['fila'];
                    $auxfila++;
                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC35'||$fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC39'||$fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC41'){    //CAMBIAR AL DEJAR FIJO!!!!!
                    $maquina[$auxmaquina] = $fila2['valor'];
                    $auxmaquina++;
                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC36'){    //CAMBIAR AL DEJAR FIJO!!!!!
                    $tiempo[$auxtiempo] = $fila2['valor'];
                    $auxtiempo++;
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
                    if($procedimiento[$j]==='PROCEDIMIENTO26'){
                        $query = mysql_query("SELECT * FROM PCPSPC WHERE fila = '".$filaproceso[$j]."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC29'");
                        while($row = mysql_fetch_array($query)){
                            $insumo = $row['valor'];
                        }
                        $query = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$insumo."'");
                        while($row = mysql_fetch_array($query)){
                            $insumo = $row['descripcion'];
                        }
                        echo "<td>".$fila['idProcedimiento']."</td>";
                        $result2 = mysql_query("SELECT * FROM Proceso WHERE idProceso = '".$fila['idProceso']."'");
                        while($fila2 = mysql_fetch_array($result2)){
                            echo "<td>".$fila2['descripcion']."-".$insumo."-".$prenda."</td>";
                        }
                    }else{
                        echo "<td>".$fila['idProcedimiento']."</td>";
                        $result2 = mysql_query("SELECT * FROM Proceso WHERE idProceso = '".$fila['idProceso']."'");
                        while($fila2 = mysql_fetch_array($result2)){
                            echo "<td>".$fila2['descripcion']."-".$fila['descripcion']."-".$prenda."</td>";
                        }
                    }
                }
                $result = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$maquina[$j]."'");
                while($fila = mysql_fetch_array($result)){
                    echo "<td>".$fila['descripcion']."</td>";
                }
                echo "<td>".$tiempo[$j]."</td>";
                echo "</tr>";
            }
            echo '
        </tbody>
        </table>
        </div>';
        }
        ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <footer class="panel-footer navbar-fixed-bottom">
        <div class="container col-sm-6 col-sm-offset-3 text-center">
            <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
        </div>
    </footer>
    </body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>