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
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">

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

    if(isset($_POST['Enviar'])){
        $aux = 0;
        $result = selectTable("productocomponentesprenda");
        while($fila = mysql_fetch_array($result)){
            $aux++;
        }
        $aux++;
        $insertar = mysql_query("INSERT INTO productocomponentesprenda  VALUES
                        ('COMPESP".$aux."','".$_POST['idProd']."','".$_POST['selectcomponente']."','".$_POST['selectmaterial']."','".$_POST['selectColor']."','".$_POST['cantMat']."','1','1')");

        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }

    }

    if(isset($_POST['addParte'])){
        $aux = 0;
        $result = selectTable("productocomponentesprenda");
        while($fila = mysql_fetch_array($result)){
            $aux++;
        }
        $aux++;
        $insertar = mysql_query("INSERT INTO productocomponentesprenda VALUES ('COMPESP".$aux."','".$_POST['idProd']."','".$_POST['selectParte']."',null,null,null  ,'2','1')");
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }

    if(isset($_POST['borrar'])){
        $eliminar = mysql_query("UPDATE ProductoComponentesPrenda SET estado = '0' WHERE idProducto = '".$_POST['idProd']."' AND idComponenteEspecifico = '".$_POST['componenteEliminar']."'");
    }
    ?>

    <section class="container">
        <div>
            <h3>Paso 3: Componentes y Partes de la Prenda</h3>
        </div>
        <hr>

        <table class="table table-bordered" border="1">
            <thead>
            <tr>
                <th>Componente</b></th>
                <th>Material</b></th>
                <th>Color</b></th>
                <th>Unidad de Medida</b></th>
                <th>Cantidad de Material</b></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = selectTableWhere("productocomponentesprenda","idProducto","'".$_POST['idProd']."'");
            while($fila = mysql_fetch_array($result)){
                if($fila['tipoComponente'] === '1' && $fila['estado'] === '1'){
                    echo "<tr>";

                    $result2 = selectTableWhere("ComponentesPrenda","idComponente","'".$fila['idComponente']."'");
                    while($filaM = mysql_fetch_array($result2)){
                        echo "<td>".$filaM['descripcion']."</td>";
                    }

                    $result2 = selectTableWhere("material","idMaterial","'".$fila['idMaterial']."'");
                    while($fila2 = mysql_fetch_array($result2)){
                        echo "<td>".$fila2['material']."</td>";
                    }

                    echo "<td>".$fila['idColor']."</td>";

                    $result2 = selectTableWhere("material","idMaterial","'".$fila['idMaterial']."'");
                    while($fila2 = mysql_fetch_array($result2)){
                        echo "<td>".$fila2['idUnidadMedida']."</td>";
                    }

                    echo "<td>".$fila['cantidadMaterial']."</td>";
                    echo " <form action=\"#\" method=\"post\">";
                    echo "<td><input type='submit' value='Eliminar' name='borrar' class='btn-link'></td>";
                    echo "<input type='hidden' name='componenteEliminar' value='".$fila['idComponenteEspecifico']."'>";
                    echo '<input type="hidden" name="idProd" value="'.$_POST['idProd'].'">
                          <input type="hidden" name="selectcodificaciontalla" value="'.$_POST['selectcodificaciontalla'].'">';
                    echo "</form>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>

    </section>


    <section class="container col-sm-4 col-sm-offset-4">

        <table class="table table-bordered" border="1">
            <thead>
            <tr>
                <th colspan="2">Partes</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = selectTableWhere("productocomponentesprenda","idProducto","'".$_POST['idProd']."'");
            while($fila = mysql_fetch_array($result)){
                if($fila['tipoComponente'] === '2' && $fila['estado'] === '1'){
                    echo "<tr>";
                    $result2 = selectTableWhere("ComponentesPrenda","idComponente","'".$fila['idComponente']."'");
                    while($filaM = mysql_fetch_array($result2)){
                        echo "<td>".$filaM['descripcion']."</td>";
                    }
                    echo "<form method=\"post\" action=\"#\">";
                    echo "<td><input type='submit' value='Eliminar' name='borrar' class='btn-link'></td>";
                    echo "<input type='hidden' name='componenteEliminar' value='".$fila['idComponenteEspecifico']."'>";
                    echo '<input type="hidden" name="idProd" value="'.$_POST['idProd'].'">
                          <input type="hidden" name="selectcodificaciontalla" value="'.$_POST['selectcodificaciontalla'].'">';
                    echo "</form>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </section>

    <hr>

    <section class="container col-sm-6">
        <form action="#" method="post" class="form-horizontal jumbotron col-sm-10 col-sm-offset-1">
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectcomponente" class="formlabels col-sm-12">Componente:</label>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $result = mysql_query("SELECT * FROM ComponentesPrenda WHERE tipo = '1'");
                        echo "<select name='selectcomponente' id='selectcomponente' class='ddselect-12'>";
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
                        <label for="selectmaterial" class="formlabels col-sm-12">Material:</label>
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
                        <label for="cantMat" class="formlabels col-sm-12">Cantidad:</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="cantMat" id="cantMat" class="textinput-8">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <label for="selectColor" class="formlabels col-sm-12">Color:</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="selectColor" class="textinput-8 form-control">
                    </div>
                </div>
            </div>
            <hr>
            <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']?>">
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
                    <input class="btn btn-success col-sm-offset-3 col-sm-6" type="submit" name="Enviar" value="Agregar">
                </div>
            </div>
        </form>
    </section>

    <hr>

    <section class="container col-sm-6">
        <form action="#" method="post" class="form-horizontal jumbotron col-sm-10 col-sm-offset-1">
            <div class="form-group">
                <div class="col-sm-5">
                    <label for="selectParte" class="formlabels col-sm-12">Parte:</label>
                </div>
                <div class="col-sm-7">
                    <select name="selectParte" class="ddselect-12 form-control">
                        <?php
                        $result = mysql_query("SELECT * FROM ComponentesPrenda WHERE Tipo = '2'");
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value='".$fila['idComponente']."'>".$fila['descripcion']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']?>">
                <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
                <input class="btn btn-success col-sm-offset-3 col-sm-6" type="submit" name="addParte" value="Agregar">
            </div>
        </form>
    </section>

    <hr>

    <section class="container">
        <form action="nuevaHE4.php" method="post">
            <input type="hidden" name="idProd" value="<?php echo $_POST['idProd']?>">
            <input type="hidden" name="selectcodificaciontalla" value="<?php echo $_POST['selectcodificaciontalla']?>">
            <div class="form-group">
                <div class="col-sm-12">
                    <input class="btn btn-default col-sm-3 col-sm-offset-2" type="submit" name="Regresar" value="Regresar" formaction="nuevaHE2.php">
                    <input class="btn btn-primary col-sm-3 col-sm-offset-2" type="submit" name="Siguiente" value="Siguiente">
                </div>
            </div>
        </form>
    </section>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <footer class="panel-footer navbar-fixed-bottom">
        <div class="container col-sm-6 col-sm-offset-3 text-center">
            <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
        </div>
    </footer>
    </body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>
