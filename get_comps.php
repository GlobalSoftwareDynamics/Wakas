<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto"])) {
    echo "<option>Seleccionar</option>";

    $componentes = array();
    $auxcomponentes = 0;
    $filas = array();
    $auxfilas = 0;
    $idvalores = array();
    $auxidvalores = 0;
    $idcomponente = array();
    $auxidcomponente = 0;
    $valores = array();
    $auxvalores = 0;
    $flag = false;
    $select=selectTableWhere('SubProceso','idProcedimiento',"'".$_POST['procedimiento']."'");
    while ($fila=mysql_fetch_array($select)){
        if($fila['idProceso']==="PROCESO6"){
            $_POST['procedimiento']="PROCEDIMIENTO26";
        }
    }
    $query = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '" . $_POST['producto'] . "'");
    while ($row = mysql_fetch_array($query)) {
        $componentes[$auxcomponentes] = $row['idComponenteEspecifico'];
        $auxcomponentes++;
    }

    for ($j = 0; $j < count($componentes); $j++) {
        $query = mysql_query("SELECT * FROM PCPSPC WHERE idComponenteEspecifico = '" . $componentes[$j] . "' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC34' AND valor = '".$_POST['procedimiento']."' ORDER BY LENGTH (id)");
        while ($row = mysql_fetch_array($query)) {
            $filas[$auxfilas] = $row['fila'];
            $auxfilas++;
        }
    }

    for ($j = 0; $j < count($filas); $j++) {
        mysql_data_seek($query, 0);
        $query = mysql_query("SELECT * FROM PCPSPC WHERE fila = '" . $filas[$j] . "' AND idSubProcesoCaracteristica = 'SUBPROCESOCARAC32'");
        while ($row = mysql_fetch_array($query)) {
                $idvalores[$auxidvalores] = $row['valor'];
                $auxidvalores++;
        }
    }

    asort($idvalores);

    for ($j = 0; $j < count($idvalores); $j++) {
        mysql_data_seek($query, 0);
        $query = mysql_query("SELECT * FROM ProductoComponentesPrenda WHERE idComponenteEspecifico = '" . $idvalores[$j] . "'");
        while ($row = mysql_fetch_array($query)) {
            $idcomponente[$auxidcomponente] = $row['idComponente'];
            $auxidcomponente++;
        }
    }

    for ($j = 0; $j < count($idcomponente); $j++) {
        mysql_data_seek($query, 0);
        $query = mysql_query("SELECT * FROM ComponentesPrenda WHERE idComponente = '" . $idcomponente[$j] . "'");
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