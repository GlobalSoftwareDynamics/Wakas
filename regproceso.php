<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registar datos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Formularios.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <script>
        function getcomponentes(val) {
            $.ajax({
                type: "POST",
                url: "get_comps.php",
                data:'producto_id='+val,
                success: function(data){
                    $("#componentes").html(data);
                }
            });
        }
    </script>

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
                <a class="navbar-brand" href="mainOperario.php">W<span>&alpha;</span>k<span>&alpha;</span>-s Textiles</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="mainOperario.php">Inicio</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<section class="container">
    <form action="regproceso1.php" method="post" class="form-horizontal jumbotron col-xs-12">
        <div class="form-group">
            <div class="col-xs-12">
                <label for="dni" class="formlabelscel col-xs-12">DNI:</label>
            </div>
            <div class="col-xs-12">
                <input class="textinput-12" id="dni" type="text" name="idempleado" value="<?php echo $_POST['idempleado'];?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="product" class="formlabelscel col-xs-12">Seleccione Producto:</label>
            </div>
            <div class="col-xs-12">
                <select id="product" name="producto" class="ddselect-12" onChange='getcomponentes(this.value);'>
                    <option>Seleccionar</option>
                    <?php
                    $result=selectTable("Producto");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                                <option value='".$fila['idProducto']."'>".$fila['idProducto']."</option>
                            ";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for='componentes' class="formlabelscel col-xs-12">Seleccione Componente:</label>
            </div>
            <div class="col-xs-12">
                <select id='componentes' class="ddselect-12" name='componente'>
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="procedi" class="formlabelscel col-xs-12">Procedimiento:</label>
            </div>
            <div class="col-xs-12">
                <select id="procedi" name="procedimiento" class="ddselect-12">
                    <?php
                        $result1=selectTable("SubProceso");
                        while ($fila1=mysql_fetch_array($result1)){
                            echo "
                                <option value='".$fila1['idProcedimiento']."'>".$fila1['descripcion']."</option>
                            ";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="cant" class="formlabelscel col-xs-12">Cantidad Terminada:</label>
            </div>
            <div class="col-xs-12">
                <input id="cant" type="text" name="cantidad" class="textinput-12">
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="btn btn-default col-xs-10 col-xs-offset-1" type="submit" name="siguiente" value="Guardar">
            </div>
        </div>
    </form>
</section>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>