<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idlote"])) {
    $producto =mysql_query("SELECT * FROM lote WHERE idLote = '" . $_POST["idlote"] . "' AND estado ='1'");
    while($result2=mysql_fetch_array($producto)){
        echo "<input type='hidden' name='producto' id='product' value=".$result2['idProducto'].">";
    }
}
?>