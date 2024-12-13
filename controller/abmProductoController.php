<?php
    // require "./database.php";
    // session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibe una acción
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    
        // Ejecutar la acción correspondiente
        switch ($action) {
            case 'agregarProducto':
                agregarProducto($_POST);
                break;
            default:
                echo "Acción no válida";
        }
    }
}

function agregarProducto($data) {
    require_once './database.php';
    global $conexion;
    session_start();
    // Guardar el producto en la tabla `productos`
    $nombre = $data['nombre'];
    $precio = $data['precio'];
    $stock = $data['stock'];
    $descripcion = $data['descripcion'];
    $descuento = $data['descuento'];
    $categoria = $data['categoria'];
    $talle = $data['talle'];
    $color = $data['color'];
    
    $query = "INSERT INTO producto (nombre, precio, descripcion, descuento, categoria, talle, color, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sdisssss", $nombre, $precio, $descripcion, $descuento, $categoria, $talle, $color, $stock);
    $stmt->execute();
    
    $idProducto = $conexion->insert_id;
    $idPersona = $_SESSION['id_persona'];
     
     $queryRel = "INSERT INTO producto_usuario (id_producto, id_persona) VALUES (?, ?)";
     $stmtRel = $conexion->prepare($queryRel);
     $stmtRel->bind_param("ii", $idProducto, $idPersona);
     $stmtRel->execute();

    // Guardar las imágenes en la tabla `foto_producto`

    if (isset($_FILES['imagenes']) && !empty($_FILES['imagenes']['name'][0])) {
        $uploadDir = '../img/products/';
        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['imagenes']['name'][$key];
            $uploadPath = $uploadDir . $fileName;
  
            if (move_uploaded_file($tmpName, $uploadPath)) {
                $fotoPath = './img/products/' . $fileName;
                $queryFoto = "INSERT INTO foto_producto (foto, id_producto) VALUES (?, ?)";
                $stmtFoto = $conexion->prepare($queryFoto);
                $stmtFoto->bind_param("si", $fotoPath, $idProducto);
                if ($stmtFoto->execute()) {
                    echo "Imagen $fileName insertada correctamente en la base de datos.<br>";
                } else {
                    echo "Error al insertar la imagen $fileName: " . $stmtFoto->error . "<br>";
                }
            } else {
                echo "Error al subir imagen $fileName.<br>";
            }
        }
    } else {
        echo "No se recibieron imágenes.<br>";
    }

    header("Location: ../view/vendedor/homeSeller.php"); 
    exit;
}




?>