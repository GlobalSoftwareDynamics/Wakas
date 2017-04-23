<?php
session_start();
require('funciones.php');
conexion();
mysql_query("SET NAMES 'utf8'");
$prod0 = selectTable("Producto");
if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
?>
<html lang="es">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nueva Confirmaci&oacute;n de Venta</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">

        <script>
            function gettalla() {
                var producto = document.getElementById('prod').value;
                var idcodificacionTalla = document.getElementById('code').value;
                $.ajax({
                    type: "POST",
                    url: "get_talla.php",
                    data:{'producto':producto, 'idcodificacionTalla':idcodificacionTalla},
                    success: function(data){
                        $("#row").html(data);
                    }
                });
            }

            function getmaterial(val) {
                $.ajax({
                    type: "POST",
                    url: "get_materials.php",
                    data:'producto_id='+val,
                    success: function(data){
                        $("#mat").html(data);
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
                        <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                                    <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
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

        <?php

            if(isset($_POST['agregar'])){
                $agreg="INSERT INTO ProductoColor(idProducto, idColor) VALUES (
                              '".$_POST['producto']."','".$_POST['color']."')";
                $agreg1=mysql_query($agreg);
                $result1=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                while ($fila2=mysql_fetch_array($result1)){
                    if(isset($_POST[$fila2['idTalla']])&&$_POST[$fila2['idTalla']]){
                        $agregar1="INSERT INTO ConfirmacionVentaProducto(idProducto, idColor, idTalla, idContrato, idMaterial, cantidad, cantidadop, yourcode, estado) VALUES (
                            '".$_POST['producto']."','".$_POST['color']."','".$fila2['idTalla']."','".$_POST['contrato']."','".$_POST['material']."','".$_POST[$fila2['idTalla']]."'
                              ,'0','".$_POST['yourcode']."','1')";
                        $query=mysql_query($agregar1);
                    }
                }
            }

            if(isset($_POST['guardar'])){
                $agregar2="INSERT INTO ConfirmacionVenta(idContrato, idContacto, idIncoterm, idVia, idMetodoPago, idcodificacionTalla, fecha, shipdate, reference) VALUES (
                              '".$_POST['contrato']."','".$_POST['cliente']."','".$_POST['incoterm']."','".$_POST['via']."','".$_POST['payment']."','".$_POST['idcodificacionTalla']."'
                              ,'".$_POST['date']."','".$_POST['shipdate']."','".$_POST['referencia']."')";
                $agregar3=mysql_query($agregar2);
            }
        ?>
        <section class="container">
            <div>
                <h3>Paso 2: Selección de Productos</h3>
            </div>
        </section>
        <hr>
        <section class="container">
            <form action="nuevaCV2.php" class="form-horizontal jumbotron" method="post">
                <input type='hidden' id="contra" name='contrato' value="<?php echo $_POST['contrato']; ?>" readonly>
                <input type='hidden' id="code" name='idcodificacionTalla' value="<?php echo $_POST['idcodificacionTalla']; ?>" readonly>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="prod" class="formlabels col-sm-12">Producto:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id="prod" class="ddselect-6" name="producto" onchange='gettalla();'>
                            <option>Seleccionar</option>
                            <?php
                            $result2=selectTableWhere('Producto','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                            while ($fila1=mysql_fetch_array($result2)){
                                echo "
                                            <option value='".$fila1['idProducto']."'>".$fila1['idProducto']."</option>
                                        ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 15%">Código Cliente</th>
                            <th style="width: 20%">Material</th>
                            <th style="width: 15%">Color</th>
                            <?php
                            $result=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                            while ($fila=mysql_fetch_array($result)){
                                echo "
                                    <th>".$fila['descripcion']."</th>
                                ";
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody id="row">
                        <tr>
                            <td>
                                <input id="code" type="text" name="yourcode" class="textinput-12">
                            </td>
                            <td>
                                <select id='mat' class="ddselect-12" name='material'>
                                    <option>Seleccionar</option>
                                </select>
                            </td>
                            <td>
                                <select id='col' class="ddselect-12" name='color'>
                                    <option>Selecc.</option>
                                    <?php
                                    $prod2 = selectTable("Color");
                                    while($fila6 = mysql_fetch_array($prod2)){
                                        echo "
                                        <option>".$fila6['idColor']."</option>
                                    ";
                                    }
                                    ?>
                                </select>
                            </td>
                            <?php
                            $result3=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                            while ($fila3=mysql_fetch_array($result3)){
                                echo "
                                    <td><input type='text' class='textinput-12'></td>
                                ";
                            }
                            ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class='form-group'>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <input class='btn btn-success col-sm-6 col-sm-offset-3' type='submit' name='agregar' value='Agregar'>
                        </div>
                        <div class="col-sm-6">
                            <input class='btn btn-primary col-sm-6 col-sm-offset-3' type='submit' formaction="nuevaCV3.php" name='continuar' value='Siguiente'>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>