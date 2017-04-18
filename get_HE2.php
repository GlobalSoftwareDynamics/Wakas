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
    <script>
        function getID(val,val2) {
            $.ajax({
                type: "POST",
                url: "get_ProdID.php",
                data:'tipoproducto=' + val + '&idProd=' + val2,
                success: function(data){
                    $("#idProd").html(data);
                }
            });
        }
    </script>
    <?php
    mysql_query("SET NAMES 'utf8'");
    echo "<div>
                <h4>Nueva Producto a partir de Plantilla</h4>
            </div>
            <hr>";
    ?>
    <div class="form-group">
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label for="idProd" class="formlabels col-sm-12">Id Producto:</label>
            </div>
            <div class="col-sm-7" id="idProd">
                <?php
                $aux = 1;
                $i = 0;
                $strings = array();
                $flag = false;
                $result = selectTable("producto");
                while($fila = mysql_fetch_array($result)){
                    $strings[$i] = substr($fila['idProducto'],0,4);
                    $i++;
                }
                asort($strings);
                for($j=1;$j<$i;$j++){
                        if($strings[($j-1)]==$strings[$j]){
                        }else{
                            $aux++;
                        }
                }
                $idProd = $aux + 6000;
                //echo "<span id='idProd'>".$idProd."</span>";
                echo "<input type='text' class='form-control textinput-6' name='idProd' id='idProd' value='".$idProd."' readonly>"
                ?>
            </div>
        </div>
    </div>
    <?php
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
    /*$result = selectTableWhere("TipoProducto","idTipoProducto",'"'.$tipoProducto.'"');
    while($fila = mysql_fetch_array($result)){
        $tipoProducto = $fila['descripcion'];
    }
    $result = selectTableWhere("Genero","idGenero",'"'.$genero.'"');
    while($fila = mysql_fetch_array($result)){
        $tipoProducto = $fila['descripcion'];
    }*/
    echo "<div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <div class=\"col-sm-5\">
                        <label for=\"idProv\" class=\"formlabels col-sm-12\">ID Provisional:</label>
                    </div>
                    <div class=\"col-sm-7\">
                        <input type='text' name='idProv' id='idProv' class='form-control textinput-4 col-sm-12' value='".$idProvisional."'>
                    </div>
                </div>
          </div>";
    ?>
    <div class="form-group">
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label for="tipoProducto" class="formlabels col-sm-12">Tipo de Producto:</label>
            </div>
            <div class="col-sm-7">
                <?php
                $result = selectTable("tipoproducto");
                echo "<select name='tipoProducto' id='tipoProducto' class='ddselect-8  form-control' onchange='getID(this.value,$idProd)'>";
                echo "<option>Seleccionar</option>";
                while($fila = mysql_fetch_array($result)){
                    echo "<option value=".$fila['idTipoProducto'].">".$fila['descripcion']."</option>";
                }
                echo "</select>";
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label for="genero" class="formlabels col-sm-12">Genero:</label>
            </div>
            <div class="col-sm-7">
                <?php
                $result = selectTable("genero");
                echo "<select name='genero' id='genero' class='ddselect-6 form-control'>";
                echo "<option>Seleccionar</option>";
                while($fila = mysql_fetch_array($result)){
                    echo "<option value=".$fila['idgenero'].">".$fila['descripcion']."</option>";
                }
                echo "</select>";
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label for="idcliente" class="formlabels col-sm-12">ID Cliente:</label>
            </div>
            <div class="col-sm-7">
                <?php
                $result = selectTable("cliente");
                echo "<select name='idcliente' id='idcliente' class='ddselect-10 form-control'>";
                echo "<option>Seleccionar</option>";
                while($fila = mysql_fetch_array($result)){
                    echo "<option value=".$fila['idCliente'].">".$fila['nombre']."</option>";
                }
                echo "</select>";
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label for="idcodificacionTalla" class="formlabels col-sm-12">Codificación de Talla:</label>
            </div>
            <div class="col-sm-7">
                <?php
                $result = selectTable("codificacionTalla");
                echo "<select name='idcodificacionTalla' id='idcodificacionTalla' class='ddselect-6 form-control'>";
                echo "<option>Seleccionar</option>";
                while($fila = mysql_fetch_array($result)){
                    echo "<option value=".$fila['idcodificacionTalla'].">".$fila['descripcion']."</option>";
                }
                echo "</select>";
                ?>
            </div>
        </div>
    </div>
    <?php
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
    $result = selectTable("empleado");
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
    echo "<input type='hidden' value='".$_POST['idProd']."' name='idProdOrig'>";

}
?>