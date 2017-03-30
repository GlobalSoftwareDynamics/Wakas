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

            /*echo $_POST[\'dni\']." " ;
            echo $_POST[\'fecha\']." " ;*/
            $result1=selectTableWhere2('RegistroIngresoSalida','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
            while ($fila1=mysql_fetch_array($result1)) {
                    $horaIngreso = explode(":", $fila1['horaIngreso']);
                    $horaSalida = explode(":", $fila1['horaSalida']);
                    $minutosIngreso = ($horaIngreso[0] * 60) + $horaIngreso[1];
                    $minutosSalida = ($horaSalida[0] * 60) + $horaSalida[1];
                    $horastrabajo = $minutosSalida - $minutosIngreso;
                    $horasenwakas=$horastrabajo/60;
                    $horasenwakas1=round($horasenwakas,2,1);
                    /*echo $fila1[\'horaIngreso\'] . " ";
                    echo $fila1[\'horaSalida\'] . " ";
                    echo "$minutosIngreso ";
                    echo "$minutosSalida ";
                    echo "$horastrabajo ";*/
            }
            $result2="SELECT * FROM caracteristica WHERE descripcion = 'Tiempo'";
            $query=mysql_query($result2);
            while ($fila2=mysql_fetch_array($query)){
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
            $result5=selectTableWhere2('EmpleadoLote','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
            while ($fila5=mysql_fetch_array($result5)){
                    /*echo $fila5[\'idComponenteEspecifico\']. " ";*/
                    $result6=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila5['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                    while ($fila6=mysql_fetch_array($result6)){
                        /*echo $fila6['valor']." ";*/
                        $tiempoactividad=$fila6['valor']*$fila5['cantidad'];
                        /*echo $tiempoactividad." ";*/
                    }
                $sumatiempos=$sumatiempos+$tiempoactividad;
                /*echo $sumatiempos." ";*/
            }
            $rendimiento=($sumatiempos/$horastrabajo)*100;
            /*echo $rendimiento." ";*/
            $rendimiento1=round($rendimiento,2,1);

            $html .='
                <section class="contenedor">
                    <div>
                        <span class="label">Fecha Seleccionada:</span>
                        <span>'.$_POST['fecha'].'</span>
                    </div>
                </section>
                <section class="contenedor">
                    <div>
                        <span class="label">Horas Trabajadas:</span>
                        <span>'.$horasenwakas1.'</span>
                    </div>
                </section>
                <section class="contenedor">
                    <div>
                        <h4>Resumen de Procedimientos Realizados</h4>
                    </div>
                    <div class="contenedor">
                        <table class="tabla">
                            <thead>
                                <tr class="trborder" style="background-color: #c5c5c5">
                                    <th>idProducto</th>
                                    <th>Procedimiento</th>
                                    <th>Componente</th>
                                    <th>Cantidad</th>
                                    <th>Tiempo Estandar</th>
                                    <th>Tiempo Empleado</th>
                                </tr>
                            </thead>
                            <tbody>';
                                $tiempoempleado=0;
                                $result7=selectTableWhere2('EmpleadoLote','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
                                while ($fila7=mysql_fetch_array($result7)){
                                    $html .='
                                        <tr>
                                            <td>'.$fila7['idProducto'].'</td>
                                    ';
                                    $res1=selectTableWhere('SubProceso','idProcedimiento',"'".$fila7['idProcedimiento']."'");
                                    while ($fil2=mysql_fetch_array($res1)){
                                        $html .='
                                            <td>'.$fil2['descripcion'].'</td>
                                        ';
                                    }
                                    $res2=selectTableWhere('ProductoComponentesPrenda','idComponenteEspecifico',"'".$fila7['idComponenteEspecifico']."'");
                                    while ($fil3=mysql_fetch_array($res2)){
                                        $res3=selectTableWhere('ComponentesPrenda','idComponente',"'".$fil3['idComponente']."'");
                                        while ($fil4=mysql_fetch_array($res3)){
                                            $html .='
                                                <td>'.$fil4['descripcion'].'</td>
                                            ';
                                        }
                                    }
                                    $html .='
                                        <td>'.$fila7['cantidad'].'</td>
                                    ';
                                    $result9=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila7['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                                    while ($fila9=mysql_fetch_array($result9)){
                                        $html .='
                                            <td>'.$fila9['valor'].'</td>
                                        ';
                                    }
                                    $result8=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$fila7['idComponenteEspecifico']."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
                                    while ($fila8=mysql_fetch_array($result8)){
                                        $tiempoempleado=$fila8['valor']*$fila7['cantidad'];
                                        $html .='
                                            <td>'.$tiempoempleado.'</td>
                                        ';
                                    }
                                    $html .='</tr>';
                                }
            $html .='
                <tr class="totales">
                    <td colspan="5" class="total tdleft">Rendimiento del Día</td>
                    <td class="total">'.$rendimiento1.' %</td>
                </tr>
            ';
            $html .='
                            </tbody>
                        </table>
                    </div>
                </section>
                <hr>
            ';
            $html .='
                <section class="contenedor">
                    <div>
                        <h4>Actividades Muertas Realizadas</h4>
                    </div>
                    <div class="contenedor">
                        <table class="tabla">
                            <thead>
                                <tr class="trborder" style="background-color: #c5c5c5">
                                    <th>Actividad Muerta</th>
                                    <th>Descripción</th>
                                    <th>Tiempo Empleado</th>
                                    <th>Tiempo Estandar</th>
                                </tr>
                            </thead>
                            <tbody>';
                                $sumaactimuerta=0;
                                $res4=selectTableWhere2('EmpleadoActividadMuerta','idEmpleado',"'".$_POST['dni']."'",'fecha',"'".$_POST['fecha']."'");
                                while ($fil5=mysql_fetch_array($res4)){
                                    $html .='<tr>';
                                    $res5=selectTableWhere('ActividadMuerta','idActividadMuerta',"'".$fil5['idActividadMuerta']."'");
                                    while ($fil6=mysql_fetch_array($res5)){
                                        $html .='
                                            <td>'.$fil6['descripcion'].'</td>
                                            <td>'.$fil5['descripcion'].'</td>
                                            <td>'.$fil5['tiempo'].'</td>
                                            <td>'.$fil6['tiempoEstandar'].'</td>
                                        ';
                                        $sumaactimuerta=$sumaactimuerta+$fil5['tiempo'];
                                    }
                                    $html .='</tr>';
                                }
            $html .='
                <tr>
                    <td colspan="3" class="total tdleft">Tiempo Total en Actividades Muertas</td>
                    <td class="total">'.$sumaactimuerta.'</td>
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

        </html>';
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
                    $result=selectTableWhere('Empleado','idEmpleado',"'".$_POST['dni']."'");
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
    $nombrearchivo='ReporteRendimientDiario'.$_POST['dni'].'.pdf';
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