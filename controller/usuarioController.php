<?php
    // Obtener los usuarios de la DB
    function getUsuarios($mysqli) {
        $query = "SELECT * FROM usuario";
        $result = mysqli_query($mysqli, $query);
        return $result;
    }
    
?>