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
                            <th colspan="8" class="thlabel">Lavado</th>
                        </tr>
                        <tr class="borderbottom">';
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO2' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['tipo']==='observacion'){
                                    }else{
                                        $html .='<th>'.$fila2['descripcion'].'</th>';
                                    }
                                }
                            }
    $html .='
                        </tr>
                        </thead>
                        <tbody>';
                        $aux = 0;
                        $cantidades = array();
                        $insumo = 0;
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $componente = $fila3['idComponente'];
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY idComponenteEspecifico ASC, LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila4 = mysql_fetch_array($result4)){
                                for($j=0;$j<count($caracteristicas);$j++){
                                    if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'componente'){
                                            if($aux === 0){
                                                $aux++;
                                            }else{
                                                $html .='</tr>';
                                            }
                                            $html .='<tr>';
                                            $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['descripcion'].'</td>';
                                            }
                                        } elseif ($tipo[$j] === 'maquina'){
                                            $result5 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila4['valor']."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['descripcion'].'</td>';
                                            }
                                        } elseif ($tipo[$j] === 'insumo1'){
                                            $result5 = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$fila4['valor']."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['descripcion'].'</td>';
                                                $insumo = $fila5['descripcion'];
                                            }
                                        } elseif ($tipo[$j] === 'insumo2'){
                                            $result5 = mysql_query("SELECT * FROM Insumos WHERE idInsumo = '".$fila4['valor']."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['descripcion'].'</td>';
                                                $insumo = $fila5['descripcion'];
                                            }
                                        } elseif ($tipo[$j] === 'cantidad'){
                                            if(isset($cantidades[$insumo])){
                                                $cantidades[$insumo] += $fila4['valor'];
                                            }else{
                                                $cantidades[$insumo] = $fila4['valor'];
                                            }
                                            $html .='<td>'.$fila4['valor'].'</td>';
                                        } elseif ($tipo[$j] === 'observacion'){
                                        } else {
                                            $html .='<td>'.$fila4['valor'].'</td>';
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

            <section class="contenedor">
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
                                for($j=0;$j<count($caracteristicas);$j++){
                                    if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'observacion'){
                                            if($fila4['valor']===''||$fila4['valor']===null){

                                            }else {
                                                if ($aux === 0) {
                                                    $aux++;
                                                } else {
                                                    $html .= '</tr>';
                                                }
                                                $html .= '<tr>';
                                                $html .= '<td class="tdleft">' . $fila4['valor'] . '</td>';
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

            <section class="contenedor">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <th colspan="5" class="thlabel">Secado</th>
                        </tr>
                        <tr class="borderbottom">';
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO6' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['tipo']==='observacion'){
                                    }else{
                                        $html .='<th>'.$fila2['descripcion'].'</th>';
                                    }
                                }
                            }
    $html .='
                        </tr>
                        </thead>
                        <tbody>';
                        $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                        while ($fila3 = mysql_fetch_array($result3)){
                            $componente = $fila3['idComponente'];
                            $html .='<tr>';
                            $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY id");
                            while ($fila4 = mysql_fetch_array($result4)){
                                for($j=0;$j<count($caracteristicas);$j++){
                                    if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'componente'){
                                            $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['descripcion'].'</td>';
                                            }
                                        } elseif ($tipo[$j] === 'maquina'){
                                            $result5 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila4['valor']."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['descripcion'].'</td>';
                                            }
                                        } elseif ($tipo[$j] === 'galga'){
                                            $result5 = mysql_query("SELECT * FROM Galgas WHERE idGalgas = '".$fila4['valor']."'");
                                            while ($fila5 = mysql_fetch_array($result5)){
                                                $html .='<td>'.$fila5['Descripcion'].'</td>';
                                            }
                                        } elseif ($tipo[$j] === 'observacion'){

                                        } else {
                                            $html .='<td>'.$fila4['valor'].'</td>';
                                        }
                                    }
                                }
                            }
                            $html .='</tr>';
                        }
    $html .='
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="contenedor">
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
                                for($j=0;$j<count($caracteristicas);$j++){
                                    if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                        if($tipo[$j] === 'observacion'){
                                            if($fila4['valor']===''||$fila4['valor']===null){

                                            }else {
                                                if ($aux === 0) {
                                                    $aux++;
                                                } else {
                                                    $html .= '</tr>';
                                                }
                                                $html .= '<tr>';
                                                $html .= '<td class="tdleft">' . $fila4['valor'] . '</td>';
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

            <section class="contenedor">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <th colspan="3" class="thlabel">Resumen de Insumos de Lavado</th>
                        </tr>
                        <tr class="borderbottom">
                            <th>Insumo</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>';
                        $result = mysql_query("SELECT * FROM Insumos");
                        while($fila = mysql_fetch_array($result)){
                            if(isset($cantidades[$fila['descripcion']])){
                                $html .='<tr>';
                                $html .='<td>'.$fila['descripcion'].'</td>';
                                $html .='<td>'.$fila['idUnidadMedida'].'</td>';
                                $html .='<td>'.$cantidades[$fila['descripcion']].'</td>';
                                $html .='</tr>';
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
    $nombrearchivo='HELavadoSecado'.$_POST['idProd'].'.pdf';
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