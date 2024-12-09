<?php
    session_start();
    require "../../controller/vendedorController.php";
    $productos = getProductos();
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

    <main class="py-5 main-container">
        <div class="container">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-sm-3 col-xs-12">
                            <h4 class="title">Productos</h4>
                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group container-add-product">
                                <input type="text" class="form-control" placeholder="Buscar producto...">
                                <button class="border-0 bg-transparent" type="button" data-toggle="modal" data-target="#agregarProducto">
                                    <i class="bi bi-bag-plus-fill text-success icon-agregar"></i>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Nombre</th>
                                <th class="fw-bold">Precio</th>
                                <th class="fw-bold">Stock</th>
                                <th class="fw-bold">Descripción</th>
                                <th class="fw-bold">Descuento</th>
                                <th class="fw-bold">Categoría</th>
                                <th class="fw-bold">Talle</th>
                                <th class="fw-bold">color</th>
                                <th class="fw-bold">Imagenes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td><?php echo $producto['id_producto']; ?></td>
                                    <td><?php echo $producto['producto_nombre']; ?></td>
                                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                    <td><?php echo $producto['stock']; ?></td>
                                    <td><?php echo $producto['descripcion']; ?></td>
                                    <td><?php echo $producto['descuento']; ?>%</td>
                                    <td><?php echo $producto['categoria']; ?></td>
                                    <td><?php echo $producto['talle']; ?></td>
                                    <td><?php echo $producto['color']; ?></td>
                                    <td>
                                        <div class="product-images d-flex">
                                            <?php if (!empty($producto['fotos'])): ?> <!-- Cambié $product a $producto -->
                                                <?php foreach ($producto['fotos'] as $foto): ?>
                                                    <img src="<?php echo htmlspecialchars('../.' . $foto); ?>" alt="Imagen del producto" style="width: 50px; height: 50px;">
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p>No hay imágenes disponibles para este producto.</p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="d-flex list-unstyled align-items-center margin-ul justify-content-between">
                                            <li>
                                                <button class="button-product-pencil" type="button" data-toggle="modal" data-target="#editarProducto">
                                                    <i class="bi bi-pencil-square text-white"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="button-product-danger" type="button" data-toggle="modal" data-target="#eliminarProducto">
                                                    <i class="bi bi-trash text-white"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-sm-6 col-xs-6">showing <b>5</b> out of <b>25</b> entries</div>
                        <div class="col-sm-6 col-xs-6">
                            <ul class="pagination hidden-xs pull-right">
                                <li><a href="#"><</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="agregarProducto" tabindex="-1" role="dialog" aria-labelledby="agregarProductoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crear producto</h5>
                </div>
                <form class="modal-body" method="POST" action="../../controller/agregarProductoController.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="agregarProducto">
                    <!-- nombre input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" />
                    </div>

                    <!-- precio input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="precio">Precio</label>
                        <input type="number" id="precio" name="precio" class="form-control form-control-lg" />
                    </div>
                       
                    <!-- stock input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" class="form-control form-control-lg" />
                    </div>
                    <!-- descripcion input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="descripcion">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control form-control-lg" />
                    </div>  
                    <!-- descuento input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="descuento">Descuento</label>
                        <input type="number" id="descuento" name="descuento" class="form-control form-control-lg" />
                    </div>
                    <!-- categoria input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="categoria">Categoría</label>
                        <input type="text" id="categoria" name="categoria" class="form-control form-control-lg" />
                    </div>
                    <!-- talle input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="talle">Talle</label>
                        <input type="text" id="talle" name="talle" class="form-control form-control-lg" />
                    </div>
                    <!-- color input -->
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label  for="color">Color</label>
                        <input type="text" id="color" name="color" class="form-control form-control-lg" />
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imágenes</label>
                        <input class="form-control" type="file" id="formFile" name="imagenes[]" multiple accept="image/*">
                    </div>
                    <div id="imagePreview" class="d-flex flex-wrap gap-2"></div>                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button  type="submit" class="btn btn-primary">Agregar producto</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="../../js/PreviewImage.js"></script>
</body>
</html>