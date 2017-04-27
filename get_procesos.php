<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["lote"])) {
    echo "<option>Seleccionar</option>";
    $componentes = array();
    $auxcomponentes = 0;
    $idsubprocesos = array();
    $auxidsubprocesos = 0;
    $filas = array();
    $auxfilas = 0;
    $subprocesos = array();
    $auxsubprocesos = 0;
    $subprocesopasado = null;
    $idvalores = array();
    $auxidvalores = 0;
    $valores = array();
    $auxvalores = 0;
    $flag = false;

    $query=selectTableWhere('Lote','idLote',"'".$_POST['lote']."'");
    while ($row=mysql_fetch_array($query)){
        $producto=$row['idProducto'];
    }
    $query = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '" . $producto . "'");
    while ($row = mysql_fetch_array($query)) {
        $componentes[$auxcomponentes] = $row['idComponenteEspecifico'];
        $auxcomponentes++;
    }

    for ($j = 0; $j < count($componentes); $j++) {
        $query = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '" . $componentes[$j] . "' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC34' ORDER BY LENGTH (id)");
        while ($row = mysql_fetch_array($query)) {
            $query2=selectTableWhere('SubProceso','idProcedimiento',"'".$row['valor']."'");
            while ($row2=mysql_fetch_array($query2)){
                $query1=selectTableWhere('Proceso','idProceso',"'".$row2['idProceso']."'");
                while ($row1=mysql_fetch_array($query1)){
                    $idsubprocesos[$auxidsubprocesos] = $row1['idProceso'];
                    $auxidsubprocesos++;
                    $filas[$auxfilas] = $row['fila'];
                    $auxfilas++;
                }
            }
        }
    }

    for ($j = 0; $j < count($filas); $j++) {
        mysql_data_seek($query, 0);
        $query = mysql_query("SELECT * FROM PCPSPC WHERE fila = '" . $filas[$j] . "' AND (idSubProcesoCaracteristica = 'SUBPROCESOCARAC39' OR idSubProcesoCaracteristica = 'SUBPROCESOCARAC35' OR idSubProcesoCaracteristica = 'SUBPROCESOCARAC41')");
        while ($row = mysql_fetch_array($query)) {
            if ($row['valor'] === 'MAQUINA9') {
                //echo "<option value='" . $idsubprocesos[$j] . "'>" . $subprocesos[$j] . "</option>";
                $idvalores[$auxidvalores] = $idsubprocesos[$j];
                $auxidvalores++;
            }
        }
    }

    sort($idvalores);

    for ($j = 0; $j < count($idvalores); $j++) {
        mysql_data_seek($query, 0);
        $query = mysql_query("SELECT * FROM Proceso WHERE idProceso = '" . $idvalores[$j] . "' ORDER BY idProceso");
        while ($row = mysql_fetch_array($query)) {
            $valores[$auxvalores] = $row['descripcion'];
            $auxvalores++;
        }
    }

    for ($j = 0; $j < count($idvalores); $j++) {
        if(!$flag){
            $flag = true;
            echo "<option value='" . $idvalores[$j] . "'>" . $valores[$j] . "</option>";
        }else{
            if($idvalores[$j-1] == $idvalores[$j]){
            }else{
                echo "<option value='" . $idvalores[$j] . "'>" . $valores[$j] . "</option>";
            }
        }
    }
}
?>