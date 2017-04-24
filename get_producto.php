<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["contrato"])) {
    echo "<option>Seleccionar</option>";
    $producto =mysql_query("SELECT DISTINCT idProducto FROM ConfirmacionVentaProducto WHERE idContrato = '" . $_POST["contrato"] . "' AND estado ='1'");
    while($result2=mysql_fetch_array($producto)){
        echo "<option value=".$result2['idProducto'].">".$result2['idProducto']."</option>";
    }
}
?>