<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	 	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Waka-s login</title>
    	
		<script src="js/pace.js"></script>
    	<link href="css/bootstrap.css" rel="stylesheet">
    	<link href="css/theme.css" rel="stylesheet">
    	<link href="css/font-awesome.css" rel="stylesheet">
    	<link href="css/animate.css" rel="stylesheet">
		<link href="css/fonts1.css" type='text/css'>
		<link href="css/theme-loading-bar.css" rel="stylesheet" />
        <link href="css/Formularios.css" rel="stylesheet">
    
	</head>
<?php 
	require("funciones.php");
    mysql_query("SET NAMES 'utf8'");
	conexion();
	session_start();
	session_unset();
	session_destroy();
	$bandera = false;
	if(isset($_POST["user"])) {
		$datos=selectTable("empleado");
		while($fila=mysql_fetch_array($datos)){
			if($_POST["user"] == $fila['usuario'] && $_POST["password"] == $fila['contrasena']) {
				session_start();
	
				$_SESSION['login'] = $_POST["user"];
				$_SESSION['nombre']	= $fila['nombres'];
					
				if(isset($_POST['verifica'])) {
					setcookie("user", $_POST['user'], time()+30);
				}
				switch($fila['idTipoUsuario']){
					case 1:
						header("Location: mainAdmin.php");
						break;
					case 2:
						header("Location: mainOperario.php");
						break;
				}
				$bandera = false;
				break;
			}else {
				$bandera = true;
			}
		}
	}
?>


	
	<body>
		<div class="container" id="container" style="display:none;">
		<section id="form" class="animated fadeInDown">
			<div class="container">    
				<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel white-alpha-90" >
						<div class="panel-heading">
							<div class="panel-title text-center"><h3>Ingresar al Portal</h3></div>
							</div>     
							<div class="panel-body" >
								<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
									<form method="POST" id="loginform" class="form-horizontal" role="form">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input id="login-username" type="text" class="form-control" name="user" value="<?php if(isset($_COOKIE ['user'])) echo $_COOKIE ['user'];?>" placeholder="Usuario" required autofocus>
									</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input id="login-password" type="password" class="form-control" name="password" placeholder="Contrase&ntilde;a" required>
								</div>
								<div class="input-group col-xs-12 text-center login-action">
								  <div 	class="checkbox1">
									<label style="cursor: pointer; font-weight:normal">
									  <input id="login-remember" type="checkbox" name="verifica" value="1" style="margin-top: 10px;"> Recordarme &nbsp;
									  <span id="btn-login"><button type="submit" class="btn btn-success">Ingresar</button></span>
									  <?php
						                if($bandera) {
						                    echo "<div class='alert alert-danger' role='alert'>";
                    						echo 	"<p> <strong>Error! Clave o nombre de usuario incorrectos</strong></p>";
                    						echo " </div>";
						                }
						              ?>
									</label>
								  </div>
								</div>
								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
									</div>
								</div>
							</form>     
						</div>                     
					</div>  
				</div>
			</div>
		</section>
	</div>
									
		<!-- Codigo original -->
		
			<!-- <form method="POST" class="form-signin">
			<input id="inputEmail" type="text" name="user" value="<?php if(isset($_COOKIE ['user'])) echo $_COOKIE ['user'];?>"/>
			<label>Contrase&ntilde;a:</label>
			<input type="password" name="password"/>
			<label>Recordarme</label>
			<input type="checkbox" name="verifica" value="1"/>
			<button type="submit" class="btn btn-sm btn-success">Ingresar</button>
			<?php
                if($bandera) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo 	"<p> <strong>Error! Clave o nombre de usuario incorrectos</strong></p>";
                    echo " </div>";
                }
            ?>
		</form>
		</div>-->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.backstretch.min.js"></script>

	<script>
		Pace.on('hide', function(){
		  $("#container").fadeIn('1000');
		  $.backstretch([
				"image/alpacas3.jpg",
				"image/alpacas.jpg"
			], {duration: 5000, fade: 2000});
		});
		
	</script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-53918379-1', 'auto');
	  ga('send', 'pageview');

	</script>
	</body>
</html>