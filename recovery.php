<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
    mysql_query("SET NAMES 'utf8'");
    ?>

    <!DOCTYPE html>

    <html lang="es">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Waka-s Textiles Finos S.A.</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formularios.css" rel="stylesheet">
        <link href="css/Tablas.css" rel="stylesheet">
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">



    </head>

    <body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                                <li><a href="gestionOP.php">Visualizaci&oacuten de Órdenes de Producci&oacuten</a></li>
                                <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                                <li><a href="rendimiento.php">Visualizaci&oacuten de Rendimiento</a></li>
                                <li><a href="menuestadoproceso.php">Visualizaci&oacuten de Estado de Proceso</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OPERACIONES<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                                <li><a href="OpcionHE.php">Nueva Hoja de Especificaciones</a></li>
                                <li><a href="OPnueva.php">Nueva Orden de Producción</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INFORMACIÓN INTERNA<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionMateriales.php">Materiales</a></li>
                                <li><a href="gestionMaquinas.php">M&aacutequinas</a></li>
                                <li><a href="gestionInsumos.php">Insumos</a></li>
                                <li><a href="gestionOperarios.php">Empleados</a></li>
                                <li><a href="gestionProcesos.php">Procesos</a></li>
                                <li><a href="gestionRepuestos.php">Repuestos</a></li>
                                <li><a href="menuagregarotros.php">Otros</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONTACTOS<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="gestionClientes.php">Clientes</a></li>
                                <li><a href="gestionProveedores.php">Proveedores</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
    </header>

    <?php
    if(isset($_POST['recuperarprod'])) {
        $recovery="UPDATE producto SET estado = '1' WHERE idProducto = '".$_POST['idProd']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }

    if(isset($_POST['recuperargalga'])) {
        $recovery="UPDATE galgas SET estado = '1' WHERE idGalgas = '".$_POST['idgalgas']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarinsumo'])) {
        $recovery="UPDATE insumos SET estado = '1' WHERE idInsumo = '".$_POST['idinsumo']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarmaquina'])) {
        $recovery="UPDATE maquina SET estado = '1' WHERE idMaquina = '".$_POST['idmaquina']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarmaterial'])) {
        $recovery="UPDATE material SET estado = '1' WHERE idMaterial = '".$_POST['idmaterial']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarproceso'])){
        $recovery="UPDATE proceso SET estado = '1' WHERE idProceso = '".$_POST['idProceso']."'";
        $recovery2=mysql_query($recovery);
        $recovery="UPDATE subproceso SET estado = '1' WHERE idProceso = '".$_POST['idProceso']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarsubproceso'])){
        $recovery="UPDATE subproceso SET estado = '1' WHERE idProcedimiento = '".$_POST['idProcedimiento']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarempleado'])) {
        $recovery="UPDATE empleado SET estado = '1' WHERE idEmpleado = '".$_POST['idempleado']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarproveedor'])) {
        $recovery="UPDATE proveedor SET estado = '1' WHERE idProveedor = '".$_POST['idproveedor']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarcliente'])) {
        $recuperarcont="UPDATE contacto SET estado = '1' WHERE idCliente = '".$_POST['idcliente']."'";
        $recuperarcont1=mysql_query($recuperarcont);
        $recuperarcli="UPDATE cliente SET estado = '1' WHERE idCliente = '".$_POST['idcliente']."'";
        $recuperarcli1=mysql_query($recuperarcli);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarcontacto'])){
        $recovery="UPDATE contacto SET estado = '1' WHERE idContacto = '".$_POST['idcontacto']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    if(isset($_POST['recuperarcv'])) {
        $recovery="UPDATE ordenproduccion SET estado = '1' WHERE idContrato = '".$_POST['contrato']."'";
        $recovery2=mysql_query($recovery);
        $recovery="UPDATE confirmacionventa SET estado = '1' WHERE idContrato = '".$_POST['contrato']."'";
        $recovery2=mysql_query($recovery);
        if ( !empty( $error = mysql_error() ) )
        {
            echo 'Mysql error '. $error ."<br />\n";
        }
    }
    ?>

    <section class="container">
        <h3>Centro de Recuperación de Registros</h3>
        <hr>
        <div class="form-group form-horizontal jumbotron col-sm-10 col-sm-offset-1">
            <br>
            <form method="post" action="#">
                <div class="col-sm-6">
                    <label for="selectrecuperar">Seleccione el tipo de registro a recuperar:</label>
                </div>
                <div class="col-sm-6">
                    <select id="selectrecuperar" name="selectrecuperar" class="form-control">
                        <option>Seleccionar</option>
                        <option value="producto">Productos</option>
                        <option value="galga">Galgas</option>
                        <option value="insumo">Insumos</option>
                        <option value="maquina">Máquinas</option>
                        <option value="material">Material</option>
                        <option value="proceso">Procesos</option>
                        <option value="subproceso">Subprocesos</option>
                        <option value="empleado">Empleados</option>
                        <option value="proveedor">Proveedores</option>
                        <option value="cliente">Clientes</option>
                        <option value="contacto">Contactos</option>
                        <option value="confirmacion">Confirmaciones de Venta</option>
                    </select>
                </div>
                <br><br><br>
                <div>
                    <input type="submit" class="btn btn-success col-sm-offset-5" value="Seleccionar">
                </div>
                <br><br>
            </form>
        </div>
    </section>

    <section class="container">
        <?php
            if(isset($_POST['selectrecuperar'])){
                if($_POST['selectrecuperar']==='producto'){
                    echo "<section class='container'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th>idProducto</th>
                                        <th>Tipo de Producto</th>
                                        <th>Género</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>";

                    $result=selectTableWhere("Producto",'estado','0');
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                <tr>
                                    <td>".$fila ['idProducto']."</td>";
                        $result2 = selectTableWhere("TipoProducto","idTipoProducto","'".$fila['idTipoProducto']."'");
                        while ($fila2 = mysql_fetch_array($result2)){
                            echo "<td>".$fila2 ['descripcion']."</td>";
                        }
                        echo "<td>".$fila ['idgenero']."</td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idProd' value='".$fila['idProducto']."' readonly>
                                            <input type='submit' formaction='HEFinal.php' class='btn-link' value='Ver Detalle'>
                                        </form>
                                    </td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idProd' value='".$fila['idProducto']."' readonly>
                                            <input type='hidden' name='selectrecuperar' value='producto' readonly>
                                            <input type='submit' name='recuperarprod' formaction='recovery.php' class='btn-link' value='Recuperar'>
                                        </form>
                                    </td>
                                </tr>
                            ";
                    }
                        echo "</tbody>
                        </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='galga'){
                    echo "<section class='container'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th>idGalga</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Unidad de Medida</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $result = mysql_query("SELECT * FROM galgas WHERE estado = '0' ORDER BY LENGTH(idGalgas)");
                    while($fila=mysql_fetch_array($result)){
                        echo "
                                <tr>
                                    <td>".$fila['idGalgas']."</td>
                                    <td>".$fila['Descripcion']."</td> 
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idgalgas' value='".$fila['idGalgas']."'>
                                            <input type='hidden' name='selectrecuperar' value='galga' readonly>
                                            <input type='submit' class='btn-link' name='recuperargalga' value='Recuperar' formaction='recovery.php'>
                                        </form>
                                    </td>
                                </tr>
                        ";
                    }
                    echo "</tbody>
                    </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='insumo'){
                    echo "
                    <section class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idInsumo</th>
                                    <th>Descrici&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th>Procedimiento</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
                    $result = mysql_query("SELECT * FROM insumos WHERE estado='0' ORDER BY LENGTH(idInsumo)");
                    while($fila = mysql_fetch_array($result)) {
                        echo "
                                 <tr>
                                    <td>".$fila['idInsumo']."</td>
                                    <td>".$fila['descripcion']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>";
                        if ($fila['idProcedimiento'] === NULL){
                            echo "<td></td>";
                        }else{
                            $result1="SELECT * FROM subproceso WHERE idProcedimiento ='".$fila['idProcedimiento']."'";
                            $query=mysql_query($result1);
                            while ($fila1=mysql_fetch_array($query)){
                                echo "
                    <td>".$fila1['descripcion']."</td>
                ";
                            }
                        }
                        echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idinsumo' value='".$fila['idInsumo']."'>
                                            <input type='hidden' name='selectrecuperar' value='insumo' readonly>
                                            <input type='submit' class='btn-link' name='recuperarinsumo' value='Recuperar' formaction='recovery.php'>
                                        </form>
                                    </td>
                                </tr>
                    ";
                    }
                    echo "
                         </tbody>
                       </table>
                    </section>
                ";
                }elseif($_POST['selectrecuperar']=='maquina'){
                    echo "<section class='container'>
        <table class='table table-hover'>
            <thead>
            <tr>
                <th>idM&aacute;quina</th>
                <th>Descripci&oacute;n</th>
                <th>Costo Fijo</th>
                <th></th>
            </tr>
            </thead>
            <tbody>";
            $result = mysql_query("SELECT * FROM maquina WHERE estado='0' ORDER BY LENGTH(idMaquina)");
            while($fila = mysql_fetch_array($result)) {
                echo "
								<tr>
										<td>".$fila['idMaquina']."</td>
										<td>".$fila['descripcion']."</td>
										<td>".$fila['costoFijo']."</td>
                                        <td>
										    <form method='post'>
                                                <input type='hidden' name='idmaquina' value='".$fila['idMaquina']."'>
                                                <input type='hidden' name='selectrecuperar' value='maquina' readonly>
                                                <input type='submit' class='btn-link' name='recuperarmaquina' value='Recuperar' formaction='recovery.php'>
                                            </form>
                                        </td>
								</tr>
							";
            }
                    echo"</tbody>
                    </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='material'){
                    echo "
                    <section class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idMaterial</th>
                                    <th>Descrici&oacute;n</th>
                                    <th>Unidad de Medida</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                ";
                    $result = mysql_query("SELECT * FROM material WHERE estado ='0' ORDER BY LENGTH(idMaterial)");
                    while($fila = mysql_fetch_array($result)) {
                        echo "
                                 <tr>
                                    <td>".$fila['idMaterial']."</td>
                                    <td>".$fila['material']."</td>
                                    <td>".$fila['idUnidadMedida']."</td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idmaterial' value='".$fila['idMaterial']."'>
                                            <input type='hidden' name='selectrecuperar' value='material' readonly>
                                            <input type='submit' class='btn-link' name='recuperarmaterial' value='Recuperar' formaction='recovery.php'>
                                        </form>
                                    </td>
                                </tr>
                    ";
                    }
                    echo "
                         </tbody>
                       </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='proceso'){
                    echo "<section>
                            <div class='container'>
                                <table class='table table-hover'>
                                    <thead>
                                        <tr>
                                            <th>idProceso</th>
                                            <th>Descripción</th>
                                            <th>Ver Subprocesos</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>";
            $result=mysql_query("SELECT * FROM proceso WHERE estado ='0' ORDER BY LENGTH(idProceso)");
            while ($fila=mysql_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$fila['idProceso']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "  
                          <form method='post'>
                          <input type='hidden' name='idProceso' value='".$fila['idProceso']."'>
                          <td>
                              <input class=' btn-link' type='submit' formaction='gestionSubprocesos.php' value='Ver'>
                          </td>
                          <input type='hidden' name='selectrecuperar' value='proceso' readonly>";

                echo "<td><input type='submit' name='recuperarproceso' value='Recuperar' class='btn-link' formaction='recovery.php'></td>
                        </form>";
                echo "</tr>";
            }
                    echo "</tbody>
                    </table>
                    </div>
                    </section>";
                }elseif($_POST['selectrecuperar']=='subproceso'){
                    echo "<section>
                    <div class='container'>
                    <table class='table table-hover'>
                        <thead>
                        <tr>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>";
                        $result=selectTableWhere('SubProceso','estado','0');
                        while ($fila=mysql_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>".$fila['descripcion']."</td>";
                            echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='idProcedimiento' value='".$fila['idProcedimiento']."'>
                                    <input type='hidden' name='selectrecuperar' value='subproceso' readonly>
                                    <input type='submit' value='Recuperar' name='recuperarsubproceso' class='btn-link' formaction='recovery.php'>
                                </form>
                            </td>
                    ";
                            echo "</tr>";
                        }
                        echo "
                        </tbody>
                    </table>
                    </div>
                    </section>";
                }elseif($_POST['selectrecuperar']=='empleado'){
                    echo "
            <section class='container'>
                 <table class='table table-hover table-condensed'>
                     <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de Usuario</th>
                                <th>Usuario</th>
                                <th>Contrase&ntilde;a</th>
                                <th></th>
				            </tr>
			        </thead>
			        <tbody>
        ";
                    $result = mysql_query("SELECT * FROM empleado WHERE estado ='0' ORDER BY apellidos");
                    while($fila = mysql_fetch_array($result)) {
                        echo "
                             <tr>
                                <td>".$fila['idEmpleado']."</td>
                                <td>".$fila['nombres']."</td>
                                <td>".$fila['apellidos']."</td>
                                ";
                        $result1 = selectTableWhere("TipoUsuario","idTipoUsuario","'".$fila['idTipoUsuario']."'");
                        while($fila1=mysql_fetch_array($result1)){
                            echo "
                            <td>".$fila1['Descripcion']."</td>
                ";
                        }
                        echo "
                                <td>".$fila['usuario']."</td>
                                <td>".$fila['contrasena']."</td>
                                <td>
                                    <form method='post'>
                                         <input type='hidden' name='idempleado' value='".$fila['idEmpleado']."'>
                                         <input type='hidden' name='selectrecuperar' value='empleado' readonly>
                                         <input type='submit' class='btn-link' name='recuperarempleado' value='Recuperar' formaction='recovery.php'>
                                    </form>
                                </td>
                            </tr>
                ";
                    }
                    echo "
                   </tbody>
                </table>
            </section>";
                }elseif($_POST['selectrecuperar']=='proveedor'){
                    echo "<section class='container'>
    <table class='table table-hover'>
        <thead>
        <tr>
            <th>idProveedor</th>
            <th>Nombre</th>
            <th>Direcci&oacute;n</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        $result=selectTableWhere('Proveedor','estado','0');
        while($fila=mysql_fetch_array($result)){
            echo "
                                <tr>
                                    <td>".$fila['idProveedor']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['Direccion']."</td>
                            ";
            echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idproveedor' value='".$fila['idProveedor']."'>
                                            <input type='submit' class='btn-link' name='ver' value='Ver Ficha' formaction='fichaProveedor.php'>
                                        </form>
                                    </td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idproveedor' value='".$fila['idProveedor']."'>
                                            <input type='hidden' name='selectrecuperar' value='proveedor' readonly>
                                            <input type='submit' class='btn-link' name='recuperarproveedor' value='Recuperar' formaction='recovery.php'>
                                        </form>
                                    </td>
                                </tr>
                            ";
        }
        echo"
                    </tbody>
                    </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='cliente'){
                    echo "
                    <section class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>idCliente</th>
                                    <th>Nombre</th>
                                    <th>Contactos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                ";
                    $result = selectTableWhere("Cliente","estado","0");
                    while($fila = mysql_fetch_array($result)) {
                        echo "
                                 <tr>
                                    <td>".$fila['idCliente']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idcliente' value='".$fila['idCliente']."'>
                                            <input type='submit' class='btn-link' name='ver' value='Ver' formaction='vercontactos.php'>
                                        </form>
                                    </td>
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='idcliente' value='".$fila['idCliente']."'>
                                            <input type='hidden' name='selectrecuperar' value='cliente' readonly>
                                            <input type='submit' class='btn-link' name='recuperarcliente' value='Recuperar' formaction='recovery.php'>
                                        </form>
                                    </td>
                                </tr>
                    ";
                    }
                    echo "
                         </tbody>
                       </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='contacto'){
                    echo "
                    <section class='container'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Direccion</th>
                                    <th>Ciudad</th>
                                    <th>Pa&iacute;s</th>
                                    <th>Tel&eacute;fono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody> 
                            ";
                    $result = selectTableWhere("Contacto",'estado','0');
                    while($fila = mysql_fetch_array($result)) {
                        echo "
                                 <tr>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['apellido']."</td>
                ";
                        $result2=selectTableWhere("Direccion","idDireccion","'".$fila['idDireccion']."'");
                        while($fila2=mysql_fetch_array($result2)) {
                            echo "
                                    <td>".$fila2['direccion']."</td>
                ";
                            $result3=selectTableWhere("Ciudad","idCiudad","'".$fila2['idCiudad']."'");
                            while($fila3=mysql_fetch_array($result3)){
                                echo "
                                <td>".$fila3['nombre']."</td>
                            ";
                                $result4=selectTableWhere("Pais","idPais","'".$fila3['idPais']."'");
                                while($fila4=mysql_fetch_array($result4)){
                                    echo "
                                    <td>".$fila4['pais']."</td>
                                 
                    ";
                                }
                            }
                        }
                        $result7=selectTableWhere('ContactoTelefono','idContacto',"'".$fila['idContacto']."'");
                        while ($fila7=mysql_fetch_array($result7)){
                            echo "
                            <td>".$fila7['numTelefono']."</td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='idcontacto' value='".$fila['idContacto']."'>
                                    <input type='hidden' name='selectrecuperar' value='contacto' readonly>
                                    <input type='submit' class='btn-link' name='recuperarcontacto' value='Recuperar' formaction='recovery.php'>
                                </form>
                            </td>
                        ";
                        }
                        echo "
                                </tr>
                    ";
                    }
                    echo "
                         </tbody>
                       </table>
                    </section>";
                }elseif($_POST['selectrecuperar']=='confirmacion'){
                    echo "<section class='container'>
                            <table class='table table-hover'>
                                <thead>
                                <tr>
                                    <th>idConfirmaci&oacute;nVenta</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>";
                    $result=mysql_query("SELECT * FROM ConfirmacionVenta WHERE estado = '0' ORDER BY fecha");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                    <tr>
                                        <td>".$fila['idContrato']."</td>
                                        <td>".$fila['fecha']."</td>
                                ";
                        $result1=selectTableWhere('Contacto','idContacto',"'".$fila['idContacto']."'");
                        while ($fila1=mysql_fetch_array($result1)){
                            $result2=selectTableWhere('Cliente','idCliente',"'".$fila1['idCliente']."'");
                            while ($fila2=mysql_fetch_array($result2)){
                                echo "
                                                <td>".$fila2['nombre']."</td>
                                                <td>
                                                    <form action='verCV.php' method='post'>
                                                        <input type='hidden' name='contrato' value='".$fila['idContrato']."'>
                                                        <input type='hidden' name='idcodificacionTalla' value='".$fila['idcodificacionTalla']."'>
                                                        <input type='submit' class='btn-link' name='detalle' value='Ver Detalle'>
                                                    </form>
                                                </td>
                                                <td>
                                                <form action='gestionCV.php' method='post'>
                                                    <input type='hidden' name='contrato' value='".$fila['idContrato']."'>
                                                    <input type='hidden' name='selectrecuperar' value='confirmacion' readonly>
                                                    <input type='submit' name='recuperarcv' class='btn-link' value='Recuperar'>
                                                </form>
                                            </td>
                                            </tr>
                                        ";
                            }
                        }
                    }
                }
            }
        ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <footer class="panel-footer navbar-fixed-bottom">
        <div class="container col-sm-6 col-sm-offset-3 text-center">
            <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
        </div>
    </footer>

    </body>

    </html>
    <?php
}else{

    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>