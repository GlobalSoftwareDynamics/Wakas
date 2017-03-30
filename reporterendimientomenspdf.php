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
        <body class="portrait">';
        
        $hoy=date("m/d/Y");
        /*echo $hoy." ";*/
        $año=explode("/",$hoy);
        /*echo $año[2]." ";*/
    $html .='
                <section class="contenedor">
                    <div>
                        <span class="label">Mes Seleccionado: </span>';
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
                        <span>'.$nombremes.'</span>
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
    $rendimientomestotal=0;
    $aux=0;
    $rendmes="SELECT * FROM RegistroIngresoSalida WHERE idEmpleado ='".$_POST['dni1']."' AND fecha LIKE '".$_POST['mes']."/%%/".$año[2]."'";
    $query=mysql_query($rendmes);
    while ($filames=mysql_fetch_array($query)){
            $html .='<tr>';
                    $horaIngreso = explode(":", $filames['horaIngreso']);
                    $horaSalida = explode(":", $filames['horaSalida']);
                    $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
                    $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
                    $horastrabajo = $minutosSalida - $minutosIngreso;
                    $tiempohoras=$horastrabajo/60;
                    /*echo $fila1[\'horaIngreso\'] . " ";
                    echo $fila1[\'horaSalida\'] . " ";
                    echo "$minutosIngreso ";
                    echo "$minutosSalida ";
                    echo "$horastrabajo ";*/
                    $html .='
                        <td>'.$filames['fecha'].'</td>
                        <td>'.$tiempohoras.'</td>
                    ';
            $result2="SELECT * FROM caracteristica WHERE descripcion = 'Tiempo'";
            $query1=mysql_query($result2);
            while ($fila2=mysql_fetch_array($query1)){
                $idcaractiempo=$fila2['idCaracteristica'];
                /*echo $idcaractiempo." ";*/
            }
            $result3=selectTableWhere('SubProceso','descripcion','"Hoja de Tiempos y Secuencia"');
            while ($fila3=mysql_fetch_array($result3)){
                $idprocedimientotiempo=$fila3['idProcedimiento'];
                /*echo $idprocedimientotiempo." ";*/
            }
            $result4=selectTableWhere2('SubProcesoCaracteristica','idProcedimiento',"'".$idprocedimientotiempo."'",'idCaracteristica',"'".$idcaractiempo."'");
            while ($fila4=mysql_fetch_array($result4)){
                $idsubprocesocaracteristica=$fila4['idSubProcesoCaracteristica'];
                /*echo $idsubprocesocaracteristica." ";*/
            }
            $sumatiempos=0;
            $tiempoactividad=0;
            $rendimiento=0;

            $rendmes1="SELECT * FROM empleadolote WHERE idEmpleado ='".$filames['idEmpleado']."' AND fecha LIKE '".$filames['fecha']."'";
            $result1=mysql_query($rendmes1);
            while ($fila5=mysql_fetch_array($result1)){
                    /*echo $fila5[\'idComponenteEspecifico\']. " ";*/
                    $result6=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila5['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                    while ($fila6=mysql_fetch_array($result6)){
                        /*echo $fila6[\'valor\']." ";*/
                        $tiempoactividad=$fila6['valor']*$fila5['cantidad'];
                        /*echo $tiempoactividad." ";*/
                    }
                $sumatiempos=$sumatiempos+$tiempoactividad;
                /*echo $sumatiempos." ";*/
            }
        $rendimiento=($sumatiempos/$horastrabajo)*100;
        $rendimiento1=round($rendimiento,2,1);
        /*echo $rendimiento." ";*/
        $html .='
                        <td>'.$rendimiento1.' %</td>
        ';
        $html .='
            </tr>
        ';
        $rendimientomestotal=$rendimientomestotal+$rendimiento;
        $aux++;
        }
        $rendimientofinaltotal=$rendimientomestotal/$aux;
        $rendimientofinaltotal1=round($rendimientofinaltotal,2,1);
        $html .='
                <tr class="totales">
                    <td colspan="2" class="total tdleft">Rendimiento Mensual</td>
                    <td class="total">'.$rendimientofinaltotal1.' %</td>
                </tr>
        ';
        $html .='
                            </tbody>
                        </table>
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
                    <h4>Reporte de Rendimiento Mensual</h4>';
                        $result=selectTableWhere('Empleado','idEmpleado',"'".$_POST['dni1']."'");
                        while ($fila=mysql_fetch_array($result)){
                            $htmlheader .='
                                <h5 class="desctitulo">'.$fila['nombres'].' '.$fila['apellidos'].'</h5>
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
    $nombrearchivo='ReporteRendimientMensual'.$_POST['dni1'].'.pdf';
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
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>