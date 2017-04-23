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
                        <?php
                        $result11=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                        while ($fila11=mysql_fetch_array($result11)){
                            echo "
                                    <th>".$fila11['descripcion']."</th>
                                ";
                        }
                        ?>
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
                $result12="SELECT * FROM confirmacionventaproducto WHERE idContrato ='".$_POST['contrato']."' ORDER BY idProducto ASC, idColor ASC";
                $resultxvr=mysql_query($result12);
                while ($fila12=mysql_fetch_array($resultxvr)){
                    if(($ProdActual==$fila12['idProducto'])&&($ColorActual==$fila12['idColor'])) {
                        echo "</tr>";
                    }else{
                        echo "<tr>";
                        echo "
                                                <td>".$fila12['idProducto']."</td>
                                                <td>".$fila12['yourcode']."</td>
                                        ";
                        $result2=selectTableWhere('Material','idMaterial',"'".$fila12['idMaterial']."'");
                        while ($fila2=mysql_fetch_array($result2)){
                            echo "
                                                <td>".$fila2['material']."</td>
                                            ";
                        }
                        echo "
                                            <td>".$fila12['idColor']."</td>
                                        ";
                        $tallas1=array();
                        $tallas2=array();
                        $indice1=0;
                        $indice2=0;
                        $result=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                        while ($fila=mysql_fetch_array($result)) {
                            $tallas1[$indice1] = $fila['idTalla'];
                            $indice1++;
                        }
                        $talla ="SELECT * FROM confirmacionventaproducto WHERE idProducto = '".$fila12['idProducto']."' AND idContrato='".$_POST['contrato']."' AND idColor='".$fila12['idColor']."' AND idMaterial='".$fila12['idMaterial']."'";
                        $result2=mysql_query($talla);
                        while ($fila1=mysql_fetch_array($result2)){
                            $tallas2[$indice2]=$fila1['idTalla'];
                            $indice2++;
                        }
                        foreach ($tallas1 as $value1) {
                            $encontrado=false;
                            foreach ($tallas2 as $value2) {
                                if ($value1 == $value2){
                                    $encontrado=true;
                                    $cant="SELECT * FROM confirmacionventaproducto WHERE idProducto='".$fila12['idProducto']."' AND idContrato='".$_POST['contrato']."' AND idColor='".$fila12['idColor']."' AND idTalla='".$value1."'";
                                    $cant1=mysql_query($cant);
                                    while ($filacant=mysql_fetch_array($cant1)){
                                        echo "<td>".$filacant['cantidad']."</td>";
                                    }
                                }
                            }
                            if ($encontrado == false){
                                echo "<td></td>";
                            }
                        }
                        $ProdActual=$fila12['idProducto'];
                        $ColorActual=$fila12['idColor'];
                        $numproductos=array();
                        $indice=0;
                        $result3 = selectTableWhere4('ConfirmacionVentaProducto','idContrato',"'".$_POST['contrato']."'",'idProducto',"'".$fila12['idProducto']."'",'idColor',"'".$fila12['idColor']."'",'idMaterial',"'".$fila12['idMaterial']."'");
                        while ($fila3 = mysql_fetch_array($result3)) {
                            $numproductos[$indice] = $fila3['cantidad'];
                            $indice++;
                        }
                        $suma=array_sum($numproductos);
                        $result2=selectTableWhere2('Precio','idContrato',"'".$_POST['contrato']."'",'idProducto',"'".$fila12['idProducto']."'");
                        while($fila2=mysql_fetch_array($result2)) {
                            echo "
                                                            <td>" . $suma . "</td>
                                                            <td>" . $fila2['precio'] . "</td>
                                                        ";
                            $totalusd = $suma * $fila2['precio'];
                            echo "
                                                            <td>$ " . $totalusd . "</td>
                                                        ";
                            $sumafinal = $sumafinal + $totalusd;
                            $sumafinalprod = $sumafinalprod + $suma;
                        }
                    }
                }
                    echo "
                            <tr>
                                <td>Total<td>
                                <td></td>
                                <td></td>";
                        $result11=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
                        while ($fila11=mysql_fetch_array($result11)){
                            echo "
                                    <td></td>
                                ";
                        }
                    echo "
                                <td>".$sumafinalprod."</td>
                                <td></td>
                                <td>$ ".$sumafinal."</td>
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
                <input type="hidden" name="idcodificacionTalla" value="<?php echo $_POST['idcodificacionTalla'];?>" readonly>
                <div class="col-sm-6">
                    <input type="submit" formaction="gestionCV.php" value="Regresar" class="btn btn-default col-sm-6 col-sm-offset-3">
                </div>
                <div class="col-sm-6">
                    <input type="submit" name="pdf" value="Descargar PDF" class="btn btn-primary col-sm-6 col-sm-offset-3">
                </div>
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