<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<html lang="es">
    <head>

    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirmación de Venta</title>
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

        <section class="container">
            <div>
                <img width="116" height="116" src="image/logowakas.jpg">
            </div>
            <div>
                <div>
                    <label>Waka-s <span>Textiles Finos SAC</span></label>
                </div>
                <div>
                    <label>Urb. Francisco Mostajo G-25</label>
                </div>
                <div>
                    <label>04002 Arequipa - Peru</label>
                </div>
                <div>
                    <h2>Confirmation of Sale</h2>
                </div>
            </div>
        </section>
        
        <section class="container">
            <div>
                <label>For:</label>
            </div>
            <div>
                <?php
                $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                while ($fila1=mysql_fetch_array($result1)){
                    $result2=selectTableWhere('Contacto','idContacto',"'".$fila1['idContacto']."'");
                    while ($fila2=mysql_fetch_array($result2)){
                        echo "
                            <div>
                                <label>".$fila2['nombre']." ".$fila2['apellido']."</label>
                            </div>
                        ";
                        $result3=selectTableWhere('Direccion','idDireccion',"'".$fila2['idDireccion']."'");
                        while ($fila4=mysql_fetch_array($result3)){
                            echo "
                                <div>
                                    <label>".$fila4['direccion']."</label>
                                </div>
                            ";
                            $result4=selectTableWhere('Ciudad','idCiudad',"'".$fila4['idCiudad']."'");
                            while ($fila5=mysql_fetch_array($result4)){
                                echo "
                                    <div>
                                        <label>".$fila5['nombre']."</label>
                                    </div>
                                ";
                                $result5=selectTableWhere('Pais','idPais',"'".$fila5['idPais']."'");
                                while ($fila6=mysql_fetch_array($result5)){
                                    echo "
                                        <div>
                                            <label>".$fila6['pais']."</label>
                                        </div>
                                    ";
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
        </section>

        <section class="container">
            <?php
                $result7=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                while ($fila7=mysql_fetch_array($result7)){
                    echo "
                        <div>
                            <div>
                                <label for='ourship'>Our Shipment:</label>
                            </div>
                            <div>
                                <span id='ourship'>".$fila7['idContrato']."</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='date'>Date:</label>
                            </div>
                            <div>
                                <span id='date'>".$fila7['fecha']."</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='yourref'>Your Reference:</label>
                            </div>
                            <div>
                                <span id='yourref'>".$fila7['reference']."</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='inco'>Incoterm:</label>
                            </div>
                            <div>
                                <span id='inco'>".$fila7['idIncoterm']."</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='pay'>Payment:</label>
                            </div>
                            <div>
                                <span id='pay'>".$fila7['idMetodoPago']."</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='via'>Via:</label>
                            </div>
                            <div>
                                <span id='via'>".$fila7['idVia']."</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for='ship'>Shipment:</label>
                            </div>
                            <div>
                                <span id='ship'>".$fila7['shipdate']."</span>
                            </div>
                        </div>
                    ";
                }
            ?>
        </section>

        <section>
            <label>With reference to our fax/e-mail exchange we are pleased to confirm our sale to you as follows:</label>
        </section>

        <section>

        <section class=container>
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>Our Code</th>
                        <th>Your Code</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th>XXS</th>
                        <th>XS</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>XXL</th>
                        <th>TU</th>
                        <th>Total</th>
                        <th>Price (USD)</th>
                        <th>Total (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ProdActual="ninguno";
                        $ColorActual="ninguno";
                        $inicio=0;
                        $sumafinal=0;
                        $sumafinalprod=0;
                        $result="SELECT * FROM confirmacionventaproducto WHERE idContrato ='".$_POST['contrato']."' ORDER BY idProducto ASC, idColor ASC";
                        $resultxvr=mysql_query($result);
                        while ($fila=mysql_fetch_array($resultxvr)){
                            if(($ProdActual==$fila['idProducto'])&&($ColorActual==$fila['idColor'])) {
                                echo "</tr>";
                            }else{
                                echo "<tr>";
                                echo "
                                               <td>".$fila['idProducto']."</td>
                                               <td>".$fila['yourcode']."</td>
                                ";
                                $result2=selectTableWhere('Material','idMaterial',"'".$fila['idMaterial']."'");
                                while ($fila2=mysql_fetch_array($result2)){
                                    echo "
                                               <td>".$fila2['material']."</td>
                                    ";
                                }
                                echo "
                                            <td>".$fila['idColor']."</td>
                                ";
                                $indice = 0;
                                $tallas = array();
                                $valores = array();
                                $result3 = selectTableWhere4('ConfirmacionVentaProducto','idContrato',"'".$_POST['contrato']."'",'idProducto',"'".$fila['idProducto']."'",'idColor',"'".$fila['idColor']."'",'idMaterial',"'".$fila['idMaterial']."'");
                                while ($fila3 = mysql_fetch_array($result3)) {
                                    $tallas[$indice] = $fila3['idTalla'];
                                    $valores[$indice] = $fila3['cantidad'];
                                    $indice++;
                                }
                                $aux = 0;
                                $aux2=0;
                                while ($aux < 9) {
                                    $bandera=false;
                                    switch ($aux) {
                                        case 0:
                                            $aux2 = "XXS";
                                            break;
                                        case 1:
                                            $aux2 = "XS";
                                            break;
                                        case 2:
                                            $aux2 = "S";
                                            break;
                                        case 3:
                                            $aux2 = "M";
                                            break;
                                        case 4:
                                            $aux2 = "L";
                                            break;
                                        case 5:
                                            $aux2 = "XL";
                                            break;
                                        case 6:
                                            $aux2 = "XXL";
                                            break;
                                        case 7:
                                            $aux2 = "TU";
                                            break;
                                        case 8:
                                            $aux2 = "Total";
                                            break;
                                    }
                                    for ($i = 0; $i < count($tallas); $i++) {
                                        if ($tallas[$i] == $aux2) {
                                            echo "<td>" . $valores[$i] . "</td>";
                                            $bandera = true;
                                        }
                                    }
                                    if($aux2=='Total'){
                                        $suma=array_sum($valores);
                                        $result2=selectTableWhere2('Precio','idContrato',"'".$_POST['contrato']."'",'idProducto',"'".$fila['idProducto']."'");
                                        while($fila2=mysql_fetch_array($result2)){
                                            echo "
                                                           <td>".$suma ."</td>
                                                           <td>".$fila2['precio'] ."</td>
                                            ";
                                            $totalusd=$suma*$fila2['precio'];
                                            echo "
                                                           <td>".$totalusd."</td>
                                            ";
                                            $sumafinal=$sumafinal+$totalusd;
                                            $sumafinalprod=$sumafinalprod+$suma;
                                        }
                                        $bandera=true;
                                    }
                                    if($bandera==false){
                                        echo "
                                                   <td></td>   
                                        ";
                                    }
                                    $aux++;
                                }
                                $ProdActual=$fila['idProducto'];
                                $ColorActual=$fila['idColor'];
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <div>
                <div>
                    <label for="totunid">Total Unidades:</label>
                </div>
                <div>
                    <span id="totunid">
                        <?php
                            echo "
                                $sumafinalprod
                            ";
                        ?>
                    </span>
                </div>
            </div>
            <div>
                <div>
                    <label for="totusd">Total USD:</label>
                </div>
                <div>
                    <span id="totusd">
                        <?php
                            echo "
                                $sumafinal
                            ";
                        ?>
                    </span>
                </div>
            </div>
        </section>

        <section>
            <div>
                <p>In the event of prevention of shipment in whole or in part by reason of prohibition of export, local strike, political disturbance, riot, war
                    civil conmotion or any other cause whatsoever amounting to force majeure, the seller may extent the period until the operation of the cause preventing
                    shipment has ceased or consider the contract void to the extent to which shipment has not been affected, such right to consider the contract void
                    being valid throughout the period of prevention. The certificate of the Arequipa Chamber of Comerce shall be final and binding.</p>
            </div>
            <div>
                <p>Any dispute or diference araising out of this contract shall be settled by arbitration. The competent body to conduct the arbitration shall be
                    the Arequipa</p>
            </div>
            <div>
                <p>Thank you for this new order we remain,</p>
            </div>
            <div>
                <p>Countersigned</p>
            </div>
        </section>

        <section>
            <form action="gestionCV.php">
                <input class="btn btn-default" type="submit" name="finalizar" value="Finalizar">
            </form>
        </section>

        <section>
            <form action="nuevaOP.php" METHOD="post">
                <input type="hidden" name="contrato" value="<?php echo "".$_POST['contrato']."";?>">
                <input class="btn btn-default" type="submit" name="ordenprod" value="Crear Orden de Producción">
            </form>
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
