<?php
// Incluimos la conexión a la base de datos y las funciones de ayuda


// --- Procesamiento del formulario de alimentos ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_alimento'])) {
    $nombre = $_POST['nombre'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $cantidad = $_POST['cantidad'] ?? 0;
    $unidad = $_POST['unidad'] ?? '';
    $fecha_caducidad = $_POST['fecha_caducidad'] ?? NULL;
    $animales = $_POST['animales'] ?? '';

    $sql = "INSERT INTO alimentos (nombre, tipo, cantidad, unidad, fecha_caducidad, animales) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $nombre, $tipo, $cantidad, $unidad, $fecha_caducidad, $animales);

    if ($stmt->execute()) {
        echo '<p class="success-message">Alimento registrado exitosamente.</p>';
    } else {
        echo '<p class="error-message">Error al registrar el alimento: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}

// --- Procesamiento del formulario de medicinas ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_medicina'])) {
    $nombre = $_POST['nombre'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $cantidad = $_POST['cantidad'] ?? 0;
    $unidad = $_POST['unidad'] ?? '';
    $fecha_caducidad = $_POST['fecha_caducidad'] ?? NULL;
    $animales = $_POST['animales'] ?? '';
    $instrucciones = $_POST['instrucciones'] ?? '';

    $sql = "INSERT INTO medicinas (nombre, tipo, cantidad, unidad, fecha_caducidad, animales, instrucciones) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissss", $nombre, $tipo, $cantidad, $unidad, $fecha_caducidad, $animales, $instrucciones);

    if ($stmt->execute()) {
        echo '<p class="success-message">Medicina registrada exitosamente.</p>';
    } else {
        echo '<p class="error-message">Error al registrar la medicina: ' . $stmt->error . '</p>';
    }
    $stmt->close();
}
?>

<section id="inventario" class="section">
    <h2><i class="fas fa-boxes"></i> Gestión de Inventario</h2>
    
    <div class="tabs">
        <button class="tab-btn active" data-tab="alimentacion">Alimentación</button>
        <button class="tab-btn" data-tab="medicina">Medicina</button>
    </div>
    
    <div id="tab-alimentacion" class="tab-content active">
        <div class="form-container">
            <h3>Registrar Nuevo Alimento</h3>
            <form action="index.php?page=inventario" method="POST">
                <input type="hidden" name="form_alimento" value="1">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre del Alimento *</label>
                        <input type="text" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Alimento *</label>
                        <select name="tipo" required>
                            <option value="">Seleccione tipo</option>
                            <option value="Carne">Carne</option>
                            <option value="Pescado">Pescado</option>
                            <option value="Fruta">Fruta</option>
                            <option value="Verdura">Verdura</option>
                            <option value="Granos">Granos</option>
                            <option value="Balanceado">Balanceado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cantidad en Stock *</label>
                        <input type="number" name="cantidad" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Unidad de Medida *</label>
                        <select name="unidad" required>
                            <option value="kg">Kilogramos (kg)</option>
                            <option value="g">Gramos (g)</option>
                            <option value="lb">Libras (lb)</option>
                            <option value="unidad">Unidades</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Caducidad</label>
                        <input type="date" name="fecha_caducidad">
                    </div>
                    <div class="form-group">
                        <label>Animales que lo consumen</label>
                        <input type="text" name="animales" placeholder="Separar por comas">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Registrar Alimento
                </button>
            </form>
        </div>

        <div class="table-container">
            <h3>Inventario de Alimentos</h3>
            <?php
            function obtenerAlimentos($conn) {
                $sql = "SELECT id, nombre, tipo, cantidad, unidad, fecha_caducidad, animales FROM alimentos ORDER BY nombre ASC";
                $result = $conn->query($sql);
                $alimentos = [];
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $alimentos[] = $row;
                    }
                }
                return $alimentos;
            }
            $alimentos = obtenerAlimentos($conn);
            if ($alimentos && count($alimentos) > 0) {
                echo '<table class="data-table">';
                echo '<tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Caducidad</th>
                        <th>Animales</th>
                        <th>Acciones</th>
                    </tr>';
                foreach($alimentos as $alimento) {
                    echo "<tr>
                            <td>{$alimento['nombre']}</td>
                            <td>{$alimento['tipo']}</td>
                            <td>{$alimento['cantidad']}</td>
                            <td>{$alimento['unidad']}</td>
                            <td>{$alimento['fecha_caducidad']}</td>
                            <td>{$alimento['animales']}</td>
                            <td>
                                <button class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button>
                                <button class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></button>
                                <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                            </td>
                        </tr>";
                }
                echo '</table>';
            } else {
                echo '<p class="no-data">No hay alimentos registrados.</p>';
            }
            ?>
        </div>
    </div>
    
    <div id="tab-medicina" class="tab-content">
        <div class="form-container">
            <h3>Registrar Nueva Medicina</h3>
            <form action="index.php?page=inventario" method="POST">
                <input type="hidden" name="form_medicina" value="1">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre de la Medicina *</label>
                        <input type="text" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Medicina *</label>
                        <select name="tipo" required>
                            <option value="">Seleccione tipo</option>
                            <option value="Antibiótico">Antibiótico</option>
                            <option value="Analgésico">Analgésico</option>
                            <option value="Vacuna">Vacuna</option>
                            <option value="Desparasitante">Desparasitante</option>
                            <option value="Vitaminas">Vitaminas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cantidad en Stock *</label>
                        <input type="number" name="cantidad" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Unidad de Medida *</label>
                        <select name="unidad" required>
                            <option value="ml">Mililitros (ml)</option>
                            <option value="l">Litros (l)</option>
                            <option value="mg">Miligramos (mg)</option>
                            <option value="g">Gramos (g)</option>
                            <option value="unidad">Unidades</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Caducidad</label>
                        <input type="date" name="fecha_caducidad">
                    </div>
                    <div class="form-group">
                        <label>Animales que la requieren</label>
                        <input type="text" name="animales" placeholder="Separar por comas">
                    </div>
                </div>
                <div class="form-group">
                    <label>Instrucciones de Uso</label>
                    <textarea name="instrucciones" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Registrar Medicina
                </button>
            </form>
        </div>

        <div class="table-container">
            <h3>Inventario de Medicinas</h3>
            <?php
            function obtenerMedicinas($conn) {
                $sql = "SELECT id, nombre, tipo, cantidad, unidad, fecha_caducidad, animales FROM medicinas ORDER BY nombre ASC";
                $result = $conn->query($sql);
                $medicinas = [];
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $medicinas[] = $row;
                    }
                }
                return $medicinas;
            }
            $medicinas = obtenerMedicinas($conn);
            if ($medicinas && count($medicinas) > 0) {
                echo '<table class="data-table">';
                echo '<tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Caducidad</th>
                        <th>Animales</th>
                        <th>Acciones</th>
                    </tr>';
                foreach($medicinas as $medicina) {
                    echo "<tr>
                            <td>{$medicina['nombre']}</td>
                            <td>{$medicina['tipo']}</td>
                            <td>{$medicina['cantidad']}</td>
                            <td>{$medicina['unidad']}</td>
                            <td>{$medicina['fecha_caducidad']}</td>
                            <td>{$medicina['animales']}</td>
                            <td>
                                <button class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button>
                                <button class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></button>
                                <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                            </td>
                        </tr>";
                }
                echo '</table>';
            } else {
                echo '<p class="no-data">No hay medicinas registradas.</p>';
            }
            ?>
        </div>
    </div>
</section>
<script>
    // Script para la funcionalidad de pestañas
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetTab = tab.getAttribute('data-tab');

                tabs.forEach(item => item.classList.remove('active'));
                tabContents.forEach(item => item.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(`tab-${targetTab}`).classList.add('active');
            });
        });
    });
</script>