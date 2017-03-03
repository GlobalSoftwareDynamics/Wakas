<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["pais_id"])) {
    $ciudad =mysql_query("SELECT * FROM Ciudad WHERE idPais = '" . $_POST["pais_id"] . "'");
    while($result=mysql_fetch_array($ciudad)){
        echo "
            <option value=".$result["idCiudad"].">".$result["nombre"]."</option>
       ";
    }
}
?>