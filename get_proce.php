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
        $result2=selectTableWhere('SubProceso','idProcedimiento','"PROCEDIMIENTO32"');
        while ($fila2=mysql_fetch_array($result2)){
            $idprocedimiento=$fila2['idProcedimiento'];
        }
        $result3=selectTableWhere2('SubProcesoCaracteristica','idProcedimiento',"'".$idprocedimiento."'",'idCaracteristica',"'".$idcarac."'");
        while ($fila3=mysql_fetch_array($result3)){
            $idsubprocesocaracteristica=$fila3['idSubProcesoCaracteristica'];
        }
        $result4=selectTableWhere2('PCPSPC','idComponenteEspecifico',"'".$_POST["compesp_id"]."'",'idSubProcesoCaracteristica',"'".$idsubprocesocaracteristica."'");
        while ($fila4=mysql_fetch_array($result4)){
            $idpcpspc=$fila4['id']+1;
            $result5=selectTableWhere('PCPSPC','id',"'".$idpcpspc."'");
                while ($fila5=mysql_fetch_array($result5)){
                    if($fila5['valor']=="MAQUINA9"){
                        $result6=selectTableWhere('SubProceso','idProcedimiento',"'".$fila4['valor']."'");
                        while ($fila6=mysql_fetch_array($result6)) {
                            echo "<option value='" . $fila4['valor'] . "'>" . $fila6['descripcion'] . "</option>";
                        }
                    }
                }
            }
        }
?>