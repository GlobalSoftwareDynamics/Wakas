<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idProceso"])) {
    echo "<option>Seleccionar</option>";
    $subproceso =mysql_query("SELECT * FROM subproceso WHERE idProceso = '" . $_POST["idProceso"] . "'");
    while($result=mysql_fetch_array($subproceso)){
        echo "
            <option value=".$result["idProcedimiento"].">".$result["descripcion"]."</option>
       ";
    }
}
?>