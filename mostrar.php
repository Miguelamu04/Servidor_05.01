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

echo "<h2>Consulta 6: Lista los usuarios junto con los temas que han elegido y la fecha en que los seleccionaron.</h2>";
$sql = "SELECT usuarios.nombre AS nombreUsuario, temas.nombre as nombreTema, fecha
		FROM usuarios
		INNER JOIN usuarios_temas ON usuarios_temas.idUsuario = usuarios.idUsuario
		INNER JOIN temas ON temas.idTema = usuarios_temas.idTema
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreUsuario"] . " || " . "Tema: " . $fila["nombreTema"] . " || " . $fila["fecha"]. "<br>";
}

echo "<h2>Consulta 7: Muestra los nombres de las ciudades que no tienen ningún usuario registrado.</h2>";
$sql = "SELECT ciudades.nombre AS nombreCiudad
		FROM ciudades
		LEFT JOIN usuarios ON usuarios.idCiudad = ciudades.idCiudad
		where usuarios.idUsuario is NULL
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreCiudad"] . "<br>";
}

echo "<h2>Consulta 8: Obtén los nombres de los temas que no han sido elegidos por ningún usuario.</h2>";
$sql = "SELECT temas.nombre AS nombreTema
		FROM temas
		LEFT JOIN usuarios_temas ON usuarios_temas.idTema = temas.idTema
		LEFT JOIN usuarios ON usuarios.idUsuario = usuarios_temas.idUsuario
		where usuarios.idUsuario is NULL
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreTema"] . "<br>";
}

echo "<h2>Consulta 9: Muestra los usuarios cuyo correo electrónico pertenece al dominio “gmail.com”.</h2>";
$sql = "SELECT usuarios.nombre AS nombreUsuario
		FROM usuarios
		where email LIKE '%gmail.com'
";
$resultado = $conexion->query($sql);

while($fila = $resultado->fetch_assoc()){
	echo "Nombre: " . $fila["nombreUsuario"] . "<br>";
}

echo "<h2>Consulta 10: Muestra los nombres de los temas que no han sido elegidos por ningún usuario.</h2>";

$sql = "SELECT temas.nombre AS nombreTema
        FROM temas
        LEFT JOIN usuarios_temas ON usuarios_temas.idTema = temas.idTema
        WHERE usuarios_temas.idUsuario IS NULL;";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    echo "Tema no elegido: " . $fila["nombreTema"] . "<br>";
}
?>
