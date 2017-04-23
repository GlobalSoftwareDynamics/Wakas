<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
?>
<html lang="es">
   <head>

    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>Ver Órden de Producción</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Tablas.css" rel="stylesheet">
       <link href="css/Formatos.css" rel="stylesheet">

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

       <section class="container-fluid">
           <div class="col-sm-1">
               <div>
                   <img width="110" height="110" src="image/logowakas.jpg"/>
               </div>
           </div>
           <div class="col-sm-7" id="descripcionbrand">
               <div>
                   <span id="brand">W<span class="alfa">&alpha;</span>k<span class="alfa">&alpha;</span>-s <span id="subbrand">Textiles Finos SAC</span></span>
               </div>
               <div>
                   <span>Urb. Francisco Mostajo G-25</span>
               </div>
               <div>
                   <span>04002 Arequipa - Peru</span>
               </div>
           </div>
           <div class="col-sm-3">
               <div class="titulo">
                   <h3>Órden de Producción</h3>
               </div>
           </div>
       </section>
       <hr>

        <section class="container-fluid">
            <div class="col-sm-9">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="idop">Nro de &Oacute;rden:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                        $result=selectTableWhere('OrdenProduccion','idContrato',"'".$_POST['contrato']."'");
                        while ($fila3=mysql_fetch_array($result)){
                            echo "<span id='idop'>".$fila3['idOrdenProduccion']."</span>";
                            $idOP=$fila3['idOrdenProduccion'];
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="cont">Contrato:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                        echo "
                        <span id='cont'>".$_POST['contrato']."</span>
                    ";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label for="cliente">ID Cliente:</label>
                    </div>
                    <div class="col-sm-10">
                        <?php
                        $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
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
            <div class="col-sm-3">
                <div class="col-sm-12">
                    <div class="col-sm-8">
                        <label for="fechacre">Fecha de Creaci&oacute;n:</label>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
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
                        <label for="creador">Creado por:</label>
                    </div>
                    <div class="col-sm-4">
                        <span id="creador">EFG</span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-8">
                        <label for="fechaen">Fecha de Env&iacute;o:</label>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$_POST['contrato']."'");
                        while ($fila=mysql_fetch_array($result)){
                            echo "
                                <span id='fechaen'>".$fila['shipdate']."</span>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <table class="table table-condensed">
                <thead id="theadborder">
                    <tr>
                        <th>Lote</th>
                        <th>idLote</th>
                        <th>idProducto</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $aux3=1;
                $result1="SELECT * FROM Lote WHERE idOrdenProduccion ='".$idOP."' ORDER BY idProducto ASC";
                $result=mysql_query($result1);
                while ($fila=mysql_fetch_array($result)){
                    echo "
                                <tr>
                                    <td>".$aux3."</td>
                                    <td>".$fila['idLote']."</td>
                                    <td>".$fila['idProducto']."</td>
                                    <td>".$fila['material']."</td>
                                    <td>".$fila['idColor']."</td>
                                    <td>".$fila['idTalla']."</td>
                                    <td>".$fila['cantidad']."</td>
                                </tr>
                            ";
                    $aux3++;
                }
                ?>
                </tbody>
            </table>
        </section>
        <br>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>

   </body>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>
