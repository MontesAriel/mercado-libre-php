<?php
    require_once('../../controller/database.php');
    $id = $_GET['id'];

    $queryDeleteRel = "DELETE FROM producto_usuario WHERE id_producto = ?";
    $stmtDeleteRel = $conexion->prepare($queryDeleteRel);
    $stmtDeleteRel->bind_param("i", $id);
    $stmtDeleteRel->execute();

    // Eliminar las imágenes asociadas al producto
    $queryFotos = "SELECT * FROM foto_producto WHERE id_producto = ?";
    $stmtFotos = $conexion->prepare($queryFotos);
    $stmtFotos->bind_param("i", $id);
    $stmtFotos->execute();
    $resultFotos = $stmtFotos->get_result();

    while ($row = $resultFotos->fetch_assoc()) {
        $filePath = '../' . $row['foto'];
        if (file_exists($filePath)) {
            unlink($filePath); // Eliminar archivo físico
        }
    }

    // Eliminar las referencias de imágenes
    $queryDeleteFotos = "DELETE FROM foto_producto WHERE id_producto = ?";
    $stmtDeleteFotos = $conexion->prepare($queryDeleteFotos);
    $stmtDeleteFotos->bind_param("i", $id);
    $stmtDeleteFotos->execute();

    // Eliminar el producto
    $query = "DELETE FROM producto WHERE id_producto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto: " . $stmt->error;
    }

    header("Location: ./homeSeller.php"); 
    exit;
?>