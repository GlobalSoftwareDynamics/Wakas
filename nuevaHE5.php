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
        <link href="css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Insert de datos -->

    <?php
    if(isset($_POST['Agregar'])){
        $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = '".$_POST['selectsubproceso']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
        mysql_data_seek($result, 0);
        while($fila = mysql_fetch_array($result)){
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
                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectcomponente']."')",$con);
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
                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquina']."')",$con);
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
                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."')",$con);
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
                    $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$galgas_unidas."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo1']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo1']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo2']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectinsumo2']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    }
                } elseif ($fila['tipo']==="otro"||$fila['tipo']==="cantidad"||$fila['tipo']==='observacion') {
                    $result3 = mysql_query("SELECT * FROM PCPSPC");
                    $conteo = 0;
                    while($fila3 = mysql_fetch_array($result3)){
                        $conteo++;
                    }
                    $conteo++;
                    if(isset($_POST['selectcomponente'])){
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST[$fila2['idCaracteristica']]."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST[$fila2['idCaracteristica']]."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectprocedimiento']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$_POST['selectcomponente']."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquinatiempo']."')",$con);
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
                        $insertar = mysql_query("INSERT INTO PCPSPC VALUES ('".$conteo."','".$componente."', '".$fila['idSubProcesoCaracteristica']. "' , '".$_POST['selectmaquinatiempo']."')",$con);
                        if(!$insertar){
                            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                        }
                    }
                }
            }
        }
    }

    ?>

    <!-- Seleecionar Subproceso -->



    <section class="container">
        <!-- Contenido Real -->
        <div>
        <form method="post" action="#" class="form-horizontal col-sm-12">
            <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']; ?>">
            <input type="hidden" name="selectproceso" value="<?php echo $_POST['selectproceso']; ?>">
            <input type="hidden" name="selectsubproceso" value="<?php echo $_POST['selectsubproceso']; ?>">
            <div class="form-group">
            <table class="table table-bordered">
            <?php
                $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = '".$_POST['selectsubproceso']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                echo "
                
                    <thead>
                        <tr>";
                        mysql_data_seek($result, 0);
                        while($fila = mysql_fetch_array($result)){
                            $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                            while($fila2 = mysql_fetch_array($result2)){
                                echo "<th>".$fila2['descripcion']."</th>";
                            }
                        }
                        echo "</tr>
                    </thead>
                    <tbody>";
                        echo "<tr>";
                        mysql_data_seek($result, 0);
                        while($fila = mysql_fetch_array($result)){

                            $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                            mysql_data_seek($result2, 0);
                            while($fila2 = mysql_fetch_array($result2)){
                                echo "<td>";
                                if($fila['tipo']==="componente"){
                                    echo "<select name='selectcomponente' id='selectcomponente' onChange='getMaterial(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTableWhere("productocomponentesprenda","idProducto","'".$_POST['idProd']."'");
                                    while($fila3 = mysql_fetch_array($result3)){
                                        $result4 = selectTableWhere("componentesprenda","idComponente","'".$fila3['idComponente']."'");
                                        while($fila4 = mysql_fetch_array($result4)){
                                            echo "<option value='".$fila3['idComponenteEspecifico']."'>".$fila4['descripcion']."</option>";
                                        }
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==="material"){
                                    echo "<p id='material'></p>";
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
                                    echo "<p id='idinsumo'></p>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='procedimiento'){
                                    echo "<select name='selectprocedimiento' id='selectprocedimiento'  onchange='getProcedimiento(this.value)' class='ddselect-12'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTable("SubProceso");
                                    while ($fila3 = mysql_fetch_array($result3)) {
                                        echo "<option value='" . $fila3['idProcedimiento'] . "'>" . $fila3['descripcion'] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "</td>";
                                } elseif ($fila['tipo']==='IdProcedimiento'){
                                    echo "<p id='idProcedimiento'></p>";
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
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input type="submit" name="Agregar" value="Agregar" class="btn btn-default col-sm-8 col-sm-offset-2">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" name="Volver" value="Volver" class="btn btn-default col-sm-8 col-sm-offset-2" formaction="nuevaHE4.php">
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
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

</html>