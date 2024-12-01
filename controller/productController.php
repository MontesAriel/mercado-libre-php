<?php
   require "./controller/database.php";

   // Obtener todos los productos
   function getAllProducts() {
      global $conexion;
      $query = "SELECT * FROM producto";
      $result = mysqli_query($conexion, $query);

      $products = [];
      while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
      }

      return $products;
   }

   function getProductDiscount() {
      global $conexion;
      $query = "SELECT producto.*, foto_producto.foto 
               FROM producto 
               LEFT JOIN foto_producto ON producto.id_producto = foto_producto.id_producto
               WHERE producto.descuento > 0";
      $result = mysqli_query($conexion, $query);

      $products = [];
      while ($row = mysqli_fetch_assoc($result)) {
         $idProducto = $row['id_producto'];
         // Si el producto ya existe, solo agrega la imagen al array de fotos
         if (isset($products[$idProducto])) {
            $products[$idProducto]['fotos'][] = $row['foto'];
         } else {
            $products[$idProducto] = [
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
      $products = array_values($products);
      
      return $products;
   }


   // Obtener los productos por categoria
   function getProductCategorie($categoria) {
      global $conexion;  
      $query = "SELECT * FROM producto WHERE categoria = $categoria";
      $result = mysqli_query($conexion, $query);

      $products = [];
      while ($row = mysqli_fetch_assoc($result)) {
         $products[] = $row;
      }

      return $products;
   }



?>