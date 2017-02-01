<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto_id"])) {
    $talla ="SELECT DISTINCT idTalla FROM TallaMedida WHERE idProducto = '" . $_POST["producto_id"] . "'";
    $result=mysql_query($talla);
    while($fila=mysql_fetch_array($result)) {
        echo "
            <option value=".$fila["idTalla"].">".$fila["idTalla"]."</option>
       ";
    }
}
?>