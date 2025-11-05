<?php
include_once "conexion.php";

class Ciudades extends Conexion {
    public function obtenerCiudades() {
        try {
            $conexion = $this->conectar();
            $sql = "SELECT idCiudad, nombre FROM ciudades";
            $resultado = $conexion->query($sql);
            $this->desconectar();
            return $resultado;
        } catch (Exception $error) {
            if ($error) {
                echo "Error ({$error->getCode()}): " . $error->getMessage() . "<br>";
            }
        }
    }
}
?>
