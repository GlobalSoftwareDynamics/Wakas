<!DOCTYPE html>
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
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
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
    if(isset($_POST['guardar'])){
        $agregar="INSERT INTO componentesprenda(idComponente, descripcion,tipo) VALUES ('".$_POST['idcomponente']."','".$_POST['descripcion']."','".$_POST['selecttipo']."')";
        $agregar1=mysql_query($agregar);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }else{
            echo "<br>
            <div class='container'>
                <div class='alert alert-success' role='alert'>
                    <p><strong>Componente/Prenda Agregado Exitosamente</strong></p>
                </div>
            </div>
            ";
        }
    }
    if(isset($_GET['eliminarComponente'])){
        $eliminar="DELETE FROM componentesprenda WHERE idComponente ='".$_GET['eliminarComponente']."'";
        $eliminar1=mysql_query($eliminar);
    }
    ?>

    <section class="container col-sm-6 col-sm-offset-3">
        <form action="otroscomponente.php" method="post" class="form-horizontal jumbotron col-sm-10 col-sm-offset-1">
            <div>
                <h3>Nuevo Componente/Parte</h3>
            </div>
            <hr>
            <?php
            $aux = 0;
            $result = selectTable("ComponentesPrenda");
            while($fila = mysql_fetch_array($result)){
                $aux++;
            }
            $aux++;
            echo "<input type='hidden' name= 'idcomponente' value='COMPONENTE".$aux."' readonly>";
            ?>
            <div class="form-group col-sm-12">
                <div class="col-sm-3">
                    <label for="idcomp" class="formlabels col-sm-12">Descripcion:</label>
                </div>
                <div class="col-sm-8">
                    <input id="idcomp" type="text" name="descripcion" class="textinput-12">
                </div>
            </div>
            <div class="form-group col-sm-12">
                <div class="col-sm-3">
                    <label for="selecttipo" class="formlabels col-sm-12">Tipo:</label>
                </div>
                <div class="col-sm-8">
                    <select id="selecttipo" name="selecttipo" class="form-control ddselect-6">
                        <option value="1">Componente</option>
                        <option value="2">Parte</option>
                    </select>
                </div>
            </div>
            <hr>
            <br><br><br><br><br><br>
            <div class="form-group">
                <div class="col-sm-6">
                    <input formaction="menuagregarotros.php" class="btn btn-default col-sm-10 col-sm-offset-1" type="submit" value="Regresar">
                </div>
                <div class="col-sm-6">
                    <input class="btn btn-success col-sm-10 col-sm-offset-1" type="submit" name="guardar" value="Agregar">
                </div>
            </div>
        </form>
    </section>

    <hr>

    <section class="container jumbotron col-sm-6 col-sm-offset-3">
        <div class="container col-sm-10 col-sm-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result1= mysql_query("SELECT * FROM ComponentesPrenda ORDER BY Tipo, Descripcion");
                while ($fila1=mysql_fetch_array($result1)){
                    echo "
                            <tr>
                                <td>".$fila1['descripcion']."</td>";
                                if($fila1['tipo']=='1'){
                                    echo "<td>Componente</td>";
                                }else{
                                    echo "<td>Parte</td>";
                                }
                    echo "      <td><a href='otroscomponente.php?eliminarComponente=".$fila1['idComponente']."'>Eliminar</a></td>
                            </tr>
                        ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>