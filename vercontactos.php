<!doctype html>
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
        <title>Gesti&oacute;n de Contactos</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Tablas.css" rel="stylesheet">

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
                    <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                                <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
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

            if(isset($_POST['actualizarcon'])){
                $actualziar="UPDATE Contacto SET nombre = '".$_POST['nombre']."' WHERE idContacto = '".$_POST['idCon']."'";
                $actualziar1=mysql_query($actualziar);
            }

            if(isset($_POST['guardar'])){
                $agregardir="INSERT INTO direccion(idDireccion, idCiudad, direccion) VALUES ('".$_POST['idDir']."','".$_POST['ciudad']."','".$_POST['direccion']."')";
                $agregardir1=mysql_query($agregardir);
                $agregarcont="INSERT INTO contacto(idContacto, idCliente, idDireccion, nombre, apellido) VALUES ('".$_POST['idCon']."','".$_POST['cliente']."','".$_POST['idDir']."','".$_POST['nombre']."','".$_POST['apellido']."')";
                $agregarcont1=mysql_query($agregarcont);
                $agregartelcon="INSERT INTO telefono(numTelefono) VALUES ('".$_POST['tel']."')";
                $agregartelcon1=mysql_query($agregartelcon);
                $agregartelcon2="INSERT INTO contactotelefono(idContacto, numTelefono) VALUES ('".$_POST['idCon']."','".$_POST['tel']."')";
                $agregartelcon3=mysql_query($agregartelcon2);
            
                echo "
                    <div class='container'>";

                $result0=selectTableWhere("Cliente", "idCliente", "'".$_POST['cliente']."'");
                while($fila0=mysql_fetch_array($result0)){
                    echo "
                            <h4>Contactos para ".$fila0['nombre']."</h4>
                            ";
                }
                echo "
                    </div>
                    <hr>
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Direccion</th>
                                    <th>Ciudad</th>
                                    <th>Pa&iacute;s</th>
                                    <th>Tel&eacute;fono</th>
                                    </tr>
                            </thead>
                            <tbody> 
                            ";
                $result = selectTableWhere("Contacto","idCliente","'".$_POST['cliente']."'");
                while($fila = mysql_fetch_array($result)) {
                    echo "
                                 <tr>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['apellido']."</td>
                ";
                    $result2=selectTableWhere("Direccion","idDireccion","'".$fila['idDireccion']."'");
                    while($fila2=mysql_fetch_array($result2)) {
                        echo "
                                    <td>".$fila2['direccion']."</td>
                ";
                        $result3=selectTableWhere("Ciudad","idCiudad","'".$fila2['idCiudad']."'");
                        while($fila3=mysql_fetch_array($result3)){
                            echo "
                                <td>".$fila3['nombre']."</td>
                            ";
                            $result4=selectTableWhere("Pais","idPais","'".$fila3['idPais']."'");
                            while($fila4=mysql_fetch_array($result4)){
                                echo "
                                    <td>".$fila4['pais']."</td>
                                 
                    ";
                            }
                        }
                    }
                    $result7=selectTableWhere('ContactoTelefono','idContacto',"'".$fila['idContacto']."'");
                    while ($fila7=mysql_fetch_array($result7)){
                        echo "
                            <td>".$fila7['numTelefono']."</td>
                        ";
                    }
                    echo "
                                </tr>
                    ";
                }
                echo "
                         </tbody>
                       </table>
                    </div>
                    <hr>
                    <div class='container'>
                        <form action='agregarContacto.php' method='post' class='form-horizontal col-sm-12'>
                            <input type='hidden' name='idCli' value='".$_POST['cliente']."'>
                            <div class='col-sm-6'>
                                <input class='btn btn-default col-sm-6 col-sm-offset-3'type='submit' name='agregarcontacto' value='Agregar Contacto'>
                            </div>
                            <div class='col-sm-6'>
                                <button class='btn btn-default col-sm-6 col-sm-offset-3' formaction='gestionClientes.php'>Regresar</button>
                            </div>
                        </form>
                    </div>
                ";
            }else{
                echo "
                    <div class='container'>";
                $result0=selectTableWhere("Cliente", "idCliente", "'".$_GET['idCliente']."'");
                while($fila0=mysql_fetch_array($result0)){
                    echo "
                            <h4>Contactos para ".$fila0['nombre']."</h4>
                            ";
                }
                echo "
                    </div>
                    <hr>
                    <div class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Direccion</th>
                                    <th>Ciudad</th>
                                    <th>Pa&iacute;s</th>
                                    <th>Tel&eacute;fono</th>
                                    </tr>
                            </thead>
                            <tbody> 
                            ";
                $result = selectTableWhere("Contacto","idCliente","'".$_GET['idCliente']."'");
                while($fila = mysql_fetch_array($result)) {
                    echo "
                                 <tr>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['apellido']."</td>
                ";
                    $result2=selectTableWhere("Direccion","idDireccion","'".$fila['idDireccion']."'");
                    while($fila2=mysql_fetch_array($result2)) {
                        echo "
                                    <td>".$fila2['direccion']."</td>
                                    
                ";
                        $result3=selectTableWhere("Ciudad","idCiudad","'".$fila2['idCiudad']."'");
                        while($fila3=mysql_fetch_array($result3)){
                            echo "
                                <td>".$fila3['nombre']."</td>
                            ";
                            $result4=selectTableWhere("Pais","idPais","'".$fila3['idPais']."'");
                            while($fila4=mysql_fetch_array($result4)){
                                echo "
                                    <td>".$fila4['pais']."</td>
                    ";
                            }
                        }
                    }
                    $result7=selectTableWhere('ContactoTelefono','idContacto',"'".$fila['idContacto']."'");
                    while ($fila7=mysql_fetch_array($result7)){
                        echo "
                            <td>".$fila7['numTelefono']."</td>
                        ";
                    }
                    echo "
                                </tr>
                    ";
                }
                echo "
                         </tbody>
                       </table>
                    </div>
                    <hr>    
                    <div class='container'>
                        <form action='agregarContacto.php' method='post' class='form-horizontal col-sm-12'>
                            <input type='hidden' name='idCli' value='".$_GET['idCliente']."'>
                            <div class='col-sm-6'>
                                <input class='btn btn-default col-sm-6 col-sm-offset-3'type='submit' name='agregarcontacto' value='Agregar Contacto'>
                            </div>
                            <div class='col-sm-6'>
                                <button class='btn btn-default col-sm-6 col-sm-offset-3' formaction='gestionClientes.php'>Regresar</button>
                            </div>
                        </form>
                    </div>
                ";
            }
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>

    </body>

</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
