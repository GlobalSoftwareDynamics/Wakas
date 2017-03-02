<!doctype html>
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

    <section class="container">
        <form action="asignarRepuestos.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
            <?php
            if(isset($_GET['idRepuestos'])){
                echo "
                         <input type='hidden' name='idRep' value=".$_GET['idRepuestos']." readonly>
                    ";
            }
            if(isset($_POST['asignar'])){
                echo "
                         <input type='hidden' name='idRep' value=".$_POST['idRep']." readonly>
                    ";
            }
            ?>
            <div>
                <h3>Asignar Repuestos</h3>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <label for="idMaq" class="formlabels1 col-sm-12">Seleccionar M&aacute;quina:</label>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    <select id="idMaq" name="idMaq" class="ddselect-12">
                        <option>Seleccionar</option>
                        <?php
                        $result=selectTable('Maquina');
                        while ($fila=mysql_fetch_array($result)){
                            echo "
                                <option value='".$fila['idMaquina']."'>".$fila['descripcion']."</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <input class="btn btn-success col-sm-10 col-sm-offset-2" type="submit" name="asignar" value="Asignar M&aacute;quina">
                    </div>
                    <div class="col-sm-4">
                        <input formaction="gestionMaquinas.php" class="btn btn-success col-sm-10 col-sm-offset-2" type="submit" value="Ir a M&aacute;quinas">
                    </div>
                    <div class="col-sm-4">
                        <input formaction="gestionRepuestos.php" class="btn btn-success col-sm-10 col-sm-offset-2" type="submit" value="Regresar">
                    </div>
                </div>
            </div>
        </form>

        <?php
        if(isset($_POST['asignar'])){
            $agregar2="INSERT INTO RepuestosMaquina(idRepuestos, idMaquina) VALUES ('".$_POST['idRep']."','".$_POST['idMaq']."')";
            $agregar3=mysql_query($agregar2);
            if ( !empty( $error = mysql_error() ) )
            {
                echo 'Mysql error '. $error ."<br />\n";
            }else{
                echo "<br>";
                echo "<div class='alert alert-success' role='alert'>";
                echo 	"<p> <strong>Asignación completada</strong></p>";
                echo " </div>";
            }
        }
        ?>
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