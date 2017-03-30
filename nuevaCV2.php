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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="css/Formularios.css" rel="stylesheet">

        <script>
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

            function gettalla(val) {
                $.ajax({
                    type: "POST",
                    url: "get_talla.php",
                    data:'producto_id='+val,
                    success: function(data){
                        $("#tall").html(data);
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

        <?php

            if(isset($_POST['agregar'])){
                $agreg="INSERT INTO ProductoColor(idProducto, idColor) VALUES (
                              '".$_POST['producto']."','".$_POST['color']."')";
                $agreg1=mysql_query($agreg);
                $agregar="INSERT INTO ConfirmacionVentaProducto(idProducto, idColor, idTalla, idContrato, idMaterial, cantidad, yourcode) VALUES (
                              '".$_POST['producto']."','".$_POST['color']."','".$_POST['talla']."','".$_POST['contrato']."','".$_POST['material']."','".$_POST['cantidad']."'
                              ,'".$_POST['yourcode']."')";
                $agregar1=mysql_query($agregar);
               }

            if(isset($_POST['guardar'])){
                $agregar2="INSERT INTO ConfirmacionVenta(idContrato, idContacto, idIncoterm, idVia, idMetodoPago, fecha, shipdate, reference) VALUES (
                              '".$_POST['contrato']."','".$_POST['cliente']."','".$_POST['incoterm']."','".$_POST['via']."','".$_POST['payment']."'
                              ,'".$_POST['date']."','".$_POST['shipdate']."','".$_POST['referencia']."')";
                $agregar3=mysql_query($agregar2);
            }
        ?>

        <section class='container'>
            <form action='nuevaCV2.php' method='post' class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
                <div>
                    <h3>Paso 2: Selección de Productos</h3>
                </div>
                <hr>
                <input type='hidden' name='contrato' value="<?php echo $_POST['contrato']; ?>" readonly>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for='produc' class="formlabels col-sm-12">Seleccione Producto:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id='produc' class="ddselect-6" onChange='getmaterial(this.value);gettalla(this.value);' name='producto'>
                            <option>Seleccionar</option>
                                <?php
                                    while($fila4 = mysql_fetch_array($prod0)){
                                        echo "
                                            <option>".$fila4['idProducto']."</option>
                                        ";
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for='codigocli' class="formlabels col-sm-12">Ingrese C&oacute;digo del Cliente:</label>
                    </div>
                    <div class="col-sm-7">
                        <input id='codigocli' class="textinput-6" type='text' name='yourcode'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for='mat' class="formlabels col-sm-12">Seleccione Material:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id='mat' class="ddselect-10" name='material'>
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for='col' class="formlabels col-sm-12">Seleccione Color:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id='col' class="ddselect-6" name='color'>
                            <option>Seleccionar</option>
                            <?php
                                $prod2 = selectTable("Color");
                                while($fila6 = mysql_fetch_array($prod2)){
                                    echo "
                                        <option>".$fila6['idColor']."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for='tall' class="formlabels col-sm-12">Seleccione Talla:</label>
                    </div>
                    <div class="col-sm-7">
                        <select id='tall' class="ddselect-3" name='talla'>
                            <option>Selec.</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for='cant' class="formlabels col-sm-12">Cantidad:</label>
                    </div>
                    <div class="col-sm-7">
                        <input id='cant' class="textinput-3" type='text' name='cantidad'>
                    </div>
                </div>
                <hr>
                <div class='form-group'>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <input class='btn btn-default col-sm-6 col-sm-offset-3' type='submit' name='agregar' value='Agregar'>
                        </div>
                        <div class="col-sm-6">
                            <input class='btn btn-default col-sm-6 col-sm-offset-3' type='submit' type='submit' formaction="nuevaCV3.php" name='continuar' value='Continuar'>
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
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>