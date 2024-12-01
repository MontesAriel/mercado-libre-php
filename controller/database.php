<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $basededatos = "tp-final-php";
    
    // Crea la conexión a la base de datos
    $conexion = new mysqli($servidor, $usuario, $clave, $basededatos);
    
    // Prueba la conexión
    if($conexion->connect_error) {
        die("Error al intentar conectar la base de datos: " . $conexion->connect_error);
    }
    
    // Limpiar los datos del usuario
    function limpiarDatosUsuario($dato){
        $dato = trim($dato);
        $dato = htmlspecialchars(stripslashes($dato));
        return $dato;
    }

    // $nombre = mysqli_real_escape_string($mysqli, $nombre);

?>