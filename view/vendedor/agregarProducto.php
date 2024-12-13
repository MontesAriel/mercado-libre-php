<?php
    require_once('../../controller/database.php');
    session_start();

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $descuento = $_POST['descuento'];
    $categoria = $_POST['categoria'];
    $talle = $_POST['talle'];
    $color = $_POST['color'];
    
    $query = "INSERT INTO producto (nombre, precio, descripcion, descuento, categoria, talle, color, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sdsdsssi", $nombre, $precio, $descripcion, $descuento, $categoria, $talle, $color, $stock);
    $stmt->execute();
    
    $idProducto = $conexion->insert_id;
    $idPersona = $_SESSION['id_persona'];
    echo "idProducto: $idProducto, idPersona: $idPersona<br>";
     $queryRel = "INSERT INTO producto_usuario (id_producto, id_persona) VALUES (?, ?)";
     $stmtRel = $conexion->prepare($queryRel);
     $stmtRel->bind_param("ii", $idProducto, $idPersona);
     $stmtRel->execute();

    // Guardar las imágenes en la tabla `foto_producto`

    if (isset($_FILES['imagenes']) && !empty($_FILES['imagenes']['name'][0])) {
        $uploadDir = '../../img/products/';
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

    header("Location: ./homeSeller.php"); 
    exit;
?>