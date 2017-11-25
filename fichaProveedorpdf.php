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
            <title>Ficha Proveedor</title>
            <link href="css/Formatospdf.css" rel="stylesheet">
        </head>
        <body>
            <div>
                <div>
                    <span class="label">Direcci&oacute;n del Proveedor:</span>
                    ';
                        $result=selectTableWhere('Proveedor','idProveedor',"'".$_POST['idproveedor']."'");
                        while ($fila=mysql_fetch_array($result)){
                            $html .='
                                 <span style="font-size: 10px">'.$fila['Direccion'].'</span>
                            ';
                        }
        $html .='
                </div>
            </div>
            <br>
            <section>
                <div class="contenedor">
                    <span class="label">Insumos que Provee:</span>
                </div>
                <table class="tabla">
                    <thead>
                        <tr class="borderbottom">
                            <th>IdInsumo</th>
                            <th>Descripci&oacute;n</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>';
                            $result=selectTableWhere('ProveedorInsumos','idProveedor',"'".$_POST['idproveedor']."'");
                            while ($fila=mysql_fetch_array($result)){
                                $html .='
                                            <td>'.$fila['idInsumo'].'</td>
                                        ';
                                $result1=selectTableWhere('Insumos','idInsumo',"'".$fila['idInsumo']."'");
                                while ($fila1=mysql_fetch_array($result1)){
                                    $html .='
                                                    <td>'.$fila1['descripcion'].'</td>
                                                ';
                                }
                                $html .='
                                             <td>S/. '.$fila['costo'].'</td>
                                         </tr>
                                        ';
                            }
        $html .='
                    </tbody>
                </table>
            </section>
            <br>
            <section>
                <div class="contenedor">
                    <span class="label">Materiales que Provee:</span>
                </div>
                <table class="tabla">
                    <thead>
                        <tr class="borderbottom">
                            <th>idMaterial</th>
                            <th>Descripci&oacute;n</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>';
                            $result=selectTableWhere('MaterialProveedor','idProveedor',"'".$_POST['idproveedor']."'");
                            while ($fila=mysql_fetch_array($result)){
                                $html .='
                                                <td>'.$fila['idMaterial'].'</td>
                                            ';
                                $result1=selectTableWhere('Material','idMaterial',"'".$fila['idMaterial']."'");
                                while ($fila1=mysql_fetch_array($result1)){
                                    $html .='
                                                    <td>'.$fila1['material'].'</td>
                                                ';
                                }
                                $html .='
                                                <td>S/. '.$fila['costo'].'</td>
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
                    <h4>Ficha de Proveedor</h4>
                ';
                    $result=selectTableWhere('Proveedor','idProveedor',"'".$_POST['idproveedor']."'");
                    while ($fila=mysql_fetch_array($result)){
                        $htmlheader .='
                            <h5 class="desctitulo">PROV '.$fila['nombre'].'</h5>
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
    $nombrearchivo='FichadeProveedor'.$_POST['idproveedor'].'.pdf';
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
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>