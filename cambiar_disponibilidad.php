<?php
session_start();

if(isset($_GET['indice'])){
    $indice = (int)$_GET['indice'];
    
    // Cambiar disponibilidad con operador ternario
    $_SESSION['libros'][$indice]['disponible'] = $_SESSION['libros'][$indice]['disponible'] ? false : true;
}

header("Location: index.php");
exit();
?>