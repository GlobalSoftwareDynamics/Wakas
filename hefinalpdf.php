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
            <div class="descladoizquierdoHE">
                <div>
                    <div>
                        <div>
                            <span class="label">ID Producto:</span>
                            <span>'.$_POST['idProd'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">ID Provisional:</span>';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['idProvisional'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">Tipo:</span>';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);

    $html .='
                            <span>'.$fila['idTipoProducto'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">Género:</span>
                        ';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);

    $html .='
                            <span>'.$fila['idgenero'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">ID Cliente:</span>';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['idCliente'].'</span>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div>
                            <span class="label">Fecha de Creación:</span>';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['fechaCreacion'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">Creado por:</span>';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['creador'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">Versión:</span>';
                                $result = selectTableWhere("ModificacionHE","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['version'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">Fecha de Modificación:</span>';
                                $result = selectTableWhere("ModificacionHE","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['fechaModificacion'].'</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span class="label">Modificado Por:</span>';
                                $result = selectTableWhere("ModificacionHE","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);
    $html .='
                            <span>'.$fila['idEmpleado'].'</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <br><br>
                    <table class="tablaobservacionesHEgeneral" border="1">
                        <thead>
                        <tr>
                            <td class="thlabel">Observaciones Generales</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>';
                                $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                                $fila=mysql_fetch_array($result);

    $html .='
                            <td class="observacion">'.$fila['observaciones'].'</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="descladoderechoHE">
                <table class="tablaobservacionesHEgeneral" border="1">
                    <thead>
                    <tr>
                        <td class="thlabel">Descripción General</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>';
                            $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
                            $fila=mysql_fetch_array($result);

    $html .='
                        <td class="observacion">'.$fila['descripcionGeneral'].'</td>;
                    </tr>
                    <tr>';

                        $file = null;
                        $filenamejpg = 'Fotografias/'.$_POST['idProd'].'-prod.jpg';
                        $filenamejpeg = 'Fotografias/'.$_POST['idProd'].'-prod.jpeg';
                        $filenamegif = 'Fotografias/'.$_POST['idProd'].'-prod.gif';
                        $filenamepng = 'Fotografias/'.$_POST['idProd'].'-prod.png';
                        if(file_exists($filenamejpg)){
                            $file=$filenamejpg;
                        } elseif(file_exists($filenamejpeg)){
                            $file=$filenamejpeg;
                        } elseif(file_exists($filenamegif)){
                            $file=$filenamegif;
                        } elseif(file_exists($filenamepng)){
                            $file=$filenamepng;
                        } else{
                            $html.= "No existe foto para el producto";
                        }
                        $i=0;
                        $talla = array();
    $result = mysql_query("SELECT * FROM Producto WHERE idProducto = '".$_POST['idProd']."'");
    while ($fila = mysql_fetch_array($result)){
        $result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$fila['idcodificacionTalla']."' ORDER BY LENGTH (idTalla) ASC");
        while ($fila = mysql_fetch_array($result)){
            $talla[$i] = $fila['descripcion'];
            $i++;
        }
    }
                        
    $html .='
                        <td><img alt="Fotografia de Producto" height="300" width="auto" src="'.$file.'"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
    
                <hr>
                
                <section class="contenedor col-sm-12">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <th class="thlabel" colspan="'.($i+4).'">Medidas</th>
                        </tr>
                        <tr class="borderbottom">
                            <th></th>
                            <th></th>';

    for($j=0;$j<count($talla);$j++){
        $html .="<th>".$talla[$j]."</th>";
    }
/*
                            $result = mysql_query("SELECT * FROM Producto WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila = mysql_fetch_array($result)){
                                $result = mysql_query("SELECT * FROM Talla WHERE idcodificacionTalla = '".$fila['idcodificacionTalla']."' ORDER BY LENGTH (idTalla) ASC");
                                while ($fila = mysql_fetch_array($result)){
                                    $html .="<th class='thlabel'>".$fila['descripcion']."</th>";
                                }
                            }*/
$html .='
                            <th>Unidad</th>
                            <th>T(+/-)</th>
                        </tr>
                        </thead>
                        <tbody>';

                        $result = mysql_query("SELECT DISTINCT idMedida FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."'  ORDER BY LENGTH (idTalla) ASC");
                        while($fila = mysql_fetch_array($result)){
                            $html .= "<tr>";
                            $result2 = mysql_query("SELECT * FROM Medida WHERE idMedida = '".$fila['idMedida']."'");
                            while($fila2 = mysql_fetch_array($result2)){
                                $html .="<th class='thlabel2'>".$fila2['descripcion']."</th>";
                                $html .="<th class='thlabel2'>".$fila2['idMedida']."</th>";
                                $unidadMedida = $fila2['idUnidadMedida'];
                            }
                            $result3 = mysql_query("SELECT * FROM TallaMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$fila['idMedida']."' ORDER BY LENGTH (idTalla) ASC");
                            while ($fila3 = mysql_fetch_array($result3)){
                                $html .="<td>".$fila3['valor']."</td>";
                            }
                            $html .="<td>".$unidadMedida."</td>";
                            $result4 = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."' AND idMedida = '".$fila['idMedida']."'");
                            while ($fila4 = mysql_fetch_array($result4)){
                                $html .="<td>".$fila4['tolerancia']."</td>";
                            }
                            $html .="</tr>";
                        }
                        $html .='
                        </tbody>
                    </table>
                </div>
            </section>
                
<hr>

            <section class="contenedor">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <td class="thlabel">Observaciones - Medidas</td>
                        </tr>
                        </thead>
                        <tbody>';
                                    $result2 = mysql_query("SELECT * FROM ProductoMedida WHERE idProducto = '".$_POST['idProd']."'");
                                    while($fila2 = mysql_fetch_array($result2)){
                                        if($fila2['observacion']===''||$fila2['observacion']=== null){
                                        }else {
                                            $html .= '<tr>';
                                            $html .= '<td class="observacion">' . $fila2['observacion'] . '</td>';
                                            $html .= '</tr>';
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
    $nombrearchivo='HEDatosGenerales'.$_POST['idProd'].'.pdf';
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