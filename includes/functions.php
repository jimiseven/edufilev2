    
<?php
require_once __DIR__ . '/../config/database.php';   // ← ruta correcta


// Función para obtener todos los estudiantes
function obtenerEstudiantes() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT 
                e.id_estudiante,
                e.nombre,
                e.apellido_paterno,
                e.apellido_materno,
                e.fecha_nacimiento,
                e.sexo,
                n.nombre_nivel,
                c.nombre_curso,
                p.nombre_paralelo
              FROM estudiantes e
              JOIN paralelos p ON e.id_paralelo = p.id_paralelo
              JOIN cursos c ON p.id_curso = c.id_curso
              JOIN niveles n ON c.id_nivel = n.id_nivel
              ORDER BY n.id_nivel, c.nombre_curso, p.nombre_paralelo, e.apellido_paterno";
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todos los cursos
function obtenerCursos() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT 
                c.id_curso,
                c.nombre_curso,
                n.nombre_nivel,
                COUNT(p.id_paralelo) as total_paralelos,
                COUNT(e.id_estudiante) as total_estudiantes
              FROM cursos c
              JOIN niveles n ON c.id_nivel = n.id_nivel
              LEFT JOIN paralelos p ON c.id_curso = p.id_curso
              LEFT JOIN estudiantes e ON p.id_paralelo = e.id_paralelo
              GROUP BY c.id_curso, c.nombre_curso, n.nombre_nivel
              ORDER BY n.id_nivel, c.nombre_curso";
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener estadísticas del dashboard
function obtenerEstadisticas() {
    $database = new Database();
    $db = $database->getConnection();
    
    $stats = [];
    
    // Total estudiantes
    $query = "SELECT COUNT(*) as total FROM estudiantes";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_estudiantes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Total cursos
    $query = "SELECT COUNT(*) as total FROM cursos";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_cursos'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Total niveles
    $query = "SELECT COUNT(*) as total FROM niveles";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_niveles'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Total paralelos
    $query = "SELECT COUNT(*) as total FROM paralelos";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_paralelos'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    return $stats;
}
?>
