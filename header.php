<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Zoológico</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container">
    <!-- Header -->
    <header class="header">
        <h1><i class="fas fa-paw"></i> Sistema de Gestión - Zoológico</h1>
        <nav class="nav">
            <a href="index.php?seccion=animales" class="nav-link <?php echo ($seccion_activa == 'animales') ? 'active' : ''; ?>">Animales</a>
            <a href="index.php?seccion=empleados" class="nav-link <?php echo ($seccion_activa == 'empleados') ? 'active' : ''; ?>">Empleados</a>
            <a href="index.php?seccion=habitats" class="nav-link <?php echo ($seccion_activa == 'habitats') ? 'active' : ''; ?>">Hábitats</a>
            <a href="index.php?seccion=visitantes" class="nav-link <?php echo ($seccion_activa == 'visitantes') ? 'active' : ''; ?>">Visitantes</a>
            <a href="index.php?seccion=inventario" class="nav-link <?php echo ($seccion_activa == 'inventario') ? 'active' : ''; ?>">Inventario</a>
        </nav>
    </header>