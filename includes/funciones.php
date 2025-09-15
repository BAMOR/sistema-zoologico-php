<?php
// Función para contar registros en una tabla
function contarRegistros($tabla) {
    global $conn; // Accede a la conexión global
    $sql = "SELECT COUNT(*) AS total FROM $tabla";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Función para calcular la edad a partir de la fecha de nacimiento
function calcularEdad($fecha_nacimiento) {
    if (empty($fecha_nacimiento) || $fecha_nacimiento === '0000-00-00') {
        return 'N/A';
    }
    $fecha_nacimiento = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento);
    return $edad->y . ' años';
}

// Función para obtener todos los animales de la base de datos
function obtenerAnimales($conn) {
    $sql = "SELECT id, nombre, especie, habitat, fecha_nacimiento, peso, salud FROM animales ORDER BY nombre ASC";
    $result = $conn->query($sql);
    $animales = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $animales[] = $row;
        }
    }
    return $animales;
}
?>