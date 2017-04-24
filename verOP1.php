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
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
        <title>Ver Orden de Producción</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Tablas.css" rel="stylesheet">
        <link href="css/Formatos.css" rel="stylesheet">

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

        <section class="container-fluid">
            <div class="col-sm-2">
                <div>
                    <img style="margin-top:25px" width="auto" height="70" src="image/LogoWakas.png"/>
                </div>
            </div>
            <div class="col-sm-6" id="descripcionbrand">
                <div>
                    <br><b><span style="margin-top: 20px">Waka-s Textiles Finos SAC</span></b>
                </div>
                <div>
                    <span>Urb. Francisco Mostajo G-25</span>
                </div>
                <div>
                    <span>04002 Arequipa - Peru</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="titulo">
                    <h3>Orden de Producción</h3>
                </div>
            </div>
        </section>
        <hr>

        <section class="container-fluid">
            <div class="col-sm-9">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="idop">Nro de Orden:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            $result=selectTableWhere('OrdenProduccion','idOrdenProduccion',
                                "'".$_POST['ordenprod']."'");
                            while ($fila3=mysql_fetch_array($result)){
                                echo "<span id='idop'>".$_POST['ordenprod']."</span>";
                                $idContract=$fila3['idContrato'];
                            }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="contrato">Contrato:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            echo "
                                <span id='contrato'>".$idContract."</span>
                            ";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="cliente">Cliente:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                            while($fila=mysql_fetch_array($result1)){
                                $result2=selectTableWhere('Contacto','idContacto',"'".$fila['idContacto']."'");
                                while ($fila1=mysql_fetch_array($result2)){
                                    $result3=selectTableWhere('Cliente','idCliente',"'".$fila1['idCliente']."'");
                                    while ($fila2=mysql_fetch_array($result3)){
                                        echo "
                                        <span id='cliente'>".$fila2['nombre']."</span>
                                   ";
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-12">
                    <div class="col-sm-8">
                        <label for="fechacre">Fecha de Creaci&oacute;n:</label>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                            while ($fila=mysql_fetch_array($result)){
                                echo "
                                    <span id='fechacre'>".$fila['fecha']."</span>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-8">
                        <label for="creador">Creado por:</label>
                    </div>
                    <div class="col-sm-4">
                        <span id="creador">EFG</span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-8">
                        <label for="fechaen">Fecha de Env&iacute;o:</label>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                            while ($fila=mysql_fetch_array($result)){
                                echo "
                                    <span id='fecahen'>".$fila['shipdate']."</span>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <table class="table table-codensed">
                <thead id="theadborder">
                    <tr>
                        <th>Lote</th>
                        <th>idLote</th>
                        <th>idProducto</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idLotes = array();
                    $idProductos = array();
                    $materiales = array();
                    $idColores = array();
                    $descripciones = array();
                    $cantidades = array();
                    $aux3=1;
                    $result1="SELECT * FROM Lote WHERE idOrdenProduccion ='".$_POST['ordenprod']."' ORDER BY idProducto ASC, posicion ASC";
                    $result=mysql_query($result1);
                    $result=mysql_query($result1);
                    while ($fila=mysql_fetch_array($result)){
                        $result9=selectTableWhere('Talla','idTalla',"'".$fila['idTalla']."'");
                        while ($fila7=mysql_fetch_array($result9)){
                            echo "
                                <tr>
                                    <td>".$aux3."</td>
                                    <td>".$fila['idLote']."</td>
                                    <td>".$fila['idProducto']."</td>
                                    <td>".$fila['material']."</td>
                                    <td>".$fila['idColor']."</td>
                                    <td>".$fila7['descripcion']."</td>
                                    <td>".$fila['cantidad']."</td>
                                </tr>
                            ";
                            $idLotes[($aux3-1)]=$fila['idLote'];
                            $idProductos[($aux3-1)]=$fila['idProducto'];
                            $materiales[($aux3-1)]=$fila['material'];
                            $idColores[($aux3-1)]=$fila['idColor'];
                            $descripciones[($aux3-1)]=$fila7['descripcion'];
                            $cantidades[($aux3-1)]=$fila['cantidad'];
                        $aux3++;
                        }
                    }
                    if(isset($_POST['datos'])){
                        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                        for($i=0;$i<count($idLotes);$i++){
                            $txt=$idLotes[$i].",".$idProductos[$i].",".$materiales[$i].",".$idColores[$i].",".$descripciones[$i].",".$cantidades[$i]."\r\n";
                            fwrite($myfile, $txt);
                        }
                        fclose($myfile);
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section class="container">
            <div>
                <h5>Observación:</h5>
            </div>
            <div class="observacionop">
                <?php
                $observacion=selectTableWhere('OrdenProduccion','idOrdenProduccion',"'".$_POST['ordenprod']."'");
                while ($fila5=mysql_fetch_array($observacion)){
                    echo "
                            <p>".$fila5['Observacion']."</p>
                        ";
                }
                ?>
            </div>
        </section>

        <hr>

        <?php

        ?>

        <section class="container">
            <form action="veroppdf.php" method="post" class="form-horizontal col-sm-12">
                <input type="hidden" name="idop" value="<?php echo $_POST['ordenprod']; ?>" readonly>
                <input type="hidden" name="idContract" value="<?php echo $_POST['idContract']; ?>" readonly>
                <input type="hidden" name="ordenprod" value="<?php echo $_POST['ordenprod']; ?>" readonly>
                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="submit" name="pdf" value="Descargar PDF" class="btn btn-primary col-sm-10 col-sm-offset-1">
                    </div>
                    <div class="col-sm-4">
                        <input type="submit" formaction="prueba.php" value="Crear Tarjetas" class="btn btn-primary col-sm-10 col-sm-offset-1">
                    </div>
                    <div class="col-sm-4">
                        <input type="submit" formaction="nuevaOPobs.php" name="nuevaobs" value="Agregar Observaciones" class="btn btn-success col-sm-10 col-sm-offset-1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" formaction="gestionOP.php" value="Regresar" class="btn btn-default col-sm-8 col-sm-offset-2">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" formaction="#" name="datos" value="Descargar Datos" class="btn btn-primary col-sm-8 col-sm-offset-2">
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

</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>