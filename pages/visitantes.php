<?php


// --- Procesamiento del formulario de registro de visitantes ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $tipo_entrada = $_POST['tipo_entrada'] ?? '';
    $fecha_visita = $_POST['fecha_visita'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';

    // Preparar la consulta SQL de forma segura
    $sql = "INSERT INTO visitantes (nombre, email, telefono, tipo_entrada, fecha_visita, observaciones) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $email, $telefono, $tipo_entrada, $fecha_visita, $observaciones);

    // Ejecutar la consulta y mostrar mensaje de éxito o error
    if ($stmt->execute()) {
        echo '<p class="success-message">Visitante registrado exitosamente.</p>';
    } else {
        echo '<p class="error-message">Error al registrar el visitante: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}
?>

<section id="visitantes" class="section">
    <h2><i class="fas fa-users-viewfinder"></i> Gestión de Visitantes</h2>
    
    <div class="form-container">
        <h3>Registrar Nuevo Visitante</h3>
        <form action="index.php?page=visitantes" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre Completo *</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" name="telefono">
                </div>
                <div class="form-group">
                    <label>Tipo de Entrada</label>
                    <select name="tipo_entrada">
                        <option value="Adulto">Adulto</option>
                        <option value="Niño">Niño</option>
                        <option value="Estudiante">Estudiante</option>
                        <option value="Senior">Senior</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha de Visita</label>
                    <input type="date" name="fecha_visita">
                </div>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea name="observaciones" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Registrar Visitante
            </button>
        </form>
    </div>

    <div class="table-container">
        <h3>Visitantes Registrados</h3>
        <?php
        // Función para obtener visitantes de la base de datos
        function obtenerVisitantes($conn) {
            $sql = "SELECT id, nombre, email, telefono, tipo_entrada, fecha_visita FROM visitantes ORDER BY fecha_visita DESC";
            $result = $conn->query($sql);
            $visitantes = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $visitantes[] = $row;
                }
            }
            return $visitantes;
        }

        $visitantes = obtenerVisitantes($conn);
        if ($visitantes && count($visitantes) > 0) {
            echo '<table class="data-table">';
            echo '<tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Tipo de Entrada</th>
                    <th>Fecha de Visita</th>
                    <th>Acciones</th>
                </tr>';
            foreach($visitantes as $visitante) {
                echo "<tr>
                        <td>{$visitante['nombre']}</td>
                        <td>{$visitante['email']}</td>
                        <td>{$visitante['telefono']}</td>
                        <td>{$visitante['tipo_entrada']}</td>
                        <td>{$visitante['fecha_visita']}</td>
                        <td>
                            <button class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>";
            }
            echo '</table>';
        } else {
            echo '<p class="no-data">No hay visitantes registrados.</p>';
        }
        
        // Cierra la conexión a la base de datos
        $conn->close();
        ?>
    </div>
</section>