<?php 
include '../includes/header.php';
include '../includes/functions.php';

// Obtener todos los cursos con estadísticas
$cursos = obtenerCursosConEstadisticas();
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="col-md-9 col-lg-10">
            <div class="content-area p-4">
                <!-- Encabezado de la página -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <i class="bi bi-book me-2"></i>
                        Lista de Cursos
                    </h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-download me-1"></i>
                                Exportar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas rápidas -->
                <div class="row mb-4">
                    <?php 
                    $totalCursos = count($cursos);
                    $totalEstudiantes = array_sum(array_column($cursos, 'total_estudiantes'));
                    $totalMujeres = array_sum(array_column($cursos, 'total_mujeres'));
                    $totalHombres = array_sum(array_column($cursos, 'total_hombres'));
                    ?>
                    
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $totalCursos; ?></h4>
                                        <p class="mb-0">Total Cursos</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-book" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $totalEstudiantes; ?></h4>
                                        <p class="mb-0">Total Estudiantes</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-people" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $totalMujeres; ?></h4>
                                        <p class="mb-0">Mujeres</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-person-dress" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $totalHombres; ?></h4>
                                        <p class="mb-0">Hombres</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-person" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-funnel me-2"></i>
                            Filtros
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="filtroNivel" class="form-label">Nivel:</label>
                                <select class="form-select" id="filtroNivel">
                                    <option value="">Todos los niveles</option>
                                    <option value="inicial">Inicial</option>
                                    <option value="primaria">Primaria</option>
                                    <option value="secundaria">Secundaria</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="ordenarPor" class="form-label">Ordenar por:</label>
                                <select class="form-select" id="ordenarPor">
                                    <option value="nivel">Nivel</option>
                                    <option value="estudiantes">Cantidad de Estudiantes</option>
                                    <option value="mujeres">Cantidad de Mujeres</option>
                                    <option value="hombres">Cantidad de Hombres</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-secondary w-100" onclick="limpiarFiltros()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Limpiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de cursos -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-table me-2"></i>
                            Cursos Registrados
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaCursos">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nivel</th>
                                        <th scope="col">Curso</th>
                                        <th scope="col">Paralelos</th>
                                        <th scope="col">Total Estudiantes</th>
                                        <th scope="col">Mujeres</th>
                                        <th scope="col">Hombres</th>
                                        <th scope="col">Distribución</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cursos)): ?>
                                        <?php $contador = 1; ?>
                                        <?php foreach ($cursos as $curso): ?>
                                            <tr>
                                                <td><?php echo $contador++; ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo getNivelColor($curso['nombre_nivel']); ?>">
                                                        <?php echo ucfirst($curso['nombre_nivel']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong><?php echo $curso['nombre_curso']; ?></strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        <?php echo $curso['total_paralelos']; ?> paralelos
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary fs-6">
                                                        <?php echo $curso['total_estudiantes']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger fs-6">
                                                        <i class="bi bi-person-dress me-1"></i>
                                                        <?php echo $curso['total_mujeres']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info fs-6">
                                                        <i class="bi bi-person me-1"></i>
                                                        <?php echo $curso['total_hombres']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($curso['total_estudiantes'] > 0): ?>
                                                        <?php 
                                                        $porcentajeMujeres = round(($curso['total_mujeres'] / $curso['total_estudiantes']) * 100);
                                                        $porcentajeHombres = 100 - $porcentajeMujeres;
                                                        ?>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar bg-danger" role="progressbar" 
                                                                 style="width: <?php echo $porcentajeMujeres; ?>%" 
                                                                 title="Mujeres: <?php echo $porcentajeMujeres; ?>%">
                                                                <?php echo $porcentajeMujeres; ?>%
                                                            </div>
                                                            <div class="progress-bar bg-info" role="progressbar" 
                                                                 style="width: <?php echo $porcentajeHombres; ?>%" 
                                                                 title="Hombres: <?php echo $porcentajeHombres; ?>%">
                                                                <?php echo $porcentajeHombres; ?>%
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <span class="text-muted">Sin estudiantes</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                                title="Ver estudiantes">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                                title="Reporte">
                                                            <i class="bi bi-file-earmark-text"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <div class="py-4">
                                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                                    <p class="mt-2 text-muted">No hay cursos registrados</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Función para obtener el color del badge según el nivel
function getNivelColor($nivel) {
    switch(strtolower($nivel)) {
        case 'inicial':
            return 'warning';
        case 'primaria':
            return 'success';
        case 'secundaria':
            return 'primary';
        default:
            return 'secondary';
    }
}
?>

<!-- JavaScript para filtros -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filtroNivel = document.getElementById('filtroNivel');
    const ordenarPor = document.getElementById('ordenarPor');
    const tabla = document.getElementById('tablaCursos');
    const tbody = tabla.getElementsByTagName('tbody')[0];
    let filasOriginales = Array.from(tbody.getElementsByTagName('tr'));

    function filtrarYOrdenar() {
        const nivelSeleccionado = filtroNivel.value.toLowerCase();
        const criterioOrden = ordenarPor.value;
        
        // Filtrar filas
        let filasFiltradas = filasOriginales.filter(fila => {
            if (fila.cells.length <= 1) return false; // Saltar fila vacía
            
            const nivel = fila.cells[1].textContent.toLowerCase();
            return !nivelSeleccionado || nivel.includes(nivelSeleccionado);
        });
        
        // Ordenar filas
        filasFiltradas.sort((a, b) => {
            switch(criterioOrden) {
                case 'nivel':
                    return a.cells[1].textContent.localeCompare(b.cells[1].textContent);
                case 'estudiantes':
                    return parseInt(b.cells[4].textContent) - parseInt(a.cells[4].textContent);
                case 'mujeres':
                    return parseInt(b.cells[5].textContent) - parseInt(a.cells[5].textContent);
                case 'hombres':
                    return parseInt(b.cells[6].textContent) - parseInt(a.cells[6].textContent);
                default:
                    return 0;
            }
        });
        
        // Limpiar tbody y agregar filas ordenadas
        tbody.innerHTML = '';
        filasFiltradas.forEach((fila, index) => {
            fila.cells[0].textContent = index + 1; // Actualizar numeración
            tbody.appendChild(fila);
        });
        
        // Si no hay filas, mostrar mensaje
        if (filasFiltradas.length === 0) {
            const filaVacia = document.createElement('tr');
            filaVacia.innerHTML = `
                <td colspan="9" class="text-center">
                    <div class="py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="mt-2 text-muted">No se encontraron cursos</p>
                    </div>
                </td>
            `;
            tbody.appendChild(filaVacia);
        }
    }

    // Event listeners
    filtroNivel.addEventListener('change', filtrarYOrdenar);
    ordenarPor.addEventListener('change', filtrarYOrdenar);
});

function limpiarFiltros() {
    document.getElementById('filtroNivel').value = '';
    document.getElementById('ordenarPor').value = 'nivel';
    
    // Recargar tabla original
    location.reload();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
