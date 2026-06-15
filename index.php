<?php
session_start();

define("NOMBRE_BIBLIOTECA", "Biblioteca Digital UTC");
define("MAX_ISBN", 13);

// Inicializar libros de ejemplo
if(!isset($_SESSION['libros'])){
    $_SESSION['libros'] = [
        [
            'isbn' => '9780451524935',
            'titulo' => 'Cien Años de Soledad',
            'autor' => 'Gabriel García Márquez',
            'genero' => 'Ficción',
            'año' => 1967,
            'paginas' => 417,
            'disponible' => true,
            'cantidad' => 3
        ],
        [
            'isbn' => '9780743273565',
            'titulo' => 'El Gran Gatsby',
            'autor' => 'F. Scott Fitzgerald',
            'genero' => 'Ficción',
            'año' => 1925,
            'paginas' => 180,
            'disponible' => true,
            'cantidad' => 5
        ],
        [
            'isbn' => '9780307474278',
            'titulo' => 'El Código Da Vinci',
            'autor' => 'Dan Brown',
            'genero' => 'Ficción',
            'año' => 2003,
            'paginas' => 689,
            'disponible' => false,
            'cantidad' => 2
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo NOMBRE_BIBLIOTECA; ?></title>
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

    <h2>Libros en la Biblioteca</h2>

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
            <th>Acción</th>
        </tr>
        <?php foreach($_SESSION['libros'] as $indice => $libro): ?>
        <tr>
            <td><?php echo $libro['isbn']; ?></td>
            <td><?php echo $libro['titulo']; ?></td>
            <td><?php echo $libro['autor']; ?></td>
            <td><?php echo $libro['genero']; ?></td>
            <td><?php echo $libro['año']; ?></td>
            <td><?php echo $libro['paginas']; ?></td>
            <td><?php echo $libro['disponible'] ? 'Sí' : 'No'; ?></td>
            <td><?php echo $libro['cantidad']; ?></td>
            <td>
                <a href="cambiar_disponibilidad.php?indice=<?php echo $indice; ?>">
                    Cambiar disponibilidad
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>