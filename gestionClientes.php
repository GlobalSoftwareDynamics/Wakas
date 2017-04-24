<!DOCTYPE HTML>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html lang="es">
    <head>

    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
        <title>Gesti&oacute;n de Clientes</title>
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

        <?php
            if(isset($_POST['guardar'])){
                $agregardir="INSERT INTO direccion(idDireccion, idCiudad, direccion) VALUES ('".$_POST['idDir']."','".$_POST['ciudad']."','".$_POST['direccion']."')";
                $agregardir1=mysql_query($agregardir);
                $agregarcont="INSERT INTO contacto(idContacto, idCliente, idDireccion, nombre, apellido) VALUES ('".$_POST['idCon']."','".$_POST['cliente']."','".$_POST['idDir']."','".$_POST['nombre']."','".$_POST['apellido']."')";
                $agregarcont1=mysql_query($agregarcont);
                $agregartelcon="INSERT INTO telefono(numTelefono) VALUES ('".$_POST['tel']."')";
                $agregartelcon1=mysql_query($agregartelcon);
                $agregartelcon2="INSERT INTO contactotelefono(idContacto, numTelefono) VALUES ('".$_POST['idCon']."','".$_POST['tel']."')";
                $agregartelcon3=mysql_query($agregartelcon2);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }

            if(isset($_GET['eliminarCliente'])) {
                $eliminar = "DELETE FROM cliente WHERE idCliente = '".$_GET['eliminarCliente']."'";
                $resutlt1 = mysql_query($eliminar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }

            if(isset($_GET['eliminarContacto'])) {
                $aux=0;
                $contar=selectTableWhere("Contacto","idContacto","'".$_GET['eliminarContacto']."'");
                while ($contar1=mysql_fetch_array($contar)){
                    $contar2=selectTableWhere("Cliente","idCliente","'".$contar1['idCliente']."'");
                    while ($contar3=mysql_fetch_array($contar2)){
                        $contar4=selectTableWhere("Contacto","idCliente","'".$contar3['idCliente']."'");
                        while ($contar5=mysql_fetch_array($contar4)){
                            $aux++;
                        }
                    }
                }
                if($aux>1){
                    $result5=selectTableWhere("contactotelefono","idContacto","'".$_GET['eliminarContacto']."'");
                    while($fila5=mysql_fetch_array($result5)){
                        $numero=$fila5['numTelefono'];
                        $eliminar2 = "DELETE FROM contactotelefono WHERE idContacto = '".$_GET['eliminarContacto']."'";
                        $resutlt2 = mysql_query($eliminar2);
                        $eliminar3 = "DELETE FROM telefono WHERE numTelefono = '$numero'";
                        $resutlt3 = mysql_query($eliminar3);
                    }
                    $result6=selectTableWhere("contacto","idContacto","'".$_GET['eliminarContacto']."'");
                    while ($fila6=mysql_fetch_array($result6)){
                        $iddireccion=$fila6['idDireccion'];
                        $eliminar4 = "DELETE FROM direccion WHERE idDireccion = '$iddireccion'";
                        $resutlt4 = mysql_query($eliminar4);
                    }
                    $eliminar = "DELETE FROM Contacto WHERE idContacto = '".$_GET['eliminarContacto']."'";
                    $resutlt1 = mysql_query($eliminar);
                }else{
                    echo "
                        <span>El &uacute;ltimo contacto no se puede eliminar.</span>
                    ";
                }
            }

            if(isset($_POST['actualizarcli'])){
                $actualziar="UPDATE cliente SET nombre = '".$_POST['nombrecli']."' WHERE idCliente = '".$_POST['idCli']."'";
                $actualziar1=mysql_query($actualziar);
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                }
            }
        ?>

        <section class="container">
            <form action="gestionClientes.php" method="post" class="form-horizontal jumbotron col-sm-12">
                <div class="form-group col-sm-6">
                    <div class="col-sm-5">
                        <label for="buscar" class="formlabels col-sm-12">Buscar Cliente:</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" id="buscar" name="filtroCliente" class="textinput-12">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="col-sm-6">
                        <input class="btn btn-success col-sm-10 col-sm-offset-2 boton" type="submit" name="buscarclien" value="Buscar">
                    </div>
                    <div class="col-sm-6">
                        <input formaction="gestionClientes.php" class="btn btn-default col-sm-10 col-sm-offset-2 boton" type="submit" value="Eliminar Filtro">
                    </div>
                </div>
            </form>
        </section>
        <hr>
        <?php
            if(isset($_POST['buscarclien'])){
                echo "
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idCliente</th>
                                    <th>Nombre</th>
                                    <th>Contactos</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
            $result = selectTableWhereLikeSingle('Cliente','nombre',"'".$_POST['filtroCliente']."'");
            while($fila=mysql_fetch_array($result)){
                echo "
                                <tr>
                                    <td>".$fila['idCliente']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td><a href='vercontactos.php?idCliente=".$fila['idCliente']."'>Ver</a></td>
                                    <td><a href='actualizarCliente.php?idCliente=".$fila['idCliente']."'>Modificar</a></td>
                                </tr>
                    ";
            }
            echo "
                            </tbody>
                        </table>
                    </div> 
                    <hr>
                    <div class='container'>
                        <form class='form-horizontal col-sm-12'>
                            <div>
                                <button class='btn btn-default col-sm-4 col-sm-offset-4' formaction='agregarCliente.php'>Agregar Cliente</button>
                            </div>
                        </form>
                    </div>
                ";
            }else{
            unset($_POST['buscarclien']);
            unset($_POST['filtroCliente']);
            echo "
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idCliente</th>
                                    <th>Nombre</th>
                                    <th>Contactos</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
            $result = selectTable("Cliente");
            while($fila = mysql_fetch_array($result)) {
                echo "
                                 <tr>
                                    <td>".$fila['idCliente']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td><a href='vercontactos.php?idCliente=".$fila['idCliente']."'>Ver</a></td>
                                    <td><a href='actualizarCliente.php?idCliente=".$fila['idCliente']."'>Modificar</a></td>
                                </tr>
                    ";
            }
                echo "
                         </tbody>
                       </table>
                    </div>
                    <hr>
                    <div class='container'>
                        <form class='form-horizontal col-sm-12'>
                            <div>
                                <button class='btn btn-success col-sm-4 col-sm-offset-4' formaction='agregarCliente.php'>Agregar Cliente</button>
                            </div>
                        </form>
                    </div>
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

