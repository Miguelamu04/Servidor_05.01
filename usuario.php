<?php
include_once "conexion.php";

class Usuario extends Conexion {
    private $nombre;
    private $email;
    private $idCiudad;
    private $temas = [];
    
    public function __construct($nombre, $email, $idCiudad, $temas = []) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->idCiudad = $idCiudad;
        $this->temas = $temas;
    }
    
    public function validarEmail() {
        try {
            $conexion = $this->conectar();
            $sql = "SELECT email FROM usuarios WHERE email = '$this->email'";
            $resultado = $conexion->query($sql);
            $this->desconectar();
            
            if ($resultado && $resultado->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $error) {
            if ($error) {
                echo "Error ({$error->getCode()}): " . $error->getMessage() . "<br>";
            }
        }
    }
    
    public function guardarUsuario() {
        try {
            $conexion = $this->conectar();
            $sql = "INSERT INTO usuarios (nombre, email, idCiudad) VALUES
                    ('$this->nombre', '$this->email', '$this->idCiudad')";
            
            if ($conexion->query($sql)) {
                $idUsuario = $conexion->insert_id;
                echo "Usuario insertado correctamente<br>";
            } else {
                echo "Error al insertar el usuario<br>";
            }
            
            $this->desconectar();
            return $idUsuario;
        } catch (Exception $error) {
            if ($error) {
                echo "Error ({$error->getCode()}): " . $error->getMessage() . "<br>";
            }
        }
    }
    
    public function guardarUsuario_Temas($idUsuario) {
        try {
            $conexion = $this->conectar();
            foreach ($this->temas as $idTema) {
                $sql = "INSERT INTO usuarios_temas (idUsuario, idTema) VALUES ($idUsuario, $idTema)";
                if ($conexion->query($sql)) {
                    echo "Temas y usuarios insertados correctamente<br>";
                } else {
                    echo "Error al insertar los temas al usuario<br>";
                }
            }
            $this->desconectar();
        } catch (Exception $error) {
            if ($error) {
                echo "Error ({$error->getCode()}): " . $error->getMessage() . "<br>";
            }
        }
    }
}
?>
