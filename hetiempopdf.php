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
                            <th colspan="6" class="thlabel">Hoja de Tiempos y Secuencias</th>
                        </tr>
                        <tr class="borderbottom">';
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO32' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
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
                            //$result4 = mysql_query("SELECT DISTINCT pcpspc.* FROM `PCPSPC`,`SubProcesoCaracteristica` WHERE pcpspc.idSubProcesoCaracteristica = subprocesocaracteristica.idSubProcesoCaracteristica AND subprocesocaracteristica.idProcedimiento = \'PROCEDIMIENTO32\' AND pcpspc.idComponenteEspecifico = \'".$compespec[$j]."\' ORDER BY LENGTH (id),idSubProcesoCaracteristica");
                            $result4 = mysql_query("SELECT DISTINCT pcpspc.* FROM `PCPSPC`,`SubProcesoCaracteristica` WHERE pcpspc.idSubProcesoCaracteristica = subprocesocaracteristica.idSubProcesoCaracteristica AND subprocesocaracteristica.idProcedimiento = 'PROCEDIMIENTO32' AND pcpspc.idComponenteEspecifico = '".$compespec[$j]."' ORDER BY `PCPSPC`.`id` ASC ");
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
                        for ($i = 0; $i < count($contenido); $i=$i+4) {
                            $html .='<tr>';
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$contenido[$i]."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    $html .='<td>'.$fila2['descripcion'].'</td>';
                                }
                            }
                            $html .='<td>'.$contenido[$i+1].'</td>';
                            $result = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$contenido[$i+1]."'");
                            while($fila = mysql_fetch_array($result)){
                                $html .='<td>'.$fila['descripcion'].'</td>';
                            }
                            $result = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$contenido[$i+2]."'");
                            while($fila = mysql_fetch_array($result)){
                                $html .='<td>'.$fila['descripcion'].'</td>';
                            }
                            //echo "<td>".$contenido[$i+($entradas*2)]."</td>";
                            $html .='<td>'.$contenido[$i+3].'</td>';
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
    $nombrearchivo='HETiempos'.$_POST['idProd'].'.pdf';
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