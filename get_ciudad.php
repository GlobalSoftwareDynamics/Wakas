<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["pais_id"])) {
    $ciudad ="SELECT * FROM Ciudad WHERE idPais = '" . $_POST["pais_id"] . "'";
    $result=runQuery($ciudad);
    foreach($result as $fila) {
       echo "
            <option value=".$fila["idCiudad"].">".$fila["nombre"]."</option>
       ";
    }
}
?>