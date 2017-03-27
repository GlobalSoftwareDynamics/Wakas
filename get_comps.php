<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto_id"])) {
    $comp =selectTableWhere("ProductoComponentesPrenda","idProducto","'".$_POST["producto_id"]."'");
    while($fila=mysql_fetch_array($comp)) {
        $comp1=selectTableWhere("ComponentesPrenda","idComponente","'".$fila['idComponente']."'");
        while ($fila1=mysql_fetch_array($comp1)){
            echo "
            <option value=".$fila["idComponenteEspecifico"].">".$fila1["descripcion"]."</option>
       ";
        }
    }
}
?>