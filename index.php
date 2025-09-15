<?php
// Incluimos el archivo de conexión a la base de datos y otras funciones.
// NOTA: Asegúrate de que estos archivos existan en la carpeta 'includes'.
// Si no los tienes, puedes omitir estas líneas por ahora.
// include 'includes/db_connection.php';
// include 'includes/funciones.php';
include 'includes/db_connection.php'; // Correcto
include 'includes/funciones.php';      // Nuevo

// Verificamos qué página se debe mostrar. El valor por defecto es 'dashboard'.
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Validamos que el archivo de la página exista para evitar errores.
$path = 'pages/' . basename($page) . '.php'; // Usamos basename() por seguridad.

// Incluimos el encabezado.
include 'includes/header.php';

// Verificamos y cargamos el contenido de la página solicitada.
if (file_exists($path)) {
    include $path; // Incluimos la página solicitada
} else {
    // Si la página no existe, mostramos un mensaje de error 404.
    echo '<div class="section"><h2>Error 404</h2><p>Página no encontrada.</p></div>';
}

// Incluimos el pie de página.
include 'includes/footer.php';
?>