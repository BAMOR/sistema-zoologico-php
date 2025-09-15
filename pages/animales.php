<!-- Sección Animales -->
<section id="animales" class="section">
    <h2><i class="fas fa-paw"></i> Gestión de Animales</h2>
    
    <!-- Formulario de Animales -->
    <div class="form-container">
        <h3>Registrar Nuevo Animal</h3>
        <form action="procesar_animal.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre del Animal *</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>Especie *</label>
                    <input type="text" name="especie" required>
                </div>
                <div class="form-group">
                    <label>Habitat</label>
                    <input type="text" name="habitat">
                </div>
                <div class="form-group">
                    <label>Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento">
                </div>
                <div class="form-group">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.01" name="peso">
                </div>
                <div class="form-group">
                    <label>Estado de Salud</label>
                    <select name="salud">
                        <option value="Excelente">Excelente</option>
                        <option value="Bueno">Bueno</option>
                        <option value="Regular">Regular</option>
                        <option value="En tratamiento">En tratamiento</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Dieta/Alimentación</label>
                <textarea name="dieta" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea name="observaciones" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Foto del Animal</label>
                <input type="file" name="foto" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Registrar Animal
            </button>
        </form>
    </div>

    <!-- Lista de Animales -->
    <div class="table-container">
        <h3>Animales Registrados</h3>
        <?php
        $animales = obtenerAnimales();
        if ($animales && count($animales) > 0) {
            echo '<table class="data-table">';
            echo '<tr>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Habitat</th>
                    <th>Edad</th>
                    <th>Peso</th>
                    <th>Salud</th>
                    <th>Acciones</th>
                </tr>';
            foreach($animales as $animal) {
                $edad = calcularEdad($animal['fecha_nacimiento']);
                echo "<tr>
                        <td>{$animal['nombre']}</td>
                        <td>{$animal['especie']}</td>
                        <td>{$animal['habitat']}</td>
                        <td>{$edad}</td>
                        <td>{$animal['peso']} kg</td>
                        <td><span class='badge badge-{$animal['salud']}'>{$animal['salud']}</span></td>
                        <td>
                            <button class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>";
            }
            echo '</table>';
        } else {
            echo '<p class="no-data">No hay animales registrados.</p>';
        }
        ?>
    </div>
</section>