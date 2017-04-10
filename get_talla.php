<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto_id"])) {
    $talla ="SELECT DISTINCT idTalla FROM TallaMedida WHERE idProducto = '" . $_POST["producto_id"] . "'";
    $result=mysql_query($talla);
    while($fila=mysql_fetch_array($result)) {
        $talla1=selectTableWhere('Talla','idTalla',"'".$fila['idTalla']."'");
        while ($fila1=mysql_fetch_array($talla1)){
            echo "<option value=".$fila1['idTalla'].">".$fila1['descripcion']."</option>";
        }
    }
}
?>