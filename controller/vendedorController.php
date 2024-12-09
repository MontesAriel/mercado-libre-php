<?php
    require "../../controller/database.php";

   

    //trae los productos del vendedor
    function getProductos() {
        global $conexion;
        $id_persona = $_SESSION['id_persona'];
    
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
          INNER JOIN usuario ON producto_usuario.id_persona = ?";
    
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_persona); // 'i' para indicar que es un entero
        $stmt->execute();
        $result = $stmt->get_result();
    
        $products = [];
    
        while ($row = $result->fetch_assoc()) {
            // Obtén las fotos para este producto
            $id_producto = $row['id_producto'];
    
            $queryFotos = "SELECT foto FROM foto_producto WHERE id_producto = ?";
            $stmtFotos = $conexion->prepare($queryFotos);
            $stmtFotos->bind_param("i", $id_producto);
            $stmtFotos->execute();
            $resultFotos = $stmtFotos->get_result();
    
            $fotos = [];
            while ($fotoRow = $resultFotos->fetch_assoc()) {
                $fotos[] = $fotoRow['foto'];
            }
    
            // Añade las fotos al producto
            $row['fotos'] = $fotos;
            
            // Agrega el producto al array de productos
            
            $products[] = $row;
        }
        
        return $products;
    }
    

?>