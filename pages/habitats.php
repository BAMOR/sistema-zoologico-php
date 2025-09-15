<section id="habitats" class="section">
    <h2><i class="fas fa-mountain"></i> Gestión de Hábitats</h2>
    
    <div class="form-container">
        <h3>Registrar Nuevo Hábitat</h3>
        <form action="#" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre del Hábitat *</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>Tipo de Clima</label>
                    <input type="text" name="clima">
                </div>
                <div class="form-group">
                    <label>Animales que Contiene</label>
                    <input type="text" name="animales">
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado">
                        <option value="Óptimo">Óptimo</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Cerrado">Cerrado</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Registrar Hábitat
            </button>
        </form>
    </div>

    <div class="table-container">
        <h3>Hábitats Registrados</h3>
        <p class="no-data">Aquí se mostrará la lista de hábitats.</p>
    </div>
</section>