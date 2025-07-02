<?php 
include '../includes/header.php';
include '../includes/functions.php';

// Obtener todos los estudiantes
$estudiantes = obtenerEstudiantes();
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="col-md-9 col-lg-10">
            <div class="content-area p-4">
                <!-- Encabezado de la página -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <i class="bi bi-people me-2"></i>
                        Lista de Estudiantes
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
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo count($estudiantes); ?></h4>
                                        <p class="mb-0">Total Estudiantes</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-people" style="font-size: 2rem;"></i>
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
                            <div class="col-md-3">
                                <label for="filtroNivel" class="form-label">Nivel:</label>
                                <select class="form-select" id="filtroNivel">
                                    <option value="">Todos los niveles</option>
                                    <option value="inicial">Inicial</option>
                                    <option value="primaria">Primaria</option>
                                    <option value="secundaria">Secundaria</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filtroSexo" class="form-label">Sexo:</label>
                                <select class="form-select" id="filtroSexo">
                                    <option value="">Todos</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="buscarEstudiante" class="form-label">Buscar:</label>
                                <input type="text" class="form-control" id="buscarEstudiante" placeholder="Nombre o apellido...">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-secondary w-100" onclick="limpiarFiltros()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Limpiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de estudiantes -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-table me-2"></i>
                            Estudiantes Registrados
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaEstudiantes">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Apellido Paterno</th>
                                        <th scope="col">Apellido Materno</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Sexo</th>
                                        <th scope="col">Curso</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($estudiantes)): ?>
                                        <?php $contador = 1; ?>
                                        <?php foreach ($estudiantes as $estudiante): ?>
                                            <tr>
                                                <td><?php echo $contador++; ?></td>
                                                <td><?php echo htmlspecialchars($estudiante['apellido_paterno']); ?></td>
                                                <td><?php echo htmlspecialchars($estudiante['apellido_materno']); ?></td>
                                                <td><?php echo htmlspecialchars($estudiante['nombre']); ?></td>
                                                <td>
                                                    <?php if ($estudiante['sexo'] == 'masculino'): ?>
                                                        <span class="badge bg-primary">
                                                            <i class="bi bi-person me-1"></i>
                                                            Masculino
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">
                                                            <i class="bi bi-person-dress me-1"></i>
                                                            Femenino
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        <?php echo ucfirst($estudiante['nombre_nivel']); ?> 
                                                        <?php echo $estudiante['nombre_curso']; ?>
                                                        <?php echo strtoupper($estudiante['nombre_paralelo']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $fechaNac = new DateTime($estudiante['fecha_nacimiento']);
                                                    $hoy = new DateTime();
                                                    $edad = $hoy->diff($fechaNac)->y;
                                                    echo $edad . ' años';
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                                title="Ver detalles">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                                title="Editar">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="py-4">
                                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                                    <p class="mt-2 text-muted">No hay estudiantes registrados</p>
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

<!-- JavaScript para filtros -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filtroNivel = document.getElementById('filtroNivel');
    const filtroSexo = document.getElementById('filtroSexo');
    const buscarEstudiante = document.getElementById('buscarEstudiante');
    const tabla = document.getElementById('tablaEstudiantes');
    const filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    function filtrarTabla() {
        const nivelSeleccionado = filtroNivel.value.toLowerCase();
        const sexoSeleccionado = filtroSexo.value.toLowerCase();
        const textoBusqueda = buscarEstudiante.value.toLowerCase();

        for (let i = 0; i < filas.length; i++) {
            const fila = filas[i];
            const celdas = fila.getElementsByTagName('td');
            
            if (celdas.length > 1) {
                const apellidoPaterno = celdas[1].textContent.toLowerCase();
                const apellidoMaterno = celdas[2].textContent.toLowerCase();
                const nombre = celdas[3].textContent.toLowerCase();
                const sexo = celdas[4].textContent.toLowerCase();
                const curso = celdas[5].textContent.toLowerCase();

                let mostrarFila = true;

                // Filtro por nivel
                if (nivelSeleccionado && !curso.includes(nivelSeleccionado)) {
                    mostrarFila = false;
                }

                // Filtro por sexo
                if (sexoSeleccionado && !sexo.includes(sexoSeleccionado)) {
                    mostrarFila = false;
                }

                // Filtro por búsqueda de texto
                if (textoBusqueda && 
                    !apellidoPaterno.includes(textoBusqueda) && 
                    !apellidoMaterno.includes(textoBusqueda) && 
                    !nombre.includes(textoBusqueda)) {
                    mostrarFila = false;
                }

                fila.style.display = mostrarFila ? '' : 'none';
            }
        }
    }

    // Event listeners para los filtros
    filtroNivel.addEventListener('change', filtrarTabla);
    filtroSexo.addEventListener('change', filtrarTabla);
    buscarEstudiante.addEventListener('input', filtrarTabla);
});

function limpiarFiltros() {
    document.getElementById('filtroNivel').value = '';
    document.getElementById('filtroSexo').value = '';
    document.getElementById('buscarEstudiante').value = '';
    
    // Mostrar todas las filas
    const tabla = document.getElementById('tablaEstudiantes');
    const filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < filas.length; i++) {
        filas[i].style.display = '';
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
