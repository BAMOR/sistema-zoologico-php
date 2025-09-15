<?php
// Incluimos el archivo de conexión a la base de datos
include 'includes/db_connection.php';
// Incluimos las funciones de ayuda
include 'includes/funciones.php';

// --- Procesamiento del formulario de registro ---

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $habitat = $_POST['habitat'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $peso = $_POST['peso'] ?? 0;
    $salud = $_POST['salud'] ?? '';
    $dieta = $_POST['dieta'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';

    // Lógica para subir la foto
    $foto_path = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $foto_name = uniqid('animal_', true) . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_path = $upload_dir . $foto_name;
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);
    }

    // Preparar la consulta SQL de forma segura
    $sql = "INSERT INTO animales (nombre, especie, habitat, fecha_nacimiento, peso, salud, dieta, observaciones, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdssss", $nombre, $especie, $habitat, $fecha_nacimiento, $peso, $salud, $dieta, $observaciones, $foto_path);

    // Ejecutar la consulta y mostrar mensaje de éxito o error
    if ($stmt->execute()) {
        echo '<p class="success-message">Animal registrado exitosamente.</p>';
    } else {
        echo '<p class="error-message">Error al registrar el animal: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}
?>

<section id="animales" class="section">
    <h2><i class="fas fa-paw"></i> Gestión de Animales</h2>
    
    <div class="form-container">
        <h3>Registrar Nuevo Animal</h3>
        <form action="index.php?page=animales" method="POST" enctype="multipart/form-data">
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

    <div class="table-container">
        <h3>Animales Registrados</h3>
        <?php
        // Obtenemos los animales de la base de datos
        $animales = obtenerAnimales($conn);
        
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
        
        // Cierra la conexión a la base de datos
        $conn->close();
        ?>
    </div>
</section>