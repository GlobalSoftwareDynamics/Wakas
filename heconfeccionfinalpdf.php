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
            
            <section class="contenedor col-sm-12">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                        <th class="thlabel" colspan="3">Confeccion</th>
</tr>
                        <tr class="borderbottom">';

                            $idSubProcesoCaracteristica = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO30' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $idSubProcesoCaracteristica[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['descripcion'] === 'Observaciones de Confeccion'){
                                    } elseif ($fila2['descripcion'] === 'Maquina- Hoja Tiempos'){
                                    } elseif ($fila2['descripcion'] === 'Tiempo'){
                                    } elseif ($fila2['descripcion'] === 'Componente'){
                                        $html .= "<th>Parte</th>";
                                    } else {
                                        $html .= "<th>".$fila2['descripcion']."</th>";
                                    }
                                }
                            }
                            $html .='
                        </tr>
                        </thead>
                        <tbody>';

                        $auxcomp = 0;
                        $auxproced = 0;
                        $auxindicacion = 0;
                        $componente = array();
                        $procedimiento = array();
                        $indicacion = array();
                        $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while($fila = mysql_fetch_array($result)){
                            $result2 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ORDER BY LENGTH (id) ASC");
                            while($fila2 = mysql_fetch_array($result2)){
                                if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC23'){   //CAMBIAR AL DEJAR FIJO!!!!!
                                    $componente[$auxcomp] = $fila2['valor'];
                                    $auxcomp++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC24'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $procedimiento[$auxproced] = $fila2['valor'];
                                    $auxproced++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC25'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $indicacion[$auxindicacion] = $fila2['valor'];
                                    $auxindicacion++;
                                }
                            }
                        }
                        for($j = 0; $j < $auxcomp; $j++){
                            $html .= "<tr>";
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$componente[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    $html .= "<td class='tdobservacion'>".$fila2['descripcion']."</td>";
                                }
                            }
                            $result = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$procedimiento[$j]."'");
                            while($fila = mysql_fetch_array($result)){
                                $html .= "<td>".$fila   ['descripcion']."</td>";
                            }
                            $html .= "<td>".$indicacion[$j]."</td>";
                            $html .= "</tr>";
                        }
    $html .='
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="contenedor col-sm-12">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <th class="thlabel">Observaciones</th>
                        </tr>
                        </thead>
                        <tbody>';
                        $aux = 0;
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $componente = $fila3['idComponente'];
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica");
                            while ($fila4 = mysql_fetch_array($result4)){
                                for($j=0;$j<count($idSubProcesoCaracteristica);$j++){
                                    if($idSubProcesoCaracteristica[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'observacion'){
                                            if($fila4['valor']===''||$fila4['valor']===null){

                                            }else {
                                                if ($aux === 0) {
                                                    $aux++;
                                                } else {
                                                    $html .= "</tr>";
                                                }
                                                $html .= "<tr>";
                                                $html .= "<td class='observacion'>" . $fila4['valor'] . "</td>";
                                            }
                                        } else {
                                        }
                                    }
                                }
                            }
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
                <img style="margin-top: 20px" width="auto" height="60" src="image/WakasPDF.png"/>
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
                <span style="font-size: 10px;">Waka-s Textiles Finos SAC. </span>
                                   
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo='HEConfeccion'.$_POST['idProd'].'.pdf';
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