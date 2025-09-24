<?php
// Incluimos la conexión a la base de datos y las funciones necesarias
include 'includes/db_connection.php';
include 'includes/funciones.php';
?>

<section id="dashboard" class="section">
    <h2>¡Bienvenido! Resumen del Zoológico</h2>
    <div class="dashboard">
        <div class="stats">
            <a href="index.php?page=animales" class="stat-card">
                <i class="fas fa-paw"></i>
                <h3>Animales</h3>
                <p><?php echo contarRegistros($conn, 'animales'); ?></p>
            </a>
            <a href="index.php?page=empleados" class="stat-card">
                <i class="fas fa-users"></i>
                <h3>Empleados</h3>
                <p><?php echo contarRegistros($conn, 'empleados'); ?></p>
            </a>
            <a href="index.php?page=habitats" class="stat-card">
                <i class="fas fa-mountain"></i>
                <h3>Hábitats</h3>
                <p><?php echo contarRegistros($conn, 'habitats'); ?></p>
            </a>
            <a href="index.php?page=visitantes" class="stat-card">
                <i class="fas fa-users-viewfinder"></i>
                <h3>Visitantes</h3>
                <p><?php echo contarRegistros($conn, 'visitantes'); ?></p>
            </a>
            <a href="index.php?page=inventario" class="stat-card">
                <i class="fas fa-boxes"></i>
                <h3>Inventario</h3>
                <p><?php echo (contarRegistros($conn, 'alimentos') + contarRegistros($conn, 'medicinas')); ?></p>
            </a>
        </div>
    </div>
</section>