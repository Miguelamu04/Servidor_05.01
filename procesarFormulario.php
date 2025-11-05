<?php
include_once "usuario.php";

if(empty($_POST["nombre"]) || empty($_POST["email"]) || empty($_POST["idCiudad"])){
	echo "Error: campos vacios";
}else if(!isset($_POST["temas"])){
	echo "No ha seleccionado ningun tema";
}else{
	
	$nombre = $_POST["nombre"];
	$email = $_POST["email"];
	$idCiudad = $_POST["idCiudad"];
	$temas = $_POST["temas"];
	
	$usuario = new Usuario($nombre, $email, $idCiudad, $temas);
	
	//Verificamos email y llamamos a las funciones
	if(!$usuario->validarEmail()){
		$idUsuario = $usuario->guardarUsuario();
		if($idUsuario){
			$usuario->guardarUsuario_Temas($idUsuario);
			echo "Usuarios y temas insertados correctamente<br>";
		}else{
			echo "Error al insertar el usuario";
		}	
	}else{
		echo "El email: '$email' ya esta en la base de datos";
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>
