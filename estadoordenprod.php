<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Waka-s Textiles Finos S.A.</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="css/Formatos.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mainAdmin.php" id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                            <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
                            <li><a href="rendimiento.php">Visualizaci&oacuten de Rendimiento</a></li>
                            <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operaciones<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                            <li><a href="nuevaHE.php">Nueva Hoja de Especificaciones</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informaci&oacuten Interna<span class="caret"></span></a>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contactos<span class="caret"></span></a>
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
    $op=strtoupper ($_POST["idop"]);
?>
<section class='container-fluid'>
    <div class='col-sm-1'>
        <div>
            <img width='110' height='110' src='image/logowakas.jpg'/>
        </div>
    </div>
    <div class='col-sm-6' id='descripcionbrand'>
        <div>
            <span id='brand'>W<span class='alfa'>&alpha;</span>k<span class='alfa'>&alpha;</span>-s <span id='subbrand'>Textiles Finos SAC</span></span>
        </div>
        <div>
            <span>Urb. Francisco Mostajo G-25</span>
        </div>
        <div>
            <span>04002 Arequipa - Peru</span>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='titulo'>
            <h3>Seguimiento de Orden de Producción</h3>
        </div>
        <div>
            <h4 class='desctitulo'>
                <?php
                    echo $op;
                ?>
            </h4>
        </div>
    </div>
</section>
<hr>
<section class="container-fluid">
    <div class="col-sm-8">
                <?php
                $result=selectTableWhere('OrdenProduccion','idOrdenProduccion',"'".$op."'");
                while ($fila3=mysql_fetch_array($result)){
                    $idContract=$fila3['idContrato'];
                }
                ?>
        <div class="col-sm-12">
            <div class="col-sm-2">
                <label for="contrato">Contrato:</label>
            </div>
            <div class="col-sm-10">
                <?php
                echo "
                    <span id='contrato'>".$idContract."</span>
                ";
                ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-2">
                <label for="cliente">Cliente:</label>
            </div>
            <div class="col-sm-10">
                <?php
                $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                while($fila=mysql_fetch_array($result1)){
                    $result2=selectTableWhere('Contacto','idContacto',"'".$fila['idContacto']."'");
                    while ($fila1=mysql_fetch_array($result2)){
                        $result3=selectTableWhere('Cliente','idCliente',"'".$fila1['idCliente']."'");
                        while ($fila2=mysql_fetch_array($result3)){
                            echo "
                                        <span id='cliente'>".$fila2['nombre']."</span>
                                   ";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-12">
            <div class="col-sm-8">
                <label for="fechacre">Fecha de Creaci&oacute;n:</label>
            </div>
            <div class="col-sm-4">
                <?php
                $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                while ($fila=mysql_fetch_array($result)){
                    echo "
                                    <span id='fechacre'>".$fila['fecha']."</span>
                                ";
                }
                ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-8">
                <label for="fechaen">Fecha de Env&iacute;o:</label>
            </div>
            <div class="col-sm-4">
                <?php
                $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                while ($fila=mysql_fetch_array($result)){
                    echo "
                                    <span id='fecahen'>".$fila['shipdate']."</span>
                                ";
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>idLote</th>
            <th>idProducto</th>
            <th>% Avance</th>
            <th>Detalle</th>
        </tr>
        </thead>
        <tbody>
        <?php
        echo "<tr>";
        $avance=0;
        $avanceOP=0;
        $numlotes=0;
        $result4=selectOrderedTableWhere('Lote','idOrdenProduccion',"'".$op."'",'posicion');
        while ($fila4=mysql_fetch_array($result4)){
            $cantidadlote=$fila4['cantidad'];
            $numproce=0;
            $cantidadcomponente=0;
            $result6=selectTableWhere('ProductoComponentesPrenda','idProducto',"'".$fila4['idProducto']."'");
            while ($fila6=mysql_fetch_array($result6)){
                $result7=selectTableWhere2('PCPSPC','idSubProcesoCaracteristica','"SUBPROCESOCARAC34"','idComponenteEspecifico',"'".$fila6['idComponenteEspecifico']."'");
                while ($fila7=mysql_fetch_array($result7)){
                    $numfila=$fila7['fila'];
                    $result8=selectTableWhere('PCPSPC','fila',"'".$numfila."'");
                    while ($fila8=mysql_fetch_array($result8)){
                        if($fila8['valor']=="MAQUINA9"||$fila8['valor']=="MAQUINA8"){
                            $numproce++;
                            $result5=selectTableWhere3('EmpleadoLote','idLote',"'".$fila4['idLote']."'",'idProcedimiento',"'".$fila7['valor']."'",'idComponenteEspecifico',"'".$fila6['idComponenteEspecifico']."'");
                            while ($fila5=mysql_fetch_array($result5)){
                                $cantidadcomponente=$cantidadcomponente+$fila5['cantidad'];
                            }
                        }
                    }
                }
            }
            $numlotes++;
            $avance=($cantidadcomponente/($numproce*$cantidadlote));
            $avance1=round($avance*100,2,1);
            $avanceOP=($avanceOP+$avance);
            echo "<td>".$fila4['idLote']."</td>";
            echo "<td>".$fila4['idProducto']."</td>";
            echo "<td>".$avance1." %</td>";
            echo "<td>
                      <form action='seguimientoproducto.php' method='post'>
                            <input type='hidden' value='".$fila4['idLote']."' name='idlote'>
                            <input type='submit' class='btn-link' value='Detalle de Lote'>
                      </form>
                  </td>
            ";
            echo "</tr>";
        }
        $avanceOP=$avanceOP/$numlotes;
        $avanceOP1=round($avanceOP*100,2,1);
        echo "<tr>";
        echo "
            <td>Avance Total</td>
            <td></td>
            <td>".$avanceOP1." %</td>
            <td></td>
        ";
        echo "</tr>";
        ?>
        </tbody>
    </table>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>