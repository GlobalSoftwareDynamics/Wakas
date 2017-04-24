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
                            <th class="thlabel" colspan="6">Hoja de Tiempos y Secuencias</th>
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
                                    if($fila2['descripcion'] === 'Componente'){
                                    }else{
                                        $html.= "<th>".$fila2['descripcion']."</th>";
                                    }

                                }
                            }
$html.='
                        </tr>
                        </thead>
                        <tbody>';

                            $auxcomp = 0;
                            $auxproced = 0;
                            $auxmaquina = 0;
                            $auxtiempo = 0;
                            $auxfila = 0;
                            $filaproceso = array();
                            $componente = array();
                            $procedimiento = array();
                            $maquina = array();
                            $tiempo = array();
                            $string = null;
                            $bandera = false;
                            $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while($fila = mysql_fetch_array($result)) {
                                if($bandera == false){
                                    $string = $string."idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ";
                                    $bandera = true;
                                }else{
                                    $string = $string."OR idComponenteEspecifico = '".$fila['idComponenteEspecifico']."' ";
                                }
                            }
                            $query ="SELECT * FROM PCPSPC WHERE ".$string." ORDER BY LENGTH (id)";
                            $result2 = mysql_query($query);
                            while($fila2 = mysql_fetch_array($result2)){
                                if($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC32'){   //CAMBIAR AL DEJAR FIJO!!!!!
                                    $componente[$auxcomp] = $fila2['valor'];
                                    $auxcomp++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC34'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $procedimiento[$auxproced] = $fila2['valor'];
                                    $auxproced++;
                                    $filaproceso[$auxfila] = $fila2['fila'];
                                    $auxfila++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC35'||$fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC39'||$fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC41'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $maquina[$auxmaquina] = $fila2['valor'];
                                    $auxmaquina++;
                                } elseif ($fila2['idSubProcesoCaracteristica'] === 'SUBPROCESOCARAC36'){    //CAMBIAR AL DEJAR FIJO!!!!!
                                    $tiempo[$auxtiempo] = $fila2['valor'];
                                    $auxtiempo++;
                                }
                            }
                            for($j = 0; $j < $auxcomp; $j++){
                                $html .= "<tr>";
                                $result = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '".$componente[$j]."'");
                                while($fila = mysql_fetch_array($result)){
                                    $result2 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$fila['idComponente']."'");
                                    while($fila2 = mysql_fetch_array($result2)){
                                        $prenda = $fila2['descripcion'];
                                    }
                                }
                                $result = mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '".$procedimiento[$j]."'");
                                while($fila = mysql_fetch_array($result)){
                                    if($procedimiento[$j]==='PROCEDIMIENTO26'){
                                        $query = mysql_query("SELECT * FROM PCPSPC WHERE fila = '".$filaproceso[$j]."' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC29'");
                                        while($row = mysql_fetch_array($query)){
                                            $insumo = $row['valor'];
                                        }
                                        $query = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$insumo."'");
                                        while($row = mysql_fetch_array($query)){
                                            $insumo = $row['descripcion'];
                                        }
                                        $html .= "<td>".$fila['idProcedimiento']."</td>";
                                        $result2 = mysql_query("SELECT * FROM Proceso WHERE idProceso = '".$fila['idProceso']."'");
                                        while($fila2 = mysql_fetch_array($result2)){
                                            $html .= "<td>".$fila2['descripcion']."-".$insumo."-".$prenda."</td>";
                                        }
                                    }else{
                                        $html .= "<td>".$fila['idProcedimiento']."</td>";
                                        $result2 = mysql_query("SELECT * FROM Proceso WHERE idProceso = '".$fila['idProceso']."'");
                                        while($fila2 = mysql_fetch_array($result2)){
                                            $html .= "<td>".$fila2['descripcion']."-".$fila['descripcion']."-".$prenda."</td>";
                                        }
                                    }
                                }
                                $result = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$maquina[$j]."'");
                                while($fila = mysql_fetch_array($result)){
                                    $html .= "<td>".$fila['descripcion']."</td>";
                                }
                                $html .= "<td>".$tiempo[$j]."</td>";
                                $html .= "</tr>";
                            }
    $html.='
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
               <span style="font-size: 10px">Waka-s Textiles Finos SAC</span>
          </div>
    ';
    $nombrearchivo='HETiempos'.$_POST['idProd'].'.pdf';
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