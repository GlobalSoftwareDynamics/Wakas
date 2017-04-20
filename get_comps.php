<?php
session_start();
require('funciones.php');
conexion();

if(!empty($_POST["producto"])) {
    echo "<option>Seleccionar</option>";
    $compesp1=array();
    $compesp2=array();
    $indice1=0;
    $indice2=0;
    $comp =selectTableWhere("ProductoComponentesPrenda","idProducto","'".$_POST["producto"]."'");
    while($fila=mysql_fetch_array($comp)) {
        $compesp1[$indice1] = $fila['idComponenteEspecifico'];
        $indice1++;
    }
    $result=selectTableWhere2('EmpleadoLote','idLote',"'".$_POST["lote"]."'",'idProducto',"'".$_POST["producto"]."'");
    while ($fila2=mysql_fetch_array($result)){
        $compesp2[$indice2] = $fila2['idComponenteEspecifico'];
        $indice2++;
    }
    foreach ($compesp1 as $value1) {
        $encontrado=false;
        foreach ($compesp2 as $value2) {
            if ($value1 == $value2){
                $encontrado=true;
            }
        }
        if ($encontrado == false){
            $componente=selectTableWhere('ProductoComponentesPrenda','idComponenteEspecifico',"'".$value1."'");
            while ($fila3=mysql_fetch_array($componente)){
                $comp1=selectTableWhere("ComponentesPrenda","idComponente","'".$fila3['idComponente']."'");
                while ($fila1=mysql_fetch_array($comp1)){
                    echo "
                        <option value=".$value1.">".$fila1["descripcion"]."</option>
                    ";
                }
            }
        }
    }
}
?>