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
                    <span class="label">Colaborador:</span>';
    $result2=selectTableWhere('empleado','idEmpleado',"'".$_POST['filtroEmpleado']."'");
    while ($fila2=mysql_fetch_array($result2)){
        $html .='
                    <span style="font-size: 10px">'.$fila2['nombres'].' '.$fila2['apellidos'].' (DNI:'.$_POST['filtroEmpleado'].')</span>';
    }
    $html .='
                </div>
            </section>
            <hr>
            <section class="contenedor">
                <table class="tabla">
                    <thead>
                        <tr class="trborder" style="background-color: #c5c5c5">
                            <th>Fecha</th>
                            <th>Hora de Ingreso</th>
                            <th>Salida a Refrigerio</th>
                            <th>Entrada de Refrigerio</th>
                            <th>Hora de Salida</th>
				         </tr>
			        </thead>
			        <tbody>
        ';
    $result = mysql_query("SELECT * FROM RegistroIngresoSalida WHERE idEmpleado = ".$_POST['filtroEmpleado']." AND fecha LIKE '".$_POST['mes']."/%%/".$_POST['año']."'");
    while($fila=mysql_fetch_array($result)){
        $html .='
                        <tr>
                            <td>'.$fila['fecha'].'</td>
                            <td>'.$fila['horaIngreso'].'</td>
                            <td>'.$fila['salidaBreak'].'</td>
            ';
        $html .='
                            <td>'.$fila['ingresoBreak'].'</td>
                            <td>'.$fila['horaSalida'].'</td>
                        </tr>
            ';
    }
    $html .='
                    </tbody>
		        </table>
		    </section>
        ';
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
                <h5>Reporte Mensual de Ingresos y Salidas</h5>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
                <span style="font-size: 10px;">Waka-s Textiles Finos SAC. </span>
                       
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo='ReporteMensIngSal'.$_POST['filtroEmpleado'].'.pdf';
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