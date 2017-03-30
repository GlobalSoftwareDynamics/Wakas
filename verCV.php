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
        <title>Ver Confirmacion de Venta</title>
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

        <section class="container-fluid">
            <div class="col-sm-1">
                <div>
                    <img width="110" height="110" src="image/logowakas.jpg"/>
                </div>
            </div>
            <div class="col-sm-5" id="descripcionbrand">
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
            <div class="col-sm-5">
                <div class="titulo">
                    <h3>Confirmation of Sale</h3>
                </div>
            </div>
        </section>
        <hr>
        <section class="container-fluid">
            <div class="col-sm-7">
                <div>
                    <label>For:</label>
                </div>
                <?php
                $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                while ($fila1=mysql_fetch_array($result1)){
                    $result2=selectTableWhere('Contacto','idContacto',"'".$fila1['idContacto']."'");
                    while ($fila2=mysql_fetch_array($result2)){
                        echo "
                                    <div>
                                        <span>".$fila2['nombre']." ".$fila2['apellido']."</span>
                                    </div>
                                ";
                        $result3=selectTableWhere('Direccion','idDireccion',"'".$fila2['idDireccion']."'");
                        while ($fila4=mysql_fetch_array($result3)){
                            echo "
                                        <div>
                                            <span>".$fila4['direccion']."</span>
                                        </div>
                                        
                                    ";
                            $result4=selectTableWhere('Ciudad','idCiudad',"'".$fila4['idCiudad']."'");
                            while ($fila5=mysql_fetch_array($result4)){
                                echo "
                                    <div>
                                         <span>".$fila5['nombre']."</span>
                                    </div>
                                ";
                                $result5=selectTableWhere('Pais','idPais',"'".$fila5['idPais']."'");
                                while ($fila6=mysql_fetch_array($result5)){
                                    echo "
                                         <div>
                                            <span>".$fila6['pais']."</span>
                                         </div>
                                    ";
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
            <div class="col-sm-5">
                <?php
                $result7=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                while ($fila7=mysql_fetch_array($result7)){
                    echo "
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='ourship'>Our Shipment:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='ourship'>".$fila7['idContrato']."</span>
                                </div>
                            </div>
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='date'>Date:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='date'>".$fila7['fecha']."</span>
                                </div>
                            </div>
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='yourref'>Your Reference:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='yourref'>".$fila7['reference']."</span>
                                </div>
                            </div>
                    ";
                    $result8=selectTableWhere('Incoterms','idIncoterm',"'".$fila7['idIncoterm']."'");
                    while ($fila8=mysql_fetch_array($result8)){
                        echo "
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='inco'>Incoterm:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='inco'>".$fila8['descripcion']."</span>
                                </div>
                            </div>
                        ";
                    }
                    $result9=selectTableWhere('MetodoPago','idMetodoPago',"'".$fila7['idMetodoPago']."'");
                    while ($fila9=mysql_fetch_array($result9)){
                        echo "
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='pay'>Payment:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='pay'>".$fila9['descripcion']."</span>
                                </div>
                            </div>
                        ";
                    }
                    $result10=selectTableWhere('Via','idVia',"'".$fila7['idVia']."'");
                    while ($fila10=mysql_fetch_array($result10)){
                        echo "
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='via'>Via:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='via'>".$fila10['descripcion']."</span>
                                </div>
                            </div>
                        ";
                    }
                    echo "
                            <div class='col-sm-12'>
                                <div class='col-sm-4'>
                                    <label for='ship'>Shipment:</label>
                                </div>
                                <div class='col-sm-8'>
                                    <span id='ship'>".$fila7['shipdate']."</span>
                                </div>
                            </div>
                    ";
                }
                ?>
            </div>
        </section>

        <section class="container-fluid" id="sectiontext">
            <div class="col-sm-12">
                <span>With reference to our fax/e-mail exchange we are pleased to confirm our sale to you as follows:</span>
            </div>
        </section>

        <section class=container>
            <table class="table table-condensed">
                <thead id="theadborder">
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
                            $aux2 = 0;
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
                    echo "
                            <tr>
                                <td>Total<td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>".$sumafinalprod."</td>
                                <td></td>
                                <td>".$sumafinal."</td>
                            </tr>
                    ";
                    ?>
                </tbody>
            </table>
        </section>

        <section class="container-fluid">
            <div class="col-sm-12">
                <p>In the event of prevention of shipment in whole or in part by reason of prohibition of export, local strike, political disturbance, riot, war,
                    civil conmotion or any other cause whatsoever amounting to force majeure, the seller may extent the period until the operation of the cause preventing
                    shipment has ceased or consider the contract void to the extent to which shipment has not been affected, such right to consider the contract void
                    being valid throughout the period of prevention. The certificate of the Arequipa Chamber of Comerce shall be final and binding.</p>
                <p>Any dispute or diference araising out of this contract shall be settled by arbitration. The competent body to conduct the arbitration shall be
                    the Arequipa...</p>
                <p>Thank you for this new order we remain,</p>
            </div>
            <div class="col-sm-12">
                <p>Countersigned</p>
            </div>
        </section>
        <hr>
        <section class="container">
            <form action="vercvpdf.php" method="post" class="form-horizontal col-sm-12">
                <input type="hidden" name="contrato" value="<?php echo $_POST['contrato'];?>" readonly>
                <input type="submit" name="pdf" value="Descargar PDF" class="btn btn-default col-sm-4 col-sm-offset-4">
            </form>
        </section>
        <br>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>