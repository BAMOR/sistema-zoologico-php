<?php
// Incluimos la conexión a la base de datos y las funciones de ayuda


// --- Procesamiento del formulario de registro de hábitats ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $clima = $_POST['clima'] ?? '';
    $animales = $_POST['animales'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // Preparar la consulta SQL
    $sql = "INSERT INTO habitats (nombre, clima, animales, estado) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $clima, $animales, $estado);

    // Ejecutar la consulta y mostrar mensaje de éxito o error
    if ($stmt->execute()) {
        echo '<p class="success-message">Hábitat registrado exitosamente.</p>';
    } else {
        echo '<p class="error-message">Error al registrar el hábitat: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}
?>

<section id="habitats" class="section">
    <h2><i class="fas fa-mountain"></i> Gestión de Hábitats</h2>
    
    <div class="form-container">
        <h3>Registrar Nuevo Hábitat</h3>
        <form action="index.php?page=habitats" method="POST">
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
        <?php
        // Función para obtener hábitats de la base de datos
        function obtenerHabitats($conn) {
            $sql = "SELECT id, nombre, clima, animales, estado FROM habitats ORDER BY nombre ASC";
            $result = $conn->query($sql);
            $habitats = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $habitats[] = $row;
                }
            }
            return $habitats;
        }

        $habitats = obtenerHabitats($conn);
        if ($habitats && count($habitats) > 0) {
            echo '<table class="data-table">';
            echo '<tr>
                    <th>Nombre</th>
                    <th>Clima</th>
                    <th>Animales</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>';
            foreach($habitats as $habitat) {
                echo "<tr>
                        <td>{$habitat['nombre']}</td>
                        <td>{$habitat['clima']}</td>
                        <td>{$habitat['animales']}</td>
                        <td><span class='badge badge-{$habitat['estado']}'>{$habitat['estado']}</span></td>
                        <td>
                            <button class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>";
            }
            echo '</table>';
        } else {
            echo '<p class="no-data">No hay hábitats registrados.</p>';
        }
        ?>
    </div>
</section>