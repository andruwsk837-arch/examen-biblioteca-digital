<?php
session_start();
define("NOMBRE_BIBLIOTECA", "Biblioteca Digital UTC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Libro - <?php echo NOMBRE_BIBLIOTECA; ?></title>
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

    <h2>Registrar Nuevo Libro</h2>

    <?php
    if(isset($_GET['exito'])){
        echo "<p class='exito'>¡Libro registrado exitosamente!</p>";
    }
    ?>

    <form action="procesar_registro.php" method="POST">
        <label>ISBN (máx 13 números):</label><br>
        <input type="text" name="isbn" maxlength="13"><br>

        <label>Título:</label><br>
        <input type="text" name="titulo"><br>

        <label>Autor:</label><br>
        <input type="text" name="autor"><br>

        <label>Género:</label><br>
        <select name="genero">
            <option value="">Seleccione...</option>
            <option value="Ficción">Ficción</option>
            <option value="No Ficción">No Ficción</option>
            <option value="Ciencia">Ciencia</option>
            <option value="Historia">Historia</option>
            <option value="Romance">Romance</option>
            <option value="Fantasía">Fantasía</option>
        </select><br>

        <label>Año de publicación:</label><br>
        <input type="number" name="año" min="1900" max="2024"><br>

        <label>Número de páginas:</label><br>
        <input type="number" name="paginas" min="1" max="5000"><br>

        <label>Disponible:</label>
        <input type="checkbox" name="disponible" value="1"><br>

        <label>Cantidad en inventario:</label><br>
        <input type="number" name="cantidad" min="1"><br><br>

        <input type="submit" value="Registrar Libro">
    </form>
</div>

</body>
</html>