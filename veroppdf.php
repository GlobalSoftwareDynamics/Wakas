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
            <title>Ver Órden de Producción</title>
            <link href="css/Formatospdf.css" rel="stylesheet">
        </head>
        <body>
             <div>
                <div class="descladoizquierdo">
                        <span class="label">Nro de &Oacute;rden:</span>';
                        $result=selectTableWhere('OrdenProduccion','idOrdenProduccion',"'".$_POST['idop']."'");
                            while ($fila3=mysql_fetch_array($result)){
                                $html .='<span>'.$_POST['idop'].'</span>';
                                $idContract=$fila3['idContrato'];
                        }
    $html .='            
                    <br>
                        <span class="label">Contrato:</span>';
                        $html .='
                             <span>'.$idContract.'</span>
                        ';
    $html .='                    
                    <br>
                        <span class="label">Cliente:</span>';
                        $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                        while($fila=mysql_fetch_array($result1)){
                            $result2=selectTableWhere('Contacto','idContacto',"'".$fila['idContacto']."'");
                            while ($fila1=mysql_fetch_array($result2)){
                                $result3=selectTableWhere('Cliente','idCliente',"'".$fila1['idCliente']."'");
                                while ($fila2=mysql_fetch_array($result3)){
                                    $html .='
                                        <span>'.$fila2['nombre'].'</span>
                                    ';
                                }
                            }
                        }
    $html .='                    
                </div>
                <div class="descladoderecho">
                            <span class="label">Fecha de Creaci&oacute;n:</span>';
                            $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                            while ($fila=mysql_fetch_array($result)){
                                $html .='
                                                <span>'.$fila['fecha'].'</span>
                                            ';
                            }
    $html .='                        
                        <br>
                            <span class="label">Creado por:</span>
                            <span id="creador">EFG</span>
                        <br>
                            <span class="label">Fecha de Env&iacute;o:</span>';
                            $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                            while ($fila=mysql_fetch_array($result)){
                                $html .='
                                    <span>'.$fila['shipdate'].'</span>
                                ';
                            }
    $html .='                        
                </div>
             </div>
             <br>
             <section>
                <table class="tabla">
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
                    <tbody>';
                    $aux3=1;
                    $result1="SELECT * FROM Lote WHERE idOrdenProduccion ='".$_POST['idop']."' ORDER BY idProducto ASC";
                    $result=mysql_query($result1);
                    while ($fila=mysql_fetch_array($result)){
                        $html .='
                                    <tr>
                                        <td>'.$aux3.'</td>
                                        <td>'.$fila['idLote'].'</td>
                                        <td>'.$fila['idProducto'].'</td>
                                        <td>'.$fila['material'].'</td>
                                        <td>'.$fila['idColor'].'</td>
                                        <td>'.$fila['idTalla'].'</td>
                                        <td>'.$fila['cantidad'].'</td>
                                    </tr>
                                ';
                        $aux3++;
                    }
    $html .='
                    </tbody>
                </table>
             </section>
             <section>
                <div>
                    <h5>Observación:</h5>
                </div>
                <div class="observacionop">';
                    $observacion=selectTableWhere('OrdenProduccion','idOrdenProduccion',"'".$_POST['idop']."'");
                    while ($fila5=mysql_fetch_array($observacion)){
                        $html .='
                                            <p>'.$fila5['Observacion'].'</p>
                                        ';
                    }
    $html .='                
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
                    <h4>Órden de Producción</h4>
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
    $nombredearchivo=$_POST['idop'].'.pdf';
    $mpdf = new mPDF();

// Write some HTML code:
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->SetHTMLFooter($htmlfooter);
    $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
    $mpdf->Output($nombredearchivo,'D');
?>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>