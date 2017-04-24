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
                                    if($fila2['descripcion'] === 'Componente'){
                                    }elseif($fila2['descripcion'] === 'Maquina- Hoja Tiempos'){
                                    }elseif($fila2['descripcion'] === 'Tiempo'){
                                    }else{
                                        $html .= "<th>".$fila2['descripcion']."</th>";
                                    }
                                }
                            }
    $html .='
                        </tr>
                        </thead>
                        <tbody>';
                            $auxcomp = 0;
                            $auxinsumo = 0;
                            $auxmaquina = 0;
                            $auxcantidades = 0;
                            $auxfila = 0;
                            $auxobservacion = 0;
                            $componente = array();
                            $insumo = array();
                            $maquina = array();
                            $cantidades = array();
                            $filaElegida = array();
                            $observaciones = array();
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while($fila = mysql_fetch_array($result)){
                                $result2 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ORDER BY LENGTH (id) ASC");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC27'){   //CAMBIAR AL DEJAR FIJO!!!!!
                                        $componente[$auxcomp] = $fila2['valor'];
                                        $auxcomp++;
                                    } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC28'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                        //28 no se guarda en la bd, es IdInsumo
                                    } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC29'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                        $insumo[$auxinsumo] = $fila2['valor'];
                                        //Procedimiento = IdInsumo
                                        $auxinsumo++;
                                        $filaElegida[$auxfila] = $fila2['fila'];
                                        $auxfila++;
                                    } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC30'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                        //Cantidad
                                        $cantidades[$auxcantidades] = $fila2['valor'];
                                        $auxcantidades++;
                                    } elseif($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC31'){
                                        //Observacion
                                        $observaciones[$auxobservacion] = $fila2['valor'];
                                        $auxobservacion++;
                                    }
                                }
                            }
                            for($j = 0; $j < $auxcomp; $j++){
                                $html .= "<tr>";
                                $result = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$insumo[$j]."'");
                                while($fila = mysql_fetch_array($result)){
                                    $html .= "<td>".$fila['idInsumo']."</td>";
                                    $html .= "<td>".$fila['descripcion']."</td>";
                                }
                                $html .= "<td>".$cantidades[$j]."</td>";
                                $html .= "<td>".$observaciones[$j]."</td>";
                                $html .= "</tr>";
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
                        <th class="thlabel" colspan="12" style="font-size: 12px">Fotografía de Embolsado y Etiquetado</th>
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
               <span style="font-size: 10px">Waka-s Textiles Finos SAC</span>
          </div>
    ';
    $nombrearchivo='HEEtiquetadoyEmpaquetado'.$_POST['idProd'].'.pdf';
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