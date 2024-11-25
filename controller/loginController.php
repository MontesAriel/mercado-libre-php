<?php
require "./database.php";

//verificamos si los campos no estan vacios
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consulta segura con sentencia preparada
    $stmt = $conexion->prepare("SELECT nombre FROM usuario WHERE email = ? AND contrasenia = ?");
    $stmt->bind_param("ss", $email, $password); // "ss" indica dos cadenas
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        session_start();
        $_SESSION['usuario'] = $user['nombre'];
        header("Location: ../index.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">EL USUARIO NO EXISTE</div>';
    }
    $stmt->close();
} else {
    echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
}


?>