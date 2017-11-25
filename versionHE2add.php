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
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
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
            		if((isset($_POST[$fila['idTalla']]))&&(($_POST[$fila['idTalla']]===null)||($_POST[$fila['idTalla']]===0))){		
			}else{
			mysql_data_seek($result,0);
			$result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$_POST['selectcodificaciontalla']."'");
        		while ($fila = mysql_fetch_array($result)){
            		if(isset($_POST[$fila['idTalla']])){
               	 		$insertar = mysql_query("INSERT INTO TallaMedida (idProducto, idTalla, idMedida, valor) VALUES ('".$_POST['idProd']."','".$fila['idTalla']."','".$_POST['selectmedida']."','".$_POST[$fila['idTalla']]."')");
            		}
        	}
        	$insertar = mysql_query("INSERT INTO ProductoMedida (idProducto, idMedida, tolerancia, observacion) VALUES ('".$_POST['idProd']."','".$_POST['selectmedida']."','".$_POST['tolerancia']."','".$_POST['observacion']."')");
	}
        	}
	
        
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

    <br>
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