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
    <title>Gestion Procedimientos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <script>
        function getGalga(val) {
            $.ajax({
                type: "POST",
                url: "get_galga2.php",
                data:'idMaquina='+val,
                success: function(data){
                    $("#galga").html(data);
                }
            });
        }
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

<?php
if(isset($_POST['Asignar'])){
    if(isset($_POST['galga'])){
        $insertar = mysql_query("INSERT INTO MaquinaSubProceso (idMaquina,idGalgas,idProcedimiento) VALUES ('".$_POST['selectmaquina']."','".$_POST['galga']."','".$_POST['idProcedimiento']."')",$con);
        if(!$insertar){
            echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
        }else{
            echo '<div class="alert alert-success" role="alert">
                <strong>Asignación exitosa</strong>
            </div>';
        }
    }else{
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
    <div>
        <table class="table">
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

<section class="container">
        <div>
        <form method="post" action="#">
            <label for="selectmaquina">Seleccionar Máquina</label>
            <select name="selectmaquina" id="selectmaquina" onchange="getGalga(this.value)">
                <option>Seleccionar</option>
                <?php
                $result = mysql_query("SELECT DISTINCT * FROM Maquina");
                while($fila = mysql_fetch_array($result)){
                    echo "<option value='".$fila['idMaquina']."'>".$fila['descripcion']."</option>";
                }
                ?>
            </select>

            <div id="galga">
            </div>
            <input type="hidden" name="idProceso" value="<?php echo $_POST['idProceso']?>">
            <input type="hidden" name="idProcedimiento" value="<?php echo $_POST['idProcedimiento']?>">
            <input type="submit" value="Volver" class="btn btn-default" formaction="gestionSubprocesos.php">
            <input type="submit" value="Asignar" class="btn btn-success" name="Asignar">
        </form>
    </div>
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
