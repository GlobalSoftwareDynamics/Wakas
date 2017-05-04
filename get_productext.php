<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idlote"])) {
    $producto =mysql_query("SELECT * FROM lote WHERE idLote = '" . $_POST["idlote"] . "' AND estado ='1'");
    while($result2=mysql_fetch_array($producto)){
        echo "<div class='col-xs-5'>";
        echo "<label for='product' class='formlabels col-xs-12'>Producto:</label>";
        echo "</div>";
        echo "<div class='col-xs-7'>";
        echo "<input type='text' class='textinput-6' name='producto' id='idproduct' value=".$result2['idProducto']." readonly>";
        echo "</div>";
    }
}
?>