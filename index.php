<?php
    session_start();
    require "./controller/productController.php";
    $discountedProducts = getProductDiscount();
    $categoryProducts = getProductZapatillas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado Libre</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon-ml.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <header>
        <nav class="navbar bg-mercado-libre">
            <div class="container">
                <h1>
                    <a class="navbar-brand" href="./index.php">
                        <img src="./img/mercado-libre-logo.png" alt="logo mercado libre" class="img-logo" />
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
                <img src="./img/promo.webp" alt="promoción nvl 6" class="img-promo"/>
            </div>
            <div class="container nav justify-content-between w-100 align-items-center">
                <ul class="d-flex list-unstyled">
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            Categorias
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Zapatillas</a></li>
                            <li><a class="dropdown-item" href="#">Hogar</a></li>
                            <li><a class="dropdown-item" href="#">Pantalones</a></li>
                            <li><a class="dropdown-item" href="#">Remeras</a></li>
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

        <div id="carosuelHeader" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/banner1.webp" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="./img/banner2.webp" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="./img/banner3.webp" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="./img/banner4.webp" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="./img/banner5.webp" class="d-block w-100" alt="banner">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carosuelHeader" data-bs-slide="prev">
                <span class="icon-arrow"><</span>
                <span class="carousel-control-prev-icon visually-hidden" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carosuelHeader" data-bs-slide="next">
                <span class="icon-arrow">></span>
                <span class="carousel-control-next-icon visually-hidden" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <main class="py-5">
        <section class="container p-4 bg-white">
            <h2>Ofertas</h2>
            <div id="carouselOferta" class="carousel slide">
                <div class="carousel-indicators h-25">
                    <?php for ($i = 0; $i < ceil(count($discountedProducts) / 5); $i++): ?>
                        <button type="button" data-bs-target="#carouselOferta" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <?php 
                    $chunks = array_chunk($discountedProducts, 5);
                    foreach ($chunks as $index => $group): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="d-flex justify-content-around gap-3">
                                <?php foreach ($group as $product): ?>
                                    <div 
                                        class="img-card shadow rounded cursor-pointer"
                                        style="height:430px"
                                        onclick="window.location.href ='./view/producto.php?id=<?= $product['id_producto'] ?>'"
                                        >
                                        <?php if (!empty($product['fotos'])): ?>
                                            <img src="<?= htmlspecialchars($product['fotos'][0]) ?>" class="card-img-top" style="height:250px" alt="<?= htmlspecialchars($product['nombre']) ?>">
                                        <?php else: ?>
                                            <img src="./img/default-product.jpg" class="card-img-top" alt="Imagen no disponible">
                                        <?php endif; ?>
                                        <div class="card-body p-2">
                                            <h5 class="card-title"><?= htmlspecialchars($product['nombre']) ?></h5>
                                            <p class="card-text mt-2" style="font-size:14px"><?= htmlspecialchars($product['descripcion']) ?></p>
                                            <div class="d-flex align-items-center">
                                                <p class="fw-bold" style="font-size:24px">$ <?= $product['precio'] ?></p>
                                                <?php if ($product['descuento'] > 0): ?>
                                                    <p class="ms-2" style="color:#00a650"><small><?= $product['descuento'] ?>% Off</small></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Controles del carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselOferta" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselOferta" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </section>


        <section>
        
        </section>

        <section class="container mt-4 p-4 bg-white">
            <h2>Zapatillas</h2>
            <div id="carouselZapatillas" class="carousel slide">
                <div class="carousel-indicators h-25">
                    <?php for ($i = 0; $i < ceil(count($categoryProducts) / 5); $i++): ?>
                        <button type="button" data-bs-target="#carouselZapatillas" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <?php 
                    $chunks = array_chunk($categoryProducts, 5);
                    foreach ($chunks as $index => $group): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="d-flex justify-content-around gap-3">
                                <?php foreach ($group as $product): ?>
                                    <div 
                                        class="img-card shadow rounded cursor-pointer" 
                                        onclick="window.location.href ='./view/producto.php?id=<?= $product['id_producto'] ?>'"
                                        >
                                        <?php if (!empty($product['fotos'])): ?>
                                            <img src="<?= htmlspecialchars($product['fotos'][0]) ?>" class="card-img-top" style="height:250px" alt="<?= htmlspecialchars($product['nombre']) ?>">
                                        <?php else: ?>
                                            <img src="./img/default-product.jpg" class="card-img-top" alt="Imagen no disponible">
                                        <?php endif; ?>
                                        <div class="card-body p-2">
                                            <h5 class="card-title"><?= htmlspecialchars($product['nombre']) ?></h5>
                                            <p class="card-text mt-2" style="font-size:14px"><?= htmlspecialchars($product['descripcion']) ?></p>
                                            <div class="d-flex align-items-center">
                                                <p class="fw-bold" style="font-size:24px">$ <?= $product['precio'] ?></p>
                                                <?php if ($product['descuento'] > 0): ?>
                                                    <p class="ms-2" style="color:#00a650"><small><?= $product['descuento'] ?>% Off</small></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Controles del carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselZapatillas" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselZapatillas" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
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
                            target="_blank"
                            role="button"
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>