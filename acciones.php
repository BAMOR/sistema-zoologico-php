<?php
// Incluimos la conexión a la base de datos
include 'includes/db_connection.php';

// Verificamos que se hayan recibido los parámetros de acción y tabla
if (isset($_GET['action']) && isset($_GET['tabla']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $tabla = $_GET['tabla'];
    $id = $_GET['id'];

    // Aseguramos que la tabla sea una de las permitidas para evitar inyecciones SQL
    $tablas_validas = ['animales', 'empleados', 'habitats', 'visitantes', 'alimentos', 'medicinas'];
    if (!in_array($tabla, $tablas_validas)) {
        header("Location: index.php?page=dashboard&msg=invalid_table");
        exit();
    }

    // --- Lógica para ELIMINAR ---
    if ($action == 'eliminar') {
        $sql = "DELETE FROM $tabla WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirigimos a la página de origen con un mensaje de éxito
            header("Location: index.php?page=$tabla&msg=success_del");
            exit();
        } else {
            // Redirigimos con un mensaje de error
            header("Location: index.php?page=$tabla&msg=error_del");
            exit();
        }
        $stmt->close();
    }

    // Aquí podemos añadir la lógica para otras acciones (ver, editar) más adelante
    
} else {
    // Si no se recibieron los parámetros necesarios, redirigimos al dashboard
    header("Location: index.php?page=dashboard&msg=error");
    exit();
}

$conn->close();
?>