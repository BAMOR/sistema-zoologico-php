<!-- Sección Visitantes -->
<section id="visitantes" class="section">
    <h2><i class="fas fa-user-friends"></i> Gestión de Visitantes</h2>
    
    <!-- Formulario de Visitantes -->
    <div class="form-container">
        <h3>Registrar Nuevo Visitante</h3>
        <form action="procesar_visitante.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre Completo *</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label>Número de Ticket *</label>
                    <input type="text" name="ticket" required>
                </div>
                <div class="form-group">
                    <label>Tipo de Membresía *</label>
                    <select name="membresia" required>
                        <option value="">Seleccione membresía</option>
                        <option value="General">General</option>
                        <option value="VIP">VIP</option>
                        <option value="Anual">Anual</option>
                        <option value="Familiar">Familiar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha de Visita</label>
                    <input type="date" name="fecha_visita">
                </div>
                <div class="form-group">
                    <label>Número de Personas</label>
                    <input type="number" name="numero_personas" min="1" value="1">
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" name="edad">
                </div>
            </div>
            <div class="form-group">
                <label>Comentarios/Observaciones</label>
                <textarea name="comentarios" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Registrar Visitante
            </button>
        </form>
    </div>

    <!-- Lista de Visitantes -->
    <div class="table-container">
        <h3>Visitantes Registrados</h3>
        <?php
        $visitantes = obtenerVisitantes();
        if ($visitantes && count($visitantes) > 0) {
            echo '<table class="data-table">';
            echo '<tr>
                    <th>Nombre</th>
                    <th>Ticket</th>
                    <th>Membresía</th>
                    <th>Fecha Visita</th>
                    <th>N° Personas</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>';
            foreach($visitantes as $visitante) {
                echo "<tr>
                        <td>{$visitante['nombre']}</td>
                        <td>{$visitante['ticket']}</td>
                        <td><span class='badge'>{$visitante['membresia']}</span></td>
                        <td>{$visitante['fecha_visita']}</td>
                        <td>{$visitante['numero_personas']}</td>
                        <td>{$visitante['edad']}</td>
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
        ?>
    </div>
</section>