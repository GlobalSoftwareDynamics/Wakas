<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["tipoproducto"])&&!empty($_POST['idProd'])) {
    $result=mysql_query("SELECT * FROM tipoproducto WHERE idTipoProducto = '" . $_POST["tipoproducto"] . "'");
    while($fila=mysql_fetch_array($result)) {
        echo "<input type='text' name='idProd' id='idProd' class='form-control textinput-6' value='".$_POST['idProd'].$fila['digitoID']."' readonly>";
    }
}
?>