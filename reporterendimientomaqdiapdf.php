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
             <section class="contenedor">
                    <div>
                        <h5>Rendimiento Bruto de Máquina del '.$_POST['fecha'].'</h5>
                    </div>
                    <hr>
                    <div class="contenedor">
                        <table class="tabla">
                            <thead>
                                <tr class="trborder" style="background-color: #c5c5c5">
                                    <th>Máquina</th>
                                    <th>Operador</th>
                                    <th>Tiempo del Turno</th>
                                    <th>Tiempo Operativo</th>
                                    <th>Tiempo Muerto</th>
                                    <th>Rendimiento</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $horasenwakas1=0;
                            $horasenwakas=0;
                            $horastrabajo=0;
                            $tiempomuerto=0;
                            $tiempoefectivo=0;
                            $rendimientomaquina=0;
                            $result2=mysql_query("SELECT DISTINCT idEmpleado FROM empleadolote WHERE idMaquina='".$_POST['idmaq']."' AND fecha='".$_POST['fecha']."'");
                            while ($fila2=mysql_fetch_array($result2)){
                                $html .='<tr>';
                                $result12=selectTableWhere('Maquina','idMaquina',"'".$_POST['idmaq']."'");
                                while ($fila12=mysql_fetch_array($result12)){
                                   $html .='<td>'.$fila12['descripcion'].'</td>';
                                }
                                $result3=selectTableWhere('Empleado','idEmpleado',"'".$fila2['idEmpleado']."'");
                                while ($fila3=mysql_fetch_array($result3)){
                                    $html .='<td>'.$fila3['nombres'].' '.$fila3['apellidos'].'</td>';
                                }
                                $result1=selectTableWhere2('RegistroIngresoSalida','idEmpleado',"'".$fila2['idEmpleado']."'",'fecha',"'".$_POST['fecha']."'");
                                while ($fila1=mysql_fetch_array($result1)) {
                                    $horaIngreso = explode(":", $fila1['horaIngreso']);
                                    $horaSalida = explode(":", $fila1['horaSalida']);
                                    $horasalidabreak=explode(":", $fila1['salidaBreak']);
                                    $horaingresobreak=explode(":", $fila1['ingresoBreak']);
                                    $minutosSalidaBreak=($horasalidabreak[0] * 60) + $horasalidabreak[1];
                                    /*echo $minutosSalidaBreak." ";*/
                                    $minutosIngresoBreak=($horaingresobreak[0] * 60) + $horaingresobreak[1];
                                    /*echo $minutosIngresoBreak." ";*/
                                    $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
                                    $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
                                    $horastrabajo = $minutosSalida - $minutosIngreso;
                                    $tiempobreak=$minutosIngresoBreak-$minutosSalidaBreak;
                                    /*echo $tiempobreak." ";*/
                                    $horasenwakas=($horastrabajo/60)-($tiempobreak/60);
                                    /*echo $horasenwakas." ";*/
                                    $horasenwakas1=round($horasenwakas,2,1);
                                    /*echo $fila1['horaIngreso'] . " ";
                                    echo $fila1['horaSalida'] . " ";
                                    echo "$minutosIngreso ";
                                    echo "$minutosSalida ";
                                    echo "$horastrabajo ";*/
                                    $html .='<td>'.$horasenwakas1.' horas</td>';
                                }
                                $result4=selectTableWhere2('empleadoactividadmuerta','idEmpleado',"'".$fila2['idEmpleado']."'",'idMaquina',"'".$_POST['idmaq']."'");
                                while ($fila4=mysql_fetch_array($result4)){
                                    $tiempomuerto=$tiempomuerto+$fila4['tiempo'];
                                }
                                $tiempoefectivo=$horastrabajo-$tiempomuerto;
                                $html .='<td>'.$tiempoefectivo.' minutos</td>
                                      <td>'.$tiempomuerto.' minutos</td>
                                ';
                                $rendimientomaquina=($tiempoefectivo/$horastrabajo)*100;
                                $rendimientomaquina1=round($rendimientomaquina,2,1);
                                $html .='<td>'.$rendimientomaquina1.' %</td>';
                                $html .='</tr>';
                            }
$html .='
                            </tbody>                    
                        </table>
                    </div>
                    <div class="contenedor">
                        <div>
                            <h5>Actividades Muertas</h5>
                        </div>
                        <br>
                        <table class="tabla">
                            <thead>
                                <tr class="trborder" style="background-color: #c5c5c5">
                                    <th>Empleado</th>
                                    <th>Actividad Muerta</th>
                                    <th>Descripción</th>
                                    <th>Tiempo</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $result13=selectTableWhere2('empleadoactividadmuerta','idMaquina',"'".$_POST['idmaq']."'",'fecha',"'".$_POST['fecha']."'");
                            while ($fila13=mysql_fetch_array($result13)){
                                $html .='<tr>';
                                $emp=selectTableWhere("empleado",'idempleado',"'".$fila13['idEmpleado']."'");
                                while ($empfil=mysql_fetch_array($emp)){
                                    $html .='<td>'.$empfil['nombres'].' '.$empfil['apellidos'].'</td>';
                                }
                                $act=selectTableWhere('actividadmuerta','idActividadMuerta',"'".$fila13['idActividadMuerta']."'");
                                while ($actifil=mysql_fetch_array($act)){
                                    $html .='<td>'.$actifil['descripcion'].'</td>';
                                }
                                $html .='<td>'.$fila13['descripcion'].'</td>
                                      <td>'.$fila13['tiempo'].' min</td>
                                ';
                                $html .='</tr>';
                            }
