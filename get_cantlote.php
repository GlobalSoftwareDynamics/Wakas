<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["producto"])) {
    $cantidad=0;
    $result1=selectTableWhere('Lote','idLote',"'".$_POST['lote']."'");
    while ($fila=mysql_fetch_array($result1)){
        $cantidad=$fila['cantidad'];
    }
    $cantidad1=0;
    $componente =mysql_query("SELECT * FROM EmpleadoLote WHERE idProducto = '" . $_POST["producto"] . "' AND idLote ='".$_POST['lote']."' AND idProcedimiento ='".$_POST['procedimiento']."' AND idComponenteEspecifico ='".$_POST['componente']."'");
    while($result2=mysql_fetch_array($componente)){
        $cantidad1=$cantidad1+$result2['cantidad'];
    }
    if($cantidad==$cantidad1){
        echo "<input type=text value='".$cantidad."' name='cantidad' class='textinput-12' id='cant'>";
    }else{
        $res=$cantidad-$cantidad1;
        echo "<input type=text value='".$res."' name='cantidad' class='textinput-12' id='cant'>";
    }
}
?>