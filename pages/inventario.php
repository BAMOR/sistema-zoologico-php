<!-- Sección Inventario -->
<section id="inventario" class="section">
    <h2><i class="fas fa-boxes"></i> Gestión de Inventario</h2>
    
    <!-- Tabs para Inventario -->
    <div class="tabs">
        <button class="tab-btn active" data-tab="alimentacion">Alimentación</button>
        <button class="tab-btn" data-tab="medicina">Medicina</button>
    </div>
    
    <!-- Contenido de pestaña Alimentación -->
    <div id="tab-alimentacion" class="tab-content active">
        <div class="form-container">
            <h3>Registrar Nuevo Alimento</h3>
            <form action="procesar_alimento.php" method="POST">
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

        <!-- Lista de Alimentos -->
        <div class="table-container">
            <h3>Inventario de Alimentos</h3>
            <?php
            $alimentos = obtenerAlimentos();
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
    
    <!-- Contenido de pestaña Medicina -->
    <div id="tab-medicina" class="tab-content">
        <div class="form-container">
            <h3>Registrar Nueva Medicina</h3>
            <form action="procesar_medicina.php" method="POST">
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

        <!-- Lista de Medicinas -->
        <div class="table-container">
            <h3>Inventario de Medicinas</h3>
            <?php
            $medicinas = obtenerMedicinas();
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