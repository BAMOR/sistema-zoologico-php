<div class="dashboard">
    <div class="stats">
        <div class="stat-card">
            <i class="fas fa-paw"></i>
            <h3>Animales</h3>
            <p><?php echo contarRegistros('animales'); ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>Empleados</h3>
            <p><?php echo contarRegistros('empleados'); ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-mountain"></i>
            <h3>Hábitats</h3>
            <p><?php echo contarRegistros('habitats'); ?></p>
        </div>
    </div>
</div>