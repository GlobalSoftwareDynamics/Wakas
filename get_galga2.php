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
        echo "
        <div class='form-group'>
            <div class='col-sm-12'>
                <div class='col-sm-5'>
                    <label for='selectgalga' class='formlabels col-sm-12'>Seleccionar Galga</label>
                </div>
        ";
        echo "
                <div class='col-sm-7'>
                    <select name='galga' id='selectgalga' class='ddselect-10'>
                
        ";
        echo "<option value='-'>Seleccionar</option>";
        mysql_data_seek($componente, 0);
        $componente =mysql_query("SELECT * FROM Galgas WHERE idMaquina = '" . $_POST["idMaquina"] . "'");
        while($result2=mysql_fetch_array($componente)){
            echo "
                <option value=".$result2["idGalgas"].">".$result2["Descripcion"]."</option>
            ";
        }
        echo "
                    </select>
                </div>
            </div>
        </div>";
    }
}
?>
