<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idMaquina"])) {
    echo "<option value='-'>Seleccionar</option>";
    $componente =mysql_query("SELECT * FROM Galgas WHERE idMaquina = '" . $_POST["idMaquina"] . "' AND estado = '1'");
        while($result2=mysql_fetch_array($componente)){
            echo "
                <option value=".$result2["idGalgas"].">".$result2["Descripcion"]."</option>
            ";
        }
}
?>