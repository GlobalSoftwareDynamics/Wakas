<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idInsumo"])) {
    $componente =mysql_query("SELECT * FROM Insumos WHERE idInsumo = '" . $_POST["idInsumo"] . "'");
    while($result2=mysql_fetch_array($componente)){
        echo $result2['idInsumo'];
    }
}
?>