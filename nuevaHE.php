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
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
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

<section class="container">
        <form method="post" action="nuevaHE2.php">
            <div class="form-group">
                <div>
                    <label for="idProd">Id Producto</label>
                </div>
                <div>
                    <?php
                    $aux = 0;
                    $result = selectTable("producto");
                    while($fila = mysql_fetch_array($result)){
                        $aux++;
                    }
                    $aux++;
                    echo "<input type='text' name= 'idProd' id='idProd' value='PROD".$aux."' readonly>";
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="idProv">Id Provisional</label>
                </div>
                <div>
                    <input type="text" name="idProv" id="idProv">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="selecttipo">Tipo</label>
                </div>
                <div>
                    <?php
                    $result = selectTable("tipoproducto");
                    echo "<select name='selecttipo' id='selecttipo'>";
                    echo "<option>Seleccionar</option>";
                    while($fila = mysql_fetch_array($result)){
                        echo "<option value=".$fila['idTipoProducto'].">".$fila['idTipoProducto']."</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="selectgenero">Genero</label>
                </div>
                <div>
                    <?php
                    $result = selectTable("genero");
                    echo "<select name='selectgenero' id='selectgenero'>";
                    echo "<option>Seleccionar</option>";
                    while($fila = mysql_fetch_array($result)){
                        echo "<option value=".$fila['idgenero'].">".$fila['idgenero']."</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="selectidcliente">ID Cliente</label>
                </div>
                <div>
                    <?php
                    $result = selectTable("cliente");
                    echo "<select name='selectidcliente' id='selectidcliente'>";
                    echo "<option>Seleccionar</option>";
                    while($fila = mysql_fetch_array($result)){
                        echo "<option value=".$fila['idCliente'].">".$fila['nombre']."</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="codProdCliente">C&oacute;digo de Producto Cliente</label>
                </div>
                <div>
                    <input type="text" name="codProdCliente" id="codProdCliente">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="datepicker">Fecha de Creaci&oacute;n</label>
                </div>
                <div>
                    <input name="date" id="datepicker" />
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="selectempleado">Creado por:</label>
                </div>
                <div>
                    <?php
                    $result = selectTable("empleado");
                    echo "<select name='selectempleado' id='selectempleado'>";
                    echo "<option>Seleccionar</option>";
                    while($fila = mysql_fetch_array($result)){
                        echo "<option value=".$fila['idEmpleado'].">".$fila['nombres']." ".$fila['apellidos']."</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="observGen">Observaciones Generales:</label>
                </div>
                <div>
                    <textarea name="observGen" id="observGen" cols="30" rows="3"></textarea>
                </div>
            </div>
            <div>
                <div>
                    <label for="descrGen">Descripci&oacute;n General:</label>
                </div>
                <div>
                    <input type="text" name="descrGen" id="descrGen">
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" value="1" name="creacion">
                <input class="btn btn-success" type="submit" value="Siguiente">
            </div>
        </form>
</section>

    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

</html>