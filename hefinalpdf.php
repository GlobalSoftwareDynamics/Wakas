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
                            echo "No existe foto para el producto";
                        }
    $html .='
                        <td><img alt="Fotografia de Producto" height="300" width="auto" src="'.$file.'"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <section class="contenedor">
                <div>
                    <div>
                        <table class="tabla">
                            <thead>
                            <tr class="trborder">
                                <th class="thlabel" colspan="12">Medidas</th>
                            </tr>
                            <tr class="borderbottom">
                                <td colspan="2" style="width: 30%;"></td>
                                <td style="width: 6%;">XXS</td>
                                <td style="width: 6%;">XS</td>
                                <td style="width: 6%;">S</td>
                                <td style="width: 6%;">M</td>
                                <td style="width: 6%;">L</td>
                                <td style="width: 6%;">XL</td>
                                <td style="width: 6%;">XXL</td>
                                <td style="width: 6%;">TU</td>
                                <td style="width: 8%;">Unidad</td>
                                <td style="width: 8%;">T +/-</td>
                            </tr>
                            </thead>
                            <tbody>';
                            $bandera2 = false;
                            $contador = 0;
                            $medidasusadas = array();
                            $verificador = false;
                            $result = selectOrderedTable("tallamedida","idMedida");
                            while($fila = mysql_fetch_array($result)) {
                                if($fila['idProducto']==$_POST['idProd']){
                                    //if ($fila['idProducto'] == "PROD1") {
                                    $medidasusadas[$contador] = $fila['idMedida'];
                                    $contador++;
                                    if (isset($medidasusadas[$contador - 2])) {
                                        if ($medidasusadas[($contador - 2)] == $fila['idMedida']) {
                                        } else {
                                            $html .='<tr>';
                                            $med="SELECT * FROM medida WHERE idMedida ='".$fila['idMedida']."'";
                                            $quer=mysql_query($med);
                                            while($fl=mysql_fetch_array($quer)){
                                                $html .='<td class="tdleft">'.$fl['descripcion'].'</td>';
                                            }
                                            $html .='<td>'.$fila['idMedida'].'</td>';
                                            $indice = 0;
                                            $tallas = array();
                                            $valores = array();
                                            //while($fila2 = mysql_fetch_array($result2)){
                                            $result3 = selectTableWhere2("tallamedida","idMedida","'".$fila['idMedida']."'","idProducto","'".$_POST['idProd']."'");
                                            //$result3 = selectTableWhere2("tallamedida", "idMedida", "'" . $fila['idMedida'] . "'", "idProducto", "'"PROD1'");
                                            while ($fila3 = mysql_fetch_array($result3)) {
                                                $tallas[$indice] = $fila3['idTalla'];
                                                $valores[$indice] = $fila3['valor'];
                                                $indice++;
                                            }
                                            $aux = 0;
                                            while ($aux < 9) {

                                                $bandera = false;
                                                switch ($aux) {
                                                    case 0:
                                                        $aux2 = "XXS";
                                                        break;
                                                    case 1:
                                                        $aux2 = "XS";
                                                        break;
                                                    case 2:
                                                        $aux2 = "S";
                                                        break;
                                                    case 3:
                                                        $aux2 = "M";
                                                        break;
                                                    case 4:
                                                        $aux2 = "L";
                                                        break;
                                                    case 5:
                                                        $aux2 = "XL";
                                                        break;
                                                    case 6:
                                                        $aux2 = "XXL";
                                                        break;
                                                    case 7:
                                                        $aux2 = "TU";
                                                        break;
                                                    case 8:
                                                        $aux2 = "Tolerancia";
                                                        break;
                                                    case 9:
                                                        $aux2 = "Observaciones";
                                                        break;
                                                }
                                                for ($i = 0; $i < count($tallas); $i++) {
                                                    if ($tallas[$i] == $aux2) {
                                                        $html .='<td>'.$valores[$i].'</td>';
                                                        $tallarealizada = true;
                                                        $bandera = true;
                                                    }
                                                    if($aux2 == "Tolerancia"){
                                                        if($bandera2){
                                                        }else {
                                                            $resultado = selectTableWhere2("productomedida", "idProducto", "'" . $_POST['idProd'] . "'", "idMedida", "'" . $fila['idMedida'] . "'");
                                                            //selectTableWhere2("productomedida","idproducto",$_POST['idProd'],"idmedida",$fila['idMedida']);
                                                            while ($filasa = mysql_fetch_array($resultado)) {
                                                                $res=selectTableWhere('Medida','idMedida',"'".$filasa['idMedida']."'");
                                                                while ($fil=mysql_fetch_array($res)){
                                                                    $html .='<td>'.$fil['idUnidadMedida'].'</td>';
                                                                }
                                                                $html .='<td>'.$filasa['tolerancia'].'</td>';
                                                            }
                                                            $bandera = true;
                                                            $bandera2 = true;
                                                        }
                                                    }
                                                }
                                                if ($bandera == false) {
                                                    $html .='<td></td>';
                                                }
                                                $aux++;
                                            }
                                            $html .='</tr>';
                                            $bandera2 = false;
                                        }
                                    } else {
                                        $html .='<tr>';
                                        $med="SELECT * FROM medida WHERE idMedida ='".$fila['idMedida']."'";
                                        $quer=mysql_query($med);
                                        while($fl=mysql_fetch_array($quer)){
                                            $html .='<td class="tdleft">'.$fl['descripcion'].'</td>';
                                        }
                                        $html .='<td>'.$fila['idMedida'].'</td>';
                                        $indice = 0;
                                        $tallas = array();
                                        $valores = array();
                                        //while($fila2 = mysql_fetch_array($result2)){
                                        $result3 = selectTableWhere2("tallamedida","idMedida","'".$fila['idMedida']."'","idProducto","'".$_POST['idProd']."'");
                                        //$result3 = selectTableWhere2("tallamedida", "idMedida", "'" . $fila['idMedida'] . "'", "idProducto", "'PROD1'");
                                        while ($fila3 = mysql_fetch_array($result3)) {
                                            $tallas[$indice] = $fila3['idTalla'];
                                            $valores[$indice] = $fila3['valor'];
                                            $indice++;
                                        }
                                        $aux = 0;
                                        while ($aux < 9) {

                                            $bandera = false;
                                            switch ($aux) {
                                                case 0:
                                                    $aux2 = "XXS";
                                                    break;
                                                case 1:
                                                    $aux2 = "XS";
                                                    break;
                                                case 2:
                                                    $aux2 = "S";
                                                    break;
                                                case 3:
                                                    $aux2 = "M";
                                                    break;
                                                case 4:
                                                    $aux2 = "L";
                                                    break;
                                                case 5:
                                                    $aux2 = "XL";
                                                    break;
                                                case 6:
                                                    $aux2 = "XXL";
                                                    break;
                                                case 7:
                                                    $aux2 = "TU";
                                                    break;
                                                case 8:
                                                    $aux2 = "Tolerancia";
                                                    break;
                                                case 9:
                                                    $aux2 = "Observaciones";
                                                    break;
                                            }
                                            for ($i = 0; $i < count($tallas); $i++) {
                                                if ($tallas[$i] == $aux2) {
                                                    $html .='<td>'.$valores[$i].'</td>';
                                                    $tallarealizada = true;
                                                    $bandera = true;
                                                }
                                                if($aux2 == "Tolerancia"){
                                                    if($bandera2){
                                                    }else{
                                                        $resultado = selectTableWhere2("productomedida","idProducto","'".$_POST['idProd']."'","idMedida","'".$fila['idMedida']."'");
                                                        //selectTableWhere2("productomedida","idproducto",$_POST['idProd'],"idmedida",$fila['idMedida\']);
                                                        while($filasa = mysql_fetch_array($resultado)) {
                                                            $res=selectTableWhere('Medida','idMedida',"'".$filasa['idMedida']."'");
                                                            while ($fil=mysql_fetch_array($res)){
                                                                $html .='<td>'.$fil['idUnidadMedida'].'</td>';
                                                            }
                                                            $html .='<td>'.$filasa['tolerancia'].'</td>';
                                                        }
                                                        $bandera = true;
                                                        $bandera2 = true;
                                                    }
                                                }
                                            }



                                            if ($bandera == false) {
                                                $html .='<td></td>';
                                            }
                                            $aux++;
                                        }
                                        $html .='</tr>';
                                        $bandera2 = false;
                                    }
                                }
                            }
    $html .='
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

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