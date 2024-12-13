<?php
    require_once('../../controller/database.php');
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $descuento = $_POST['descuento'];
    $categoria = $_POST['categoria'];
    $talle = $_POST['talle'];
    $color = $_POST['color'];

    $query = "UPDATE producto SET nombre = ?, precio = ?, descripcion = ?, descuento = ?, categoria = ?, talle = ?, color = ?, stock = ? WHERE id_producto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sdsdsssii", $nombre, $precio, $descripcion, $descuento, $categoria, $talle, $color, $stock, $id);


    if ($stmt->execute()) {
        echo "Producto actualizado correctamente.";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    header("Location: ./homeSeller.php"); 
    
    exit;
?>