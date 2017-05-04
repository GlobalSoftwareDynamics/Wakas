<?php
session_start();
require('funciones.php');
conexion();
if(!empty($_POST["idProd"])) {
    ?>
<script>
    $(document).ready(function() {
        $("#datepicker").datepicker();
    });
</script>
<?php
    mysql_query("SET NAMES 'utf8'");
    echo "<div>
                <h4>Nueva Versión de Hoja de Especificaciones</h4>
            </div>
            <hr>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"idProd\" class=\"formlabels col-sm-12\">ID Producto:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' id='idProd' class='form-control textinput-4 col-sm-12' value='".$_POST['idProd']."' readonly>
                    </div>
                </div>
          </div>";
    $result = selectTableWhere("Producto","idProducto","'".$_POST['idProd']."'");
    while($fila=mysql_fetch_array($result)){
        $idProvisional = $fila['idProvisional'];
        $tipoProducto = $fila['idTipoProducto'];
        $genero = $fila['idgenero'];
        $idCliente = $fila['idCliente'];
        $idcodificacionTalla = $fila['idcodificacionTalla'];
        $observacion = $fila['observaciones'];
        $descripcion = $fila['descripcionGeneral'];
    }
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"idProv\" class=\"formlabels col-sm-12\">ID Provisional:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' name='idProv' id='idProv' class='form-control textinput-4 col-sm-12' value='".$idProvisional."' readonly>
                    </div>
                </div>
          </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"tipoProducto\" class=\"formlabels col-sm-12\">Tipo:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' name='tipoProducto' id='tipoProducto' class='form-control textinput-4 col-sm-12' value='".$tipoProducto."' readonly>
                    </div>
                </div>
          </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"genero\" class=\"formlabels col-sm-12\">Género:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' name='genero' id='genero' class='form-control textinput-4 col-sm-12' value='".$genero."' readonly>
                    </div>
                </div>
          </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"idcliente\" class=\"formlabels col-sm-12\">ID Cliente:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' name='idcliente' id='idcliente' class='form-control textinput-4 col-sm-12' value='".$idCliente."' readonly>
                    </div>
                </div>
          </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"idcodificacionTalla\" class=\"formlabels col-sm-12\">ID Codificacion Talla:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' name='idcodificacionTalla' id='idcodificacionTalla' class='form-control textinput-4 col-sm-12' value='".$idcodificacionTalla."' readonly>
                    </div>
                </div>
          </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"datepicker\" class=\"formlabels col-sm-12\">Fecha de Creaci&oacute;n:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input name=\"date\" id=\"datepicker\" class=\"textinput-6\">
                    </div>
                </div>
            </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"selectempleado\" class=\"formlabels col-sm-12\">Creado por:</label>
                    </div>
                    <div class=\"col-sm-7\">";
                        $result = selectTableWhere("empleado",'estado','1');
                        echo "<select name='selectempleado' id='selectempleado' class='ddselect-10'>";
                        echo "<option>Seleccionar</option>";
                        while($fila = mysql_fetch_array($result)){
                            echo "<option value=".$fila['idEmpleado'].">".$fila['nombres']." ".$fila['apellidos']."</option>";
                        }
                        echo "</select>";
                    echo "</div>
                </div>
            </div>";
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"observGen\" class=\"formlabels col-sm-12\">Observaciones Generales:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <textarea name=\"observGen\" id=\"observGen\" cols=\"30\" rows=\"3\" class=\"areainput-12\">".$observacion."</textarea>
                    </div>
                </div>
            </div>
            <div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"descrGen\" class=\"formlabels col-sm-12\">Descripci&oacute;n General:</label>
                    </div>
                    <div  class=\"col-sm-7\">
                        <textarea name=\"descrGen\" id=\"descrGen\" cols=\"30\" rows=\"3\" class=\"areainput-12\">".$descripcion."</textarea>
                    </div>
                </div>
            </div>";
    echo "<div class=\"form-group\">
                <input type=\"hidden\" value=\"1\" name=\"creacion\">
                <input type=\"hidden\" value=\"add\" name=\"add\">
                <div class=\"col-sm-12\">
                    <input class=\"btn btn-default col-sm-6 col-sm-offset-3\" type=\"submit\" value=\"Siguiente\" name='Siguiente'>
                </div>
            </div>";
    $pointer = 0;
    $query = mysql_query("SELECT * FROM Producto WHERE idProducto LIKE '".$_POST['idProd']."%'");
    while($search = mysql_fetch_array($query)){
        $pointer++;
    }
    $version = array();
    $version = explode("_V",$_POST['idProd']);
    if(isset($version[1])){
        $versionactual = intval($version[1])+1;
        $Producto = $version[0]."_V".$versionactual;
    }else{
        $Producto = $_POST['idProd']."_V".$pointer;
    }
    echo "<input type='hidden' value='".$Producto."' name='idProd'>";
    echo "<input type='hidden' value='".$_POST['idProd']."' name='idProdOrig'>";

    }
?>