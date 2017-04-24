<!DOCTYPE html>

<html lang="es">

<?php
session_start();
require('funciones.php');
conexion();

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
    <title>Hoja de Especificaci&oacuten</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
    <link href="css/Formatos.css" rel="stylesheet">
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-sm-3">
            <nav class="navbar navbar-default navbar-fixed-side">
                <!-- normal collapsible navbar markup -->
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Secciones disponibles</a>
                </div>
                <div class="collapse navbar-collapse">
                    <form method="post">
                        <input type="hidden" value="<?php echo $_POST['idProd']?>" name="idProd">
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE2.php" value="Sección Medidas">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE3.php" value="Sección Tejido">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE4.php" value="Sección Lavado y Secado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE5.php" value="Sección Confección">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE6.php" value="Sección Etiquetado y Embolsado">
                        </div>
                        <div class="col-sm-12 sideselect">
                            <input type="submit" class="btn-link" formaction="versionHE7.php" value="Sección Tiempos y Secuencia">
                        </div>
                    </form>
                </div>
            </nav>
        </div>

        <div class="col-sm-9 col-sm-9">
            <!-- your page content -->

            <?php
            $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=0");
            $pointer = 0;
            $pointer2 = 1;
            if(isset($_POST['Siguiente'])){
                $query = mysql_query("SELECT * FROM Producto WHERE idProducto LIKE '".$_POST['idProd']."%'");
                while($search = mysql_fetch_array($query)){
                    $pointer++;
                }

                $add = mysql_query("INSERT INTO Producto (idProducto,idTipoProducto,idCliente,creador,idgenero,idcodificacionTalla,idProvisional,fechaCreacion,observaciones,descripcionGeneral) 
                                    VALUES ('".$_POST['idProd']."','".$_POST['tipoProducto']."','".$_POST['idcliente']."','".$_POST['selectempleado']."','".$_POST['genero']."','".$_POST['idcodificacionTalla']."','".$_POST['idProv']."','".$_POST['date']."','".$_POST['observGen']."','".$_POST['descrGen']."')");
                if ( !empty( $error = mysql_error() ) )
                {
                    echo 'Mysql error '. $error ."<br />\n";
                    echo "Query: ".$add."<br>";
                }

                $query = mysql_query("SELECT * FROM tallamedida WHERE idProducto = '".$_POST['idProdOrig']."'");
                while($search = mysql_fetch_array($query)){
                    $add = mysql_query("INSERT INTO tallamedida VALUES ('".$_POST['idProd']."','".$search['idTalla']."','".$search['idMedida']."','".$search['valor']."')");
                    if ( !empty( $error = mysql_error() ) )
                    {
                        echo 'Mysql error '. $error ."<br />\n";
                    }
                }

                $query = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProdOrig']."'");
                while($search = mysql_fetch_array($query)){
                    $add = mysql_query("INSERT INTO ProductoMedida VALUES ('".$_POST['idProd']."','".$search['idMedida']."','".$search['tolerancia']."','".$search['observacion']."')");
                    if ( !empty( $error = mysql_error() ) )
                    {
                        echo 'Mysql error '. $error ."<br />\n";
                    }
                }


                $query = mysql_query("SELECT * FROM ProductoComponentesPrenda");
                while($search = mysql_fetch_array($query)){
                    $pointer2++;
                }
                mysql_data_seek($query, 0);
                $query = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProdOrig']."' AND estado = '1'");
                while($search = mysql_fetch_array($query)){
                    $add = mysql_query("INSERT INTO ProductoComponentesPrenda (idComponenteEspecifico,idProducto,idComponente,idMaterial,idColor,cantidadMaterial,tipoComponente,estado) 
                                    VALUES ('COMPESP".$pointer2."','".$_POST['idProd']."','".$search['idComponente']."','".$search['idMaterial']."','".$search['idColor']."','".$search['cantidadMaterial']."','".$search['tipoComponente']."','".$search['estado']."')");
                    if ( !empty( $error = mysql_error() ) )
                    {
                        echo 'Mysql error '. $error ."<br />\n";
                    }


                    $pointer3 = 1;

                    $query2 = mysql_query("SELECT * FROM PCPSPC");
                    while($search2 = mysql_fetch_array($query2)){
                        $pointer3++;
                    }
                    mysql_data_seek($query2, 0);
                    $query2 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$search['idComponenteEspecifico']."'");
                    while($search2 = mysql_fetch_array($query2)){
                        $add = mysql_query("INSERT INTO PCPSPC 
                                    VALUES ('".$pointer3."','COMPESP".$pointer2."','".$search2['idSubProcesoCaracteristica']."','".$search2['valor']."','".($search2['fila']+1)."')");
                        $pointer3++;
                        if ( !empty( $error = mysql_error() ) )
                        {
                            echo 'Mysql error '. $error ."<br />\n";
                        }
                    }
                    $pointer2++;
                }

            }
            $sqlquery = mysql_query("SET FOREIGN_KEY_CHECKS=1");
            ?>

            <section class="container col-sm-12">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="thobservacion">Medidas</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php
                            $result = mysql_query("SELECT * FROM Producto WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila = mysql_fetch_array($result)){
                                $result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$fila['idcodificacionTalla']."' ORDER BY LENGTH (idTalla) ASC");
                                while ($fila = mysql_fetch_array($result)){
                                    echo "<th>".$fila['descripcion']."</th>";
                                }
                            }
                            ?>
                            <th>Unidad</th>
                            <th>T(+/-)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = mysql_query("SELECT DISTINCT idMedida FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."'  ORDER BY LENGTH (idTalla) ASC");
                        while($fila = mysql_fetch_array($result)){
                            echo "<tr>";
                            $result2 = mysql_query("SELECT * FROM Medida WHERE idMedida = '".$fila['idMedida']."'");
                            while($fila2 = mysql_fetch_array($result2)){
                                echo "<th>".$fila2['descripcion']."</th>";
                                echo "<th>".$fila2['idMedida']."</th>";
                                $unidadMedida = $fila2['idUnidadMedida'];
                            }
                            $result3 = mysql_query("SELECT * FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$fila['idMedida']."' ORDER BY LENGTH (idTalla) ASC");
                            while ($fila3 = mysql_fetch_array($result3)){
                                echo "<td>".$fila3['valor']."</td>";
                            }
                            echo "<td>".$unidadMedida."</td>";
                            $result4 = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$fila['idMedida']."'");
                            while ($fila4 = mysql_fetch_array($result4)){
                                echo "<td>".$fila4['tolerancia']."</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="container col-sm-12">
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="thobservacion">Observaciones - Medidas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result2 = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."'");
                        while($fila2 = mysql_fetch_array($result2)){
                            if($fila2['observacion']===''||$fila2['observacion']=== null){
                            }else {
                                echo "<tr>";
                                echo "<td class='tdobservacion'>" . $fila2['observacion'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="container">
                <div>
                    <div class="form-group">
                        <form method="post" action="#">
                            <input type="hidden" name='idProd' value="<?php echo $_POST['idProd']?>">
                            <?php
                            $query = mysql_query("SELECT * FROM Producto WHERE idProducto = '".$_POST['idProd']."'");
                            while($row = mysql_fetch_array($query)){
                                $selectcodificaciontalla = $row['idcodificacionTalla'];
                            }
                            echo "<input type='hidden' name='selectcodificaciontalla' value='".$selectcodificaciontalla."'>";
                            ?>
                            <input type="submit" name="add" value="Modificar Valores" class="btn btn-success col-sm-3 col-sm-offset-3" formaction="versionHE2add.php">
                        </form>
                    </div>
                </div>
            </section>
            <hr>
            <section class="container col-sm-6 col-sm-offset-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="thobservacion">Fotografía de Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $estado = true;
                        $file = null;
                        $filenamejpg = 'Fotografias/'.$_POST['idProd'].'-prod.jpg';
                        $filenamejpeg = 'Fotografias/'.$_POST['idProd'].'-prod.jpeg';
                        $filenamegif = 'Fotografias/'.$_POST['idProd'].'-prod.gif';
                        $filenamepng = 'Fotografias/'.$_POST['idProd'].'-prod.png';
                        if(file_exists($filenamejpg)){
                            $file=$filenamejpg;
                        } elseif(file_exists($filenamejpeg)){
                            $file=$filenamejpeg;
                        } elseif(file_exists($filenamegif)){
                            $file=$filenamegif;
                        } elseif(file_exists($filenamepng)){
                            $file=$filenamepng;
                        } else{
                            echo "<td>No existe foto para el producto</td>";
                            $estado = false;
                        }
                        if($estado == true){
                          echo "<td><img src='".$file."' alt='Fotografia de Producto' height='300' width='auto'></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                                    echo "<form action='uploadfotoproducto2.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='idProd' value='".$_POST['idProd']."'>
                                <div>
                                    <td style='text-align: center'><input type='file' name='fileToUpload' id='fileToUpload'>
                                </div>
                                <div>
                                    <input type='submit' value='Subir Imagen' name='submit' class='btn btn-primary'>
                                </div>
                          </td>
                          </form>";
                        ?>
                    </tr>
                    </tbody>
                </table>
            </section>


            <hr>




        </div>
    </div>
</div>

<hr>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<footer class="panel-footer navbar-fixed-bottom">
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
</body>
</html>