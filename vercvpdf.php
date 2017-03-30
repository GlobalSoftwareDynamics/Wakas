<?php
session_start();
require('funciones.php');
require_once __DIR__ . '/lib/mpdf/mpdf.php';

conexion();

if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
?>

<?php

    $html='
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">    
                <title>Ver Confirmacion de Venta</title>
                <link href="css/Formatospdf.css" rel="stylesheet">
            </head>
            <body class="landscape">
                <section>
                    <div class="descladoizquierdoCV">
                        <div>
                            <span class="label">For:</span>
                        </div>
    ';
                        $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                        while ($fila1=mysql_fetch_array($result1)){
                            $result2=selectTableWhere('Contacto','idContacto',"'".$fila1['idContacto']."'");
                            while ($fila2=mysql_fetch_array($result2)){
                                $html .='
                                            <div>
                                                <span>'.$fila2['nombre'].' '.$fila2['apellido'].'</span>
                                            </div>
                                        ';
                                $result3=selectTableWhere('Direccion','idDireccion',"'".$fila2['idDireccion']."'");
                                while ($fila4=mysql_fetch_array($result3)){
                                    $html .='
                                                <div>
                                                    <span>'.$fila4['direccion'].'</span>
                                                </div>
                                                
                                            ';
                                    $result4=selectTableWhere('Ciudad','idCiudad',"'".$fila4['idCiudad']."'");
                                    while ($fila5=mysql_fetch_array($result4)){
                                        $html .='
                                            <div>
                                                 <span>'.$fila5['nombre'].'</span>
                                            </div>
                                        ';
                                        $result5=selectTableWhere('Pais','idPais',"'".$fila5['idPais']."'");
                                        while ($fila6=mysql_fetch_array($result5)){
                                            $html .='
                                                 <div>
                                                    <span>'.$fila6['pais'].'</span>
                                                 </div>
                                            ';
                                        }
                                    }
                                }
                            }
                        }
    $html .='
                    </div>
                    <div class="descladoderechoCV">
    ';
                        $result7=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                        while ($fila7=mysql_fetch_array($result7)){
                            $html .='
                                    <div>
                                        <div>
                                            <span class="label">Our Shipment:</span>
                                            <span>'.$fila7['idContrato'].'</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <span class="label">Date:</span>
                                            <span>'.$fila7['fecha'].'</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <span class="label">Your Reference:</span>
                                            <span>'.$fila7['reference'].'</span>
                                        </div>
                                    </div>
                            ';
                            $result8=selectTableWhere('Incoterms','idIncoterm',"'".$fila7['idIncoterm']."'");
                            while ($fila8=mysql_fetch_array($result8)){
                                $html .='
                                    <div>
                                        <div>
                                            <span class="label">Incoterm:</span>
                                            <span>'.$fila8['descripcion'].'</span>
                                        </div>
                                    </div>
                                ';
                            }
                            $result9=selectTableWhere('MetodoPago','idMetodoPago',"'".$fila7['idMetodoPago']."'");
                            while ($fila9=mysql_fetch_array($result9)){
                                $html .='
                                    <div>
                                        <div>
                                            <span class="label">Payment:</span>
                                            <span>'.$fila9['descripcion'].'</span>
                                        </div>
                                    </div>
                                ';
                            }
                            $result10=selectTableWhere('Via','idVia',"'".$fila7['idVia']."'");
                            while ($fila10=mysql_fetch_array($result10)){
                                $html .='
                                    <div>
                                        <div>
                                            <span class="label">Via:</span>
                                            <span>'.$fila10['descripcion'].'</span>
                                        </div>
                                    </div>
                                ';
                            }
                            $html .='
                                    <div>
                                        <div>
                                            <span class="label">Shipment:</span>
                                            <span>'.$fila7['shipdate'].'</span>
                                        </div>
                                    </div>
                            ';
                        }
    $html .='
                    </div>
                </section>
                <section class="parrafotabla">
                    <span>With reference to our fax/e-mail exchange we are pleased to confirm our sale to you as follows:</span>
                </section>
        
                <section>
                    <table class="tabla">
                        <thead id="theadborder">
                            <tr>
                                <th style="width: 7%">Our Code</th>
                                <th style="width: 7%">Your Code</th>
                                <th style="width: 15%">Material</th>
                                <th style="width: 7%">Color</th>
                                <th style="width: 5%">XXS</th>
                                <th style="width: 5%">XS</th>
                                <th style="width: 5%">S</th>
                                <th style="width: 5%">M</th>
                                <th style="width: 5%">L</th>
                                <th style="width: 5%">XL</th>
                                <th style="width: 5%">XXL</th>
                                <th style="width: 5%">TU</th>
                                <th style="width: 8%">Total</th>
                                <th style="width: 8%">Price (USD)</th>
                                <th style="width: 8%">Total (USD)</th>
                            </tr>
                        </thead>
                        <tbody>
    ';
                            $ProdActual="ninguno";
                            $ColorActual="ninguno";
                            $inicio=0;
                            $sumafinal=0;
                            $sumafinalprod=0;
                            $result="SELECT * FROM confirmacionventaproducto WHERE idContrato ='".$_POST['contrato']."' ORDER BY idProducto ASC, idColor ASC";
                            $resultxvr=mysql_query($result);
                            while ($fila=mysql_fetch_array($resultxvr)){
                                if(($ProdActual==$fila['idProducto'])&&($ColorActual==$fila['idColor'])) {
                                    $html .='</tr>';
                                }else{
                                    $html .='<tr>';
                                    $html .='
                                                <td>'.$fila['idProducto'].'</td>
                                                <td>'.$fila['yourcode'].'</td>
                                    ';
                                    $result2=selectTableWhere('Material','idMaterial',"'".$fila['idMaterial']."'");
                                    while ($fila2=mysql_fetch_array($result2)){
                                        $html .='
                                                        <td>'.$fila2['material'].'</td>
                                                    ';
                                    }
                                    $html .='
                                                    <td>'.$fila['idColor'].'</td>
                                                ';
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
                                                $html .='<td>' . $valores[$i] . '</td>';
                                                $bandera = true;
                                            }
                                        }
                                        if($aux2=='Total'){
                                            $suma=array_sum($valores);
                                            $result2=selectTableWhere2('Precio','idContrato',"'".$_POST['contrato']."'",'idProducto',"'".$fila['idProducto']."'");
                                            while($fila2=mysql_fetch_array($result2)){
                                                $html .='
                                                                    <td>'.$suma .'</td>
                                                                    <td>$ '.$fila2['precio'].'</td>
                                                                ';
                                                $totalusd=$suma*$fila2['precio'];
                                                $html .='
                                                                    <td>$ '.$totalusd.'</td>
                                                                ';
                                                $sumafinal=$sumafinal+$totalusd;
                                                $sumafinalprod=$sumafinalprod+$suma;
                                            }
                                            $bandera=true;
                                        }
                                        if($bandera==false){
                                            $html .='
                                                            <td></td>
                                                        ';
                                        }
                                        $aux++;
                                    }
                                    $ProdActual=$fila['idProducto'];
                                    $ColorActual=$fila['idColor'];
                                }
                            }
                            $html .='
                                    <tr id="totales">
                                        <td class="total">Total</td>
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
                                        <td></td>
                                        <td>'.$sumafinalprod.'</td>
                                        <td></td>
                                        <td>$ '.$sumafinal.'</td>
                                    </tr>
                        </tbody>
                    </table>
                </section>
        
                <section>
                    <div class="parrafofinal">
                        <p>In the event of prevention of shipment in whole or in part by reason of prohibition of export, local strike, political disturbance, riot, war,
                            civil conmotion or any other cause whatsoever amounting to force majeure, the seller may extent the period until the operation of the cause preventing
                            shipment has ceased or consider the contract void to the extent to which shipment has not been affected, such right to consider the contract void
                            being valid throughout the period of prevention. The certificate of the Arequipa Chamber of Comerce shall be final and binding.</p>
                        <p>Any dispute or diference araising out of this contract shall be settled by arbitration. The competent body to conduct the arbitration shall be
                            the Arequipa...</p>
                        <p>Thank you for this new order we remain,</p>
                        <p>Countersigned</p>
                    </div>
                </section>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
            </body>
        </html>
    ';
    $htmlheader='
        <header>
            <div id="descripcionbrand">
                <img width="80" height="80" src="image/logowakas.jpg" class="imagenlogo">
                <div class="aladologo">
                    <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
                    <br>
                    <span class="direccion">Urb. Francisco Mostajo G-25</span>
                    <br>
                    <span class="direccion">04002 Arequipa - Peru</span>
                </div>
            </div>
            <div id="tituloreporte">
                <div class="titulo">
                    <h4>Confirmation of Sale</h4>
                    <h5></h5>
                </div>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
               <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
          </div>
    ';
    $nombrearchivo=$_POST['contrato'].'.pdf';
    $mpdf = new mPDF('','A4-L');

// Write some HTML code:
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->SetHTMLFooter($htmlfooter);
    $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
    $mpdf->Output($nombrearchivo,'D');
?>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>