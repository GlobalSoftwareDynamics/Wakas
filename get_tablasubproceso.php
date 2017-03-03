<?php
session_start();
require('funciones.php');
conexion();
?>
<html>
<head>
    <script>
        function getMaterial(val) {
            $.ajax({
                type: "POST",
                url: "get_material.php",
                data:'idComponente='+val,
                success: function(data){
                    $("#material").html(data);
                }
            });
        }
    </script>
</head>

<?php
if(!empty($_POST["idSubproceso"])) {
    $result =mysql_query("SELECT * FROM subprocesocaracteristica WHERE idProcedimiento = '" . $_POST["idSubproceso"] . "'");
        echo "
            <thead>
                <tr>";
                   while($fila = mysql_fetch_array($result)){
                           $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                           while($fila2 = mysql_fetch_array($result2)){
                               echo "<th>".$fila2['descripcion']."</th>";
                           }
                       }
                echo "</tr>
            </thead>
            <tbody>";
                while($fila = mysql_fetch_array($result)){
                    echo "<tr>";
                    $result2 = selectTableWhere("caracteristica","idCaracteristica","'".$fila['idCaracteristica']."'");
                    while($fila2 = mysql_fetch_array($result2)){
                        echo "<td>";
                            if($fila['tipo']==="componente"){
                                echo "<select name=\"selectcomponente\" id=\"selectcomponente\" onChange='getMaterial(this.value)'>";
                                    echo "<option>Seleccionar</option>";
                                    $result3 = selectTableWhere("productocomponentesprenda","idProducto","'".$_POST['idProducto']."'");
                                    while($fila3 = mysql_fetch_array($result3)){
                                        $result4 = selectTableWhere("componentesprenda","idComponente","'".$fila3['idComponente']."'");
                                        while($fila4 = mysql_fetch_array($result4)){
                                            echo "<option value='".$fila3['idComponenteEspecifico']."'>".$fila4['descripcion']."</option>";
                                        }
                                    }
                                echo "</select>";
                            } elseif ($fila['tipo']==="material"){
                                echo "<p id='material'></p>";
                            } elseif ($fila['tipo']==='maquina'){

                            } elseif ($fila['tipo']==='galga'){

                            } elseif ($fila['tipo']==='insumo'){

                            } elseif ($fila['tipo']==='texto'){

                            }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            echo "</tbody>
       ";
}
?>
</html>
