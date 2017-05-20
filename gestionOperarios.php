<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();
if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="Waka-s">
    <meta name="application-name" content="Waka-s">
    <meta name="theme-color" content="#ef4a43">
    <title>Gesti&oacute;n de Personal</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">

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
    <form action="gestionOperarios.php" method="post" class="form-horizontal jumbotron col-sm-12">
        <div class="form-group col-sm-6">
            <div class="col-sm-5">
                <label for="filtroEmpleado" class="formlabels col-sm-12">Buscar por DNI:</label>
            </div>
            <div class="col-sm-7">
                <input type="text" id="filtroEmpleado" name="filtroEmpleado" class="textinput-12">
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <input class="btn btn-success col-sm-10 col-sm-offset-2 boton" type="submit" name="buscaremp" value="Buscar">
                </div>
                <div class="col-sm-6">
                    <input class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" value="Eliminar Filtro">
                </div>
            </div>
        </div>
    </form>
</section>

<hr>

<?php
if(isset($_POST['eliminarEmpleado'])) {
    $eliminarcont="UPDATE empleado SET estado = '0' WHERE idEmpleado = '".$_POST['idempleado']."'";
    $eliminarcont1=mysql_query($eliminarcont);
}
if(isset($_POST['guardaremp'])){
    $agregar = "INSERT INTO empleado(idEmpleado, idTipoUsuario, nombres, apellidos, usuario, contrasena, estado) VALUES ('".$_POST['idEmp']."','".$_POST['tipouser']."','".$_POST['nombres']."','".$_POST['apellidos']."','".$_POST['usuario']."','".$_POST['pass']."','1')";
    $agregar1 = mysql_query($agregar);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_POST['actualizaremp'])){
    $actualziar="UPDATE empleado SET idTipoUsuario = '".$_POST['tipouser']."' WHERE idEmpleado = '".$_POST['idEmp']."'";
    $actualziar1=mysql_query($actualziar);
    $actualziar2="UPDATE empleado SET nombres = '".$_POST['nombres']."' WHERE idEmpleado = '".$_POST['idEmp']."'";
    $actualziar3=mysql_query($actualziar2);
    $actualziar4="UPDATE empleado SET apellidos = '".$_POST['apellidos']."' WHERE idEmpleado = '".$_POST['idEmp']."'";
    $actualziar5=mysql_query($actualziar4);
    $actualziar6="UPDATE empleado SET usuario = '".$_POST['usuario']."' WHERE idEmpleado = '".$_POST['idEmp']."'";
    $actualziar7=mysql_query($actualziar6);
    $actualziar8="UPDATE empleado SET contrasena = '".$_POST['pass']."' WHERE idEmpleado = '".$_POST['idEmp']."'";
    $actualziar9=mysql_query($actualziar8);
    if ( !empty( $error = mysql_error() ) )
    {
        echo 'Mysql error '. $error ."<br />\n";
    }
}
if(isset($_POST['buscaremp'])){
    echo "
            <section class='container'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombres</th>
				            <th>Apellidos</th>
				            <th>Tipo de Usuario</th>
				            <th>Usuario</th>
				            <th>Contrase&ntilde;a</th>
				            <th></th>
				            <th></th>
				         </tr>
			        </thead>
			        <tbody>
        ";
    $result = selectTableWhereLike1('Empleado','estado','1','idEmpleado',"'".$_POST['filtroEmpleado']."'");
    while($fila=mysql_fetch_array($result)){
        echo "
                        <tr>
                            <td>".$fila['idEmpleado']."</td>
                            <td>".$fila['nombres']."</td>
                            <td>".$fila['apellidos']."</td>
            ";
        $result1 = selectTableWhere("TipoUsuario","idTipoUsuario","'".$fila['idTipoUsuario']."'");
        while($fila1=mysql_fetch_array($result1)){
            echo "
                            <td>".$fila1['Descripcion']."</td>
                ";
        }
        echo "          <td>".$fila['usuario']."</td>
                            <td>".$fila['contrasena']."</td>
                            <td>
                                <form method='post'>
                                     <input type='hidden' name='idempleado' value='".$fila['idEmpleado']."'>
                                     <input type='submit' class='btn-link' name='ver' value='Modificar' formaction='actualizarPersonal.php'>
                                </form>
                            </td>
                            <td>
                                <form method='post'>
                                     <input type='hidden' name='idempleado' value='".$fila['idEmpleado']."'>
                                     <input type='submit' class='btn-link' name='eliminarEmpleado' value='Eliminar' formaction='gestionOperarios.php'>
                                </form>
                            </td>
                        </tr>
            ";
    }
    echo "
                    </tbody>
		        </table>
		    </section>
            <hr>
		    <section class='container'>
		         <form class='form-horizontal col-sm-12'>
		              <div class='form-group col-sm-12'>
                            <div class='col-sm-6'>
                                <button class='btn btn-default col-sm-6 col-sm-offset-3' formaction='verActividadMuerta.php'>Ver Actividad Muerta</button>
                            </div>
                            <div class='col-sm-6'>
                                <button class='btn btn-success col-sm-6 col-sm-offset-3' formaction='agregarEmpleado.php'>Agregar</button>
                            </div>
			          </div>
		         </form>
            </section>
        		
        ";
}else{
    unset($_POST['buscaremp']);
    unset($_POST['filtroEmpleado']);
    echo "
            <div class='container'>
                 <table class='table table-hover table-condensed'>
                     <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de Usuario</th>
                                <th>Usuario</th>
                                <th>Contrase&ntilde;a</th>
                                <th></th>
                                <th></th>
				            </tr>
			        </thead>
			        <tbody>
        ";
    $result = mysql_query("SELECT * FROM empleado WHERE estado ='1' ORDER BY apellidos");
    while($fila = mysql_fetch_array($result)) {
        echo "
                             <tr>
                                <td>".$fila['idEmpleado']."</td>
                                <td>".$fila['nombres']."</td>
                                <td>".$fila['apellidos']."</td>
                                ";
        $result1 = selectTableWhere("TipoUsuario","idTipoUsuario","'".$fila['idTipoUsuario']."'");
        while($fila1=mysql_fetch_array($result1)){
            echo "
                            <td>".$fila1['Descripcion']."</td>
                ";
        }
        echo "
                                <td>".$fila['usuario']."</td>
                                <td>".$fila['contrasena']."</td>
                                <td>
                                <form method='post'>
                                     <input type='hidden' name='idempleado' value='".$fila['idEmpleado']."'>
                                     <input type='submit' class='btn-link' name='ver' value='Modificar' formaction='actualizarPersonal.php'>
                                </form>
                                </td>
                                <td>
                                    <form method='post'>
                                         <input type='hidden' name='idempleado' value='".$fila['idEmpleado']."'>
                                         <input type='submit' class='btn-link' name='eliminarEmpleado' value='Eliminar' formaction='gestionOperarios.php'>
                                    </form>
                                </td>
                            </tr>
                ";
    }
    echo "
                   </tbody>
                </table>
            </div>
            <hr>
            <section class='container'>
                 <form class='form-horizontal col-sm-12'>
		              <div class='form-group col-sm-12'>
                          <div class='col-sm-4'>
                                <button class='btn btn-primary col-sm-6 col-sm-offset-3' formaction='verActividadMuerta.php'>Ver Actividad Muerta</button>
                            </div>
                            <div class='col-sm-4'>
                                <button class='btn btn-success col-sm-6 col-sm-offset-3' formaction='agregarEmpleado.php'>Agregar</button>
                            </div>
                            <div class='col-sm-4'>
                                <button class='btn btn-success col-sm-8 col-sm-offset-3' formaction='seleccionMes.php'>Reporte de Ingresos y Salidas</button>
                            </div>
			          </div>
		         </form>
            </section>
            </center>
        ";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<footer class="panel-footer navbar-fixed-bottom">
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
</body>



</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>