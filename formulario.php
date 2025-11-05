<?php
include_once "ciudades.php";
include_once "temas.php";

// Instanciamos las clases
$ciudad = new Ciudades();
$tema = new Temas();

// Obtenemos los resultados de las consultas
$resultadoCiudades = $ciudad->obtenerCiudades();
$resultadoTemas = $tema->obtenerTemas();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mi formulario</title>
</head>
<body>
    <h1>Formulario</h1>
    <form action="procesarFormulario.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre del usuario" required>
        
        <br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email del usuario" required>
        
        <br><br>
        
        <label for="ciudad">Ciudad:</label>
        <select name="idCiudad">
            <option value="">-- Selecciona una opción --</option>
            <?php
                // Generamos las opciones del select
                while ($fila = $resultadoCiudades->fetch_assoc()) {
                    echo "<option value='" . $fila['idCiudad'] . "'>" . $fila['nombre'] . "</option>";
                }
            ?>
        </select>
        
        <br><br>

        <fieldset>
            <legend>Temas de interés:</legend>
            <?php
                // Generamos los checkboxes
                while ($fila = $resultadoTemas->fetch_assoc()) {
                    echo "<label>";
                    echo "<input type='checkbox' name='temas[]' value='" . $fila['idTema'] . "'> " . $fila['nombre'];
                    echo "</label><br>";
                }
            ?>
        </fieldset>

        <br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpiar">
    </form>
</body>
</html>
