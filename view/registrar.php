<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon-ml.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<header>
        <nav class="navbar bg-mercado-libre">
            <div class="container">
                <h1>
                    <a class="navbar-brand">
                        <img src="../img/mercado-libre-logo.png" alt="logo mercado libre" class="img-logo" />
                    </a>
                </h1>
            </div>
        </nav>
    </header>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="d-flex justify-content-center w-75">
                    <h2>Para registrarte debes completar todos los campos.</h2>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form class="form-login" method="POST" action="../controller/registerController.php">
                        <div class="container-input-form">
                            <label class="form-label" for="name">Nombre</label>
                            <input type="text" name="name" class="form-control form-control-lg" />
                        </div>
                        <div class="container-input-form mt-2">
                            <label class="form-label" for="apellido">Apellido</label>
                            <input type="text" name="lastName" class="form-control form-control-lg" />
                        </div>
                        <div class="container-input-form mt-2">
                            <label class="form-label" for="phone">Número de celular</label>
                            <input type="number" name="phone" class="form-control form-control-lg" />
                        </div>
                        <div class="container-input-form mt-2">
                            <label class="form-label" for="email">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control form-control-lg" />
                        </div>
                        <div class="container-input-form mt-2">
                            <label class="form-label" for="birth">Fecha de nacimiento</label>
                            <input type="date" name="birth" class="form-control form-control-lg"/>
                        </div>
                        <div class="container-input-form mt-2">
                            <label class="form-label" for="password">Contaseña</label>
                            <input type="password" name="password" class="form-control form-control-lg" />
                        </div>
                        <div class="mt-3">
                            <label>
                                <input type="checkbox" name="seller" value="1"/>
                                Soy vendedor.
                            </label>
                        </div>

                        <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="mt-2 alert alert-danger">
                                <?php 
                                echo $_SESSION['error_message']; 
                                unset($_SESSION['error_message']); // Limpiar el mensaje después de mostrarlo
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <button type="submit" name="registrar" data-mdb-button-init data-mdb-ripple-init class="mt-5 btn btn-primary btn-lg btn-block w-100">Registrar</button>
                        <button href="./login.php" class="mt-1 btn btn-light btn-lg btn-block w-100">tengo cuenta</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

