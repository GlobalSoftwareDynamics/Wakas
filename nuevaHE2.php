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
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">

    </head>

    <body>
    <header>
        <nav class="navbar navbar-inverse">
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
    <!-- Insert de datos NuevaHE -->
        <?php
        if(isset($_POST['creacion'])){
            $insertar = mysql_query("INSERT INTO producto (idProducto, idProvisional, idTipoProducto, idCliente, fechaCreacion, creador, observaciones, descripcionGeneral, idgenero) VALUES ('".$_POST['idProd']."', '".$_POST['idProv'].
                "', '".$_POST['selecttipo']."', '".$_POST['selectidcliente']."', '".$_POST['date']."', '".$_POST['selectempleado']."', '".$_POST['observGen']."', '".$_POST['descrGen']."', '".$_POST['selectgenero']."')",$con);
            if(!$insertar){
                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
            }
        }

        if(isset($_POST['add'])&&($_POST['add']=='Agregar')){
            $insertar = mysql_query("INSERT INTO tallamedida (idProducto, idTalla, idMedida, valor) VALUES ('".$_POST['idProd']."', '".$_POST['selecttalla']."', '".$_POST['selectmedida']."','".$_POST['valormedida']."')",$con);
            if(!$insertar){
                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
            }
        }

        if(isset($_POST['tolobs'])){
            $insertar = mysql_query("INSERT INTO productomedida (idProducto, idMedida, tolerancia, observacion) VALUES ('".$_POST['idProd']."', '".$_POST['selectmedida']."', '".$_POST['tolerancia']."','".$_POST['observacion']."')",$con);
            if(!$insertar){
                echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
            }
        }
        ?>
        <!-- Tabla de Datos de NuevaHE2 -->
    <section class="container">
        <div>
            <h3>Paso 2: Medidas y Tallas</h3>
        </div>
        <hr>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th>Medidas</th>
                    <th>XXS</th>
                    <th>XS</th>
                    <th>S</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                    <th>XXL</th>
                    <th>TU</th>
                    <th>T +/-</th>
                    <th>Observaciones</th>
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
                                echo "<td>" . $fila['idMedida'] . "</td>";
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
                                                    echo "<td>" . $filasa['tolerancia'] . "</td>";
                                                    echo "<td>" . $filasa['observacion'] . "</td>";
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
                            echo "<td>" . $fila['idMedida'] . "</td>";
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
                                                echo "<td>".$filasa['tolerancia']."</td>";
                                                echo "<td>".$filasa['observacion']."</td>";
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
    </section>
    <hr>
    <?php
        if(isset($_POST["add"])&&!isset($_POST["addtolerancias"])){
            echo "<section class='container'>
                    <form action='#' method='post' class='form-horizontal jumbotron col-sm-6 col-sm-offset-3'>
                        <div class='form-group'>
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='selectmedida' class='formlabels col-sm-12'>Medida:</label>
                                </div>
                                <div class='col-sm-8'>";
                $result = selectTable("medida");
                echo "<select name='selectmedida' id='selectmedida' class='ddselect-12'>";
                echo "<option>Seleccionar</option>";
                while($fila = mysql_fetch_array($result)){
                    echo "<option value=".$fila['idMedida'].">".$fila['descripcion']."</option>";
                }
                echo "</select>";
                echo "</div>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='valormedida' class='formlabels col-sm-12'>Valor Medida:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <input type='text' name='valormedida' id='valormedida' class='textinput-4'>
                                </div >
                            </div>
                        </div>
                            <input type='hidden' value='".$_POST['idProd']."' name='idProd'>
                        <div class='form-group'>
                            <div class='col-sm-12'>
                            <div class='col-sm-4'>
                                <label for='selecttalla' class='formlabels col-sm-12'>Talla:</label>
                            </div>
                            <div class='col-sm-8'>";
            $result = selectTable("talla");
            echo "<select name='selecttalla' id='selecttalla' class='ddselect-4'>";
            echo "<option>Selecc.</option>";
            while($fila = mysql_fetch_array($result)){
                echo "<option value=".$fila['idTalla'].">".$fila['idTalla']."</option>";
            }
            echo "</select>";
            echo "</div>
                    </div>
                            </div>
                            <hr>
                            <div class='form-group'>
                                <div class='col-sm-12'>
                                    <div class='col-sm-6'>
                                        <input class='btn btn-default col-sm-10 col-lg-offset-1' type='submit' value='Agregar' name='add'>
                                    </div>
                                    <div class='col-sm-6'>
                                        <input class='btn btn-default col-sm-10 col-lg-offset-1' type='submit' value='Gestionar Tolerancias' name='addtolerancias'>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>";
        }else{
            echo "<section class='container'>
                    <form action='#' method='post' class='form-horizontal jumbotron col-sm-6 col-lg-offset-3'>
                        <div class='form-group'>
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='selectmedida' class='formlabels col-sm-12'>Medida:</label>
                                </div>
                                <div class='col-sm-8'>";
                                    $aux = "A";
                                    $aux2 = "B";
                                    settype($aux,"string");
                                    settype($aux2,"string");
                                    $result = mysql_query("SELECT * FROM tallamedida WHERE idProducto = '".$_POST['idProd']."' ORDER BY idMedida");
                                    echo "<select name='selectmedida' id='selectmedida' class='ddselect-12'>";
                                        echo "<option>Seleccionar</option>";
                                        while($fila = mysql_fetch_array($result)){
                                            $aux = $fila['idMedida'];
                                            if($aux != $aux2){
                                                $aux2 = $fila['idMedida'];
                                                $result2 = selectTableWhere("medida","idMedida","'".$fila['idMedida']."'");
                                                while($fila2 = mysql_fetch_array($result2)){
                                                    echo "<option value=".$fila2['idMedida'].">".$fila2['descripcion']."</option>";
                                                }
                                            }
                                        }
                                    echo "</select>";
                                echo "</div>
                            </div>
                            </div>
                            <div class='form-group'>
                                <div class='col-sm-12'>
                                    <div class='col-sm-4'>
                                        <label for='tolerancia' class='formlabels col-sm-12'>Tolerancia:</label>
                                    </div>
                                    <div class='col-sm-8'>
                                        <input type='text' name='tolerancia' id='tolerancia' class='textinput-4'>
                                    </div>
                                </div>
                            </div>
                            <input type='hidden' value='".$_POST['idProd']."' name='idProd'>
                            <div class='form-group'>
                                <div class='col-sm-12'>
                                    <div class='col-sm-4'>
                                        <label for='observacion' class='formlabels col-sm-12'>Observaci&oacute;n:</label>
                                    </div>
                                    <div class='col-sm-8'>
                                        <textarea name='observacion' cols='30' rows='3' id='observacion' class='textinput-12'></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class='form-group'>
                                <div class='col-sm-12'>
                                    <div class='col-sm-6'>
                                        <input class='btn btn-default col-sm-10 col-sm-offset-1' type='submit' value='Agregar' name='tolobs'>
                                    </div>
                                    <div class='col-sm-6'>
                                        <input class='btn btn-default col-sm-10 col-sm-offset-1' type='submit' value='Gestionar Medidas' name='add'>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>";
        }
    ?>

    <hr>

    <section class="container">
        <form action="nuevaHE3.php" method="post" class="col-sm-12">
            <div class="form-group">
                <input type="hidden" name="idProd" value="<?php echo $_POST['idProd'] ?>">
                <input class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" value="Continuar">
            </div>
        </form>
    </section>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

</html>