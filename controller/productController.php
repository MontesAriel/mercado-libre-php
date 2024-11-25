<?php
require "./database.php";


     // Obtener todos los productos
     function getAllProducts() {
         $query = "SELECT * FROM producto";
         $result = mysqli_query($connection, $query);

     }

      // Obtener los productos con descuento
     function getProductDiscount() {
        $query = "SELECT * FROM producto WHERE descuento > 0";
        $result = mysqli_query($connection, $query);
    
     }

     // Obtener los productos por categoria
     function getProductCategorie($categoria) {
        $query = "SELECT * FROM producto WHERE categoria === $categoria";
        $result = mysqli_query($connection, $query);
     }

?>