<?php
	session_start();
	include_once('datosBD.php');
	if (isset($_POST['usuario']) && isset($_POST['password'])) {
		$usuario = addslashes($_POST['usuario']);
		$password = addslashes($_POST['password']);
		
		if (array_key_exists($usuario, $usuarios)) {
			
			if (strcmp ($password , $usuarios[$usuario]['passw'] ) == 0) {
				$_SESSION['usuario'] = $usuario;
				if(isset($_POST['recordar'])&&$_POST['recordar']=="1"){
					setcookie("recordar_usuario", $usuario, (time()+60*60*24*30));
					setcookie("recordar_password", $password, (time()+60*60*24*30));
				}
				header("Location:../menu_usuario.php");
			} else {
				$_SESSION['error'] = "La contraseña no coincide.";
				header("Location:../index.php");
			}
		} else {
			$_SESSION['error'] = "El usuario es incorrecto.";
			
			header("Location:../index.php");
		}
	}
?>