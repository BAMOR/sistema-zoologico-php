<?php
// Incluimos la conexión a la base de datos y las funciones de ayuda

// --- Procesamiento del formulario de registro de empleados ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $puesto = $_POST['puesto'] ?? '';
    $fecha_contratacion = $_POST['fecha_contratacion'] ?? '';
    $salario = $_POST['salario'] ?? 0;
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';

    // Preparar la consulta SQL
    $sql = "INSERT INTO empleados (nombre, puesto, fecha_contratacion, salario, telefono, email, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsss", $nombre, $puesto, $fecha_contratacion, $salario, $telefono, $email, $observaciones);

    // Ejecutar la consulta y mostrar mensaje de éxito o error
    if ($stmt->execute()) {
        echo '<p class="success-message">Empleado registrado exitosamente.</p>';
    } else {
        echo '<p class="error-message">Error al registrar el empleado: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}
?>

<section id="empleados" class="section">
    <h2><i class="fas fa-user-tie"></i> Gestión de Empleados</h2>
    
    <div class="form-container">
        <h3>Registrar Nuevo Empleado</h3>
        <form action="index.php?page=empleados" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre Completo *</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>Puesto *</label>
                    <input type="text" name="puesto" required>
                </div>
                <div class="form-group">
                    <label>Fecha de Contratación</label>
                    <input type="date" name="fecha_contratacion">
                </div>
                <div class="form-group">
                    <label>Salario</label>
                    <input type="number" step="0.01" name="salario">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea name="observaciones" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Registrar Empleado
            </button>
        </form>
    </div>

    <div class="table-container">
        <h3>Empleados Registrados</h3>
        <?php
        $empleados = obtenerEmpleados($conn);
        if ($empleados && count($empleados) > 0) {
            echo '<table class="data-table">';
            echo '<tr>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Fecha de Contratación</th>
                    <th>Salario</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>';
            foreach($empleados as $empleado) {
                echo "<tr>
                        <td>{$empleado['nombre']}</td>
                        <td>{$empleado['puesto']}</td>
                        <td>{$empleado['fecha_contratacion']}</td>
                        <td>\${$empleado['salario']}</td>
                        <td>{$empleado['telefono']}<br>{$empleado['email']}</td>
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