<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST['producto'])) {
    echo "
            <table class='table table-hover'>
                <thead>
                    <tr>
        ";
    $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
    while ($fila=mysql_fetch_array($result)){
        $idcod=$fila['idcodificacionTalla'];
        $result1=selectTableWhere('Talla','idcodificacionTalla',"'".$fila['idcodificacionTalla']."'");
        while ($fila1=mysql_fetch_array($result1)){
            echo "
                <th>".$fila1['descripcion']."</th>
            ";
        }
        echo "
                    </tr>
                </thead>
                <tbody>
                    <tr>
    ";
        $tallas1=array();
        $tallas2=array();
        $indice1=0;
        $indice2=0;
        $result2=selectTableWhere('Talla','idcodificacionTalla',"'".$fila['idcodificacionTalla']."'");
        while ($fila2=mysql_fetch_array($result2)) {
            $tallas1[$indice1] = $fila2['idTalla'];
            $indice1++;
        }
        $talla ="SELECT DISTINCT idTalla FROM confirmacionventaproducto WHERE idProducto = '".$_POST["producto"]."' AND idContrato='".$_POST['contrato']."' AND idColor='".$_POST['color']."'";
        $result3=mysql_query($talla);
        while ($fila3=mysql_fetch_array($result3)){
            $tallas2[$indice2]=$fila3['idTalla'];
            $indice2++;
        }
        foreach ($tallas1 as $value1) {
            $encontrado=false;
            foreach ($tallas2 as $value2) {
                if ($value1 == $value2){
                    $encontrado=true;
                    $cantidad=0;
                    $result4="SELECT * FROM confirmacionventaproducto WHERE idContrato='".$_POST['contrato']."' AND idProducto='".$_POST['producto']."' AND idColor='".$_POST['color']."' AND idTalla='".$value2."'";
                    $result5=mysql_query($result4);
                    while ($fila4=mysql_fetch_array($result5)){
                        $cantidad=$fila4['cantidad']-$fila4['cantidadop'];
                        echo "<td><input type='text' class='textinput-12' name='".$value2."' value='".$cantidad."'></td>";
                    }
                }
            }
            if ($encontrado == false){
                echo "<td><input type='text' class='textinput-12 form-control' readonly></td>";
            }
        }
        echo "
        </tr>
        ";
            echo "
                </tbody>
            </table>
            <input type='hidden' name='idcodificacionTalla' value='".$idcod."'>
        ";
    }

}
?>