<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto"])) {
    /*echo "
    <tr>
    <td>".$_POST['idcodificacionTalla']."</td>
    <td>".$_POST['producto']."</td>
    </tr>
    ";*/
    echo "
    <tr>
    <td>
        <input type='text' name='yourcode' class='textinput-12'>
    </td>
    <td>
       <select id='mat' class='ddselect-12' name='material'>
           <option>Seleccionar</option>";
            $prod = "SELECT * FROM ProductoComponentesPrenda WHERE idProducto = '".$_POST['producto']."' AND idComponente = 'COMPONENTE1'";
            $prod1=mysql_query($prod);
            while($fila5 = mysql_fetch_array($prod1)){
                $result1=selectTableWhere('Material','idMaterial',"'".$fila5['idMaterial']."'");
                while ($fila2=mysql_fetch_array($result1)){
                    echo "
                        <option value='".$fila2['idMaterial']."'>".$fila2['material']."</option>
                    ";
                }
            }
    echo "
       </select>
    </td>
    <td>
        <select id='col' class='ddselect-12' name='color'>
            <option>Selecc.</option>";
            $prod2 = selectTable("Color");
            while($fila6 = mysql_fetch_array($prod2)){
                echo "
                    <option>".$fila6['idColor']."</option>
                ";
            }
    echo "
        </select>
    </td>
    ";
    $tallas1=array();
    $tallas2=array();
    $indice1=0;
    $indice2=0;
    $result=selectTableWhere('Talla','idcodificacionTalla',"'".$_POST['idcodificacionTalla']."'");
    while ($fila=mysql_fetch_array($result)) {
        $tallas1[$indice1] = $fila['idTalla'];
        $indice1++;
    }
    $talla ="SELECT DISTINCT idTalla FROM TallaMedida WHERE idProducto = '".$_POST["producto"]."'";
    $result2=mysql_query($talla);
    while ($fila1=mysql_fetch_array($result2)){
        $tallas2[$indice2]=$fila1['idTalla'];
        $indice2++;
    }
    foreach ($tallas1 as $value1) {
        $encontrado=false;
        foreach ($tallas2 as $value2) {
            if ($value1 == $value2){
                $encontrado=true;
                echo "<td><input type='text' class='textinput-12' name='".$value2."'></td>";
            }
        }
        if ($encontrado == false){
            echo "<td><input type='text' class='textinput-12 form-control' readonly></td>";
        }
    }
    echo "
    </tr>
    ";
    /*$talla ="SELECT DISTINCT idTalla FROM TallaMedida WHERE idProducto = '" . $_POST["producto"] . "'";
    $result=mysql_query($talla);
    while($fila=mysql_fetch_array($result)) {
        $talla1=selectTableWhere('Talla','idTalla',"'".$fila['idTalla']."'");
        while ($fila1=mysql_fetch_array($talla1)){
            echo "<option value=".$fila1['idTalla'].">".$fila1['descripcion']."</option>";
        }
    }*/
}
?>