<?php
require "./database.php";

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = limpiarDatosUsuario($_POST['email']);
    $password = limpiarDatosUsuario($_POST['password']);
    $seller = isset($_POST['seller']) ? 'vendedor' : 'usuario';

    // Consulta para obtener la contraseña
    $stmt = $conexion->prepare("SELECT id_persona, nombre, contrasenia, rol FROM usuario WHERE email = ? AND rol = ?");
    $stmt->bind_param("ss", $email, $seller); // "ss" indica dos cadenas
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo $user;
        print_r($user);
        // Verifica la contraseña ingresada contra la contraseña almacenado
        if ($password === $user['contrasenia']) {
            session_start();
            $_SESSION['usuario'] = $user['nombre'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['id_persona'] = $user['id_persona'];
            
            if ($user['rol'] === 'vendedor') {
                header("Location: ../view/vendedor/homeSeller.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            echo '<div class="alert alert-danger">Contraseña incorrecta.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">El usuario no existe o el rol es incorrecto.</div>';
    }
    $stmt->close();
} else {
    echo '<div class="alert alert-danger">Los campos están vacíos.</div>';
}

?>