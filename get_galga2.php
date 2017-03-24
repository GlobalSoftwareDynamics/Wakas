<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idMaquina"])) {
    $aux = 0;
    $componente =mysql_query("SELECT * FROM Galgas WHERE idMaquina = '" . $_POST["idMaquina"] . "'");
    while($result2=mysql_fetch_array($componente)){
      $aux++;
    }
    if($aux === 0){

    }else{
        echo "<label for='selectgalga'>Seleccionar Galga</label>";
        echo "<select name=\"galga\" id='selectgalga'>";
        echo "<option value='-'>Seleccionar</option>";
        mysql_data_seek($componente, 0);
        $componente =mysql_query("SELECT * FROM Galgas WHERE idMaquina = '" . $_POST["idMaquina"] . "'");
        while($result2=mysql_fetch_array($componente)){
            echo "
                <option value=".$result2["idGalgas"].">".$result2["Descripcion"]."</option>
            ";
        }
        echo "</select>";
    }
}
?>
