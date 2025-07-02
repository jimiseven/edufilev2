<div class="col-md-3 col-lg-2 px-0">
    <div class="sidebar d-flex flex-column p-3">
        <h5 class="text-white mb-4">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Sistema Escolar
        </h5>
        
        <nav class="nav flex-column">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"
               href="<?php echo url('index.php'); ?>">
                <i class="bi bi-house-door me-2"></i>
                Dashboard
            </a>
            
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'estudiantes.php' ? 'active' : ''; ?>"
               href="<?php echo url('pages/estudiantes.php'); ?>">
                <i class="bi bi-people me-2"></i>
                Estudiantes
            </a>
            
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'cursos.php' ? 'active' : ''; ?>"
               href="<?php echo url('pages/cursos.php'); ?>">
                <i class="bi bi-book me-2"></i>
                Cursos
            </a>
        </nav>
        
        <div class="mt-auto">
            <hr class="text-white-50">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
                   data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2"></i>
                    <span>Admin</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Configuración</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
