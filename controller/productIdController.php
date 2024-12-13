<?php
require "../controller/database.php";

function productId($id) {
    global $conexion;

    $query = "SELECT producto.*, foto_producto.foto, usuario.nombre AS vendedor_nombre, usuario.apellido AS vendedor_apellido
              FROM producto
              INNER JOIN foto_producto ON producto.id_producto = foto_producto.id_producto
              INNER JOIN producto_usuario ON producto.id_producto = producto_usuario.id_producto
              INNER JOIN usuario ON producto_usuario.id_persona = usuario.id_persona
              WHERE producto.id_producto = $id";

    $result = mysqli_query($conexion, $query);
    $product = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $idProducto = $row['id_producto'];

        if (isset($product[$idProducto])) {
            $product[$idProducto]['fotos'][] = $row['foto'];
            if ($row['descuento'] > 0) {
                $priceDisccount = $row['precio'] - (($row['descuento'] * $row['precio']) / 100);
                // Agregar el precio con descuento
                $product[$idProducto]['precioDescuento'] = $priceDisccount;
            }
        } else {
            $priceDisccount = $row['precio'];

            if ($row['descuento'] > 0) {
                $priceDisccount = $row['precio'] - (($row['descuento'] * $row['precio']) / 100);
                $row['precioDescuento'] = $priceDisccount;
            }

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
                'fotos' => [$row['foto']],
                'precioDescuento' => isset($row['precioDescuento']) ? $row['precioDescuento'] : null,
                'vendedor_nombre' => $row['vendedor_nombre'],   
                'vendedor_apellido' => $row['vendedor_apellido'] 
            ];
        }
    }

    $product = array_values($product);
    return $product;
}
?>