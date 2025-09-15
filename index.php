<?php
// Incluir funciones y configuración
include 'includes/funciones.php';
include 'includes/config.php';

// Determinar qué sección mostrar
$secciones_validas = ['animales', 'empleados', 'habitats', 'visitantes', 'inventario'];
$seccion_activa = isset($_GET['seccion']) && in_array($_GET['seccion'], $secciones_validas) ? $_GET['seccion'] : 'animales';

// Incluir la cabecera
include 'header.php';

// Mostrar dashboard
include 'dashboard.php';

// Mostrar la sección correspondiente
include "secciones/$seccion_activa.php";

// Incluir el pie de página
include 'footer.php';
?>