<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["fecha"])) {
    echo "<option>Seleccionar</option>";
    $contrato =mysql_query("SELECT * FROM ConfirmacionVenta WHERE fecha = '" . $_POST["fecha"] . "'");
    while($result2=mysql_fetch_array($contrato)){
        echo "<option value=".$result2['idContrato'].">".$result2['idContrato']."</option>";
    }
}
?>