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
                    <title>Tarjeta</title>
                    <link href="css/bootstrap.css" rel="stylesheet">
                    <link href="css/Formatospdf.css" rel="stylesheet">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                    <script src="lib/barcode/JsBarcode.all.min.js"></script>
                </head>
                <body>
    ';
    $result="SELECT * FROM lote WHERE idOrdenProduccion='".$_POST['idop']."' ORDER BY posicion";
    $result1=mysql_query($result);
    while ($fila=mysql_fetch_array($result1)){
        $bar=$fila['idLote'];
        $html .='        
                <section class="tarjetalote" style="height: 15.2cm; width: 10cm;">
                        <div class="contenedor">
                            <div>
                                <img width="3cm" height="70" src="image/Brand.png" class="izquierda">
                                <img width="200" height="80" src="barcodes/'.$_POST['idop'].'/'.$bar.'.png" class="derecha">
                            </div>
                        </div>
                        <div class="contenedor">
                                        <div class="tarjetacont" >
                                            <p class="columnaizquierda1 col-xs-3">idLote</p>
                                            <p class="col-xs-5">'.$fila['idLote'].'</p>
                                        </div>
                                        <div class="tarjetacont" >
                                            <p class="columnaizquierda1 col-xs-3">idModelo</p>
                                            <p class="col-xs-5">'.$fila['idProducto'].'</p>
                                        </div>
                                        <div class="tarjetacont">
                                            <p class="columnaizquierda1 col-xs-3">Material</p>
                                            <p class="col-xs-5">'.$fila['material'].'</p>
                                        </div>
                                        <div class="tarjetacont">
                                            <p class="columnaizquierda1 col-xs-3">Color</p>
                                            <p class="col-xs-5">'.$fila['idColor'].'</p>
                                        </div>
                                        <div class="tarjetacont">
                                            <p class="columnaizquierda1 col-xs-3">Talla</p>';
        $talla=selectTableWhere('Talla','idTalla',"'".$fila['idTalla']."'");
        while ($fila1=mysql_fetch_array($talla)){
            $html .='<p class="col-xs-5">'.$fila1['descripcion'].'</p>';
        }
        $html .='
                                        </div>
                                        <div class="tarjetacont">
                                            <p class="columnaizquierda1 col-xs-3">Cantidad</p>
                                            <p class="col-xs-5">'.$fila['cantidad'].'</p>
                                        </div>
                        </div>
                        <div class="contenedor">
        ';
        $medidas=selectTableWhere2('TallaMedida','idProducto',"'".$fila['idProducto']."'","idTalla","'".$fila['idTalla']."'");
        while ($fila2=mysql_fetch_array($medidas)){
            $descmedidas=selectTableWhere('Medida','idMedida',"'".$fila2['idMedida']."'");
            while ($fila3=mysql_fetch_array($descmedidas)){
                $html .='
                    <div class="tarjetacont">
                        <p class="columnaizquierda col-xs-7">'.$fila2['idMedida'].': '.$fila3['descripcion'].'</p>
                        <p class="columnaderecha col-xs-2">'.$fila2['valor'].'</p>
                    </div>
            ';
            }
        }
        $html .='
                        </div>
                        <div class="cuadrobservacion" style="font-size: 12px">
                            <p class="columnaizquierda1">OBSERVACIONES</p>
                            <p>'.$_POST['observacion'].'</p>
                        </div>
                </section>
            ';
    }
    $html .='
        </body>
    </html>
    ';
    $nombrearchivo='Tarjetas'.$_POST['idop'].'.pdf';
    $mpdf = new mPDF('utf8',array(102,153),0,'',3,3,3,3,6,6);
// Write some HTML code:
    $mpdf->WriteHTML($html);
// Output a PDF file directly to the browser
    $mpdf->Output($nombrearchivo,'D');
    ?>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>