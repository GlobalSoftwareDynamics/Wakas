<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["procedimiento"])) {
    if($_POST['procedimiento']==='PROCEDIMIENTO1'||$_POST['procedimiento']==='PROCEDIMIENTO2'||$_POST['procedimiento']==='PROCEDIMIENTO6'){
        echo "<div class='col-xs-12'>";
            echo "<label for='maquina' class='formlabelscel col-xs-12'>Seleccione Máquina:</label>";
        echo "</div>";
        echo "<div class='col-xs-12'>";
            echo "<select name='maquina' id='maquina' class='ddselect-12''>";
                $query = mysql_query("SELECT DISTINCT idMaquina FROM MaquinaSubproceso WHERE idProcedimiento = '".$_POST['procedimiento']."'");
                while($row = mysql_fetch_array($query)){
                    $query2 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$row['idMaquina']."'");
                    while($row2 = mysql_fetch_array($query2)){
                        echo "<option value='".$row['idMaquina']."'>".$row2['descripcion']."</option>";
                    }
                }
            echo "</select>";
        echo "</div>";
    }
}elseif(!empty($_POST['actimuerta'])&&(($_POST['actimuerta']==='ActivMuerta1')||($_POST['actimuerta']==='ActivMuerta2'))){
    echo "<div class='col-xs-12'>";
        echo "<label for='maquina' class='formlabelscel col-xs-12'>Seleccione Máquina:</label>";
    echo "</div>";
    echo "<div class='col-xs-12'>";
        echo "<select name='maquina' id='maquina' class='ddselect-12''>";
        $query = mysql_query("SELECT DISTINCT idMaquina FROM MaquinaSubproceso");
        while($row = mysql_fetch_array($query)){
            $query2 = mysql_query("SELECT * FROM Maquina WHERE idMaquina = '".$row['idMaquina']."'");
            while($row2 = mysql_fetch_array($query2)){
                echo "<option value='".$row['idMaquina']."'>".$row2['descripcion']."</option>";
            }
        }
        echo "</select>";
    echo "</div>";
}
?>