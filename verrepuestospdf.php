
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
    <h5>Repuestos:</h5>
    <table class="tabla">
        <thead>
        <tr class="borderbottom">
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
                <img style="margin-top: 20px" width="auto" height="60" src="image/WakasPDF.png"/>
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
                <span style="font-size: 10px;">Waka-s Textiles Finos SAC. </span>
                                   
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo='ReporteRepuestos'.$_POST['idmaquina'].'.pdf';
    $mpdf = new mPDF('','A4',0,'','15',15,35,35,6,6);

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