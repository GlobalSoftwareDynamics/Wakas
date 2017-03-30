<!DOCTYPE html>

<html lang="es">

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
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
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


    <?php

    if(isset($_POST['Enviar'])){
        $aux = 0;
        $result = selectTable("productocomponentesprenda");
        while($fila = mysql_fetch_array($result)){
            $aux++;
        }
        $aux++;
        $insertar = mysql_query("INSERT INTO productocomponentesprenda  VALUES
                        ('COMPESP".$aux."','".$_POST['idProd']."','".$_POST['selectcomponente']."','".$_POST['selectmaterial']."','".$_POST['selectColor']."','".$_POST['cantMat']."')");

        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }

    }
    ?>

    <section class="container">
        <div>
            <h3>Paso 3: Componentes y Materiales</h3>
        </div>
        <hr>
        <table class="table table-bordered" border="1">
            <thead>
            <tr>
                <td><b>Componente</b></td>
                <td><b>Material</b></td>
                <td><b>Color</b></td>
                <td><b>Unidad de Medida</b></td>
                <td><b>Cantidad de Material</b></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = selectTableWhere("productocomponentesprenda","idProducto","'".$_POST['idProd']."'");
            while($fila = mysql_fetch_array($result)){
                echo "<tr>";

                $result2 = selectTableWhere("ComponentesPrenda","idComponente","'".$fila['idComponente']."'");
                while($filaM = mysql_fetch_array($result2)){
                    echo "<td>".$filaM['descripcion']."</td>";
                }

                $result2 = selectTableWhere("material","idMaterial","'".$fila['idMaterial']."'");
                while($fila2 = mysql_fetch_array($result2)){
                    echo "<td>".$fila2['material']."</td>";
                }

                $result2 = selectTableWhere("Color","idColor","'".$fila['idColor']."'");
                while($filaM = mysql_fetch_array($result2)){
                    echo "<td>".$filaM['descripcion']."</td>";
                }

                $result2 = selectTableWhere("material","idMaterial","'".$fila['idMaterial']."'");
                while($fila2 = mysql_fetch_array($result2)){
                    echo "<td>".$fila2['idUnidadMedida']."</td>";
                }

                echo "<td>".$fila['cantidadMaterial']."</td>";
                echo "</tr>";

            }
            ?>
            </tbody>
        </table>
    </section>
    <hr>
    <section class="container">
        <form action="#" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectcomponente" class="formlabels col-sm-12">Componente:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("componentesprenda");
                        echo "<select name='selectcomponente' id='selectcomponente' class='ddselect-8'>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idComponente'].">".$fila['descripcion']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectmaterial" class="formlabels col-sm-12">Material</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("material");
                        echo "<select name='selectmaterial' id='selectmaterial' class='ddselect-12'>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idMaterial'].">".$fila['material']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="cantMat" class="formlabels col-sm-12">Cantidad</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="cantMat" id="cantMat" class="textinput-4">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectColor" class="formlabels col-sm-12">Color:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = selectTable("Color");
                        echo "<select name='selectColor' id='selectColor' class='ddselect-8'>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idColor'].">".$fila['descripcion']."</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
            </div>
            <hr>
            <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']?>">
            <div class="form-group">
                <div class="col-sm-12">
                    <input class="btn btn-default col-sm-offset-3 col-sm-6" type="submit" name="Enviar" value="Agregar">
                </div>
            </div>
        </form>
    </section>
    <hr>
    <section class="container">
        <form action="nuevaHE4.php" method="post">
            <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']?>">
            <div class="form-group">
                <div class="col-sm-12">
                    <input class="btn btn-default col-sm-6 col-sm-offset-3" type="submit" name="Siguiente" value="Siguiente">
                </div>
            </div>
        </form>
    </section>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

    <?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>

</html>