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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#datepicker").datepicker();
            });
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
                    <div class="col-sm-7">
                        <?php
                        $aux = 0;
                        $result = selectTable("producto");
                        while($fila = mysql_fetch_array($result)){
                            $aux++;
                        }
                        $aux++;
                        echo "<input type='text' class='textinput-6' name= 'idProd' id='idProd' value='PROD".$aux."' readonly>";
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
                        <input type="text" name="idProv" id="idProv" class="textinput-6">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selecttipo" class="formlabels col-sm-12">Tipo:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("tipoproducto");
                        echo "<select name='selecttipo' id='selecttipo' class='ddselect-8'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idTipoProducto'].">".$fila['idTipoProducto']."</option>";
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
                        echo "<select name='selectgenero' id='selectgenero' class='ddselect-6'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idgenero'].">".$fila['idgenero']."</option>";
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
                        echo "<select name='selectidcliente' id='selectidcliente' class='ddselect-10'>";
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
                        <label for="codProdCliente" class="formlabels col-sm-12">C&oacute;digo de Producto Cliente:</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="codProdCliente" id="codProdCliente" class="textinput-6">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="datepicker" class="formlabels col-sm-12">Fecha de Creaci&oacute;n:</label>
                    </div>
                    <div class="col-sm-7">
                        <input name="date" id="datepicker" class="textinput-6">
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
                        echo "<select name='selectempleado' id='selectempleado' class='ddselect-10'>";
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
                        <textarea name="observGen" id="observGen" cols="30" rows="3" class="areainput-12"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="descrGen" class="formlabels col-sm-12">Descripci&oacute;n General:</label>
                    </div>
                    <div  class="col-sm-7">
                        <textarea name="descrGen" id="descrGen" cols="30" rows="3" class="areainput-12"></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" value="1" name="creacion">
                <input type="hidden" value="add" name="add">
                <div class="col-sm-12">
                    <input class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" value="Siguiente">
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