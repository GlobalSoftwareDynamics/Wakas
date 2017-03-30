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
                            <input type="submit" class="btn-link" formaction="HEFinal.php" value="Sección General">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="HEFinalTejido.php" value="Sección Tejido">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="HEFinalLavSec.php" value="Sección Lavado y Secado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="HEFinalConfeccion.php" value="Sección Confección">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="HEFinalEtiqEmb.php" value="Sección Etiquetado y Embolsado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="HEFinalTiempos.php" value="Sección Tiempos y Secuencia">
                        </div>
                    </form>
                </div>
            </nav>
        </div>

        <div class="col-sm-9 col-sm-9">
            <!-- your page content -->
            <section class="container-fluid">
                <div class="col-sm-2">
                    <div>
                        <img width="110" height="110" src="image/logowakas.jpg"/>
                    </div>
                </div>
                <div class="col-sm-5" id="descripcionbrand">
                    <div>
                        <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
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
                        <h3>Ficha de Repuestos</h3>
                    </div>
                    <div>
                        <h4 class='desctitulo'>MOD <?php echo $_POST['idProd']; ?></h4>
                    </div>
                </div>
            </section>
            <hr>
            <div class="container col-sm-6">
                <div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>ID Producto:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php echo $_POST['idProd'];?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>ID Provisional:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['idProvisional']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Tipo:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['idTipoProducto']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Género:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['idgenero']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>ID Cliente:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['idCliente']?></span>
                        </div>
                    </div>
                    <div class="container col-sm-12 seperadorhe">

                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Fecha de Creación:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['fechaCreacion']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Creado por:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['creador']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Versión:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("ModificacionHE","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['version']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Fecha de Modificación:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("ModificacionHE","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['fechaModificacion']?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label>Modificado Por:</label>
                        </div>
                        <div class="col-sm-6">
                            <span><?php $result = selectTableWhere("ModificacionHE","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['idEmpleado']?></span>
                        </div>
                    </div>
                </div>
                <div class="container col-sm-12">
                    <br>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="thobservacion">Observaciones Generales</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="tdobservacion"><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['observaciones']?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container col-sm-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="thobservacion">Descripción General</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="tdobservacion"><?php $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'"); $fila=mysql_fetch_array($result); echo $fila['descripcionGeneral']?></td>
                    </tr>
                    <tr>
                        <?php
                        $file = null;
                        $filenamejpg = 'Fotografias/'.$_POST['idProd'].'-prod.jpg';
                        $filenamejpeg = 'Fotografias/'.$_POST['idProd'].'-prod.jpeg';
                        $filenamegif = 'Fotografias/'.$_POST['idProd'].'-prod.gif';
                        $filenamepng = 'Fotografias/'.$_POST['idProd'].'-prod.png';
                        if(file_exists($filenamejpg)){
                            $file=$filenamejpg;
                        } elseif(file_exists($filenamejpeg)){
                            $file=$filenamejpeg;
                        } elseif(file_exists($filenamegif)){
                            $file=$filenamegif;
                        } elseif(file_exists($filenamepng)){
                            $file=$filenamepng;
                        } else{
                            echo "No existe foto para el producto";
                        }
                        ?>
                        <td><img src="<?php echo $file;?>" alt='Fotografia de Producto' height='300' width='auto'/></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <section>
                <div class="container col-sm-12">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="thobservacion">Medidas</th>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>XXS</td>
                                <td>XS</td>
                                <td>S</td>
                                <td>M</td>
                                <td>L</td>
                                <td>XL</td>
                                <td>XXL</td>
                                <td>TU</td>
                                <td>Unidad de Medida</td>
                                <td>T +/-</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $bandera2 = false;
                            $contador = 0;
                            $medidasusadas = array();
                            $verificador = false;
                            $result = selectOrderedTable("tallamedida","idMedida");
                            while($fila = mysql_fetch_array($result)) {
                                if($fila['idProducto']==$_POST['idProd']){
                                    //if ($fila['idProducto'] == "PROD1") {
                                    $medidasusadas[$contador] = $fila['idMedida'];
                                    $contador++;
                                    if (isset($medidasusadas[$contador - 2])) {
                                        if ($medidasusadas[($contador - 2)] == $fila['idMedida']) {
                                        } else {
                                            echo "<tr>";
                                            $med="SELECT * FROM medida WHERE idMedida ='".$fila['idMedida']."'";
                                            $quer=mysql_query($med);
                                            while($fl=mysql_fetch_array($quer)){
                                                echo "<th>".$fl['descripcion']."</th>";
                                            }
                                            echo "<th>" . $fila['idMedida'] . "</th>";
                                            $indice = 0;
                                            $tallas = array();
                                            $valores = array();
                                            //while($fila2 = mysql_fetch_array($result2)){
                                            $result3 = selectTableWhere2("tallamedida","idMedida","'".$fila['idMedida']."'","idProducto","'".$_POST['idProd']."'");
                                            //$result3 = selectTableWhere2("tallamedida", "idMedida", "'" . $fila['idMedida'] . "'", "idProducto", "'PROD1'");
                                            while ($fila3 = mysql_fetch_array($result3)) {
                                                $tallas[$indice] = $fila3['idTalla'];
                                                $valores[$indice] = $fila3['valor'];
                                                $indice++;
                                            }
                                            $aux = 0;
                                            while ($aux < 9) {

                                                $bandera = false;
                                                switch ($aux) {
                                                    case 0:
                                                        $aux2 = "XXS";
                                                        break;
                                                    case 1:
                                                        $aux2 = "XS";
                                                        break;
                                                    case 2:
                                                        $aux2 = "S";
                                                        break;
                                                    case 3:
                                                        $aux2 = "M";
                                                        break;
                                                    case 4:
                                                        $aux2 = "L";
                                                        break;
                                                    case 5:
                                                        $aux2 = "XL";
                                                        break;
                                                    case 6:
                                                        $aux2 = "XXL";
                                                        break;
                                                    case 7:
                                                        $aux2 = "TU";
                                                        break;
                                                    case 8:
                                                        $aux2 = "Tolerancia";
                                                        break;
                                                    case 9:
                                                        $aux2 = "Observaciones";
                                                        break;
                                                }
                                                for ($i = 0; $i < count($tallas); $i++) {
                                                    if ($tallas[$i] == $aux2) {
                                                        echo "<td>" . $valores[$i] . "</td>";
                                                        $tallarealizada = true;
                                                        $bandera = true;
                                                    }
                                                    if($aux2 == "Tolerancia"){
                                                        if($bandera2){
                                                        }else {
                                                            $resultado = selectTableWhere2("productomedida", "idProducto", "'" . $_POST['idProd'] . "'", "idMedida", "'" . $fila['idMedida'] . "'");
                                                            //selectTableWhere2("productomedida","idproducto",$_POST['idProd'],"idmedida",$fila['idMedida']);
                                                            while ($filasa = mysql_fetch_array($resultado)) {
                                                                $res=selectTableWhere('Medida','idMedida',"'".$filasa['idMedida']."'");
                                                                while ($fil=mysql_fetch_array($res)){
                                                                    echo "<td>".$fil['idUnidadMedida']."</td>";
                                                                }
                                                                echo "<td>" . $filasa['tolerancia'] . "</td>";
                                                            }
                                                            $bandera = true;
                                                            $bandera2 = true;
                                                        }
                                                    }
                                                }
                                                if ($bandera == false) {
                                                    echo "<td></td>";
                                                }
                                                $aux++;
                                            }
                                            echo "</tr>";
                                            $bandera2 = false;
                                        }
                                    } else {
                                        echo "<tr>";
                                        $med="SELECT * FROM medida WHERE idMedida ='".$fila['idMedida']."'";
                                        $quer=mysql_query($med);
                                        while($fl=mysql_fetch_array($quer)){
                                            echo "<th>".$fl['descripcion']."</th>";
                                        }
                                        echo "<th>" . $fila['idMedida'] . "</th>";
                                        $indice = 0;
                                        $tallas = array();
                                        $valores = array();
                                        //while($fila2 = mysql_fetch_array($result2)){
                                        $result3 = selectTableWhere2("tallamedida","idMedida","'".$fila['idMedida']."'","idProducto","'".$_POST['idProd']."'");
                                        //$result3 = selectTableWhere2("tallamedida", "idMedida", "'" . $fila['idMedida'] . "'", "idProducto", "'PROD1'");
                                        while ($fila3 = mysql_fetch_array($result3)) {
                                            $tallas[$indice] = $fila3['idTalla'];
                                            $valores[$indice] = $fila3['valor'];
                                            $indice++;
                                        }
                                        $aux = 0;
                                        while ($aux < 9) {

                                            $bandera = false;
                                            switch ($aux) {
                                                case 0:
                                                    $aux2 = "XXS";
                                                    break;
                                                case 1:
                                                    $aux2 = "XS";
                                                    break;
                                                case 2:
                                                    $aux2 = "S";
                                                    break;
                                                case 3:
                                                    $aux2 = "M";
                                                    break;
                                                case 4:
                                                    $aux2 = "L";
                                                    break;
                                                case 5:
                                                    $aux2 = "XL";
                                                    break;
                                                case 6:
                                                    $aux2 = "XXL";
                                                    break;
                                                case 7:
                                                    $aux2 = "TU";
                                                    break;
                                                case 8:
                                                    $aux2 = "Tolerancia";
                                                    break;
                                                case 9:
                                                    $aux2 = "Observaciones";
                                                    break;
                                            }
                                            for ($i = 0; $i < count($tallas); $i++) {
                                                if ($tallas[$i] == $aux2) {
                                                    echo "<td>" . $valores[$i] . "</td>";
                                                    $tallarealizada = true;
                                                    $bandera = true;
                                                }
                                                if($aux2 == "Tolerancia"){
                                                    if($bandera2){
                                                    }else{
                                                        $resultado = selectTableWhere2("productomedida","idProducto","'".$_POST['idProd']."'","idMedida","'".$fila['idMedida']."'");
                                                        //selectTableWhere2("productomedida","idproducto",$_POST['idProd'],"idmedida",$fila['idMedida']);
                                                        while($filasa = mysql_fetch_array($resultado)) {
                                                            $res=selectTableWhere('Medida','idMedida',"'".$filasa['idMedida']."'");
                                                            while ($fil=mysql_fetch_array($res)){
                                                                echo "<td>".$fil['idUnidadMedida']."</td>";
                                                            }
                                                            echo "<td>".$filasa['tolerancia']."</td>";
                                                        }
                                                        $bandera = true;
                                                        $bandera2 = true;
                                                    }
                                                }
                                            }



                                            if ($bandera == false) {
                                                echo "<td></td>";
                                            }
                                            $aux++;
                                        }
                                        echo "</tr>";
                                        $bandera2 = false;
                                    }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section class="container col-sm-12">
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="thobservacion">Observaciones - Medidas</th>
                        </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $result2 = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."'");
                                    while($fila2 = mysql_fetch_array($result2)){
                                        if($fila2['observacion']===''||$fila2['observacion']=== null){
                                        }else {
                                            echo "<tr>";
                                            echo "<td class='tdobservacion'>" . $fila2['observacion'] . "</td>";
                                            echo "</tr>";
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
    <form action="hefinalpdf.php" method="post" class="form-horizontal col-sm-12">
        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
        <input type="submit" class="btn btn-default col-sm-4 col-sm-offset-4" name="pdf" value="Descargar PDF">
    </form>
    <br>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
</body>
</html>