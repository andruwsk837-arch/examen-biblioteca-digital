<?php
session_start();
define("NOMBRE_BIBLIOTECA", "Biblioteca Digital UTC");

// Calcular estadísticas
$total_libros = count($_SESSION['libros']);
$disponibles = 0;
$no_disponibles = 0;
$total_paginas = 0;
$total_inventario = 0;
$año_min = $_SESSION['libros'][0]['año'];
$año_max = $_SESSION['libros'][0]['año'];
$libro_mas_antiguo = $_SESSION['libros'][0]['titulo'];
$libro_mas_reciente = $_SESSION['libros'][0]['titulo'];
$generos = [];

foreach($_SESSION['libros'] as $libro){

    // Disponibles vs no disponibles
    if($libro['disponible'] == true){
        $disponibles++;
    } else {
        $no_disponibles++;
    }

    // Total páginas e inventario
    $total_paginas = $total_paginas + $libro['paginas'];
    $total_inventario = $total_inventario + $libro['cantidad'];

    // Libro más antiguo y más reciente
    if($libro['año'] < $año_min){
        $año_min = $libro['año'];
        $libro_mas_antiguo = $libro['titulo'];
    }
    if($libro['año'] > $año_max){
        $año_max = $libro['año'];
        $libro_mas_reciente = $libro['titulo'];
    }

    // Contar géneros
    if(isset($generos[$libro['genero']])){
        $generos[$libro['genero']]++;
    } else {
        $generos[$libro['genero']] = 1;
    }
}

// Porcentaje disponibilidad
if($total_libros > 0){
    $porcentaje = ($disponibles / $total_libros) * 100;
    $porcentaje = number_format($porcentaje, 2);
} else {
    $porcentaje = 0;
}

// Promedio de páginas
if($total_libros > 0){
    $promedio_paginas = number_format($total_paginas / $total_libros, 2);
} else {
    $promedio_paginas = 0;
}

// Género más popular
$genero_popular = "";
$max_genero = 0;
foreach($generos as $genero => $cantidad){
    if($cantidad > $max_genero){
        $max_genero = $cantidad;
        $genero_popular = $genero;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas - <?php echo NOMBRE_BIBLIOTECA; ?></title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1><?php echo NOMBRE_BIBLIOTECA; ?></h1>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="registrar.php">Registrar Libro</a>
        <a href="buscar.php">Buscar/Filtrar</a>
        <a href="estadisticas.php">Estadísticas</a>
        <a href="salir.php">Salir</a>
    </nav>

    <h2>Estadísticas del Sistema</h2>

    <table>
        <tr>
            <th>Estadística</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Total de libros</td>
            <td><?php echo $total_libros; ?></td>
        </tr>
        <tr>
            <td>Libros disponibles</td>
            <td><?php echo $disponibles; ?></td>
        </tr>
        <tr>
            <td>Libros no disponibles</td>
            <td><?php echo $no_disponibles; ?></td>
        </tr>
        <tr>
            <td>Porcentaje de disponibilidad</td>
            <td><?php echo $porcentaje; ?>%</td>
        </tr>
        <tr>
            <td>Libro más antiguo</td>
            <td><?php echo $libro_mas_antiguo; ?> (<?php echo $año_min; ?>)</td>
        </tr>
        <tr>
            <td>Libro más reciente</td>
            <td><?php echo $libro_mas_reciente; ?> (<?php echo $año_max; ?>)</td>
        </tr>
        <tr>
            <td>Género más popular</td>
            <td><?php echo $genero_popular; ?></td>
        </tr>
        <tr>
            <td>Total de páginas</td>
            <td><?php echo $total_paginas; ?></td>
        </tr>
        <tr>
            <td>Promedio de páginas por libro</td>
            <td><?php echo $promedio_paginas; ?></td>
        </tr>
        <tr>
            <td>Inventario total</td>
            <td><?php echo $total_inventario; ?></td>
        </tr>
    </table>

</div>

</body>
</html>