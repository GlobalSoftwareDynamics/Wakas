<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Waka-s Textiles Finos S.A.</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

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
if(isset($_POST['guardar'])){
    $agregar="INSERT INTO Caracteristica VALUES ('".$_POST['idCaracteristica']."','".$_POST['descripcion']."','".$_POST['selecttipo']."')";
    $agregar1=mysql_query($agregar);
}
?>

<section class="containerform">
    <form action="#" method="post">
        <div>
            <h3>Nueva Caracter&iacute;stica</h3>
        </div>
        <div>
            <div>
                <label for="idCaracteristica">idCaracteristica:</label>
            </div>
            <div>
                <?php
                $aux = 0;
                $result = selectTable("Caracteristica");
                while($fila = mysql_fetch_array($result)){
                    $aux++;
                }
                $aux++;
                echo "<input id='idCaracteristica' type='text' name= 'idCaracteristica' value='CARAC".$aux."' readonly>";
                ?>
            </div>
        </div>
        <div>
            <div>
                <label for="Descripcion">Descripcion:</label>
            </div>
            <div>
                <input id="Descripcion" type="text" name="descripcion">
            </div>
        </div>
        <div>
            <div>
                <label for="selecttipo">Tipo:</label>
            </div>
            <div>
                <select name="selecttipo" id="selecttipo">
                    <option value="componente">Componente</option>
                    <option value="maquina">Maquina</option>
                    <option value="insumo">Insumo</option>
                    <option value="idinsumo">ID Insumo</option>
                    <option value="material">Material</option>
                    <option value="galga">Galga</option>
                    <option value="fotografia">Fotograf&iacute;a</option>
                    <option value="color">Color</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>
        <div>
            <input class="btn btn-success"type="submit" name="guardar" value="Agregar">
            <input formaction="menuagregarotros.php" class="btn btn-default" type="submit" value="Regresar">
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
