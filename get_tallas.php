<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST['producto'])) {
    echo "<option>Selecc.</option>";
    $producto =mysql_query("SELECT DISTINCT idTalla FROM ConfirmacionVentaProducto WHERE idProducto = '" . $_POST['producto'] . "' AND idContrato ='". $_POST['contrato'] ."' AND estado = '1'");
    while($result2=mysql_fetch_array($producto)){
        $talla=selectTableWhere('Talla','idTalla',"'".$result2['idTalla']."'");
        while ($fila=mysql_fetch_array($talla)){
            echo "<option value=".$fila['idTalla'].">".$fila['descripcion']."</option>";
        }
    }
}
?>