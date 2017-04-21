<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
$nombre =$_SESSION['nombre'];
$result="SELECT * FROM empleado WHERE nombres ='".$nombre."'";
$result1=mysql_query($result);
while ($fila=mysql_fetch_array($result1)){
    $idempleado=$fila['idEmpleado'];
}
?>

<html lang="es">

    <head>

    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>Agregar Colaborador</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Tablas.css" rel="stylesheet">
        <link href="css/Formatos.css" rel="stylesheet">

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
                                    <li><a href="estadoproceso.php">Visualizaci&oacuten de Estado de Proceso</a></li>
                                    <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operaciones<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                                    <li><a href="nuevaHE.php">Nueva Hoja de Especificaciones</a></li>
                                    <li><a href="OPnueva.php">Nueva Orden de Producción</a></li>
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

            if(isset($_POST['ordenprod'])){
                $aux = 0;
                $result = selectTable("OrdenProduccion");
                while($fila = mysql_fetch_array($result)){
                    $aux++;
                }

                $aux++;
                $idOrdProd="OP".$aux;
                $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                while ($fila=mysql_fetch_array($result1)){
                    $fechacreacion=(string)$fila['fecha'];
                    $fechadespacho=(string)$fila['shipdate'];
                }

                $result2="INSERT INTO ordenproduccion(idOrdenProduccion, idContrato, idEmpleado, fechaCreacion, fechaDespacho) VALUES ('".$idOrdProd."','".$_POST['contrato']."','".$idempleado."','".$fechacreacion."','".$fechadespacho."')";
                $agregar=mysql_query($result2);
                if ( !empty( $error = mysql_error() ) ) {
                    echo 'Mysql error '. $error ."<br />\n";
                }
                $aux1 = 0;
                $result4="SELECT * FROM confirmacionventaproducto WHERE idContrato='".$_POST['contrato']."' ORDER BY idProducto ASC, idColor ASC, idTalla DESC";
                $result5=mysql_query($result4);
                while ($fila1=mysql_fetch_array($result5)){
                    $material=selectTableWhere('Material','idMaterial',"'".$fila1['idMaterial']."'");
                    while ($fila6=mysql_fetch_array($material)){
                        $nombremat=$fila6['material'];
                    }
                    $result6=selectTableWhere('Producto','idProducto',"'".$fila1['idProducto']."'");
                    $cantidadlote=$fila1['cantidad'];
                    settype($cantidadlote,"integer");
                    while ($fila2=mysql_fetch_array($result6)){
                        $result8=selectTableWhere('TipoProducto','idTipoProducto',"'".$fila2['idTipoProducto']."'");
                        while ($fila4=mysql_fetch_array($result8)){
                            $tamanolote=$fila4['tamanoLote'];
                            $aux2=0;
                            for ($i=0;$cantidadlote > 0;$i++) {
                                if (($cantidadlote) > $fila4['tamanoLote']) {
                                    $aux1++;
                                    $idlote = $idOrdProd . "LT" . $aux1;
                                    $cantidadlote1 = $fila4['tamanoLote'];
                                    settype($cantidadlote1,"integer");
                                    $agreglote = "INSERT INTO Lote(idLote, idOrdenProduccion, idProducto, idColor, idTalla, cantidad, material, estado, posicion) VALUES ('" . $idlote . "','" . $idOrdProd . "','" . $fila1['idProducto'] . "','" . $fila1['idColor'] . "','" . $fila1['idTalla'] . "','" . $cantidadlote1 . "','" . $nombremat . "','1','".$aux1."')";
                                    $agregarlote1 = mysql_query($agreglote);
                                } else {
                                    $aux1++;
                                    $idlote = $idOrdProd . "LT" . $aux1;
                                    $agreglote = "INSERT INTO Lote(idLote, idOrdenProduccion, idProducto, idColor, idTalla, cantidad, material, estado, posicion) VALUES ('" . $idlote . "','" . $idOrdProd . "','" . $fila1['idProducto'] . "','" . $fila1['idColor'] . "','" . $fila1['idTalla'] . "','" . $cantidadlote . "','" . $nombremat . "','1','".$aux1."')";
                                    $agregarlote1 = mysql_query($agreglote);
                                }
                                $cantidadlote = $cantidadlote - $tamanolote;
                                $aux2++;
                            }
                        }
                    }
                    $cantidadactual=$fila1['cantidad'];
                    $actualizar="UPDATE confirmacionventaproducto SET cantidadop = '".$cantidadactual."' WHERE idContrato='".$_POST['contrato']."' AND idProducto='".$fila1['idProducto']."' AND idColor='".$fila1['idColor']."' AND idTalla='".$fila1['idTalla']."'";
                    $query=mysql_query($actualizar);
                    $actualizar1="UPDATE confirmacionventaproducto SET estado = '0' WHERE idContrato='".$_POST['contrato']."' AND idProducto='".$fila1['idProducto']."' AND idColor='".$fila1['idColor']."' AND idTalla='".$fila1['idTalla']."'";
                    $query1=mysql_query($actualizar1);
                }
            }
            if(isset($_POST['ordenprodform'])){
                $aux = 0;
                $result = selectTable("OrdenProduccion");
                while($fila = mysql_fetch_array($result)){
                    $aux++;
                }

                $aux++;
                $idOrdProd="OP".$aux;
                $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                while ($fila=mysql_fetch_array($result1)){
                    $fechacreacion=(string)$fila['fecha'];
                    $fechadespacho=(string)$fila['shipdate'];
                }

                $result2="INSERT INTO ordenproduccion(idOrdenProduccion, idContrato, idEmpleado, fechaCreacion, fechaDespacho) VALUES ('".$idOrdProd."','".$_POST['contrato']."','".$idempleado."','".$fechacreacion."','".$fechadespacho."')";
                $agregar=mysql_query($result2);
                if ( !empty( $error = mysql_error() ) ) {
                    echo 'Mysql error '. $error ."<br />\n";
                }
                $aux1 = 0;
                $result1=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                while ($fila2=mysql_fetch_array($result1)){
                    if(isset($_POST[$fila2['idTalla']])&&$_POST[$fila2['idTalla']]){
                        $result4="SELECT * FROM confirmacionventaproducto WHERE idContrato='".$_POST['contrato']."' AND idProducto='".$_POST['producto']."' AND idColor='".$_POST['color']."' AND idTalla='".$fila2['idTalla']."' ORDER BY idProducto ASC, idColor ASC, idTalla DESC";
                        $result5=mysql_query($result4);
                        while ($fila1=mysql_fetch_array($result5)){
                            $cantidadrestante=$fila1['cantidad']-$fila1['cantidadop'];
                            if ($cantidadrestante<$_POST[$fila2['idTalla']]){
                                echo "<div class='container'><span class='alert alert-danger col-sm-8 col-sm-offset-2'>La cantidad ingresada es inválida.</span></div><hr>";
                            }else {
                                $material=selectTableWhere('Material','idMaterial',"'".$fila1['idMaterial']."'");
                                while ($fila6=mysql_fetch_array($material)){
                                    $nombremat=$fila6['material'];
                                }
                                $result6=selectTableWhere('Producto','idProducto',"'".$fila1['idProducto']."'");
                                $cantidadlote=$_POST[$fila2['idTalla']];
                                settype($cantidadlote,"integer");
                                while ($fila5=mysql_fetch_array($result6)){
                                    $result8=selectTableWhere('TipoProducto','idTipoProducto',"'".$fila5['idTipoProducto']."'");
                                    while ($fila4=mysql_fetch_array($result8)){
                                        $tamanolote=$fila4['tamanoLote'];
                                        $aux2=0;
                                        for ($i=0;$cantidadlote > 0;$i++) {
                                            if (($cantidadlote) > $fila4['tamanoLote']) {
                                                $aux1++;
                                                $idlote = $idOrdProd . "LT" . $aux1;
                                                $cantidadlote1 = $fila4['tamanoLote'];
                                                settype($cantidadlote1,"integer");
                                                $agreglote = "INSERT INTO Lote(idLote, idOrdenProduccion, idProducto, idColor, idTalla, cantidad, material, estado, posicion) VALUES ('" . $idlote . "','" . $idOrdProd . "','" . $fila1['idProducto'] . "','" . $fila1['idColor'] . "','" . $fila1['idTalla'] . "','" . $cantidadlote1 . "','" . $nombremat . "','1','".$aux1."')";
                                                $agregarlote1 = mysql_query($agreglote);
                                            } else {
                                                $aux1++;
                                                $idlote = $idOrdProd . "LT" . $aux1;
                                                $agreglote = "INSERT INTO Lote(idLote, idOrdenProduccion, idProducto, idColor, idTalla, cantidad, material, estado, posicion) VALUES ('" . $idlote . "','" . $idOrdProd . "','" . $fila1['idProducto'] . "','" . $fila1['idColor'] . "','" . $fila1['idTalla'] . "','" . $cantidadlote . "','" . $nombremat . "','1','".$aux1."')";
                                                $agregarlote1 = mysql_query($agreglote);
                                            }
                                            $cantidadlote = $cantidadlote - $tamanolote;
                                            $aux2++;
                                        }
                                    }
                                }
                                $cantidadactual=$fila1['cantidadop']+$_POST[$fila2['idTalla']];
                                $actualizar="UPDATE confirmacionventaproducto SET cantidadop = '".$cantidadactual."' WHERE idContrato='".$_POST['contrato']."' AND idProducto='".$_POST['producto']."' AND idColor='".$_POST['color']."' AND idTalla='".$fila2['idTalla']."'";
                                $query=mysql_query($actualizar);
                                $resta=$fila1['cantidad']-$cantidadactual;
                                if($resta==0){
                                    $actualizar1="UPDATE confirmacionventaproducto SET estado = '0' WHERE idContrato='".$_POST['contrato']."' AND idProducto='".$_POST['producto']."' AND idColor='".$_POST['color']."' AND idTalla='".$fila2['idTalla']."'";
                                    $query1=mysql_query($actualizar1);
                                }
                            }
                        }
                    }
                }
            }
        ?>

        <section class="container-fluid">
            <div class="col-sm-1">
                <div>
                    <img width="110" height="110" src="image/logowakas.jpg"/>
                </div>
            </div>
            <div class="col-sm-7" id="descripcionbrand">
                <div>
                    <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
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
                    <h3>Órden de Producción</h3>
                </div>
            </div>
        </section>
        <hr>
        <section class="container-fluid">
      	    <div class="col-sm-9">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="idprod">Nro de &Oacute;rden:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            echo "<span id='idprod'>".$idOrdProd."</span>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="contrat">Contrato:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            echo "
                                <span id='contrat'>".$_POST['contrato']."</span>
                            ";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="idclie">ID Cliente:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                            $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                            while($fila=mysql_fetch_array($result1)){
                                $result2=selectTableWhere('Contacto','idContacto',"'".$fila['idContacto']."'");
                                while ($fila1=mysql_fetch_array($result2)){
                                    $result3=selectTableWhere('Cliente','idCliente',"'".$fila1['idCliente']."'");
                                    while ($fila2=mysql_fetch_array($result3)){
                                        echo "
                                            <span id='idclie'>".$fila2['nombre']."</span>
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
                        <label for="fechacrea">Fecha de Creaci&oacute;n:</label>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                        while ($fila=mysql_fetch_array($result)){
                            echo "
                            <span id='fechacrea'>".$fila['fecha']."</span>
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
                        $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                        while ($fila=mysql_fetch_array($result)){
                            echo "
                                <span id='fechaen'>".$fila['shipdate']."</span>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <table class="table table-condensed">
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
                    $aux3=1;
                    $result1="SELECT * FROM Lote WHERE idOrdenProduccion ='".$idOrdProd."' ORDER BY idProducto ASC, posicion ASC";
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
                        }
                        $aux3++;
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="container">
            <form action="gestionCV.php" method="post" class="form-horizontal col-sm-12">
                <input class="btn btn-default col-sm-4 col-sm-offset-4" type="submit" name="finalizar" value="Finalizar">
            </form>
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