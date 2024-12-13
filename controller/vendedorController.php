<?php
    require "../../controller/database.php";

    // Trae los productos del vendedor
    function getProductos($busqueda = '') {
        global $conexion;
        $id_persona = $_SESSION['id_persona'];
        
        // Consulta base
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
        INNER JOIN usuario ON producto_usuario.id_persona = ?
        WHERE producto_usuario.id_persona = ?
        GROUP BY producto.id_producto";

        
        // Agregar condición adicional si hay búsqueda
        if ($busqueda !== '') {
            $query .= " AND producto.nombre LIKE ?";
        }
    
        $stmt = $conexion->prepare($query);
    
        // Preparar parámetros según la búsqueda
        if ($busqueda !== '') {
            $searchTerm = '%' . $busqueda . '%';
            $stmt->bind_param("iis", $id_persona, $id_persona, $searchTerm);
        } else {
            $stmt->bind_param("ii", $id_persona, $id_persona);
        }
    
        // Ejecutar la consulta
        $stmt->execute();
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
            return [];
        }
    
        $result = $stmt->get_result();
        if (!$result) {
            echo "Error: " . $stmt->error;
            return [];
        }
    
        $products = [];
        $seenIds = [];

        while ($row = $result->fetch_assoc()) {
            $id_producto = $row['id_producto'];

            // Verificar si el producto ya está en la lista
            if (in_array($id_producto, $seenIds)) {
                continue;
            }
            $seenIds[] = $id_producto;

            // Consultar fotos asociadas al producto
            $queryFotos = "SELECT foto FROM foto_producto WHERE id_producto = ?";
            $stmtFotos = $conexion->prepare($queryFotos);
            $stmtFotos->bind_param("i", $id_producto);
            $stmtFotos->execute();
            $resultFotos = $stmtFotos->get_result();

            $fotos = [];
            while ($fotoRow = $resultFotos->fetch_assoc()) {
                $fotos[] = $fotoRow['foto'];
            }

            $row['fotos'] = $fotos;
            $products[] = $row;
        }

        return $products;
    }
    
?>
