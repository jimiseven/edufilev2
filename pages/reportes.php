<?php
include '../includes/header.php';
include '../includes/functions.php';

// Obtener estadísticas para los reportes
$stats = obtenerEstadisticas();
$estudiantes = obtenerEstudiantes();
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
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>
                        Reportes del Sistema
                    </h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-primary" onclick="mostrarCrearReporte()">
                                <i class="bi bi-plus-circle me-1"></i>
                                Crear Reportes
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download me-1"></i>
                                Exportar Todo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal/Sección para Crear Reportes Personalizados -->
                <div class="card mb-4" id="seccionCrearReporte" style="display: none;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-gear me-2"></i>
                            Crear Reporte Personalizado
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="formCrearReporte">
                            <div class="row">
                                <!-- Selección de Niveles -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-layers me-2"></i>
                                        Niveles Educativos
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="todos" id="todosniveles" onchange="toggleTodos('niveles')">
                                        <label class="form-check-label fw-bold" for="todosniveles">
                                            Todos los niveles
                                        </label>
                                    </div>
                                    <hr class="my-2">
                                    <div class="form-check">
                                        <input class="form-check-input nivel-check" type="checkbox" value="inicial" id="inicial">
                                        <label class="form-check-label" for="inicial">
                                            <span class="badge bg-warning text-dark">Inicial</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input nivel-check" type="checkbox" value="primaria" id="primaria">
                                        <label class="form-check-label" for="primaria">
                                            <span class="badge bg-success">Primaria</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input nivel-check" type="checkbox" value="secundaria" id="secundaria">
                                        <label class="form-check-label" for="secundaria">
                                            <span class="badge bg-primary">Secundaria</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Selección de Cursos -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-book me-2"></i>
                                        Cursos
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="todos" id="todoscursos" onchange="toggleTodos('cursos')">
                                        <label class="form-check-label fw-bold" for="todoscursos">
                                            Todos los cursos
                                        </label>
                                    </div>
                                    <hr class="my-2">
                                    <div class="form-check">
                                        <input class="form-check-input curso-check" type="checkbox" value="1" id="curso1">
                                        <label class="form-check-label" for="curso1">
                                            Curso 1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input curso-check" type="checkbox" value="2" id="curso2">
                                        <label class="form-check-label" for="curso2">
                                            Curso 2
                                        </label>
                                    </div>
                                </div>

                                <!-- Selección de Paralelos -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-grid me-2"></i>
                                        Paralelos
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="todos" id="todosparalelos" onchange="toggleTodos('paralelos')">
                                        <label class="form-check-label fw-bold" for="todosparalelos">
                                            Todos los paralelos
                                        </label>
                                    </div>
                                    <hr class="my-2">
                                    <div class="form-check">
                                        <input class="form-check-input paralelo-check" type="checkbox" value="a" id="paraleloA">
                                        <label class="form-check-label" for="paraleloA">
                                            Paralelo A
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input paralelo-check" type="checkbox" value="b" id="paraleloB">
                                        <label class="form-check-label" for="paraleloB">
                                            Paralelo B
                                        </label>
                                    </div>
                                </div>

                                <!-- Selección de Género -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-gender-ambiguous me-2"></i>
                                        Género
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="todos" id="todosgeneros" onchange="toggleTodos('generos')">
                                        <label class="form-check-label fw-bold" for="todosgeneros">
                                            Ambos géneros
                                        </label>
                                    </div>
                                    <hr class="my-2">
                                    <div class="form-check">
                                        <input class="form-check-input genero-check" type="checkbox" value="masculino" id="masculino">
                                        <label class="form-check-label" for="masculino">
                                            <span class="badge bg-info">
                                                <i class="bi bi-person me-1"></i>
                                                Masculino
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input genero-check" type="checkbox" value="femenino" id="femenino">
                                        <label class="form-check-label" for="femenino">
                                            <span class="badge bg-danger">
                                                <i class="bi bi-person-dress me-1"></i>
                                                Femenino
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Selección de Edad -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-calendar-date me-2"></i>
                                    Filtro por Edad
                                </label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="todos" id="todasedades" onchange="toggleFiltroEdad()">
                                            <label class="form-check-label fw-bold" for="todasedades">
                                                Todas las edades
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="edadMinima" class="form-label">Edad mínima:</label>
                                        <input type="number" class="form-control" id="edadMinima" min="3" max="18" placeholder="Ej: 5">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="edadMaxima" class="form-label">Edad máxima:</label>
                                        <input type="number" class="form-control" id="edadMaxima" min="3" max="18" placeholder="Ej: 12">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Rangos predefinidos:</label>
                                        <select class="form-select" id="rangoEdadPredefinido" onchange="aplicarRangoPredefinido()">
                                            <option value="">Seleccionar rango...</option>
                                            <option value="3-5">Inicial (3-5 años)</option>
                                            <option value="6-11">Primaria (6-11 años)</option>
                                            <option value="12-17">Secundaria (12-17 años)</option>
                                            <option value="3-8">Niños pequeños (3-8 años)</option>
                                            <option value="9-14">Preadolescentes (9-14 años)</option>
                                            <option value="15-18">Adolescentes (15-18 años)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Puedes usar rangos predefinidos o establecer edades personalizadas. Deja vacío para incluir todas las edades.
                                        </small>
                                    </div>
                                </div>
                            </div>


                            <!-- Botones de acción -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-success" onclick="generarReportePersonalizado()">
                                            <i class="bi bi-search me-2"></i>
                                            Generar Reporte
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="limpiarFiltrosReporte()">
                                            <i class="bi bi-arrow-clockwise me-2"></i>
                                            Limpiar Filtros
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="ocultarCrearReporte()">
                                            <i class="bi bi-x-circle me-2"></i>
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sección de Resultados del Reporte Personalizado -->
                <div class="card" id="resultadosReporte" style="display: none;">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-table me-2"></i>
                                Resultados del Reporte Personalizado
                            </h5>
                            <div>
                                <button class="btn btn-light btn-sm me-2" onclick="exportarReporte('excel')">
                                    <i class="bi bi-file-earmark-excel me-1"></i>
                                    Excel
                                </button>
                                <button class="btn btn-light btn-sm" onclick="exportarReporte('pdf')">
                                    <i class="bi bi-file-earmark-pdf me-1"></i>
                                    PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Resumen de filtros aplicados -->
                        <div class="alert alert-info" id="resumenFiltros">
                            <strong>Filtros aplicados:</strong> <span id="filtrosTexto"></span>
                        </div>

                        <!-- Estadísticas del reporte -->
                        <div class="row mb-3" id="estadisticasReporte">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h4 id="totalResultados">0</h4>
                                        <p class="mb-0">Total Estudiantes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger text-white">
                                    <div class="card-body text-center">
                                        <h4 id="totalMujeres">0</h4>
                                        <p class="mb-0">Mujeres</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h4 id="totalHombres">0</h4>
                                        <p class="mb-0">Hombres</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-dark">
                                    <div class="card-body text-center">
                                        <h4 id="edadPromedio">0</h4>
                                        <p class="mb-0">Edad Promedio</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de resultados -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaResultados">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Curso</th>
                                        <th>Edad</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpoTablaResultados">
                                    <!-- Los resultados se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Resto del contenido existente de reportes por defecto -->
                <div id="reportesPorDefecto">
                    <!-- Aquí va todo el contenido existente de las tarjetas de reportes -->
                    <!-- ... (mantén todo el código existente) ... -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para el sistema de reportes personalizados -->
