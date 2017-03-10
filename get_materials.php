<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto_id"])) {
    $prod = "SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['producto_id']."' AND idComponente = 'COMPONENTE1'";
    $prod1=mysql_query($prod);
    while($fila5 = mysql_fetch_array($prod1)){
        $result1=selectTableWhere('Material','idMaterial',"'".$fila5['idMaterial']."'");
        while ($fila1=mysql_fetch_array($result1)){
            echo "
                <option value='".$fila1['idMaterial']."'>".$fila1['material']."</option>
            ";
        }
    }
}
?>