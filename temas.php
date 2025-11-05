<?php
include_once "conexion.php";

class Temas extends Conexion {
    public function obtenerTemas() {
        try {
            $conexion = $this->conectar();
            $sql = "SELECT idTema, nombre FROM temas";
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
