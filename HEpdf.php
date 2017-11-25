<?php
//session_start();

require_once __DIR__ . '/lib/mpdf/mpdf.php';

$link = mysqli_connect("localhost", "root", "", "seapp");

mysqli_query($link,"SET NAMES 'utf8'");

//if(isset($_SESSION['login'])){

    $html='
        <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>             PLACEHOLDER         </title>
	<link href="css/bootstrap.css" rel="stylesheet">
    <script>
        function getCiudad(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:\'infoEmpresas_pais=\'+val,
                success: function(data){
                    $("#ciudad").html(data);
                }
            });
        }
        </script>
    </head>
    
    <body>
    <header>';
        include_once('navbarMainAdminRRHH.php');
    $html='
    </header>
    ';
        if(isset($_POST['submit'])){
            $insert = mysqli_query($link, "INSERT INTO Telefono VALUES ('".$_POST['telefono']."')");
            $insert = mysqli_query($link, "INSERT INTO Sede(ruc,idCiudad,telefono,direccion,estado) VALUES ('".$_POST['ruc']."','".$_POST['ciudad']."','".$_POST['telefono']."','".$_POST['direccion']."',1)");
        }

        if(isset($_POST['delete'])){
            $delete = mysqli_query($link, "UPDATE Sede SET estado = 0 WHERE idSede = '".$_POST['idSede']."'");
        }

        if(isset($_POST['modify'])){
            $modify = mysqli_query($link, "SET foreign_key_checks = 0");
            $modify = mysqli_query($link, "UPDATE Telefono SET numero = '".$_POST['telefono']."' WHERE numero = '".$_POST['telefonoant']."'");
            $modify = mysqli_query($link, "UPDATE Sede SET direccion = '".$_POST['direccion']."', telefono = '".$_POST['telefono']."' WHERE idSede = '".$_POST['idSede']."'");
            $modify = mysqli_query($link, "SET foreign_key_checks = 1");
        }

        $html='
        <section class="container">
            <div class="col-sm-4">
                <div class="col-sm-8">
                    <h3 class="text-center">Ficha de Empresa</h3>
                </div>
                <div class="col-sm-12">
        ';
        $query = mysqli_query($link,"SELECT * FROM Empresa WHERE ruc = '".$_POST['ruc']."'");
        while($row = mysqli_fetch_array($query)){
            $razonSocial = $row['razonSocial'];
            $siglas = $row['siglas'];
            $alcance = $row['detalleAlcance'];
            $estado = $row['estado'];
            $query2 = mysqli_query($link, "SELECT * FROM TipoEmpresa WHERE idTipoEmpresa = '".$row['idTipoEmpresa']."'");
            while($row2 = mysqli_fetch_array($query2)){
                $tipoEmpresa = $row2['descripcion'];
            }
        }
        $html='
        <div>
                <p>&nbsp;RUC: <?php echo $_POST[\'ruc\'];?></p>
                <p>&nbsp;Razón Social: <?php echo $razonSocial;?></p>
                <p>&nbsp;Siglas: <?php echo $siglas;?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="col-sm-3 col-sm-offset-9">
            <br>
            <img width="auto" height="100" src="image/Logo.png"/>
        </div>
    </div>
</section>

<section class="container">

</section>

<hr>

<section class="container">
	<div>
		<div>
			<h4>Sedes de la Empresa</h4>
		</div>
		<div>
			<table class="table">
				<thead>
				<tr>
					<th class="text-center">Ciudad de Ubicación</th>
					<th class="text-center">Dirección</th>
					<th class="text-center">Teléfono</th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody>
        ';

$query = mysqli_query($link, "SELECT * FROM Sede WHERE ruc = '".$_POST['ruc']."' AND estado = 1");
while($row = mysqli_fetch_array($query)){
	$query2 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '".$row['idCiudad']."'");
	while($row2 = mysqli_fetch_array($query2)){
		$ciudad = $row2['nombre'];
	}
	echo "
                        <tr>
						<td class=\"text-center\">".$ciudad."</td>
						<td class=\"text-center\">".$row['direccion']."</td>
						<td class=\"text-center\">".$row['telefono']."</td>
						<form method='post' action='#' id='modify'>
							<td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarSedes.php'></td>
							<input type='hidden' value='".$row['ruc']."' name='ruc'>
							<input type='hidden' value='".$row['idSede']."' name='idSede'>
						</form>
						<form method='post' action='#'>
							<td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
							<input type='hidden' value='".$row['ruc']."' name='ruc'>
							<input type='hidden' value='".$row['idSede']."' name='idSede'>
						</form>
						</tr>
						";
}

$html='
</tbody>
			</table>
		</div>
	</div>
</section>

<section class="container">
    <button type="button" class="btn btn-primary col-sm-2 col-sm-offset-5" data-toggle="modal" data-target="#myModal">Agregar Sede</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nueva Sede" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nueva Sede</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><label for="pais">País</label></th>
                                    <th class="text-center"><label for="ciudad">Ciudad</label></th>
                                    <th class="text-center"><label for="direccion">Dirección</label></th>
                                    <th class="text-center"><label for="telefono">Teléfono</label></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><select id="pais" name="ciudad" onchange="getCiudad(this.value);" class="form-control">
                                            <option>Seleccionar</option>
';
                                                $query = mysqli_query($link,"SELECT * FROM Pais");
                                                while($row = mysqli_fetch_array($query)){
                                                    echo "<option value='".$row['idPais']."'>".$row['nombre']."</option>";
                                                }
$html='

';





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
                </div>
                
                <div>
                    <br><br>
                    <table class="tablaobservacionesHEgeneral" border="1">
                        <thead>
                        <tr>
                            <td class="thlabel">Observaciones Generales</td>
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
                        <td class="thlabel">Descripción General</td>
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
        $html.= "<td>No existe foto para el producto</td>";
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
                
                <section class="contenedor">
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
            
            <pagebreak>
            
            <section class="contenedor">
                <div>
                    <table class="tabla">
                        <thead>
                        <tr class="trborder">
                            <td colspan="6" class="thlabel">Tejido</td>
                        </tr>
                        <tr class="borderbottom">';
                            $caracteristicas = array();
                            $tipo = array();
                            $i = 0;
                            $result = mysql_query("SELECT * FROM `SubProcesoCaracteristica` WHERE `idProcedimiento` = 'PROCEDIMIENTO1' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica;");
                            while ($fila = mysql_fetch_array($result)){
                                $caracteristicas[$i] = $fila['idSubProcesoCaracteristica'];
                                $tipo[$i] = $fila['tipo'];
                                $i++;
                                $result2 = selectTableWhere('caracteristica','idCaracteristica',"'".$fila['idCaracteristica']."'");
                                while($fila2 = mysql_fetch_array($result2)){
                                    if($fila2['tipo']==='observacion'){

                                    }elseif($fila2['tipo']==='tiempo'){
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
                            $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila3 = mysql_fetch_array($result3)){
                                $componente = $fila3['idComponente'];
                                $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."' ORDER BY LENGTH(idSubProcesoCaracteristica), idSubProcesoCaracteristica");
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
                                                    $result6 = mysql_query("SELECT * FROM Material WHERE idMaterial = '".$fila3['idMaterial']."'");
                                                    while($fila6 = mysql_fetch_array($result6)){
                                                        $html .='<td>'.$fila6['material'].'</td>';
                                                    }
                                                }
                                            } elseif ($tipo[$j] === 'maquina'){
                                                $result5 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$fila4['valor']."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    $html .='<td>'.$fila5['descripcion'].'</td>';
                                                }
                                            } elseif ($tipo[$j] === 'galga'){
                                                $galgas = array();
                                                $galgas = explode(',',$fila4['valor']);
                                                $html .='<td>';
                                                for($i=0;$i<count($galgas);$i++){
                                                    $result5 = mysql_query("SELECT * FROM Galgas WHERE idGalgas = '".$galgas[$i]."'");
                                                    while ($fila5 = mysql_fetch_array($result5)){
                                                        $html .=$fila5['Descripcion'];
                                                    }
                                                    if(($i+1) < count($galgas)){
                                                        $html .=', ';
                                                    }
                                                }
                                                $html .='</td>';
                                            }elseif ($tipo[$j] === 'observacion'){
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
                            <td colspan="5" class="thlabel">Requerimiento Promedio de Material</td>
                        </tr>
                        <tr class="borderbottom">
                            <th>Componente</th>
                            <th>Material</th>
                            <th>Color</th>
                            <th>Unidad de Medida</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>';
                            $cantidadMaterial = 0;
                            $k = 0;
                            $resumenMateriales = array();
                            $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."'");
                            while ($fila3 = mysql_fetch_array($result3)){
                                $componente = $fila3['idComponente'];
                                $html .='<tr>';
                                $result4 = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '".$fila3['idComponenteEspecifico']."'");
                                while ($fila4 = mysql_fetch_array($result4)){
                                    for($j=0;$j<count($caracteristicas);$j++){
                                        if($caracteristicas[$j] === $fila4['idSubProcesoCaracteristica']){
                                            if($tipo[$j] === 'componente'){
                                                $result5 = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '".$componente."'");
                                                while ($fila5 = mysql_fetch_array($result5)){
                                                    $html .='<td>'.$fila5['descripcion'].'</td>';
                                                }
                                            }
                                        }
                                    }

                                }
                                $result4 = mysql_query("SELECT * FROM Material WHERE idMaterial = '".$fila3['idMaterial']."'");
                                while ($fila4 = mysql_fetch_array($result4)){
                                    $html .='<td>'.$fila4['material'].'</td>';
                                    $html .='<td>'.$fila3['idColor'].'</td>';
                                    $html .='<td>'.$fila4['idUnidadMedida'].'</td>';
                                    $html .='<td>'.$fila3['cantidadMaterial'].'</td>';
                                    if(isset($resumenMateriales[$fila3['idMaterial']][$fila3['idColor']])){
                                        $resumenMateriales[$fila3['idMaterial']][$fila3['idColor']] += $fila3['cantidadMaterial'];
                                    }else{
                                        $resumenMateriales[$fila3['idMaterial']][$fila3['idColor']] = $fila3['cantidadMaterial'];
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
                            <td colspan="3" class="thlabel">Resumen de Materiales</td>
                        </tr>
                        <tr class="borderbottom">
                            <th>Material</th>
                            <th>Color</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>';
                            $materialRepetido = array();
                            $colorRepetido = array();
                            $puntero = 0;
                            mysql_data_seek($result3, 0);
                            $result3 = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['idProd']."' ORDER BY `productocomponentesprenda`.`idMaterial` ASC") ;
                            while ($fila3 = mysql_fetch_array($result3)){
                                $bandera = false;
                                $html .='<tr>';
                                $materialRepetido[$puntero] = $fila3['idMaterial'];
                                $colorRepetido[$puntero] = $fila3['idColor'];
                                for($l = 0; $l<$puntero;$l++){
                                    if($materialRepetido[$l] === $fila3['idMaterial'] && $colorRepetido[$l] === $fila3['idColor']){
                                        $bandera = true;
                                    }
                                }
                                if($bandera){

                                }else{
                                    $result4 = mysql_query("SELECT * FROM Material WHERE idMaterial = '".$fila3['idMaterial']."'");
                                    while($fila4 = mysql_fetch_array($result4)){
                                        $html .='<td>'.$fila4['material'].'</td>';
                                        $html .='<td>'.$fila3['idColor'].'</td>';
                                        $html .='<td>'.$resumenMateriales[$fila3['idMaterial']][$fila3['idColor']].'</td>';
                                    }
                                }
                                $puntero++;
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
                                <td class="thlabel">Observaciones</td>
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
            
            <pagebreak>
            
            
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
                                    } elseif($fila2['tipo']==='tiempo'){
                                    } else{
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
                                    }elseif($fila2['tipo']==='tiempo'){
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
            
            <pagebreak>
            
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
            
            <pagebreak>
            
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
            
            <pagebreak>
            
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
                <span style="font-size: 10px;">Waka-s Textiles Finos SAC. </span>
                                   
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo='Hoja de Especificación '.$_POST['idProd'].'.pdf';
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