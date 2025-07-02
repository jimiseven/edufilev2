<?php
// Definir la ruta base del proyecto
define('BASE_PATH', dirname(__DIR__));

// Definir rutas de directorios importantes
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('PAGES_PATH', BASE_PATH . '/pages');
define('ASSETS_PATH', BASE_PATH . '/assets');

// Función helper para generar URLs consistentes
function url($path = '') {
    // Obtener la ruta base del proyecto desde la URL
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    
    // Si estamos en una subcarpeta (como pages/), subir un nivel
    if (basename($scriptDir) === 'pages') {
        $baseUrl = dirname($scriptDir);
    } else {
        $baseUrl = $scriptDir;
    }
    
    // Construir la URL final
    return $baseUrl . '/' . ltrim($path, '/');
}

// Función alternativa más simple
function baseUrl($path = '') {
    // Detectar la ruta base del proyecto
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $projectPath = '/edufilev2'; // Cambia esto por tu carpeta de proyecto
    
    return $protocol . '://' . $host . $projectPath . '/' . ltrim($path, '/');
}
?>
