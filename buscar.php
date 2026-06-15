<?php
session_start();
define("NOMBRE_BIBLIOTECA", "Biblioteca Digital UTC");

$resultados = [];
$busqueda_realizada = false;

if(isset($_GET['buscar'])){
    $busqueda_realizada = true;
    $tipo = $_GET['tipo'];

    foreach($_SESSION['libros'] as $libro){

        // Opción 1 - Búsqueda por título
        if($tipo == "titulo"){
            $texto = htmlspecialchars($_GET['texto']);
            if(stripos($libro['titulo'], $texto) !== false){
                array_push($resultados, $libro);
            }
        }

        // Opción 2 - Filtro por género
        elseif($tipo == "genero"){
            $genero = htmlspecialchars($_GET['genero']);
            if($libro['genero'] == $genero){
                array_push($resultados, $libro);
            }
        }

        // Opción 3 - Filtro por disponibilidad
        elseif($tipo == "disponibilidad"){
            $disponibilidad = $_GET['disponibilidad'];
            if($disponibilidad == "todos"){
                array_push($resultados, $libro);
            } elseif($disponibilidad == "disponibles" && $libro['disponible'] == true){
                array_push($resultados, $libro);
            } elseif($disponibilidad == "no_disponibles" && $libro['disponible'] == false){
                array_push($resultados, $libro);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar - <?php echo NOMBRE_BIBLIOTECA; ?></title>
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

    <h2>Buscar / Filtrar Libros</h2>

    <!-- Búsqueda por título -->
    <h3>Buscar por título</h3>
    <form method="GET">
        <input type="hidden" name="tipo" value="titulo">
        <input type="text" name="texto" placeholder="Ingrese título...">
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <!-- Filtro por género -->
    <h3>Filtrar por género</h3>
    <form method="GET">
        <input type="hidden" name="tipo" value="genero">
        <select name="genero">
            <option value="Ficción">Ficción</option>
            <option value="No Ficción">No Ficción</option>
            <option value="Ciencia">Ciencia</option>
            <option value="Historia">Historia</option>
            <option value="Romance">Romance</option>
            <option value="Fantasía">Fantasía</option>
        </select>
        <input type="submit" name="buscar" value="Filtrar">
    </form>

    <!-- Filtro por disponibilidad -->
    <h3>Filtrar por disponibilidad</h3>
    <form method="GET">
        <input type="hidden" name="tipo" value="disponibilidad">
        <input type="radio" name="disponibilidad" value="todos" checked> Todos
        <input type="radio" name="disponibilidad" value="disponibles"> Disponibles
        <input type="radio" name="disponibilidad" value="no_disponibles"> No disponibles
        <input type="submit" name="buscar" value="Filtrar">
    </form>

    <!-- Resultados -->
    <?php if($busqueda_realizada): ?>
        <h3>Resultados: <?php echo count($resultados); ?> libro(s) encontrado(s)</h3>
        <?php if(count($resultados) == 0): ?>
            <p>No hay resultados.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Año</th>
                    <th>Páginas</th>
                    <th>Disponible</th>
                    <th>Cantidad</th>
                </tr>
                <?php foreach($resultados as $libro): ?>
                <tr>
                    <td><?php echo $libro['isbn']; ?></td>
                    <td><?php echo $libro['titulo']; ?></td>
                    <td><?php echo $libro['autor']; ?></td>
                    <td><?php echo $libro['genero']; ?></td>
                    <td><?php echo $libro['año']; ?></td>
                    <td><?php echo $libro['paginas']; ?></td>
                    <td><?php echo $libro['disponible'] ? 'Sí' : 'No'; ?></td>
                    <td><?php echo $libro['cantidad']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</div>

</body>
</html>