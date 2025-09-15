<?php
// Funciones auxiliares para simular datos hasta que tengamos base de datos

function contarRegistros($tipo) {
    // Simular conteo de registros
    $contadores = [
        'animales' => 15,
        'empleados' => 8,
        'habitats' => 5,
        'visitantes' => 32,
        'inventario' => 24
    ];
    
    return $contadores[$tipo] ?? 0;
}

function obtenerAnimales() {
    // Simular datos de animales
    return [
        [
            'nombre' => 'Leo',
            'especie' => 'León',
            'habitat' => 'Sabana',
            'fecha_nacimiento' => '2018-05-12',
            'peso' => 180,
            'salud' => 'Excelente'
        ],
        [
            'nombre' => 'Mamba',
            'especie' => 'Serpiente',
            'habitat' => 'Terrario',
            'fecha_nacimiento' => '2020-11-03',
            'peso' => 4.5,
            'salud' => 'Bueno'
        ]
    ];
}

function obtenerEmpleados() {
    // Simular datos de empleados
    return [
        [
            'nombre' => 'Juan Pérez',
            'carnet' => 'EMP-001',
            'edad' => 32,
            'area' => 'Cuidado de animales',
            'fecha_ingreso' => '2020-03-15',
            'salario' => 1200.00
        ],
        [
            'nombre' => 'María García',
            'carnet' => 'EMP-002',
            'edad' => 28,
            'area' => 'Administración',
            'fecha_ingreso' => '2021-06-20',
            'salario' => 1500.00
        ]
    ];
}

function obtenerVisitantes() {
    // Simular datos de visitantes
    return [
        [
            'nombre' => 'Carlos Rodríguez',
            'ticket' => 'TKT-0001',
            'membresia' => 'General',
            'fecha_visita' => '2023-10-15',
            'numero_personas' => 3,
            'edad' => 35
        ],
        [
            'nombre' => 'Ana Martínez',
            'ticket' => 'TKT-0002',
            'membresia' => 'VIP',
            'fecha_visita' => '2023-10-16',
            'numero_personas' => 2,
            'edad' => 28
        ]
    ];
}

function obtenerAlimentos() {
    // Simular datos de alimentos
    return [
        [
            'nombre' => 'Carne de res',
            'tipo' => 'Carne',
            'cantidad' => 50,
            'unidad' => 'kg',
            'fecha_caducidad' => '2023-11-20',
            'animales' => 'Leones, Tigres'
        ],
        [
            'nombre' => 'Manzanas',
            'tipo' => 'Fruta',
            'cantidad' => 25,
            'unidad' => 'kg',
            'fecha_caducidad' => '2023-10-25',
            'animales' => 'Monos, Osos'
        ]
    ];
}

function obtenerMedicinas() {
    // Simular datos de medicinas
    return [
        [
            'nombre' => 'Antibiótico AV-500',
            'tipo' => 'Antibiótico',
            'cantidad' => 10,
            'unidad' => 'ml',
            'fecha_caducidad' => '2024-05-15',
            'animales' => 'Aves, Reptiles'
        ],
        [
            'nombre' => 'Vitamina C',
            'tipo' => 'Vitaminas',
            'cantidad' => 500,
            'unidad' => 'mg',
            'fecha_caducidad' => '2024-02-10',
            'animales' => 'Todos'
        ]
    ];
}

function calcularEdad($fecha_nacimiento) {
    if (empty($fecha_nacimiento)) return 'Desconocida';
    
    $nacimiento = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $diferencia = $hoy->diff($nacimiento);
    
    return $diferencia->y . ' años';
}
?>