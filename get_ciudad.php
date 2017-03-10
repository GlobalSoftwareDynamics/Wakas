<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["pais_id"])) {
    $ciudad ="SELECT * FROM Ciudad WHERE idPais = '" . $_POST["pais_id"] . "'";
    $result=mysql_query($ciudad);
    while($fila=mysql_fetch_array($result)) {
       echo "
            <option value=".$fila["idCiudad"].">".$fila["nombre"]."</option>
       ";
    }
}
?>