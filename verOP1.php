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
        <title>Ver Orden de Producción</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/estiloCV.css" rel="stylesheet">

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
                        <a class="navbar-brand" href="mainAdmin.php">Waka-s</a>
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

        <section>
            <div>
                <img align="left" WIDTH="110" HEIGHT="110" src="image/logowakas.jpg" border=10/>
            </div>
            <div>
                <label>Waka-s <span>Textiles Finos SAC</span></label>
            </div>
            <div>
                <label>Urb. Francisco Mostajo G-25</label>
            </div>
            <div>
                <label>04002 Arequipa - Peru</label>
            </div>
        </section>

        <section>
            <h2>&Oacute;rden de Producci&oacute;n</h2>
      	</section>

        <section>
            <div>
               <span>Nro de &Oacute;rden:
                   <?php
                   $result=selectTableWhere('OrdenProduccion','idOrdenProduccion',
                       "'".$_POST['ordenprod']."'");
                   while ($fila3=mysql_fetch_array($result)){
                       echo "<span>".$_POST['ordenprod']."</span>";
                       $idContract=$fila3['idContrato'];
                   }
                   ?>
               </span>
            </div>
            <div>
                <span>Contrato:
                    <?php
                    echo "
                        <span>".$idContract."</span>
                    ";
                    ?>
                </span>
            </div>
            <div>
               <span>ID Cliente:
                   <?php
                   $result1=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                   while($fila=mysql_fetch_array($result1)){
                       $result2=selectTableWhere('Contacto','idContacto',"'".$fila['idContacto']."'");
                       while ($fila1=mysql_fetch_array($result2)){
                           $result3=selectTableWhere('Cliente','idCliente',"'".$fila1['idCliente']."'");
                           while ($fila2=mysql_fetch_array($result3)){
                               echo "
                                    <span>".$fila2['nombre']."</span>
                               ";
                           }
                       }
                   }
                   ?>
               </span>
            </div>
        </section>
        <section>
            <div>
               <span>Fecha de Creaci&oacute;n:
                   <?php
                   $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                   while ($fila=mysql_fetch_array($result)){
                       echo "
                           <span>".$fila['fecha']."</span>
                       ";
                   }
                   ?>
               </span>
            </div>
            <div>
                <span>Creado por:<span>EFG</span></span><br/>
            </div>
            <div>
                <span>Fecha de Env&iacute;o:
                    <?php
                    $result=selectTableWhere('ConfirmacionVenta','idContrato',"'".$idContract."'");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                            <span>".$fila['shipdate']."</span>
                        ";
                    }
                    ?>
                </span>
            </div>
        </section>

        <section>
            <table class="table table-bordered" border="1">
                <thead>
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
                    $result1="SELECT * FROM Lote WHERE idOrdenProduccion ='".$_POST['ordenprod']."' ORDER BY idProducto ASC";
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

        <section>
            <form action="gestionOP.php" method="post">
                <input class="btn btn-default" type="submit" name="regresar" value="Regresar">
            </form>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>

    </body>
    <footer>

    </footer>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>