$html .='
                            </tbody>
                        </table>
                    </div>
                </section>
                </section>
                <hr>
                <section class="contenedor">
                    <div>
                        <h4>Rendimiento de la Producción</h4>
                    </div>
                    ';
                    $rendimientodeproduccion=0;
                    $result5=mysql_query("SELECT DISTINCT idEmpleado FROM empleadolote WHERE idMaquina='".$_POST['idmaq']."' AND fecha='".$_POST['fecha']."'");
                    while ($fila5=mysql_fetch_array($result5)){
                        $html .='
                            <div class="contenedor">
                                <div>
                                    <h5>Turno llevado por: ';
                        $result3=selectTableWhere('Empleado','idEmpleado',"'".$fila5['idEmpleado']."'");
                        while ($fila3=mysql_fetch_array($result3)){
                            $html .= $fila3['nombres'].' '.$fila3['apellidos'];
                        }
                        $html .='
                                    </h5>
                                </div>
                            </div>                          
                            <div class="contenedor">
                                <table class="tabla">
                                    <thead>
                                        <tr class="trborder" style="background-color: #c5c5c5">
                                            <th>Lote</th>
                                            <th>Producto</th>
                                            <th>Componente</th>
                                            <th>Cantidad</th>
                                            <th>Tiempo</th>
                                            <th>Tiempo Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        ';
                        $tiempocantidad=0;
                        $tiempoproduccion=0;
                        $tiempoesperadoproduccion=0;
                        $tiempolote=0;
                        $cantidadlote=0;
                        $tiempoesperadoproducciontotal=0;
                        $result6=selectTableWhere3('empleadolote','idEmpleado',"'".$fila5['idEmpleado']."'",'idMaquina',"'".$_POST['idmaq']."'",'fecha',"'".$_POST['fecha']."'");
                        while ($fila6=mysql_fetch_array($result6)){
                            $html .='<tr>';
                            $html .='<td>'.$fila6['idLote'].'</td>
                                  <td>'.$fila6['idProducto'].'</td>
                            ';
                            $result7=selectTableWhere('productocomponentesprenda','idComponenteEspecifico',"'".$fila6['idComponenteEspecifico']."'");
                            while ($fila7=mysql_fetch_array($result7)){
                                $result8=selectTableWhere('componentesprenda','idComponente',"'".$fila7['idComponente']."'");
                                while ($fila8=mysql_fetch_array($result8)){
                                    $html .='<td>'.$fila8['descripcion'].'</td>';
                                }
                            }
                            $result11=selectTableWhere('Lote','idLote',"'".$fila6['idLote']."'");
                            while ($fila11=mysql_fetch_array($result11)){
                                $cantidadlote=$fila11['cantidad'];
                            }
                            $html .='<td>'.$fila6['cantidad'].'</td>';
                            $result9=mysql_query("SELECT DISTINCT fila FROM PCPSPC WHERE idComponenteEspecifico='".$fila6['idComponenteEspecifico']."' AND valor='".$_POST['idmaq']."'");
                            while ($fila9=mysql_fetch_array($result9)){
                                $filapcpspc=$fila9['fila'];
                                $result10=mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico='".$fila6['idComponenteEspecifico']."' AND idSubProcesoCaracteristica='SUBPROCESOCARAC36' AND fila='".$filapcpspc."'");
                                while ($fila10=mysql_fetch_array($result10)){
                                    $html .='<td>'.$fila10['valor'].' min</td>';
                                    $tiempocantidad=$fila6['cantidad']*$fila10['valor'];
                                    $tiempoesperadoproduccion=$cantidadlote*$fila10['valor'];
                                    $tiempoproduccion=$tiempoproduccion+$tiempocantidad;
                                    $tiempoesperadoproducciontotal=$tiempoesperadoproducciontotal+$tiempoesperadoproduccion;
                                }
                            }
                            $html .='<td>'.$tiempoproduccion.' min</td>';
                            $html .='</tr>';
                        }
                        $rendimientodeproduccion=($tiempoproduccion/$tiempoesperadoproducciontotal)*100;
                        $rendimientodeproduccion1=round($rendimientodeproduccion,2,1);
                        $html .='
                            <tr class="totales">
                                <td colspan="5" class="total tdleft">Rendimiento de Producción</td>
                                <td class="total">'.$rendimientodeproduccion1.' %</td>
                            </tr>
                        ';
                        $html .='
                                        </tbody>
                                    </table>                
                                </div>
                        ';
                    }
$html .='                                    
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
                <h5>Reporte de Rendimiento de Máquina</h5>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
                <span style="font-size: 10px;">Waka-s Textiles Finos SAC. </span>
                       
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo='ReporteRendimientoMaqDiario'.$_POST['idmaq'].'.pdf';
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