<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["compesp_id"])) {
        echo "<option>Seleccionar</option>";
        $result1=selectTableWhere('Caracteristica','descripcion','"Procedimiento - Hoja Tiempos"');
        while ($fila1=mysql_fetch_array($result1)){
            $idcarac=$fila1['idCaracteristica'];
        }
        $result2=selectTableWhere('SubProceso','descripcion','"Hoja de Tiempos y Secuencia"');
        while ($fila2=mysql_fetch_array($result2)){
            $idprocedimiento=$fila2['idProcedimiento'];
        }
        $result3=selectTableWhere2('SubProcesoCaracteristica','idProcedimiento',"'".$idprocedimiento."'",'idCaracteristica',"'".$idcarac."'");
        while ($fila3=mysql_fetch_array($result3)){
            $idsubprocesocaracteristica=$fila3['idSubProcesoCaracteristica'];
        }
        $result4=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$_POST["compesp_id"]."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
        while ($fila4=mysql_fetch_array($result4)){
            $result5=selectTableWhere('SubProceso','idProcedimiento',"'".$fila4['valor']."'");
            while ($fila5=mysql_fetch_array($result5)){
                echo "<option value='".$fila4['valor']."'>".$fila5['descripcion']."</option>";
            }
        }
    }
?>