<?php
    // Obtener los usuarios de la DB
    function getUsuarios($mysqli) {
        $query = "SELECT * FROM usuario WHERE rol = 'usuario'";
        $result = mysqli_query($mysqli, $query);
        return $result;
    }
    
    // Obtener los vendedores de la DB
    function getVendedores($mysqli) {
        $query = "SELECT * FROM usuario WHERE rol = 'vendedor'";
        $result = mysqli_query($mysqli, $query);
        return $result;
    }
    
?>