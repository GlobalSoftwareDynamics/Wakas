<?php
session_start();
require('funciones.php');
require_once __DIR__ . '/lib/mpdf/mpdf.php';

conexion();

if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
    ?>


    <?php
    /*echo $_POST['dni1']." " ;
    echo $_POST['mes']." " ;*/
    $hoy=date("m/d/Y");
    /*echo $hoy." ";*/
    $año=explode("/",$hoy);
    /*echo $año[2]." ";*/
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
                <section class="container">
                    <div>
                        <span class="label">Mes Seleccionado:</span>';
$nombremes="";
switch ($_POST['mes']) {
    case "01":
        $nombremes = "Enero";
        break;
    case "02":
        $nombremes = "Febrero";
        break;
    case "03":
        $nombremes = "Marzo";
        break;
    case "04":
        $nombremes = "Abril";
        break;
    case "05":
        $nombremes = "Mayo";
        break;
    case "06":
        $nombremes = "Junio";
        break;
    case "07":
        $nombremes = "Julio";
        break;
    case "08":
        $nombremes = "Agosto";
        break;
    case "09":
        $nombremes = "Septiembre";
        break;
    case "10":
        $nombremes = "Octubre";
        break;
    case "11":
        $nombremes = "Noviembre";
        break;
    case "12":
        $nombremes = "Diciembre";
        break;
}
$html .='
                        <span style="font-size: 10px">'.$nombremes.'</span>
                    </div>
                </section>
                <section class="contenedor">
                    <div>
                        <span class="label">Máquina Seleccionada:</span>';
            $maq=selectTableWhere('maquina','idmaquina',"'".$_POST['idmaq1']."'");
            while ($fil=mysql_fetch_array($maq)){
                $html .='<span style="font-size: 10px"> '.$fil['descripcion'].'</span>';
            }
$html .='
                        
                    </div>
                </section>
                <section class="contenedor">
                    <div>
                        <h4>Resumen de Rendimientos Diarios</h4>
                    </div>
                    <div class="contenedor">
                        <table class="tabla">
                            <thead>
                                <tr class="trborder" style="background-color: #c5c5c5">
                                    <th>Fecha</th>
                                    <th>Tiempo Trabajado (Horas)</th>
                                    <th>Rendimiento</th>
                                </tr>
                            </thead>
                            <tbody>';
$horasenwakas1=0;
$horasenwakas=0;
$horastrabajo=0;
$tiempomuerto=0;
$tiempoefectivo=0;
$rendimientomaquinames=0;
$horastotaleswakas=0;
$tiempoefectivototal=0;
$result=mysql_query("SELECT DISTINCT fecha FROM empleadolote WHERE idMaquina='".$_POST['idmaq1']."' AND fecha LIKE '".$_POST['mes']."/%%/".$año[2]."'");
while ($fila=mysql_fetch_array($result)){
    $html .='<tr>';
    $html .='<td>'.$fila['fecha'].'</td>';
    $result2=mysql_query("SELECT DISTINCT idEmpleado FROM empleadolote WHERE idMaquina='".$_POST['idmaq1']."' AND fecha ='".$fila['fecha']."'");
    while ($fila2=mysql_fetch_array($result2)){
        $result1=selectTableWhere2('RegistroIngresoSalida','idEmpleado',"'".$fila2['idEmpleado']."'",'fecha',"'".$fila['fecha']."'");
        while ($fila1=mysql_fetch_array($result1)) {
            $horaIngreso = explode(":", $fila1['horaIngreso']);
            $horaSalida = explode(":", $fila1['horaSalida']);
            $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
            $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
            $horasalidabreak=explode(":", $fila1['salidaBreak']);
            $horaingresobreak=explode(":", $fila1['ingresoBreak']);
            $minutosSalidaBreak=($horasalidabreak[0] * 60) + $horasalidabreak[1];
            /*echo $minutosSalidaBreak." ";*/
            $minutosIngresoBreak=($horaingresobreak[0] * 60) + $horaingresobreak[1];
            /*echo $minutosIngresoBreak." ";*/
            $tiempobreak=$minutosIngresoBreak-$minutosSalidaBreak;
            /*echo $tiempobreak." ";*/
            $horastrabajo = ($minutosSalida - $minutosIngreso)-($minutosIngresoBreak-$minutosSalidaBreak);
            $horasenwakas=$horastrabajo/60;
            $horasenwakas1=round($horasenwakas,2,1);
            /*echo $fila1['horaIngreso'] . " ";
            echo $fila1['horaSalida'] . " ";
            echo "$minutosIngreso ";
            echo "$minutosSalida ";
            echo "$horastrabajo ";*/
            $horastotaleswakas=$horastotaleswakas+$horastrabajo;
            $horastotaleswakas1=round(($horastotaleswakas/60),2,1);
        }
        $html .='<td>'.$horastotaleswakas1.' horas</td>';
        $result4=selectTableWhere2('empleadoactividadmuerta','idEmpleado',"'".$fila2['idEmpleado']."'",'idMaquina',"'".$_POST['idmaq1']."'");
        while ($fila4=mysql_fetch_array($result4)){
            $tiempomuerto=$tiempomuerto+$fila4['tiempo'];
        }
        $tiempoefectivo=$horastrabajo-$tiempomuerto;
        $tiempoefectivototal=$tiempoefectivototal+$tiempoefectivo;
    }
    $rendimientomaquinames=($tiempoefectivototal/$horastotaleswakas)*100;
    $rendimientomaquinames1=round($rendimientomaquinames,2,1);
    $html .='<td>'.$rendimientomaquinames1.' %</td>';
    $html .='</tr>';
}
$html .='
                            </tbody>
                        </table>
                    </div>
                </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        </body>

        </html>';
    $htmlheader='
        <header>
            <div id="descripcionbrand">
                <img style="margin-top: 20px" width="auto" height="60" src="image/WakasPDF.png"/>
            </div>
            <div id="tituloreporte" class="titulo">
                <h5>Reporte de Rendimiento Mensual de Máquina</h5>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
                <span style="font-size: 10px;">Waka-s Textiles Finos SAC. </span>
                       
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo='ReporteRendimientoMaqMens'.$_POST['idmaq'].'.pdf';
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