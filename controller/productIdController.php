<?php
   require "../controller/database.php";

    function productId($id) {
      global $conexion;

      $query = "SELECT producto.*, foto_producto.foto 
      FROM producto 
      INNER JOIN foto_producto 
      ON producto.id_producto = foto_producto.id_producto 
      WHERE producto.id_producto = $id";

      $result = mysqli_query($conexion, $query);
      $product = [];

      while ($row = mysqli_fetch_assoc($result)) {
        $idProducto = $row['id_producto'];
        if (isset($product[$idProducto])) {
           $product[$idProducto]['fotos'][] = $row['foto'];
        } else {
           $product[$idProducto] = [
                 'id_producto' => $row['id_producto'],
                 'nombre' => $row['nombre'],
                 'precio' => $row['precio'],
                 'descripcion' => $row['descripcion'],
                 'descuento' => $row['descuento'],
                 'categoria' => $row['categoria'],
                 'talle' => $row['talle'],
                 'color' => $row['color'],
                 'stock' => $row['stock'],
                 'fotos' => [$row['foto']]
           ];
        }
    }  
    // Reindexar el array por índices numéricos
    $product = array_values($product);
    return $product;
    }

?>