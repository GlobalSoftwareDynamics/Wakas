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
                            <th colspan="6">Tejido</th>
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
                                            } else {
                                                echo "<td>".$fila4['valor']."</td>";
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
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="5">Requerimiento Promedio de Material</th>
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

            <section class="container">
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="3">Resumen de Materiales</th>
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

            <section class="container">
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Observaciones</th>
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
                                            if($aux === 0){
                                                $aux++;
                                            }else{
                                                echo "</tr>";
                                            }
                                            echo "<tr>";
                                            echo "<td>".$fila4['valor']."</td>";
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
</body>
</html>