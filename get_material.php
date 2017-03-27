<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idComponente"])) {
    $componente =mysql_query("SELECT * FROM productocomponentesprenda WHERE idComponenteEspecifico = '" . $_POST["idComponente"] . "'");
    while($result=mysql_fetch_array($componente)){
        $material = mysql_query("SELECT * FROM material WHERE idMaterial = '".$result['idMaterial']."'");
        while($result2=mysql_fetch_array($material)){
            echo $result2["material"];
        }
    }
}
?>