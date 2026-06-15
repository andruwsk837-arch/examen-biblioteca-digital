<?php
session_start();
define("NOMBRE_BIBLIOTECA", "Biblioteca Digital UTC");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $errores = [];

    // Sanitizar y obtener datos
    $isbn = htmlspecialchars($_POST["isbn"]);
    $titulo = htmlspecialchars($_POST["titulo"]);
    $autor = htmlspecialchars($_POST["autor"]);
    $genero = htmlspecialchars($_POST["genero"]);
    $año = (int)$_POST["año"];
    $paginas = (int)$_POST["paginas"];
    $disponible = isset($_POST["disponible"]) ? true : false;
    $cantidad = (int)$_POST["cantidad"];

    // Validaciones
    if(empty($isbn) || !is_numeric($isbn)){
        $errores[] = "El ISBN es obligatorio y debe contener solo números.";
    }
    if(strlen($isbn) > 13){
        $errores[] = "El ISBN no puede tener más de 13 caracteres.";
    }
    if(empty($titulo) || strlen($titulo) < 5){
        $errores[] = "El título es obligatorio y debe tener mínimo 5 caracteres.";
    }
    if(empty($autor) || strlen($autor) < 3){
        $errores[] = "El autor es obligatorio y debe tener mínimo 3 caracteres.";
    }
    if(empty($genero)){
        $errores[] = "Debe seleccionar un género.";
    }
    if($año < 1900 || $año > 2024){
        $errores[] = "El año debe estar entre 1900 y 2024.";
    }
    if($paginas < 1 || $paginas > 5000){
        $errores[] = "El número de páginas debe estar entre 1 y 5000.";
    }
    if($cantidad < 1){
        $errores[] = "La cantidad debe ser mínimo 1.";
    }

    // Verificar ISBN único
    foreach($_SESSION['libros'] as $libro){
        if($libro['isbn'] == $isbn){
            $errores[] = "El ISBN ya existe en la biblioteca.";
            break;
        }
    }

    // Si hay errores mostrarlos
    if(count($errores) > 0){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error - <?php echo NOMBRE_BIBLIOTECA; ?></title>
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
    <h2>Errores en el formulario</h2>
    <?php foreach($errores as $error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endforeach; ?>
    <a href="registrar.php">Volver al formulario</a>
</div>
</body>
</html>
<?php
    } else {
        // Agregar libro a la sesión
        $nuevoLibro = [
            'isbn' => $isbn,
            'titulo' => $titulo,
            'autor' => $autor,
            'genero' => $genero,
            'año' => $año,
            'paginas' => $paginas,
            'disponible' => $disponible,
            'cantidad' => $cantidad
        ];

        array_push($_SESSION['libros'], $nuevoLibro);

        header("Location: registrar.php?exito=1");
        exit();
    }
} else {
    header("Location: registrar.php");
    exit();
}
?>