<!-- Sección Empleados -->
<section id="empleados" class="section">
    <h2><i class="fas fa-users"></i> Gestión de Empleados</h2>
    
    <!-- Formulario de Empleados -->
    <div class="form-container">
        <h3>Registrar Nuevo Empleado</h3>
        <form action="procesar_empleado.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre Completo *</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>Número de Carnet *</label>
                    <input type="text" name="carnet" required>
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" name="edad">
                </div>
                <div class="form-group">
                    <label>Área de Trabajo *</label>
                    <select name="area" required>
                        <option value="">Seleccione un área</option>
                        <option value="Cuidado de animales">Cuidado de animales</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Administración">Administración</option>
                        <option value="Seguridad">Seguridad</option>
                        <option value="Guía turístico">Guía turístico</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso">
                </div>
                <div class="form-group">
                    <label>Salario</label>
                    <input type="number" step="0.01" name="salario">
                </div>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <textarea name="direccion" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label>Teléfono de Contacto</label>
                <input type="tel" name="telefono">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Registrar Empleado
            </button>
        </form>
    </div>

    <!-- Lista de Empleados -->
    <div class="table-container">
        <h3>Empleados Registrados</h3>
        <?php
        $empleados = obtenerEmpleados();
        if ($empleados && count($empleados) > 0) {
            echo '<table class="data-table">';
            echo '<tr>
                    <th>Nombre</th>
                    <th>Carnet</th>
                    <th>Edad</th>
                    <th>Área</th>
                    <th>Fecha Ingreso</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                </tr>';
            foreach($empleados as $empleado) {
                echo "<tr>
                        <td>{$empleado['nombre']}</td>
                        <td>{$empleado['carnet']}</td>
                        <td>{$empleado['edad']}</td>
                        <td>{$empleado['area']}</td>
                        <td>{$empleado['fecha_ingreso']}</td>
                        <td>\${$empleado['salario']}</td>
                        <td>
                            <button class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>";
            }
            echo '</table>';
        } else {
            echo '<p class="no-data">No hay empleados registrados.</p>';
        }
        ?>
    </div>
</section>