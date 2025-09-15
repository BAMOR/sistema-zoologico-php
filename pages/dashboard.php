<?php
// Incluimos la conexión a la base de datos y el archivo de funciones.
// Esto es importante si el archivo se accede directamente o si se incluye en otro contexto.
include 'includes/db_connection.php';
include 'includes/funciones.php';
?>

<div class="dashboard">
    <div class="stats">
        <div class="stat-card">
            <i class="fas fa-paw"></i>
            <h3>Animales</h3>
            <p><?php echo contarRegistros($conn, 'animales'); ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>Empleados</h3>
            <p><?php echo contarRegistros($conn, 'empleados'); ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-mountain"></i>
            <h3>Hábitats</h3>
            <p><?php echo contarRegistros($conn, 'habitats'); ?></p>
        </div>
    </div>
</div>