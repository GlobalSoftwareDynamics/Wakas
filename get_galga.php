<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idMaquina"])) {
    echo "<option value='-'>Seleccionar</option>";
    $componente =mysql_query("SELECT * FROM maquinasubproceso WHERE idMaquina = '" . $_POST["idMaquina"] . "'");
        while($result2=mysql_fetch_array($componente)){
            if ($result2['idGalgas']===NULL){
            }else{
                $result1=selectTableWhere('Galgas','idGalgas',"'".$result2['idGalgas']."'");
                while ($fila=mysql_fetch_array($result1)){
                    echo "
                        <option value=".$result2["idGalgas"].">".$fila["Descripcion"]."</option>
                    ";
                }
            }
        }
}
?>