<script>
    // Datos de estudiantes (se cargarán desde PHP)
    const todosLosEstudiantes = <?php echo json_encode($estudiantes); ?>;

    function mostrarCrearReporte() {
        document.getElementById('seccionCrearReporte').style.display = 'block';
        document.getElementById('reportesPorDefecto').style.display = 'none';
        document.getElementById('resultadosReporte').style.display = 'none';
    }

    function ocultarCrearReporte() {
        document.getElementById('seccionCrearReporte').style.display = 'none';
        document.getElementById('reportesPorDefecto').style.display = 'block';
        document.getElementById('resultadosReporte').style.display = 'none';
    }

    function toggleTodos(categoria) {
        const todosCheckbox = document.getElementById('todos' + categoria);
        const checkboxes = document.querySelectorAll('.' + categoria.slice(0, -1) + '-check');

        checkboxes.forEach(checkbox => {
            checkbox.checked = todosCheckbox.checked;
        });
    }

    function toggleFiltroEdad() {
        const todasEdades = document.getElementById('todasedades');
        const edadMinima = document.getElementById('edadMinima');
        const edadMaxima = document.getElementById('edadMaxima');
        const rangoPredefinido = document.getElementById('rangoEdadPredefinido');

        if (todasEdades.checked) {
            edadMinima.value = '';
            edadMaxima.value = '';
            rangoPredefinido.value = '';
            edadMinima.disabled = true;
            edadMaxima.disabled = true;
            rangoPredefinido.disabled = true;
        } else {
            edadMinima.disabled = false;
            edadMaxima.disabled = false;
            rangoPredefinido.disabled = false;
        }
    }

    function aplicarRangoPredefinido() {
        const rangoSeleccionado = document.getElementById('rangoEdadPredefinido').value;
        const edadMinima = document.getElementById('edadMinima');
        const edadMaxima = document.getElementById('edadMaxima');

        if (rangoSeleccionado) {
            const [min, max] = rangoSeleccionado.split('-');
            edadMinima.value = min;
            edadMaxima.value = max;
            document.getElementById('todasedades').checked = false;
        }
    }

    function limpiarFiltrosReporte() {
        // Limpiar todos los checkboxes
        const checkboxes = document.querySelectorAll('#formCrearReporte input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Limpiar campos de edad
        document.getElementById('edadMinima').value = '';
        document.getElementById('edadMaxima').value = '';
        document.getElementById('rangoEdadPredefinido').value = '';
        document.getElementById('edadMinima').disabled = false;
        document.getElementById('edadMaxima').disabled = false;
        document.getElementById('rangoEdadPredefinido').disabled = false;
    }

    function generarReportePersonalizado() {
        // Obtener filtros seleccionados
        const filtros = obtenerFiltrosSeleccionados();

        // Validar filtros de edad
        if (!validarFiltrosEdad(filtros)) {
            return;
        }

        // Filtrar estudiantes
        const estudiantesFiltrados = filtrarEstudiantes(filtros);

        // Mostrar resultados
        mostrarResultados(estudiantesFiltrados, filtros);
    }

    function obtenerFiltrosSeleccionados() {
        const filtros = {
            niveles: [],
            cursos: [],
            paralelos: [],
            generos: [],
            edad: {
                todas: false,
                minima: null,
                maxima: null
            }
        };

        // Obtener niveles seleccionados
        if (document.getElementById('todosniveles').checked) {
            filtros.niveles = ['inicial', 'primaria', 'secundaria'];
        } else {
            document.querySelectorAll('.nivel-check:checked').forEach(checkbox => {
                filtros.niveles.push(checkbox.value);
            });
        }

        // Obtener cursos seleccionados
        if (document.getElementById('todoscursos').checked) {
            filtros.cursos = ['1', '2'];
        } else {
            document.querySelectorAll('.curso-check:checked').forEach(checkbox => {
                filtros.cursos.push(checkbox.value);
            });
        }

        // Obtener paralelos seleccionados
        if (document.getElementById('todosparalelos').checked) {
            filtros.paralelos = ['a', 'b'];
        } else {
            document.querySelectorAll('.paralelo-check:checked').forEach(checkbox => {
                filtros.paralelos.push(checkbox.value);
            });
        }

        // Obtener géneros seleccionados
        if (document.getElementById('todosgeneros').checked) {
            filtros.generos = ['masculino', 'femenino'];
        } else {
            document.querySelectorAll('.genero-check:checked').forEach(checkbox => {
                filtros.generos.push(checkbox.value);
            });
        }

        // Obtener filtros de edad
        filtros.edad.todas = document.getElementById('todasedades').checked;
        const edadMinima = document.getElementById('edadMinima').value;
        const edadMaxima = document.getElementById('edadMaxima').value;

        if (edadMinima) filtros.edad.minima = parseInt(edadMinima);
        if (edadMaxima) filtros.edad.maxima = parseInt(edadMaxima);

        return filtros;
    }

    function validarFiltrosEdad(filtros) {
        if (!filtros.edad.todas && filtros.edad.minima !== null && filtros.edad.maxima !== null) {
            if (filtros.edad.minima > filtros.edad.maxima) {
                alert('Error: La edad mínima no puede ser mayor que la edad máxima.');
                return false;
            }
        }

        if (filtros.edad.minima !== null && (filtros.edad.minima < 3 || filtros.edad.minima > 18)) {
            alert('Error: La edad mínima debe estar entre 3 y 18 años.');
            return false;
        }

        if (filtros.edad.maxima !== null && (filtros.edad.maxima < 3 || filtros.edad.maxima > 18)) {
            alert('Error: La edad máxima debe estar entre 3 y 18 años.');
            return false;
        }

        return true;
    }

    function calcularEdad(fechaNacimiento) {
        const fechaNac = new Date(fechaNacimiento);
        const hoy = new Date();
        return Math.floor((hoy - fechaNac) / (365.25 * 24 * 60 * 60 * 1000));
    }

    function filtrarEstudiantes(filtros) {
        return todosLosEstudiantes.filter(estudiante => {
            // Filtrar por nivel
            const cumpleNivel = filtros.niveles.length === 0 ||
                filtros.niveles.includes(estudiante.nombre_nivel.toLowerCase());

            // Filtrar por curso
            const cumpleCurso = filtros.cursos.length === 0 ||
                filtros.cursos.includes(estudiante.nombre_curso);

            // Filtrar por paralelo
            const cumpleParalelo = filtros.paralelos.length === 0 ||
                filtros.paralelos.includes(estudiante.nombre_paralelo.toLowerCase());

            // Filtrar por género
            const cumpleGenero = filtros.generos.length === 0 ||
                filtros.generos.includes(estudiante.sexo);

            // Filtrar por edad
            let cumpleEdad = true;
            if (!filtros.edad.todas) {
                const edad = calcularEdad(estudiante.fecha_nacimiento);

                if (filtros.edad.minima !== null && edad < filtros.edad.minima) {
                    cumpleEdad = false;
                }

                if (filtros.edad.maxima !== null && edad > filtros.edad.maxima) {
                    cumpleEdad = false;
                }
            }

            return cumpleNivel && cumpleCurso && cumpleParalelo && cumpleGenero && cumpleEdad;
        });
    }

    function mostrarResultados(estudiantes, filtros) {
        // Ocultar sección de crear reporte y mostrar resultados
        document.getElementById('seccionCrearReporte').style.display = 'none';
        document.getElementById('resultadosReporte').style.display = 'block';

        // Actualizar resumen de filtros
        actualizarResumenFiltros(filtros);

        // Calcular estadísticas
        const stats = calcularEstadisticas(estudiantes);
        actualizarEstadisticas(stats);

        // Llenar tabla de resultados
        llenarTablaResultados(estudiantes);
    }

    function actualizarResumenFiltros(filtros) {
        let textoFiltros = [];

        if (filtros.niveles.length > 0) {
            textoFiltros.push(`Niveles: ${filtros.niveles.join(', ')}`);
        }
        if (filtros.cursos.length > 0) {
            textoFiltros.push(`Cursos: ${filtros.cursos.join(', ')}`);
        }
        if (filtros.paralelos.length > 0) {
            textoFiltros.push(`Paralelos: ${filtros.paralelos.join(', ').toUpperCase()}`);
        }
        if (filtros.generos.length > 0) {
            textoFiltros.push(`Género: ${filtros.generos.join(', ')}`);
        }

        // Agregar filtro de edad al resumen
        if (!filtros.edad.todas) {
            let textoEdad = 'Edad: ';
            if (filtros.edad.minima !== null && filtros.edad.maxima !== null) {
                textoEdad += `${filtros.edad.minima}-${filtros.edad.maxima} años`;
            } else if (filtros.edad.minima !== null) {
                textoEdad += `${filtros.edad.minima}+ años`;
            } else if (filtros.edad.maxima !== null) {
                textoEdad += `hasta ${filtros.edad.maxima} años`;
            }

            if (filtros.edad.minima !== null || filtros.edad.maxima !== null) {
                textoFiltros.push(textoEdad);
            }
        }

        document.getElementById('filtrosTexto').textContent =
            textoFiltros.length > 0 ? textoFiltros.join(' | ') : 'Sin filtros específicos';
    }

    function calcularEstadisticas(estudiantes) {
        const total = estudiantes.length;
        const mujeres = estudiantes.filter(e => e.sexo === 'femenino').length;
        const hombres = estudiantes.filter(e => e.sexo === 'masculino').length;

        // Calcular edad promedio
        let sumaEdades = 0;
        estudiantes.forEach(estudiante => {
            const edad = calcularEdad(estudiante.fecha_nacimiento);
            sumaEdades += edad;
        });
        const edadPromedio = total > 0 ? Math.round(sumaEdades / total) : 0;

        return {
            total,
            mujeres,
            hombres,
            edadPromedio
        };
    }

    function actualizarEstadisticas(stats) {
        document.getElementById('totalResultados').textContent = stats.total;
        document.getElementById('totalMujeres').textContent = stats.mujeres;
        document.getElementById('totalHombres').textContent = stats.hombres;
        document.getElementById('edadPromedio').textContent = stats.edadPromedio + ' años';
    }

    function llenarTablaResultados(estudiantes) {
        const tbody = document.getElementById('cuerpoTablaResultados');
        tbody.innerHTML = '';

        if (estudiantes.length === 0) {
            tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center py-4">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="mt-2 text-muted">No se encontraron estudiantes con los filtros seleccionados</p>
                </td>
            </tr>
        `;
            return;
        }

        estudiantes.forEach((estudiante, index) => {
            // Calcular edad
            const edad = calcularEdad(estudiante.fecha_nacimiento);

            const fila = `
            <tr>
                <td>${index + 1}</td>
                <td>${estudiante.apellido_paterno}</td>
                <td>${estudiante.apellido_materno}</td>
                <td>${estudiante.nombre}</td>
                <td>
                    <span class="badge bg-${estudiante.sexo === 'masculino' ? 'info' : 'danger'}">
                        <i class="bi bi-${estudiante.sexo === 'masculino' ? 'person' : 'person-dress'} me-1"></i>
                        ${estudiante.sexo === 'masculino' ? 'Masculino' : 'Femenino'}
                    </span>
                </td>
                <td>
                    <span class="badge bg-success">
                        ${estudiante.nombre_nivel.charAt(0).toUpperCase() + estudiante.nombre_nivel.slice(1)} 
                        ${estudiante.nombre_curso}${estudiante.nombre_paralelo.toUpperCase()}
                    </span>
                </td>
                <td>
                    <span class="badge bg-warning text-dark">
                        ${edad} años
                    </span>
                </td>
            </tr>
        `;
            tbody.innerHTML += fila;
        });
    }

    function exportarReporte(formato) {
        alert(`Exportando reporte en formato ${formato.toUpperCase()}...`);
        // Aquí implementarías la lógica de exportación
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>