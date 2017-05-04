<?php
session_start();
require('funciones.php');
conexion();

    $result=mysql_query("SELECT * FROM tipoproducto WHERE idTipoProducto = '" . $_POST["tipoproducto"] . "'");
    while($fila=mysql_fetch_array($result)) {
        $idProd = idgen('P').$fila['digitoID'];
        echo "<input type='text' name='idProd' id='idProd' class='form-control textinput-6' value='".$idProd."' readonly>";
    }

?>