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
    <meta name="apple-mobile-web-app-title" content="Waka-s">
    <meta name="application-name" content="Waka-s">
    <meta name="theme-color" content="#ef4a43">
    <title>Registar datos</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/Formularios.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <script>
        function getproduct(val) {
            $.ajax({
                type: "POST",
                url: "get_product.php",
                data:'idlote='+val,
                success: function(data){
                    $("#productos").html(data);
                }
            });
        }
        function getprocesos(val) {
            $.ajax({
                type: "POST",
                url: "get_procesos.php",
                data:{'lote':val},
                success: function(data){
                    $("#proceso").html(data);
                }
            });
        }
        function getprocedim() {
            var lote = document.getElementById('lot').value;
            var producto = document.getElementById('product').value;
            var proceso = document.getElementById('proceso').value;
            $.ajax({
                type: "POST",
                url: "get_proce.php",
                //
                data:'lote=' + lote +' &producto=' + producto,
                success: function(data){
                    $("#procedi").html(data);
                }
            });
        }
        function getcomponentes() {
            var lote = document.getElementById('lot').value;
            var producto = document.getElementById('product').value;
            var procedimiento = document.getElementById('procedi').value;
            $.ajax({
                type: "POST",
                url: "get_comps.php",
                data:'lote=' + lote + '&producto=' + producto + '&procedimiento=' + procedimiento,
                success: function(data){
                    $("#componentes").html(data);
                }
            });
        }
        function getcantidadlote() {
            var lote = document.getElementById('lot').value;
            var producto = document.getElementById('product').value;
            var procedimiento = document.getElementById('procedi').value;
            var componente = document.getElementById('componentes').value;
            $.ajax({
                type: "POST",
                url: "get_cantlote.php",
                data:'lote=' + lote + '&producto=' + producto + '&procedimiento=' + procedimiento+ '&componente=' + componente,
                success: function(data){
                    $("#canti").html(data);
                }
            });
        }
    </script>

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
                <a href="mainOperario.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="mainOperario.php">Inicio</a></li>
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
                <label for="lot" class="formlabelscel col-xs-12">Indique el idLote:</label>
            </div>
            <div class="col-xs-12">
                <input class="textinput-12" id="lot" type="text" name="idlote" oninput="getproduct(this.value); getprocesos(this.value)">
            </div>
        </div>
        <div id="productos">
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="proceso" class="formlabelscel col-xs-12">Seleccione Proceso:</label>
            </div>
            <div class="col-xs-12">
                <select id="proceso" name="proce" class="ddselect-12" onChange='getprocedim();'>
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="procedi" class="formlabelscel col-xs-12">Seleccione Procedimiento:</label>
            </div>
            <div class="col-xs-12">
                <select id="procedi" name="procedimiento" class="ddselect-12" onChange='getcomponentes(this.value);'>
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for='componentes' class="formlabelscel col-xs-12">Seleccione Componente o Parte:</label>
            </div>
            <div class="col-xs-12">
                <select id='componentes' class="ddselect-12" name='componente' onChange='getcantidadlote();'>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="cant" class="formlabelscel col-xs-12">Cantidad Terminada:</label>
            </div>
            <div class="col-xs-12" id="canti">
                <input id="cant" type="text" name="cantidad" class="textinput-12">
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" name="siguiente" value="Guardar">
            </div>
        </div>
    </form>
</section>
<script src="js/bootstrap.min.js"></script>
<footer class="panel-footer navbar-fixed-bottom">
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.<br>Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
</body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifiquese.";
}
?>