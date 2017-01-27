<!doctype html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Waka-s Textiles Finos S.A.</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
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
        <form action="gestionOperarios.php" method="post">
            <div class="form-group">
                <div>
                    <label for="idEmp">DNI</label>
                </div>
                <div>
                    <input type="text" name="idEmp" id="idEmp">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="nombres">Nombres</label>
                </div>
                <div>
                    <input type="text" name="nombres" id="nombres">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="apellidos">Apellidos</label>
                </div>
                <div>
                    <input type="text" name="apellidos" id="apellidos">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="tipouser">Tipo de Usuario</label>
                </div>
                <div>
                    <select name="tipouser" id="tipouser">
                        <option>Seleccionar</option>
                        <?php
                        $result=selectTable('TipoUsuario');
                        while($fila=mysql_fetch_array($result)){
                            echo "
                            <option>".$fila['Descripcion']."</option>
                        ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="usuario">Usuario</label>
                </div>
                <div>
                    <input type="text" name="usuario" id="usuario">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="pass">Contrase&ntilde;a</label>
                </div>
                <div>
                    <input type="text" name="pass" id="pass">
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" name="guardaremp" value="Guardar Colaborador">
                <input class="btn btn-default" type="submit" value="Regresar" formaction="gestionOperarios.php">
            </div>
        </form>
    </section>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>

<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
