<?php
include_once "configbd.php";

class Conexion {
    protected $conexion;
    
    public function conectar() {
        try {
            $this->conexion = new mysqli(SERVIDOR, USUARIO, CLAVE, NOMBRE_BD);
            return $this->conexion;
        } catch (Exception $error) {
            if ($error) {
                echo "Error ({$error->getCode()}): " . $error->getMessage() . "<br>";
            }
        }
    }
    
    public function desconectar() {
        try {
            $this->conexion->close();
            return $this->conexion;
        } catch (Exception $error) {
            if ($error) {
                echo "Error al desconectar ({$error->getCode()}): " . $error->getMessage() . "<br>";
            }
        }
    }
}
?>
