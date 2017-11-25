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
                <title>Detalle de Producto</title>
                <link href="css/Formatospdf.css" rel="stylesheet">
            </head>
            <body>
            <section>
                <span class="label">Avance del Lote:</span>
                <span>'.$_POST['avance'].' %</span>
                <table class="tabla">
                    <thead>
                        <tr class="borderbottom">
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Procedimiento</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $result=selectOrderedTableWhere('EmpleadoLote','idLote',"'".$_POST['idlote']."'",'fecha');
                    while ($fila=mysql_fetch_array($result)){
                        $html .='<tr>';
                        $html .='<td>'.$fila['fecha'].'</td>';
                        $result1=selectTableWhere('Empleado','idEmpleado',"'".$fila['idEmpleado']."'");
                        while ($fila1=mysql_fetch_array($result1)){
                            if($fila1['idTipoUsuario']=="1"){
                                $html .='<td>Proceso Tercerizado</td>';
                            }else{
                                $html .='<td>'.$fila1['nombres'].' '.$fila1['apellidos'].'</td>';
                            }
                        }
                        $result2=selectTableWhere('SubProceso','idProcedimiento',"'".$fila['idProcedimiento']."'");
                        while ($fila2=mysql_fetch_array($result2)){
                            $html .='<td>'.$fila2['descripcion'].'</td>';
                        }
                        $html .='<td>'.$fila['cantidad'].'</td>';
                        $html .='</tr>';
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
                    <h4>Detalle de Lote</h4>
                    <span class="desctitulo">'.$_POST['idlote'].'</span>
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
    $nombrearchivo='DetalledeLote'.$_POST['idlote'].'.pdf';
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