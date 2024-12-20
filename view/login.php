
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
                    <h2>Ingresá con tu e-mail para iniciar sesión</h2>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form class="form-login" method="POST" action="../controller/loginController.php">
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" />
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        </div>

                        <!-- vendedor checkbox -->
                        <div class="mt-3">
                            <label>
                                <input type="checkbox" name="seller" value="1"/>
                                Soy vendedor.
                            </label>
                        </div>

                        <div class="mb-4">
                                <a href="./registrar.php" class="form-check-label">no tengo cuenta</a>
                        </div>

                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block w-100">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

