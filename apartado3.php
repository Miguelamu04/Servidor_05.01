<?php
    include "config.php";

    // CONFIGURACION DE LA BASE DE DATOS
    $sql = "DROP DATABASE IF EXISTS formulario";

        if($conexion->query($sql)){
            echo "Base de datos eliminada correctamente </br>";
        }else{
            echo "Error al eliminar la base de datos" . $conexion->Error;
        }
    
    $sql = "CREATE DATABASE formulario";

        if($conexion->query($sql)){
            echo "Base de datos creada correctamente </br>";
        }else{
            echo "Error al crear la base de datos" . $conexion->error;
        }

    // CONFIGURACION DE CREACION DE LAS TABLAS
    $conexion->select_db("formulario");
    $sql = "
            CREATE TABLE ciudades(
                idCiudades INT PRIMARY KEY AUTO_INCREMENT,
                nombre VARCHAR(100) NOT NULL
            )
            ;";
    $resultado = $conexion->query($sql);  
    
    // CONFIGURACION PARA INSERTAR DATOS
    $sql = "INSERT INTO ciudades (nombre) values
            ('Madrid'),
            ('Badajoz'),
            ('Sevilla'),
            ('Zafra'),
            ('Salamanca'),
            ('Malaga')
            ;";

            
    $resultado = $conexion->query($sql);
    if($resultado){
        echo "Tebla e inserts creados correctamente";
    }

    $conexion->close();

    header("Location: apartado5.php");
?>