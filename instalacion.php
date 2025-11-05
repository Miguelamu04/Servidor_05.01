<?php
include_once "configbd.php";

try{
	$conexion= new mysqli(SERVIDOR, USUARIO, CLAVE);

	//Borramos la bdd si ya existe
	$sql = "DROP DATABASE cursos_online";
	if($conexion->query($sql)){
		echo "Bdd borrada correctamente<br>";
	}else{
		echo "Error al borrar la bdd: " . $conexion->error;
	}
	
	//Creamos la bdd
	$sql = "CREATE DATABASE cursos_online";
	if($conexion->query($sql)){
		echo "Bdd creada correctamente<br>";
	}else{
		echo "Error al crear la bdd: " . $conexion->error;
	}
	
	//Seleccionamos la bdd
	$conexion->select_db("cursos_online");
	
	//Creamos las tablas
	$sql = "CREATE TABLE ciudades(
			idCiudad TINYINT UNSIGNED AUTO_INCREMENT,
			nombre VARCHAR(150) NOT NULL,
			CONSTRAINT pk_idCiudad PRIMARY KEY (idCiudad)
	);";
	if($conexion->query($sql)){
		echo "Tabla ciudades creada correctamente<br>";
	}else{
		echo "Error al crear la tabla ciudades: " . $conexion->error;
	}
	
	$sql = "CREATE TABLE temas(
			idTema TINYINT UNSIGNED AUTO_INCREMENT,
			nombre VARCHAR(150) NOT NULL,
			CONSTRAINT pk_idTema PRIMARY KEY (idTema)
	);";
	if($conexion->query($sql)){
		echo "Tabla temas creada correctamente<br>";
	}else{
		echo "Error al crear la tabla temas: " . $conexion->error;
	}
	
	$sql = "CREATE TABLE usuarios(
			idUsuario INT UNSIGNED AUTO_INCREMENT,
			nombre VARCHAR(150) NOT NULL,
			email VARCHAR(150) NOT NULL,
			idCiudad TINYINT UNSIGNED,
			CONSTRAINT pk_idUsuario PRIMARY KEY (idUsuario),
			CONSTRAINT fk_idCiudad FOREIGN KEY (idCiudad) REFERENCES ciudades (idCiudad)
	);";
	if($conexion->query($sql)){
		echo "Tabla usuarios creada correctamente<br>";
	}else{
		echo "Error al crear la tabla usuarios: " . $conexion->error;
	}
	
	$sql = "CREATE TABLE usuarios_temas(
			idUsuario INT UNSIGNED,
			idTema TINYINT UNSIGNED,
			fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			CONSTRAINT pk_idUsuario_idTema PRIMARY KEY (idUsuario, idTema),
			CONSTRAINT fk_idUsuario FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE,
			CONSTRAINT fk_idTema FOREIGN KEY (idTema) REFERENCES temas (idTema) ON DELETE CASCADE ON UPDATE CASCADE
	);";
	if($conexion->query($sql)){
		echo "Tabla usuarios_temas creada correctamente<br>";
	}else{
		echo "Error al crear la tabla usuarios_temas: " . $conexion->error;
	}
	
	//Inserts checkbox y select
	
	
	$sql = "INSERT INTO ciudades (nombre) VALUES
			('Badajoz'),
			('Zafra'),
			('Sevilla'),
			('Teruel'),
			('Granada')
	";
	if($conexion->query($sql)){
		echo "Insert ciudades realizados correctamente<br>";
	}else{
		echo "Error al insertar ciudades: " . $conexion->error;
	}
	
	$sql = "INSERT INTO temas (nombre) VALUES
			('Programacion'),
			('Base de datos'),
			('Fol'),
			('Sostenibilidad'),
			('Interface'),
			('Cliente'),
			('Servidor'),
			('NoSQL')
	";
	if($conexion->query($sql)){
		echo "Insert temas realizados correctamente<br>";
	}else{
		echo "Error al insertar ciudades: " . $conexion->error;
	}
	
}catch(Exception $e){
	echo $e->getMessage();
}
?>