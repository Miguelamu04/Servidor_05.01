<?php
include_once "configbd.php";
$conexion = new mysqli(SERVIDOR, USUARIO, CLAVE, NOMBRE_BD);

echo "<h2>Consulta 1: Muestra el nombre y el email de todos los usuarios registrados en la base de datos.</h2>";
$sql = "SELECT nombre, email FROM usuarios";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombre"] . " || " . "Email: " . $fila["email"] . "<br>";
}

echo "<h2>Consulta 2: Obtén los nombres y correos de los usuarios que viven en la ciudad de Badajoz.</h2>";
$sql = "SELECT usuarios.nombre as nombre, usuarios.email as email
		FROM usuarios
		INNER JOIN ciudades ON ciudades.idCiudad = usuarios.idCiudad
		where ciudades.nombre = 'Badajoz';
	";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombre"] . " || " . "Email: " . $fila["email"] . "<br>";
}

echo "<h2>Consulta 3: Muestra los nombres de los temas a los que está inscrito un usuario concreto (por ejemplo, Miguel).</h2>";
$sql = "SELECT usuarios.nombre as nombreUsuario, temas.nombre as nombreTemas
		FROM usuarios
		INNER JOIN usuarios_temas ON usuarios_temas.idUsuario = usuarios.idUsuario
		INNER JOIN temas ON temas.idTema = usuarios_temas.idTema
		where usuarios.nombre = 'Diego';
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreUsuario"] . " || " . "Tema: " . $fila["nombreTemas"] . "<br>";
}

echo "<h2>Consulta 4: Lista todos los usuarios junto con el nombre de su ciudad, aunque no tengan ninguna asociada.</h2>";
$sql = "SELECT usuarios.nombre as nombreUsuario, ciudades.nombre as nombreCiudad
		FROM usuarios
		LEFT JOIN ciudades ON ciudades.idCiudad = usuarios.idCiudad
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreUsuario"] . " || " . "Ciudad: " . $fila["nombreCiudad"] . "<br>";
}

echo "<h2>Consulta 5: Muestra los nombres de los usuarios que están apuntados a al menos un tema.</h2>";
$sql = "SELECT DISTINCT usuarios.nombre as nombreUsuario
		FROM usuarios
		INNER JOIN usuarios_temas ON usuarios_temas.idUsuario = usuarios.idUsuario
		INNER JOIN temas ON temas.idTema = usuarios_temas.idTema
		where temas.idTema > 0;
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreUsuario"] . "<br>";
}
?>