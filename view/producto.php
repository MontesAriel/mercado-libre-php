<?php
require "../controller/productIdController.php";

if (isset($_GET['id'])) {
    $idProducto = intval($_GET['id']);
    $producto = productId($idProducto);
    if (!$producto) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado Libre</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon-ml.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/producto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar bg-mercado-libre">
            <div class="container">
                <h1>
                    <a class="navbar-brand" href="../index.php">
                        <img src="../img/mercado-libre-logo.png" alt="logo mercado libre" class="img-logo" />
                    </a>
                </h1>
                <form class="d-flex w-50" role="search"  method="GET">
                    <div class="input-group">
                        <input 
                            class="form-control" 
                            type="search" 
                            placeholder="Buscar productos, marcas y más..." 
                            aria-label="Search" 
                            aria-describedby="search-icon"
                        >
                        <span class="input-group-text cursor-pointer" id="search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                </form>
                <img src="../img/promo.webp" alt="promoción nvl 6" class="img-promo"/>
            </div>
            <div class="container nav justify-content-between w-100 align-items-center">
                <ul class="d-flex list-unstyled">
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            Categorias
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link">Productos</a></li>
                </ul>
                <ul class="d-flex list-unstyled"> 
                    <li class="nav-item dropdown d-flex">
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="./view/logout.php">Salir</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="./view/registrar.php" class="nav-link">Creá tu cuenta</a>
                            <a href="./view/login.php" class="nav-link">Ingresá</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <button class="nav-link">
                            <i class="bi bi-cart cart-icon"></i>
                        </button>
                    </li>
                </ul>

            </div>          
        </nav>

    </header>

    <main class="py-5">
        <section class="container bg-white d-flex justify-content-between p-5 rounded shadow-sm">
            <div class="d-flex">
                <section class="carousel-container">
                    <div class="carousel-wrapper">
                        <!-- Botones con miniaturas de las imágenes -->
                        <!-- Carousel con miniaturas -->
                        <aside class="buttons">
                            <?php foreach ($producto[0]['fotos'] as $index => $foto): ?>
                                <div class="carousel-btn btn<?= $index + 1 ?> shadow-sm rounded">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index ?>" <?= $index === 0 ? 'aria-current="true"' : '' ?> aria-label="Slide <?= $index + 1 ?>">
                                    <img src="<?= htmlspecialchars('.' . $foto) ?>" class="d-block w-100" alt="Foto <?= $index + 1 ?>">
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </aside>

                        
                        <!-- Carousel principal -->
                        <aside class="carousel" id="carouselExampleIndicators" class="carousel slide carousel-wrapper d-flex flex-row">
                            <section class="carousel-inner">
                                <?php foreach ($producto[0]['fotos'] as $index => $foto): ?>
                                    <div class="carousel-box box<?= $index + 1 ?> carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= htmlspecialchars('.' . $foto) ?>" class="d-block w-100" alt="Foto <?= $index + 1 ?>">
                                    </div>
                                <?php endforeach; ?>
                            </section>
                        </aside>
                    </div>
                </section>
            </div>
            <div class="border p-2 rounded" style="min-width:350px">
                <h2 style="font-size:22px" class="pb-2"><?= htmlspecialchars($producto[0]['nombre']) ?></h2>

                <span style="font-size:16px;" class="text-decoration-line-through text-secondary">$<?= htmlspecialchars($producto[0]['precio']) ?></span>
                <div class="d-flex align-items-center">
                    <p style="font-size:36px">$<?= htmlspecialchars($producto[0]['precioDescuento']) ?></p>
                    <span class="ms-2 " style="font-size:18px"><?= htmlspecialchars($producto[0]['descuento']) ?>% Off</span>
                </div>    
                <p>Color: <span class="fw-bold"><?= htmlspecialchars($producto[0]['color']) ?></span></p>
                <p>Talle: <span class="border p-2 rounded"><?= htmlspecialchars($producto[0]['talle']) ?></span></p>
                <p class="fw-bold"><?= htmlspecialchars($producto[0]['stock'] > 0 ? 'Stock disponible' : '') ?></p>
                <p>Cantidad:</p>
                <div class="d-flex flex-column">
                    <button class="btn btn-primary fw-bold">Comprar ahora</button>
                    <button 
                        class="btn btn-light text-primary mt-2 fw-bold"
                        onclick=""
                    >
                        Agregar al carrito
                    </button>
                </div>   
                <p>Vendedor</p>
            </div>
        </section>
    </main>

    <footer class="text-center text-lg-start bottom-0 start-0 end-0 bg-mercado-libre">
        <div class="container p-4 pb-0">
            <section class="">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold fw-bold">Mercado Libre</h6>
                        <p>Final para la materia Programación Web II.</p>
                    </div>

                    <hr class="w-100 clearfix d-md-none" />

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold fw-bold">Productos</h6>
                        <p>
                            <a>Zapatillas</a>
                        </p>
                        <p>
                            <a>Remeras</a>
                        </p>
                        <p>
                            <a>Pantalones</a>
                        </p>
                        <p>
                            <a>Hogar</a>
                        </p>
                    </div>
                    <hr class="w-100 clearfix d-md-none" />

                    <hr class="w-100 clearfix d-md-none" />

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold fw-bold">Contacto</h6>
                        <p><i class="fas fa-home mr-3"></i> Trabajá con nosotros</p>
                        <p><i class="fas fa-envelope mr-3"></i> ariel.montes@davinci.edu.ar</p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold fw-bold">Seguime</h6>

                        <a
                            class="btn btn-primary btn-floating m-1 border-0"
                            style="background-color: #0082ca"
                            href="https://www.linkedin.com/in/montesariel/"
                            role="button"
                            target="_blank"
                        >
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a
                            class="btn btn-primary btn-floating m-1 border-0"
                            style="background-color: #333333"
                            href="https://github.com/MontesAriel?tab=repositories"
                            role="button"
                            target="_blank"
                        >
                            <i class="bi bi-github"></i>
                        </a>

                        <a
                            class="btn btn-primary btn-floating m-1 border-0"
                            style="background-color: #dd4b39"
                            href="mailto:montesarieel@gmail.com?subject=Asunto%20del%20mensaje&body=Contenido%20del%20mensaje"
                            role="button"
                            target="_blank"
                        >
                            <i class="bi bi-envelope-at-fill"></i>
                        </a>

                    </div>
                </div>
            </section>
        </div>

        <div class="text-center p-3 d-flex justify-content-center fw-bold">
            <span>© 2024 Copyright: </span>
            <p class="ms-1"> Realizado por Ariel Montes</p>
        </div>
    </footer>

   
<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
