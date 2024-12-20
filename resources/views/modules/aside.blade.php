<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-list"></i>
        </button>
        <div class="sidebar-logo">
            <a href="{{ route('dashboard') }}">Jireh Libreria</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('authors') }}" class="sidebar-link">
                <i class="bi bi-person-lines-fill"></i>
                <span>Autores</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('categories') }}" class="sidebar-link">
                <i class="bi bi-bookmarks"></i>
                <span>Categorias</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('editorials') }}" class="sidebar-link">
                <i class="bi bi-journal-text"></i>
                <span>Editoriales</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('books') }}" class="sidebar-link">
                <i class="bi bi-book"></i>
                <span>Libros</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('customers') }}" class="sidebar-link">
                <i class="bi bi-person-check"></i>
                <span>Clientes</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('invoices') }}" class="sidebar-link">
                <i class="bi bi-receipt"></i>
                <span>Facturas</span>
            </a>
        </li>
        @role('administrador')
            <li class="sidebar-item">
                <a href="{{ route('users') }}" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        @endrole
    </ul>
    <div class="sidebar-footer">
        <a href="{{ route('close_session') }}" class="sidebar-link">
            <i class="bi bi-box-arrow-in-left"></i>
            <span>Cerrar sesion</span>
        </a>
    </div>
</aside>
