
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
    <title>Waka-s Textiles Finos S.A.</title>
    <link href="css/Formatospdf.css" rel="stylesheet">
</head>
<body class="portrait">
<section>
    <h4>Repuestos:</h4>
    <table class="tabla">
        <thead>
        <tr>
            <th>idRepuesto</th>
            <th>Descripci&oacute;n</th>
        </tr>
        </thead>
        <tbody>
';
$result=selectTableWhere('RepuestosMaquina','idMaquina',"'".$_POST['idmaquina']."'");
while ($fila=mysql_fetch_array($result)){
    $html .='
                                 <tr>
                                    <td>'.$fila['idRepuestos'].'</td>                             
                ';
    $result1=selectTableWhere('Repuestos','idRepuestos',"'".$fila['idRepuestos']."'");
    while ($fila1=mysql_fetch_array($result1)){
        $html .='
                                     <td>'.$fila1['descripcion'].'</td>
                ';
    }
    $html .='
                                 </tr>
            ';
}
$html .='
        </tbody>
    </table>
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
                    <h4>Ficha de Repuestos</h4>
                ';
                    $result=selectTableWhere('Maquina','idMaquina',"'".$_POST['idmaquina']."'");
                    while ($fila=mysql_fetch_array($result)){
                        $htmlheader .='
                             <h5 class="desctitulo">MAQ '.$fila['descripcion'].'</h5>
                        ';
                    }
            $htmlheader .='
                </div>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
               <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
          </div>
    ';
    $nombrearchivo='ReporteRepuestos'.$_POST['idmaquina'].'.pdf';
    $mpdf = new mPDF();

// Write some HTML code:
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->SetHTMLFooter($htmlfooter);
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output($nombrearchivo,'D');
?>


<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>