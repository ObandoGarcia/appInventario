<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-list"></i>
        </button>
        <div class="sidebar-logo">
            <a href="{{ route('paneles') }}">Mc Constructores</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('marcas') }}" class="sidebar-link">
                <i class="bi bi-substack"></i>
                <span>Marcas</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('proveedores') }}" class="sidebar-link">
                <i class="bi bi-box-seam-fill"></i>
                <span>Proveedores</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('materiales') }}" class="sidebar-link">
                <i class="bi bi-stack"></i>
                <span>Materiales</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('encargados') }}" class="sidebar-link">
                <i class="bi bi-person-lines-fill"></i>
                <span>Encargados de proyecto</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('proyectos') }}" class="sidebar-link">
                <i class="bi bi-kanban-fill"></i>
                <span>Proyectos</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('maquinarias') }}" class="sidebar-link">
                <i class="bi bi-car-front"></i>
                <span>Maquinarias</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('herramientas') }}" class="sidebar-link">
                <i class="bi bi-tools"></i>
                <span>Herramientas</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('conductores') }}" class="sidebar-link">
                <i class="bi bi-truck"></i>
                <span>Conductores</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="lni lni-protection"></i>
                <span>Auth</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Login</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Register</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="{{ route('cerrar_sesion') }}" class="sidebar-link">
            <i class="bi bi-box-arrow-in-left"></i>
            <span>Cerrar sesion</span>
        </a>
    </div>
</aside>

