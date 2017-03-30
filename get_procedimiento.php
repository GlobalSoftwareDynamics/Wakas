<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idProcedimiento"])) {
    $componente =mysql_query("SELECT * FROM SubProceso WHERE idProcedimiento = '" . $_POST["idProcedimiento"] . "'");
    while($result2=mysql_fetch_array($componente)){
        echo $result2['idProcedimiento'];
    }
}
?>