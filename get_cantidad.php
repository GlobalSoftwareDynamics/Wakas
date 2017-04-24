<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["producto"])) {
    $cantidad=0;
    $componente =mysql_query("SELECT * FROM ConfirmacionVentaProducto WHERE idProducto = '" . $_POST["producto"] . "' AND idContrato ='".$_POST['contrato']."' AND idColor ='".$_POST['color']."' AND idTalla ='".$_POST['talla']."'");
    while($result2=mysql_fetch_array($componente)){
        $cantidad=$result2['cantidad']-$result2['cantidadop'];
    }
    echo "<input type=text value='".$cantidad."' name='cantidad' class='textinput-4'>";
}else{
    echo "<input type=text value='Inválido' name='cantidad' class='textinput-4'>";
}
?>