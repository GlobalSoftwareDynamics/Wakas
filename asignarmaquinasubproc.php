<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
$con=mysql_connect("localhost","root","");
if($con){
    $bd=mysql_select_db("wakas",$con);
    if(!$bd) echo "No existe la bd";
}else{
    echo "No existe la conexi&oacute;n";
}

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
    <title>Gestion Procedimientos</title>
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
if(isset($_POST['Asignar'])){
    if(!empty($_POST['galga']) and $_POST['galga']!="Seleccionar"){
        $insertar = mysql_query("INSERT INTO MaquinaSubProceso (idMaquina,idGalgas,idProcedimiento) VALUES ('".$_POST['selectmaquina']."','".$_POST['galga']."','".$_POST['idProcedimiento']."')",$con);
        if(!$insertar){
            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
        }else{
            echo '<div class="alert alert-success" role="alert">
                <strong>Asignación exitosa</strong>
            </div>';
        }
    }else{
        echo $_POST['galga'];
        $insertar = mysql_query("INSERT INTO MaquinaSubProceso (idMaquina,idGalgas,idProcedimiento) VALUES ('".$_POST['selectmaquina']."',null,'".$_POST['idProcedimiento']."')",$con);
        if(!$insertar){
            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
        }else{
            echo '<div class="alert alert-success" role="alert">
                <strong>Asignación exitosa</strong>
            </div>';
        }
    }
}
?>

<section class="container">
    <?php
    $result = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$_POST['idProcedimiento']."'");
    while($fila = mysql_fetch_array($result)){
        echo "<h3>Asignar Máquina a Subproceso de ".$fila['descripcion']."</h3>";
    }
    ?>
    <hr>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Maquina</th>
                    <th>Galga</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = mysql_query("SELECT * FROM MaquinaSubProceso WHERE idProcedimiento = '".$_POST['idProcedimiento']."'");
            while($fila = mysql_fetch_array($result)){
                echo "<tr>";
                    $result2 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila['idMaquina']."'");
                    while($fila2 = mysql_fetch_array($result2)){
                        echo "<td>".$fila2['descripcion']."</td>";
                    }
                    $result2 = mysql_query("SELECT * FROM Galgas WHERE idGalgas = '".$fila['idGalgas']."'");
                    while($fila2 = mysql_fetch_array($result2)){
                        echo "<td>".$fila2['Descripcion']."</td>";
                    }
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
<hr>
<section class="container">
        <form method="post" action="#" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectmaquina" class="formlabels col-sm-12">Máquina:</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="selectmaquina" id="selectmaquina" onchange="getGalga(this.value)" class="ddselect-12">
                            <option>Seleccionar</option>
                            <?php
                            $result = mysql_query("SELECT DISTINCT * FROM Maquina");
                            while($fila = mysql_fetch_array($result)){
                                echo "<option value='".$fila['idMaquina']."'>".$fila['descripcion']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for='selectgalga' class='formlabels col-sm-12'>Seleccionar Galga:</label>
                    </div>
                    <div class="col-sm-7">
                        <select name='galga' id='selectgalga' class='ddselect-10'>
                            <option>Seleccionar</option>
                            <?php
                            $result3=selectTableWhere('Galgas','estado','1');
                            while ($fila3=mysql_fetch_array($result3)){
                                echo "<option value=".$fila3["idGalgas"].">".$fila3["Descripcion"]."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="idProceso" value="<?php echo $_POST['idProceso']?>">
                <input type="hidden" name="idProcedimiento" value="<?php echo $_POST['idProcedimiento']?>">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input type="submit" value="Regresar" class="btn btn-default col-sm-8 col-sm-offset-2" formaction="gestionSubprocesos.php">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" value="Asignar" class="btn btn-success col-sm-8 col-sm-offset-2" name="Asignar">
                    </div>
                </div>
            </div>
        </form>
</section>

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
