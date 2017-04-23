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
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#datepicker").datepicker();
            });
        </script>
        <script>
            function getID(val,val2) {
                $.ajax({
                    type: "POST",
                    url: "get_ProdID.php",
                    data:'tipoproducto=' + val + '&idProd=' + val2,
                    success: function(data){
                        $("#idProd").html(data);
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


<section class="container">
    <div>
        <h3>Paso 1: Datos Generales</h3>
    </div>
    <hr>
        <form method="post" action="nuevaHE2.php" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
            <div>
                <h4>Nueva Hoja de Especificaciones</h4>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="idProd" class="formlabels col-sm-12">Id Producto:</label>
                    </div>
                    <div class="col-sm-7" id="idProd">
                        <?php
                        $aux = 1;
                        $i = 0;
                        $strings = array();
                        $flag = false;
                        $result = selectTable("producto");
                        while($fila = mysql_fetch_array($result)){
                            $strings[$i] = substr($fila['idProducto'],0,4);
                            $i++;
                        }
                        asort($strings);
                        for($j=1;$j<$i;$j++){
                            if($strings[($j-1)]==$strings[$j]){
                            }else{
                                $aux++;
                            }
                        }
                        if($aux == 0){
                            $idProd = 6000;
                        }else{
                            $idProd = $aux + 6001;
                        }
                        //echo "<span id='idProd'>".$idProd."</span>";
                        echo "<input type='text' class='form-control textinput-6' name='idProd' id='idProd' value='".$idProd."' readonly>"
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="idProv" class="formlabels col-sm-12">Id Provisional:</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="idProv" id="idProv" class="textinput-6 form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selecttipo" class="formlabels col-sm-12">Tipo de Producto:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("tipoproducto");
                        echo "<select name='selecttipo' id='selecttipo' class='ddselect-8  form-control' onchange='getID(this.value,$idProd)'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idTipoProducto'].">".$fila['descripcion']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectgenero" class="formlabels col-sm-12">Genero:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("genero");
                        echo "<select name='selectgenero' id='selectgenero' class='ddselect-6 form-control'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idgenero'].">".$fila['descripcion']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectcodificaciontalla" class="formlabels col-sm-12">Codificación de Talla:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("codificacionTalla");
                        echo "<select name='selectcodificaciontalla' id='selectcodificaciontalla' class='ddselect-6 form-control'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idcodificacionTalla'].">".$fila['descripcion']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectidcliente" class="formlabels col-sm-12">ID Cliente:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("cliente");
                        echo "<select name='selectidcliente' id='selectidcliente' class='ddselect-10 form-control'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idCliente'].">".$fila['nombre']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="datepicker" class="formlabels col-sm-12">Fecha de Creaci&oacute;n:</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="date" id="datepicker" class="textinput-6 form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectempleado" class="formlabels col-sm-12">Creado por:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("empleado");
                        echo "<select name='selectempleado' id='selectempleado' class='ddselect-10 form-control'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idEmpleado'].">".$fila['nombres']." ".$fila['apellidos']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="observGen" class="formlabels col-sm-12">Observaciones Generales:</label>
                    </div>
                    <div class="col-sm-7">
                        <textarea name="observGen" id="observGen" cols="30" rows="3" class="areainput-12 form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="descrGen" class="formlabels col-sm-12">Descripci&oacute;n General:</label>
                    </div>
                    <div  class="col-sm-7">
                        <textarea name="descrGen" id="descrGen" cols="30" rows="3" class="areainput-12 form-control"></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" value="1" name="creacion">
                <input type="hidden" value="add" name="add">
                <div class="col-sm-12">
                    <input class="btn btn-default col-sm-3 col-sm-offset-2" type="submit" value="Regresar" formaction="mainAdmin.php">
                    <input class="btn btn-primary col-sm-3 col-sm-offset-2" type="submit" value="Siguiente">
                </div>
            </div>
        </form>
</section>

    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>