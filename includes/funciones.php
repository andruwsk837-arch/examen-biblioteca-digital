<?php
// Función 1 - Verificar si un ISBN ya existe
function isbn_existe($isbn, $libros){
    foreach($libros as $libro){
        if($libro['isbn'] == $isbn){
            return true;
        }
    }
    return false;
}

// Función 2 - Contar libros disponibles
function contar_disponibles($libros){
    $contador = 0;
    foreach($libros as $libro){
        if($libro['disponible'] == true){
            $contador++;
        }
    }
    return $contador;
}

// Función 3 - Obtener género más popular
function genero_popular($libros){
    $generos = [];
    foreach($libros as $libro){
        if(isset($generos[$libro['genero']])){
            $generos[$libro['genero']]++;
        } else {
            $generos[$libro['genero']] = 1;
        }
    }
    $max = 0;
    $popular = "";
    foreach($generos as $genero => $cantidad){
        if($cantidad > $max){
            $max = $cantidad;
            $popular = $genero;
        }
    }
    return $popular;
}
?>