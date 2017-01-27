<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

$pais=SelectTable('Pais');
if(isset($_SESSION['login'])){

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waka-s Textiles Finos S.A.</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">

            <script>
                function getCiudad(val) {
                    $.ajax({
                        type: "POST",
                        url: "get_ciudad.php",
                        data:'pais_id='+val,
                        success: function(data){
                            $("#listaciudad").html(data);
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
        </header>

        <?php
            if(isset($_POST['guardarcli'])){
                $agregar = "INSERT INTO cliente(idCliente, nombre) VALUES ('".$_POST['idCli']."','".$_POST['nombrecli']."')";
                $agregar1 = mysql_query($agregar);
            }
        ?>

        <section class="container containerform">
            <div>
                <h3>Ingreso de Datos de Contacto</h3>
            </div><br>
            <form action="vercontactos.php" method="post" class="container-fluid">
                <div class="containerformcontrol col-sm-12">
                    <div class="col-sm-2">
                        <label for="nombre" class="formlabels">Nombres:</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="nombre" id="nombre" class="textinput-md">
                    </div>
                </div>
                <div class="containerformcontrol col-sm-12">
                    <div class="col-sm-2">
                        <label for="apellido" class="formlabels col-sm-12">Apellidos:</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="apellido" class="textinput-md" id="apellido">
                    </div>
                </div>
                <div class="containerformcontrol col-sm-12">
                    <div class="col-sm-2">
                        <label for="pais" class="formlabels">País:</label>
                    </div>
                    <div class="col-sm-10">
                        <select name="pais" id="pais" onChange="getCiudad(this.value);" class="ddselect">
                            <option>Pais</option>
                            <?php
                            while($fila=mysql_fetch_array($pais)){
                                echo "
                                    <option value=".$fila['idPais'].">".$fila['pais']."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="containerformcontrol col-sm-12">
                    <div class="col-sm-2">
                        <label for="listaciudad" class="formlabels col-sm-12">Ciudad:</label>
                    </div>
                    <div class="col-sm-10">
                        <select name="ciudad" id="listaciudad" class="ddselect">
                            <option>Ciudad</option>
                        </select>
                    </div>
                </div>
                <div class="containerformcontrol col-sm-12">
                    <div class="col-sm-2">
                        <label for="direccion" class="formlabels col-sm-12">Dirección:</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" id="direccion" name="direccion" class="textinput-lg">
                    </div>
                </div>
                <div class="containerformcontrol col-sm-12">
                    <div class="col-sm-2">
                        <label for="tele" class="formlabels col-sm-12">Teléfono:</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text"  id="tele" name="tel" class="textinput-sm">
                    </div>
                </div>
                <?php
                    $aux = 0;
                    $result = selectTable("Contacto");
                    while($fila1 = mysql_fetch_array($result)){
                        $aux++;
                    }
                    $aux++;
                    echo "<input type='hidden' name= 'idCon' value='CONT".$aux."' readonly>";

                    $aux2 = 0;
                    $result = selectTable("Direccion");
                    while($fila = mysql_fetch_array($result)){
                        $aux2++;
                    }
                    $aux2++;
                    echo "<input type='hidden' name= 'idDir' value='DIR".$aux."' readonly>";
                ?>
                <input type="hidden" name="cliente" value="<?php echo $_POST['idCli'] ?>">
                <div class="col-sm-12">
                    <input type="submit" name="guardar" value="Guardar" class="btn btn btn-primary boton">
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
