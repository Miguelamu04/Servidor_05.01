<?php
    include "config.php";
    $resultado = $conexion->query("SELECT * FROM ciudades");
    while ($fila = $resultado->fetch_array()) {
        echo 'ID: ' . $fila['idCiudades'] . ' - Nombre: ' . $fila['nombre'] . '</br>';
    }
?>