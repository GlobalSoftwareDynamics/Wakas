<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
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
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
                }else{
                    echo "<br/><b><i></i></b><br/>";
                }

                $result4="SELECT * FROM confirmacionventaproducto WHERE idContrato='".$_POST['contrato']."' ORDER BY idProducto ASC, idColor ASC, idTalla DESC";
                $result5=mysql_query($result4);
                while ($fila1=mysql_fetch_array($result5)){
                    $material=selectTableWhere('Material','idMaterial',"'".$fila1['idMaterial']."'");
                    while ($fila6=mysql_fetch_array($material)){
                        $nombremat=$fila6['material'];
                    }
                    $result6=selectTableWhere('Producto','idProducto',"'".$fila1['idProducto']."'");
                    $cantidadlote=$fila1['cantidad'];
                    while ($fila2=mysql_fetch_array($result6)){
                        $result8=selectTableWhere('TipoProducto','idTipoProducto',"'".$fila2['idTipoProducto']."'");
                        while ($fila4=mysql_fetch_array($result8)){
                            $tamanolote=$fila4['tamanoLote'];
                            $aux2=0;
                            for ($i=0;$cantidadlote > 0;$i++) {
                                if (($cantidadlote) > $fila4['tamanoLote']) {
                                    $aux1 = 0;
                                    $result7 = selectTable("Lote");
                                    while ($fila3 = mysql_fetch_array($result7)) {
                                        $aux1++;
                                    }
                                    $aux1++;
                                    $idlote = $idOrdProd . "LT" . $aux1;
                                    $cantidadlote1 = $fila4['tamanoLote'];
                                    $agreglote = "INSERT INTO Lote(idLote, idOrdenProduccion, idProducto, idColor, idTalla, cantidad, material) VALUES ('" . $idlote . "','" . $idOrdProd . "','" . $fila1['idProducto'] . "','" . $fila1['idColor'] . "','" . $fila1['idTalla'] . "','" . $cantidadlote1 . "','" . $nombremat . "')";
                                    $agregarlote1 = mysql_query($agreglote);
                                } else {
                                    $aux1 = 0;
                                    $result7 = selectTable("Lote");
                                    while ($fila3 = mysql_fetch_array($result7)) {
                                        $aux1++;

                                    }
                                    $aux1++;
                                    $idlote = $idOrdProd . "LT" . $aux1;
                                    $agreglote = "INSERT INTO Lote(idLote, idOrdenProduccion, idProducto, idColor, idTalla, cantidad, material) VALUES ('" . $idlote . "','" . $idOrdProd . "','" . $fila1['idProducto'] . "','" . $fila1['idColor'] . "','" . $fila1['idTalla'] . "','" . $cantidadlote . "','" . $nombremat . "')";
                                    $agregarlote1 = mysql_query($agreglote);
                                }
                                $cantidadlote = $cantidadlote - $tamanolote;
                                $aux2++;
                            }
                        }
                    }
                }
            }
        ?>

        <section>
            <div>
                <img WIDTH="110" HEIGHT="110" src="image/logowakas.jpg" border=10/>
            </div>
            <div>
                <label>Waka-s <span>Textiles Finos SAC</span></label>
            </div>
            <div>
                <label>Urb. Francisco Mostajo G-25</label>
            </div>
            <div>
                <label>04002 Arequipa - Peru</label>
            </div>
        </section>

        <section>
      		<h2>&Oacute;rden de Producci&oacute;n</h2>
      	</section>

        <section>
      	    <div>
                <div>
                    <label for="idprod">Nro de &Oacute;rden:</label>
                </div>
                <div>
                    <?php
                        echo "<span id='idprod'>".$idOrdProd."</span>";
                    ?>
                </div>
            </div>
            <div>
                <div>
                    <label for="contrat">Contrato:</label>
                </div>
                <div>
                    <?php
                        echo "
                            <span id='contrat'>".$_POST['contrato']."</span>
                        ";
                    ?>
                </div>
            </div>
            <div>
                <div>
                    <label for="idclie">ID Cliente:</label>
                </div>
                <div>
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
        </section>

        <section>
            <div>
                <div>
                    <label for="fechacrea">Fecha de Creaci&oacute;n:</label>
                </div>
                <div>
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
            <div>
                <div>
                    <label for="creador">Creado por:</label>
                </div>
                <div>
                    <span id="creador">EFG</span>
                </div>
            </div>
            <div>
                <div>
                    <label for="fechaen">Fecha de Env&iacute;o:</label>
                </div>
                <div>
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
        </section>

        <section>
            <table class="table table-bordered" border="1">
                <thead>
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
                    $result1="SELECT * FROM Lote WHERE idOrdenProduccion ='".$idOrdProd."' ORDER BY idProducto ASC";
                    $result=mysql_query($result1);
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                <tr>
                                    <td>".$aux3."</td>
                                    <td>".$fila['idLote']."</td>
                                    <td>".$fila['idProducto']."</td>
                                    <td>".$fila['material']."</td>
                                    <td>".$fila['idColor']."</td>
                                    <td>".$fila['idTalla']."</td>
                                    <td>".$fila['cantidad']."</td>
                                </tr>
                            ";
                        $aux3++;
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <form action="gestionCV.php" method="post">
                <input class="btn btn-primary" type="submit" name="finalizar" value="Finalizar">
            </form>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>

    </body>
    <footer>

    </footer>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>