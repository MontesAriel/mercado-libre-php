<?php
    require_once('../../controller/database.php');
    $id = $_GET['id'];
    $query = "SELECT 
    producto.id_producto, 
    producto.nombre AS producto_nombre, 
    producto.precio, 
    producto.descripcion, 
    producto.descuento, 
    producto.categoria, 
    producto.talle, 
    producto.color, 
    producto.stock, 
    usuario.nombre AS usuario_nombre
    FROM producto
    INNER JOIN producto_usuario ON producto.id_producto = producto_usuario.id_producto
    INNER JOIN usuario ON producto_usuario.id_persona = usuario.id_persona
    WHERE producto.id_producto = $id;";
    $result = $conexion->query($query);
    $record = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado Libre</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-ml.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/homeSeller.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar bg-mercado-libre">
            <div class="container">
                <h1>
                    <a class="navbar-brand">
                        <img src="../../img/mercado-libre-logo.png" alt="logo mercado libre" class="img-logo" />
                    </a>
                </h1>
                <ul class="margin-ul"> 
                    <li class="nav-item dropdown d-flex list-unstyled">
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="./view/logout.php">Salir</a></li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>

            </div>
        </nav>

    </header>
    
    <main class="container mt-4" style="height:60vh;">
        <form class="modal-body" method="POST" action="updateProduct.php" enctype="multipart/form-data">
            <div class="row">
                <!-- nombre input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" value="<?php echo $record['producto_nombre'] ?>" />
                </div>
        
                <!-- precio input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" class="form-control form-control-lg" value="<?php echo $record['precio'] ?>"/>
                </div>
            </div>
                
            <div class="row">
                <!-- stock input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control form-control-lg" value="<?php echo $record['stock'] ?>"/>
                </div>
                <!-- descripcion input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-lg" value="<?php echo $record['descripcion'] ?>"/>
                </div>  
            </div>

            <div class="row">
                <!-- descuento input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="descuento">Descuento</label>
                    <input type="number" id="descuento" name="descuento" class="form-control form-control-lg" value="<?php echo $record['descuento'] ?>"/>
                </div>
                <!-- categoria input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="categoria">Categoría</label>
                    <input type="text" id="categoria" name="categoria" class="form-control form-control-lg" value="<?php echo $record['categoria'] ?>"/>
                </div>
            </div>

            <div class="row">
                <!-- talle input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="talle">Talle</label>
                    <input type="text" id="talle" name="talle" class="form-control form-control-lg" value="<?php echo $record['talle'] ?>"/>
                </div>
                <!-- color input -->
                <div data-mdb-input-init class="form-outline mb-2 col-6">
                    <label  for="color">Color</label>
                    <input type="text" id="color" name="color" class="form-control form-control-lg" value="<?php echo $record['color'] ?>"/>
                </div>
            </div>
            <!-- <div class="mb-3">
                <label for="formFile" class="form-label">Imágenes</label>
                <input class="form-control" type="file" id="formFile" name="imagenes[]" multiple accept="image/*" value="<?php echo $record['fotos'] ?>">
            </div>
            <div id="imagePreview" class="d-flex flex-wrap gap-2"></div> -->
            <input type="hidden" name="id" value="<?php echo $id ?>">                    
            <div class="d-flex justify-content-center mt-4">
                <a href="./homeSeller.php" type="button" class="btn btn-secondary me-2">Cerrar</a>
                <button  type="submit" class="btn btn-primary ms-2">Modificar producto</button>
            </div>
        </form>
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
</body>
</html>