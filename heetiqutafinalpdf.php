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
                <title>HE Final</title>
                <link href="css/Formatospdf.css" rel="stylesheet">
            </head>
            <body>
            
            <section class="contenedor">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <th colspan="6" class="thlabel">Etiquetado y Embolsado</th>
                        </tr>
                        <tr class="borderbottom">';
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO26' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    $html .='<th>'.$fila2['descripcion'].'</th>';
                                }
                            }
    $html .='
                        </tr>
                        </thead>
                        <tbody>';
                        $aux = 0;
                        $aux2 = 0;
                        $contenido = array();
                        $subprocesocaracteristica = array();
                        $tipocontenido = array();
                        $compespec = array();
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $compespec[$aux2] = $fila3['idComponenteEspecifico'];
                            $aux2++;
                        }
                        for($j = 0; $j<count($compespec);$j++){
                            $result4 = mysql_query("SELECT DISTINCT pcpspc.* FROM `PCPSPC`,`SubProcesoCaracteristica` WHERE pcpspc.idSubProcesoCaracteristica = subprocesocaracteristica.idSubProcesoCaracteristica AND subprocesocaracteristica.idProcedimiento = 'PROCEDIMIENTO26' AND pcpspc.idComponenteEspecifico = '".$compespec[$j]."'");
                            while ($fila4 = mysql_fetch_array($result4)) {
                                $contenido[$aux] = $fila4['valor'];
                                $subprocesocaracteristica[$aux] = $fila4['idSubProcesoCaracteristica'];
                                $result5 = mysql_query("SELECT * FROM SubProcesoCaracteristica WHERE idSubProcesoCaracteristica = '" . $fila4['idSubProcesoCaracteristica'] . "'");
                                while ($fila5 = mysql_fetch_array($result5)) {
                                    $tipocontenido[$aux] = $fila5['tipo'];
                                }
                                $aux++;
                            }
                        }
                        $entradas = $aux/4;
                        for ($i = 0; $i < $entradas; $i++) {
                            $html .='<tr>';
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$contenido[$i]."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    $html .='<td>'.$fila2['descripcion'].'</td>';
                                }
                            }
                            $html .='<td>'.$contenido[$i+$entradas].'</td>';
                            $result = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$contenido[$i+$entradas]."'");
                            while($fila = mysql_fetch_array($result)){
                                $html .='<td>'.$fila['descripcion'].'</td>';
                            }
                            $html .='<td>'.$contenido[$i+($entradas*2)].'</td>';
                            $html .='<td>'.$contenido[$i+($entradas*3)].'</td>';
                            /*echo "<td>".$contenido[$i]."</td>";
                            echo "<td>".$contenido[$i+$entradas]."</td>";
                            echo "<td>".$contenido[$i+($entradas*2)]."</td>";
                            echo "<td>".$contenido[$i+($entradas*3)]."</td>";*/
                            $html .='</tr>';
                        }
    $html .='
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="contenedor">
                <table class="tabla">
                    <thead>
                    <tr class="trborder">
                        <th class="thlabel" colspan="12" style="font-size: 16px;">Fotografía de Embolsado y Etiquetado</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>';
                        for($i=0;$i<4;$i++){
                            $file = null;
                            $filenamejpg = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.jpg';
                            $filenamejpeg = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.jpeg';
                            $filenamegif = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.gif';
                            $filenamepng = 'Fotografias/'.$_POST['idProd'].'-etiq'.$i.'.png';
                            if(file_exists($filenamejpg)){
                                $file=$filenamejpg;
                            } elseif(file_exists($filenamejpeg)){
                                $file=$filenamejpeg;
                            } elseif(file_exists($filenamegif)){
                                $file=$filenamegif;
                            } elseif(file_exists($filenamepng)){
                                $file=$filenamepng;
                            }
                            if($file === null){
                            }else{
                                $html .='<td><img src='.$file.' alt="Fotografia de Embolsado" height="200" width="auto"/></td>';
                            }
                        }
    $html .='
                    </tr>
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
                    <h4>Hoja de Especificaciones</h4>
                    <span class="desctitulo">PROD '.$_POST['idProd'].'</span>
                </div>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
               <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
          </div>
    ';
    $nombrearchivo='HEEtiquetadoyEmpaquetado'.$_POST['idProd'].'.pdf';
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