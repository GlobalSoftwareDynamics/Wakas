<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["tipo"])) {
    if ($_POST['tipo']=="Acondicionamiento")
    echo "
                    <div class='col-sm-5'>
                        <label for='proce' class='formlabels col-sm-12'>Procedimiento:</label>
                    </div>
                    <div class='col-sm-7''>
                        <select id='proce' name='procedimiento' class='ddselect-10'>
                            <option>Seleccionar</option>";
                            $result = "SELECT * FROM subproceso WHERE idProceso='PROCESO6' AND estado='1' AND tipo='2'";
                            $result1 = mysql_query($result);
                            while ($fila1 = mysql_fetch_array($result1)) {
                                echo "
                                    <option value='".$fila1['idProcedimiento']."'>" . $fila1['descripcion'] . "</option>
                                ";
                            }
    echo "
                        </select>
                    </div>
    ";
}else{

}
?>