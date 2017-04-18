<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["producto"])) {
    echo "<option>Selecc.</option>";
    $producto =mysql_query("SELECT DISTINCT idColor FROM ConfirmacionVentaProducto WHERE idProducto = '" . $_POST["producto"] . "' AND idContrato ='". $_POST["contrato"] ."' AND estado = '1'");
    while($result2=mysql_fetch_array($producto)){
        echo "<option value=".$result2['idColor'].">".$result2['idColor']."</option>";
    }
}
?>