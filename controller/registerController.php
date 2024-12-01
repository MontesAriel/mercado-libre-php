<?php
    require "./database.php";
    session_start();
    // Registrar un nuevo registro en la tabla "usuarios"
    function registrarUsuario($nombre, $apellido, $email, $celular, $birth, $password, $seller){
        global $conexion; // Hace accesible la variable $conexion definida fuera de la función
    
        // Limpiar y proteger datos
        $nombre = mysqli_real_escape_string($conexion, limpiarDatosUsuario($nombre));
        $apellido = mysqli_real_escape_string($conexion, limpiarDatosUsuario($apellido));
        $email = mysqli_real_escape_string($conexion, limpiarDatosUsuario($email));
        $celular = mysqli_real_escape_string($conexion, limpiarDatosUsuario($celular));
        $birth = mysqli_real_escape_string($conexion, limpiarDatosUsuario($birth));
        $password = mysqli_real_escape_string($conexion, limpiarDatosUsuario($password));
        $seller = $seller ? 'vendedor' : 'usuario';
        
        // //hash contraseña
        // $password = password_hash($password, PASSWORD_BCRYPT);

         // Verificar si el email ya está registrado
        $queryEmailCheck = "SELECT id_persona FROM usuario WHERE email = '$email' and rol = '$seller'";
        $resultado = $conexion->query($queryEmailCheck);

        if ($resultado->num_rows > 0) {
            $_SESSION['error_message'] = 'El correo electrónico ya está registrado para este rol. Por favor, usa otro.';
            header("Location: ../view/registrar.php");
            exit();
        }
        
        // Insertar datos
        $query = "INSERT INTO usuario (nombre, apellido, email, num_celular, fecha_nacimiento, rol, foto, contrasenia) 
                VALUES ('$nombre', '$apellido', '$email', '$celular', '$birth', '$seller', null, '$password')";
        
        echo $query;
        if ($conexion->query($query) === TRUE) {
            echo '<div class="alert alert-success">TE REGISTRASTE CORRECTAMENTE</div>';
            header("Location: ../view/login.php");
            exit();
        } else {
            $_SESSION['error_message'] = 'HUBO UN ERROR AL REGISTRARTE: ' . $conexion->error;
            header("Location: ../view/registrar.php");
            exit();
        }
        

    }
    
    

    if (!empty($nombre) || !empty($apellido) || !empty($email) || !empty($celular) || !empty($birth) || !empty($password)) {
        $_SESSION['error_message'] = '<div class="alert alert-danger">Por favor, completa todos los campos requeridos.</div>' . $conexion->error;
        header("Location: ../view/registrar.php");
        exit();
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['registrar'])){
            $nombre = $_POST['name'];
            $apellido = $_POST['lastName'];
            $email = $_POST['email'];
            $celular = $_POST['phone'];
            $birth = $_POST['birth'];
            $password = $_POST['password'];
            $seller = isset($_POST['seller']) ? true : false;

            // Verificar el valor de seller
            echo "Valor de seller: $seller"; 
          
            registrarUsuario($nombre, $apellido, $email, $celular, $birth, $password, $seller);
        }
    }


?>